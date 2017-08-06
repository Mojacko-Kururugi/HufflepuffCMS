@extends('layouts.secretary-master')

@section('content')

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Add New Payment</h5>
  </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-content">
      <div class="contents">
        <div class="container-fluid">
          <form action="{{ URL::to('teacher/save-profile-edit') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
            
            <div class="row">
              <div class="input-field col l6 m6 s12">
                <input id="user_id" name="user_id" type="text" class="validate" data-error=".id_error" value="" readonly/>
                <label for="user_id">ID:</label>
                <div class="id_error"></div>
              </div>
            </div>

            <div class="row">
              <div class="col s12">
                <p>Patient Name:</p>
              </div>
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
      			    <label for="payment-mode">Description:</label>
                <textarea id="pay-desc" name="pay-desc" class="materialize-textarea"></textarea>
              </div>
            </div>		
    			
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="amount" name="amount" type="text" class="validate" value="" > <!--onkeypress="return isNumber(event)"-->
                <label for="address">Amount of Payment:</label>
              </div>
			  
      			  <div class="col s12 m6 l6">
                <label for="pay-date" >Date of Payment:</label>
                <input id="pay_date" name="pay-date" type="date" class="datepicker" style="height:39px" value="">
              </div>
            </div>
    			
    			<div class="row">
              <div class="col s6">
                <label for="payment-mode">Payment Mode:</label>
                <select name="payment-mode">
      				     <option value="2" disabled selected>- Choose your option -</option>
      				     <option value="installment">Installment</option>
        					 <option value="full">Full</option>
        				</select>
              </div> 	
    			  
    			  <div class="col s6">
              <label for="payment-status">Payment Status:</label>
              <select name="payment-status">
    				     <option value="1" disabled selected>- Choose your option -</option>
    				     <option value="installment">Ongoing</option>
    					   <option value="full">Fully paid</option>
    				  </select>
            </div>
    			
    			<!---
                <div class="row">
                  <div class="col s12 m8 l6">
                    <label for="pay-date" >Date of Payment:</label>
                    <input id="pay_date" name="pay-date" type="date" class="datepicker" style="height:39px" value="">
                  </div>
                </div>
    			
                <div class="row">
                  <div class="col s12">
                    <label for="payment-status">Payment Status:</label>
                    <select name="payment-status">
    				     <option value="1" disabled selected>- Choose your option -</option>
    				     <option value="installment">Ongoing</option>
    					 <option value="full">Fully paid</option>
    				</select
                  </div>
                </div>
    			-->
    			
                <div class="row">
                  <div class="input-field col s12 center">
                    <button type="submit" class="waves-effect waves-light btn blue darken-1 btn-green modal-btn">Save</button>
                    <a href="{{ URL::to('/record') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
                  </div>
                </div>
              </div>
            </div>
        </form>
      </div> 
      </div> 
    </div> 
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

        pay-desc: "required",

        amount: {
          required: true,
          regex: 
        },

      },
      errorElement: 'div'
    });
  });

  $('#pay-desc').val('New Text');
  $('#pay-desc').trigger('autoresize');
  
  <!--function isNumber(evt) {
    <!--evt = (evt) ? evt : window.event;
   <!-- var charCode = (evt.which) ? evt.which : evt.keyCode;
   <!-- if (charCode > 31 && (charCode < 48 || charCode > 57)) { -->
   <!--    return false;
   <!-- }
   <!-- return true;
}-->
  
  function showfield(name){
  if(name=='Installment')document.getElementById('deposit').innerHTML='Other: <input type="text" name="other" />';
  else document.getElementById('div1').innerHTML='';
  
// function alphaOnly(event) {
//   var key = event.keyCode;
//   return ((key >= 65 && key <= 90) || key == 8 || key == 32);
// };
</script>
{{-- Scripts END --}}
@endsection