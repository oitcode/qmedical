<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Medical
    </h3>
    <div class="card-tools">
      <button class="btn btn-sm btn-outline-success px-3" wire:click="create">
        <i class="fas fa-plus"></i>
      </button>

      @can ('create-medical-test-type')
        <button class="btn btn-sm btn-outline-success px-3" wire:click="enterMedicalTestTypeCreateMode">
          <i class="fas fa-folder-plus"></i>
        </button>
      @endcan

      <span class="">
          <input type="text" wire:model.defer="patientSearchName" wire:keydown.enter="search" class="">
          <button class="btn btn-sm text-success text-bold" wire:click="search">
            Go
          </button>
      </span>
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

    @if ($medicalTestTypeCreateMode)
      @livewire('medical-test-type-component')
    @endif
  
    @livewire('medical-test-list')
  
    {{--
    @if ($editMode)
      @livewire('medical-test-edit')
    @endif
    --}}
  </div>

</div>
