<?php

namespace App\Http\Livewire\Welcome;

use App\Models\Client;
use App\Models\Cost;
use App\Models\Item;
use App\Models\Material;
use Livewire\Component;

class WelcomeIndex extends Component
{
    public $modalTitle = 'APG Reciclados', $name, $email, $subject, 
            $material_id, $item_id, $msg, $folioType, $qty, $cost, $total,
            $info= [], $weights = [], $tempItemId, $tempItemName, $tempClientName, $newFolioTotalCost,
            $formOpen, $formQuoterOpen;

    public function mount(){
        $this->formOpen = false;
        $this->formQuoterOpen = false;
    }

    public function render()
    {
        //dd($materials);
        return view('livewire.welcome.welcome-index');
    }

    /* Show Contact Form */
    public function showForm(){
        $this->resetUI();
        $this->formOpen = true;
    }

    /* Show Quoter Form */
    public function showQuoterForm(){
        $this->resetUI();
        $this->folioType = 'Compra';
        $this->formQuoterOpen = true;
    }

    /* Send Contact Form */
    public function sendContactForm(){
        $rules = ['name' => 'required',
                'email' => 'required',
                'subject' => 'required',
                'msg' => 'required',
                ];
        $messages = ['name.required' => 'El Nombre es requerido',
                    'email.required' => 'El Correo Electronico es requerido',
                    'subject.required' => 'El Asunto es requerido',
                    'msg.required' => 'El Mensaje es requerido',
                    ];
        $this->validate($rules, $messages);
    }

    

    public function resetUi(){
        $this->reset(['name', 'email', 'subject', 'msg', 'material_id', 'item_id', 
                    'folioType', 'qty', 'cost', 'total', 'tempItemName', 'weights',
                    'formOpen', 'formQuoterOpen']);
    }
}
