<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\ExpenseCategory as EC;;

class ExpenseCategory extends Component
{
    public $name;
    public $comment;

    public $createMode = false;
    public $updateMode = false;

    public $expenseCategories = null;

    public function render()
    {
        $this->expenseCategories = EC::all();

        return view('livewire.expense-category');
    }

    public function create()
    {
        $this->createMode = true;
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->comment = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'comment' => 'nullable',
        ]);

        EC::create($validatedData);
        $this->exitCreateMode();
    }

    public function exitCreateMode()
    {
        $this->resetInputFields();
        $this->createMode = false;
    }

    public function delete($id)
    {
        EC::findOrFail($id)->delete();
    }
}
