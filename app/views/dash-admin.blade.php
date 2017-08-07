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
                <a class="modal-trigger waves-effect waves-light btn btn-flat right btn-small center-text" href="{{ URL::to('/reports') }}">Generate Report</a>
          </div>
        </div>

        <div class="row">
          <div class="nav-wrapper">
            <div class="container-fluid">
              <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Serial Code</th>
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
                @foreach($data as $data)
                      <tr>
                        <td>{{ $data->strInvCode }}</td>
                        <td>{{ $data->strProdName }}</td>
                        <td>{{ $data->strProdModel }}</td>
                        <td>{{ $data->strPTDesc }}</td>
                        <td>{{ $data->dcInvPPrice }}</td>
                        <td>{{ $data->intInvQty }}</td>
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
                            @if($data->intProdType != 1)
                            <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#{{$data->intInvID}}">EXPIRATION</a>
                            @endif
                        </td>


                              <!-- Modal Structure -->
                              <div id="{{$data->intInvID}}" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Expiration for for {{$data->strProdName}} - {{$data->strInvCode}}</h4>
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
            <br>
            </div>
            <!-- dito naman yung mga susunod na shits kung may idadagdag pa ^_^ -->
          </div>
        </div>
      </div>
    </div>

    <div class="col s12 m12 l5">
      <div class="card-panel">
        <span class="card-title">Pending Requests</span>
        <hr>
        <div class="card-content">
<<<<<<< HEAD
         @if($ord != null)
          <p>
            You have pending requests.
          </p>
          <table class="centered table-fixed">
            <thead>
                    <tr>
                        <th>Serial Code</th>
                        <th>Ordered Product Name and Model</th>
                        <th>Ordered Quantity</th>
                        <th>Date Ordered</th>
                        <th>Action</th>
                    </tr>
            </thead>

            <tbody>
               @foreach($ord as $data)
                      <tr>
                        <td>{{ $data->strOCode }}</td>
                        <td>{{ $data->strProdName .' - ' . $data->strProdModel }}</td>
                        <td>{{ $data->intOQty }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td @if($data->intStatus == 1) class="green-text bold" @else class="yellow-text bold" @endif>{{ $data->strOSDesc }}</td>
                        <td>
                        @if($data->intStatus == 2)
                            <div class="center-btn">
                             <a class="waves-effect waves-light btn green darken-1 btn-small center-text" href="">DELIVER</a>
                            </div>
                        @elseif($data->intStatus == 1)
                        <a class="green-text bold"> Received at {{ $data->dtOReceived }} </a>
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
=======
          <p>
            You have no pending requests.
          </p>
>>>>>>> 929f74798f2669644cf64cba346edfdf1e5fa643
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
} );
  </script>

    <script>
    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
    </script>
@stop

