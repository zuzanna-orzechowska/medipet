<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\AppointmentService;

class AppointmentServiceTest extends TestCase
{
    //test sprawdzający jakie statusy wizyt pozwalają na jej odwołanie
    public function test_it_allows_cancelling_only_pending_appointments()
    {
        $service = new AppointmentService();

        //statusy zezwalajace na odwołanie wizyty
        $this->assertTrue($service->canBeCancelled('oczekująca'));

        //statusy blokujące odwołanie wizyty
        $this->assertFalse($service->canBeCancelled('zatwierdzona'));
        $this->assertFalse($service->canBeCancelled('zakończona'));
        $this->assertFalse($service->canBeCancelled('odwołana'));
    }

    //test sprawdzający czy dany użytkownik jest właścicielem wizyty
    public function test_it_correctly_validates_ownership()
    {
        $service = new AppointmentService();
        $currentUserId = 10;

        //użytkownik jest właścicielem
        $this->assertTrue($service->isOwner($currentUserId, 10));

        //użytkownik nie jest właścicielem
        $this->assertFalse($service->isOwner($currentUserId, 99));
    }
}