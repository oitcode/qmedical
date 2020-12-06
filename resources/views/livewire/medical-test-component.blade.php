<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Medical
    </h3>
    <div class="card-tools">
      <a href="#" class="btn btn-tool btn-sm">
        <i class="fas fa-plus mr-3 text-success" wire:click="create"></i>
      </a>
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
