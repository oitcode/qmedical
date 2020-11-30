<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;

class InfoCardUser extends Component
{
    public $userCount;

    public function render()
    {
        $this->userCount = User::count();

        return view('livewire.info-card-user');
    }
}
