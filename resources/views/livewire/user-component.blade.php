<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      User
    </h3>
    <div class="card-tools">
      <button class="btn btn-sm btn-outline-success px-3" wire:click="create">
        <i class="fas fa-plus"></i>
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
    @if ($createMode)
      @livewire('user-create')
    @endif

    @livewire('user-list')
  </div>
</div>
