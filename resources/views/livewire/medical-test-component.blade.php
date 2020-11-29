<table class="table table-bordered mt-5">
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
      <td>
        <a href="">{{ $medicalTest->patient->name }}</a>
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
          <button class="btn btn-primary btn-sm">
            Edit
          </button>
        </a>
      <button {{-- wire:click="delete({{ $expense->expense_id }})" --}} class="btn btn-danger btn-sm">Delete</button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
