@extends('layouts.master')

@section('content')

  <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h3>Service</h3>

    </div>
  </div>

  <div class="contents z-depth-1">
    <div class="container">
      <form action="{{ URL::to('/save-service') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="patient" id="patient" data-error=".school_error">
                          <option value="" disabled selected>Patient Name</option>
                          @foreach($patient as $patient)
                            <option value="{{ $patient->intPatID}}" @if(Input::old('patient') == $patient->intPatID) selected="selected" @endif>{{ $patient->strPatLast . ', ' . $patient->strPatFirst . ' ' . $patient->strPatMiddle}}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="service" id="service" data-error=".school_error">
                          <option value="" disabled selected>Service</option>
                          @foreach($service as $service)
                            <option value="{{ $service->intServID}}" @if(Input::old('service') == $service->intServID) selected="selected" @endif>{{ $service->strServDesc }}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="product" id="product" data-error=".school_error">
                          <option value="" disabled selected>Product</option>
                          @foreach($product as $product)
                            <option value="{{ $product->intInvID}}" @if(Input::old('product') == $product->intInvID) selected="selected" @endif>{{ $product->strProdName . ' - ' . $product->dcInvPPrice . ' php' }}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="type" id="type" data-error=".school_error">
                          <option value="" disabled selected>Payment Type</option>
                          @foreach($type as $type)
                            <option value="{{ $type->intPayTID}}" @if(Input::old('type') == $type->intPayTID) selected="selected" @endif>{{ $type->strPayTDesc }}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="status" id="status" data-error=".school_error">
                          <option value="" disabled selected>Payment status</option>
                          @foreach($status as $status)
                            <option value="{{ $status->intServStatID}}" @if(Input::old('status') == $status->intServStatID) selected="selected" @endif>{{ $status->strServStatDesc }}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>

            <div class="row">
              <div class="input-field col l12 s12 center">
                <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Save</button>
                <a href="{{ URL::to('/service') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
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