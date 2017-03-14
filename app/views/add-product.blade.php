@extends('layouts.admin-master')

@section('content')

  <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h3>Add New Product</h3>

    </div>
  </div>

  <div class="contents z-depth-1">
    <div class="container">
      <form action="{{ URL::to('/products/add-prod') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
        <div class="row">
              <div class="input-field col l12 m8 s12">
                <label for="name">Product Name</label>
                <input id="name" name="name" type="text" class="validate" value="" />
              </div>
        </div>
        <div class="row">
              <div class="input-field col l12 m8 s12">
                <label for="model">Product Model</label>
                <input id="model" name="model" type="text" class="validate" value="" />
              </div>
        </div>
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="type" id="type" data-error=".school_error">
                          <option value="" disabled selected>Type</option>
                          @foreach($data as $data)
                            <option value="{{ $data->intPTID}}" @if(Input::old('type') == $data->intPTID) selected="selected" @endif>{{ $data->strPTDesc}}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
            <div class="row">
              <div class="input-field col l12 s12 center">
                <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Save</button>
                <a href="{{ URL::to('/products') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
              </div>
            </div>
            <br><br>
            </form>
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