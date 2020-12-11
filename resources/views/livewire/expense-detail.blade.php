<div class="modal fade" id="expenseDetailModal" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Expense Detail</h5>
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="modal-body">

        <h3 class="h5 mb-3">
          {{ $expense->name }}
        </h3>

        <div class="row">
          <div class="col-sm-4 bg-info text-light">
            Date
          </div>
          <div class="col-sm-8">
            {{ $expense->date }}
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4">
            Total
          </div>
          <div class="col-sm-8">
            {{ $expense->amount }}
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4">
            Category
          </div>
          <div class="col-sm-8">
            {{ $expense->expenseCategory->name }}
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4">
            Comment
          </div>
          <div class="col-sm-8">
            {{ $expense->comment }}
          </div>
        </div>


      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        $('#expenseDetailModal').modal('show');
    });

    window.livewire.on('show', () => {
        $('#expenseDetailModal').modal('show');
    });

    window.livewire.on('oclose', () => {
        $('#expenseDetailModal').modal('hide');
    });

    $('#expenseDetailModal').on('hidden.bs.modal', function () {
        window.livewire.emit('destroyDisplay');
    });
</script>
