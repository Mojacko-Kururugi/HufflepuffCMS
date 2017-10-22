@extends('layouts.admin-master')

@section('content')

  <?php Session::put('upId', $id); ?> 

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Update Employee</h5>
  </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-content">
        <div class="contents">
          <div class="container-fluid">
            <form action="{{ URL::to('/update-emp') }}" method="POST" id="signup_validate" enctype="multipart/form-data">
              <div class="row">
                    <div class="input-field col s12 m6 l6">
                      <input id="role" type="text" class="validate" value="Employee" readonly>
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
                      <input id="last_name_sa" name="last_name_sa" type="text" class="validate" value="{{ $data->strEmpLast }}">
                      <label for="last_name_sa">Last Name*</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <input id="first_name_sa" name="first_name_sa" type="text" class="validate" value="{{ $data->strEmpFirst }}">
                      <label for="first_name_sa">First Name*</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <input id="middle_name_sa" name="middle_name_sa" type="text" class="validate" value="{{ $data->strEmpMiddle }}">
                      <label for="middle_name_sa">Middle Name</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" value="{{ $data->intEmpBranch }}" name="branch" id="branch" data-error=".school_error">
                          <option value="" disabled>Branch*</option>
                          @foreach($branch as $branch)
                            <option value="{{ $branch->intBranchID}}" @if(Input::old('branch') == $branch->intBranchID) selected="selected" @endif>{{ $branch->strBranchName}}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
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
  var contactRegex = /((\+63)|0)\d{10}/;

  $(document).ready(function() {
    $.validator.addMethod("regex", function(value, element, regexp) {
       return regexp.test(value);
     }, "Please enter a valid format.");
    $('#signup_validate').validate({
      rules: {
        first_name_sa: {
          required: true,
          regex: nameRegex
        },

        //middle_name_sa: {
        //   regex: nameRegex
        //},

        last_name_sa: {
          required: true,
          regex: nameRegex
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
          minlength: 6
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