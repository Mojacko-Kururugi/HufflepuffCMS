@extends('layouts.secretary-master')

@section('content')

<!-- header -->
<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Patient Details</h5>
  </div>
</div>


<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <div class="container-fluid">
    <div class="card">
      <div class="card-content">
                                          <p>
                                                <div class="row">
                                                  <div class="col s12"><br>
                                                    <div class="row" style="padding:0px; margin:0px;">
                                                      <p style="padding:0px; margin:0px;">Name:</p>
                                                    </div>
                                                    <div class="row">
                                                      <div class="input-field col s12 m4 l4">
                                                        <input id="last_name_sa" name="last_name_sa" type="text" class="validate" value="{{ $data->strPatLast }}" pattern="[A-Za-z]+" onkeydown="return alphaOnly(event);" readonly>
                                                        <label for="last_name_sa">Last Name</label>
                                                      </div>
                                                      <div class="input-field col s12 m4 l4">
                                                        <input id="first_name_sa" name="first_name_sa" type="text" class="validate" value="{{ $data->strPatFirst }}" pattern="[A-Za-z]+" onkeydown="return alphaOnly(event);" readonly>
                                                        <label for="first_name_sa">First Name</label>
                                                      </div>
                                                      <div class="input-field col s12 m4 l4">
                                                        <input id="middle_name_sa" name="middle_name_sa" type="text" class="validate" value="{{ $data->strPatMiddle }}" pattern="[A-Za-z]+" onkeydown="return alphaOnly(event);" readonly>
                                                        <label for="middle_name_sa">Middle Name</label>
                                                      </div>
                                                    </div>
                                                    <div class="row">
                                                      <div class="col s12">
                                                        <label for="gender_select">Gender</label>
                                                        @if($data->intPatGender == 1)
                                                        <p>
                                                          <input name="gender" type="radio" id="male" value="1" checked/>
                                                          <label for="male">Male</label>
                                                        </p>                         
                                                      @else
                                                        <p>
                                                          <input name="gender" type="radio" id="female" value="2" checked/>
                                                          <label for="female">Female</label>
                                                        </p>
                                                      @endif
                                                      </div>
                                                    </div>
                                                    </div>
                                                    </div>

                                        <div class="row"> 
                                          <div class="col s12 m12 l12">
                                            <label for="address">Address</label>
                                            <input id="address" name="address" type="text" class="validate" value="{{ $data->strPatAddress }}" readonly>
                                          </div>
                                        </div>

                                        <div class="row">
                                          <div class="input-field col l6 m6 s12">
                                              <label for="number">Contact Number</label>
                                              <input id="number" name="number" type="text" class="validate" value="{{ $data->strPatContactNumb }}" readonly/>
                                          </div>
                                          <div class="input-field col s12 m6 l6">
                                              <label for="company">Company:</label>
                                              <input id="company" name="company" type="text" class="validate" value="" readonly/>
                                          </div>
                                        </div>

                                   <div class="row">
                                              <div class="input-field col l6 m8 s12">
                                                    <label for="email">Email</label>
                                                    <input id="email" name="email" type="email" class="validate" data-error=".email_error" value="{{ $data->strPatEmail }}" readonly/>
                                                    <div class="email_error">
                                                    </div>
                                                </div>
                                          </div>

                                          <hr>
                                          <div class="row">
                                            <div class="col l12 m6 s6">
                                                <div class="row">
                                                   <div class="col s12 m6 l4">
                                                    <h5>Family History:</h5>
                                                    <form action="#" style="font-color: black;">
                                                      <p>
                                                        <input type="checkbox" id="diabetes" name="diabetes" value="1"  @if(strpos($data->strPatHistory , '1') !== false) checked @endif/>
                                                        <label for="diabetes">Diabetes</label>
                                                      </p>
                                                      <p>
                                                        <input type="checkbox" id="glaucoma" name="glaucoma" value="2" @if(strpos($data->strPatHistory , '2') !== false) checked @endif/>
                                                        <label for="glaucoma">Glaucoma</label>
                                                      </p>
                                                      <p>
                                                        <input type="checkbox" id="asthma" name="asthma" value="3"  @if(strpos($data->strPatHistory , '3') !== false) checked @endif/>
                                                        <label for="asthma">Asthma</label>
                                                      </p>
                                                      <p>
                                                        <input type="checkbox" id="highblood" name="highblood" value="4"  @if(strpos($data->strPatHistory , '4') !== false) checked @endif/>
                                                        <label for="highblood">Highblood</label>
                                                      </p>
                                                      <p>
                                                        <input type="checkbox" id="goiter" name="goiter" value="5"  @if(strpos($data->strPatHistory , '5') !== false) checked @endif/>
                                                        <label for="goiter">Goiter</label>
                                                      </p>
                                                      <p>
                                                        <input type="checkbox" id="kidneyprob" name="kidneyprob" value="6"  @if(strpos($data->strPatHistory , '6') !== false) checked @endif/>
                                                        <label for="kidneyprob">Kidney Problem</label>
                                                      </p>
                                                    </form>
                                                  </div>
                                                </div>
                                            </div>
                                          </div>
                                  </p>


        <div class="row">
          <div class="col s12 m12 l12">
          <h5>RX History</h5>
            <div>
                <div class="col s12 m12 l12 overflow-x">
                <table class="centered">
                    <thead>
                      <tr>
                        <th>Date and Time</th>
                        <th>SOD</th>
                        <th>SOD Add</th>
                        <th>SOS</th>
                        <th>SOS Add</th>
                        <th>CLOD</th>
                        <th>CLOS</th>
                      </tr>
                    </thead>
                    @foreach($rx as $r)
                    <tbody>
                      <tr>
                        <td>{{$r->created_at}}</td>
                        <td>{{$r->strSOD}}</td>
                        <td>{{$r->strSODAdd}}</td>
                        <td>{{$r->strSOS}}</td>
                        <td>{{$r->strSOSAdd}}</td>
                        <td>{{$r->strCLOD}}</td>
                        <td>{{$r->strCLOS}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- <p>
                  You have no items.
                </p> -->

                <div class="clearfix">

                </div>
            </div>
          </div>
        </div>


        <br>
        <div class="row">
          <div class="nav-wrapper">
            <div class="container-fluid">
              <h5>Service History</h5>
              <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Service Ref #</th>
                        <th>Date and Time</th>
                        <th>Service Done</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($serv as $serv)
                      <tr>
                        <td>{{ $serv->strSHCode }}</td>
                        <td>{{ $serv->intSHDateTime }}</td>
                        <td>{{ $serv->strServDesc }}</td>
                        <td>
                            <a class="modal-trigger waves-effect waves-light btn green darken-1 btn-small center-text" href="/sec-patient/view-service/{{$serv->intSHID}}">VIEW DETAILS</a>
                        </td>
                      </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

<div class="nav-wrapper">
                    <div class="container-fluid">
                    <h5>Account Ledger</h5>
                        <table id="example2" class="mdl-data-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Service Ref #</th>
                                    <th>Total</th>
                                    <th>Balance Paid</th>
                                    <th>Date of Service</th> 
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($pay as $pay)
                                <tr>
                                    <td>{{ $pay->strSHCode }}</td>
                                    <td>{{ $pay->dcmSBalance }}</td>
                                    <td>{{ $pay->sum }}</td>
                                    <td>{{ $pay->intSHDateTime }}</td>
                                    <td>
                                        <div class="center-btn">
                                         <a class="waves-effect waves-light btn blue lighten-1 btn-small center-text" href="/sec/payment/{{ $pay->strSHCode }}">PAY</a>
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

<script>   
    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  }); 
</script>

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
@stop

