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
            <label for="name">Rate:</label>
            <input type="text" class="form-control" id="" placeholder="Rate" wire:model="rate">
            @error('rate') <span class="text-danger">{{ $message }}</span>@enderror
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
                <th>Rate</th>
                <th>Comment</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($medicalTestTypes as $medicalTestType)
            <tr>
                <td>{{ $medicalTestType->medical_test_type_id }}</td>
                <td>{{ $medicalTestType->name }}</td>
                <td>{{ $medicalTestType->rate }}</td>
                <td>{{ $medicalTestType->comment }}</td>
                <td>
                <button wire:click="edit({{ $medicalTestType->medical_test_type_id }})" class="btn btn-primary btn-sm">Edit</button>
                <button wire:click="delete({{ $medicalTestType->medical_test_type_id }})" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
