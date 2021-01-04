@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pending</h1>
@stop

@section('content')
  @livewire('pending-bill-list-component')
@stop
