<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Dues Received
    </h3>
    <div class="card-tools">
    </div>
  </div>
  <div class="card-body p-0">
    @if (count($duesReceived) > 0)
    <div class="table-responsive">
      <table class="table">
        <thead>
        </thead>
        <tbody>
          @foreach ($duesReceived as $payment)
            <tr>
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
  </div>
</div>
