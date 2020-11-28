<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Expense;

class ExpenseComponent extends Component
{
    public $expenses;

    public $expense_id;
    public $date = '';
    public $name = '';
    public $amount = '';
    public $comment = '';

    public $updateMode = false;

    public function render()
    {
        $this->expenses = Expense::all();

        return view('livewire.expense-component');
    }

    public function store()
    {
        $validatedData = $this->validate([
            'date' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'comment' => 'nullable',
        ]);

        Expense::create($validatedData);
        session()->flash('message', 'Expense Created Successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);

        $this->expense_id = $id;
        $this->date = $expense->date;
        $this->name = $expense->name;
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

        $this->updateMode = false;
        session()->flash('message', 'Expense Updated Successfully.');
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->date = '';
        $this->name = '';
        $this->amount = '';
        $this->comment = '';
    }

    public function delete($id)
    {
        Expense::find($id)->delete();
        session()->flash('message', 'Expense Deleted Successfully.');
    }
}
