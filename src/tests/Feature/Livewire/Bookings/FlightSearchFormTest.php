<?php

namespace Tests\Feature\Livewire\Bookings;

use App\Livewire\Bookings\FlightSearchForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class FlightSearchFormTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(FlightSearchForm::class)
            ->assertStatus(200);
    }
}
