<div>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Actions
    </h3>
    <div class="card-tools">
      <i class="fas fa-plus mr-3 text-success" wire:click="create"></i>
      <button class="btn btn-outline bg-white text-green btn-success">
        <span class="text-success text-bold mr-3">Refresh</span>
      </button>
    </div>
  </div>
</div>

  @if ($createMode)
    @livewire('medical-test-create-component')
  @endif

  @if ($displayMode)
    @livewire('medical-test-detail', ['medicalTest' => $displayedMedicalTest])
  @endif

  @livewire('medical-test-list')

  {{--
  @if ($editMode)
    @livewire('medical-test-edit')
  @endif
  --}}

</div>
