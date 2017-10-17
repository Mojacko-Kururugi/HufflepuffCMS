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
        <span class="card-title">Appointments</span>
        <hr>
        <div class="card-content">
          @if($app != null)
          <p>
            These are your <span class="green-text bold">UPCOMING</span> appointments.
          </p>
          <table class="centered">
            <thead>
              <tr>
                <th>Patient</th>
                <th>Concern and Details</th>
                <th>Date and Time</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
            @foreach($app as $app)
             <tr>
                <td>{{ $app->strPatLast . ', ' . $app->strPatFirst }}</td>
                <td>{{ $app->strSchedHeader . ' - ' . $app->strSchedDetails }}</td>
                <td>{{ $app->dtSchedDate . ' - ' . $app->tmSchedTime }}</td>
                <td>
                  <div class="center-btn">
                    <a class="waves-effect waves-light btn btn-small center-text" href="/cano-sched/{{$app->intSchedID}}">CANCEL</a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        @else
         <p> You have <span class="red-text bold">no upcoming</span> appointments.</p>
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
                    <a class="waves-effect waves-light btn btn-small green center-text" href="/app-sched/{{$req->intSchedID}}">Accept</a>
                    <a class="waves-effect waves-light btn btn-small red center-text" href="/dec-sched/{{$req->intSchedID}}">Decline</a>
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
