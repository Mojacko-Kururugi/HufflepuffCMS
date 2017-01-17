@extends('layouts.master')

@section('content')
      <div class="main-wrapper">
        <!-- ACTUAL PAGE CONTENT GOES HERE -->
        <div class="row">
          <div class="col s12 m12 l12">
            <span class="page-title">Sales</span>
          </div>

          <div class="row">
      <div class="col s12 m12 l6">
        <div class="col s12 m12 l10">
        <button class="modal-trigger waves-effect waves-light btn btn-small center-text" href="#newprod">ADD NEW PAYMENT</button>
            <a class="modal-trigger waves-effect waves-light btn btn-small center-text" href="{{ URL::to('/reports') }}">GENERATE SALES REPORT</a>
        </div>
      </div>
     </div>

  


          <div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <span class="card-title">Sales on Brgy Sangandaan branch</span>
                <div class="divider"></div>
                <div class="card-content">
                  
                  </div>

                  <div class="col s12 m12 l12 overflow-x">
                    <table class="centered">
                      <thead>
                        <tr>
                          <th>Patient</th>
                          <th>Details</th>
                         <!--  <th>Brand</th>
                          <th>Model</th> -->
                          <th>Total Sale</th>
                          <th>Type of Payment</th>
                          <th>Paid Amount</th>
                          <th>Status</th>
                        </tr>
                      </thead>

                      <tbody>

                         
                        <tr>
                          <td>Amac, Pamela</td>
                          <td>Eye check ups with follow up</td>
                          <td>P500</td>
                          <td>Full Payment On-Hand</td>
                          <td>P500</td>
                          <td class="green-text bold">FULLY PAID</td>
                          <td>
                            <div class="center-btn">
                              <a class="waves-effect waves-light btn btn-small center-text" href="">VIEW FULL DETAILS</a>
                            </div>
                          </td>
                        </tr>

                         <tr>
                          <td>Gallardo, Joseph</td>
                          <td>Check up with Lens recommendation</td>
                          <td>P1000</td>
                          <td>Half Payment per 15 days Bank Deposit</td>
                          <td>P500</td>
                          <td class="yellow-text bold">ONGOING</td>
                          <td>
                            <div class="center-btn">
                              <a class="waves-effect waves-light btn btn-small center-text" href="">VIEW FULL DETAILS</a>
                            </div>
                          </td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                  <!-- <p>
                    You have no items.
                  </p> -->

                  <div class="clearfix">

                  </div>
                </div>
              </div>
            </div>
          </div>

@stop

@section('scripts')
<!--{{ HTML::script('js/new-order.js') }}-->
<script type="text/javascript" src="js/jquery.js"></script>
<script src="js/materialize.js"></script>
<script>   
    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  }); 
</script>
@stop

