<div class="card card-light" wire:ignore.self
  @if($fullScreenTrue)
    style="
      position: fixed !important;
      top: 0 !important;
      left: 0 !important;
      bottom: 0 !important;
      right: 0 !important;
      width: 100% !important;
      z-index: 100000 !important;
    "
  @endif
  >
  <div class="card-header">
    <div class="card-title">
      <h2 class="h5">Office Pending</h2>
    </div>
    <div class="card-tools">
      @if (false)
        <button class="btn btn-sm btn-outline-success px-3" wire:click="">
          <i class="fas fa-plus"></i>
        </button>

        <button class="btn btn-sm text-danger" wire:click="">
          <i class="fas fa-power-off"></i>
        </button>
        <button class="btn btn-sm text-primary" wire:click="">
          <i class="fas fa-ellipsis-h"></i>
        </button>
      @endif

      @if (false)
      <button class="btn btn-light btn-sm border" wire:click.prevent="">
        <i class="fas fa-arrow-left"></i>
      </button>

      <button class="btn btn-light btn-sm border" wire:click.prevent="">
        <i class="fas fa-arrow-right"></i>
      </button>

      <span class="">
          <input type="text" wire:model.defer="" wire:keydown.enter="" class="">
          <button class="btn btn-sm text-success text-bold" wire:click="">
            Go
          </button>
      </span>
      @endif

      @if (false)
      <button type="button" class="btn btn-tool" wire:click="toggleFullScreen">
        <i class="fas fa-expand"></i>
      </button>
      @endif

      <button type="button" class="btn btn-tool" data-card-widget="maximize">
        <i class="fas fa-expand"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0">

    <div class="form-inline p-2">
      <div class="form-row">

        @if (false)
        <div class="col w-25">
          <input type="date" class="form-control mb-2 mr-sm-2" wire:model.defer="startDate">
        </div>

        <div class="col w-25">
          <input type="date" class="form-control mb-2 mr-sm-2" wire:model.defer="endDate">
        </div>
        @endif

        <div class="col w-25 m-0">
          <div class="input-group mb-0 mx-0" style="margin:0 !important; padding: 0 !important;">
            @if (false)
            <div class="input-group-prepend d-none">
              <div class="input-group-text">Test type</div>
            </div>
            @endif
            <select class="custom-select mx-0" wire:model.defer="medicalTestTypeId">
              <option value="0" selected>Choose...</option>
              @foreach ($medicalTestTypes as $medicalTestType)
                <option value="{{ $medicalTestType->medical_test_type_id }}">
                  {{ $medicalTestType->name }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col w-25 m-0">
          <div class="input-group mb-2 mx-0">
            @if (false)
            <div class="input-group-prepend d-none">
              <div class="input-group-text">Agent</div>
            </div>
            @endif
            <select class="custom-select" wire:model.defer="agentId">
              <option value="0" selected>Choose...</option>
              @foreach ($agents as $agent)
                <option value="{{ $agent->agent_id }}">
                  {{ $agent->name }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

      </div>
    
      <button type="submit" class="btn btn-sm btn-info mb-2 mx-2" wire:click="search">Go</button>
    </div>

    @if (false)
    <div class="row text-dark mx-0">
      <div class="col-sm-3">
        Count
      </div>
      <div class="col-sm-6">
        {{ $pendingCount }}
      </div>
    </div>
    @endif

    <div class="row text-dark border-bottom mx-0 p-3">
      <div class="col-sm-3">
        Total
      </div>
      <div class="col-sm-6">
        <strong>
          {{ $pendingAmountTotal }}
        </strong>
      </div>
    </div>

    @if (!empty($medicalTests) && count($medicalTests) > 0)
      <div class="table-responsive">
        <table class="table table-sm table-hover table-valign-middle">
          @if (true)
          <thead>
            <tr class="text-secondary">
              <th>Bill Date</th>
              <th>Id</th>
              <th>Patient</th>
              <th>Test Type</th>
              <th>Agent</th>
              <th>Payment Status</th>
              <th>Total Amount</th>
              <th>Due Amount</th>
            </tr>
          </thead>
          @endif

          <tbody>
            @foreach($medicalTests as $medicalTest)
            <tr>
              <td>
                   {{ $medicalTest->date }}
              </td>

              <td>
                   {{ $medicalTest->medical_test_id }}
              </td>

              <td>
                <a href="" wire:click.prevent="$emit('displayMedicalTest', {{ $medicalTest }})" class="text-dark">
                   {{ $medicalTest->patient->name }}
                </a>
              </td>
              <td>
                <span class="text-muted">
                  {{ $medicalTest->medicalTestType->name }}
                </span>
              </td>

              <td>
                @if ($medicalTest->agent)
                  {{ $medicalTest->agent->name }}
                @endif
              </td>

              <td>
                @if (strtolower($medicalTest->payment_status) === 'paid')
                  <span class="badge badge-success badge-pill">
                    P
                  </span>
                @elseif (strtolower($medicalTest->payment_status) === 'partially_paid')
                  <span class="badge badge-warning badge-pill">
                    Partial
                  </span>
                @else
                  <span class="badge badge-danger badge-pill">
                    {{ $medicalTest->payment_status }}
                  </span>
                @endif
              </td>

              @if (false)
              <td>
                @if ($medicalTest->status === 'Waiting')
                  <span class="badge badge-danger badge-pill">
                    W
                  </span>
                @elseif ($medicalTest->status === 'Completed')
                  <span class="badge badge-success badge-pill">
                    C
                  </span>
                @else
                  <span class="">
                    {{ $medicalTest->status }}
                  </span>
                @endif
              </td>
              @endif

              <td>
                {{ $medicalTest->getActualPrice() }}
              </td>

              <td>
                {{ $medicalTest->getPendingAmount() }}
              </td>

              <td>
                {{-- TODO --}}
                @if (false)
                <span class="btn btn-tool btn-sm">
                  <i class="fas fa-pencil-alt text-primary mr-3" wire:click="$emit('updateMedicalTest', {{ $medicalTest }})"></i>
                </span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    @else
      <div class="text-info p-2"> 
        No office pending
      </div>
    @endif

    <!-- Loans -->
    @if ($pendingAgentLoans != null && count($pendingAgentLoans) > 0)
      <div class="clearfix text-right px-3 pt-2 border-top bg-light">
        <div class="float-left">
          <h4 class="h6">Agent carryover</h4>
        </div>
        <div class="float-right">
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-sm table-hover text-nowrap">
          <thead>
            <tr class="text-muted">
              <th>Agent</th>
              <th>Payment Status</th>
              <th>Comment</th>
              <th>Total</th>
              <th>Due</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pendingAgentLoans as $agentLoan)
              <tr>
                <td>
                  {{ $agentLoan->agent->name }}
                </td>
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
                  <span class="text-dark">
                    {{ $agentLoan->getPendingAmount() }}
                  </span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      @if (false)
      <div class="p-2 text-info">
        No loans
      </div>
      @endif
    @endif
  </div>
</div>
