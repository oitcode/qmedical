<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="agentSettlementCreateModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Settlement</h5>
      </div>

      <div class="modal-body">
        <h3 class="h5">{{ $agent->name }}</h3>
        <form>
            <div class="form-group form-inline">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-calendar"></i>
                    </div>
                  </div>
                  <input type="text" class="form-control" id="" placeholder="Date" wire:model.defer="date">
                  @error('date') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group form-inline">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-comment mr-3"></i>
                    </div>
                  </div>
                  <textarea class="form-control" rows="3" wire:model.defer="comment" placeholder="Comment"></textarea>
                  @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
        </form>
      </div>

      <div class="modal-footer">
        <button wire:click="store" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    /* Show the modal on load */
    $(document).ready(function () {
       $('#agentSettlementCreateModal').modal('show');
    });


    /* Toggle the modal.  */
    window.livewire.on('toggleAgentSettlementCreateModal', () => {
        $('#agentSettlementCreateModal').modal('hide');
    });


   /* Destroy the modal on hide */
   $('#agentSettlementCreateModal').on('hidden.bs.modal', function () {
       window.livewire.emit('destroyAgentSettlementCreate');
   });

</script>
