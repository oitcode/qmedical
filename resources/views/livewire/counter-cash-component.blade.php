<div class="card card-light">
  <div class="card-header">
    <h2 class="card-title h5">
      Counter Cash
    </h2>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>

  <div class="card-body py-1">
    <div class="clearfix">
      <div class="float-left text-info">
        <strong>
          @if ($searchDate == \Carbon\Carbon::today())
            Today
          @elseif ($searchDate == \Carbon\Carbon::yesterday())
            Yesterday
          @else
            {{ $searchDate->toDateString() }}
          @endif
        </strong>
        <span class="text-muted" style="font-size:12px;">
            {{ $searchDate->format('l') }}
        </span>
      </div>
      <div class="float-right">
        <input type="date" wire:model.defer="searchDate" />
        <button class="btn btn-sm btn-outline-info" wire:click="setSearchDate">
          Go
        </button>
        <button class="btn btn-light btn-sm border text-info rounded-circle" wire:click.prevent="previousDay">
          <i class="fas fa-arrow-left"></i>
        </button>
    
        <button class="btn btn-light btn-sm border text-info rounded-circle" wire:click.prevent="nextDay">
          <i class="fas fa-arrow-right"></i>
        </button>
      </div>
    </div>

    <div class="row text-dark mx-0">
      <div class="col-sm-3">
        Cash Sales
      </div>
      <div class="col-sm-6">
        {{ $todayPayment }}
      </div>
    </div>

    <div class="row text-muted mx-0">
      <div class="col-sm-3">
        Credit Sales
      </div>
      <div class="col-sm-6">
        {{ $todayCreditSalesTotal }}
      </div>
    </div>

    <div class="row text-dark mx-0">
      <div class="col-sm-3">
        Due Received
      </div>
      <div class="col-sm-6">
        {{ $duePayment }}
      </div>
    </div>

    <div class="row text-dark border-bottom mx-0 pb-2">
      <div class="col-sm-3">
        Expense
      </div>
      <div class="col-sm-6">
        {{ $expense }}
      </div>
    </div>

    <div class="row mx-0 my-1">
      <div class="col-sm-3 text-info">
        <strong>
          Net 
        </strong>
      </div>
      <div class="col-sm-6 @if($netBalance >= 0) text-success @else text-danger @endif">
        <strong>
          {{ $netBalance }}
        </strong>
      </div>
    </div>
  </div>


</div>
