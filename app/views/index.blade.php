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
          <p>
            These items are branch's <span class="green-text bold">current</span> stocks.
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
                    <a class="waves-effect waves-light btn btn-small center-text" href="/neworder">Order</a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        
         <!-- <p> All of your items are in <span class="green-text bold">good</span> stocks.</p> -->
        
        </div>
      </div>

      <div class="card-panel">
        <span class="card-title">Incoming schedules/appointments</span>
        <hr>
        <div class="card-content">
          <p>
            You have 1 notification.
          </p>
          <table class="centered table-fixed">
            <thead>
              <tr>
                <th>Event</th>
                <th>Date</th>
                <th>Time</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>Appointment with Mr. Gallardo</td>
                <td>01/11/2016</td>
                <td>4:30pm</td>
              </tr>
            </tbody>
          </table>

          <!-- <p>
            You have no incoming requests.
          </p> -->
        </div>
      </div>


    </div>
    <div class="col s12 m12 l5">
      <div class="card-panel">
        <span class="card-title">Pending appointments</span>
        <hr>
        <div class="card-content">
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
              <tr>
              <td>Amac, Pamela</td>
               <td>Walk in Check up</td>
                <td>01/23/2016 10:30am</td>
                <td>
                  <div class="center-btn">
                    <a class="waves-effect waves-light btn btn-small green center-text">Accept</a>
                    <a class="waves-effect waves-light btn btn-small red center-text">Decline</a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- <p>
            You have no pending orders.
          </p> -->
        </div>
      </div>


    </div>
  </div>
</div>
@stop
