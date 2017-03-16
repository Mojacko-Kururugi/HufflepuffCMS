@extends('layouts.secretary-master')

@section('content')

<!-- header -->
<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Orders</h5>
  </div>
</div>

<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <div class="container-fluid">
    <div class="card">
      <div class="card-content">
        <div class="row">
          <div class="col s12 m12 l12">
                <a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/sec-order/ord">ADD NEW ORDER</a>
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
                        <th>Ordered Product Name and Model</th>
                        <th>Ordered Quantity</th>
                        <th>Date Ordered</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                      <tr>
                        <td>{{ $data->strOCode }}</td>
                        <td>{{ $data->strProdName .' - ' . $data->strProdModel }}</td>
                        <td>{{ $data->intOQty }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td @if($data->intStatus == 1) class="green-text bold" @else class="yellow-text bold" @endif>{{ $data->strOSDesc }}</td>
                        <td>
                        @if($data->intStatus == 2)
                            <div class="center-btn">
                             <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#{{$data->intOID}}">RECEIVE</a>
                            </div>

                              <!-- Modal Structure -->
                              <div id="{{$data->intOID}}" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>ENTER PRICE FOR {{$data->strProdName}}</h4>
                                  <p>
                                  <form action="/sec-inv/ord/{{$data->intOID}}" method="POST">
                                          <div class="form-group col l6 ">
                                          <label for="price">Price per piece</label>
                                          <input type="number" class="form-control" name="price" id="price" value="1">
                                          </div>
                                          @if($data->intProdType == 1)
                                          <br>
                                          @else
                                          <br>
                                          <div class="row">
                                            <div class="col s12 m8 l6">
                                              <label for="date">Choose Expiry Date</label>
                                              <input id="date" name="date" type="date" class="datepicker" style="height:39px" value="">
                                            </div>
                                          </div>
                                          @endif  
                                  </p>
                                </div>
                                <div class="modal-footer col 6">
                                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CANCEL</a>
                                  <button type="submit" class="waves-effect waves-green btn-flat ">SUBMIT</button>
                                </div>
                                </form>
                              </div>

                        @elseif($data->intStatus == 1)
                        <a class="green-text bold"> Received at {{ $data->dtOReceived }} </a>
                        @endif
                        </td>
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

