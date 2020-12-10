<div class="card shadow-none">
  <div class="card-body table-responsive p-0">
    <table class="table table-striped table-hover table-valign-middle">
      <thead>
      <tr class="sr-only">
        <th>#</th>
        <th>Name</th>
        <th>Balance</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        @foreach($agents as $agent)
        <tr >
            <td>
              {{ $agent->agent_id }}
            </td>
            <td>
              <a href="" wire:click.prevent="$emit('displayAgent', {{ $agent }})" class="text-dark">
                {{ $agent->name }}
              </a>
            </td>
            <td>
                @livewire('agent-balance-display', ['agent' => $agent], key(rand() * $agent->agent_id))
            </td>
            <td>
              <span class="btn btn-tool btn-sm">
                <i class="fas fa-folder text-info mr-3" wire:click="$emit('displayAgent', {{ $agent }})"></i>
              </span>

              <span class="btn btn-tool btn-sm">
                <i class="fas fa-pencil-alt text-primary mr-3" wire:click="$emit('updateAgent', {{ $agent }})"></i>
              </span>
              <span class="btn btn-tool btn-sm">
                <i class="fas fa-trash text-danger mr-3" wire:click="$emit('deleteAgent', {{ $agent->agent_id }})"></i>
              </span>
              </span>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $agents->links() }}
  </div>
</div>
<!-- /.card -->
