<div class="card">
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

      <button class="btn btn-light btn-sm border" wire:click.prevent="">
        <i class="fas fa-arrow-left"></i>
      </button>

      <button class="btn btn-light btn-sm border" wire:click.prevent="">
        <i class="fas fa-arrow-right"></i>
      </button>

      @if (false)
      <span class="">
          <input type="text" wire:model.defer="" wire:keydown.enter="" class="">
          <button class="btn btn-sm text-success text-bold" wire:click="">
            Go
          </button>
      </span>
      @endif

      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body">

    <div class="form-inline">
      <input type="date" class="form-control mb-2 mr-sm-2" wire:model.defer="startDate">
      <input type="date" class="form-control mb-2 mr-sm-2" wire:model.defer="endDate">
    
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text">Test type</div>
        </div>
        <select class="custom-select" wire:model.defer="medicalTestTypeId">
          <option selected>Choose...</option>
          @foreach ($medicalTestTypes as $medicalTestType)
            <option value="{{ $medicalTestType->medical_test_type_id }}">
              {{ $medicalTestType->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text">Agent</div>
        </div>
        <select class="custom-select" wire:model.defer="agentId">
          <option selected>Choose...</option>
          @foreach ($agents as $agent)
            <option value="{{ $agent->agent_id }}">
              {{ $agent->name }}
            </option>
          @endforeach
        </select>
      </div>
    
      <button type="submit" class="btn btn-sm btn-primary mb-2" wire:click="search">Go</button>
    </div>

    @if (!empty($medicalTests) && count($medicalTests) > 0)
      <div class="table-responsive">
        <table class="table table-striped table-hover table-valign-middle">
          @if (false)
          <thead>
            <tr class="text-secondary">
              <th>Patient</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          @endif

          <tbody>
            @foreach($medicalTests as $medicalTest)
            <tr>
              <td>
                   {{ $medicalTest->medical_test_id }}
              </td>
              <td>
                <a href="" wire:click.prevent="$emit('displayMedicalTest', {{ $medicalTest }})" class="text-dark">
                   {{ $medicalTest->patient->name }}
                </a>
                <span class="text-muted ml-3 font-sm">
                  {{ $medicalTest->medicalTestType->name }}
                </span>
              </td>

              <td>
                @if ($medicalTest->agent)
                  <span class="badge badge-info badge-pill">
                    A
                  </span>
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
      <div class="text-info"> 
        No office pending
      </div>
    @endif
  </div>
</div>
