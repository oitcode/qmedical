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

    @if ($deleteMode)
      <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="medicalTestDeleteConfirmModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Really Delete?</h5>
              <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                <i class="fas fa-times"></i>
              </button>
            </div>
      
            <div class="modal-body p-0">
              <div class="p-3">
                <p>
                  Do you really want to delete ?
                </p>
                <p>
                  Medical Test Id: {{ $deletingMedicalTest->medical_test_id }}
                </p>
              </div>
              <div class="mx-2 my-4">
                <button wire:click="deleteMedicalTest({{ $deletingMedicalTest->medical_test_id }})" class="btn btn-sm btn-danger mr-3">Delete</button>
                <button wire:click="exitDeleteMode" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
      
      
            </div>
          </div>
        </div>
      </div>
      
      <script>
          /* Show the modal on load */
          $(document).ready(function () {
             $('#medicalTestDeleteConfirmModal').modal('show');
          });
      
          // /* Toggle the modal.  */
          // window.livewire.on('toggleExpenseCategoryCreateModal', () => {
          //     $('#expenseCategoryCreateModal').modal('hide');
          // });
      
      
          // /* Destroy the modal on hide */
          // $('#expenseCategoryCreateModal').on('hidden.bs.modal', function () {
          //     window.livewire.emit('destroyExpenseCategoryCreate');
          //     console.log('Hiding');
          // });
      
      </script>


















    @endif
  </div>

</div>
