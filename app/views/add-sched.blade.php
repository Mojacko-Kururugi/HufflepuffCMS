@extends('layouts.master')

@section('content')

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Add New Schedule</h5>
  </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-content">

      <div class="contents">
        <div class="container-fluid">
          <form action="{{ URL::to('teacher/save-profile-edit') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
             <!-- Date & Time -->
            <div class="row">
                  <div class="col s12 m8 l6">
                       <label for="a_time">Time:</label>
                        <select name="time_frequency">
                          <option value="" selected disabled>- Choose Time -</option>
                          <option value="1">9:00am</option>
                          <option value="2">10:00am</option>
                          <option value="3">11:00am</option>
                          <option value="4">12:00am</option>
                          <option value="5">1:00pm</option>
                          <option value="6">2:00pm</option>
                          <option value="7">3:00pm</option>
                          <option value="8">4:00pm</option>
                          <option value="9">5:00pm</option>
                          <option value="10">6:00pm</option>
                          <option value="11">7:00pm</option>
                          <option value="12">8:00pm</option>
                        </select>
                  </div>
            </div>

            <div class="row">
              <div class="col s12 m8 l6">
                <label for="b_day">Choose Date</label>
                <input id="b_day" name="b_day" type="date" class="datepicker" style="height:39px" value="">
              </div>
            </div>  


            <div class="row">
                   <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="patient" id="patient" data-error=".school_error">
                          <option value="" disabled selected>Patient Name</option>
                          @foreach($data as $data)
                            <option value="{{ $data->intPatID}}" @if(Input::old('patient') == $data->intPatID) selected="selected" @endif>{{ $data->strPatLast . ',' . $data->strPatFirst }}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>
              </div>
                <div class="row">
                  <div class="col s12">
                    <label for="time_frequency">Time Frequency of Reminder</label>
                    <select name="time_frequency">
    				     <option value="" selected disabled>- Choose Option -</option>
    				     <option value="1">Every 30 mins</option>
    					 <option value="2">Every 1 hour</option>
    					 <option value="3">Every 4 hours</option>
    					 <option value="4">Day before</option>
    					 <option value="5">Week before</option>
    				       </select>
                  </div>
                </div>
                </div>

                <div class="row">
                  <div class="input-field col s12 center">
                    <button type="submit" class="waves-effect waves-light btn blue darken-1 modal-btn">Save</button>
                    <a href="{{ URL::to('/schedules') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
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
<script type="text/javascript" src="js/jquery.js">
  var date = new Date();
  var nameRegex = /^([ \u00c0-\u01ffa-zA-Z'\-])+$/;
  var contactRegex = /((\+63)|0)\d{10}/;

  $(document).ready(function() {
    $('#b_day').pickadate({
      format: "yyyy-mm-dd",
      selectYears: true,
      selectMonths: true,
      selectYears: 100, // scroll shits of years
      min: new Date(1929,12,31),
      max: new Date(2009,12,01)
    });


    $('#user_image_input').on('change', function() {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#image_div').attr('src', e.target.result);
      };

      reader.readAsDataURL(this.files[0]);
    });

    $.validator.addMethod("regex", function(value, element, regexp) {
      return regexp.test(value);
    }, "Please enter a valid format.");

    $('#signup_validate').validate({
      rules: {
        stud_id_no: {
          required: true
        },
        
        user_type: "required",

        first_name_sa: {
          required: true,
          regex: nameRegex
        },

        // middle_name_sa: {
        //   regex: nameRegex
        // },

        last_name_sa: {
          required: true,
          regex: nameRegex
        },

        school: "required",

        gender: "required",

        b_day: {
          required: true
        },

        number: {
          required: true,
          regex: contactRegex
        },

        address: {
          required: true
        },

      },
      errorElement: 'div'
    });
  });

// function alphaOnly(event) {
//   var key = event.keyCode;
//   return ((key >= 65 && key <= 90) || key == 8 || key == 32);
// };
</script>
{{-- Scripts END --}}
@endsection