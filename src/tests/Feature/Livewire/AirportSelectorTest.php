<?php

namespace Tests\Feature\Livewire;

use App\Livewire\AirportSelector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

use App\Models\Airport;

class AirportSelectorTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AirportSelector::class)
            ->assertStatus(200);
    }

    
}

