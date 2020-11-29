<div>
    @if (session()->has('message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
    @endif


    <form>
        <!-- Top row -->
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
                <label for="name">Date</label>
                <input type="text" class="form-control" id="" placeholder="Date" wire:model="medicalTestDate">
            </div>
          </div>

          <div class="col-md-2">
            <label for="">Test type</label>
            <select class="custom-select" wire:model="medicalTestTypeId">
              <option>---</option>
              @foreach($medicalTestTypes as $medicalTestType)
                <option value="{{ $medicalTestType->medical_test_type_id }}">{{ $medicalTestType->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label for="">Status</label>
            <select class="custom-select" disabled>
              <option>---</option>
                <option value="" selected>Waiting</option>
                <option value="">Completed</option>
            </select>
          </div>


        </div>
        <!-- /.Top row -->

        <hr />

        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Patient Detail</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" class="form-control" id="" placeholder="Enter name" wire:model="patientName">
                </div>

                <!-- Biometric Detail -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Sex</label>
                      <select class="custom-select" wire:model="patientSex">
                        <option>---</option>
                          <option value="m">Male</option>
                          <option value="f">Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Date of Birth</label>
                        <input type="text" class="form-control" id="" placeholder="Date of birth" wire:model="patientDob">
                    </div>
                  </div>
                </div>
                <!-- /.Biometric Detail -->

                <hr />

                <!-- Contact Detail -->
                <div class="form-group">
                  <label for="">Address</label>
                  <input type="text" class="form-control" id="" placeholder="Address" wire:model="patientAddress">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Contact number</label>
                      <input type="text" class="form-control" id="" placeholder="Contact number" wire:model="patientContactNumber">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="" placeholder="Email" wire:model="patientEmail">
                    </div>
                  </div>
                </div>
                <!-- /.Contact Detail -->

                <hr />

                <!-- Passport Detail -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Passport number</label>
                      <input type="text" class="form-control" id="" placeholder="Passport number" wire:model="patientPassportNumber">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Passport Expiry Date</label>
                        <input type="text" class="form-control" id="" placeholder="Passport Expiry Date" wire:model="patientPassportExpiryDate">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Passport Issue Place</label>
                      <input type="text" class="form-control" id="" placeholder="Passport Issue Place" wire:model="patientPassportIssuePlace">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nationality</label>
                        <input type="text" class="form-control" id="" placeholder="Nationality" wire:model="patientNationality">
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
                  <label for="Price" class="mr-3">Price</label>
                  <input type="text" class="form-control" id="" placeholder="Price" wire:model="price">
                </div>

                <div class="form-group form-inline">
                  <label for="paymentStatus" class="mr-3">Payment Status</label>
                  <select class="custom-select" wire:model="paymentStatus">
                    <option>---</option>
                      <option>Pending</option>
                      <option>Paid</option>
                  </select>
                </div>

                <!-- Agent -->
                <hr />
                <h3 class="h5 mb-4">Agent</h3>

                  <select class="custom-select mb-4" wire:model="selectedAgentId" wire:change="selectAgent">
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
                  <label for="Price" class="mr-3">Amount</label>
                  <input type="text" class="form-control" id="" placeholder="Amount" wire:model="agentCommission">
                </div>

                <div class="form-group form-inline">
                  <label for="paymentStatus" class="mr-3">Payment Status</label>
                  <select class="custom-select" wire:model="agentCommissionStatus">
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

        @if($editMode)
          <button wire:click.prevent="update()" class="btn btn-success">Update</button>
        @else
          <button wire:click.prevent="store()" class="btn btn-success">Save</button>
        @endif
    </form>

</div>
