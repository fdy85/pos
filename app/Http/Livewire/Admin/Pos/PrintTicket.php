<?php

namespace App\Http\Livewire\Admin\Pos;

use App\Models\Sale;
use Livewire\Component;

class PrintTicket extends Component
{
    public $sale, $selectedId;

    /* GET Parameter from URL if exists */
    protected $queryString = ['selectedId'];

    public function mount(){
        $this->sale = Sale::find($this->selectedId);
    }

    public function render()
    {
        return view('livewire.admin.pos.print-ticket')
                    ->extends('layouts.guest')
                    ->section('ticket');
    }
}
