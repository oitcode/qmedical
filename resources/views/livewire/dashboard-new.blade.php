<div>
  @if (false)
  <div class="row">
    <div class="col-md-3 col-6">
      @livewire('info-card-patient')
    </div>
    <div class="col-md-3 col-6">
      @livewire('info-card-agent')
    </div>
    <div class="col-md-3 col-6">
      @livewire('info-card-medical-test')
    </div>
    <div class="col-md-3 col-6">
      @livewire('info-card-user')
    </div>
  </div>
  @endif
  <div class="row">
    <div class="col-md-6">
      @livewire('medical-test-component')
      @livewire('sales-component')
      @livewire('due-received-component')
    </div>
    <div class="col-md-6">
      @livewire('expense-component')
      @livewire('agent-component')

      @can ('view-user-component')
        @livewire('user-component')
      @endcan

      @if ($displayingComponent !== null)
        {{--
        @livewire($displayingComponent, [$modelName => $model, 'compDisplayMode' => 'normal',])
        --}}
        Model name: {{ $modelName }}
        Model {{ $model->name }}
      @endif
    </div>
  </div>
</div>
