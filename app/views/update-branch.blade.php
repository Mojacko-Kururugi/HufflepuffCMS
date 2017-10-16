@extends('layouts.admin-master')

@section('content')

  <?php Session::put('upId', $id); ?>             

<!--   <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h3>Update Branch</h3>

    </div>
  </div>
 -->


<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Update Branch</h5>
  </div>
</div>

  <div class="contents">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-content">
              <form action="{{ URL::to('/update-branch') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
            <div class="row">
                  <div class="input-field col l12 m8 s12">
                    <label for="email">Branch Name*</label>
                    <input id="number" name="number" type="text" class="validate" value="{{ $data->strBranchName }}" data-error=".branch_error"/>
                    <div class="branch_error"></div>
                  </div>
            </div>
                <div class="row">
                  <div class="input-field col s12 m12 l12">
                    <input id="address" name="address" type="text" class="validate" value="{{ $data->strBranchAddress }}" data-error=".address_error">
                    <label for="address">Address*</label>
                    <div class="address_error"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m8 l6">
                    <input id="stud_id_no" name="stud_id_no" type="number" class="validate" value="{{ $data->strBContactNumb }}" data-error=".num_error">
                    <label for="stud_id_no">Contact Number*</label>
                    <div class="num_error"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col l12 s12 center">
                    <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Save</button>
                    <a href="{{ URL::to('/branches') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
                    </div>
                </div>
                 <br><br>
                 </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

{{-- Scripts START --}}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script type="text/javascript">
  $().ready(function() {
    $.validator.addMethod("regex", function(value, element, regexp) {
       return regexp.test(value);
     }, "Please enter a valid format.");

    $('#signup_validate').validate({
      rules: {
        user_id: {
          required: true,
          regex: licenseRegex
        },

        branch: "required",
        
        user_type: "required",

        first_name_sa: {
          required: true
        },

        // middle_name_sa: {
        //   regex: nameRegex
        // },

        last_name_sa: {
          required: true
        },


        gender: "required",

        // number: {
        //   required: true,
        //   regex: contactRegex
        // },

        strUserLastName: {
          required: true,
          regex: nameRegex
        },

        address: {
          //required: true,
          regex: addRegex
        },

        stud_id_no: {
          //required: true,
          //maxlength: 11,
         // minlength: 11,
          regex: contactRegex
        },

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
      // messages: {
      //   user_id: "This field is Required."
      // },
      errorElement: 'div'
    });
  });

</script>
{{-- Scripts END --}}
@endsection