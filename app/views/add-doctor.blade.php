@extends('layouts.admin-master')
@section('javascript')

<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
@stop
<style type="text/css">
  div.error {
  color: red;
  margin-top: -15px;
  padding: 0;
  font-size: 0.9em;
}
</style>
@section('content')

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Add New Optometrist</h5>
  </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-content">
      
          <div class="container-fluid">
            <form action="{{ URL::to('/save-doctor') }}" method="post" id="addDoctor_validate"><br><br>
              <div class="row">
                <div class="input-field col l6 m6 s12">
                  <input id="license_id" name="license_id" type="text" class="validate" />
                  <label for="license_id">License ID:</label>
                  <div class="id_error"></div>
                </div>
              </div>
              <div class="row">
                    <div class="input-field col s12 m6 l6">
                      <input id="role" type="text" class="" value="Optometrist" readonly>
                      <label for="role">User Type</label>
                    </div>
              </div>
                <div class="col s12"><br>
                  <div class="row" style="padding:0px; margin:0px;">
                    <p style="padding:0px; margin:0px;">Name:</p>
                  </div>
                  <div class="row">
                    <div class="input-field col s12 m4 l4">
                      <input id="last_name_sa" name="last_name_sa" type="text" class="required specialChar">
                      <label for="last_name_sa">Last Name</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <input id="first_name_sa" name="first_name_sa" type="text" class="required specialChar">
                      <label for="first_name_sa">First Name</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <input id="middle_name_sa" name="middle_name_sa" type="text">
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
                      <input id="address" name="address" type="text">
                      <label for="address">Address</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12 m8 l6">
                      <input id="contact_number" name="contact_number" type="text" >
                      <label for="contact_number">Contact Number</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="required initialized browser-default" name="branch" id="branch">
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
                            <input id="email" name="email" type="email"/>
                            <div class="email_error">
                            </div>
                        </div>
                        <div class="input-field col l6 m8 s12">
                            <label for="con_email">Confirm Email</label>
                            <input id="con_email" name="con_email" type="email"/>
                            <div class="confirm_email_error"></div>
                        </div>
                  </div>
                  <div class="row">
                        <div class="input-field col l6 m8 s12">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" class="required specialChar"/>
                                <div class="password_error"></div>
                            </div>
                          <div class="input-field col l6 m8 s12">
                            <label for="con_pass">Confirm Password</label>
                            <input id="con_pass" name="con_pass" type="password" class="required specialChar"/>
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
            </form>
          </div> 
    </div>
  </div>
</div>
  <script type="text/javascript">
    $(document).ready(function(){

      jQuery.validator.addMethod("specialChar", function(value, element) {
     return this.optional(element) || /([0-9a-zA-Z\s])$/.test(value);
  }, "Please Fill Correct Value in Field.");

    $("#contact_number").mask("(9999) 999-9999");


$("#contact_number").on("blur", function() {
    var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );
    
    if( last.length == 3 ) {
        var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );
        var lastfour = move + last;
        
        var first = $(this).val().substr( 0, 9 );
        
        $(this).val( first + '-' + lastfour );
    }
});

      $('#addDoctor_validate').validate({
      rules:{
        'license_id': {
          required: true,
          minlength: 7
        },
        'last_name_sa':
        {
          required: true,
          specialChar: true
        },
        'first_name_sa':
        {
          required: true,
          specialChar: true
        },
        'address': {
          required: true
        },
        'contact_number': {
          required: true,
          minlength: 11
        },
        'email': {
          required: true,
          email: true
        },
        'con_email': {
          required: true,
          equalTo: "#email"
        },
        'password': {
          required: true,
          minlength: 5,
          specialChar: true
        },
        'con_pass': {
          required: true,
          equalTo: "#password",
          specialChar: true
        }
      },
      messages: {
        'license_id': {
          required: "Please enter license id",},
        'last_name_sa': {
          required: "Please enter last name",
        },
        'first_name_sa': {
          required: "Please enter first name",
        },
        'address': {
          required: "Please enter address"
        },
        'contact_number':{
          required: "Please provide contact number",
          minlength: "please enter 11-digit contact number"
        },
        'email': {
          required: "Please enter email address",
          email: "Please enter valid email address"
        },
        'con_email':{
          required: "Please re-enter email address",
          equalTo: "Please enter the same email address"
        },
        'password': {
          required: "Please enter password",
          minlength: "Please enter minimum of 5 character"
        },
        'con_pass': {
          required: "Please re-enter password",
          equalTo: "Password didn't match! Please enter the same password"
        }
      },

      errorElement: "div",

    errorPlacement : function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    },
      submitHandler: function (form) {
            alert("New Optometrist Added!");
            return true;
        },
        invalidHandler: function () {
            alert("Form is invalid. Please input data");
        }
    });

    });
    
  </script>
@endsection