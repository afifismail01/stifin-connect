<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UserPointController extends Controller
{
    public function show(User $user): View
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