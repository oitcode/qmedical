<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Expense
    </h3>
    <div class="card-tools">
      <span class="btn btn-tool btn-sm">
        <i class="fas fa-plus mr-3 text-success" wire:click="create"></i>
      <span>

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

    @livewire('expense-category')
  </div>
</div>
