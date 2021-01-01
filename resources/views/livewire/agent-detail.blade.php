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


          @if (false)
          <a href="#" class="btn btn-tool btn-sm" wire:click.prevent="">
            <i class="fas fa-arrow-left"></i>
          </a>

          <a href="#" class="btn btn-tool btn-sm" wire:click.prevent="">
            <i class="fas fa-arrow-right"></i>
          </a>
          @endif

          @if (false)
          <span class="">
              <input type="text" wire:model.defer="" wire:keydown.enter="" class="">
              <button class="btn btn-sm text-success text-bold" wire:click="">
                Go
              </button>
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



        <!-- Recent transactions -->
        @if (false)
          <h3 class="h5 m-3">Transactions</h3>
          @if (count($agentTransactions))
            <div class="table-responsive text-muted">
              <table class="table table-sm table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>In</th>
                    <th>Out</th>
                    <th>Comment</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($agentTransactions as $agentTransaction)
                    @if($agentTransaction->medicalTest)
                    <tr>
                    @else
                    <tr class="">
                    @endif
                      <td>
                        {{ $agentTransaction->created_at->format('Y-d-m') }}
                      </td>
                      <td>
                        @if ($agentTransaction->direction === 'in')
                          <span class="text-success">
                            {{ $agentTransaction->amount }}
                          </span>
                        @endif
                      </td>
                      <td>
                        @if ($agentTransaction->direction === 'out')
                          <span class="text-danger">
                            {{ $agentTransaction->amount }}
                          </span>
                        @endif
                      </td>
                      <td>
                        {{ $agentTransaction->comment }}
                      </td>
                      <td>
                        @if ($agentTransaction->medicalTest)
                          {{ $agentTransaction->medicalTest->patient->name }}
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <p class="text-info m-3">
              No Transactions
            </p>
          @endif
        @endif

        @if ($viewOfficialPendingsFalg && false)
          <hr />
          <h3 class="h5 m-3">Official Pending</h3>
          @if (count($officialPendings) > 0)
            <div class="table-responsive">
              <table class="table table-sm table-hover text-nowrap">
                <thead>
                </thead>
                <tbody>
                  @foreach ($officialPendings as $medicalTest)
                    <tr>
                      <td>
                        {{ $loop->iteration }}
                      </td>
                      <td>
                        {{ $medicalTest->date }}
                      </td>
                      <td>
                        {{ $medicalTest->patient->name }}
                      </td>
                      <td>
                        <span class="badge badge-pill badge-danger">
                          {{ $medicalTest->payment_status }}
                        </span>
                      </td>
                      <td>

                        <!-- If partially paid -->
                        @if ($medicalTest->payments)
                          @php
                            $pendingAmount = $medicalTest->price;
                          @endphp
                          @foreach ($medicalTest->payments as $payment)
                            @php
                              $pendingAmount -= $payment->amount;
                            @endphp
                          @endforeach
                          @php
                            $pendingAmount -= $medicalTest->agent_commission;
                          @endphp

                          {{ $pendingAmount }}
                        @else
                          {{ $medicalTest->price - $medicalTest->agent_commission }}
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="text-info p-3">
              No official pending
            </div>
          @endif
        @endif


        <!-- Pending bills (medical_tests) -->
        <div class="clearfix text-right px-3 pt-2 border-top bg-light">
          <div class="float-left">
            <h4 class="h6">Medical Tests</h4>
          </div>
          <div class="float-right">
            @if ($showOnlyPending === false)
              <button class="btn btn-sm text-danger" wire:click="viewOnlyPendingMedicalTests">
                <i class="fas fa-exclamation-circle"></i>
                  Only Pending
              </button>
            @else
              <button class="btn btn-sm text-info" wire:click="viewAllMedicalTests">
                <i class="fas fa-ellipsis-h mr-2"></i>
                  View All
              </button>
            @endif
          </div>
        </div>

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
              @if ($showOnlyPending)
                @php
                  $tests = $agentPendingMedicalTests;
                @endphp
              @else
                @php
                  $tests = $agentMedicalTests;
                @endphp
              @endif

              @foreach ($tests as $medicalTest)
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


        <!-- Loans -->
        @if ($agentLoans !== null && count($agentLoans) > 0)
          <div class="clearfix text-right px-3 pt-2 border-top bg-light">
            <div class="float-left">
              <h4 class="h6">Opening Remaining</h4>
            </div>
            <div class="float-right">
            </div>
          </div>

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
          {{-- TODO --}}
          @if (false)
          <div class="p-2 text-info">
            No loans
          </div>
          @endif
        @endif



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
    });
</script>
