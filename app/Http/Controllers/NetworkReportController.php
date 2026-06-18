<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class NetworkReportController extends Controller
{
    public function show(User $user): View
    {
        $user->load([
            'downlines.referred.downlines.referred'
        ]);

        $user->loadCount([
            'directMitras',
            'directPesertas'
        ]);

        return view(
            'super-admin.network-report',
            [
                'admin' => $user,
            ]
        );
    }
}