<div class="card shadow-none">
  <div class="card-body table-responsive p-0">
    <table class="table table-striped table-hover table-valign-middle">
      <thead>
      <tr class="sr-only">
        <th>Name</th>
        <th>Role</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr >
            <td>
              {{ $user->name }}
            </td>
            <td>
              {{ $user->role }}
            </td>
            <td>
              {{ $user->email }}
            </td>
            <td>
              <span class="btn btn-tool btn-sm" wire:click="">
                <i class="fas fa-pencil-alt text-primary mr-3"></i>
              </span>
              @can ('delete-models')
                <span class="btn btn-tool btn-sm">
                  <i class="fas fa-trash text-danger mr-3" wire:click=""></i>
                </span>
              @endcan
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!-- /.card -->
