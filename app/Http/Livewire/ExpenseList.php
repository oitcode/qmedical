<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Expense;

class ExpenseList extends Component
{

    protected $listeners = [
        // 'dataAdded' => 'render',
        'updateList' => 'render',
    ];

    public $expenses;


    public function render()
    {
        $this->expenses = Expense::all()->sortByDesc('expense_id');

        return view('livewire.expense-list');
    }
}
