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

    <!-- START OF CARD CONTENT FOR PRODUCT -->
    
    <div class="card">
      
      <div class="card-content">
        <!-- START OF CARD TAB -->
          <div class="card-tabs">
            <ul class="tabs" style="color: blue !important;">
              <li class="tab"><a href="#products" style="color: blue;">Products</a></li>
              <li class="tab"><a href="#materials" style="color: blue;">Materials</a></li>
            </ul>
          </div>
        <!-- END OF CARD TAB -->
<!-- START OF PRODUCT CARD CONTENT -->

      <div class="card-content" id="products">

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
                        <th>Product Brand</th>
                        <th>Product Description</th>
                        <th>Product Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $data)
                      <tr>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemBrand }}</td>
                        <td>{{ $data->strItemDesc }}</td>
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

      <!-- START OF CARD CONTENT FOR MATERIAL -->
      <div class="card-content" id="materials">

        <div class="row">
          <div class="col s12 m12 l6">
                <a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/materials/add">ADD NEW MATERIAL</a>
          </div>
        </div>

        <div class="row">
          <div class="nav-wrapper">
            <div class="container-fluid">
              <table id="example1" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Material Name</th>
                        <th>Material Description</th>
                        <th>Material Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($mat as $data)
                      <tr>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemDesc }}</td>
                        <td>{{ $data->strITDesc }}</td>
                        <td>
                            <div class="center-btn">
                             <a class="waves-effect waves-light btn green darken-1 btn-small center-text" href="materials/{{$data->intItemID}}">UPDATE</a>
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
<!-- END OF CARD CONTENT FOR MATERIAL -->
    </div>
<!-- END OF CARD CONTENT  FOR PRODUCT-->
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

