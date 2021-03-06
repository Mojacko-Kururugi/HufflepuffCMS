@extends('layouts.secretary-master')

@section('content')
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!--   <div class="row">
    <div class="center col l12 m12 s12">
      <h3>Job Order</h3>
    </div>
  </div>
 -->

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Job Order</h5>
  </div>
</div>


<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <form action="{{ URL::to('/sec-joborder-add') }}" method="POST" id="signup_validate" enctype="multipart/form-data">
       <div class="row">
       @if($data3 != null)
            <div class="input-field col s12 m4 l4">
                <input type="text" id="search" value="{{$data3->strPatLast . ', ' . $data3->strPatFirst}}">
                <label class="label-icon" for="search">Customer</label>
            </div>
      @else
            <div class="input-field col s12 m4 l4">
            <!-- <i class=" material-icons prefix">search</i> -->
              <label class="label-icon" for="search"></label>
              <select name="patient" id="patient" class="browser-default">
              <option value="0" disabled selected>- Select Customer Name -</option>
              @foreach($pat as $pat)
              <option value="{{$pat->intPatID}}">{{$pat->strPatLast . ", " . $pat->strPatFirst}}</option>
              @endforeach
              </select>
            </div>
      @endif
            <div class="input-field col s12 m4 l4">
              <!-- dapat autogenerated-->
              <input type="text" name="transaction-no" required="" value="{{Session::get('purch_sess')}}">
              <label for="transaction-no">Transaction No.</label>
            </div>

            <div class="col s12 m4 l4">
              <label class="label-icon" for="jotype">Job Order Type</label>
                 <select class="browser-default" name="jotype" id="jotype" data-error=".jotype_error">
                    <option value="" disabled selected>- select JO type -</option>
                    <option value="1">Customization</option>
                    <option value="2">Repair</option>
                 </select>
              <div class="exp_error"></div>
            </div>          
      </div>

      <div class="card">
        <div class="card-content">
            <div class="row">
              <div class="col l12 m6 s6">
                  <div class="row">
                      <div class="col s12">

                              <p>
                                  <input type="checkbox" class="filled-in" id="eyeglass" name="eyeglass" value="1"/>
                                  <label for="eyeglass" class="black-text bold">EYE GLASS</label>
                              </p>
                              <p>
                                  <input type="radio" name="group1" id="single" name="single" value="2">
                                  <label for="single" class="light-blue-text text-darken-4 bold">SINGLE</label>
                              </p>
                              <div id="divSingle" class="row">
                                <div class="col l4 s12">
                                  <p style="text-indent: 20px">
                                    <input type="checkbox" id="lhi" name="lhi" value="3">
                                    <label for="lhi">LHI MULTI</label>
                                  </p>
                                  <p style="text-indent: 20px">
                                      <input type="checkbox" id="multi" name="multi" value="4">
                                      <label for="multi">MULTI</label>
                                  </p>
                                </div>
                                <div class="col l4 s12">
                                  <p style="text-indent: 20px">
                                    <input type="checkbox" id="hc" name="hc" value="5">
                                    <label for="hc">H.C.</label>
                                  </p>
                                  <p style="text-indent: 20px">
                                      <input type="checkbox" id="cr39" name="cr39" value="6">
                                      <label for="cr39">CR39</label>
                                  </p>
                                </div>
                                <div class="col l4 s12"></div>
                              </div>

                      </div>
                      <div class="col s12">

                              <p style="">
                                  <input type="radio"  name="group1" id="double" name="double" value="7">
                                  <label for="double" class="light-blue-text text-darken-4 bold">DOUBLE</label>
                              </p>
                              <div id="divDouble">
                                <div class="row">
                                  <div class="col l4 s12">
                                    <p style="text-indent: 20px">
                                      <input type="checkbox" id="kk" name="kk" value="8">
                                      <label for="kk">KK</label>
                                    </p>
                                    <p style="text-indent: 20px">
                                        <input type="checkbox" id="flattop" name="flattop" value="9">
                                        <label for="flattop">FLAT TOP</label>
                                    </p>
                                    <p style="text-indent: 20px">
                                        <input type="checkbox" id="progressive" name="progressive" value="a">
                                        <label for="progressive">PROGRESSIVE</label>
                                    </p>
                                  </div>
                                  <div class="col l4 s12">
                                      <p style="text-indent: 20px">
                                          <input type="checkbox" id="exec" name="exec" value="b">
                                          <label for="exec">EXEC</label>
                                      </p>
                                      <p style="text-indent: 20px">
                                          <input type="checkbox" id="noline" name="noline" value="c">
                                          <label for="noline">NOLINE</label>
                                      </p>
                                  </div>
                                  <div class="col l4 s12"></div>
                                </div>
                                <div class="row">
                                  <div class="col l4 s12">
                                     <p style="text-indent: 20px; margin-left: 30px">
                                        <input type="checkbox" id="hoyanm" name="hoyanm" value="d">
                                        <label for="hoyanm">HOYA NM</label>
                                      </p>
                                  </div>
                                  <div class="col l4 s12">
                                    <p style="text-indent: 20px">
                                        <input type="checkbox" id="vrx" name="vrx" value="e">
                                        <label for="vrx">VRX</label>
                                    </p>
                                  </div>
                                  <div class="col l4 s12"></div>
                                  
                                </div>
                                
                                <div class="row">
                                  <div class="col l4 s12">
                                    <p style="text-indent: 20px">
                                        <input type="checkbox" id="hoyamlti" name="hoyamlti" value="f">
                                        <label for="hoyamlti">HOYA MLTI</label>
                                    </p>
                                  </div>
                                  <div class="col l4 s12">
                                    <p style="text-indent: 20px">
                                        <input type="checkbox" id="pentax" name="pentax" value="g">
                                        <label for="pentax">PENTAX</label>
                                    </p>
                                  </div>
                                  <div class="col l4 s12"></div>
                                </div>
                              </div>

                      </div>
                  </div>
                  <div class="row">
                      <div class="col s12 m6 l4">

                              <p>
                                  <input type="checkbox" class="filled-in" id="glass" name="glass" value="h" />
                                  <label for="glass" class="black-text bold">GLASS</label>
                              </p>
                              <p>
                                  <input type="checkbox" class="filled-in" id="plastic" name="plastic" value="i"/>
                                  <label for="plastic" class="black-text bold">PLASTIC</label>
                              </p>

                      </div>
                    
                  </div>
              </div>
            </div>
        </div>
      </div>
      <hr>
      
      <div class="card">
          <div class="card-content">
              <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Sph. / Cyl*</th>
                      <th>Axis*</th>
                      <th>B.C.*</th>
                      <th>P.D.*</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td>O.D.</td>
                        <td><input type="text" name="odsc" id="odsc"></td>
                        <td><input type="text" name="odax" id="odax"></td>
                        <td><input type="text" name="odbc" id="odbc"></td>
                        <td><input type="text" name="odpd" id="odpd"></td>
                      </tr>
                      <tr>
                        <td>O.S.</td>
                        <td><input type="text" name="ossc" id="ossc"></td>
                        <td><input type="text" name="osax" id="osax"></td>
                        <td><input type="text" name="osbc" id="osbc"></td>
                        <td><input type="text" name="ospd" id="ospd"></td>
                      </tr>
                  </tbody>
              </table>
              <div class="row">
                 <div class="col l4">
                <label class="label-icon" for="frames">Frame:</label>
                  <select class="browser-default" name="frames" id="frames" data-error=".frames_error">
                      @foreach($data as $data)
                      <option value="{{$data->intInvID}}">{{$data->strItemName}}</option>
                      @endforeach
                  </select> 
                  <div class="frames_error"></div>
                  <br/>
                <label class="label-icon" for="lens">Lens:</label>
                    
                  <select class="browser-default" name="lens" id="lens" data-error=".lens_error">
                      @foreach($data2 as $data2)
                      <option value="{{$data2->intInvID}}">{{$data2->strItemName}}</option>
                      @endforeach
                  </select> 
                  <div class="lens_error"></div>
                </div>

                <div class="col l4">
                Add OD*:<input type="text" name="addod" id="addod">
                Add OS*:<input type="text" name="addos" id="addos">
                </div>
              </div>

                        <div class="col s6">
                <label for="payment-mode">Payment Mode*:</label>
                <select class="browser-default" name="payment-mode" id="payment-mode" data-error=".pay_error">
                   <option value="" disabled selected>- Choose your option -</option>
                   <option value="1">Full Payment</option>
                   <option value="2">2 Gives - every 15 days</option>
                   <option value="3">Quarterly - every 7 days</option>
                </select>
                <div class="pay_error"></div>
          </div>
             
          </div>  
      </div>
      <hr>
      <div class="card">
        <div class="card-content">
          <div class="row">
      <!--          <div class="col l6 m6 s12">
                    <div class="row">
                      <div class="input-field">
                        <label for="note">Note:</label>
                        <input id="note" name="note" type="text" value="" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field">
                        <label for="doctor">Doctor-in-Charge:</label>
                        <input id="doctor" name="doctor" type="text" value="" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field">
                        <label for="sales">Sales-in-Charge:</label>
                        <input id="sales" name="sales" type="text" value="{{Session::get('user_name')}}" />
                      </div>
                    </div>
                </div>
                <div class="col s12 m6 l6">
                    <div class="row">
                      <div class="input-field"> 
                        <label for="amount">Amount*:</label>
                        <input type="number" name="amount" id="amount">
                      </div>
                    </div>

                </div>
          </div> -->

          <div class="row">
              <div class="input-field col l12 s12 center">
                <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Save</button>
                <a href="{{ URL::to('/sec-add-payment') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
              </div>
            </div
        </div>
      </div>

  </form>
