@if ($compDisplayMode === 'normal')
<div>
@else
<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="agentSettlementCreateModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Settlement</h5>
      </div>

      <div class="modal-body">
@endif

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
                  <input type="text" class="form-control" rows="3" wire:model.defer="comment" placeholder="Comment">
                  @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
        </form>
      @if ($compDisplayMode === 'normal')
      <button wire:click="store" class="btn btn-success">Save</button>
      <button wire:click="close" class="btn btn-success">Close X</button>
    </div>
      @else
    </div>
      <div class="modal-footer">
        <button wire:click="store" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif

<script>
    /* Show the modal on load */
    @if($compDisplayMode !== 'normal') 
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
    @else
    @endif

</script>
