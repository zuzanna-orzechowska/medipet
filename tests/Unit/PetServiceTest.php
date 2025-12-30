<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\PetService;
use Carbon\Carbon;

class PetServiceTest extends TestCase
{
    private $petService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->petService = new PetService();
    }

    //test sprawdzający poprawne obliczanie daty urodzenia zwierzaka
    public function test_it_calculates_age_correctly()
    {
        $fourYearsAgo = Carbon::now()->subYears(4)->format('Y-m-d');
        
        $age = $this->petService->calculateAge($fourYearsAgo);

        $this->assertEquals(4, $age);
    }

    //test sprawdzający, kto jest właścicielem danego zwierzaka
    public function test_it_validates_pet_management_permissions()
    {
        //jest właścicielem
        $this->assertTrue($this->petService->canUserManagePet(1, 1));
        
        //nie jest właścicielem
        $this->assertFalse($this->petService->canUserManagePet(1, 2));
    }

    //test sprawdzający format daty
    public function test_it_formats_breed_name_correctly()
    {
        //rasa jest podana
        $this->assertEquals('Owczarek', $this->petService->formatBreed('Owczarek'));
        
        //brak rasy - null
        $this->assertEquals('Mieszaniec', $this->petService->formatBreed(null));
    }
}