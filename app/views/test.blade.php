@extends('layouts.secretary-master')

@section('content')

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Add New Patient</h5>
  </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-content">
        <div class="contents">
          <div class="container-fluid">
            <form action="{{ URL::to('/save-pat') }}" method="POST" id="signup_validate" enctype="multipart/form-data">
              <div class="row">
                    <div class="input-field col s12 m6 l6">
                      <input id="role" type="text" class="validate" value="Patient" readonly>
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
                      <input id="last_name_sa" name="last_name_sa" type="text" class="validate" value="" pattern="[a-zA-Z][a-zA-Z ]{1,}" onkeydown="return alphaOnly(event);">
                      <label for="last_name_sa">Last Name*</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <input id="first_name_sa" name="first_name_sa" type="text" class="validate" value="" pattern="[a-zA-Z][a-zA-Z ]{1,}" onkeydown="return alphaOnly(event);">
                      <label for="first_name_sa">First Name*</label>
                    </div>
                    <div class="input-field col s12 m4 l4">
                      <input id="middle_name_sa" name="middle_name_sa" type="text" class="validate" value="" pattern="[a-zA-Z][a-zA-Z ]{1,}" onkeydown="return alphaOnly(event);">
                      <label for="middle_name_sa">Middle Name</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s12">
                      <label for="gender_select">Sex</label>
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
        <div class="col s12 m12 l12">
          <label for="address">Address</label>
          <input id="address" name="address" type="text" class="validate" value="">
        </div>
      </div>

      <div class="row">
        <div class="input-field col l6 m6 s12">
            <label for="number">Contact Number</label>
            <input id="number" name="number" type="text" class="validate" value="" />
        </div>
        <div class="input-field col s12 m6 l6">
            <label for="company">Company:</label>
            <input id="company" name="company" type="text" class="validate" value="*Optional"/>
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

        <hr>
        <div class="row">
          <div class="col l12 m6 s6">
              <div class="row">
                 <div class="col s12 m6 l4">
                  <h5>Family History:</h5>
                  <form action="#" style="font-color: black;">
                    <p>
                      <input type="checkbox" id="diabetes" name="diabetes" value="1"/>
                      <label for="diabetes">Diabetes</label>
                    </p>
                    <p>
                      <input type="checkbox" id="glaucoma" name="glaucoma" value="2" />
                      <label for="glaucoma">Glaucoma</label>
                    </p>
                    <p>
                      <input type="checkbox" id="asthma" name="asthma" value="3"/>
                      <label for="asthma">Asthma</label>
                    </p>
                    <p>
                      <input type="checkbox" id="highblood" name="highblood" value="4"/>
                      <label for="highblood">Highblood</label>
                    </p>
                    <p>
                      <input type="checkbox" id="goiter" name="goiter" value="5"/>
                      <label for="goiter">Goiter</label>
                    </p>
                    <p>
                      <input type="checkbox" id="kidneyprob" name="kidneyprob" value="6"/>
                      <label for="kidneyprob">Kidney Problem</label>
                    </p>
                </div>
                 <div class="col s12 m6 l4">
                  <!-- <h5>Complaints:</h5>
                      <p>
                        <input type="checkbox" id="BOVfar" name="BOVfar" value="1"/>
                        <label for="BOVfar">BOV Far</label>
                      </p>
                      <p>
                        <input type="checkbox" id="BOVnear" name="BOVnear" value="2"/>
                        <label for="BOVnear">BOV Near</label>
                      </p>
                      <p>
                        <input type="checkbox" id="headache" name="headache" value="3"/>
                        <label for="headache">Headache</label>
                      </p>
                      <p>
                        <input type="checkbox" id="dizziness" name="dizziness" value="4"/>
                        <label for="dizziness">Dizziness</label>
                      </p>
                      <p>
                        <input type="checkbox" id="glare" name="glare" value="5"/>
                        <label for="glare">Glare</label>
                      </p>
                      <p>
                        <input type="checkbox" id="vomitting" name="vomitting" value="6"/>
                        <label for="vomitting">Vomitting</label>
                      </p>
                      -->
                    </form>
                </div>
              </div>
          </div>
        </div>

      <br>
      <hr>
      <br>
      <div class="col s12 m6 l6">
        <!-- mga bes, wag nested row at col-->
        <div class="row">
            <div class="col s12">
              <h5>Old Rx</h5>
              <h6>Spectacles</h6>
            </div>
            <div class="input-field col l6 m6 s12">
              <label for="OD">OD:</label>
              <input id="OD" name="OD" type="text" class="validate" value="" />
            </div>
            <div class="input-field col l6 m6 s12">
              <label  for="ODAdd">Add:</label>
              <input id="ODAdd" name="ODAdd" type="text" class="validate" value=""/>
            </div>
            <div class="input-field col l6 m6 s12">
              <label for="OS">OS:</label>
              <input id="OS" name="OS" type="text" class="validate" value="" />
            </div>
            <div class="input-field col l6 m6 s12">
                <label  for="OSAdd">Add:</label>
                <input id="OSAdd" name="OSAdd" type="text" class="validate" value=""/>
            </div>
        </div>
        <div class="row">
          <div class="col s12">
            <h6>VA/Contact Lens</h6>
          </div>
          <div class="input-field col l6 m6 s12">
            <label for="CLOD">OD:</label>
            <input id="CLOD" name="CLOD" type="text" class="validate" value="" />
          </div>
          <div class="input-field col l6 m6 s12">
            <label  for="CLOS">OS:</label>
            <input id="CLOS" name="CLOS" type="text" class="validate" value=""/>
          </div>
        </div>
          
      </div>

                  <div class="row">
                    <div class="input-field col s12 center">
                      <button type="submit" class="waves-effect waves-light btn blue darken-1 modal-btn">Save</button>
                      <a href="{{ URL::to('/records') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
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
  $().ready(function() {
    $("#signup_validate").validate({
      rules: {
        last_name_sa: "required",
        first_name_sa: "required",
        
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

</script>
{{-- Scripts END --}}
@endsection