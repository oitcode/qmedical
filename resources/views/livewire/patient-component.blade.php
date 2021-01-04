<div>
    @if (session()->has('message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
    @endif


    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Patient List</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>

      <div class="card-body p-0">
        <table class="table table-sm table-bordered table-hover">
            <thead>
                <tr class="text-muted">
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Contact Number</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($patients as $patient)
                <tr>
                    <td>{{ $patient->patient_id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->sex }}</td>
                    <td>{{ $patient->contact_number }}</td>
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

    @if (false)
    <form>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="" placeholder="Name" wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="date">Date:</label>
            <input type="text" class="form-control" id="" wire:model="date" placeholder="date">
            @error('date') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="name">Amount:</label>
            <input type="text" class="form-control" id="" placeholder="Amount" wire:model="amount">
            @error('amount') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control" rows="3" wire:model="comment" placeholder="Comment"></textarea>
            @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        @if($updateMode)
          <button wire:click.prevent="update()" class="btn btn-success">Update</button>
        @else
          <button wire:click.prevent="store()" class="btn btn-success">Save</button>
        @endif
    </form>
    @endif

</div>
