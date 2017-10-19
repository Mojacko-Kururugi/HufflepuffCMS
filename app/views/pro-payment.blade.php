@extends('layouts.secretary-master')

@section('content')
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <form action="{{ URL::to('/sec-purch/addPayF') }}" method="POST" id="signup_validate" enctype="multipart/form-data">
 
     <div class="card-panel">
      <span class="card-title">Payment</span>
        <hr>
        <div class="card-content">

          <div class="col s6">
              <label for="claim">Will Claim The Products?*</label>
              <select class="browser-default" name="claim" id="claim" data-error=".claim_error">
                 <option value="" disabled selected>- Choose your option -</option>
                 <option value="1">Yes</option>
                 <option value="2">No</option>
              </select>
              <div class="claim_error"></div>
          </div>
          

          <div class="row">
            <div class="col s6 m6 l6">
              <h5>Total:</h5><br>
              <h5>Amnt. Received*:</h5><br>
              <!-- <h5>Change:</h5> -->
            </div>
            <div class="col s6 m6 l6">
              <input type="number" name="total" id="total" value="{{$total}}" readonly>
              <input type="text" name="amount-received" id="amount-received">
              <!-- <input type="number" name="change" placeholder="(disabled)"> -->
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
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
  $().ready(function() {
    $("#signup_validate").validate({
      rules: {
        'amount-received': "required",
        'claim': "required",
        'payment-mode': "required",
        // name: "required",
      },
      errorElement: 'div'
    });

  //  var total = $("#total").val()
  //  console.log(total)
  //  $('#payment-mode').on('change', function() {
  //   if (this.value == "1"){
  //     var val = parseFloat(total)
  //     console.log("1",val);
  //     $( "#signup_validate" ).validate({
  //         rules: {
  //           'amount-received': {
  //             required: true,
  //             min: val
  //           }, 
  //     errorElement: 'div'

  //         }
  //       });
  //   }else if (this.value == "2" || this.value == "3"){
  //     var val = parseFloat(total)
  //     console.log("23",val - 1);
  //       $( "#signup_validate" ).validate({
  //         rules: {
  //           'amount-received': {
  //             required: true,
  //             max: val
  //           },
  //     errorElement: 'div'
            
  //         }
  //       });
  //   }
  //   })
  // });


</script>
{{-- Scripts END --}}
@endsection