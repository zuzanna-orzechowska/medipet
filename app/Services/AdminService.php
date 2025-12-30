<?php

namespace App\Services;

use App\Models\User;

class AdminService
{
    //czy administrator może usunąć danego użytkownika.
    public function canDeleteUser(int $adminId, int $targetUserId): bool
    {
        //admin nie może usunąć samego siebie
        return $adminId !== $targetUserId;
    }

    //statystyki dla dashboard
    public function formatDashboardStats(int $uCount, int $pCount, int $aCount): array
    {
        return [
            'users' => $uCount,
            'pets' => $pCount,
            'appointments' => $aCount,
        ];
    }
}