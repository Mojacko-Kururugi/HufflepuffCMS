@extends('layouts.secretary-master')

@section('content')
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <form action="{{ URL::to('/sec-purch/addPayEF') }}" method="POST" id="signup_validate" enctype="multipart/form-data">
 
     <div class="card-panel">
      <span class="card-title">Payment</span>
        <hr>
        <div class="card-content">
          <div class="row">
            <div class="col s6 m6 l6">
              <h5>Service #:</h5><br>
              <h5>Total:</h5><br>
              <h5>Amnt. Received:</h5><br>
            </div>
            <div class="col s6 m6 l6">
              <input type="text" name="id" id="id" value="{{$data->strSServCode}}" readonly>
              <input type="number" name="total" id="total" value="{{$data->dcmSBalance}}" readonly>
              <input type="number" name="amount-received" id="amount-received">
            </div>
          </div>

            <div class="row">
              <div class="input-field col l12 s12 center">
                <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">PAY</button>
                <a href="{{ URL::to('/sec-home') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
              </div>
            </div>
        </div>
      </div>
</form>
  </div>




{{-- Scripts START --}}
<!--<script type="text/javascript">
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
          regex: contactRegex
        },
        
        number: {
          required: true,
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
</script>-->
{{-- Scripts END --}}
@endsection