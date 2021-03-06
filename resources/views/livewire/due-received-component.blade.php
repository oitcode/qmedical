<div class="card">
  @if (false)
    <div class="card-header">
      <h3 class="card-title">
        Dues Received
      </h3>
      <div class="card-tools">
      </div>
    </div>
  @endif
  <div class="card-body p-0">
    <div class="row p-3">
      <div class="col-md-6 text-success">
        <strong>
          Dues Received
        </strong>
      </div>
      <div class="col-md-6">
        <strong>
          {{ $dueReceivedTotal }}
        </strong>
      </div>
    </div>
    @if (count($duesReceived) > 0)
    <div class="table-responsive">
      <table class="table">
        <thead>
        </thead>
        <tbody>
          @foreach ($duesReceived as $payment)
            <tr>
              <td>
                {{ $payment->medicalTest->medical_test_id }}
              </td>
              <td>
                {{ $payment->medicalTest->patient->name }}
              </td>
              <td>
                {{ $payment->medicalTest->date }}
              </td>
              <td>
                {{ $payment->amount }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @else
      <div class="text-info p-3">
        No dues received
      </div>
    @endif
    Date: {{ $searchDate }}
  </div>
</div>
