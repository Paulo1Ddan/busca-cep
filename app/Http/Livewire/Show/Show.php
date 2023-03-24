<?php

namespace App\Http\Livewire\Show;

use Livewire\Component;
use App\Models\Address;

class Show extends Component
{
    public function render()
    {
        return view('livewire.show.show', ["addresses" => Address::all()]);
    }
}
