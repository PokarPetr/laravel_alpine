<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CalendarSelector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CalendarSelectorTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(CalendarSelector::class)
            ->assertStatus(200);
    }
}
