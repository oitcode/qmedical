<div class="card shadow-none">
  <div class="card-body p-0">

    @if (!is_null($medicalTests) && count($medicalTests) > 0)
      <table class="table table-sm  table-hover table-valign-middle">
        @if (true)
        <thead>
          <tr class="text-secondary">
            <th>ID</th>
            <th>Date</th>
            <th>Patient</th>
            <th>Test Type</th>
            <th>Agent</th>
            <th>Payment</th>
            <th>Result</th>
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
                 {{ $medicalTest->date }}
            </td>
            <td>
              <a href="" wire:click.prevent="$emit('displayMedicalTest', {{ $medicalTest }})" class="text-dark">
                 {{ $medicalTest->patient->name }}
              </a>
            </td>

            <td>
              <span class="text-muted ml-3 font-sm">
                {{ $medicalTest->medicalTestType->name }}
              </span>
            </td>

            <td>
              @if ($medicalTest->agent)
                <small class="text-muted">
                  {{ $medicalTest->agent->name }}
                </small>
              @else
                <span class="text-muted">
                  <small>
                    N/A
                  </small>
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
              @if (false)
              <span class="btn btn-tool btn-sm" wire:click="">
                <a href="{{ route('medicalformprint', $medicalTest->medical_test_id) }}" target="_blank">
                  <i class="fas fa-print text-info"></i>
                </a>
              </span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="px-3 mt-2 text-muted">
        <small>
          No records to display.
        </small>
      </div>
    @endif
  </div>
  @if ($createMode)
    @livewire('medical-test-create-component')
  @endif
</div>
