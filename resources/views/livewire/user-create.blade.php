<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="userCreateModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New User</h5>
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="modal-body p-0">





<form>
    {{-- Name field --}}
    <div class="input-group m">
        <input type="text" wire:model.defer="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
               placeholder="Name" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>
        @if($errors->has('name'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </div>
        @endif
    </div>

    {{-- Email field --}}
    <div class="input-group">
        <input type="email" wire:model.defer="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
               placeholder="Email">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>
        @if($errors->has('email'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </div>
        @endif
    </div>

    {{-- Password field --}}
    <div class="input-group">
        <input type="password" wire:model.defer="password"
               class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
               placeholder="Password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>
        @if($errors->has('password'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </div>
        @endif
    </div>

    {{-- Confirm password field --}}
    <div class="input-group">
        <input type="password" wire:model.defer="passwordConfirm"
               class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
               placeholder="Password Confirm">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>
        @if($errors->has('password_confirmation'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </div>
        @endif
    </div>

    {{-- Register button --}}
    <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}" wire:click.prevent="store">
        <span class="fas fa-user-plus"></span>
        {{ __('adminlte::adminlte.register') }}
    </button>

</form>






      </div>
    </div>
  </div>
</div>

<script>
    /* Show the modal on load */
    $(document).ready(function () {
       $('#userCreateModal').modal('show');
    });

    /* Toggle the modal.  */
    window.livewire.on('toggleUserCreateModal', () => {
        $('#userCreateModal').modal('hide');
    });

   /* Destroy the modal on hide */
   $('#userCreateModal').on('hidden.bs.modal', function () {
       window.livewire.emit('destroyUserCreate');
   });

</script>
