<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Expense;
use App\ExpenseCategory;

class ExpenseComponent extends Component
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

    public function render()
    {
        $this->expenses = Expense::all();
        $this->expenseCategories = ExpenseCategory::all();

        return view('livewire.expense-component');
    }

    public function create()
    {
        $this->createMode = true;
    }

    public function exitCreateMode()
    {
        $this->resetInputFields();
        $this->createMode = false;
    }

    public function exitUpdateMode()
    {
        $this->resetInputFields();
        $this->updateMode = false;
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
        session()->flash('message', 'Expense Created Successfully.');
        $this->resetInputFields();
        $this->exitCreateMode();
    }

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);

        $this->expense_id = $id;
        $this->date = $expense->date;
        $this->name = $expense->name;
        $this->expense_category_id = $expense->expense_category_id;
        $this->amount = $expense->amount;
        $this->comment = $expense->comment;

        $this->updateMode = true;
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'date' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'comment' => 'nullable',
        ]);


        $expense = Expense::find($this->expense_id);
        $expense->update([
            'date' => $this->date,
            'name' => $this->name,
            'amount' => $this->amount,
            'comment' => $this->comment,
        ]);

        $this->exitUpdateMode();
        session()->flash('message', 'Expense Updated Successfully.');
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

    public function delete($id)
    {
        Expense::find($id)->delete();
        session()->flash('message', 'Expense Deleted Successfully.');
    }
}
