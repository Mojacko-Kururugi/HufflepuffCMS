@extends('layouts.admin-master')

@section('content')

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Add New Assistant</h5>
  </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-content">
        <div class="contents">
          <div class="container-fluid">
            <form action="{{ URL::to('/save-emp') }}" method="POST" id="signup_validate" enctype="multipart/form-data">
              <div class="row">
                    <div class="input-field col s12 m6 l6">
                      <input id="role" type="text" class="" value="Assistant" readonly>
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
                      <label for="last_name_sa">Last Name*</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <input id="first_name_sa" name="first_name_sa" type="text" class="validate" value="">
                      <label for="first_name_sa">First Name*</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <input id="middle_name_sa" name="middle_name_sa" type="text" class="validate" value="" pattern="[A-Za-z]+" onkeydown="return alphaOnly(event);">
                      <label for="middle_name_sa">Middle Name</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="branch" id="branch" data-error=".school_error">
                          <option value="" disabled selected>Branch*</option>
                          @foreach($branch as $branch)
                            <option value="{{ $branch->intBranchID}}" @if(Input::old('branch') == $branch->intBranchID) selected="selected" @endif>{{ $branch->strBranchName}}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>

        <div class="row">
            <div class="input-field col l6 m8 s12">
                  <label for="email">Email*</label>
                  <input id="email" name="email" type="email" class="validate" data-error=".email_error" value="" />
                  <div class="email_error">
                  </div>
              </div>
              <div class="input-field col l6 m8 s12">
                  <label for="con-email">Confirm Email*</label>
                  <input id="con_email" name="con_email" type="email" class="validate" data-error=".confirm_email_error" />
                  <div class="confirm_email_error"></div>
              </div>
        </div>
        <div class="row">
              <div class="input-field col l6 m8 s12">
                      <label for="password">Password*</label>
                      <input id="password" name="password" type="password" class="validate" data-error=".password_error" />
                      <div class="password_error"></div>
                  </div>
                <div class="input-field col l6 m8 s12">
                  <label for="con_pass">Confirm Password*</label>
                  <input id="con_pass" name="con_pass" type="password" class="validate" data-error=".confirm_password_error" />
                  <div class="confirm_password_error"></div>
              </div>
        </div>
        
                  <div class="row">
                    <div class="input-field col s12 center">
                      <button type="submit" class="waves-effect waves-light btn blue darken-1 modal-btn">Save</button>
                      <a href="{{ URL::to('/employees') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
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
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
  var date = new Date();
  var nameRegex = /^([ \u00c0-\u01ffa-zA-Z'\-])+$/;
  var passRegex = /^[a-zA-Z0-9]{6,16}$/;
  
  $(document).ready(function() {
    $.validator.addMethod("regex", function(value, element, regexp) {
       return regexp.test(value);
     }, "Please enter a valid format.");
    $('#signup_validate').validate({
      rules: {
        first_name_sa: {
          required: true,
          // regex: nameRegex
        },

        // middle_name_sa: {
        //   regex: nameRegex
        // },

        last_name_sa: {
          required: true,
          // regex: nameRegex
        },

        branch: "required",

        email: {
          required: true,
          email: true
        },
        
        con_email: {
          email: true,
          equalTo: "#email",
          required: true
        },
        
        password: {
          required: true,
          minlength: 6,
          regex: passRegex
        },
        
        con_pass: {
          required: true,
          equalTo: "#password"
        }
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