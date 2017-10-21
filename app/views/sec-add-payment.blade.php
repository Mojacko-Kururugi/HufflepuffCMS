@extends('layouts.secretary-master')

@section('content')
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!--   <div class="row">
    <div class="center col l12 m12 s12">
      <h5>POS</h5>
    </div>
  </div> -->

<?php
  if(Session::get('purch_mess') != null)
    {
      $message = "Insufficient Stock!";
echo "<script type='text/javascript'>alert('$message');</script>";
      Session::forget('purch_mess');
    }
?>

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>POS</h5>
  </div>
</div>

  <div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <form action="{{ URL::to('/sec-purch/add-to-list') }}" method="POST" id="signup_validate" enctype="multipart/form-data">
 <div class="row">
        @if($data3 != null)
            <div class="input-field col s12 m4 l4">
                <input type="text" id="search" value="{{$data3->strPatLast . ', ' . $data3->strPatFirst}}">
                <label class="label-icon" for="search">Customer</label>
            </div>
      @else
    <div class="input-field col s12 m4 l4">
    <i class=" material-icons prefix"></i>
      <label class="label-icon" for="search"></label>
      <select name="patient" id="patient">
      <option value="0" disabled selected>- Select Customer Name -</option>
      @foreach($pat as $pat)
      <option value="{{$pat->intPatID}}">{{$pat->strPatLast . ", " . $pat->strPatFirst}}</option>
      @endforeach
      </select>
    </div>
