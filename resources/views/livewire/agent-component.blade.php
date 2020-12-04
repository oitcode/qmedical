<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    <!-- Create modal -->
    <div class="modal" tabindex="-1" role="dialog" id="exampleModal" wire:ignore>
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create Agent</h5>
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

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          Agent list
        </h4>
        <div class="card-tools">
          <i class="fas fa-plus mr-3 text-success" wire:click="" data-toggle="modal" data-target="#exampleModal"></i>
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>

    <!-- Button trigger modal -->
      </div>
      <div class="card-body p-0">
        <table class="table table-sm table-bordered table-hover">
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
                    <td>
                      <a href="{{ route('agentShow', $agent->agent_id) }}">
                        {{ $agent->name }}
                      </a>
                    </td>
                    <td>{{ $agent->sex }}</td>
                    <td>{{ $agent->contact_number }}</td>
                    <td>{{ $agent->email }}</td>
                    <td>
                      <i class="fas fa-folder text-info mr-3"></i>
                      <i class="fas fa-pencil-alt text-primary mr-3"></i>
                      <i class="fas fa-trash text-danger mr-3"></i>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
</div>
