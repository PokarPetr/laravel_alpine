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
        $this->startDate = $this->date('startDate');       
        $this->returnDate = $this->date('returnDate'); 
    }

    private function date($property)
    {
        $date = session($property, '');
        if (!$date) return '';
        return $date->format('Y-m-d');
    }

    
    #[On('selectedDate')]
    public function setFlightDate($date)
    {
        if($date) {
            $dt = Carbon::createFromFormat('Y-m-d',$date);
            if($this->targetInput == 'start'){
                $this->startDate = $date;
                $this->updatedStartDate($this->startDate); 
                if($this->returnDate) {
                    $return_date = Carbon::createFromFormat('Y-m-d', $this->returnDate);
                    if ($return_date < $dt){
                        $this->returnDate = $dt->format('Y-m-d');
                        $this->updatedReturnDate($this->returnDate);
                    }
                }
                
            }elseif($this->targetInput == 'return'){
                $this->returnDate = $date;
                $this->updatedReturnDate($this->returnDate);
                if($this->startDate) {
                    $start_date = Carbon::createFromFormat('Y-m-d', $this->startDate);
                    if ($start_date > $dt){
                        $this->startDate = $dt->format('Y-m-d'); 
                        $this->updatedStartDate($this->startDate);                    
                    }
                }                
            }
        }
    }
    
    public function updatedStartDate($value){
        $this->dispatch('propertyUpdated', ['property' => 'startDate', 'value' => $value]);
    }

    public function updatedReturnDate($value){
        $this->dispatch('propertyUpdated', ['property' => 'returnDate', 'value' => $value]);
    }

    public function openCalendar($target)
    {        
        $this->targetInput = $target;
        $this->showCalendar = true;
    }

    
    #[On('closeModals')]
    public function closeCalendar()
    {
        if($this->showCalendar == true) {
            $this->showCalendar = false;
        }
    }
    
    #[On('resetReturnDate')]
    public function resetReturnDate()
    {
        $this->returnDate = '';
        $this->updatedReturnDate($this->returnDate);
        
    }
    public function render()
    {
        return view('livewire.departure-date');
    }
}
