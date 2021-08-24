<?php

namespace App\Http\Livewire;

use App\BookingCenter;
use Livewire\Component;

class BookingNotes extends Component
{
	public $notes = '';
	public $bCenterId;

	public function mount(BookingCenter $bCenter)
	{
		$this->notes = $bCenter->notes ?: '';
		$this->bCenterId = $bCenter->id;
	}

    public function getCenterProperty()
    {
        return BookingCenter::find($this->bCenterId);
    }

	public function saveNotes()
	{
		$this->center->notes = $this->notes;
		$this->center->save();
	}

    public function render()
    {
        return view('livewire.booking-notes');
    }
}
