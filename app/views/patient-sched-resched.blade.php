@extends('layouts.patient-master')

@section('content')

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Request New Schedule</h5>
  </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-content">

      <div class="contents">
        <div class="container-fluid">
          <form action="{{ URL::to('patient-schedules/resched') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
             <!-- Date & Time -->
            <div class="row">
                  <div class="col s12 m8 l6">
                        Select a time*:
                        <input type="time" name="time" id="time" value="{{$ex->tmSchedTime}}">
                  </div>
            </div>

            <div class="row">
              <div class="col s12 m8 l6">
                <label for="date">Choose Date*</label>
                <input id="date" name="date" type="date" class="datepicker" style="height:39px" value="{{$ex->dtSchedDate}}">
              </div>
            </div>  


                </div>

                <div class="row">
                  <div class="input-field col s12 center">
                    <button type="submit" class="waves-effect waves-light btn blue darken-1 modal-btn">Save</button>
                    <a href="{{ URL::to('/patient-schedules') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div> 
      </div>
    </div>
  </div>
</div>

{{-- Scripts START --}}
<script src="js/materialize.js"></script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">


  $().ready(function() {

    if (!Modernizr.touch || !Modernizr.inputtypes.date) {
        $('input[type=date]')
            .attr('type', 'text')
            .datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 1,
            });
    }

    jQuery.validator.addMethod("timey", function(value, element) {
        var hour = parseInt(value.substring(0,2));
        return hour > 8 && hour < 21;
    }, "Invalid time");

    $("#signup_validate").validate({
      rules: {
        time: {
          timey: true,
          required: true,
          rangelength: [2, 6]
          },  
          date: {
            required: true,
          },
          doctor: 'required',
          name: 'required'

      },
      errorElement: 'div'
    });
  });

</script>
{{-- Scripts END --}}
@endsection