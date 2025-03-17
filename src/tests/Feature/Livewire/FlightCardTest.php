<?php

namespace Tests\Feature\Livewire;

use App\Livewire\FlightCard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class FlightCardTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(FlightCard::class)
            ->assertStatus(200);
    }
}
