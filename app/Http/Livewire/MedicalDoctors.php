<?php

namespace App\Http\Livewire;

use App\Doctor;
use Livewire\Component;
use Livewire\WithPagination;

class MedicalDoctors extends Component
{
	use WithPagination;

	public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
    	$doctors = Doctor::when($this->search, function($q, $search) {
    		$q->where(\DB::raw('concat(first_name, " ", last_name)'), 'like', "%$search%");
    	})->latest()->paginate(15);

        return view('livewire.medical-doctors', compact('doctors'));
    }
}
