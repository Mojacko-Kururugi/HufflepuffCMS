@extends('layouts.patient-master')

@section('content')

 <link href="css/fullcalendar.min.css" type="text/css" rel="stylesheet" />
  <link href="css/fullcalendar.print.css" type="text/css" rel="stylesheet" media="print"/>
    <link href='css/scheduler.min.css' rel='stylesheet' />
    
<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Schedules and Appointments</h5>
  </div>
</div>

<div class="main-wrapper">
        <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <div class="container-fluid">
    <div class="card">
      <div class="card-content">

        <div class="row">
          <div class="col s12 m12 l6">
            <div class="col s12 m12 l10">

                <a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/patient-schedules/req">REQUEST AN APPOINTMENT</a>

            </div>
          </div>
        </div>
        <div class="nav-wrapper">
          <div class="container-fluid">
              <div id='calendar'></div>
              <br>
          </div>
        <!-- dito naman yung mga susunod na shits kung may idadagdag pa ^_^ -->
        </div>

      </div>
    </div>
  </div>
</div>

@stop

@section('scripts')
<script src="js/moment.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/fullcalendar.min.js"></script>
  <script src="js/scheduler.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>


<script>

    $(function() { // document ready

        var evt = [
            <?php foreach ($data as $data): ?>
                    {
                       <?php if ($data->intSchedStatus == 2 && $data->intSchedPatient != Session::get('user_code')): ?>
                          resourceId: 'c',
                        title  : ' ',
                        start  : ' '
                      <?php elseif ($data->intSchedPatient != Session::get('user_code')): ?>
                        resourceId: 'c',
                        title  : 'UNAVAILABLE',
                        start  : '<?php echo $data->dtSchedDate ?>T<?php echo $data->tmSchedTime ?>'
                       <?php elseif ($data->intSchedStatus == 2 && $data->intSchedPatient == Session::get('user_code')): ?>
                        resourceId: 'b',
                        title  : '<?php echo $data->strSchedHeader ?>',
                        start  : '<?php echo $data->dtSchedDate ?>T<?php echo $data->tmSchedTime ?>'
                        <?php elseif ($data->intSchedStatus == 1 && $data->intSchedPatient == Session::get('user_code')): ?>
                        resourceId: 'a',
                        title  : '<?php echo $data->strSchedHeader ?>',
                        start  : '<?php echo $data->dtSchedDate ?>T<?php echo $data->tmSchedTime ?>'
                      <?php endif; ?>
                    },
            <?php endforeach; ?>
        ];

        var dt = Date.now() + 86400000;

        $('#calendar').fullCalendar({
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            now: dt,
            editable: false, // enable draggable events
            aspectRatio: 1.8,
            scrollTime: '00:00', // undo default 6am scrollTime
            minTime: "09:00:00",
            maxTime: "22:00:00",
            header: {
                left: 'today prev,next',
                center: 'title',
                right: 'agendaWeek'
            },
            defaultView: 'agendaWeek',
            resourceLabelText: 'Activity',
            resources: [
                { id: 'a', title: 'Reserved Check Ups', eventColor: 'green' },
                { id: 'b', title: 'Follow-Up Check Ups', eventColor: 'orange' },
                { id: 'c', title: 'Doctor is Out', eventColor: 'black' },
                { id: 'd', title: 'Repairs', children: [
                    { id: 'd1', title: 'Repairs with Check-up', eventColor: 'blue' },
                    { id: 'd2', title: 'Repairs only', eventColor: 'blue' }
                ] },
            ],
            events: evt
        });
    
    });

</script>
@stop

