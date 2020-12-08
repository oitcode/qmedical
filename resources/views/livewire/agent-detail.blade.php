<div wire:ignore.self class="modal fade" id="agentDetailModal" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agent Detail</h5>
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
          <i class="fas fa-times"></i>
        </button>
      </div>




      <div class="modal-body">
        <h3 class="text-secondary"><i class="fas fa-user mr-3"></i>{{ $agent->name}}</h3>
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



        <div>
          @if (!$viewPrevious)
            <span wire:click="showViewPrevious" class="btn btn-sm btn-primary">
              View Older
            </span>
          @else
            <span wire:click="hideViewPrevious" class="btn btn-sm btn-primary">
              Close Older
            </span>
          @endif
        </div>






        @if ($viewPrevious)
          @if (count($allMedicalTests))

          @php
            $netSummary = 0; 
          @endphp
          <div class="table-responsive text-muted">
            <table class="table table-sm table-hover text-nowrap">
              <thead>
                <tr>
                  <th>Patient</th>
                  <th>Amount</th>
                  <th>Commission</th>
                  <th>Net</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($allMedicalTests as $medicalTest)
                  <tr>
                    <td>
                      {{ $medicalTest->patient->name }}
                    </td>
                    <td>
                      {{ $medicalTest->price }}
                      @if ($medicalTest->payment_status === 'Pending')
                        <span class="badge badge-pill badge-primary ml-3">
                          A
                        </span>
                      @endif
                    </td>
                    <td>
                      {{ $medicalTest->agent_commission }}
                    </td>
                    <td>
                      @php
                          $net = 0;
                          if ($medicalTest->payment_status === 'Pending') {
                              $net = $medicalTest->agent_commission - $medicalTest->price;
                          } else {
                              $net = $medicalTest->agent_commission;
                          }

                          $netSummary += $net;
                      @endphp
                      @if ($net > 0)
                        <span class="text-success">
                          + {{ $net }}
                        </span>
                      @elseif ($net < 0)
                        <span class="text-danger">
                          {{ $net }}
                        </span>
                      @else
                        0
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>Total</th>
                  <td>
                    @if ($netSummary > 0)
                      <span class="text-success">
                        + {{ $netSummary }}
                      </span>
                    @elseif ($netSummary < 0)
                      <span class="text-danger">
                        {{ $netSummary }}
                      </span>
                    @else
                      0
                    @endif
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
          @else
            <p class="text-info">
              No medical tests
            </p>
          @endif

        @endif





        <h3 class="h5">Recent</h3>

        @if (count($recentMedicalTests))

        @php
          $netSummary = 0; 
        @endphp
        <div class="table-responsive text-muted">
          <table class="table table-sm table-hover text-nowrap">
            <thead>
              <tr>
                <th>Patient</th>
                <th>Amount</th>
                <th>Commission</th>
                <th>Net</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($recentMedicalTests as $medicalTest)
                <tr>
                  <td>
                    {{ $medicalTest->patient->name }}
                  </td>
                  <td>
                    {{ $medicalTest->price }}
                    @if ($medicalTest->payment_status === 'Pending')
                      <span class="badge badge-pill badge-primary ml-3">
                        A
                      </span>
                    @endif
                  </td>
                  <td>
                    {{ $medicalTest->agent_commission }}
                  </td>
                  <td>
                    @php
                        $net = 0;
                        if ($medicalTest->payment_status === 'Pending') {
                            $net = $medicalTest->agent_commission - $medicalTest->price;
                        } else {
                            $net = $medicalTest->agent_commission;
                        }

                        $netSummary += $net;
                    @endphp
                    @if ($net > 0)
                      <span class="text-success">
                        + {{ $net }}
                      </span>
                    @elseif ($net < 0)
                      <span class="text-danger">
                        {{ $net }}
                      </span>
                    @else
                      0
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Total</th>
                <td>
                  @if ($netSummary > 0)
                    <span class="text-success">
                      + {{ $netSummary }}
                    </span>
                  @elseif ($netSummary < 0)
                    <span class="text-danger">
                      {{ $netSummary }}
                    </span>
                  @else
                    0
                  @endif
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
        @else
          <p class="text-info">
            No recent medical tests
          </p>
        @endif

        @if (false)
        <div class="table-responsive">
          <table class="table table-sm text-muted">
            <tr>
              <th>Last settlement</th>
              <td>
                {{ $latestSettlementDate }}</td>
            </tr>
            <tr>
              <th>Commission</th>
              <td>{{ $amountToPay }}</td>
            </tr>
            <tr>
              <th>Payment</th>
              <td>{{ $amountToReceive }}</td>
            </tr>
            <tr>
              <th>Net</th>
              <td>
                {{ $netBalance['action'] }}
                {{ $netBalance['amount'] }}
              </td>
            </tr>
          </table>
        </div>
        @endif




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
