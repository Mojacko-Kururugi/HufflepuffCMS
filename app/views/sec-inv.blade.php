@extends('layouts.secretary-master')

@section('content')

<!-- header -->
<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Inventory</h5>
  </div>
</div>
<?php $x=0; $array1 = []; $array2 = []; ?>
<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <div class="container-fluid">

        <div class="row">
          <div class="col s12 m12 l12">
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
                        <th>Actions</th>
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
                         @if($data->sum <= 10)
                        <?php $array1[$x] = $data->strItemName; $array2[$x] = $data->sum; $x++; ?>
                        @endif
                        @if($data->sum > 10)
                        <td class="green-text bold">GOOD</td>
                        @elseif($data->sum <= 10)
                        <td class="yellow-text bold">CRITICAL</td>
                        @elseif($data->sum == 0)
                        <td class="red-text bold">DEPLETED</td>
                        @endif
                        <td>
                            <a class="modal-trigger waves-effect waves-light btn yellow darken-1 btn-small center-text" href="#{{$data->intInvID}}">ADJUST</a>
                        </td>


                              <!-- Modal Structure -->
                              <div id="{{$data->intInvID}}" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Adjustments for {{$data->strItemName}} - {{$data->strInvLotNum}}</h4>
                                  <p>
                                  <form action="/adjust/{{$data->intInvID}}" method="POST" id="adjnep">
                                            <div class="row">
                                              <div class="input-field col l6 m6 s12">
                                                <input id="user_id" name="user_id" type="text" class="validate" data-error=".id_error" value="{{ $count }}" readonly/>
                                                <label for="user_id">Adjustment Serial #:</label>
                                                <div class="id_error"></div>
                                              </div>
                                            </div>

                                          <div class="col l6 ">
                                          <label for="qty">Quantity</label>
                                          <input type="number" class="validate" data-error=".qty_error" name="qty" id="qty" value="" min="1" required>
                                          <div class="qty_error"></div>
                                          </div> 

                                          <div class="row">
                                            <div class="input-field col l6 m6 s12">
                                                <select class="initialized browser-default" name="type" id="type" required>
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
                        <th>Actions</th>
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
                         @if($data->intInvQty <= 10)
                        <?php $array1[$x] = $data->strItemName; $array2[$x] = $data->intInvQty; $x++; ?>
                        @endif
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
                        <td>
                            <a class="modal-trigger waves-effect waves-light btn yellow darken-1 btn-small center-text" href="#{{$data->intInvID}}">ADJUST</a>
                        </td>


                              <!-- Modal Structure -->
                              <div id="{{$data->intInvID}}" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Adjustments for {{$data->strItemName}} - {{$data->strInvLotNum}}</h4>
                                  <p>
                                  <form action="/adjust/{{$data->intInvID}}" method="POST" id="adjep">
                                            <div class="row">
                                              <div class="input-field col l6 m6 s12">
                                                <input id="user_id" name="user_id" type="text" class="validate" data-error=".id_error" value="{{ $count }}" readonly/>
                                                <label for="user_id">Adjustment Serial #:</label>
                                                <div class="id_error"></div>
                                              </div>
                                            </div>

                                          <div class="col l6 ">
                                          <label for="qty">Quantity</label>
                                          <input type="number" class="validate" data-error=".qty2_error" name="qty2" id="qty2" value="" min="1" required>
                                          <div class="qty2_error"></div>
                                          </div> 

                                          <div class="row">
                                            <div class="input-field col l6 m6 s12">
                                                <select class="initialized browser-default" name="type2" id="type2" required>
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
                        <th>Actions</th>
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
                         @if($data->sum <= 10)
                        <?php $array1[$x] = $data->strItemName; $array2[$x] = $data->sum; $x++; ?>
                        @endif
                        @if($data->sum > 10)
                        <td class="green-text bold">GOOD</td>
                        @elseif($data->sum <= 10)
                        <td class="yellow-text bold">CRITICAL</td>
                        @elseif($data->sum == 0)
                        <td class="red-text bold">DEPLETED</td>
                        @endif
                        <td>
                            <a class="modal-trigger waves-effect waves-light btn yellow darken-1 btn-small center-text" href="#{{$data->intInvID}}">ADJUST</a>
                        </td>


                              <!-- Modal Structure -->
                              <div id="{{$data->intInvID}}" class="modal modal-fixed-footer">
                                <div class="modal-content col 6">
                                  <h4>Adjustments for {{$data->strItemName}} - {{$data->strInvLotNum}}</h4>
                                  <p>
                                  <form action="/adjust/{{$data->intInvID}}" method="POST" id="adjmat">
                                            <div class="row">
                                              <div class="input-field col l6 m6 s12">
                                                <input id="user_id" name="user_id" type="text" class="validate" data-error=".id_error" value="{{ $count }}" readonly />
                                                <label for="user_id">Adjustment Serial #:</label>
                                                <div class="id_error"></div>
                                              </div>
                                            </div>

                                          <div class="col l6 ">
                                          <label for="qty">Quantity</label>
                                          <input type="number" class="validate" data-error=".qty3_error" name="qty3" id="qty3" value="" min="1" required>
                                          <div class="qty3_error"></div>
                                          </div> 

                                          <div class="row">
                                            <div class="input-field col l6 m6 s12">
                                                <select class="initialized browser-default" name="type3" id="type3" required>
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

<?php
  if($x != 0)
    {
      $message = "You have critical stocks!";
echo "<script type='text/javascript'>alert('$message');</script>";
      Session::forget('purch_mess');
    }
?>

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

   // alert("PAYAMON!");
    
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

    var qty = document.getElementById("qty");
    var qty2 = document.getElementById("qty2");
    var qty3 = document.getElementById("qty3");

    $("#qty").keypress(function(e){
      var maxval = 2;

      if(qty.value.length > maxval && e.keyCode != 46 && e.keyCode != 8)
      {
        e.preventDefault();                    
      }
    });

    $("#qty2").keypress(function(e){
      var maxval = 2;

      if(qty2.value.length > maxval && e.keyCode != 46 && e.keyCode != 8)
      {
        e.preventDefault();                    
      }
    });

    $("#qty3").keypress(function(e){
      var maxval = 2;

      if(qty3.value.length > maxval && e.keyCode != 46 && e.keyCode != 8)
      {
        e.preventDefault();                    
      }
    });

  });
    </script>
@stop

