<?php

namespace App\Services;

use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentService
{
    //użytkownik jako właściciel zwierzaka
    public function isOwner(int $userId, int $ownerId): bool
    {
        return $userId === $ownerId;
    }

    //wizyta może zostać odwołana jedynie jeśli ma status oczekująca
    public function canBeCancelled(string $status): bool
    {
        return $status === 'oczekująca';
    }

    //format statusu dla admina/lekarza
    public function validateStatusTransition(string $newStatus): bool
    {
        $allowed = ['oczekująca', 'zatwierdzona', 'zakończona', 'odwołana'];
        return in_array($newStatus, $allowed);
    }
}