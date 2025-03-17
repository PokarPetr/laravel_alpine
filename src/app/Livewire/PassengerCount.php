<?php

namespace App\Livewire;

use Livewire\Component;

class PassengerCount extends Component
{
    protected $listeners = ['closeModals' => 'closeCounter']; 
    public $showCounter = false;
    public $passengerNumber;

    public function mount() 
    {
        $this->passengerNumber = session('passengerNumber', 1);
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
        $this->passengerNumber++;
        $this->updatedPassengerNumber($this->passengerNumber);
    }
 
    public function decrement()
    {
        if ($this->passengerNumber > 1) {
            $this->passengerNumber--;
        }
        $this->updatedPassengerNumber($this->passengerNumber);        
    }

    public function resetReturnDate()
    {
        $this->passengerNumber = 1;
        $this->updatedPassengerNumber($this->passengerNumber);
    }

    public function updatedPassengerNumber($value) {
        $this->dispatch('propertyUpdated', ['property' => 'passengerNumber', 'value' => $value]);
    }

    public function render()
    {
        return view('livewire.passenger-count');
    }
}
