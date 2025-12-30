<?php

namespace App\Services;

use Carbon\Carbon;

class PetService
{
    /**
     * Sprawdza, czy użytkownik ma uprawnienia do zarządzania tym zwierzęciem.
     */
    public function canUserManagePet(int $userId, int $petOwnerId): bool
    {
        return $userId === $petOwnerId;
    }

    /**
     * Oblicza wiek zwierzęcia w latach.
     */
    public function calculateAge(string $birthDate): int
    {
        return Carbon::parse($birthDate)->age;
    }

    /**
     * Formatuje nazwę rasy (np. obsługuje brak rasy).
     */
    public function formatBreed(?string $breed): string
    {
        return $breed ?? 'Mieszaniec';
    }
}