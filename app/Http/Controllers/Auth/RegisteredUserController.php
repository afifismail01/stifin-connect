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
            'name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],

            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            'referrer_code' => ['nullable', 'exists:users,referral_code'],
        ]);

        // Buat user baru sebagai promotor
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => UserRoleEnum::PROMOTOR,
            'referral_code' => User::generateReferralCode(),
        ]);

        // Jika registrasi menggunakan referral
        if ($request->filled('referrer_code')) {
            $upline = User::where('referral_code', $request->referrer_code)->first();

            if ($upline) {
                // Simpan relasi referral
                Referral::create([
                    'referrer_id' => $upline->id,
                    'referred_id' => $user->id,
                ]);
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
