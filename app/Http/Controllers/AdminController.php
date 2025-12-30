<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pet;
use App\Models\Appointment;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function dashboard()
    {
        //statystyki w serwisie
        $stats = $this->adminService->formatDashboardStats(
            User::count(), 
            Pet::count(), 
            Appointment::count()
        );

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::with('role')->get();
        return view('admin.users', compact('users'));
    }

    public function editUser(User $user)
    {
        $roles = \App\Models\Role::all();
        return view('admin.users-edit', compact('user', 'roles'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', "Dane użytkownika <b>{$user->name}</b> zostały zaktualizowane.");
    }

    public function appointments()
    {
        $appointments = Appointment::with(['client', 'doctor', 'pet', 'service'])->latest()->get();
        return view('admin.appointments', compact('appointments'));
    }

    public function updateAppointmentStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:oczekująca,zatwierdzona,zakończona,odwołana'
        ]);

        $appointment->update(['status' => $validated['status']]);

        return back()->with('success', "Status wizyty został zmieniony na: {$validated['status']}.");
    }

    public function destroyAppointment(Appointment $appointment)
    {
        $appointment->delete();
        return back()->with('success', 'Wizyta została trwale usunięta z rejestru kliniki.');
    }

    public function destroyUser(User $user)
    {
        if (!$this->adminService->canDeleteUser(auth()->id(), $user->id)) {
            return back()->with('error', 'Nie możesz usunąć własnego konta administratora!');
        }
        
        $user->delete();
        return back()->with('success', 'Użytkownik został pomyślnie usunięty z systemu.');
    }

    public function pets()
    {
        $pets = Pet::with('user')->get();
        return view('admin.pets', compact('pets'));
    }

    public function editPet(Pet $pet)
    {
        $users = User::all();
        return view('admin.pets-edit', compact('pet', 'users'));
    }

    public function updatePet(Request $request, Pet $pet)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'species'    => 'required|string|max:255',
            'breed'      => 'nullable|string|max:100',
            'birth_date' => 'required|date',
            'user_id'    => 'required|exists:users,id',
        ]);

        $pet->update($validated);

        return redirect()->route('admin.pets')
            ->with('success', "Dane zwierzaka <b>{$pet->name}</b> zostały zaktualizowane.");
    }

    public function destroyPet(Pet $pet)
    {
        $petName = $pet->name;
        $pet->delete();
        
        return back()->with('success', "Zwierzak o imieniu <b>{$petName}</b> został usunięty.");
    }
}