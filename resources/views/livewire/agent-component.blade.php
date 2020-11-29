<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      CREATE
    </button>

    <!-- Create modal -->
    <div class="modal" tabindex="-1" role="dialog" id="exampleModal" wire:ignore>
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create Agent</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Name:</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name" wire:model.defer="name">
                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput2">Sex:</label>
                    <select wire:model.defer="sex" class="custom-select">
                      <option selected>Sex</option>
                      <option value="m">Male</option>
                      <option value="f">Female</option>
                    </select>
                    @error('sex') <span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" wire:model.defer="email" placeholder="Email">
                    @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="contact_number">Contact Number:</label>
                    <input type="text" class="form-control" id="" wire:model.defer="contact_number" placeholder="Contact number">
                    @error('contact_number') <span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" rows="3" wire:model.defer="comment" placeholder="Comment"></textarea>
                    @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </form>
          </div>

          <div class="modal-footer">
            <button wire:click.prevent="store()" class="btn btn-success" wire:key>Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <table class="table table-bordered mt-5">
        <thead>
            <tr class="bg-primary text-white">
                <th>No.</th>
                <th>Name</th>
                <th>Sex</th>
                <th>Contact number</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($agents as $agent)
            <tr>
                <td>{{ $agent->agent_id }}</td>
                <td>{{ $agent->name }}</td>
                <td>{{ $agent->sex }}</td>
                <td>{{ $agent->contact_number }}</td>
                <td>{{ $agent->email }}</td>
                <td>
                <button {{-- wire:click="edit({{ $patient->patient_id }})" --}} class="btn btn-primary btn-sm">Edit</button>
                <button {{-- wire:click="delete({{ $patient->patient_id }})" --}} class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
