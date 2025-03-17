<?php

namespace Tests\Feature\Livewire\Bookings;

use App\Livewire\Bookings\CreateBooking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateBookingTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(CreateBooking::class)
            ->assertStatus(200);
    }
}
