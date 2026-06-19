<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\TrainingRegistration;

class TrainingRegistrationController extends Controller
{
    public function index()
    {
        $registrations = TrainingRegistration::with([
            'user',
            'training'
        ])
        ->latest()
        ->paginate(20);

        return view(
            'super-admin.training-registrations.index',
            compact('registrations')
        );
    }
}