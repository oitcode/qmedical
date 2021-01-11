@if ($compDisplayMode === 'normal')
<div>
@else
<div wire:ignore.self class="modal fade" id="agentDetailModal" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agent Detail</h5>


        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
          <i class="fas fa-times"></i>
        </button>

      </div>




      <div class="modal-body p-0">
@endif
        <div class="text-right m-2">
          @if (!$agentTransactionMode)
            <button class="btn">
              <span wire:click="enterAgentTransactionMode" class="text-primary">
                <i class="fas fa-plus"></i>
                New Transaction
              </span>
            </button>
          @else
            <span wire:click="exitAgentTransactionMode" class="btn btn-sm btn-success">
              Cancel Transaction
            </span>
          @endif

        </div>



        <div class="m-2">
          <h3 class="text-secondary"><i class="fas fa-user mr-3"></i>{{ $agent->name}}</h3>
          <ul class="list-unstyled">
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
            <li>
              <a href="" class="btn-link text-secondary">
                <i class="fas fa-rupee-sign mr-3"></i>
                @livewire('agent-balance-display', ['agent' => $agent], key(rand() * $agent->agent_id))
              </a>
            </li>
          </ul>
        </div>

        @if ($agentTransactionMode)
            @livewire('agent-transaction-create', ['agent' => $agent,], key(rand() * $agent->agent_id))
        @endif


        <!-- All medical tests -->
        <hr />
        <div class="p-2">
          <h2 class="h6">Medical Tests</h2>
          @if (!is_null($medicalTests) && count($medicalTests) > 0)
            <div class="table-responsive">
              <table class="table table-sm table-hover text-nowrap">
                <thead>
                  <tr class="text-muted">
                    <th>Id</th>
                    <th>Date</th>
                    <th>Patient</th>
                    <th>Payment Status</th>
                    <th>Total</th>
                    <th>Due</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($medicalTests as $medicalTest)
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
                        @if ($medicalTest->payment_status === 'paid')
                          <span class="badge badge-pill badge-success">
                            {{ $medicalTest->payment_status }}
                          </span>
                        @else
                          <span class="badge badge-pill badge-danger">
                            {{ $medicalTest->payment_status }}
                          </span>
                        @endif
                      </td>

                      <td>
                        {{ $medicalTest->getActualPrice() }}
                      </td>

                      <td>
                        @if ($medicalTest->getPendingAmount() > 0)
                          <span class="text-danger">
                            {{ $medicalTest->getPendingAmount() }}
                          </span>
                        @else
                          {{ $medicalTest->getPendingAmount() }}
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <small class="text-muted">
              No records to display
            </small>
          @endif
        </div>

        <!-- Pending bills (medical_tests) -->
        <hr />
        <div class="p-2">
          <h2 class="h6">Pending Bills</h2>

          @if (count($agentPendingMedicalTests) > 0)
            <div class="table-responsive">
              <table class="table table-sm table-hover text-nowrap">
                <thead>
                  <tr class="text-muted">
                    <th>Id</th>
                    <th>Date</th>
                    <th>Patient</th>
                    <th>Payment Status</th>
                    <th>Total</th>
                    <th>Due</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($agentPendingMedicalTests as $medicalTest)
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
                        @if ($medicalTest->payment_status === 'paid')
                          <span class="badge badge-pill badge-success">
                            {{ $medicalTest->payment_status }}
                          </span>
                        @else
                          <span class="badge badge-pill badge-danger">
                            {{ $medicalTest->payment_status }}
                          </span>
                        @endif
                      </td>

                      <td>
                        {{ $medicalTest->getActualPrice() }}
                      </td>

                      <td>
                        @if ($medicalTest->getPendingAmount() > 0)
                          <span class="text-danger">
                            {{ $medicalTest->getPendingAmount() }}
                          </span>
                        @else
                          {{ $medicalTest->getPendingAmount() }}
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <small class="text-muted">
              No records to display
            </small>
          @endif
        </div>



        <!-- Loans -->
        <hr />
        <div class="p-2">
          <h2 class="h6">Loan</h2>
          @if ($agentLoans !== null && count($agentLoans) > 0)
            <div class="table-responsive">
              <table class="table table-sm table-hover text-nowrap">
                <thead>
                  <tr class="text-muted">
                    <th>Payment Status</th>
                    <th>Comment</th>
                    <th>Total</th>
                    <th>Due</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($agentLoans as $agentLoan)
                    <tr>
                      <td>
                        @if ($agentLoan->payment_status === 'paid')
                          <span class="badge badge-pill badge-success">
                            {{ $agentLoan->payment_status }}
                          </span>
                        @elseif ($agentLoan->payment_status === 'partially_paid')
                          <span class="badge badge-pill badge-warning">
                            {{ $agentLoan->payment_status }}
                          </span>
                        @elseif ($agentLoan->payment_status === 'pending')
                          <span class="badge badge-pill badge-danger">
                            {{ $agentLoan->payment_status }}
                          </span>
                        @else
                          {{-- TODO: is this needeed? --}}
                        @endif
                      </td>
                      <td>
                        {{ $agentLoan->comment }}
                      </td>
                      <td>
                        {{ $agentLoan->amount }}
                      </td>
                      <td>
                        <span class="text-danger">
                          {{ $agentLoan->getPendingAmount() }}
                        </span>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            @if (true)
            <div class="p-2 text-info">
              <small>
                No loans
              </small>
            </div>
            @endif
          @endif
        </div>

        <!-- Deposit -->
        <hr />
        <div class="p-2">
          <h2 class="h6">Deposit</h2>
          @if (!is_null($deposits) && count($deposits) > 0)
            <div class="table-responsive">
              <table class="table table-sm table-hover">
                <thead>
                  <tr class="text-muted">
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($deposits as $deposit)
                    <tr>
                      <td>
                        {{ $deposit->date }}
                      </td>
                      <td>
                        {{ $deposit->amount }}
                      </td>
                      <td>
                        <span class="btn btn-tool btn-sm" wire:click="">
                          <i class="fas fa-pencil-alt text-primary mr-3"></i>
                        </span>
                        @can ('delete-models')
                          <span class="btn btn-tool btn-sm">
                            <i class="fas fa-trash text-danger mr-3" wire:click=""></i>
                          </span>
                        @endcan
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <small class="text-muted">
              No deposits
            </small>
          @endif
        </div>

        <!-- Withdrawl -->
        <hr />
        <div class="p-2">
          <h2 class="h6">Withdrawl</h2>
          @if (!is_null($withdrawls) && count($withdrawls) > 0)
            <div class="table-responsive">
              <table class="table table-sm table-hover">
                <thead>
                  <tr class="text-muted">
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($withdrawls as $withdrawl)
                    <tr>
                      <td>
                        {{ $withdrawl->date }}
                      </td>
                      <td>
                        {{ $withdrawl->amount }}
                      </td>
                      <td>
                        <span class="btn btn-tool btn-sm" wire:click="">
                          <i class="fas fa-pencil-alt text-primary mr-3"></i>
                        </span>
                        @can ('delete-models')
                          <span class="btn btn-tool btn-sm">
                            <i class="fas fa-trash text-danger mr-3" wire:click=""></i>
                          </span>
                        @endcan
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <small class="text-muted">
              No withdrawls
            </small>
          @endif
        </div>



      @if ($compDisplayMode === 'normal')
      </div>
      @else
      </div>
    </div>
  </div>
</div>
@endif

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
        window.livewire.emit('destroyAgentDisplay');
    });
</script>
