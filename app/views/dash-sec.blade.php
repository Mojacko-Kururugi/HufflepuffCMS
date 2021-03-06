@extends('layouts.secretary-master')

@section('content')

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Logs for Today</h5>
  </div>
</div>

<div class="main-wrapper">
        <!-- ACTUAL PAGE CONTENT GOES HERE -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">

                <div class="row">
                    <div class="col s12 m12 l10">
                        <a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/sec-add-payment">SELL PRODUCT(POS)</a>
                        <a class="modal-trigger waves-effect waves-light btn blue darken-1 btn-small center-text" href="#services">PAY REMAINING BALANCE</a>
                    </div>
                 </div>

                 <div id="services" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Ongoing Payments</h4>
                                  <p>
                                                      <div class="nav-wrapper">
                    <div class="container-fluid">
                        <table id="example2" class="mdl-data-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Service Ref #</th>
                                    <th>Customer Name</th>
                                    <th>Total</th>
                                    <th>Balance Paid</th>
                                    <th>Date of Service</th> 
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($data2 as $data2)
                                <tr>
                                    <td>{{ $data2->strSHCode }}</td>
                                    <td>{{ $data2->strPatLast . ', ' . $data2->strPatFirst . ' ' . $data2->strPatMiddle }}</td>
                                    <td>{{ $data2->dcmSBalance }}</td>
                                    <td>{{ $data2->sum }}</td>
                                    <td>{{ $data2->intSHDateTime }}</td>
                                    <td>
                                        <div class="center-btn">
                                         <a class="waves-effect waves-light btn blue lighten-1 btn-small center-text" href="/sec/payment/{{ $data2->strSHCode }}">PAY</a>
                                        </div>
                                    </td>
                                </tr>



                                @endforeach
                            </tbody>
                        </table>
                    </div>
                <!-- dito naman yung mga susunod na shits kung may idadagdag pa ^_^ -->

              </div>
                                  </p>
                                </div>
                                <div class="modal-footer col 6">
                                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>
                                </div>
                  </div>


                <div class="nav-wrapper">
                    <div class="container-fluid">
                        <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Service Ref #</th>
                                    <th>Patient Name</th>
                                    <th>Date and Time</th>
                                    <th>Service Done</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($serv as $data)
                                <tr>
                                    <td>{{ $data->strSHCode }}</td>
                                    <td>{{ $data->strPatLast . ', ' . $data->strPatFirst . ' ' . $data->strPatMiddle }}</td>
                                    <td>{{ $data->intSHDateTime }}</td>
                                    <td>{{ $data->strServDesc }}</td>
                                    <td>
                                        <div class="center-btn">
                                         <a class="modal-trigger waves-effect waves-light btn blue lighten-1 btn-small center-text" href="/sec-patient/view-service/{{$data->intSHID}}">VIEW DETAILS</a>
                                        </div>
                                    </td>
                                </tr>

                                 <!-- Modal Structure -->
                              <div id="{{$data->intSHID}}" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Service Details</h4>
                                  <p>


<!-- just copy mga nawala sa services.blade -->
                                  </p>
                                </div>
                                <div class="modal-footer col 6">
                                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CANCEL</a>
                                </div>
                              </div>

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

