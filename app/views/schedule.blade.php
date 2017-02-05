@extends('layouts.master')

@section('content')

 <link href="css/fullcalendar.min.css" type="text/css" rel="stylesheet" />
  <link href="css/fullcalendar.print.css" type="text/css" rel="stylesheet" media="print"/>
    <link href='css/scheduler.min.css' rel='stylesheet' />
    
      <div class="main-wrapper">
        <!-- ACTUAL PAGE CONTENT GOES HERE -->
        <div class="row">
          <div class="col s12 m12 l12">
            <span class="page-title">Schedules and Apppointments</span>
          </div>

          <div class="row">
      <div class="col s12 m12 l6">
        <div class="col s12 m12 l10">

           <!-- <button class="modal-trigger waves-effect waves-light btn btn-small center-text" href="#newprod">ADD NEW EVENT/APPOINTMENT</button> -->
		   <a class="modal-trigger waves-effect waves-light btn btn-small center-text" href="/add-sched">ADD NEW EVENT/APPOINTMENT</a>
          <!--  <button class="modal-trigger waves-effect waves-light btn btn-small center-text" href="#viewprod">DELETE ALL</button> --> 
        </div>
      </div>
     </div>
 <div class="nav-wrapper">
    <div class="container">
        <div id='calendar'></div>
        <br>
        <br>
        <br>
        <br>
    </div>
    <!-- dito naman yung mga susunod na shits kung may idadagdag pa ^_^ -->

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
                right: 'timelineDay,agendaWeek,month,listWeek'
            },
            defaultView: 'timelineDay',
            resourceLabelText: 'Activity',
            resources: [
                { id: 'a', title: 'Reserved Check Ups', eventColor: 'green' },
                { id: 'b', title: 'Follow-Up Check Ups', eventColor: 'orange' },
                { id: 'c', title: 'Doctor is Out', eventColor: 'black' },
                { id: 'd', title: 'Repairs', children: [
                    { id: 'd1', title: 'Repairs with Check-up', eventColor: 'red' },
                    { id: 'd2', title: 'Repairs only', eventColor: 'blue' }
                ] },
            ],
            events: [
                { id: '1', resourceId: 'b', start: '2017-01-07T10:30:00', end: '2017-01-07T11:00:00', title: 'De Guzman,N.' },
                { id: '2', resourceId: 'c', start: '2017-01-07T12:00:00', end: '2017-01-07T13:30:00', title: 'Lunch Break' },
                { id: '3', resourceId: 'd2', start: '2017-01-07T16:00:00', end: '2017-01-07T16:30:00', title: 'Lopez,J.' },
                { id: '4', resourceId: 'a', start: '2017-01-07T09:00:00', end: '2017-01-07T10:00:00', title: 'Felix,M.' },
                { id: '5', resourceId: 'a', start: '2017-01-07T11:00:00', end: '2017-01-07T12:00:00', title: 'Lopez,J.' },
                { id: '6', resourceId: 'a', start: '2017-01-11T16:30:00', end: '2017-01-11T18:00:00', title: 'Gallardo,J.' },
                { id: '7', resourceId: 'c', start: '2017-01-09', end: '2017-01-09', title: 'Holiday' }
            ]
        });
    
    });

</script>
@stop

