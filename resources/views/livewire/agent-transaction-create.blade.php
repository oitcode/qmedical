<div class="m-0">
  <form>
      <div class="form-group form-inline m-0">
          <div class="input-group w-100">
            <div class="input-group-prepend w-25">
              <div class="input-group-text w-100">
                <i class="fas fa-calendar"></i>
              </div>
            </div>
            <input type="date" class="form-control" id="" placeholder="Date" wire:model.defer="date">
            @error('date') <span class="text-danger">{{ $message }}</span>@enderror
          </div>
      </div>
  
      <div class="form-group form-inline m-0">
          <div class="input-group w-100">
            <div class="input-group-prepend w-25">
              <div class="input-group-text w-100">
                Pay/Receive
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

      <div class="form-group form-inline m-0">
          <div class="input-group w-100">
            <div class="input-group-prepend w-25">
              <div class="input-group-text w-100">
                <i class="fas fa-dollar-sign"></i>
              </div>
            </div>
            <input type="text" class="form-control" rows="3" wire:model.defer="amount" placeholder="Amount">
            @error('amount') <span class="text-danger">{{ $message }}</span>@enderror
          </div>
      </div>

      <div class="form-group form-inline m-0">
          <div class="input-group w-100">
            <div class="input-group-prepend w-25">
              <div class="input-group-text w-100">
                <i class="fas fa-comment"></i>
              </div>
            </div>
            <input type="text" class="form-control" rows="3" wire:model="comment" placeholder="Comment">
            @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
          </div>
      </div>

      <button wire:click.prevent="store" type="button" class="btn btn-sm btn-primary m-2">
        Save
      </button>
  </form>
</div>
