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
            <a href="" wire:click.prevent="$emit('displayMedicalTest', {{ $medicalTest }})" class="text-dark">
               {{ $medicalTest->patient->name }}
            </a>
            <span class="text-muted ml-3 font-sm">
              {{ $medicalTest->medicalTestType->name }}
            </span>
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
            <span class="btn btn-tool btn-sm">
              <i class="fas fa-pencil-alt text-primary mr-3" wire:click="$emit('updateMedicalTest', {{ $medicalTest }})"></i>
            </span>

            <i class="fas fa-trash text-danger mr-3" wire:click="$emit('deleteMedicalTest', {{ $medicalTest->medical_test_id }})"></i>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @if ($createMode)
    @livewire('medical-test-create-component')
  @endif
</div>
