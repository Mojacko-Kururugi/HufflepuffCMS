@extends('layouts.patient-master')

@section('content')

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Home</h5>
  </div>
</div>


<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->

    <div class="row">
      <div class="col s12 m12 l6">
       <a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/patient-schedules/req">REQUEST AN APPOINTMENT</a>
      </div>
    </div>

    <div class="row">
      <div class="col s12 m12 l12">
        <div class="card-panel">
          <span class="card-title">Your Schedules</span>
          <hr>
          <br>
          <div class="card-content">

              <div class="col s12 m12 l12 overflow-x">
                <table class="centered">
                  <thead>
                    <tr>
                      <th>Scheduled Doctor</th>
                      <th>Schedule Header</th>
                     <!--  <th>Brand</th>
                      <th>Model</th> -->
                      <th>Date</th>
                      <th>Time</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
              @foreach($app as $app)
                    <tr>
                      <td>{{ $app->strDocLast . ', ' . $app->strDocFirst }}</td>
                      <td>{{ $app->strSchedHeader }}</td>
                      <td>{{ $app->dtSchedDate }}</td>
                      <td>{{ $app->tmSchedTime }}</td>
                      @if($app->intSchedStatus == 1)
                      <td class="green-text bold">Approved</td>
                      @elseif($app->intSchedStatus == 2)
                      <td class="orange-text bold">Pending</td>
                      @elseif($app->intSchedStatus == 3)
                      <td class="red-text bold">Declined</td>
                      @elseif($app->intSchedStatus == 5)
                      <td class="red-text bold">You Cancelled</td>
                      @elseif($app->intSchedStatus == 6)
                      <td class="red-text bold">Optometrist Cancelled</td>
                      @endif
                      @if($app->intSchedStatus == 1)
                      <td><a class="waves-effect waves-light btn btn-small red center-text" href="/can-sched/{{$app->intSchedID}}">Cancel</a>
                      <a class="waves-effect waves-light btn btn-small blue center-text" href="/re-sched/{{$app->intSchedID}}">Re-Sched</a></td>
                      @elseif($app->intSchedStatus == 2)
                      <td><a class="waves-effect waves-light btn btn-small blue center-text" href="/ed-sched/{{$app->intSchedID}}">Edit</a></td>
                      @elseif($app->intSchedStatus == 3)
                      <td></td>
                      @endif
                    </tr>
              @endforeach
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

