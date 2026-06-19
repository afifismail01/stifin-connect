<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::latest()->paginate(10);

        return view(
            'super-admin.trainings.index',
            compact('trainings')
        );
    }

    public function create()
    {
        return view('super-admin.trainings.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'training_date' => 'nullable|date',
            'quota' => 'required|integer|min:0',
            'status' => 'required|in:draft,published,closed',
        ]);

        Training::create($validated);

        return redirect()
            ->route('trainings.index')
            ->with('success', 'Training berhasil dibuat');
    }

    public function edit(Training $training)
    {
        return view(
            'super-admin.trainings.form',
            compact('training')
        );
    }

    public function update(
    Request $request,
    Training $training
    ) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'training_date' => 'nullable|date',
            'quota' => 'required|integer|min:0',
            'status' => 'required|in:draft,published,closed',
        ]);

        $training->update($validated);

        return redirect()
            ->route('trainings.index')
            ->with('success', 'Training berhasil diperbarui');
    }

    public function destroy(Training $training)
    {
        $training->delete();

        return redirect()
            ->route('trainings.index')
            ->with(
                'success',
                'Training berhasil dihapus'
            );
    }
}