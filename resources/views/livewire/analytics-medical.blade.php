<div>
  <!-- Search query row -->
  <div class="row">
    <!-- Start Date -->
    <div class="col-md-2">
      <div class="form-group">
          <label for="name">Start Date</label>
          <input type="text" class="form-control" id="" placeholder="Start Date" wire:model="startDate">
      </div>
    </div>
    <!-- /.Start Date -->

    <!-- End Date -->
    <div class="col-md-2">
      <div class="form-group">
          <label for="name">End Date</label>
          <input type="text" class="form-control" id="" placeholder="End Date" wire:model="endDate">
      </div>
    </div>
    <!-- /.End Date -->

    <!-- Medical Test Type -->
    <div class="col-md-2">
      <label for="">Test type</label>
      <select class="custom-select" wire:model="searchMedicalTestTypeId">
        <option>---</option>
        @foreach($medicalTestTypes as $medicalTestType)
          <option value="{{ $medicalTestType->medical_test_type_id }}">{{ $medicalTestType->name }}</option>
        @endforeach
      </select>
    </div>
    <!-- /.Medical Test Type -->

    <!-- Search button -->
    <div class="col-md-2">
      <div class="form-group">
          <br />
          <button class="btn btn-sm btn-primary" wire:click="search">
            Search
          </button>
      </div>
    </div>
    <!-- /.Search button -->
  </div>
  <!-- /.Search query row -->

  <hr />

  <div class="row">
    <!-- Results table column -->
    <div class="col-md-8">
      <div class="card card-primary card-outlin">
        <div class="card-body box-profile">
          <table class="table table-bordered table-sm table-striped">
            <thead>
              <tr class="bg-primary text-white">
                <th>Test Id</th>
                <th>Date</th>
                <th>Patient Name</th>
                <th>Test Type</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              @if ($medicalTests)
                @foreach ($medicalTests as $medicalTest)
                  <tr>
                    <td>
                      {{ $medicalTest->medical_test_id }}
                    </td>
                    <td>
                      {{ $medicalTest->date }}
                    </td>
                    <td>
                      {{ $medicalTest->patient->name }}
                    </td>
                    <td>
                      {{ $medicalTest->medicalTestType->name }}
                    </td>
                    <td>
                      {{ $medicalTest->price }}
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.Results table column -->

    <!-- Summary column -->
    <div class="col-md-4">
      <h3>Summary</h3>
      <!-- Summary card -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">

          <h3 class="profile-username text-center">Summary</h3>

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Total Tests</b>
              <span class="float-right">{{ $testCount }}</span>
            </li>
            <li class="list-group-item">
              <b>Amount received</b>
              <span class="float-right">{{ $totalEarning }}</span>
            </li>
          </ul>

          <a href="#" class="btn btn-primary btn-block"><b>Print</b></a>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.Summary card -->
    </div>
    <!-- /.Summary column -->
  </div>
</div>
