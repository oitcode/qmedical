<div class="card">
  <div class="card-header border-transparent">
    <h3 class="card-title">Pending Tests</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table m-0">
        <thead>
        <tr>
          <th>Test ID</th>
          <th>Patient</th>
          <th>Test type</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          @foreach($pendingMedicalTests as $medicalTest)
            <tr>
              <td><a href="">{{ $medicalTest->medical_test_id }}</a></td>
              <td>{{ $medicalTest->patient->name }}</td>
              <td>{{ $medicalTest->medicalTestType->name }}</td>
              <td><span class="badge badge-warning">Pending</span></td>
              <td>
                <a href="{{ route('medicalTestEdit', $medicalTest->medical_test_id) }}">
                <button class="btn btn-primary btn-sm">Edit</button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.table-responsive -->
  </div>
  <!-- /.card-body -->
  <div class="card-footer clearfix">
    <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">New</a>
  </div>
  <!-- /.card-footer -->
</div>
<!-- /.card -->
