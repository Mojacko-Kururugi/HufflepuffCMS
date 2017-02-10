@extends('layouts.patient-master')

@section('content')

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Optical Records</h5>
  </div>
</div>

      <div class="main-wrapper">
        <!-- ACTUAL PAGE CONTENT GOES HERE --> 
        <div class="container-fluid">
          <div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <span class="card-title">Your Records</span>
                <hr>
                <br>
                <div class="card-content">
                  
                  </div>

                  <div class="col s12 m12 l12 overflow-x">
                    <table class="centered">
                      <thead>
                        <tr>
                          <th>Service ID</th>
                          <th>Details</th>
                         <!--  <th>Brand</th>
                          <th>Model</th> -->
                          <th>Time</th>
                          <th>Date</th>
                          <th>Payment Status</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td>SVR6850</td>
                          <td>Optical Check Up</td>
                          <td>4:30pm</td>
                          <td>12/24/2016</td>
                          <td class="green-text bold">Fully Paid</td>
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

