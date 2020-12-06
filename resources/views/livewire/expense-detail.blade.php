<div class="modal fade" id="expenseDetailModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Expense Detail</h5>
      </div>

      <div class="modal-body">

            <h3 class="h5 mb-3">
              {{ $expense->name }}
            </h3>
            <div class="table-responsive border-none">
              <table class="table text-muted">
                <tr>
                  <th style="width:50%">Total</th>
                  <td>250</td>
                </tr>
                <tr>
                  <th>Category</th>
                  <td>{{ $expense->expenseCategory->name }}</td>
                </tr>
                <tr>
                  <th>Comment</th>
                  <td>{{ $expense->comment }}</td>
                </tr>
              </table>
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
