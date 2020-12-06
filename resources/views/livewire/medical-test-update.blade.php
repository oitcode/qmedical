<div  wire:ignore.self class="modal fade" id="medicalTestUpdateModal" tabindex="-1">
  <div class="modal-dialog mw-100 w-75">
    <div class="modal-content">
      <div class="modal-body">
      <form>
          <!-- Top row -->
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                  <label for="name" class="sr-only">Date</label>
                  <input type="text" class="form-control" id="" placeholder="Date" wire:model.defer="medicalTestDate">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group form-inline">
                <label for="" class="mr-3 text-muted">Test type</label>
                <select class="custom-select" wire:model.defer="medicalTestTypeId">
                  <option>---</option>
                   @foreach($medicalTestTypes as $medicalTestType)
                     <option value="{{ $medicalTestType->medical_test_type_id }}">{{ $medicalTestType->name }}</option>
                   @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group form-inline">
                <label for="" class="mr-3 text-muted">Status</label>
                <select class="custom-select" wire:model.lazy="medicalTestStatus">
                  <option>---</option>
                    <option>Waiting</option>
                    <option>Completed</option>
                </select>
              </div>
            </div>

           <div class="col-md-2">
             <label for="">Result</label>
             <select class="custom-select" wire:model.defer="result">
               <option>---</option>
                 <option selected>Pass</option>
                 <option>Fail</option>
             </select>
           </div>

           <div class="col-md-2">
             <label for="" class="sr-only">Remark</label>
                 <input type="text" class="form-control" id="" placeholder="Remarks" wire:model.defer="resultRemark">
             </select>
           </div>


          </div>
          <!-- /.Top row -->

          <hr />

          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Patient Detail</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="" class="sr-only">Name</label>
                    <input type="text" class="form-control" id="" placeholder="Enter name" wire:model.defer="patientName">
                  </div>

                  <!-- Biometric Detail -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group form-inline">
                        <label for="" class="text-secondary mr-3 text-normal">Sex</label>
                        <select class="custom-select" wire:model.defer="patientSex">
                          <option>---</option>
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="" class="sr-only">Date of Birth</label>
                          <input type="text" class="form-control" id="" placeholder="Date of birth" wire:model.defer="patientDob">
                      </div>
                    </div>
                  </div>
                  <!-- /.Biometric Detail -->

                  <hr />

                  <!-- Contact Detail -->
                  <div class="form-group">
                    <label for="" class="sr-only">Address</label>
                    <input type="text" class="form-control" id="" placeholder="Address" wire:model.defer="patientAddress">
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="" class="sr-only">Contact number</label>
                        <input type="text" class="form-control" id="" placeholder="Contact number" wire:model.defer="patientContactNumber">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="" class="sr-only">Email</label>
                          <input type="email" class="form-control" id="" placeholder="Email" wire:model.defer="patientEmail">
                      </div>
                    </div>
                  </div>
                  <!-- /.Contact Detail -->

                  <hr />

                  <!-- Passport Detail -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="" class="sr-only">Passport number</label>
                        <input type="text" class="form-control" id="" placeholder="Passport number" wire:model.defer="patientPassportNumber">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="" class="sr-only">Passport Expiry Date</label>
                          <input type="text" class="form-control" id="" placeholder="Passport Expiry Date" wire:model.defer="patientPassportExpiryDate">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="" class="sr-only">Passport Issue Place</label>
                        <input type="text" class="form-control" id="" placeholder="Passport Issue Place" wire:model.defer="patientPassportIssuePlace">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="" class="sr-only">Nationality</label>
                          <input type="text" class="form-control" id="" placeholder="Nationality" wire:model.defer="patientNationality">
                      </div>
                    </div>
                  </div>
                  <!-- /.Passport Detail -->

                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->

            <!-- right column -->
            <div class="col-md-6">

              <!-- Billing -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Billing</h3>
                </div>
                <div class="card-body">
                  <!-- Billing -->
                  <div class="form-group form-inline">
                    <label for="Price" class="sr-only">Price</label>
                    <input type="text" class="form-control" id="" placeholder="Price" wire:model.defer="price">
                  </div>

                  <div class="form-group form-inline">
                    <label for="paymentStatus" class="mr-3 text-muted">Payment Status</label>
                    <select class="custom-select" wire:model.defer="paymentStatus">
                      <option>---</option>
                        <option>Pending</option>
                        <option>Paid</option>
                    </select>
                  </div>

                  <!-- Agent -->
                  <hr />
                  <h3 class="h5 mb-4">Agent</h3>

                    <select class="custom-select mb-4" wire:model.defer="selectedAgentId" wire:change.defer="selectAgent">
                      <option>---</option>
                      @if(count($agents) > 0)
                        @foreach($agents as $agent)
                          <option value="{{ $agent->agent_id }}">{{ $agent->name }}</option>
                        @endforeach
                      @endif
                    </select>

                    @if($selectedAgent)
                      <div class="mb-3">
                      <h2 class="lead"><b>{{ $selectedAgent->name }}</b></h2>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> {{ $selectedAgent->contact_number }}</li>
                        </ul>
                      </div>
                    @endif
                  <div class="form-group form-inline">
                    <label for="Price" class="sr-only">Amount</label>
                    <input type="text" class="form-control" id="" placeholder="Amount" wire:model.defer="agentCommission">
                  </div>

                  <div class="form-group form-inline">
                    <label for="paymentStatus" class="mr-3 text-muted">Status</label>
                    <select class="custom-select" wire:model.defer="agentCommissionStatus">
                      <option>---</option>
                        <option>Pending</option>
                        <option>Paid</option>
                    </select>
                  </div>

                </div>
              </div>
              <!-- /.card -->
              <!-- Billing -->

            </div>
            <!-- /.col -->

          </div>
          <!-- /.row -->

            <button wire:click.prevent="update" class="btn btn-success">Update</button>
            <button wire:click.prevent="$emit('toggleMedicalTestUpdateModal')" class="btn btn-danger">Cancel</button>
      </form>




      </div>
    </div>
  </div>
</div>



<script>
    /* Show the modal on load */
    $(document).ready(function () {
       $('#medicalTestUpdateModal').modal('show');
    });

    /* Toggle the modal.  */
    window.livewire.on('toggleMedicalTestUpdateModal', () => {
        $('#medicalTestUpdateModal').modal('hide');
    });

   /* Destroy the modal on hide */
   $('#medicalTestUpdateModal').on('hidden.bs.modal', function () {
       window.livewire.emit('destroyMedicalTestUpdate');
   });

</script>
