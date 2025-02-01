<?php

namespace Tests\Feature\Livewire;

use App\Livewire\DepartureDate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DepartureDateTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(DepartureDate::class)
            ->assertStatus(200);
    }
}
