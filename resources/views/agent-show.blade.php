@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agent Detail</h1>
@stop

@section('content')

<div class="row">
  <!-- Main Column -->
  <div class="col-md-8">
    <div class="row">
      <!-- Contact Column -->
      <div class="col-md-3">
        <h3 class="text-primary"><i class="fas fa-user mr-3"></i>{{ $agent->name}}</h3>

        <ul class="list-unstyled">
          <li>
            <a href="" class="btn-link text-secondary">
              <i class="fas fa-map mr-3"></i>
              {{ $agent->address}}
            </a>
          </li>
          <li>
            <a href="" class="btn-link text-secondary">
              <i class="fas fa-envelope mr-3"></i>
              {{ $agent->email }}
            </a>
          </li>
          <li>
            <a href="" class="btn-link text-secondary">
              <i class="fas fa-phone mr-3"></i>
              {{ $agent->contact_number }}
            </a>
          </li>
        </ul>
      </div>

      <div class="col-md-3">
        <div class="info-box bg-light">
          <div class="info-box-content">
            <span class="info-box-text text-center text-muted">Total referral</span>
            <span class="info-box-number text-center text-muted mb-0">2300</span>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="info-box bg-light">
          <div class="info-box-content">
            <span class="info-box-text text-center text-muted">Commission Paid</span>
            <span class="info-box-number text-center text-muted mb-0">2000</span>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="info-box bg-light">
          <div class="info-box-content">
            <span class="info-box-text text-center text-muted">Pending</span>
            <span class="info-box-number text-center text-muted mb-0">20 <span>
          </div>
        </div>
      </div>

    </div>


    <hr />

    <h3>Referred Tests</h3>

    <table class="table table-hover text-nowrap table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Date</th>
          <th>Patient</th>
          <th>Price</th>
          <th>Commission</th>
          <th>Commission Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($agent->medicalTests as $medicalTest)
          <tr>
            <td>
              {{ $medicalTest->medical_test_id }}
            </td>
            <td>
              {{ $medicalTest->date }}
            </td>
            <td>
              {{ $medicalTest->patient->name }}
            </td>
            <td>
              {{ $medicalTest->price }}
            </td>
            <td>
              {{ $medicalTest->agent_commission }}
            </td>
            <td>
              {{ $medicalTest->agent_commission_status }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</div>

@stop
