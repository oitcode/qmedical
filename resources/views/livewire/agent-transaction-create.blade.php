<div>
  <h3 class="h5">{{ $agent->name }}</h3>
  <p>
    <span class="text-success">
      New Transaction
    </span>
  </p>

  <form>
      <div class="form-group form-inline">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fas fa-calendar"></i>
              </div>
            </div>
            <input type="text" class="form-control" id="" placeholder="Date" wire:model.defer="date">
            @error('date') <span class="text-danger">{{ $message }}</span>@enderror
          </div>
      </div>
  
      <div class="form-group form-inline">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                I/O
              </div>
            </div>
            <select wire:model.defer="direction" class="custom-select">
              <option>---</option>
              <option value="out">Pay</option>
              <option value="in">Receive</option>
            </select>
            @error('direction') <span class="text-danger">{{ $message }}</span>@enderror
          </div>
      </div>

      <div class="form-group form-inline">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fas fa-calendar"></i>
              </div>
            </div>
            <input type="text" class="form-control" rows="3" wire:model.defer="amount" placeholder="Amount">
            @error('amount') <span class="text-danger">{{ $message }}</span>@enderror
          </div>
      </div>

      <div class="form-group form-inline">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fas fa-comment"></i>
              </div>
            </div>
            <input type="text" class="form-control" rows="3" wire:model.defer="comment" placeholder="Comment">
            @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
          </div>
      </div>

      <button wire:click.prevent="store" type="button" class="btn btn-sm btn-primary">
        Save
      </button>
  </form>
</div>
