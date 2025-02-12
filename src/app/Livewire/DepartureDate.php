<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\On; 

class DepartureDate extends Component
{
    public $showCalendar = false; 
    public $selectedDate = null; 
    public $targetInput = ''; 
    public $startDate = null; 
    public $returnDate = null; 

    public function mount()
    {
        $this->startDate = '';       
        $this->returnDate = ''; 
    }

    
    #[On('selectedDate')]
    public function setFlightDate($date)
    {
        $dt = Carbon::createFromFormat('Y-m-d',$date);
        if($this->targetInput == 'start'){
            $this->startDate = $date;
            if($this->returnDate) {
                $return_date = Carbon::createFromFormat('Y-m-d', $this->returnDate);
                if ($return_date < $dt){
                    $this->returnDate = $dt->format('Y-m-d');
                }
            }
            $this->dispatch('propertyUpdated', ['property' => 'startDate', 'value' => $this->startDate]);
        }elseif($this->targetInput == 'return'){
            $this->returnDate = $date;
            if($this->startDate) {
                $start_date = Carbon::createFromFormat('Y-m-d', $this->startDate);
                if ($start_date > $dt){
                    $this->startDate = $dt->format('Y-m-d');
                }
            }
            $this->dispatch('propertyUpdated', ['property' => 'returnDate', 'value' => $this->returnDate]);
        }
    }

    public function openCalendar($target)
    {        
        $this->targetInput = $target;
        $this->showCalendar = true;
    }

    // Закрытие календаря
    
    #[On('closeModals')]
    public function closeCalendar()
    {
        if($this->showCalendar == true) {
            $this->showCalendar = false;
        }
    }
    // Сброс обратной даты
    
    #[On('resetReturnDate')]
    public function resetReturnDate()
    {
        $this->returnDate = '';
    }
    public function render()
    {
        return view('livewire.departure-date');
    }
}
