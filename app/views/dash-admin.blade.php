@extends('layouts.admin-master')

@section('content')

<!-- header -->
<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Inventory on Main</h5>
  </div>
</div>

<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <div class="container-fluid">
    <div class="card">
      <div class="card-content">
        <div class="row">
          <div class="col s12 m12 l12">
                <a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/admin/ord">ADD NEW ITEMS</a>
                <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#allbranch">VIEW ALL BRANCHES</a>
                <a class="modal-trigger waves-effect waves-light btn btn-flat right btn-small center-text" href="{{ URL::to('/reports') }}">Generate Report</a>
          </div>
        </div>
        <h5>Products</h5>
        <div id="allbranch" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Inventories on other Branches</h4>
                                  <p>
                                    @foreach($branch as $branch)
                                    <h5>{{$branch->strBranchName}}</h5>
                                                    <table class="centered table-fixed">
                                                      <thead>
                                                          <tr>
                                                              <th>Product Brand</th>
                                                              <th>Product Name</th>
                                                              <th>Product Model</th>
                                                              <th>Product Type</th>
                                                              <th>Price</th>
                                                              <th>Available Stock</th>
                                                              <th>Expiry Date</th>
                                                              <th>Status</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                      @foreach($alls as $all)
                                                          @if($branch->intBranchID == $all->intInvBranch)
                                                         <tr>
                                                              <td>{{ $all->strItemBrand}}</td>
                                                              <td>{{ $all->strItemName }}</td>
                                                              <td>{{ $all->strItemModel }}</td>
                                                              <td>{{ $all->strITDesc }}</td>
                                                              <td>{{ $all->dcInvPPrice }}</td>
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
              <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Product Brand</th>
                        <th>Product Name</th>
                        <th>Product Model</th>
                        <th>Product Type</th>
                        <th>Price</th>
                        <th>Available Stock</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                      <tr>
                        <td>{{$data->strItemBrand}}</td>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemModel }}</td>
                        <td>{{ $data->strITDesc }}</td>
                        <td>{{ $data->dcInvPPrice }}</td>
                        <td>{{ $data->sum }}</td>
                        @if($data->dtInvExpiry == NULL)
                        <td>N/A</td>
                        @else
                        <td>{{ $data->dtInvExpiry }}</td>
                        @endif 
                        @if($data->intISID == 1)
                        <td class="green-text bold">{{ $data->strISDesc }}</td>
                        @elseif($data->intISID == 2)
                        <td class="yellow-text bold">{{ $data->strISDesc }}</td>
                        @elseif($data->intISID == 3)
                        <td class="red-text bold">{{ $data->strISDesc }}</td>
                        @endif
                        <td>
                            @if($data->intItemType != 1)
                            <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#{{$data->intInvID}}">EXPIRATION</a>
                            @endif
                             <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#{{$data->intInvID}}/stocks">STOCK CARD</a>
                        </td>


                              <!-- Modal Structure -->
                              <div id="{{$data->intInvID}}" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Expiration for {{$data->strItemName}} - {{$data->strInvCode}}</h4>
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
            <h5>Materials</h5>
            <table id="example1" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Product Brand</th>
                        <th>Product Name</th>
                        <th>Product Model</th>
                        <th>Product Type</th>
                        <th>Price</th>
                        <th>Available Stock</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($mat as $data)
                      <tr>
                        <td>{{$data->strItemBrand}}</td>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemModel }}</td>
                        <td>{{ $data->strITDesc }}</td>
                        <td>{{ $data->dcInvPPrice }}</td>
                        <td>{{ $data->sum }}</td>
                        @if($data->dtInvExpiry == NULL)
                        <td>N/A</td>
                        @else
                        <td>{{ $data->dtInvExpiry }}</td>
                        @endif 
                        @if($data->intISID == 1)
                        <td class="green-text bold">{{ $data->strISDesc }}</td>
                        @elseif($data->intISID == 2)
                        <td class="yellow-text bold">{{ $data->strISDesc }}</td>
                        @elseif($data->intISID == 3)
                        <td class="red-text bold">{{ $data->strISDesc }}</td>
                        @endif
                        <td>
                            @if($data->intItemType != 1)
                            <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#{{$data->intInvID}}">EXPIRATION</a>
                            @endif
                             <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#{{$data->intInvID}}/stocks">STOCK CARD</a>
                        </td>


                              <!-- Modal Structure -->
                              <div id="{{$data->intInvID}}" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Expiration for {{$data->strItemName}} - {{$data->strInvCode}}</h4>
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
                            @foreach($prod as $prod)
                                                        <!-- Modal Structure -->
                              <div id="{{$prod->intInvID}}/stocks" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Stock Card for {{$prod->strItemName}} - {{$prod->strItemModel}}</h4>
                                  <p>
                                                      <table class="centered table-fixed">
                                                      <thead>
                                                          <tr>
                                                              <th>Date</th>
                                                              <th>Serial Code</th>
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
                                                              <td>{{ $data->intAdjQty }}</td>
                                                              @if($data->intAdjStatus == 1)
                                                              <td class="blue-text bold">Acquired</td>
                                                              @else
                                                              <td class="red-text bold">Released</td>
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
                        <th>Branch Name</th>
                        <th>Ordered Product Name and Model</th>
                        <th>Ordered Quantity</th>
                        <th>Date Ordered</th>
                        <th>Action</th>
                    </tr>
            </thead>

            <tbody>
               @foreach($ord as $data)
                      <tr>
                        <td>{{ $data->strBranchName }}</td>
                        <td>{{ $data->strProdName .' - ' . $data->strProdModel }}</td>
                        <td>{{ $data->intOQty }}</td>
                        <td>{{ $data->created_at }}</td>
                        @if($data->intStatus == 2)
                        <td @if($data->intStatus == 1) class="green-text bold" @else class="yellow-text bold" @endif>{{ $data->strOSDesc }}</td>
                        <td>
                            <div class="center-btn">
                             <a class="waves-effect waves-light btn green darken-1 btn-small center-text" href="admin/deliver/{{$data->intOID}}">DELIVER</a>
                            </div>
                        @elseif($data->intStatus == 1)
                        <td>
                        <a class="green-text bold"> Received at {{ $data->dtOReceived }} </a>
                         @elseif($data->intStatus == 4)
                        <td>
                        <a class="orange-text bold"> ON DELIVERY </a>
                        @endif
                        </td>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
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
} );
  </script>

    <script>
    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
    </script>
@stop

