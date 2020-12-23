<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\ExpenseCategory;
use App\Expense;

class ExpenseCreate extends Component
{
    public $expenses;

    public $expense_id;
    public $date = '';
    public $expense_category_id = '';
    public $amount = '';
    public $comment = '';
    public $name = '';

    public $expenseCategories;

    public $createMode = false;
    public $updateMode = false;
    public $displayMode = false;

    public function render()
    {
        $this->expenseCategories = ExpenseCategory::all();
        return view('livewire.expense-create');
    }

    public function resetInputFields()
    {
        $this->expense_id = '';
        $this->date = '';
        $this->expenseCategoryId = '';
        $this->amount = '';
        $this->comment = '';
        $this->name = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'date' => 'required',
            'expense_category_id' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'comment' => 'nullable',
        ]);

        Expense::create($validatedData);

        $this->emit('expenseAdded');
        $this->emit('toggleExpenseCreateModal');
    }
}
