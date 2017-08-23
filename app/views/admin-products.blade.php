@extends('layouts.admin-master')

@section('content')

<!-- header -->
<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Products and Materials</h5>
  </div>
</div>

<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <div class="container-fluid">
    <div class="card">
      <div class="card-content">
        <div class="row">
          <div class="col s12 m12 l6">
                <a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/products/add">ADD NEW PRODUCT</a>
          </div>
        </div>

        <div class="row">
          <div class="nav-wrapper">
            <div class="container-fluid">
              <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Model</th>
                        <th>Product Brand</th>
                        <th>Product Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @foreach($data as $data)
                      <tr>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemModel }}</td>
                        <td>{{ $data->strItemBrand }}</td>
                        <td>{{ $data->strITDesc }}</td>
                        <td>
                            <div class="center-btn">
                             <a class="waves-effect waves-light btn green darken-1 btn-small center-text" href="products/{{$data->intItemID}}">UPDATE</a>
                             <a class="waves-effect waves-light btn red lighten-1 btn-small center-text" href="delete-prod/{{$data->intItemID}}">DELETE</a>
                            </div>
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

        <div class="card">
      <div class="card-content">
        <div class="row">
          <div class="col s12 m12 l6">
                <a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/products/add">ADD NEW MATERIAL</a>
          </div>
        </div>

        <div class="row">
          <div class="nav-wrapper">
            <div class="container-fluid">
              <table id="example1" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Material Name</th>
                        <th>Material Model</th>
                        <th>Material Brand</th>
                        <th>Material Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @foreach($mat as $data)
                      <tr>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemModel }}</td>
                        <td>{{ $data->strItemBrand }}</td>
                        <td>{{ $data->strITDesc }}</td>
                        <td>
                            <div class="center-btn">
                             <a class="waves-effect waves-light btn green darken-1 btn-small center-text" href="products/{{$data->intItemID}}">UPDATE</a>
                             <a class="waves-effect waves-light btn red lighten-1 btn-small center-text" href="delete-prod/{{$data->intItemID}}">DELETE</a>
                            </div>
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
@stop

