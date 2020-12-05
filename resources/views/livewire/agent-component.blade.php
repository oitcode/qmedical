<div>
  <!-- Tool box card -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">
        Actions
      </h3>
      <div class="card-tools">
        <i class="fas fa-plus mr-3 text-success" wire:click="create"></i>
      </div>
    </div>
  </div>
  <!-- /.Tool box card -->

  {{-- Show agent create modal if neccessary --}}
  @if($createMode)
    @livewire('agent-create')
  @endif

  {{-- Display agent details in a modal --}}
  @if ($displayMode)
    @livewire('agent-detail', ['agent' => $displayedAgent])
  @endif

  {{-- Show agent list --}}
  @livewire('agent-list')
</div>
