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
      @livewire('agent-component')
      @livewire('medical-test-component')
      @livewire('expense-component')
    </div>
    <div class="col-md-6">
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
