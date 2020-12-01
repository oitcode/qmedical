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
    <!-- Expense column -->
    <div class="col-md-4">
      <div class="card card-danger card-outlin">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
            Expense
          </h3>
        </div>
        <div class="card-body box-profile p-0">
          <table class="table table-bordered table-sm table-striped">
            <thead>
              <tr class="bg-primary text-white">
                <th>Expense ID</th>
                <th>Date</th>
                <th>Category</th>
                <th>Title</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              @if ($expenses)
                @foreach ($expenses as $expense)
                  <tr>
                    <td>{{ $expense->expense_id }}</td>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->expenseCategory->name }}</td>
                    <td>{{ $expense->name }}</td>
                    <td>{{ $expense->amount }}</td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.Expense column -->

    <!-- Revenue column -->
    <div class="col-md-4">
      <div class="card card-success card-outlin">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
            Revenue
          </h3>
        </div>
        <div class="card-body box-profile p-0">
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
                    <td>{{ $medicalTest->medical_test_id }}</td>
                    <td>{{ $medicalTest->date }}</td>
                    <td>{{ $medicalTest->patient->name }}</td>
                    <td>{{ $medicalTest->medicalTestType->name }}</td>
                    <td>{{ $medicalTest->price }}</td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.Revenue column -->

    <!-- Summary column -->
    <div class="col-md-4">
      <!-- Summary card -->
      <div class="card card-primary card-outlin">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
            Summary
          </h3>
        </div>
        <div class="card-body box-profile">
          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Total Expense</b>
              <span class="float-right">{{ $totalExpense }}</span>
            </li>
            <li class="list-group-item">
              <b>Total Revenue</b>
              <span class="float-right">{{ $totalRevenue }}</span>
            </li>
            @if ($finalResult)
              <li class="list-group-item">
                <b>{{ $finalResult['name'] }}</b>
                <span class="float-right">{{ $finalResult['value'] }}</span>
              </li>
            @endif
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.Summary card -->
    </div>
    <!-- /.Summary column -->
  </div>

  <!-- Second row -->
  <div class="row">
    <!-- Expense column -->
    <div class="col-md-4">
      <div class="card card-danger card-outlin">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
            Expense by Category
          </h3>
        </div>
        <div class="card-body box-profile p-0">
          <table class="table table-bordered table-sm table-striped">
            <thead>
              <tr class="bg-primary text-white">
                <th>Category</th>
                <th>Expense</th>
              </tr>
            </thead>
            <tbody>
              @if ($expenseByCategories)
                @foreach ($expenseByCategories as $key => $value)
                  <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $value }}</td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.Expense column -->

    <!-- Revenue column -->
    <div class="col-md-4">
      <div class="card card-success card-outlin">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
            Revenue by Category
          </h3>
        </div>
        <div class="card-body box-profile p-0">
          <table class="table table-bordered table-sm table-striped">
            <thead>
              <tr class="bg-primary text-white">
                <th>Test Type</th>
                <th>Revenue</th>
              </tr>
            </thead>
            <tbody>
              @if ($revenueByCategories)
                @foreach ($revenueByCategories as $key => $value)
                  <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $value }}</td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.Revenue column -->
  </div>
  <!-- /.Second row -->

</div>
