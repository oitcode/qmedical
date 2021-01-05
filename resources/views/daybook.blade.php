@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Daybook</h1>
@stop

@section('content')
  @livewire('sales-component')
@stop
