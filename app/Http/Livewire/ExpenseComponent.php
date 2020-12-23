<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Expense;
use App\ExpenseCategory;

class ExpenseComponent extends Component
{
    protected $listeners = [
        'destroyExpenseCreate' => 'exitCreateMode',
        'displayExpense' => 'displaySingleExpense',
        'destroyDisplay' => 'exitDisplayMode',
        'deleteExpense',
        'updateExpense',
        'destroyExpenseUpdate' => 'exitUpdateMode',
        'destroyExpenseCategoryCreate' => 'exitCreateCategoryMode',
        'expenseCategoryAdded' => 'exitCreateCategoryMode',
    ];

    public $createMode = false;
    public $createCategoryMode = false;

    public $displayMode = false;
    public $displayedExpense = null;

    public $updateMode = false;
    public $updatingExpense = null;

    public function render()
    {
        $this->expenses = Expense::all();
        $this->expenseCategories = ExpenseCategory::all();

        return view('livewire.expense-component');
    }

    public function create()
    {
        $this->enterCreateMode();
    }

    public function enterCreateMode()
    {
        $this->createMode = true;
    }

    public function exitCreateMode()
    {
        $this->createMode = false;
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

    public function displaySingleExpense(Expense $expense)
    {
        $this->enterDisplayMode();
        $this->displayedExpense = $expense;
        $this->render();
    }

    public function enterDisplayMode()
    {
        $this->displayMode = true;
    }

    public function exitDisplayMode()
    {
        $this->displayedExpense = null;
        $this->displayMode = false;
    }

    public function deleteExpense($id)
    {
        Expense::findOrFail($id)->delete();
        $this->emit('updateList');
    }

    public function updateExpense(Expense $expense)
    {
        $this->updatingExpense = $expense;
        $this->enterUpdateMode();
    }

    public function enterUpdateMode()
    {
        $this->updateMode = true;
    }

    public function exitUpdateMode()
    {
        $this->updatingExpense = null;
        $this->updateMode = false;
    }

    public function enterCreateCategoryMode()
    {
        $this->createCategoryMode = true;
    }

    public function exitCreateCategoryMode()
    {
        $this->createCategoryMode = false;
    }

    public function previousDay()
    {
        $this->emit('navigateDayForExpense', 'previous');
    }

    public function nextDay()
    {
        $this->emit('navigateDayForExpense', 'next');
    }
}
