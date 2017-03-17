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
          <form action="{{ URL::to('patient-schedules/save') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
             <!-- Date & Time -->
            <div class="row">
                  <div class="col s12 m8 l6">
                        Select a time:
                        <input type="time" name="time" id="time">
                  </div>
            </div>

            <div class="row">
              <div class="col s12 m8 l6">
                <label for="date">Choose Date</label>
                <input id="date" name="date" type="date" class="datepicker" style="height:39px" value="">
              </div>
            </div>  


            <div class="row">
                   <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="doctor" id="doctor" data-error=".school_error">
                          <option value="" disabled selected>Doctor Name</option>
                          @foreach($data as $data)
                            <option value="{{ $data->intDocID}}" @if(Input::old('doctor') == $data->intDocID) selected="selected" @endif>{{ $data->strDocLast . ',' . $data->strDocFirst . ' (' . $data->strBranchName . ')' }}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>
              </div>

        <div class="row">
              <div class="input-field col l12 m8 s12">
                <label for="name">Schedule Header</label>
                <input id="name" name="name" type="text" class="validate" value="" />
              </div>
        </div>

      <br>
        <div class="row">
              <div class="col s12">
                  <label for="desc">Details</label>
                  <textarea id="desc" name="desc" class="materialize-textarea"></textarea>
              </div>
        </div> 


                <div class="row">
                  <div class="col s12">
                    <label for="time_frequency">Time Frequency of Reminder</label>
                    <select name="time_frequency" id="time_frequency">
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