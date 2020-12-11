<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\User;

class UserCreate extends Component
{
    public $name;
    public $email;
    public $password;
    public $passwordConfirm;

    public function render()
    {
        return view('livewire.user-create');
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'passwordConfirm' => 'required|same:password',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role'] = 'standard';

        User::create($validatedData);

        $this->emitUp('userAdded');
        $this->emit('toggleUserCreateModal');
    }
}
