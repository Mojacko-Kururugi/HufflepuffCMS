@extends('layouts.master')

@section('content')

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Inventory</h5>
  </div>
</div>

<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <div class="container-fluid">
    <div class="row">
        <div class="col s12 m12 l12">
            <button class="modal-trigger waves-effect waves-light btn blue darken-1 btn-small center-text" href="#newprod">ADD NEW ITEMS</button>
            <button class="modal-trigger waves-effect waves-light btn btn-small purple lighten-1 center-text" href="#viewprod">VIEW ALL ITEMS</button>
            <a class="modal-trigger waves-effect waves-light btn btn-flat right btn-small center-text" href="{{ URL::to('/reports') }}">Generate Report</a>
        </div>
     </div>

      <div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <span class="card-title">Items on Brgy Sangandaan branch</span>
                <hr>
                <div class="card-content">
                  
                  </div>

                  <div class="col s12 m12 l12 overflow-x">
                    <table class="centered">
                      <thead>
                        <tr>
                          <th>Batch ID</th>
                          <th>Product Name</th>
                         <!--  <th>Brand</th>
                          <th>Model</th> -->
                          <th>Price</th>
                          <th>Available Stock</th>
                          <th>Status</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td>INV001</td>
                          <td>Model 37982</td>
                          <td>P300</td>
                          <td>15</td>
                          <td class="green-text bold">Good</td>
                          <td>
                              <div class="center-btn">
                               <a class="waves-effect waves-light btn btn-small center-text" href="">REPLENISH</a>
                              </div>
                          </td>
                        </tr>

                        <tr>
                          <td>INV002</td>
                          <td>Lens 2923</td>
                          <td>P500</td>
                          <td>0</td>
                          <td class="red-text bold">Out of Stock</td>
                          <td>
                              <div class="center-btn">
                               <a class="waves-effect waves-light btn btn-small center-text" href="">REPLENISH</a>
                              </div>
                          </td>
                        </tr>
                         
                        <tr>
                          <td>INV003</td>
                          <td>Model 0734</td>
                          <td>P200</td>
                          <td>2</td>
                          <td class="yellow-text bold">Low</td>
                          <td>
                              <div class="center-btn">
                               <a class="waves-effect waves-light btn btn-small center-text" href="">REPLENISH</a>
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

