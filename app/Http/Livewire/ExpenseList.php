<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

use App\Expense;

class ExpenseList extends Component
{
    protected $listeners = [
        'updateList' => 'render',
        'navigateDayForExpense' => 'navigateDay',
        'expenseAdded' => 'render',
    ];

    public $expenses;

    public $expenseTotal;
    public $searchDate;


    public function mount()
    {
        $this->searchDate = Carbon::today();
    }

    public function render()
    {
        $this->expenses = Expense::whereDate('date', $this->searchDate)->get();
        $this->expenseTotal = $this->getExpenseTotal($this->expenses);

        return view('livewire.expense-list');
    }

    public function getExpenseTotal($expenses)
    {
        $total = 0;

        foreach ($expenses as $expense) {
            $total += $expense->amount;
        }

        return $total;
    }

    public function navigateDay($day)
    {
        if ($day === 'previous') {
            $this->searchDate->subDay();
        }
        else if ($day === 'next') {
            $this->searchDate->addDay();
        }
    }
}
