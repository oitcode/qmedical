@extends('layouts.card-component')

@section('cardTitle', 'Sales')

@section ('cardTools')
  <button class="btn btn-sm btn-outline-success px-3" wire:click="">
    <i class="fas fa-plus"></i>
  </button>

  @if (true)
    <button class="btn btn-sm text-danger" wire:click="">
      <i class="fas fa-power-off">
      </i>
    </button>
  @else
    <button class="btn btn-sm text-primary" wire:click="">
      <i class="fas fa-ellipsis-h">
      </i>
    </button>
  @endif

  <a href="#" class="btn btn-tool btn-sm" wire:click.prevent="previousDay">
    <i class="fas fa-arrow-left"></i>
  </a>

  <a href="#" class="btn btn-tool btn-sm" wire:click.prevent="nextDay">
    <i class="fas fa-arrow-right"></i>
  </a>

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
  <div class="row bg-info py-2" style="margin:auto;">
    <div class="col-md-6 px-2">
      @if ($searchDate == \Carbon\Carbon::today())
        Today
      @elseif ($searchDate == \Carbon\Carbon::yesterday())
        Yesterday
      @else
        {{ $searchDate->toDateString() }}
      @endif
    </div>
    <div class="col-md-6 px-2">
      Total: {{ $salesTotal }}
    </div>
  </div>

  <div class="card-body table-responsive p-0">
    <table class="table table-striped table-hover table-valign-middle">
      <thead>
        <tr class="sr-only">
        </tr>
      </thead>
      <tbody>
        @if (count($sales) > 0)
          @foreach($sales as $medicalTest)
          <tr >
              <td>
                {{ $medicalTest->medical_test_id }}
              </td>
              <td>
                <a href="" wire:click.prevent="" class="text-dark">
                  {{ $medicalTest->patient->name }}
                </a>
              </td>
              <td>
                {{ $medicalTest->medicalTestType->name }}
              </td>
              <td>
                {{ $medicalTest->price }}
              </td>
              <td>
                <span class="btn btn-tool btn-sm" wire:click="">
                  <i class="fas fa-pencil-alt text-primary mr-3"></i>
                </span>
                @can ('delete-models')
                  <span class="btn btn-tool btn-sm">
                    <i class="fas fa-trash text-danger mr-3" wire:click=""></i>
                  </span>
                @endcan
              </td>
          </tr>
          @endforeach
        @else
          No Sales
        @endif
      </tbody>
    </table>
  </div>
@endsection
