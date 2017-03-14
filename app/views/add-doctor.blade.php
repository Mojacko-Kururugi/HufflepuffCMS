@extends('layouts.admin-master')

@section('content')

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Add New Optometrist</h5>
  </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-content">
        <div class="contents">
          <div class="container-fluid">
            <form action="{{ URL::to('/save-doctor') }}" method="POST" id="signup_validate" enctype="multipart/form-data">
              <div class="row">
                <div class="input-field col l6 m6 s12">
                  <input id="user_id" name="user_id" type="text" class="validate" data-error=".id_error" value=""/>
                  <label for="user_id">License ID:</label>
                  <div class="id_error"></div>
                </div>
              </div>
              <div class="row">
                    <div class="input-field col s12 m6 l6">
                      <input id="role" type="text" class="validate" value="Doctor" readonly>
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
                    <div class="col s12">
                      <label for="gender_select">Gender</label>
                      <p>
                        <input name="gender" type="radio" id="male" value="1"/>
                        <label for="male">Male</label>
                      </p>                         
                      <p>
                        <input name="gender" type="radio" id="female" value="2" checked/>
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
                    <div class="input-field col s12 m8 l6">
                      <input id="stud_id_no" name="stud_id_no" type="text" class="validate" value="">
                      <label for="stud_id_no">Contact Number</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="branch" id="branch" data-error=".school_error">
                          <option value="" disabled selected>Branch</option>
                          @foreach($branch as $branch)
                            <option value="{{ $branch->intBranchID}}" @if(Input::old('branch') == $branch->intBranchID) selected="selected" @endif>{{ $branch->strBranchName}}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>

        <div class="row">
            <div class="input-field col l6 m8 s12">
                  <label for="email">Email</label>
                  <input id="email" name="email" type="email" class="validate" data-error=".email_error" value="" />
                  <div class="email_error">
                  </div>
              </div>
              <div class="input-field col l6 m8 s12">
                  <label for="con-email">Confirm Email</label>
                  <input id="con_email" name="con_email" type="email" class="validate" data-error=".confirm_email_error" />
                  <div class="confirm_email_error"></div>
              </div>
        </div>
        <div class="row">
              <div class="input-field col l6 m8 s12">
                      <label for="password">Password</label>
                      <input id="password" name="password" type="password" class="validate" data-error=".password_error" />
                      <div class="password_error"></div>
                  </div>
                <div class="input-field col l6 m8 s12">
                  <label for="con_pass">Confirm Password</label>
                  <input id="con_pass" name="con_pass" type="password" class="validate" data-error=".confirm_password_error" />
                  <div class="confirm_password_error"></div>
              </div>
        </div>

                  <div class="row">
                    <div class="input-field col s12 center">
                      <button type="submit" class="waves-effect waves-light btn blue darken-1 modal-btn">Save</button>
                      <a href="{{ URL::to('/doctors') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
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