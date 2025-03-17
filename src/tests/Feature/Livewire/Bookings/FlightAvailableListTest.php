<?php

namespace Tests\Feature\Livewire\Bookings;

use App\Livewire\Bookings\FlightAvailableList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class FlightAvailableListTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(FlightAvailableList::class)
            ->assertStatus(200);
    }
}
