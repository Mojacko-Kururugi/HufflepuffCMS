@extends('layouts.master')

@section('content')
<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
 
  <div class="row">
    <div class="col s12 m12 l12">
      <span class="page-title">Dashboard</span>
    </div>



    <div class="col s12 m12 l8">
      <div class="card-panel">
        <span class="card-title">Inventory status</span>
        <div class="divider"></div>
        <div class="card-content">
          <p>
            These items are in <span class="red-text bold">low</span> stocks.
          </p>

          <table class="centered">
            <thead>
              <tr>
                <th>Batch ID</th>
                <th>Item</th>
                <th>Qty</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>

             <tr>
                <td>INV002</td>
                <td>Lens 2923</td>
                <td>0</td>
                <td>
                  <div class="center-btn">
                    <a class="waves-effect waves-light btn btn-small center-text" href="/neworder">Replenish</a>
                    <!-- <a class="waves-effect waves-light btn btn-small center-text">Request</a> -->
                  </div>
                </td>
              </tr>
              
              <tr>
                <td>INV003</td>
                <td>Model 0734</td>
                <td>2</td>
                <td>
                  <div class="center-btn">
                    <a class="waves-effect waves-light btn btn-small center-text" href="/neworder">Replenish</a>
                    <!-- <a class="waves-effect waves-light btn btn-small center-text">Request</a> -->
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        
         <!-- <p> All of your items are in <span class="green-text bold">good</span> stocks.</p> -->
        
        </div>
      </div>

      <div class="card-panel">
        <span class="card-title">Incoming schedules/appointments</span>
        <div class="divider"></div>
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
    <div class="col s12 m12 l4">
      <div class="card-panel">
        <span class="card-title">Pending appointments</span>
        <div class="divider"></div>
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
                    <a class="waves-effect waves-light btn btn-small green center-text"><i class="mdi-navigation-check"></i></a>
                    <a class="waves-effect waves-light btn btn-small red center-text"><i class="mdi-navigation-close"></i></a>
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
