@extends('layouts.secretary-master')

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
                <!--<a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/sec-inv/ord">ADD NEW ORDER</a>-->
                <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="#allbranch">VIEW ALL BRANCHES</a>
                <a class="modal-trigger waves-effect waves-light btn btn-flat right btn-small center-text" href="{{ URL::to('/reports') }}">Generate Report</a>
          </div>
        </div>

                  <div id="allbranch" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Inventories on other Branches</h4>
                                  <p>
                                    @foreach($branch as $branch)
                                    <h5>{{$branch->strBranchName}}</h5>
                                                    <table class="centered table-fixed">
                                                      <thead>
                                                          <tr>
                                                              <th>Product Brand</th>
                                                              <th>Product Name</th>
                                                              <th>Product Description</th>
                                                              <th>Product Type</th>
                                                              <th>Price</th>
                                                              <th>Available Stock</th>
                                                              <th>Expiry Date</th>
                                                              <th>Status</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                      @foreach($alls as $all)
                                                          @if($branch->intBranchID == $all->intInvBranch)
                                                         <tr>
                                                              <td>{{ $all->strItemBrand}}</td>
                                                              <td>{{ $all->strItemName }}</td>
                                                              <td>{{ $all->strItemModel }}</td>
                                                              <td>{{ $all->strITDesc }}</td>
                                                              <td>{{ $all->dcInvPPrice }}</td>
                                                              <td>{{ $all->sum }}</td>
                                                              @if($all->dtInvExpiry == NULL)
                                                              <td>N/A</td>
                                                              @else
                                                              <td>{{ $all->dtInvExpiry }}</td>
                                                              @endif 
                                                              @if($all->intISID == 1)
                                                              <td class="green-text bold">{{ $all->strISDesc }}</td>
                                                              @elseif($all->intISID == 2)
                                                              <td class="yellow-text bold">{{ $all->strISDesc }}</td>
                                                              @elseif($all->intISID == 3)
                                                              <td class="red-text bold">{{ $all->strISDesc }}</td>
                                                              @endif
                                                          </tr>
                                                        @elseif($all == NULL)   
                                                        @endif
                                                      @endforeach 
                                                      </tbody>
                                                    </table>
                                    @endforeach
                                  </p>
                                </div>
                                <div class="modal-footer col 6">
                                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>
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
                        <th>Product Description</th>
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
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemModel }}</td>
                        <td>{{ $data->strITDesc }}</td>
                        <td>{{ $data->dcInvPPrice }}</td>
                        <td>{{ $data->intInvQty }}</td>
                        @if($data->dtInvExpiry == NULL)
                        <td>N/A</td>
                        @else
                        <td>{{ $data->dtInvExpiry }}</td>
                        @endif 
                        @if($data->intISID == 1)
                        <td class="green-text bold">{{ $data->strISDesc }}</td>
                        @elseif($data->intISID == 2)
                        <td class="yellow-text bold">{{ $data->strISDesc }}</td>
                        @elseif($data->intISID == 3)
                        <td class="red-text bold">{{ $data->strISDesc }}</td>
                        @endif
                        <td>
                            <a class="modal-trigger waves-effect waves-light btn yellow darken-1 btn-small center-text" href="#{{$data->intInvID}}">ADJUST</a>
                        </td>


                              <!-- Modal Structure -->
                              <div id="{{$data->intInvID}}" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Adjustments for {{$data->strItemName}} - {{$data->strInvCode}}</h4>
                                  <p>
                                  <form action="/adjust/{{$data->intInvID}}" method="POST">
                                            <div class="row">
                                              <div class="input-field col l6 m6 s12">
                                                <input id="user_id" name="user_id" type="text" class="validate" data-error=".id_error" value="{{ $count }}" readonly/>
                                                <label for="user_id">Adjustment Serial #:</label>
                                                <div class="id_error"></div>
                                              </div>
                                            </div>

                                          <div class="col l6 ">
                                          <label for="qty">Quantity</label>
                                          <input type="number" class="form-control" name="qty" id="qty" value="0">
                                          </div> 

                                          <div class="row">
                                            <div class="input-field col l6 m6 s12">
                                                <select class="initialized browser-default" name="type" id="type">
                                                  <option value="" disabled selected>Adjustment Type</option>
                                                  <option value="1">Increase By</option>
                                                  <option value="2">Decrease By</option>
                                                </select>
                                            </div>
                                          </div>

                                          <br>
                                         <div class="row">
                                            <div class="col s12">
                                              <label for="desc">Description:</label>
                                              <textarea id="desc" name="desc" class="materialize-textarea"></textarea>
                                            </div>
                                          </div>  
                                  </p>
                                </div>
                                <div class="modal-footer col 6">
                                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CANCEL</a>
                                  <button type="submit" class="waves-effect waves-green btn-flat ">SUBMIT</button>
                                </div>
                                </form>
                              </div>

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

