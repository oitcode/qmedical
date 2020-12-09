<div class="modal fade" id="detailModal" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Medical Test Detail</h5>
        <button type="button" class="btn btn-danger" data-dismiss="modal">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">

        <!-- Patient Detail -->
        <div class="mb-3">
          <h2 class="lead mb-4"><b>{{ $medicalTest->patient->name }}</b></h2>
          <ul class="ml-4 mb-0 fa-ul text-muted">
            <li class="small">
              <i class="fas fa-lg fa-building mr-3 mb-3"></i>
              Address: Demo Street 123, Demo City 04312, NJ
            </li>
            <li class="small">
              <i class="fas fa-lg fa-phone mr-3 mb-3"></i>
              9851000000
            </li>
          </ul>
          {{-- Dont need this for now
          <div class="card-footer">
            <div class="text-right">
              <a href="#" class="btn btn-sm bg-teal">
                <i class="fas fa-comments"></i>
              </a>
              <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-user"></i> View Profile
              </a>
            </div>
          </div>
          --}}
        </div>
        <!-- /.Patient Detail -->

        <!-- Test Detail -->
        <p>
          <span class="text-bold mr-3"> Test Type</span>
          Foreign Medical
        </p>
        <p>
          <span class="text-bold mr-3"> Result</span>
          Fit
        </p>
        <!-- /.Test Detail -->

        <h3 class="h5 mt-4">Billing</h3>
        <div class="table-responsive">
          <table class="table table-sm text-muted text-sm">
            <tr>
              <th style="width:50%">Charge</th>
              <td>{{ $medicalTest->price }}</td>
            </tr>
            <tr>
              <th>Agent</th>
              <td>{{ $medicalTest->agent_commission}}</td>
            </tr>
            <tr>
              <th>Total</th>
              <td>{{ $medicalTest->price - $medicalTest->agent_commission}}</td>
            </tr>
          </table>
        </div>
        <div class="text-left">
          <a href="#" class="btn btn-sm btn-primary">SMS Invoice</a>
          <a href="#" class="btn btn-sm btn-warning">Report</a>
        </div>













      </div>
    </div>
  </div>
</div>






<script>
    $(document).ready(function () {
        //window.livewire.emit('show');
        $('#detailModal').modal('show');
    });

    window.livewire.on('show', () => {
        $('#detailModal').modal('show');
    });

    window.livewire.on('oclose', () => {
        $('#detailModal').modal('hide');
    });

    $('#detailModal').on('hidden.bs.modal', function () {
        window.livewire.emit('destroyDisplay');
    });
</script>
