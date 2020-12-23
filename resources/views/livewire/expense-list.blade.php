<div class="card shadow-none">
  <div class="card-body p-0">

    <div class="row text-danger py-2" style="margin:auto;">
      <div class="col-md-3 px-2">
        @if ($searchDate == \Carbon\Carbon::today())
          Today
        @elseif ($searchDate == \Carbon\Carbon::yesterday())
          Yesterday
        @else
          {{ $searchDate->toDateString() }}
        @endif
      </div>
      <div class="col-md-3 px-2">
        <strong>
          {{ $expenseTotal }}
        </strong>
      </div>
      <div class="col-md-3 px-2">
      </div>
      <div class="col-md-3 px-2">
      </div>
    </div>

    <div class="table-responseive">
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
              <span class="text-dark">
                {{ $expense->expenseCategory->name }}
              </span>
            </td>
            <td>
              <a href="" wire:click.prevent="$emit('displayExpense', {{ $expense }})" class="text-dark">
                {{ $expense->name }}
              </a>
            </td>
            <td>
              <span class="text-dark">
                {{ $expense->amount }}
              </span>
            </td>
            <td>
              <span class="btn btn-tool btn-sm" wire:click="$emit('updateExpense', {{ $expense }})">
                <i class="fas fa-pencil-alt mr-2 text-primary"></i>
              </span>
              @can ('delete-models')
                <span class="btn btn-tool btn-sm">
                  <i class="fas fa-trash mr-2 text-danger" wire:click="$emit('deleteExpense', {{ $expense->expense_id }})"></i>
                </span>
              @endcan
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- /.card -->
