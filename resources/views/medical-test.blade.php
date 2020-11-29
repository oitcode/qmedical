@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Medical Test</h1>
@stop

@section('content')
  @if (session()->has('message'))
      <div class="alert alert-success">
          {{ session('message') }}
      </div>
  @endif
  @livewire('medical-test-component')
@stop
