<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Expense
    </h3>
    <div class="card-tools">
      <button class="btn btn-sm btn-outline-success px-3" wire:click="create">
        <i class="fas fa-plus"></i>
      </button>

      <button class="btn btn-sm btn-outline-success px-3" wire:click="enterCreateCategoryMode">
        <i class="fas fa-folder-plus"></i>
      </button>

      <a href="#" class="btn btn-tool btn-sm">
        <i class="fas fa-download"></i>
      </a>

      <a href="#" class="btn btn-tool btn-sm">
        <i class="fas fa-bars"></i>
      </a>

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

    @can ('view-expense-category-component')
      @livewire('expense-category')
    @endcan
  </div>
</div>
