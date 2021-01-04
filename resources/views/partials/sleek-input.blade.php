<div class="form-group form-inline m-0">
    <div class="input-group w-100">
      <div class="input-group-prepend w-25">
        <div class="input-group-text w-100">
          <i class="@isset($faIcon) {{ $faIcon }} @else fas fa-arrow-right @endisset mr-3"></i>
        </div>
      </div>
      <input type="text" class="form-control" placeholder="{{ $pName }}" wire:model.defer="{{ $mName }}">
      @error($mName) <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>
