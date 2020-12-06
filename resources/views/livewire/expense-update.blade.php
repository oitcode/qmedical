<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="expenseUpdateModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Expense</h5>
      </div>

      <div class="modal-body">
        <form>
            <div class="form-group form-inline">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-calendar"></i>
                    </div>
                  </div>
                  <label for="date" class="sr-only">Date:</label>
                  <input type="text" class="form-control" id="" wire:model="date" placeholder="date">
                </div>
            </div>

            <div class="form-group form-inline">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      Category
                    </div>
                  </div>
                  <select class="custom-select" wire:model="expense_category_id">
                    <option>---</option>
                    @foreach($expenseCategories as $expenseCategory)
                      <option value="{{ $expenseCategory->expense_category_id }}">{{ $expenseCategory->name }}</option>
                    @endforeach
                  </select>
                </div>
            </div>

            <div class="form-group form-inline">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-envelope mr-3"></i>
                    </div>
                  </div>
                  <input type="text" class="form-control" id="" wire:model="name" placeholder="Name">
                  @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group form-inline">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-phone mr-3"></i>
                    </div>
                  </div>
                  <input type="text" class="form-control" id="" placeholder="Amount" wire:model="amount">
                  @error('amount') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group form-inline">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-comment mr-3"></i>
                    </div>
                  </div>
                  <input type="text" class="form-control" wire:model="comment" placeholder="Comment">
                  @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <button wire:click="update" class="btn btn-success">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>


      </div>
    </div>
  </div>
</div>

<script>
    /* Show the modal on load */
    $(document).ready(function () {
       $('#expenseUpdateModal').modal('show');
    });

    /* Toggle the modal.  */
    window.livewire.on('toggleExpenseUpdateModal', () => {
        $('#expenseUpdateModal').modal('hide');
    });


   /* Destroy the modal on hide */
   $('#expenseUpdateModal').on('hidden.bs.modal', function () {
       window.livewire.emit('destroyExpenseUpdate');
       console.log("Destroyin!!");
   });

</script>
