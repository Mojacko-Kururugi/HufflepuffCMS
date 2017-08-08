@extends('layouts.master')

@section('content')

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Dashboard</h5>
  </div>
</div>

<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
 
  <div class="row">
    <div class="col s12 m12 l7">
      <div class="card-panel">
        <span class="card-title">Inventory status</span>
        <hr>
        <div class="card-content">
          @if($inv != null)
          <p>
            These items are branch's <span class="green-text bold">current available</span> stocks.
          </p>
          <table class="centered">
            <thead>
              <tr>
                <th>Name</th>
                <th>Model</th>
                <th>Qty</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
            @foreach($inv as $inv)
             <tr>
                <td>{{ $inv->strProdName }}</td>
                <td>{{ $inv->strProdModel }}</td>
                <td>{{ $inv->sum }}</td>
                <td>
                  <div class="center-btn">
                    <a class="waves-effect waves-light btn btn-small center-text" href="/inventory/order">Order</a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        @else
         <p> You have <span class="red-text bold">no inventory</span> on your branch.</p>
        @endif
        </div>
      </div>
	  <!-- dito un next na nawala -->
    


    </div>
    <div class="col s12 m12 l5">
      <div class="card-panel">
        <span class="card-title">Pending Appointments</span>
        <hr>
        <div class="card-content">
        @if($req != null)
          <p>
            You have pending appointments.
          </p>
          <table class="centered table-fixed">
            <thead>
              <tr>
                <th>Patient</th>
                <th>Concern</th>
                <th>Date and Time</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
              @foreach($req as $req)
              <tr>
              <td>{{ $req->strPatLast . ', ' . $req->strPatFirst }}</td>
               <td>{{ $req->strSchedHeader }}</td>
                <td>{{ $req->dtSchedDate . ' - ' . $req->tmSchedTime }}</td>
                <td>
                  <div class="center-btn">
                    <a class="waves-effect waves-light btn btn-small green center-text">Accept</a>
                    <a class="waves-effect waves-light btn btn-small red center-text">Decline</a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <p>
            You have no pending requests.
          </p>
          @endif
        </div>
      </div>


    </div>
  </div>
</div>
@stop
