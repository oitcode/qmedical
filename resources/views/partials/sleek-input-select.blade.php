<div class="form-group form-inline m-0">
  <div class="input-group w-100">
    <div class="input-group-prepend w-25">
      <div class="input-group-text w-100">
        {{ $selectTitle }}
      </div>
    </div>
    <select class="custom-select" wire:model="{{ $mName }}">
      <option>---</option>
      @foreach($items as $item)
        <option value="{{ $item->getPrimaryKey() }}">{{ $item->name }}</option>
      @endforeach
    </select>
  </div>
</div>
