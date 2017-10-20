@extends('layouts.secretary-master')

@section('content')

<!--   <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h5>Add New Order</h5>
    </div>
  </div> -->

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Add New Order</h5>
  </div>
</div>


  <div class="contents">
      <form action="{{ URL::to('/sec-order/add-to-list') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
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
                                <!-- <ul class="tabs tabs-fixed-width">
                                @foreach($type as $stype)
                                  <li class="tab"><a href="#{{ $stype->intITID }}">{{ $stype->strITDesc }}</a></li>
                                @endforeach
                                </ul> -->
                                @foreach($type as $stype)
                                 <p>
                                    <input name="group1" type="radio" class="radioProducts" id="#{{ $stype->intITID }}" value="{{ $stype->strITDesc }}"/>
                                    <label for="#{{ $stype->intITID }}">{{ $stype->strITDesc }}</label>
                                 </p>
                                  <!-- <li class="tab"><a href="#{{ $stype->intITID }}">{{ $stype->strITDesc }}</a></li> -->
                                @endforeach
                            </div>
                        </div>

                      @foreach($type as $subt)
                        <div class="card-content something"  id="id{{ $subt->intITID }}">
                               <div id="#{{ $subt->intITID }}" class="viewSelect">
                                 <div class="row">
                                  <label for="payment-mode">Products:</label>
                                    <select name="name" id="name">
                                     <option value="0" disabled selected>- Select {{$subt->strITDesc}} -</option>
                                     @foreach($data as $prod)
                                     @if($prod->intItemType == $subt->intITID)
                                     <option value="{{$prod->intItemID}}">{{$prod->strItemBrand}} - {{$prod->strItemName}} - {{$prod->strItemDesc}}</option>
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
                                      <td>{{$l->strItemDesc}}</td>
                                      <td>{{$l->intOQty}}</td>
                                      <td><a class="waves-effect waves-light btn btn-small red center-text" href="/sec-order/rem-to-list/{{$l->intOProdID}}">REMOVE</a></td>
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
                <a  @if($list == NULL)id="submitBtn"@endif class="waves-effect waves-light btn btn-green modal-btn" href="/sec-inv/add-order">SUBMIT</a>
                <a href="{{ URL::to('/sec-order') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
              </div>
            </div>
            <br><br>
           <!-- </form> -->
        </div>


{{-- Scripts START --}}
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
  $().ready(function() {
    $("#signup_validate").validate({
      rules: {
        qty: "required",
        // name: "required",
      },
      errorElement: 'div'
    });
  });

    $("#submitBtn").click(function(e){
    alert("YOU HAVE NO ITEMS IN THE LIST!");
    e.preventDefault();
  });

$(".something").addClass("hide");

$(document).ready(function() {
  var qty = document.getElementById("qty");

    $("#qty").keypress(function(e){
      var maxval = 2;

      if(qty.value.length > maxval && e.keyCode != 46 && e.keyCode != 8)
      {
        e.preventDefault();                    
      }
    });
    
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
});

</script>
{{-- Scripts END --}}
@endsection