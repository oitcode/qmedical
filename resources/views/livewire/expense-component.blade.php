<div class="card card-outline card-danger">
  <div class="card-header">
    <h3 class="card-title">
      Expense
    </h3>
    <div class="card-tools">
      <button class="btn btn-sm btn-outline-info px-3" wire:click="create">
        <i class="fas fa-plus"></i>
      </button>

      @can ('create-expense-category')
        <button class="btn btn-sm btn-outline-info px-3 mr-3" wire:click="enterCreateCategoryMode">
          <i class="fas fa-folder-plus"></i>
        </button>
      @endcan

      <button class="btn btn-info btn-sm border rounded-circle" wire:click.prevent="previousDay">
        <i class="fas fa-arrow-left"></i>
      </button>

      <span class="btn btn-info btn-sm border rounded-circle" wire:click.prevent="nextDay">
        <i class="fas fa-arrow-right"></i>
      </span>

    </div>
  </div>
  <div class="card-body p-0">
    {{-- Show expense create modal if neccessary --}}
    @if($createMode)
      @livewire('expense-create')
    @endif

    {{-- Display expense details in a modal --}}
    @if ($displayMode)
      @livewire('expense-detail', ['expense' => $displayedExpense])
    @endif

    {{-- Update modal --}}
    @if ($updateMode)
      @livewire('expense-update', ['expense' => $updatingExpense])
    @endif

    {{-- Show agent list --}}
    @livewire('expense-list')

    {{--
    @livewire('expense-category')
    --}}

    @if ($createCategoryMode)
      @livewire('expense-category-create')
    @endif

  </div>
</div>
