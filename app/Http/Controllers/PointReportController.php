<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\View\View;
use App\Models\User;

class PointReportController extends Controller
{
    public function index(): View
    {
        return view('super-admin.point-report', [
            'points' => Point::with('user', 'sourceUser')
                ->latest()
                ->paginate(20),

            'totalPoint' => Point::sum('points'),
        ]);
    }

    public function userPoints(User $user)
    {
        return view('super-admin.user-points', [
            'user' => $user,

            'points' => $user->points()
                ->with('sourceUser')
                ->latest()
                ->paginate(20),

            'totalPoint' => $user->totalPoints(),
        ]);
    }
}