@extends('layouts.master')

@section('content')

<!-- header -->
<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Inventory</h5>
  </div>
</div>

<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <div class="container-fluid">

        <div class="row">
          <div class="col s12 m12 l12">
          <a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/inventory/order">ADD NEW ORDER</a>
                <a class="modal-trigger waves-effect waves-light btn btn-flat right btn-small center-text" href="#reportModal">Generate Report</a>
          </div>
          <!--REport MOdal-->
          <div id="reportModal" class="modal modal-fixed-footer">
            <div class="modal-content col 6">
              <div class="row">
                  <label for="itemReport"><h5 style="color: black;">Generate report for:</h5></label>
                      <select name="itemReport">
                         <option value="2" disabled selected>- Choose item type -</option>
                         <option>Products</option>
                         <option>Materials</option>
                      </select>
              </div>
              <div class="row">
                <div class="col s12 m6 l6">
                  <h5>From</h5>
                  <label for="date">Choose Date*</label>
                  <input id="date" name="date" type="date" class="datepicker" style="height:39px" value="">
                </div>
                <div class="col s12 m6 l6">
                  <h5> To </h5>
                  <label for="date">Choose Date*</label>
                  <input id="date" name="date" type="date" class="datepicker" style="height:39px" value="">
                </div>
            </div>  
            </div>
            <div class="modal-footer col 6">
                <a href="{{ URL::to('/reports-inv') }}" class="modal-action modal-close waves-effect waves-green btn-flat ">GENERATE</a>
            </div>
            
          </div>
          <!--end of modal-->
        </div>


        <div class="row">
          <div class="nav-wrapper">
            <div class="container-fluid">
              <div class="card">
                <div class="card-content">
                <div class="row">
                  <div class="col s12">
                                <h5>Non Expiring Products</h5>
              <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Lot Number</th>
                        <th>Product Name</th>
                        <th>Product Description</th>
                        <th>Product Type</th>
                        <th>Price</th>
                        <th>Available Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>
                @foreach($data as $data)
                      <tr>
                        <td>{{ $data->strInvLotNum }}</td>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemDesc }}</td>
                        <td>{{ $data->strITDesc }}</td>
                        <td>{{ $data->dcPrice }}</td>
                        <td>{{ $data->sum }}</td>
                        @if($data->sum > 10)
                        <td class="green-text bold">GOOD</td>
                        @elseif($data->sum <= 10)
                        <td class="yellow-text bold">CRITICAL</td>
                        @elseif($data->sum == 0)
                        <td class="red-text bold">DEPLETED</td>
                        @endif
                    </tr>
                   @endforeach 
                </tbody>
              </table>
                  </div>
                </div>
                </div>
              </div>

            <br>
                          <div class="card">
                <div class="card-content">
                <div class="row">
                  <div class="col s12">
            <h5>Expirables</h5>
            <table id="example1" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Batch Number</th>
                        <th>Lot Number</th>
                        <th>Product Brand, Name, Description</th>
                        <th>Product Type</th>
                        <th>Price</th>
                        <th>Available Stock</th>
                        <th>Expiration Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                @foreach($data2 as $data)
                      <tr>
                        <td>{{ $data->strInvBatCode }}</td>
                        <td>{{ $data->strInvLotNum }}</td>
                        <td>{{ $data->strItemBrand }} -- {{ $data->strItemName }} -- {{ $data->strItemDesc }}</td>
                        <td>{{ $data->strITDesc }}</td>
                        <td>{{ $data->dcPrice }}</td>
                        <td>{{ $data->intInvQty }}</td>
                        @if($data->dtInvExpiry != null)
                        <td>{{ $data->dtInvExpiry }}</td>
                        @else
                        <td>PLEASE SET AN EXPIRY</td>
                        @endif
                        @if($data->intInvQty > 10)
                        <td class="green-text bold">GOOD</td>
                        @elseif($data->intInvQty <= 10)
                        <td class="yellow-text bold">CRITICAL</td>
                        @elseif($data->intInvQty == 0)
                        <td class="red-text bold">DEPLETED</td>
                        @endif
                    </tr>
                   @endforeach 
                </tbody>
              </table>
              </div>
              </div>
              </div>
              </div>
              <br>
                            <div class="card">
                <div class="card-content">
                <div class="row">
                  <div class="col s12">
              <h5>Materials</h5>
              <br>
              <table id="example2" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Lot Number</th>
                        <th>Material Name</th>
                        <th>Material Description</th>
                        <th>Material Type</th>
                        <th>Price</th>
                        <th>Available Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>
                @foreach($mats as $data)
                      <tr>
                        <td>{{ $data->strInvLotNum }}</td>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemDesc }}</td>
                        <td>{{ $data->strITDesc }}</td>
                        <td>{{ $data->dcPrice }}</td>
                        <td>{{ $data->sum }}</td> 
                        @if($data->sum > 10)
                        <td class="green-text bold">GOOD</td>
                        @elseif($data->sum <= 10)
                        <td class="yellow-text bold">CRITICAL</td>
                        @elseif($data->sum == 0)
                        <td class="red-text bold">DEPLETED</td>
                        @endif
                   @endforeach 
                </tbody>
              </table>
            </div>
            </div>
            </div>
            </div>
            </div>
            <!-- dito naman yung mga susunod na shits kung may idadagdag pa ^_^ -->
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

