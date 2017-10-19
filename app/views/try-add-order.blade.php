@extends('layouts.admin-master')

@section('content')

<!--   <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h5>Add New Stock</h5>
    </div>
  </div> -->

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Add New Stock</h5>
  </div>
</div>

  <div class="contents ">
      <form action="{{ URL::to('/admin/add-to-list') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
              <div class="row">
                <div class="input-field col l6 m6 s12">
                  <input id="user_id" name="user_id" type="text" class="validate" data-error=".id_error" value="{{ $count }}" readonly />
                  <label for="user_id">Batch Code #:</label>
                  <div class="id_error"></div>
                </div>
              </div>

               <div class="row">
                  <div class="col s12 m12 l7">
                    <div class="card-panel">
                      <span class="card-title">Products and Materials</span>
                      <hr>
                        <div class="card-content">
                             <!-- <div class="card-tabs">
                                <ul class="tabs tabs-fixed-width">
                                @foreach($type as $stype)
                                  <li class="tab"><a href="#{{ $stype->intITID }}">{{ $stype->strITDesc }}</a></li>
                                @endforeach
                                </ul>
                            </div> -->
                            
                                @foreach($type as $stype)
                                 <p>
                                    <input name="group1" type="radio" class="radioProducts" id="#{{ $stype->intITID }}" value="{{ $stype->strITDesc }}"/>
                                    <label for="#{{ $stype->intITID }}">{{ $stype->strITDesc }}</label>
                                 </p>
                                  <!-- <li class="tab"><a href="#{{ $stype->intITID }}">{{ $stype->strITDesc }}</a></li> -->
                                @endforeach
                                
                        </div>
                        <br/>
                        <br/>
                      @foreach($type as $subt)
                        <div class="card-content something" id="id{{ $subt->intITID }}">
                               <div id="#{{ $subt->intITID }}" class="viewSelect">
                                 <div class="row">
                                  <label for="payment-mode">Products*:</label>
                                    <select name="name" id="name" class="validate" required>
                                     <option value="" disabled selected>- Select {{$subt->strITDesc}} -</option>
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
                                  <label for="qty">Quantity*</label>
                                  <input id="qty" name="qty" type="number" class="validate" value="" min="1" data-error=".qty_error"/>
                                  <div class="qty_error"></div>
                          </div>
                          <div class="col s6 m6 s6 middle">
                              <button type="submit" class="waves-effect waves-light btn btn-green modal-btn" id="addBtn">Add</button>
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
                                      <td>{{$l->strItemDesc}}</td>
                                      <td>{{$l->intOQty}}</td>
                                      <td><a class="waves-effect waves-light btn btn-small red center-text" href="/admin/rem-to-list/{{$l->intOProdID}}">REMOVE</a></td>
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
                            <option value="{{ $data->intItemID}}" @if(Input::old('product') == $data->intItemID) selected="selected" @endif>{{ $data->strItemName . ' - ' . $data->strItemDesc}}</option>
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
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
  var qtyRegex = /^[0-9]{1,4}$/;
$(".something").addClass("hide");

$(document).ready(function() {
    $("input[name$='group1']").click(function() {
        var radio = $(this).attr('id');
        var s = radio.replace("#", "")
        var x = parseInt(s)
        var z = x - 1
        var lol = ("#id").concat(s)
        var localStore = localStorage.getItem("selected");

        $(".something").addClass("hide");
        $(lol).removeClass("hide");


        console.log(radio)

        // $("div.desc").hide();
        // $("#Cars" + test).show();
    });

    $.validator.addMethod("regex", function(value, element, regexpr) {          
     return regexpr.test(value);
    }, "Acceptable quantity is only up to 4 digits"); 
    $("#signup_validate").validate({          
      rules: {
        name: "required",
        qty: {
          required: true,
          regex: qtyRegex
        } 
      },
      errorElement: 'div'
    });

});

</script>
{{-- Scripts END --}}
@endsection