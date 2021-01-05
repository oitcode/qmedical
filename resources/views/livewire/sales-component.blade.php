@extends('layouts.card-component')

@section('cardTitle', 'Sales')

@section ('cardTools')
  @if (false)
    <button class="btn btn-sm btn-outline-success px-3" wire:click="">
      <i class="fas fa-plus"></i>
    </button>

    <button class="btn btn-sm text-danger" wire:click="">
      <i class="fas fa-power-off">
      </i>
    </button>
    <button class="btn btn-sm text-primary" wire:click="">
      <i class="fas fa-ellipsis-h">
      </i>
    </button>
  @endif

  <input type="date" wire:model.defer="searchDate" />
  <button class="btn btn-sm btn-outline-info" wire:click="setSearchDate">
    Go
  </button>

  <button class="btn btn-outline-info btn-sm border rounded-circle" wire:click.prevent="previousDay">
    <i class="fas fa-arrow-left"></i>
  </button>

  <button class="btn btn-outline-info btn-sm border rounded-circle" wire:click.prevent="nextDay">
    <i class="fas fa-arrow-right"></i>
  </button>

  <button type="button" class="btn btn-tool" data-card-widget="collapse">
    <i class="fas fa-minus"></i>
  </button>

  @if (false)
  <span class="">
      <input type="text" wire:model.defer="" wire:keydown.enter="" class="">
      <button class="btn btn-sm text-success text-bold" wire:click="">
        Go
      </button>
  </span>
  @endif
@endsection

@section('cardBody')
  @if (true)
  <div class="row py-2" style="margin:auto;">
    <div class="col-md-6 px-2 text-dark">
      @if ($searchDate == \Carbon\Carbon::today())
        Today
      @elseif ($searchDate == \Carbon\Carbon::yesterday())
        Yesterday
      @else
        {{ $searchDate->toDateString() }}
      @endif
    </div>
    <div class="col-md-6 px-2">
      @if (false)
        <strong>
          {{ $salesTotal }}
        </strong>
      @endif
    </div>
  </div>
  @endif

  <!-- Cash Sales -->
  <div class="row py-2 bg-light border" style="margin:auto;">
    <div class="col-md-6 px-2 text-dark">
      <strong>
        Cash
      </strong>
    </div>
    <div class="col-md-6 px-2">
      <strong>
        {{ $cashSalesTotal }}
      </strong>
    </div>
  </div>

  @if (count($cashSales) > 0)
    <div class="table-responsive">
      <table class="table table-sm table-hover table-valign-middle">
        <thead>
          <tr class="text-muted">
            <th>Id</th>
            <th>Patient</th>
            @if (false)
            <th>Test type</th>
            @endif
            <th>Amount</th>
          </tr>
        </thead>
        <tbody>
            @foreach($cashSales as $payment)
            <tr >
              <td>
                {{ $payment->medicalTest->medical_test_id }}
              </td>
              <td>
                <a href="" wire:click.prevent="" class="text-dark">
                  {{ $payment->medicalTest->patient->name }}
                </a>
              </td>
              @if (false)
              <td>
                {{ $payment->medicalTest->medicalTestType->name }}
              </td>
              @endif
              <td>
                {{ $payment->amount }}
              </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  @else
    <div class="p-3 text-muted">
      <small>
        No Cash Sales
      </small>
    </div>
  @endif


  <!-- Credit Sales -->
  <div class="row bg-light py-2 border" style="margin:auto;">
    <div class="col-md-6 px-2 text-dark">
      <strong>
        Credit
      </strong>
    </div>
    <div class="col-md-6 px-2">
      <strong>
        {{ $creditSalesTotal }}
      </strong>
    </div>
  </div>

  @if (count($creditSales) > 0)
    <div class="table-responsive">
      <table class="table table-sm table-hover table-valign-middle">
        <thead>
          <tr class="text-muted">
            <th>Id</th>
            <th>Patient</th>
            @if (false)
            <th>Test type</th>
            @endif
            <th>Amount</th>
          </tr>
        </thead>
        <tbody>
            @foreach($creditSales as $medicalTest)
            <tr class="">
              <td>
                {{ $medicalTest->medical_test_id }}
              </td>
              <td>
                <a href="" wire:click.prevent="" class="text-dark">
                  {{ $medicalTest->patient->name }}
                </a>
              </td>
              @if (false)
              <td>
                {{ $medicalTest->medicalTestType->name }}
              </td>
              @endif

              <td>
                {{ $medicalTest->credit_amount }}
              </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  @else
    <div class="p-3 text-muted">
      <small>
        No Credit Sales
      </small>
    </div>
  @endif

  @if (false)
    @livewire('due-received-component', ['searchDate' => $searchDate])
  @endif

  <!-- DUES RECEIVED -->
  <div class="row bg-light p-2 border mx-0">
    <div class="col-md-6 text-dark">
      <strong>
        Dues Received
      </strong>
    </div>
    <div class="col-md-6">
      <strong>
        {{ $dueReceivedTotal }}
      </strong>
    </div>
  </div>

  @if (count($duesReceived) > 0)
    @php
      $showDuePayment = false;
      $showLoanPayment = false;

      foreach ($duesReceived as $payment) {
          if ($payment->medicalTest) {
              $showDuePayment = true;
              break;
          }
      }

      foreach ($duesReceived as $payment) {
          if ($payment->agentLoan) {
              $showLoanPayment = true;
              break;
          }
      }
    @endphp

    @if ($showDuePayment)
      <div class="table-responsive">
        <table class="table table-sm table-hover">
          <thead>
            <tr class="text-muted">
              <th>Date</th>
              <th>Id</th>
              <th>Patient</th>
              @if (false)
              <th>Test type</th>
              @endif
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($duesReceived as $payment)
              @if ($payment->agentLoan)
                @continue
              @endif
              <tr>
                <td>
                  {{ $payment->medicalTest->date }}
                </td>
                <td>
                  {{ $payment->medicalTest->medical_test_id }}
                </td>
                <td>
                  {{ $payment->medicalTest->patient->name }}
                </td>

                @if (false)
                <td>
                </td>
                @endif

                <td>
                  {{ $payment->amount }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif

    @if ($showLoanPayment)
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr class="text-muted">
              <th></th>
              <th>Agent</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($duesReceived as $payment)
              @if ($payment->medicalTest)
                @continue
              @endif
              <tr>
                <td class="text-muted">
                  <small>
                    Opening
                  </small>
                </td>
                <td>
                  {{ $payment->agentLoan->agent->name  }}
                </td>
                <td>
                  {{ $payment->amount }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  @else
    <div class="text-muted p-3">
      <small>
        No dues received
      </small>
    </div>
  @endif

@endsection
