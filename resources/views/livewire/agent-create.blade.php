<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="agentCreateModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Agent</h5>
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="modal-body p-0">
        <form>
            <div class="form-group form-inline m-0">
                <div class="input-group w-100">
                  <div class="input-group-prepend w-25">
                    <div class="input-group-text w-100">
                      <i class="fas fa-user mr-3"></i>
                    </div>
                  </div>
                  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Name" wire:model.defer="name">
                  @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group form-inline m-0">
                <div class="input-group w-100">
                  <div class="input-group-prepend w-25">
                    <div class="input-group-text w-100">
                      <i class="fas fa-dollar-sign mr-3"></i>
                    </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Balance" wire:model.defer="balance">
                  @error('balance') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- TODO --}}
            @if (false)
            <div class="form-group form-inline m-0">
                <div class="input-group w-100">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      Sex
                    </div>
                  </div>
                  <select wire:model.defer="sex" class="custom-select">
                    <option>---</option>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                  </select>
                  @error('sex') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            @endif

            <div class="form-group form-inline m-0">
                <div class="input-group w-100">
                  <div class="input-group-prepend w-25">
                    <div class="input-group-text w-100">
                      <i class="fas fa-envelope mr-3"></i>
                    </div>
                  </div>
                  <input type="email" class="form-control" id="email" wire:model.defer="email" placeholder="Email">
                  @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group form-inline m-0">
                <div class="input-group w-100">
                  <div class="input-group-prepend w-25">
                    <div class="input-group-text w-100">
                      <i class="fas fa-phone mr-3"></i>
                    </div>
                  </div>
                  <input type="text" class="form-control" id="" wire:model.defer="contact_number" placeholder="Contact number">
                  @error('contact_number') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group form-inline m-0">
                <div class="input-group w-100">
                  <div class="input-group-prepend w-25">
                    <div class="input-group-text w-100">
                      <i class="fas fa-comment mr-3"></i>
                    </div>
                  </div>
                  <input type="text" class="form-control" rows="3" wire:model.defer="comment" placeholder="Comment">
                  @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
        </form>

        <div class="mx-2 my-4">
          <button wire:click="store" class="btn btn-sm btn-success mr-3">Save</button>
          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        </div>




      </div>
    </div>
  </div>
</div>

<script>
    /* Show the modal on load */
    $(document).ready(function () {
       $('#agentCreateModal').modal('show');
    });


    /* Toggle the modal.  */
    window.livewire.on('toggleAgentCreateModal', () => {
        $('#agentCreateModal').modal('hide');
    });


   /* Destroy the modal on hide */
   $('#agentCreateModal').on('hidden.bs.modal', function () {
       window.livewire.emit('destroyAgentCreate');
   });

</script>
