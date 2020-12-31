<div>
  @if (false)
  <div class="row">
    <div class="col-md-2 col-6">
      @livewire('info-card-patient')
    </div>
    <div class="col-md-2 col-6">
      @livewire('info-card-agent')
    </div>
    <div class="col-md-2 col-6">
      @livewire('info-card-medical-test')
    </div>
    <div class="col-md-2 col-6">
      @livewire('info-card-user')
    </div>
    <div class="col-md-4 col-6">
    </div>
  </div>
  @endif
  <div class="row">
    <div class="col-md-12">
      @livewire('medical-test-component')
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      @livewire('sales-component')
    </div>
    <div class="col-md-6">
      @if (true)
      @livewire('expense-component')
      @endif

      @livewire('counter-cash-component')

      @if ($displayingComponent !== null)
        {{--
        @livewire($displayingComponent, [$modelName => $model, 'compDisplayMode' => 'normal',])
        --}}
        Model name: {{ $modelName }}
        Model {{ $model->name }}
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      @livewire('agent-component')
    </div>
    <div class="col-md-6">
      @can ('view-user-component')
        @livewire('user-component')
      @endcan
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      @livewire('pending-bill-list-component')
    </div>
  </div>

</div>
