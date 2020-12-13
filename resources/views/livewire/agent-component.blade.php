<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Agent
    </h3>
    <div class="card-tools">
      <button class="btn btn-sm btn-outline-success px-3" wire:click="create">
        <i class="fas fa-plus"></i>
      </button>

      @if ($seeAgentList)
        <button class="btn btn-sm text-danger" wire:click="hideAgentList">
          <i class="fas fa-power-off">
          </i>
        </button>
      @else
        <button class="btn btn-sm text-primary" wire:click="">
          <i class="fas fa-ellipsis-h">
          </i>
        </button>
      @endif

      <a href="#" class="btn btn-tool btn-sm">
        <i class="fas fa-download"></i>
      </a>

      <a href="#" class="btn btn-tool btn-sm">
        <i class="fas fa-bars"></i>
      </a>
      <span class="">
          <input type="text" wire:model.defer="agentSearchName" class="">
          <button class="btn btn-sm text-success text-bold" wire:click="search">
            Go
          </button>
      </span>
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

    {{-- Settlement Create Modal --}}
    @if ($settlementMode)
      @livewire('agent-settlement-create', ['agent' => $settlingAgent])
    @endif

    @if ($seeAgentList)
      {{-- Show agent list --}}
      @livewire('agent-list')
    @endif
  </div>
</div>
