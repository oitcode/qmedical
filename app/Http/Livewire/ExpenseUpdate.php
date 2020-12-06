<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\ExpenseCategory;
use App\Expense;

class ExpenseUpdate extends Component
{
    public $expense;

    public $expenseCategories;

    public $expense_id;
    public $date = '';
    public $expense_category_id = '';
    public $amount = '';
    public $comment = '';
    public $name = '';


    public function mount()
    {
        $this->expense_id = $this->expense->expense_id; 
        $this->date = $this->expense->date; 
        $this->expense_category_id = $this->expense->expense_category_id; 
        $this->amount = $this->expense->amount; 
        $this->comment = $this->expense->comment; 
        $this->name = $this->expense->name; 
    }

    public function render()
    {
        $this->expenseCategories = ExpenseCategory::all();
        return view('livewire.expense-update');
    }

    public function resetInputFields()
    {
        $this->expense_id = '';
        $this->date = '';
        $this->expense_category_id = '';
        $this->amount = '';
        $this->comment = '';
        $this->name = '';
    }

    public function update()
    {
        $validatedData = $this->validate([
            'date' => 'required',
            'expense_category_id' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'comment' => 'nullable',
        ]);

        $this->expense->update($validatedData);

        $this->emit('toggleExpenseUpdateModal');
    }
}