</div>


{{-- Scripts START --}}
<!--<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.validate.min.js"></script>-->
<script type="text/javascript">
    $().ready(function() {
    $("#signup_validate").validate({
      rules: {
        jotype: "required",
        odsc: "required",
        odax: "required",
        odbc: "required",
        odpd: "required",
        ossc: "required",
        osax: "required",
        osbc: "required",
        ospd: "required",
        frames: "required",
        lens: "required",
        addod: "required",
        addos: "required",
        // patient: "required",
        amount: "required",
      },
      errorElement: 'div'
    });
  });


  $(document).ready(function() {

    var amount = document.getElementById("amount");
       
       $("#amount").blur(function(){
          amount.value = parseFloat(amount.value).toFixed(2);
          //alert(price.value); 
       });

    $("#divSingle").hide();
    $("#divDouble").hide();
    $("input[name$='group1']").click(function() {
        var radio = $(this).attr('id');
        if(radio == "single"){
          $("#divSingle").show();
          $("#divDouble").hide();
          $('#lhi, #multi, #hc, #cr39').attr('checked', false);
        }else{
          $("#divSingle").hide();
          $("#divDouble").show();
          $('#kk, #flattop, #progressive, #exec, #noline, #hoyanm, #hoyamlti, #vrx, #pentax ').attr('checked', false);
        }
    });
});

</script>
{{-- Scripts END --}}
@endsection