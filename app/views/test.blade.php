@extends('layouts.admin-master')

@section('content')

  <div class="row"><br>
    <div class="center col l3 m12 s12">
      <h3>Edit Profile</h3>

    </div>
  </div>

  <div class="contents z-depth-1">
    <div class="container">
      <form action="{{ URL::to('teacher/save-profile-edit') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
        <div class="row">
          <div class="input-field col l6 m6 s12">
            <input id="user_id" name="user_id" type="text" class="validate" data-error=".id_error" value="" readonly/>
            <label for="user_id">ID:</label>
            <div class="id_error"></div>
          </div>
        </div>
        <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="role" type="text" class="validate" value="Teacher" readonly>
                <label for="role">User Type</label>
              </div>
        </div>
        <div class="row">
          <div class="col s12"><br>
            <div class="row" style="padding:0px; margin:0px;">
              <p style="padding:0px; margin:0px;">Name:</p>
            </div>
            <div class="row">
              <div class="input-field col s12 m4 l4">
                <input id="last_name_sa" name="last_name_sa" type="text" class="validate" value="" pattern="[A-Za-z]+" onkeydown="return alphaOnly(event);">
                <label for="last_name_sa">Last Name</label>
              </div>
              <div class="input-field col s12 m4 l4">
                <input id="first_name_sa" name="first_name_sa" type="text" class="validate" value="" pattern="[A-Za-z]+" onkeydown="return alphaOnly(event);">
                <label for="first_name_sa">First Name</label>
              </div>
              <div class="input-field col s12 m4 l4">
                <input id="middle_name_sa" name="middle_name_sa" type="text" class="validate" value="" pattern="[A-Za-z]+" onkeydown="return alphaOnly(event);">
                <label for="middle_name_sa">Middle Name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="school" type="text" class="validate" value="" readonly>
                <label for="school">School</label>
              </div>
            </div>
            <div class="row">
              <div class="col s12">
                <label for="gender_select">Gender</label>
                <p>
                  <input name="gender" type="radio" id="male" value="Male"/>
                  <label for="male">Male</label>
                </p>                         
                <p>
                  <input name="gender" type="radio" id="female" value="Female" checked/>
                  <label for="female">Female</label>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="address" name="address" type="text" class="validate" value="">
                <label for="address">Address</label>
              </div>
            </div>
            <div class="row">
              <div class="col s12 m8 l6">
                <label for="b_day" >Birthday</label>
                <input id="b_day" name="b_day" type="date" class="datepicker" style="height:39px" value="">
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m8 l6">
                <input id="stud_id_no" name="stud_id_no" type="text" class="validate" value="">
                <label for="stud_id_no">Username</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col l6 m8 s12">
                <label for="email">Contact Number</label>
                <input id="number" name="number" type="text" class="validate" value="" />
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 center">
                <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Save</button>
                <a href="{{ URL::to('teacher/profile') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
              </div>
            </div>
          </div>
        </div>
    </form>
  </div> 
</div><br><br>

{{-- Scripts START --}}
<script type="text/javascript">
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