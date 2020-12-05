<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Agent List
    </h3>
    <div class="card-tools">
    </div>
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
                  <a href="" wire:click.prevent="$emit('displayAgent', {{ $agent }})">
                    {{ $agent->name }}
                  </a>
                </td>
                <td>{{ $agent->sex }}</td>
                <td>{{ $agent->contact_number }}</td>
                <td>{{ $agent->email }}</td>
                <td>
                  <i class="fas fa-folder text-info mr-3" wire:click="$emit('displayAgent', {{ $agent }})"></i>
                  <i class="fas fa-pencil-alt text-primary mr-3"></i>
                  <i class="fas fa-trash text-danger mr-3" wire:click="$emit('deleteAgent', {{ $agent->agent_id }})"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>
