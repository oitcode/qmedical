<div class="card shadow-none">
  <div class="card-body p-0">
    <div>
      @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
      @endif
    </div>

    @if (!is_null($medicalTests) && count($medicalTests) > 0)
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

              @can ('delete-models')
              <span class="btn btn-tool btn-sm" wire:click="$emit('confirmDeleteMedicalTest', {{ $medicalTest->medical_test_id }})">
                <i class="fas fa-trash text-danger"></i>
              </span>
              @endcan
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
  @if ($createMode)
    @livewire('medical-test-create-component')
  @endif
</div>
