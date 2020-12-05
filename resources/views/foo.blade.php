@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Component test</h1>
@stop

@section('content')
  @livewire('parent-component')

@stop
