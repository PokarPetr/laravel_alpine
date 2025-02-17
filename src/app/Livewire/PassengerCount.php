<?php

namespace App\Livewire;

use Livewire\Component;

class PassengerCount extends Component
{
    protected $listeners = ['closeModals' => 'closeCounter']; 
    public $showCounter = false;
    public $passangerNumber = null;

    public function mount() 
    {
        $this->passangerNumber = 1;
    }

    public function openCounter()
    {
        $this->showCounter = true;
    }

    public function closeCounter()
    {
        $this->showCounter = false;
    }

    public function increment()
    {
        $this->passangerNumber++;
        $this->updatedPassangerNumber($this->passangerNumber);
    }
 
    public function decrement()
    {
        if ($this->passangerNumber > 1) {
            $this->passangerNumber--;
        }
        $this->updatedPassangerNumber($this->passangerNumber);        
    }

    public function resetReturnDate()
    {
        $this->passangerNumber = 1;
        $this->updatedPassangerNumber($this->passangerNumber);
    }

    public function updatedPassangerNumber($value) {
        $this->dispatch('propertyUpdated', ['property' => 'passangerNumber', 'value' => $value]);
    }

    public function render()
    {
        return view('livewire.passenger-count');
    }
}
