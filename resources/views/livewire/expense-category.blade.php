<div class="card">
  <!-- Card header -->
  <div class="card-header">
    <h3 class="card-title">Expense Categories</h3>


    <div class="card-tools">
      <i class="fas fa-plus mr-3 text-success" wire:click="create"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button>
    </div>
  </div>
  <!-- /.Card header -->

  <!-- Card body -->
  <div class="card-body">
    <!-- Show this only if creating new -->
    @if ($createMode)
      <form>
          <div class="form-group">
              <label for="name">Category Name:</label>
              <input type="text" class="form-control" id="" placeholder="Name" wire:model="name">
              @error('name') <span class="text-danger">{{ $message }}</span>@enderror
          </div>

          <div class="form-group">
              <label for="comment">Comment:</label>
              <textarea class="form-control" rows="3" wire:model="comment" placeholder="Comment"></textarea>
              @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
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
      </form>

      <hr />
    @endif

    <table class="table table-sm table-bordered table-hover">
      <thead>
      <tr>
        <th>Name</th>
        <th>Comment</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($expenseCategories as $expenseCategory)
          <tr>
            <td>{{ $expenseCategory->name }}</td>
            <td>{{ $expenseCategory->comment }}</td>
            <td>
                <i class="fas fa-trash mr-3 text-danger" wire:click="delete({{ $expenseCategory->expense_category_id }})"></i>
                <i class="fas fa-pencil-alt text-primary"></i>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.Card body -->
</div>
