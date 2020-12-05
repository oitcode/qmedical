<div>

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div wire:ignore.self class="modal" id="exampleModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">

          <!--
           |    Issue here
           |
           |    When user types here and component has to render again the modal breaks.
           |
           -->
          <input type="text" wire:model="name" />
          <p>{{ $name }}</p>

        </div>
      </div>
    </div>
  </div>

@push('child-scripts')
<script>
     $(document).ready(function () {
        // console.log('Ready');
        // $('#exampleModal').modal('show');
     })

     window.livewire.on('show', () => {
         $('#createModal').modal('show');
     });

</script>
@endpush


</div>
