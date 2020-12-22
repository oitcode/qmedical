<div class="modal fade" id="detailModal" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Medical Test Detail</h5>
        <button type="button" class="btn btn-danger" data-dismiss="modal">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body p-0">

        <div class="mb-3 px-3">
          <div class="text-right">
            <a href="#" class="mr-3">SMS Invoice</a>
            <i class="fas fa-exclamation-circle text-danger mr-2"></i>
            <a href="#" class="">Report</a>
          </div>

          <div class="text-left mb-3">
            <span class="text-muted mr-2">
              Test Num:
            </span>
            <span class="mr-3">
              {{ $medicalTest->medical_test_id}}
            </span>
            <span class="text-info">
              <i class="fas fa-calendar mr-2"></i>
              {{ $medicalTest->date }}
            </span>
          </div>

          <!-- Patient Detail -->
          <div class="">
            <i class="fas fa-user mr-3 mb-3"></i>
            {{ $medicalTest->patient->name }}
          </div>

          <div class="">
            <i class="fas fa-map-marker-alt mr-3 mb-2"></i>
            @if ($medicalTest->patient->address)
              {{ $medicalTest->patient->address}}
            @else
              <span class="text-muted">
                <small>
                  Not Available
                </small>
              </span>
            @endif
          </div>

          <div class="">
            <i class="fas fa-phone mr-3"></i>
            @if ($medicalTest->patient->address)
              {{ $medicalTest->patient->contact_number}}
            @else
              <span class="text-muted">
                <small>
                  Not Available
                </small>
              </span>
            @endif
          </div>



          {{-- Dont need this for now
          <div class="card-footer">
            <div class="text-right">
              <a href="#" class="btn btn-sm bg-teal">
                <i class="fas fa-comments"></i>
              </a>
              <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-user"></i> View Profile
              </a>
            </div>
          </div>
          --}}
        </div>
        <!-- /.Patient Detail -->

        <!-- Test Detail -->
        <div class="p-3 bg-light border">
          <p>
            <span class="text-bold mr-3"> Test Type</span>
            {{ $medicalTest->medicalTestType->name }}
          </p>
          <p>
            <span class="text-bold mr-3"> Result</span>
            @if (strtolower($medicalTest->status) === 'waiting')
              <span class="text-danger">
                Waiting
              </span>
            @else
              <span class="text-info">
                {{ $medicalTest->result }}
              </span>
            @endif
            {{ $medicalTest->result }}
          </p>
        </div>
        <!-- /.Test Detail -->

        <!-- Billing -->
        <div class="p-3">
          <h3 class="h5 mb-4">Billing</h3>
          <div>
            <i class="fas fa-rupee-sign mr-3"></i>
            {{ $medicalTest->price }}
          </div>
          <div>
            <i class="fas fa-tag mr-3"></i>
            @if (strtolower($medicalTest->payment_status) === 'paid')
              <span class="text-success">
                Paid
              </span>
            @elseif (strtolower($medicalTest->payment_status) === 'pending')
              <span class="text-danger">
                Pending
              </span>
            @elseif (strtolower($medicalTest->payment_status) === 'partially_paid')
              <span class="text-danger">
                Partially Paid
              </span>

              <div>
                @foreach ($medicalTest->payments as $payment)
                    {{ $payment->amount }}
                @endforeach
              </div>
            @endif
          </div>
        </div>













      </div>
    </div>
  </div>
</div>






<script>
    $(document).ready(function () {
        //window.livewire.emit('show');
        $('#detailModal').modal('show');
    });

    window.livewire.on('show', () => {
        $('#detailModal').modal('show');
    });

    window.livewire.on('oclose', () => {
        $('#detailModal').modal('hide');
    });

    $('#detailModal').on('hidden.bs.modal', function () {
        window.livewire.emit('destroyDisplay');
    });
</script>
