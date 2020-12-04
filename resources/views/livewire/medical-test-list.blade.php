<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Expense list
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
    <table class="table table-hover">
      <thead>
        <tr class="bg-primary text-white">
          <th>No.</th>
          <th>Date</th>
          <th>Patient</th>
          <th>Type</th>
          <th>Status</th>
          <th>Price</th>
          <th>Payment</th>
          <th>Agent Commission</th>
          <th>Agent Commission Status</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        @foreach($medicalTests as $medicalTest)
        <tr>
          <td>{{ $medicalTest->medical_test_id }}</td>
          <td>{{ $medicalTest->date }}</td>
          <td wire:click.prevent="$emit('displayMedicalTest', {{ $medicalTest }})">
             {{ $medicalTest->patient->name }}
            </a>
          </td>
          <td>{{ $medicalTest->medicalTestType->name }}</td>
          <td>{{ $medicalTest->status }}</td>
          <td>{{ $medicalTest->price }}</td>
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
          <td>{{ $medicalTest->agent_commission }}</td>
          <td>
            @if ($medicalTest->agent_commission_status === 'Paid')
              <span class="text-success">
                {{ $medicalTest->agent_commission_status }}
              </span>
            @else
              <span class="text-danger">
                {{ $medicalTest->agent_commission_status }}
              </span>
            @endif
          </td>
          <td>

            <a href="{{ route('medicalTestEdit', $medicalTest->medical_test_id) }}">
              <i class="fas fa-pencil-alt text-primary mr-3"></i>
            </a>
              <i class="fas fa-trash text-danger mr-3"></i>
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
