<div class="card card-light">
  <div class="card-header">
    <h3 class="card-title">
      User
    </h3>
    <div class="card-tools">
      <button class="btn btn-sm btn-outline-info px-3" wire:click="create">
        <i class="fas fa-plus"></i>
      </button>

      @if ($seeUserList)
        <button class="btn btn-sm text-info" wire:click="hideUserList">
          <i class="fas fa-power-off">
          </i>
        </button>
      @else
        <button class="btn btn-sm text-info" wire:click="showUserList">
          <i class="fas fa-ellipsis-h">
          </i>
        </button>
      @endif

    </div>
  </div>
  <div class="card-body p-0">
    @if ($createMode)
      @livewire('user-create')
    @endif

    @if ($seeUserList)
      @livewire('user-list')
    @endif
  </div>
</div>
