<div class="modal fade" id="agentDetailModal">
  <div class="modal-dialog mw-100 w-75">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agent Detail</h5>
      </div>




      <div class="modal-body">

        <div class="row">
          <div class="col-md-8">
            <h3 class="text-primary"><i class="fas fa-user mr-3"></i>{{ $agent->name}}</h3>
            <div class="text-left my-3">
              <a href="#" class="btn btn-sm btn-outline-primary">SMS Invoice</a>
            </div>
            <ul class="list-unstyled">
              <li>
                <a href="" class="btn-link text-secondary">
                  <i class="fas fa-map mr-3"></i>
                  {{ $agent->address}}
                </a>
              </li>
              <li>
                <a href="" class="btn-link text-secondary">
                  <i class="fas fa-envelope mr-3"></i>
                  {{ $agent->email }}
                </a>
              </li>
              <li>
                <a href="" class="btn-link text-secondary">
                  <i class="fas fa-phone mr-3"></i>
                  {{ $agent->contact_number }}
                </a>
              </li>
            </ul>

            <hr />

            <h3 class="h5">Recent</h3>
            <table class="table table-sm table-hover text-nowrap table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Date</th>
                  <th>Patient</th>
                  <th>Commission Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($agent->medicalTests as $medicalTest)
                  <tr>
                    <td>
                      {{ $medicalTest->medical_test_id }}
                    </td>
                    <td>
                      {{ $medicalTest->date }}
                    </td>
                    <td>
                      {{ $medicalTest->patient->name }}
                    </td>
                    <td>
                      {{ $medicalTest->agent_commission_status }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="col-md-4">
            <div class="table-responsive">
              <table class="table text-muted">
                <tr>
                  <th style="width:50%">Total referred</th>
                  <td>250</td>
                </tr>
                <tr>
                  <th>Commission Earned</th>
                  <td>$102343</td>
                </tr>
                <tr>
                  <th>Balance</th>
                  <td>$265</td>
                </tr>
                <tr>
                  <th>Last settlement</th>
                  <td>2020-10-10</td>
                </tr>
              </table>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        $('#agentDetailModal').modal('show');
    });

    window.livewire.on('show', () => {
        $('#agentDetailModal').modal('show');
    });

    window.livewire.on('oclose', () => {
        $('#agentDetailModal').modal('hide');
    });

    $('#agentDetailModal').on('hidden.bs.modal', function () {
        window.livewire.emit('destroyDisplay');
    });
</script>
