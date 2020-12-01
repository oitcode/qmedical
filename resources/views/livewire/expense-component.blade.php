<div>

  <!-- Flash message row -->
  <!-- TODO: Manage this flash message -->
  <div class="row">
    <div class="col-md-6">
      @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <!-- Card -->
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <h3 class="card-title">Expense List</h3>
          <div class="card-tools">
            <i class="fas fa-plus mr-3 text-success " wire:click="create"></i>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>

        <!-- /.Card header -->

        <!-- /.Card body -->
        <div class="card-body">
          @if ($createMode || $updateMode)
            <form class="border p-4 shadow-sm">
              <h4 class="h5">New Expense</h4>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                      <label for="date">Date:</label>
                      <input type="text" class="form-control" id="" wire:model="date" placeholder="date">
                      @error('date') <span class="text-danger">{{ $message }}</span>@enderror
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                      <label for="name">Category:</label>
                      <select class="custom-select" wire:model="expense_category_id">
                        <option>---</option>
                        @foreach($expenseCategories as $expenseCategory)
                          <option value="{{ $expenseCategory->expense_category_id }}">{{ $expenseCategory->name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                      <label for="date">Name:</label>
                      <input type="text" class="form-control" id="" wire:model="name" placeholder="Name">
                      @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                      <label for="name">Amount:</label>
                      <input type="text" class="form-control" id="" placeholder="Amount" wire:model="amount">
                      @error('amount') <span class="text-danger">{{ $message }}</span>@enderror
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                      <label for="comment">Comment:</label>
                      <input type="text" class="form-control" wire:model="comment" placeholder="Comment">
                      @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
                  </div>
                </div>

              </div>

              @if($createMode)
                <button wire:click.prevent="store()" class="btn btn-sm btn-success">
                  <i class="fas fa-save mr-2"></i>
                  Save
                </button>
                <button wire:click.prevent="exitCreateMode" class="btn btn-sm btn-danger">
                  <i class="fas fa-ban mr-2"></i>
                  Cancel
                </button>
              @endif

              @if($updateMode)
                <button wire:click.prevent="update()" class="btn btn-sm btn-success">
                  <i class="fas fa-save mr-2"></i>
                  Update
                </button>
                <button wire:click.prevent="exitUpdateMode" class="btn btn-sm btn-danger">
                  <i class="fas fa-ban mr-2"></i>
                  Cancel
                </button>
              @endif
            </form>
          @endif

          <table class="table table-sm table-bordered table-hover mt-5">
            <thead>
              <tr class="bg-primary text-white">
                <th>No.</th>
                <th>Date</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Category</th>
                <th>Comment</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              @foreach($expenses as $expense)
              <tr>
                <td>{{ $expense->expense_id }}</td>
                <td>{{ $expense->date }}</td>
                <td>{{ $expense->name }}</td>
                <td>{{ $expense->amount }}</td>
                <td>{{ $expense->expenseCategory->name }}</td>
                <td>{{ $expense->comment }}</td>
                <td>
                  <i class="fas fa-pencil-alt mr-2 text-primary" wire:click="edit({{ $expense->expense_id }})"></i>
                  <i class="fas fa-trash mr-2 text-danger" wire:click="delete({{ $expense->expense_id }})"></i>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.Card body -->
      </div>
      <!-- /.Card -->
    </div>

    <div class="col-md-4">
      @livewire('expense-category')
    </div>
  </div>
</div>
