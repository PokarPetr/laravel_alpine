<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class CalendarSelector extends Component
{   
    
    public $currentDate;
    public $currentYear;
    public $currentMonth;
    public $currentMonthName;
    public $yearNumbers = 3;
    public $monthNumber = 2;
    public $months = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
    ];
    public $years = [];  


    /**
     * Initialize year and month for the calendar
     * Set year to the current year, and month to the current month.
     */
    public function mount() : void 
    {
        $this->currentDate = Carbon::now();        

        $this->currentYear = $this->currentDate->copy()->year;
        $this->currentMonth = $this->currentDate->copy()->month;
        $this->currentMonthName = $this->months[(int) $this->currentMonth];
        for ($y = 0; $y <= $this->yearNumbers; $y++) {
            $this->years[] = $this->currentYear + $y;
        } 
    }   
  
    
    /**
     * Render the view for the calendar selector.
     * Passes the current year, month, and days to the view.
     */
    public function render()
    {   
        return view('livewire.calendar-selector', [
            'days' => $this->getDays($this->currentDate, $this->monthNumber) 
        ]);
    }


    /**
     * Get days for the specified number of months.
     * Loops through the current month and the next months.
     *
     * @param int $numberOfMonth Number of months to fetch days for.
     * @return array Array of weeks with day and metadata.
     */
    private function getDays($currentDate, $monthNumber): array
    {            
        $currentWeeks = $this->getCurrentWeeks($currentDate, $isCurrentMonth=true);        
        
        $monthNumber--;

        while ($monthNumber) {

            $weeksNextMonth = $this->getCurrentWeeks($currentDate->copy()->addMonth());             
            $currentWeeks = $this->getAllWeeks($currentWeeks, $weeksNextMonth );

            $currentDate = $currentDate->addMonth();
            $monthNumber--;
        }
        
        return $currentWeeks;
    }

    /**
     * Get weeks for the current month.
     * This calculates the first and last day of the month and returns the weeks.
     *
     * @param Carbon $date Date object for the current month.
     * @param bool $isCurrentMonth Boolean flag to check if it's the current month.
     * @return array Array of weeks with day and metadata.
     */
    private function getCurrentWeeks($date, $isCurrentMonth=false): array 
    {
        $firstDayOfMonth = $date->copy()->startOfMonth();
        $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth();
        $dayOfWeek = $firstDayOfMonth->dayOfWeek;
        $dayOfWeek = ($dayOfWeek == 0) ? 7 : $dayOfWeek; 


        return $this->getWeeksForMonth($firstDayOfMonth, $lastDayOfMonth, $dayOfWeek, $isCurrentMonth);        
    }    
    
    /**
     * Get weeks for a given month.
     * This function builds an array of weeks, each containing day data with meta information.
     *
     * @param Carbon $firstDay First day of the month.
     * @param Carbon $lastDay Last day of the month.
     * @param int $dayOfWeek Day of the week the month starts on.
     * @param bool $isCurrentMonth Flag indicating whether the month is the current month.
     * @return array Array of weeks, where each week is an array of day data.
     */
    private function getWeeksForMonth($firstDay, $lastDay, $dayOfWeek, $isCurrentMonth=false): array
    {
        $weeks = [];
        $week = [];
        $currentDay = $firstDay->copy();
        $class = '';
        if ( ! $isCurrentMonth ) {
            $class = 'next-month-day';
        }
       
        for ($i = 1; $i < $dayOfWeek; $i++) {
            $week[] = [
                'day' => '',
                'meta' => [
                    'class' => $class,
                    'data-month' => '',
                    'data-year' => '',
                    'data-date' => '',],
            ];
        }   
    
        for ($day = 1; $day <= $lastDay->day; $day++) {
            $formattedDay = str_pad($day, 2, '0', STR_PAD_LEFT);
            $dayData = [
                'day' => $formattedDay,
                'meta' => [
                    'class' => $class,
                    'data-date' => $currentDay->year.'-'.$currentDay->format('m').'-'.$formattedDay,
                ]
            ];
            $week[] = $dayData;
    
            if (count($week) == 7) {
                $weeks[] = $week;
                $week = []; 
            }
        }    
        
        if (count($week) > 0) {
            while (count($week) < 7) {
                $week[] = [
                    'day' => '_',
                    'meta' => [
                        'class' => $class,
                        'data-month' => '',
                        'data-year' => '',
                        'data-date' => '',],
                    ];
            }
            $weeks[] = $week; 
        }
    
        return $weeks;
    }

    /**
     * Merge the last week of the current month and the first week of the next month.
     * This function ensures that the weeks are properly aligned.
     *
     * @param array $firstMonth Weeks from the first month.
     * @param array $lastMonth Weeks from the next month.
     * @return array Merged array of weeks from both months.
     */
    private function getAllWeeks($firstMonth, $lastMonth): array
    {
        $lastWeekCurrentMonth = array_pop($firstMonth); 
        $isLastWeekCurrentMonthFull = true;
        foreach ($lastWeekCurrentMonth as $key => $dayData) {
            if ($dayData['day'] == '_') {
                $isLastWeekCurrentMonthFull = false;
                break;               
            }
        }
        if (! $isLastWeekCurrentMonthFull ){
            $firstWeekNextMonth = array_shift($lastMonth);
            foreach ($lastWeekCurrentMonth as $key => $dayData) {
                if ($dayData['day'] == '_') {
                    $lastWeekCurrentMonth[$key] = $firstWeekNextMonth[$key];                
                }
            }
        }
        
        return array_merge($firstMonth, [$lastWeekCurrentMonth], $lastMonth);
    }


    /**
     * Update the calendar when the user selects a different year or month.
     */

    public function updated($propertyName): void
    {        
        $this->updateCalendar();
    }
 
    /**
    * Rebuild the calendar based on the selected year and month.
    */
    private function updateCalendar(): void
    {
        $this->currentDate = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $this->currentMonthName = $this->months[(int) $this->currentMonth];
        
    }

    public function setDate($date)
    {
    $dt = Carbon::createFromFormat('Y-m-d', $date);
    $this->currentYear = $dt->copy()->year;
    $this->currentMonth = $dt->month;
    $this->updateCalendar();
    $this->dispatch('selectedDate', $date);

    }

    public function closeCalendar()
    {
    $this->dispatch('closeCalendar', true);

    }
    public function resetDate()
    {
    $this->dispatch('resetReturnDate'); 
    }
}
