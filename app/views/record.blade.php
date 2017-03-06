@extends('layouts.master')

@section('content')

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Patient Records</h5>
  </div>
</div>

<div class="main-wrapper">
        <!-- ACTUAL PAGE CONTENT GOES HERE -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">

                <div class="row">
                    <div class="col s12 m12 l10">
                        <a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/add-patient">ADD NEW PATIENT</a>
                        <button class="modal-trigger waves-effect waves-light red lighten-1 btn btn-small center-text" href="#viewprod">DELETE ALL PATIENTS</button>
                    </div>
                 </div>

                <div class="nav-wrapper">
                    <div class="container-fluid">
                        <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Date Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($data as $data)
                                <tr>
                                    <td>{{ $data->strPatLast }}</td>
                                    <td>{{ $data->strPatFirst }}</td>
                                    <td>{{ $data->strPatMiddle }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="center-btn">
                                         <a class="waves-effect waves-light btn blue lighten-1 btn-small center-text" href="">VIEW DETAILS</a>
                                         <a class="waves-effect waves-light btn green darken-1 btn-small center-text" href="patient/{{$data->strPatCode}}">UPDATE</a>
                                         <a class="waves-effect waves-light btn red lighten-1 btn-small center-text" href="delete-pat/{{$data->strPatCode}}">DELETE</a>
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
@stop

