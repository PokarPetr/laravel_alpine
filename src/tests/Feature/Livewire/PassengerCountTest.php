<?php

namespace Tests\Feature\Livewire;

use App\Livewire\PassengerCount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PassengerCountTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(PassengerCount::class)
            ->assertStatus(200);
    }
}
