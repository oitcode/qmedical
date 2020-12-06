<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Agent
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
    {{-- Show agent create modal if neccessary --}}
    @if($createMode)
      @livewire('agent-create')
    @endif

    {{-- Display agent details in a modal --}}
    @if ($displayMode)
      @livewire('agent-detail', ['agent' => $displayedAgent])
    @endif

    {{-- Update Modal --}}
    @if ($updateMode)
      @livewire('agent-update', ['agent' => $updatingAgent])
    @endif

    {{-- Show agent list --}}
    @livewire('agent-list')
  </div>
</div>
