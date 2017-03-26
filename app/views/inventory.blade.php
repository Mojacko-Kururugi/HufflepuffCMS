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
    <div class="card">
      <div class="card-content">
        <div class="row">
          <div class="col s12 m12 l12">
                <a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/inventory/order">ADD NEW ORDER</a>
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
                        <td>
                          <div class="center-btn">
                             <a class="modal-trigger waves-effect waves-light btn orange darken-1 btn-small center-text" href="#{{$data->intInvID}}">DISCOUNT</a>
                          </div>
                        </td>
                        @elseif($data->intISID == 2)
                        <td class="yellow-text bold">{{ $data->strISDesc }}</td>
                        <td>
                          <div class="center-btn">
                             <a class="modal-trigger waves-effect waves-light btn orange darken-1 btn-small center-text" href="#{{$data->intInvID}}">DISCOUNT</a>
                          </div>
                        </td>
                        @elseif($data->intISID == 3)
                        <td class="red-text bold">{{ $data->strISDesc }}</td>
                        @endif
                    </tr>

                        <!-- Modal Structure -->
                              <div id="{{$data->intInvID}}" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Enter Discount PERCENTAGE for {{$data->strProdName}}</h4>
                                  <p>
                                  <form action="/inventory/discount/{{$data->intInvID}}" method="POST">
                                          <div class="form-group col l6 ">
                                          <label for="price">Price</label>
                                          <input type="number" class="form-control" name="price" id="price" value="1">
                                          </div>
                                  </p>
                                </div>
                                <div class="modal-footer col 6">
                                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CANCEL</a>
                                  <button type="submit" class="waves-effect waves-green btn-flat ">SUBMIT</button>
                                </div>
                                </form>
                              </div>
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

