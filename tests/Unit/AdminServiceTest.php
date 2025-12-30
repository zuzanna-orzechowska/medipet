<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\AdminService;

class AdminServiceTest extends TestCase
{
    //test sprawdzający czy admin może usunąć sam siebie
    public function test_it_prevents_admin_from_deleting_themselves()
    {
        $adminService = new AdminService();
        $adminId = 1;
        $result = $adminService->canDeleteUser($adminId, 1);

        $this->assertFalse($result, 'Admin nie powinien móc usunąć własnego konta.');
    }

    // test sprawdzający czy admin może usunąć innych użytkowników
    public function test_it_allows_admin_to_delete_other_users()
    {
        $adminService = new AdminService();
        $adminId = 1;
        $result = $adminService->canDeleteUser($adminId, 2);

        $this->assertTrue($result, 'Admin powinien móc usunąć konta innych użytkowników.');
    }
}