@extends('layouts.admin-master')

@section('content')

  <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h3>Add New Branch</h3>

    </div>
  </div>

  <div class="contents z-depth-1">
    <div class="container">
      <form action="{{ URL::to('teacher/save-profile-edit') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
        <div class="row">
          <div class="input-field col l6 m6 s12">
            <input id="user_id" name="user_id" type="text" class="validate" data-error=".id_error" value="" readonly/>
            <label for="user_id">Branch ID:</label>
            <div class="id_error"></div>
          </div>
        </div>
        <div class="row">
              <div class="input-field col l12 m8 s12">
                <label for="email">Branch Name</label>
                <input id="number" name="number" type="text" class="validate" value="" />
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
              <div class="input-field col l12 s12 center">
                <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Save</button>
                <a href="{{ URL::to('/branches') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
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