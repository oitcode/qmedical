@extends('layouts.card-component')

@section('cardTitle', 'Office Pending')

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

  <button class="btn btn-light btn-sm border" wire:click.prevent="">
    <i class="fas fa-arrow-left"></i>
  </button>

  <button class="btn btn-light btn-sm border" wire:click.prevent="">
    <i class="fas fa-arrow-right"></i>
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
  <div class="text-info"> 
    No office pending
  </div>
@endsection
