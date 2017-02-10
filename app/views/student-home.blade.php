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

                <button class="modal-trigger waves-effect waves-light btn btn-small center-text" href="#newprod">REQUEST AN APPOINTMENT</button>

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

        $('#calendar').fullCalendar({
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            now: '2017-01-07',
            editable: true, // enable draggable events
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
                { id: 'a', title: 'Reserved Check Ups', eventColor: 'red' },
                { id: 'b', title: 'Follow-Up Check Ups', eventColor: 'red' },
                { id: 'c', title: 'Doctor is Out', eventColor: 'black' },
                { id: 'd', title: 'Repairs', children: [
                    { id: 'd1', title: 'Repairs with Check-up', eventColor: 'blue' },
                    { id: 'd2', title: 'Repairs only', eventColor: 'blue' }
                ] },
            ],
            events: [
                { id: '1', resourceId: 'b', start: '2017-01-07T10:30:00', end: '2017-01-07T11:00:00', title: 'Unavailable' },
                { id: '2', resourceId: 'c', start: '2017-01-07T12:00:00', end: '2017-01-07T13:30:00', title: 'Lunch Break' },
                { id: '3', resourceId: 'd2', start: '2017-01-07T16:00:00', end: '2017-01-07T16:30:00', title: 'Unavailable' },
                { id: '4', resourceId: 'a', start: '2017-01-07T09:00:00', end: '2017-01-07T10:00:00', title: 'Unavailable' },
                { id: '5', resourceId: 'a', start: '2017-01-07T11:00:00', end: '2017-01-07T12:00:00', title: 'Unavailable' },
                { id: '6', resourceId: 'a', start: '2017-01-11T16:30:00', end: '2017-01-11T18:00:00', title: 'Your Meeting Approved' },
                { id: '7', resourceId: 'c', start: '2017-01-09', end: '2017-01-09', title: 'Holiday' }
            ]
        });
    
    });

</script>
@stop

