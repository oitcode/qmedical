<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExpenseDetail extends Component
{
    public $expense;

    public function render()
    {
        return view('livewire.expense-detail');
    }
}
