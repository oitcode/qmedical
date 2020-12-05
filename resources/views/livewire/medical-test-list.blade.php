<div class="card shadow-none">
  <div class="card-header">
    <h3 class="card-title">
      Recent Medical Tests
    </h3>
    <div class="card-tools">
    </div>
  </div>
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
      <thead>
        <tr class="">
          <th>Patient</th>
          <th>Type</th>
          <th>Status</th>
          <th>Payment</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        @foreach($medicalTests as $medicalTest)
        <tr>
          <td
            class="btn btn-link"
            wire:click.prevent="$emit('displayMedicalTest', {{ $medicalTest }})">
             <span class="w-100">
               {{ $medicalTest->patient->name }}
             </span>
          </td>
          <td>{{ $medicalTest->medicalTestType->name }}</td>
          <td>{{ $medicalTest->status }}</td>
          <td>
            @if ($medicalTest->payment_status === 'Paid')
              <span class="text-success">
                {{ $medicalTest->payment_status }}
              </span>
            @else
              <span class="text-danger">
                {{ $medicalTest->payment_status }}
              </span>
            @endif
          </td>
          <td>

            <a href="{{ route('medicalTestEdit', $medicalTest->medical_test_id) }}">
              <i class="fas fa-pencil-alt text-primary mr-3"></i>
            </a>

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
