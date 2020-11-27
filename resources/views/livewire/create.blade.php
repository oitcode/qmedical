<form>
    <div class="form-group">
        <label for="exampleFormControlInput1">Name:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name" wire:model="name">
        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput2">Sex:</label>
        <input type="text" class="form-control" id="exampleFormControlInput2" wire:model="sex" placeholder="Sex">
        @error('sex') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput3">DOB:</label>
        <input type="text" class="form-control" id="exampleFormControlInput3" wire:model="dob" placeholder="DOB">
        @error('dob') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <button wire:click.prevent="store()" class="btn btn-success">Save</button>
</form>
