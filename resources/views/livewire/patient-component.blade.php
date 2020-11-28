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

    <table class="table table-bordered mt-5">
        <thead>
            <tr class="bg-primary text-white">
                <th>No.</th>
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
                <button {{-- wire:click="edit({{ $expense->expense_id }})" --}} class="btn btn-primary btn-sm">Edit</button>
                <button {{-- wire:click="delete({{ $expense->expense_id }})" --}} class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
        --}}
    </table>
</div>