@endif
    <div class="input-field col s12 m4 l4">
      <!-- dapat autogenerated-->
      <input type="text" name="transaction-no" required="" value="{{$count}}" readonly>
      <label for="transaction-no">Transaction No.</label>
    </div>

    <div class="row">
      <a class="waves-effect waves-light btn" href="/sec-job-order"><i class="material-icons right"></i>Create Job Order</a>
    </div>
 </div>

  <div class="row">
    <div class="col s12 m12 l6">
      <div class="card-panel">
        <span class="card-title">Products</span>
        <hr>
        <div class="card-content">
         <div class="card-tabs">
            <ul class="tabs tabs-fixed-width">
                        <ul class="tabs tabs-fixed-width">
                                @foreach($type as $stype)
                                  <li class="tab"><a href="#{{ $stype->intITID }}">{{ $stype->strITDesc }}</a></li>
                                @endforeach
                                </ul>
            </ul>
        </div>
                      @foreach($type as $subt)
                        <div class="card-content">
                               <div id="{{ $subt->intITID }}">
                                 <div class="row">
                                  <label for="payment-mode">Products:</label>
                                  @if($subt->intIsPerishable == 1)
                                    <select name="name" id="name">
                                     <option value="0" disabled selected>- Select {{$subt->strITDesc}} -</option>
                                     @foreach($data as $prod)
                                     @if($prod->intItemType == $subt->intITID)
                                     <option value="{{$prod->intInvID}}">{{$prod->strInvBatCode}} - {{$prod->strInvLotNum}} - {{$prod->strItemBrand}} - {{$prod->strItemName}} - {{$prod->strItemDesc}}</option>
                                     @endif
                                     @endforeach
                                    </select>
                                 </div>
                                 @else
                                    <select name="name" id="name">
                                     <option value="0" disabled selected>- Select {{$subt->strITDesc}} -</option>
                                     @foreach($data as $prod)
                                     @if($prod->intItemType == $subt->intITID)
                                     <option value="{{$prod->intInvID}}">{{$prod->strItemBrand}} - {{$prod->strItemName}} - {{$prod->strItemDesc}}</option>
                                     @endif
                                     @endforeach
                                    </select>
                                 </div>
                                @endif

                               </div>
                        </div>
                      @endforeach
       </div>   
    </div>
    <div class="row">
                <div class="input-field col l6 m6 s6">
                   <label for="qty">Quantity</label>
                    <input id="qty" name="qty" type="number" min="1" class="validate" value="" />
                </div>
                <div class="col s6 m6 s6 middle">
                    <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Add</button>
                </div>
              </div>
  </form>
          <br/>
          <br/>
          <br/>
          <br/>
            <div class="row">
              <div class="input-field col l12 s12 center">
                <a @if($list == NULL && $list2 == NULL && $list3 == NULL )id="submitBtn"@endif  class="waves-effect waves-light btn btn-green modal-btn" href="/sec-purch/payment">PROCEED TO PAYMENT</a>
                <a href="{{ URL::to('/sec-home') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
              </div>
            </div>
  </div>

    <div class="col s12 m12 l6">
      <div class="card-panel">
        <span class="card-title">Cart</span>
        <hr>
        <div class="card-content">
          <div v-show="isCartEmpty">
             <!--<span class="label label-primary">No items on cart</span>-->
          </div>
          <table class="table cart-table table-hover" v-show="!isCartEmpty">
              <thead>
                <tr class="register-items-header">
                  <th>Product Name and Desc</th>
                  <th class="text-center">Qty.</th>
                  <th class="text-center">Price</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $total = 0 ?>
                 @foreach($list as $l)
                                    <tr>
                                      <td>{{$l->strItemName . " - " . $l->strItemDesc}}</td>
                                      <?php $subtotal = $l->dcTotPrice?>
                                      <td>{{$l->intQty}}</td>
                                      <td>P {{$l->dcTotPrice}}</td>
                                      <td><a class="waves-effect waves-light btn btn-small red center-text" href="/sec-purch/rem-to-list/{{$l->intHInvID}}">REMOVE</a></td>
                                    </tr>
                  <?php $total += $subtotal ?>    
                 @endforeach
                 @foreach($list2 as $l2)
                        <tr>
                          <td>{{$l2->strJOName}}</td>
                          <td>1</td>
                          <?php $subtotal = $l2->dcJOFee ?>
                          <td>P {{$subtotal}}</td>
                          <td><a class="waves-effect waves-light btn btn-small red center-text" href="/sec-purch/rem-jo-list/{{$l2->strJOHC}}">REMOVE</a></td>
                        </tr>
                        <?php $total += $subtotal ?>
                        <tr>
                          <td>-- {{$jofr->strItemName . " - " . $jofr->strItemDesc}}</td>
                          <td>1</td>
                          <td>( {{$jofr->dcPrice}} )</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>-- {{$jolens->strItemName . " - " . $jolens->strItemDesc}}</td>
                          <td>1</td>
                          <td>( {{$jolens->dcPrice}} )</td>
                          <td></td>
                        </tr>
                 @endforeach
                @foreach($list3 as $l3)
                        <tr>
                          <td>Medical Fee</td>
                          <td></td>
                          <?php $subtotal = $l3->dcCRFee ?>
                          <td>P {{$subtotal}}</td>
                          <td></td>
                        </tr>
                        <?php $total += $subtotal ?>
                 @endforeach
              </tbody>
              <tr class="dashed" id="summary-grand-total">
                  <td><h6 class="sales-info">TOTAL: </h6></td>
                  <td></td>
                  <td>
                      <h6 class="sales-info">P {{$total}}</h6>
                      <strong class="text-success"></strong>
                  </td>
              </tr>  
          </table>
        </div>
      </div>

    </div>
  </div>

</div>


{{-- Scripts START --}}
<!--<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.validate.min.js"></script>-->
<script type="text/javascript">
  $().ready(function() {

    var qty = document.getElementById("qty");

  $("#qty").keypress(function(e){
    var maxval = 2;

    if(qty.value.length > maxval && e.keyCode != 46 && e.keyCode != 8)
    {
       e.preventDefault();                    
    }
  });

  $("#submitBtn").click(function(e){
    alert("YOU HAVE NO ITEMS IN THE LIST!");
    e.preventDefault();
  });

    $("#signup_validate").validate({
      rules: {
        qty: "required",
        // name: "required",
      },
      errorElement: 'div'
    });
  });
</script>
{{-- Scripts END --}}
@endsection