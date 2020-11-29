<table class="table table-bordered mt-5">
  <thead>
    <tr class="bg-primary text-white">
      <th>No.</th>
      <th>Date</th>
      <th>Patient</th>
      <th>Type</th>
      <th>Status</th>
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
      <td>{{ $medicalTest->test_type }}</td>
      <td>{{ $medicalTest->status }}</td>
      <td>
      <button class="btn btn-primary btn-sm">
      <a href="{{ route('medicalTestEdit', $medicalTest->medical_test_id) }}">Edit</a></button>
      <button {{-- wire:click="delete({{ $expense->expense_id }})" --}} class="btn btn-danger btn-sm">Delete</button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
