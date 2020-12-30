<div class="card card-light">
  <div class="card-header">
    <h3 class="card-title">
      Agent
    </h3>
    <div class="card-tools">
      <button class="btn btn-sm btn-outline-info px-3" wire:click="create">
        <i class="fas fa-plus"></i>
      </button>

      @if ($seeAgentList)
        <button class="btn btn-sm text-info" wire:click="hideAgentList">
          <i class="fas fa-power-off">
          </i>
        </button>
      @else
        <button class="btn btn-sm text-info" wire:click="">
          <i class="fas fa-ellipsis-h">
          </i>
        </button>
      @endif

      <span class="">
          <input type="text" wire:model.defer="agentSearchName" wire:keydown.enter="search" class="">
          <button class="btn btn-sm text-info text-bold" wire:click="search">
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
