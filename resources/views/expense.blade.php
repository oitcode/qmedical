@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Expense</h1>
@stop

@section('content')
             @if (session()->has('message'))
                 <div class="alert alert-success">
                     {{ session('message') }}
                 </div>
             @endif
             @livewire('expense-component')
@stop
