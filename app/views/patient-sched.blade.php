@extends('layouts.patient-master')

@section('content')
      <div class="main-wrapper">
        <!-- ACTUAL PAGE CONTENT GOES HERE -->
        <div class="row">
          <div class="col s12 m12 l12">
            <span class="page-title">Appointments and Events</span>
          </div>

          <div class="row">
      <div class="col s12 m12 l6">
        <div class="col s12 m12 l10">

            <button class="modal-trigger waves-effect waves-light btn btn-small center-text" href="#newprod">REQUEST AN APPOINTMENT</button>

        </div>
      </div>
     </div>

  


          <div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <span class="card-title">Your Schedules</span>
                <div class="divider"></div>
                <div class="card-content">
                  
                  </div>

                  <div class="col s12 m12 l12 overflow-x">
                    <table class="centered">
                      <thead>
                        <tr>
                          <th>Appointment ID</th>
                          <th>Details</th>
                         <!--  <th>Brand</th>
                          <th>Model</th> -->
                          <th>Time</th>
                          <th>Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td>APT0548</td>
                          <td>Appointment with Mr. Gallardo</td>
                          <td>4:30pm</td>
                          <td>01/11/2017</td>
                          <td class="green-text bold">Approved</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- <p>
                    You have no items.
                  </p> -->

                  <div class="clearfix">

                  </div>
                </div>
              </div>
            </div>
          </div>

@stop

@section('scripts')
<!--{{ HTML::script('js/new-order.js') }}-->
<script type="text/javascript" src="js/jquery.js"></script>
<script src="js/materialize.js"></script>
<script>   
    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  }); 
</script>
@stop

