<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Medical
    </h3>
    <div class="card-tools">
      <button class="btn btn-sm btn-outline-success px-3" wire:click="create">
        <i class="fas fa-plus"></i>
      </button>

      <button class="btn btn-sm btn-outline-success px-3" wire:click="">
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


  <div class="card-bpdy p-0">
    @if ($createMode)
      @livewire('medical-test-create-component')
    @endif
  
    @if ($displayMode)
      @livewire('medical-test-detail', ['medicalTest' => $displayedMedicalTest])
    @endif

    @if ($updateMode)
      @livewire('medical-test-update', ['medicalTest' => $updatingMedicalTest])
    @endif
  
    @livewire('medical-test-list')
  
    {{--
    @if ($editMode)
      @livewire('medical-test-edit')
    @endif
    --}}
  </div>

</div>
