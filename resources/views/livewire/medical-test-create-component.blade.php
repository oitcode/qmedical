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


        <hr />

        <h2>Agent</h2>

        <select class="custom-select" wire:model="selectedAgentId" wire:change="selectAgent">
          <option>---</option>
          @if(count($agents) > 0)
            @foreach($agents as $agent)
              <option value="{{ $agent->agent_id }}">{{ $agent->name }}</option>
            @endforeach
          @endif
        </select>

        @if($selectedAgent)
              <div class="card bg-light my-3 py-3">
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>{{ $selectedAgent->name }}</b></h2>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> {{ $selectedAgent->address }} </li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> {{ $selectedAgent->contact_number }}</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm btn-danger" wire:click="undoSelection">
                      <i class="fas fa-user"></i> Change
                    </a>
                    <a href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> View Profile
                    </a>
                  </div>
                </div>
              </div>
        @endif


        <button wire:click.prevent="store()" class="btn btn-success">Save</button>
    </form>

</div>
