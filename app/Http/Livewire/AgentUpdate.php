<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AgentUpdate extends Component
{
    public $agent;

    public $name;
    public $sex;
    public $address;
    public $contact_number;
    public $email;
    public $comment;

    public function mount()
    {
        $this->name = $this->agent->name; 
        $this->sex = $this->agent->sex; 
        $this->contact_number = $this->agent->contact_number; 
        $this->email = $this->agent->email; 
        $this->comment = $this->agent->comment; 
    }

    public function render()
    {
        return view('livewire.agent-update');
    }

    public function resetInputFields()
    {
        //
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'sex' => 'nullable',
            'email' => 'nullable|email',
            'contact_number' => 'nullable|regex:/^[0-9]*$/',
            'comment' => 'nullable',
        ]);

        $this->agent->update($validatedData);

        $this->emitUp('agentUpdated');
        $this->emit('toggleAgentUpdateModal');
    }
}
