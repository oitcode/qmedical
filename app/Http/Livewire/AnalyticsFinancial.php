<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Expense;
use App\MedicalTest;
use App\ExpenseCategory;
use App\MedicalTestType;

class AnalyticsFinancial extends Component
{
    public $startDate;
    public $endDate;

    public $totalExpense = 0;
    public $expenses = null;

    public $totalRevenue = 0;
    public $medicalTests = null;

    public $expenseByCategories = [];
    public $revenueByCategories = [];

    public $finalResult = [];

    public function render()
    {
        return view('livewire.analytics-financial');
    }

    public function calculateTotalExpense()
    {
        $totalExpense = 0;

        $this->expenses = Expense::whereBetween('date', [$this->startDate, $this->endDate])->get();

        foreach ($this->expenses as $expense) {
            $totalExpense += $expense->amount;
        }

        $this->totalExpense = $totalExpense;
    }

    public function calculateTotalRevenue()
    {
        $totalRevenue = 0;

        $this->medicalTests = MedicalTest::whereBetween('date', [$this->startDate, $this->endDate])->get();

        foreach ($this->medicalTests as $medicalTest) {
            $totalRevenue += $medicalTest->price;
        }

        $this->totalRevenue = $totalRevenue;
    }

    public function search()
    {
        $this->resetResults();

        $this->calculateTotalExpense();
        $this->calculateTotalRevenue();

        $this->calculateExpenseByCategories();
        $this->calculateRevenueByCategories();

        $this->calculateFinalResult();
    }

    public function calculateExpenseByCategories()
    {
        $expenseCategories = ExpenseCategory::all();

        if ($expenseCategories) {
            foreach ($expenseCategories as $expenseCategory) {
                $this->expenseByCategories[$expenseCategory->name]
                    =
                    $this->calculateExpenseByCategory($expenseCategory);
            }
        }

        /* Sort the array. */
        if (!empty($this->expenseByCategories)) {
            arsort($this->expenseByCategories);
        }
    }

    public function calculateExpenseByCategory(ExpenseCategory $expenseCategory)
    {
        $total = 0;

        $expenses = $expenseCategory->expenses()->whereBetween('date', [$this->startDate, $this->endDate])->get();

        if ($expenses) {
            foreach ($expenses as $expense) {
                $total += $expense->amount;
            }
        }

        return $total;
    }

    public function calculateRevenueByCategories()
    {
        $revenueCategories = MedicalTestType::all();

        if ($revenueCategories) {
            foreach ($revenueCategories as $medicalTestType) {
                $this->revenueByCategories[$medicalTestType->name]
                    =
                    $this->calculateRevenueByCategory($medicalTestType);
            }
        }

        /* Sort the array. */
        if (!empty($this->revenueByCategories)) {
            arsort($this->revenueByCategories);
        }
    }

    public function calculateRevenueByCategory(MedicalTestType $medicalTestType)
    {
        $total = 0;

        $medicalTests = $medicalTestType->medicalTests()->whereBetween('date', [$this->startDate, $this->endDate])->get();

        if ($medicalTests) {
            foreach ($medicalTests as $medicalTest) {
                $total += $medicalTest->price;
            }
        }

        return $total;
    }

    public function resetResults()
    {
        $this->totalExpense = 0;
        $this->expenses = null;

        $this->totalRevenue = 0;
        $this->medicalTests = null;

        $this->expenseByCategories = [];
        $this->revenueByCategories = [];

        $this->finalResult = [];
    }

    public function calculateFinalResult()
    {
        if ($this->totalRevenue > $this->totalExpense) {
            $this->finalResult['name'] = 'Profit';
            $this->finalResult['value'] = $this->totalRevenue - $this->totalExpense;
        } else if ($this->totalRevenue < $this->totalExpense) {
            $this->finalResult['name'] = 'Loss';
            $this->finalResult['value'] = $this->totalExpense - $this->totalRevenue;
        } else {
            $this->finalResult['name'] = 'Balance';
            $this->finalResult['value'] = 0;
        }
    }
}
