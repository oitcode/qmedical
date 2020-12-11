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
                <i class="fas fa-dollar-sign mr-3"></i>
                @livewire('agent-balance-display', ['agent' => $agent], key(rand() * $agent->agent_id))
              </a>
            </li>
          </ul>
        </div>


        <div class="m-2">
          <!-- Transaction button -->
          @if (!$agentTransactionMode)
            <button class="btn">
              <span wire:click="enterAgentTransactionMode" class="text-primary">
                New Transaction
              </span>
            </button>
          @else
            <span wire:click="exitAgentTransactionMode" class="btn btn-sm btn-success">
              Cancel Transaction
            </span>
          @endif
        </div>


        @if ($agentTransactionMode)
            @livewire('agent-transaction-create', ['agent' => $agent,], key(rand() * $agent->agent_id))
        @endif



        <!-- Recent transactions -->
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
          </>
        @endisset
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
