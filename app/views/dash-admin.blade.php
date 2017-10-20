@extends('layouts.admin-master')

@section('content')

<!-- header -->
<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Stocks on Main</h5>
  </div>
</div>

<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <div class="container-fluid">
    <div class="card">
      <div class="card-content">
        <div class="row">
          <div class="col s12 m12 l12">
                <a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/admin/ord">ADD NEW ITEM STOCK</a>
                <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#allbranch">VIEW ALL BRANCHES</a>
                <a class="modal-trigger waves-effect waves-light btn btn-flat right btn-small center-text" href="{{ URL::to('/reports') }}">Generate Report</a>
          </div>
        </div>
        <h4> Products</h4>
        <div id="allbranch" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Inventories on other Branches</h4>
                                  <p>
                                    @foreach($branch as $br)
                                    <h5>{{$br->strBranchName}}</h5>
                                                    <table class="centered table-fixed">
                                                      <thead>
                                                          <tr>
                                                              <th>Product Brand</th>
                                                              <th>Product Name</th>
                                                              <th>Product Description</th>
                                                              <th>Product Type</th>
                                                              <th>Price</th>
                                                              <th>Available Stock</th>
                                                              <th>Expiry Date</th>
                                                              <th>Status</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                      @foreach($alls as $all)
                                                          @if($br->intBranchID == $all->intInvBranch)
                                                         <tr>
                                                              <td>{{ $all->strItemBrand}}</td>
                                                              <td>{{ $all->strItemName }}</td>
                                                              <td>{{ $all->strItemDesc }}</td>
                                                              <td>{{ $all->strITDesc }}</td>
                                                              <td>{{ $all->dcPrice }}</td>
                                                              <td>{{ $all->sum }}</td>
                                                              @if($all->dtInvExpiry == NULL)
                                                              <td>N/A</td>
                                                              @else
                                                              <td>{{ $all->dtInvExpiry }}</td>
                                                              @endif 
                                                              @if($all->intISID == 1)
                                                              <td class="green-text bold">{{ $all->strISDesc }}</td>
                                                              @elseif($all->intISID == 2)
                                                              <td class="yellow-text bold">{{ $all->strISDesc }}</td>
                                                              @elseif($all->intISID == 3)
                                                              <td class="red-text bold">{{ $all->strISDesc }}</td>
                                                              @endif
                                                          </tr>
                                                        @elseif($all == NULL)   
                                                        @endif
                                                      @endforeach 
                                                      </tbody>
                                                    </table>
                                    @endforeach
                                  </p>
                                </div>
                                <div class="modal-footer col 6">
                                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>
                                </div>
                              </div>
        <div class="row">
          <div class="nav-wrapper">
            <div class="container-fluid">
                      <h5>Non-Expirables</h5>
              <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Product Brand</th>
                        <th>Product Name</th>
                        <th>Product Description</th>
                        <th>Product Type</th>
                        <th>Price</th>
                        <th>Available Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                      <tr>
                        <td>{{$data->strItemBrand}}</td>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemDesc }}</td>
                        <td>{{ $data->strITDesc }}</td>
                        <td>{{ $data->dcPrice }}</td>
                        <td>{{ $data->sum }}</td>
                        <td>
                            @if($data->intIsPerishable == 1)
                            <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#{{$data->intInvID}}">EXPIRATION</a>
                            @endif
                             <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#{{$data->intInvID}}/stocks">STOCK CARD</a>
                        </td>


                              <!-- Modal Structure -->
                              <div id="{{$data->intInvID}}" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Expiration for {{$data->strItemName}} - {{$data->strInvLotNum}}</h4>
                                  <p>
                                  <form action="/adjust/{{$data->intInvID}}" method="POST">
                                             <br>
                                          <div class="row">
                                            <div class="col s12 m8 l6">
                                              <label for="date">Choose Expiry Date</label>
                                              <input id="date" name="date" type="date" class="datepicker" style="height:39px" value="">
                                            </div>
                                          </div> 
                                  </p>
                                </div>
                                <div class="modal-footer col 6">
                                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CANCEL</a>
                                  <button type="submit" class="waves-effect waves-green btn-flat ">SUBMIT</button>
                                </div>
                                </form>
                              </div>

                    </tr>
                   @endforeach 
                </tbody>
              </table>
              <br>
              <h5>Expirables</h5>
              <table id="example2" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Product Brand</th>
                        <th>Product Name</th>
                        <th>Product Description</th>
                        <th>Product Type</th>
                        <th>Price</th>
                        <th>Available Stock</th>
                        <th>Expiration Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data2 as $data)
                      <tr>
                        <td>{{ $data->strItemBrand }}</td>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemDesc }}</td>
                        <td>{{ $data->strITDesc }}</td>
                        <td>{{ $data->dcPrice }}</td>
                        <td>{{ $data->intInvQty }}</td>
                        @if($data->dtInvExpiry != null)
                        <td>{{ $data->dtInvExpiry }}</td>
                        @else
                        <td>PLEASE SET AN EXPIRY</td>
                        @endif
                        <td>
                            @if($data->intIsPerishable == 1)
                            @if($data->dtInvExpiry == null)
                            <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#{{$data->intInvID}}">SET EXPIRATION</a>
                            @endif
                            @endif
                             <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#{{$data->intInvID}}/stocks">STOCK CARD</a>
                        </td>


                              <!-- Modal Structure -->
                              <div id="{{$data->intInvID}}" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Expiration for {{$data->strItemName}} - {{$data->strInvLotNum}}</h4>
                                  <p>
                                  <form action="/set-exp/{{$data->intInvID}}" method="POST">
                                             <br>
                                          <div class="row">
                                            <div class="col s12 m8 l6">
                                              <label for="date">Choose Expiry Date</label>
                                              <input id="date" name="date" type="date" class="datepicker" style="height:39px" value="">
                                            </div>
                                          </div> 
                                  </p>
                                </div>
                                <div class="modal-footer col 6">
                                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CANCEL</a>
                                  <button type="submit" class="waves-effect waves-green btn-flat ">SUBMIT</button>
                                </div>
                                </form>
                              </div>

                    </tr>
                   @endforeach 
                </tbody>
              </table>
            <br>
            <h5>Materials</h5>
            <table id="example1" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Material Name</th>
                        <th>Material Description</th>
                        <th>Material Type</th>
                        <th>Price</th>
                        <th>Available Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($mat as $data)
                      <tr>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemDesc }}</td>
                        <td>{{ $data->strITDesc }}</td>
                        <td>{{ $data->dcPrice }}</td>
                        <td>{{ $data->sum }}</td>
                        <td>
                             <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#{{$data->intInvID}}/stocks">STOCK CARD</a>
                        </td>
                    </tr>
                   @endforeach 
                </tbody>
              </table>
              <br>
                            @foreach($prod as $prod)
                                                        <!-- Modal Structure -->
                              <div id="{{$prod->intInvID}}/stocks" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Stock Card for {{$prod->strItemName}} - {{$prod->strItemDesc}}</h4>
                                  <p>
                                                      <table class="centered table-fixed">
                                                      <thead>
                                                          <tr>
                                                              <th>Date</th>
                                                              <th>Batch Number</th>
                                                              <th>Lot Number</th>
                                                              <th>Quantity</th>
                                                              <th>Type</th>
                                                              <th>Reason</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                      @foreach($stock as $data)
                                                            @if($prod->intItemID == $data->intItemID)
                                                            <tr>
                                                              <td>{{ $data->dtAdjDate }}</td>
                                                              <td>{{ $data->strAdjCode }}</td>
                                                              <td>{{ $data->strInvLotNum }}</td>
                                                              <td>{{ $data->intAdjQty }}</td>
                                                              @if($data->intAdjStatus == 1)
                                                              <td class="blue-text bold">Acquired</td>
                                                              @else
                                                              <td class="red-text bold">Delivered</td>
                                                              @endif
                                                              <td>{{ $data->strAdjReason }}</td>
                                                          </tr>
                                                          @endif
                                                         @endforeach 
                                                      </tbody>
                                                    </table>
                                  </p>
                                </div>
                                <div class="modal-footer col 6">
                                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>
                                </div>
                              </div>
                              @endforeach

            <br>
            </div>
            <!-- dito naman yung mga susunod na shits kung may idadagdag pa ^_^ -->
          </div>
        </div>
      </div>
    </div>

    <div class="col s12 m12 l6">
      <div class="card-panel">
        <span class="card-title">Pending Requests</span>
        <hr>
        <div class="card-content">
         @if($ord != null)
          <p>
            You have pending requests.
          </p>
          <table class="centered table-fixed">
            <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Branch Name</th>
                        <th>Ordered Items</th>
                        <th>Date Ordered</th>
                        <th>Action</th>
                    </tr>
            </thead>

            <tbody>
               @foreach($ord as $order)
                      <tr>
                        <td>{{ $order->strOCode }}</td>
                        <td>{{ $order->strBranchName }}</td>
                        <td><a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#{{$order->strOCode}}/items">VIEW ORDERS</a></td>
                        <td>{{ $order->created_at }}</td>
                        @if($order->intStatus == 2)
                        <td @if($order->intStatus == 1) class="green-text bold" @else class="yellow-text bold" @endif>{{ $order->strOSDesc }}</td>
                        <td>
                            <div class="center-btn" id="deliverBtn">
                             <a class="waves-effect waves-light btn green darken-1 btn-small center-text" href="admin/deliver/{{$order->intOID}}">DELIVER</a>
                            </div>
                        @elseif($order->intStatus == 1)
                        <td>
                        <a class="green-text bold"> Received at {{ $order->dtOReceived }} </a>
                      </td>
                       <td><a class="modal-trigger waves-effect waves-light btn blue darken-1 btn-small center-text" href="#{{$order->intOID}}">DETAILS</a>
                         @elseif($order->intStatus == 4)
                        <td>
                        <a class="orange-text bold"> ON DELIVERY </a>
                      </td>
                      <td>
                        <a class="modal-trigger waves-effect waves-light btn blue darken-1 btn-small center-text" href="#{{$order->intOID}}">DETAILS</a>
                        @endif
                        </td>
                </td>
              </tr>

              @endforeach
            </tbody>
          </table>

          @foreach($ord as $order)
                        <!-- Modal Structure -->
                              <div id="{{$order->intOID}}" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Delivery Received from {{$order->strOCode}}</h4>
                                  <p>
                                   <table class="centered table-fixed">
                                                      <thead>
                                                          <tr>
                                                              <th>Item Name</th>
                                                              <th>Item Description</th>
                                                              <th>Delivered Qty</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                      @foreach($del as $del2)
                                                            @if($del2->intDelCode == $order->intOID)
                                                            <tr>
                                                              <td>{{ $del2->strItemName }}</td>
                                                              <td>{{ $del2->strItemDesc }}</td>
                                                              @if($del2->strDelReason != NULL)
                                                              <td>{{ $del2->intDelQty }} - {{ $del2->strDelReason }}</td>
                                                              @else
                                                              <td>{{ $del2->intDelQty }}</td>
                                                              @endif
                                                          </tr>
                                                          @endif
                                                         @endforeach 
                                                      </tbody>
                                                    </table>
                                  </p>
                                </div>
                                <div class="modal-footer col 6">
                                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CANCEL</a>
                                </div>
                              </div>
          @endforeach

          @foreach($test as $test)
                              <div id="{{$test->strOCode}}/items" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Ordered Items</h4>
                                  <p>
                                                      <table class="centered table-fixed">
                                                      <thead>
                                                          <tr>
                                                              <th>Item Name</th>
                                                              <th>Item Description</th>
                                                              <th>Quantity</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                      @foreach($list as $listi)
                                                            @if($listi->intODCode == $test->intOID)
                                                            <tr>
                                                              <td>{{ $listi->strItemName }}</td>
                                                              <td>{{ $listi->strItemDesc }}</td>
                                                              <td>{{ $listi->intOQty }}</td>
                                                          </tr>
                                                          @endif
                                                         @endforeach 
                                                      </tbody>
                                                    </table>
                                  </p>
                                </div>
                                <div class="modal-footer col 6">
                                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>
                                </div>
                              </div>
          @endforeach

          @else
          <p>
            You have no pending requests.
          </p>
          @endif
        </div>
      </div>


    </div>
  </div>
</div>

@stop

@section('scripts')
 <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.material.min.js"></script>

  <script type="text/javascript">
$(document).ready(function() {
  alert("PAYAMON!");

  $('#deliverBtn').click(function(e){
    alert("You clicked deliver button");
    e.preventDefault();
  });

    $('#example').DataTable( {
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ],
        "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
        "paging":   true,
        "ordering": true,
        "info":     true

    } );

     $('#example1').DataTable( {
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ],
        "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
        "paging":   true,
        "ordering": true,
        "info":     true

    } );

     $('#example2').DataTable( {
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ],
        "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
        "paging":   true,
        "ordering": true,
        "info":     true

    } );
} );
  </script>

    <script>
    $(document).ready(function(){

    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
    </script>
@stop

