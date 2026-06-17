<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Referral;
use App\Models\Point;
use App\Enums\UserRoleEnum;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        return view('auth.register', [
            'referrerCode' => $request->ref,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],

            'referrer_code' => [
                'nullable',
                'exists:users,referral_code',
            ],
        ]);

        // Buat user baru sebagai peserta
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => UserRoleEnum::PESERTA,
            'referral_code' => User::generateReferralCode(),
        ]);

        // Jika registrasi menggunakan referral
        if ($request->filled('referrer_code')) {

            $upline = User::where(
                'referral_code',
                $request->referrer_code
            )->first();

            if ($upline) {

                // Simpan relasi referral
                Referral::create([
                    'referrer_id' => $upline->id,
                    'referred_id' => $user->id,
                ]);

                /*
                |--------------------------------------------------------------------------
                | SISTEM POIN
                |--------------------------------------------------------------------------
                |
                | ADMIN -> PESERTA = 1 poin
                |
                | MITRA -> PESERTA
                | MITRA dapat 0.5 poin
                | ADMIN upline dapat 0.5 poin
                |
                */

                // ADMIN merekrut peserta langsung
                if ($upline->role === UserRoleEnum::ADMIN) {

                    Point::create([
                        'user_id' => $upline->id,
                        'source_user_id' => $user->id,
                        'points' => 1,
                        'description' => 'Referral peserta langsung',
                    ]);
                }

                // MITRA merekrut peserta
                elseif ($upline->role === UserRoleEnum::MITRA) {

                    // Mitra dapat 0.5
                    Point::create([
                        'user_id' => $upline->id,
                        'source_user_id' => $user->id,
                        'points' => 0.5,
                        'description' => 'Referral peserta oleh mitra',
                    ]);

                    // Cari admin yang merekrut mitra tersebut
                    $adminReferral = $upline->upline;

                    if ($adminReferral) {

                        $admin = User::find(
                            $adminReferral->referrer_id
                        );

                        if (
                            $admin &&
                            $admin->role === UserRoleEnum::ADMIN
                        ) {

                            Point::create([
                                'user_id' => $admin->id,
                                'source_user_id' => $user->id,
                                'points' => 0.5,
                                'description' => 'Bonus referral dari mitra',
                            ]);
                        }
                    }
                }
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}