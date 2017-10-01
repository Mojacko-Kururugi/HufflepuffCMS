@extends('layouts.admin-master')

@section('content')

  <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h5>Add New Order</h5>
    </div>
  </div>

  <div class="contents z-depth-1">
      <form action="{{ URL::to('/admin/add-to-list') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
              <div class="row">
                <div class="input-field col l6 m6 s12">
                  <input id="user_id" name="user_id" type="text" class="validate" data-error=".id_error" value="{{ $count }}" readonly />
                  <label for="user_id">Serial Code #:</label>
                  <div class="id_error"></div>
                </div>
              </div>

               <div class="row">
                  <div class="col s12 m12 l7">
                    <div class="card-panel">
                      <span class="card-title">Products and Materials</span>
                      <hr>
                        <div class="card-content">
                             <div class="card-tabs">
                                <ul class="tabs tabs-fixed-width">
                                @foreach($type as $stype)
                                  <li class="tab"><a href="#{{ $stype->intITID }}">{{ $stype->strITDesc }}</a></li>
                                @endforeach
                                </ul>
                            </div>
                        </div>

                      @foreach($type as $subt)
                        <div class="card-content">
                               <div id="{{ $subt->intITID }}">
                                 <div class="row">
                                  <label for="payment-mode">Products:</label>
                                    <select name="name" id="name">
                                     <option value="0" disabled selected>- Select {{$subt->strITDesc}} -</option>
                                     @foreach($data as $prod)
                                     @if($prod->intItemType == $subt->intITID)
                                     <option value="{{$prod->intItemID}}">{{$prod->strItemName}}</option>
                                     @endif
                                     @endforeach
                                    </select>
                                 </div>
                                 <!--
                                 @if($subt->intIsPerishable == 1)
                                          <div class="row">
                                            <div class="col s12 m8 l6">
                                              <label for="date">Choose Expiry Date</label>
                                              <input id="date" name="date" type="date" class="datepicker" style="height:39px">
                                            </div>
                                          </div>
                                @endif
                                -->
                               </div>
                        </div>
                      @endforeach  
                    </div>
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
                  </form>

                  <div class="col s12 m12 l5">
                    <div class="card-panel">
                      <span class="card-title">List</span>
                      <hr>
                          <div class="card-content">
                                <div v-show="isCartEmpty">
                                  <!-- <span class="label label-primary">No items on cart</span> -->
                                </div>
                                <table class="table cart-table table-hover" v-show="!isCartEmpty">
                                    <thead>
                                      <tr class="register-items-header">
                                        <th>Name</th>
                                        <th>Desc.</th>
                                        <th>Qty.</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $l)
                                    <tr>
                                      <td>{{$l->strItemName}}</td>
                                      <td>{{$l->strItemModel}}</td>
                                      <td>{{$l->intOQty}}</td>
                                      <td><a class="waves-effect waves-light btn btn-small red center-text">REMOVE</a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                          </div>
                    </div>
                  </div>

              </div>



                  <!--<div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="name" id="name" data-error=".school_error">
                          <option value="" disabled selected>Product Name</option>
                          @foreach($data as $data)
                            <option value="{{ $data->intItemID}}" @if(Input::old('product') == $data->intItemID) selected="selected" @endif>{{ $data->strItemName . ' - ' . $data->strItemModel}}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>
        <div class="row">
              <div class="input-field col l12 m8 s12">
                <label for="qty">Quantity</label>
                <input id="qty" name="qty" type="text" class="validate" value="" />
              </div>
        </div>-->
            <div class="row">
              <div class="input-field col l12 s12 center">
                <a class="waves-effect waves-light btn btn-green modal-btn" href="/admin/add-order">SUBMIT</a>
                <a href="{{ URL::to('/admin') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
              </div>
            </div>
            <br><br>
           <!-- </form> -->
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