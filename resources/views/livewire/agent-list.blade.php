<div class="card shadow-none">
  <div class="card-body table-responsive p-0">
    <table class="table table-sm table-hover table-valign-middle">
      <thead>
      <tr class="text-muted">
        <th>Agent ID</th>
        <th>Name</th>
        <th>Balance</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        @if ($agents !== null && count($agents) > 0)
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
                <span class="btn btn-tool btn-sm" wire:click="$emit('updateAgent', {{ $agent }})">
                  <i class="fas fa-pencil-alt text-primary mr-3"></i>
                </span>
                @can ('delete-models')
                  <span class="btn btn-tool btn-sm">
                    <i class="fas fa-trash text-danger mr-3" wire:click="$emit('deleteAgent', {{ $agent->agent_id }})"></i>
                  </span>
                @endcan
              </td>
          </tr>
          @endforeach
        @endif
      </tbody>
    </table>
    {{--
    {{ $agents->links() }}
    --}}
  </div>
</div>
<!-- /.card -->
