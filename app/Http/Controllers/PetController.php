<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    protected $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index()
    {
        $pets = auth()->user()->pets;
        return view('pets.index', compact('pets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'breed' => 'nullable|string|max:100',
            'birth_date' => 'nullable|date',
        ]);

        auth()->user()->pets()->create($validated);
        return redirect()->route('pets.index')->with('success', 'Zwierzę zostało dodane!');
    }

    public function edit(Pet $pet)
    {
        if (!$this->petService->canUserManagePet(auth()->id(), $pet->user_id)) {
            abort(403);
        }

        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, Pet $pet)
    {
        if (!$this->petService->canUserManagePet(auth()->id(), $pet->user_id)) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'breed' => 'nullable|string|max:100',
            'birth_date' => 'nullable|date',
        ]);

        $pet->update($validated);
        return redirect()->route('pets.index')->with('success', 'Dane zostały zaktualizowane.');
    }

    public function destroy(Pet $pet)
    {
        if (!$this->petService->canUserManagePet(auth()->id(), $pet->user_id)) {
            abort(403);
        }

        $pet->delete();
        return redirect()->route('pets.index')->with('success', 'Zwierzak został usunięty.');
    }
}