<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with([
            'upline.referrer'
        ]);

        if ($request->filled('role')) {
            $query->where(
                'role',
                $request->role
            );
        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'super-admin.users.index',
            [
                'users' => $users,
                'selectedRole' => $request->role,
            ]
        );
    }

    public function updateRole(
        Request $request,
        User $user
    ) {
        /*
        |--------------------------------------------------------------------------
        | Super Admin tidak boleh diubah
        |--------------------------------------------------------------------------
        */
        if ($user->isSuperAdmin()) {
            abort(403);
        }

        $request->validate([
            'role' => [
                'required',
                'in:admin,mitra,promotor',
            ],
        ]);

        $newRole = UserRoleEnum::from(
            $request->role
        );

        /*
        |--------------------------------------------------------------------------
        | Tidak ada perubahan
        |--------------------------------------------------------------------------
        */
        if ($user->role === $newRole) {
            return back()->with(
                'success',
                'Role tidak berubah'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Update Role
        |--------------------------------------------------------------------------
        */
        $user->update([
            'role' => $newRole,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Jika menjadi MITRA
        | otomatis jadikan downline ADMIN
        |--------------------------------------------------------------------------
        */
        if ($newRole === UserRoleEnum::MITRA) {

            $alreadyHasUpline = Referral::where(
                'referred_id',
                $user->id
            )->exists();

            if (!$alreadyHasUpline) {

                $admin = User::where(
                    'role',
                    UserRoleEnum::ADMIN
                )->first();

                if ($admin) {

                    Referral::create([
                        'referrer_id' => $admin->id,
                        'referred_id' => $user->id,
                    ]);
                }
            }
        }

        return back()->with(
            'success',
            'Role berhasil diubah menjadi ' .
            strtoupper($newRole->value)
        );
    }
}