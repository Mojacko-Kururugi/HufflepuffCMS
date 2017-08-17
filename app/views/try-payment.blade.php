@extends('layouts.master')

@section('content')
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <div class="row">
    <div class="center col l12 m12 s12">
      <h5>New Payment</h5>
    </div>
  </div>

  <div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <form action="{{ URL::to('/save-payment') }}" method="POST" id="signup_validate" enctype="multipart/form-data">
 <div class="row">
    <div class="input-field col s12 m4 l4">
      <input type="text" id="search" required="">
      <label class="label-icon" for="search">Customer<i class=" tiny material-icons prefix">search</i></label>
    </div>

    <div class="input-field col s12 m4 l4">
      <!-- dapat autogenerated-->
      <input type="text" name="transaction-no" required="">
      <label for="transaction-no">Transaction No.</label>
    </div>
 </div>

  <div class="row">
    <div class="col s12 m12 l7">
      <div class="card-panel">
        <span class="card-title">Products</span>
        <hr>
        <div class="card-content">
         <div class="card-tabs">
            <ul class="tabs tabs-fixed-width">
              <li class="tab"><a class="active" href="#specs">SPECS</a></li>
              <li class="tab"><a href="#lens">LENSES</a></li>
              <li class="tab"><a href="#contact-lens">CONTACTLENSE</a></li>
              <li class="tab"><a href="#solution">SOLUTIONS</a></li>
            </ul>
        </div>
        <div class="card-content">
             <div id="specs">
               <div class="row">
                <label for="payment-mode">Products:</label>
                  <select name="Products">
                   <option value="2" disabled selected>- Choose specs -</option>
                   <option>product 1</option>
                   <option>product 2</option>
                  </select>
               </div>
             </div>

             <div id="lens">
               <div class="row">
                <label for="payment-mode">Products:</label>
                  <select name="Products">
                   <option value="2" disabled selected>- Choose lens -</option>
                   <option>product 1</option>
                   <option>product 2</option>
                  </select>
                </div>
             </div>

              <div id="contact-lens">
                <div class="row">
                  <label for="payment-mode">Products:</label>
                    <select name="Products">
                     <option value="2" disabled selected>- Choose contact lens -</option>
                     <option>product 1</option>
                     <option>product 2</option>
                    </select>
                 </div>
              </div>

              <div id="solution">
                <div class="row">
                  <label for="payment-mode">Products:</label>
                    <select name="Products">
                     <option value="2" disabled selected>- Choose solution-</option>
                     <option>product 1</option>
                     <option>product 2</option>
                    </select>
                 </div>
              </div>
        </div>

        <div class="card-content">
              <div class="row">
                <div class="input-field col l6 m6 s6">
                   <label for="qty">Quantity</label>
                    <input id="qty" name="qty" type="text" class="validate" value="" />
                </div>
                <div class="col s6 m6 s6 middle">
                    <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Add</button>
                </div>
              </div>
        </div>
       </div>   
    </div>

    <div class="card-panel">
      <span class="card-title">Payment</span>
        <hr>
        <div class="card-content">
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

          <div class="row">
            <div class="col s6 m6 l6">
              <h5>Amnt. Received:</h5><br>
              <h5>Change:</h5>
            </div>
            <div class="col s6 m6 l6">
              <input type="number" name="amount-received">
              <input type="number" name="change" placeholder="(disabled)">
            </div>
          </div>

            <div class="row">
              <div class="input-field col l12 s12 center">
                <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">PAY</button>
                <a href="{{ URL::to('/sales') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
              </div>
            </div>
        </div>
      </div>
  </div>

    <div class="col s12 m12 l5">
      <div class="card-panel">
        <span class="card-title">Purchase</span>
        <hr>
        <div class="card-content">
          <div v-show="isCartEmpty">
             <span class="label label-primary">No items on cart</span>
          </div>
          <table class="table cart-table table-hover" v-show="!isCartEmpty">
              <thead>
                <tr class="register-items-header">
                  <th class="text-center"></th>
                  <th>Product Name</th>
                  <th class="text-center">Qty.</th>
                  <th class="text-center">Price</th>
                </tr>
              </thead>
              <tr class="dashed" id="summary-grand-total">
                  <td>
                      <h6 class="sales-info">TOTAL: </h6>
                      <strong class="text-success"></strong>
                  </td>
              </tr>  
          </table>
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