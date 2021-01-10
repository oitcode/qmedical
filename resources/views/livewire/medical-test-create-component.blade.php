<div  wire:ignore.self class="modal" id="createModal" data-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Medical Test</h5>
        <button type="button" class="btn btn-danger" data-dismiss="modal">
          <i class="fas fa-times"></i>
        </button>
      </div>


      <div class="modal-body p-0">

        <form>

          <div class="form-row">
            <div class="col-md-8">
              <!-- Date and Test type -->
              <div class="form-group form-inline m-0">
                <div class="input-group w-100">
                  <div class="input-group-prepend w-25">
                    <div class="input-group-text w-100">
                      Date
                    </div>
                  </div>

                  <input type="date" class="form-control" id="" placeholder="Date" wire:model.defer="medicalTestDate">
                  @error('medicalTestDate')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="form-group form-inline m-0">
                <div class="input-group w-100">
                  <div class="input-group-prepend w-25">
                    <div class="input-group-text w-100">
                      Test Type
                    </div>
                  </div>

                  <select class="custom-select" wire:model.defer="medicalTestTypeId">
                    <option>---</option>
                     @foreach($medicalTestTypes as $medicalTestType)
                       <option value="{{ $medicalTestType->medical_test_type_id }}">{{ $medicalTestType->name }}</option>
                     @endforeach
                  </select>
                  @error('medicalTestTypeId')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <!-- /.Date and Test type -->

              <!-- Biometric Detail -->
              @include('partials.sleek-input', ['mName' => 'patientName', 'pName' => 'Patient Name', 'faIcon' => 'fas fa-user',])

              <div class="form-group form-inline m-0">
                <div class="input-group w-100">
                  <div class="input-group-prepend w-25">
                    <div class="input-group-text w-100">
                      <i class="fas fa-venus-double"></i>
                    </div>
                  </div>

                  <select class="custom-select" wire:model.defer="patientSex">
                    <option>Sex</option>
                      <option value="m">Male</option>
                      <option value="f">Female</option>
                  </select>
                  @error('patientSex')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="form-group form-inline m-0">
                <div class="input-group w-100">
                  <div class="input-group-prepend w-25">
                    <div class="input-group-text w-100">
                      Date of Birth
                    </div>
                  </div>

                  <input type="date" class="form-control" id="" placeholder="Date of birth" wire:model.defer="patientDob">
                  @error('patientDob')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <!-- /.Biometric Detail -->


              <!-- Contact Detail -->
              @include('partials.sleek-input', ['mName' => 'patientAddress', 'pName' => 'Address', 'faIcon' => 'fas fa-map-marker-alt',])
              @include('partials.sleek-input', ['mName' => 'patientContactNumber', 'pName' => 'Phone', 'faIcon' => 'fas fa-phone',])
              @include('partials.sleek-input', ['mName' => 'patientEmail', 'pName' => 'Email','faIcon' => 'fas fa-envelope', ])

              @include('partials.sleek-input', ['mName' => 'patientPassportNumber', 'pName' => 'Passport Number', 'faIcon' => 'fas fa-passport',])
              @include('partials.sleek-input', ['mName' => 'patientPassportExpiryDate', 'pName' => 'Passport Expiry Date', 'faIcon' => 'fas fa-calendar',])
              @include('partials.sleek-input', ['mName' => 'patientPassportIssuePlace', 'pName' => 'Passport Issued Place','faIcon' => 'fas fa-map-marker-alt', ])
              @include('partials.sleek-input', ['mName' => 'patientNationality', 'pName' => 'Nationality', 'faIcon' => 'fas fa-flag', 'mValue' => 'Nepalese',])
              <!-- /.Contact Detail -->
            </div>
            <div class="col-md-4">
              <!-- Billing -->
              <div class="p-2">
                <h2 class="h5">Billing</h2>
              </div>
              @include('partials.sleek-input', ['mName' => 'price', 'pName' => 'Price',])

              <!-- Agent -->
              <div class="form-group form-inline m-0">
                <div class="input-group w-100">
                  <div class="input-group-prepend w-25">
                    <div class="input-group-text w-100">
                      Agent ?
                    </div>
                  </div>

                  <select class="custom-select" wire:model="agentFlag">
                    <option>---</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                  @error('agentFlag')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              @if (strtolower($agentFlag) === 'yes')
                <div class="form-group form-inline m-0">
                  <div class="input-group w-100">
                    <div class="input-group-prepend w-25">
                      <div class="input-group-text w-100">
                        Paid By
                      </div>
                    </div>

                    <select class="custom-select" wire:model="payBy">
                      <option>---</option>
                        <option>Agent</option>
                        <option value="Self">Patient</option>
                    </select>
                    @error('payBy')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>


                <div class="form-group form-inline m-0">
                  <div class="input-group w-100">
                    <div class="input-group-prepend w-25">
                      <div class="input-group-text w-100">
                        Agent
                      </div>
                    </div>

                    <select class="custom-select" wire:model="selectedAgentId" wire:change="selectAgent">
                      <option>---</option>
                      @if(count($agents) > 0)
                        @foreach($agents as $agent)
                          <option value="{{ $agent->agent_id }}">{{ $agent->name }}</option>
                        @endforeach
                      @endif
                    </select>
                    @error('selectedAgentId')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                @if($selectedAgent && false)
                  <div class="mb-3">
                  <h2 class="lead"><b>{{ $selectedAgent->name }}</b></h2>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> {{ $selectedAgent->contact_number }}</li>
                    </ul>
                  </div>
                @endif

                @include('partials.sleek-input', ['mName' => 'agentCommission', 'pName' => 'Agent Commission', 'faIcon' => 'fas fa-rupee-sign',])

              @endif



              <!-- Credit or not -->
              @if (false)
              {{-- TODO
              @if (strtolower($agentFlag) !== 'yes'
                ||
                (strtolower($agentFlag) === 'yes' && strtolower($payBy) === 'self')

              )
              --}}
                <div class="form-group form-inline m-0">
                  <div class="input-group w-100">
                    <div class="input-group-prepend w-25">
                      <div class="input-group-text w-100">
                        Credit
                      </div>
                    </div>
                    <select class="custom-select" wire:model="creditFlag">
                      <option>---</option>
                        <option>No</option>
                        <option>Yes</option>
                    </select>
                    @error('creditFlag')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              @endif
            </div>
          </div>









          <div class="mx-2 my-4">
            <button wire:click.prevent="store()" class="btn btn-sm btn-success">Save</button>
            <button wire:click.prevent="$emit('toggleMedicalTestCreateModal')" class="btn btn-sm btn-danger">Cancel</button>
          </div>
        </form>




      </div>
    </div>
  </div>
</div>



<script>
    /* Show the modal on load */
    $(document).ready(function () {
       console.log('Hi');
       $('#createModal').modal('show');
    });


    /* Toggle the modal.  */
    window.livewire.on('toggleMedicalTestCreateModal', () => {
        $('#createModal').modal('hide');
        console.log('Create modal toggled off');
    });


   /* Destroy the modal on hide */
   $('#createModal').on('hidden.bs.modal', function () {
       window.livewire.emit('destroyCreate');
   });

</script>
