<div class="card shadow-none">
  <div class="card-body table-responsive p-0">
    <table class="table table-striped table-hover">
      @if (false)
      <thead>
        <tr>
          <th>Name</th>
          <th>Amount</th>
          <th>Action</th>
        </tr>
      </thead>
      @endif
    
      <tbody>
        @foreach($expenses as $expense)
        <tr>
          <td>
            <a href="" wire:click.prevent="$emit('displayExpense', {{ $expense }})" class="text-dark">
              {{ $expense->name }}
            </a>
          </td>
          <td>{{ $expense->amount }}</td>
          <td>
            <span class="btn btn-tool btn-sm">
              <i class="fas fa-pencil-alt mr-2 text-primary" wire:click=""></i>
            </span>
            <span class="btn btn-tool btn-sm">
              <i class="fas fa-trash mr-2 text-danger" wire:click="$emit('deleteExpense', {{ $expense->expense_id }})"></i>
            </span>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!-- /.card -->
