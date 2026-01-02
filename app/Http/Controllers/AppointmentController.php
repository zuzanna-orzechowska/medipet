<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Service;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function index()
    {
        $appointments = Appointment::where('client_id', auth()->id())
            ->with(['pet', 'service'])
            ->orderBy('appointment_date', 'asc')
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $pets = auth()->user()->pets;
        $services = Service::all();
        $doctors = \App\Models\User::where('role_id', 2)->get();

        if ($pets->isEmpty()) {
            return redirect()->route('pets.create')->with('info', 'Najpierw dodaj zwierzaka!');
        }

        return view('appointments.create', compact('pets', 'services', 'doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'service_id' => 'required|exists:services,id',
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after:now',
            'notes' => 'nullable|string|max:500',
        ]);

        $pet = Pet::findOrFail($validated['pet_id']);
        
        if (!$this->appointmentService->isOwner(auth()->id(), $pet->user_id)) {
            abort(403);
        }

        Appointment::create([
            'client_id' => auth()->id(),
            'doctor_id' => $validated['doctor_id'],
            'pet_id' => $validated['pet_id'],
            'service_id' => $validated['service_id'],
            'appointment_date' => $validated['appointment_date'],
            'status' => 'oczekująca',
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('appointments.index')->with('success', 'Wizyta została umówiona!');
    }

    public function destroy(Appointment $appointment)
    {
        //sprawdzenie uprawnień przez serwis
        if (!$this->appointmentService->isOwner(auth()->id(), $appointment->client_id)) {
            abort(403);
        }

        if (!$this->appointmentService->canBeCancelled($appointment->status)) {
            return back()->with('error', 'Nie można odwołać wizyty w tym statusie.');
        }

        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Wizyta odwołana.');
    }

    public function doctorIndex()
    {
        $appointments = Appointment::where('doctor_id', auth()->id())
            ->with(['pet', 'service', 'client'])
            ->orderBy('appointment_date', 'asc')
            ->get();

        return view('doctor.dashboard', compact('appointments'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate(['status' => 'required|in:zatwierdzona,odwołana,zakończona']);
        
        $appointment->update(['status' => $request->status]);

        return back()->with('success', 'Status wizyty został zmieniony.');
    }

    public function show(Appointment $appointment)
    {
        if (!$this->appointmentService->isOwner(auth()->id(), $appointment->client_id)) {
            abort(403);
        }
        $appointment->load(['pet', 'doctor', 'service']);
        return view('appointments.show', compact('appointment'));
    }
}