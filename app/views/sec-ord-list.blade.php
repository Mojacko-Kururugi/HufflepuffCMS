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
          <div class="nav-wrapper">
            <div class="container-fluid">
              <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
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
                        <td>{{ $data->strProdName .' - ' . $data->strProdModel }}</td>
                        <td>{{ $data->intOQty }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ $data->intStatus }}</td>
                        <td>
                        @if($data->intStatus == 2)
                            <div class="center-btn">
                             <a class="waves-effect waves-light btn green darken-1 btn-small center-text" href="sec-inv/ord/{{$data->strOCode}}">RECEIVE</a>
                            </div>
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
@stop

