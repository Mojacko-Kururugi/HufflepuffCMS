@extends('layouts.master')

@section('content')

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Sales</h5>
  </div>
</div>

<div class="main-wrapper">
        <!-- ACTUAL PAGE CONTENT GOES HERE -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">

                <div class="row">
                    <div class="col s12 m12 l12">
						<!--<a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/add-payment">ADD NEW PAYMENT</a>
						<a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/add-payment-for-existing">ADD NEW PAYMENT FOR EXISTING</a> -->
                        <a class="modal-trigger waves-effect waves-light btn btn-flat right btn-small center-text" href="{{ URL::to('/reports') }}">Generate Report</a>
                    </div>
                 </div>

                <div class="nav-wrapper">
                    <div class="container-fluid">
                        <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Service Ref #</th>
                                    <th>Patient Name</th>
                                    <th>Total</th>
                                    <th>Balance Paid</th>
                                    <th>Payment Mode</th> 
                                  <!--  <th>Status</th> -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($data as $data)
                                <tr>
                                    <td>{{ $data->strSHCode }}</td>
                                    <td>{{ $data->strPatLast . ', ' . $data->strPatFirst . ' ' . $data->strPatMiddle }}</td>
                                    <td>{{ $data->dcmSBalance }}</td>
                                    <td>{{ $data->sum }}</td>
                                    <td>{{ $data->strPayTDesc }}</td>
                                   <!-- <td>{{ $data->strSaleSDesc }}</td> -->
                                    <td>
                                        <div class="center-btn">
                                         <a class="modal-trigger waves-effect waves-light btn blue lighten-1 btn-small center-text" href="#{{$data->intSHID}}">VIEW DETAILS</a>
                                        </div>
                                    </td>
                                </tr>



                                @endforeach
                            </tbody>
                        </table>
                    </div>
                <!-- dito naman yung mga susunod na shits kung may idadagdag pa ^_^ -->

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

