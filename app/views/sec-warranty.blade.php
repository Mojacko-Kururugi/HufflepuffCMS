@extends('layouts.secretary-master')

@section('content')

<!-- header -->
<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Warrantied Products</h5>
  </div>
</div>

<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <div class="container-fluid">
    <div class="card">
      <div class="card-content">
        <div class="row">
          <div class="col s12 m12 l12">
                <a class="modal-trigger waves-effect waves-light btn btn-flat right btn-small center-text" href="{{ URL::to('/reports') }}">Generate Report</a>
          </div>
        </div>

        <div class="row">
          <div class="nav-wrapper">
            <div class="container-fluid">
              <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Service Ref #</th>
                        <th>Patient Name</th>
                        <th>Product Name & Model</th>
                        <th>Qty</th>
                        <th>Warranty Status</th>
                        <th>Date of Service</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                      <tr>
                        <td>{{ $data->strSHCode }}</td>
                        <td>{{ $data->strPatLast . ', ' . $data->strPatFirst . ' ' . $data->strPatMiddle }}</td>
                        <td>{{ $data->strItemName .' - ' . $data->strItemDesc }}</td>
                        <td>{{ $data->intQty }}</td>
                        <td @if($data->intHWarranty == 1) class="green-text bold" @else class="orange-text bold" @endif>{{ $data->strWDesc }}</td>
                        <td>{{ $data->intSHDateTime }}</td>
                        @if($data->intHWarranty == 1)
                        <td>
                            <a class="waves-effect waves-light btn green darken-1 btn-small center-text" href="replace/{{$data->strSHCode}}">REPLACE</a>
                        </td>
                        @endif
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

