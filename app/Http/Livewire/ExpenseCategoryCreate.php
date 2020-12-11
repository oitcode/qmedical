<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\ExpenseCategory;

class ExpenseCategoryCreate extends Component
{
    public $name = null;
    public $comment = null;


    public function render()
    {
        return view('livewire.expense-category-create');
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|unique:expense_category',
            'comment' => 'nullable|string',
        ]);

        $expenseCategory = ExpenseCategory::create($validatedData);

        $this->emit('expenseCategoryAdded');
        $this->emit('toggleExpenseCategoryCreateModal');
    }
}
