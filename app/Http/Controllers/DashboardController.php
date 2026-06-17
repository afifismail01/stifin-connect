<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\User;
use App\Models\Referral;
use App\Models\Point;
use App\Enums\UserRoleEnum;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        return match ($user->role) {

            /*
            |--------------------------------------------------------------------------
            | SUPER ADMIN
            |--------------------------------------------------------------------------
            */
            UserRoleEnum::SUPER_ADMIN => view(
                'dashboard.super-admin',
                [
                    'totalAdmin' => User::where(
                        'role',
                        UserRoleEnum::ADMIN
                    )->count(),

                    'totalMitra' => User::where(
                        'role',
                        UserRoleEnum::MITRA
                    )->count(),

                    'totalPeserta' => User::where(
                        'role',
                        UserRoleEnum::PESERTA
                    )->count(),

                    'totalReferral' => Referral::count(),

                    'totalPoint' => Point::sum('points'),

                    'latestUsers' => User::latest()
                        ->take(5)
                        ->get(),
                ]
            ),

            /*
            |--------------------------------------------------------------------------
            | ADMIN
            |--------------------------------------------------------------------------
            */
            UserRoleEnum::ADMIN => view(
                'dashboard.admin',
                [
                    'totalMitra' => User::where(
                        'role',
                        UserRoleEnum::MITRA
                    )->count(),

                    'totalPeserta' => User::where(
                        'role',
                        UserRoleEnum::PESERTA
                    )->count(),

                    'totalReferral' => Referral::count(),

                    'totalPoint' => $user->totalPoints(),

                    'referralLink' => url(
                        '/register?ref=' . $user->referral_code
                    ),

                    'pointHistories' => $user->points()
                        ->with('sourceUser')
                        ->latest()
                        ->take(10)
                        ->get(),

                    'mitras' => User::where(
                        'role',
                        UserRoleEnum::MITRA
                    )
                        ->withCount('downlines')
                        ->latest()
                        ->get(),

                    'pesertas' => User::where(
                        'role',
                        UserRoleEnum::PESERTA
                    )
                        ->latest()
                        ->get(),
                ]
            ),
            /*
            |--------------------------------------------------------------------------
            | MITRA
            |--------------------------------------------------------------------------
            */
            UserRoleEnum::MITRA => view(
                'dashboard.mitra',
                [
                    'user' => $user,

                    'totalPoint' => $user->totalPoints(),

                    'referralLink' => url(
                        '/register?ref=' .
                        $user->referral_code
                    ),

                    'downlines' => $user->downlines()
                        ->with('referred')
                        ->latest()
                        ->get(),

                    'pointHistories' => Point::with('sourceUser')
                        ->where('user_id', $user->id)
                        ->latest()
                        ->take(10)
                        ->get(),

                    'upline' => optional($user->upline)->referrer,
                ]
            ),

            /*
            |--------------------------------------------------------------------------
            | PESERTA
            |--------------------------------------------------------------------------
            */
            UserRoleEnum::PESERTA => view(
                'dashboard.peserta',
                [
                    'user' => $user,
                ]
            ),
        };
    }
}