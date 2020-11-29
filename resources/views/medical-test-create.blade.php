@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Medical Test Create</h1>
@stop

@section('content')
  @if (session()->has('message'))
      <div class="alert alert-success">
          {{ session('message') }}
      </div>
  @endif
  @isset($edit)
    @livewire('medical-test-create-component', ['medicalTest' => $medicalTest, 'editMode' => true])
  @else
    @livewire('medical-test-create-component')
  @endisset
@stop
