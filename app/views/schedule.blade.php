@extends('layouts.master')

@section('content')


<link href="css/fullcalendar.min.css" type="text/css" rel="stylesheet" />
<link href="css/fullcalendar.print.css" type="text/css" rel="stylesheet" media="print"/>
<link href='css/scheduler.min.css' rel='stylesheet' />
    
<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Schedules and Apppointments</h5>
  </div>
</div>

      <div class="main-wrapper">
        <!-- ACTUAL PAGE CONTENT GOES HERE -->
<?php
  if(Session::get('sched_mess') != null)
    {
      $message = "Time and Date is Unavailable!";
echo "<script type='text/javascript'>alert('$message');</script>";
      Session::forget('sched_mess');
    }
?>
        <div class="container-fluid">

          <div class="card">
            <div class="card-content">

              <div class="row">
                <div class="col s12 m12 l6">
                  <div class="col s12 m12 l10">

                     <!-- <button class="modal-trigger waves-effect waves-light btn btn-small center-text" href="#newprod">ADD NEW EVENT/APPOINTMENT</button> -->
          		   <a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/add-sched">ADD NEW EVENT/ APPOINTMENT</a>
                    <!--  <button class="modal-trigger waves-effect waves-light btn btn-small center-text" href="#viewprod">DELETE ALL</button> --> 
                  </div>
                </div>
              </div>
              <div class="nav-wrapper">
                  <div class="container-fluid">
                      <div id='calendar'></div>
                      <br>
                      <br>
                      <br>
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
                      <?php if ($data->intSchedStatus == 1): ?>
                        resourceId: 'a',
                       <?php elseif ($data->intSchedStatus == 2): ?>
                        resourceId: 'b',
                      <?php elseif ($data->intSchedStatus == 3): ?>
                        resourceId: 'c',
                      <?php elseif ($data->intSchedStatus == 5): ?>
                        resourceId: 'd',
                      <?php elseif ($data->intSchedStatus == 6): ?>
                        resourceId: 'd',
                      <?php endif; ?>
                        title  : '<?php echo $data->strSchedHeader ?>',
                        start  : '<?php echo $data->dtSchedDate ?>T<?php echo $data->tmSchedTime ?>'
                    },
            <?php endforeach; ?>
        ];

        var dt = Date.now();
// + 86400000
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
                right: 'timelineDay,agendaWeek,month,listWeek'
            },
            defaultView: 'agendaWeek',
            resourceLabelText: 'Activity',
            resources: [
                { id: 'a', title: 'Approved', eventColor: 'green' },
                { id: 'b', title: 'Pending', eventColor: 'orange' },
                { id: 'c', title: 'Declined', eventColor: 'red' },
                { id: 'd', title: 'Cancelled', eventColor: 'black' },
              //  { id: 'c', title: 'Doctor is Out', eventColor: 'black' },
              //  { id: 'd', title: 'Repairs', children: [
              //      { id: 'd1', title: 'Repairs with Check-up', eventColor: 'red' },
              //      { id: 'd2', title: 'Repairs only', eventColor: 'blue' }
              //  ] },
            ],
            events: evt
        });
    
    });

</script>
@stop

