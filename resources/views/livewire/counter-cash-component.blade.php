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

  <div class="card-body p-0">



    @if (true)
      <!-- Search Tool box -->
      <div class="row bg-light p-0 border" style="margin: auto;">

        <div class="col-md-2 px-2">
          <div>
            &nbsp;
          </div>
          <div>
            <button class="btn btn-light btn-sm border text-info rounded-circle" wire:click.prevent="previousDay">
              <i class="fas fa-arrow-left"></i>
            </button>
    
            <button class="btn btn-light btn-sm border text-info rounded-circle" wire:click.prevent="nextDay">
              <i class="fas fa-arrow-right"></i>
            </button>
          </div>
        </div>

        <div class="col-md-4 p-0 bg-info-x border text-muted">
          <div>
            <div class="mx-2">
              Start Date
            </div>
            <div>
              <input type="date" class="form-control" wire:model.defer="searchStartDate" />
            </div>
          </div>
        </div>

        <div class="col-md-4 p-0 bg-info-x border text-muted">
          <div>
            <div class="mx-2">
              End Date
            </div>
            <div>
              <input type="date" class="form-control" wire:model.defer="searchEndDate" />
            </div>
          </div>
        </div>


        <div class="col-md-1 px-2">
          <div>
            <div>
              &nbsp;
            </div>
            <div>
              <button class="btn btn-info" wire:click="render">
                Go
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Search Tool box -->
    @endif


    <div class="clearfix m-3">
      <div class="float-left text-info mr-4">
        <strong>
          @if ($searchStartDate == \Carbon\Carbon::today()->toDateString())
            Today
          @elseif ($searchStartDate == \Carbon\Carbon::yesterday()->toDateString())
            Yesterday
          @else
            {{ $searchStartDate }}
          @endif
        </strong>
        <span class="text-muted" style="font-size:12px;">
            {{ \Carbon\Carbon::create($searchStartDate)->format('l') }}
        </span>
      </div>

      @if ($searchEndDate !== null)
        <div class="float-left text-info">
          <strong>
            @if ($searchEndDate == \Carbon\Carbon::today()->toDateString())
              Today
            @elseif ($searchEndDate == \Carbon\Carbon::yesterday()->toDateString())
              Yesterday
            @else
              {{ $searchEndDate }}
            @endif
          </strong>
          <span class="text-muted" style="font-size:12px;">
              {{ \Carbon\Carbon::create($searchEndDate)->format('l') }}
          </span>
        </div>
      @endif
    </div>

    <div class="px-3">
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


</div>
