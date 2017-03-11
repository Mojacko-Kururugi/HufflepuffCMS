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
                                         <a class="modal-trigger waves-effect waves-light btn blue lighten-1 btn-small center-text" href="#{{$data->intPatID}}">VIEW DETAILS</a>
                                         <a class="waves-effect waves-light btn green darken-1 btn-small center-text" href="patient/{{$data->intPatID}}">UPDATE</a>
                                         <a class="waves-effect waves-light btn red lighten-1 btn-small center-text" href="delete-pat/{{$data->intPatID}}">DELETE</a>
                                        </div>
                                    </td>
                                </tr>

                                 <!-- Modal Structure -->
                              <div id="{{$data->intPatID}}" class="modal modal-fixed-footer">
                                <div class="modal-content col l12">
                                  <h4>Patient Details</h4>
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
                                              <input id="company" name="company" type="text" class="validate" value="{{ $data->strPatCompany }}" readonly/>
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
                                                   <div class="col s12 m6 l4">
                                                    <h5>Complaints:</h5>
                                                      <form action="#" style="font-color: black;">
                                                        <p>
                                                          <input type="checkbox" id="BOVfar" name="BOVfar" value="1"  @if(strpos($data->strPatComplaints , '1') !== false) checked @endif/>
                                                          <label for="BOVfar">BOV Far</label>
                                                        </p>
                                                        <p>
                                                          <input type="checkbox" id="BOVnear" name="BOVnear" value="2" @if(strpos($data->strPatComplaints , '2') !== false) checked @endif/>
                                                          <label for="BOVnear">BOV Near</label>
                                                        </p>
                                                        <p>
                                                          <input type="checkbox" id="headache" name="headache" value="3" @if(strpos($data->strPatComplaints , '3') !== false) checked @endif/>
                                                          <label for="headache">Headache</label>
                                                        </p>
                                                        <p>
                                                          <input type="checkbox" id="dizziness" name="dizziness" value="4" @if(strpos($data->strPatComplaints , '4') !== false) checked @endif/>
                                                          <label for="dizziness">Dizziness</label>
                                                        </p>
                                                        <p>
                                                          <input type="checkbox" id="glare" name="glare" value="5" @if(strpos($data->strPatComplaints , '5') !== false) checked @endif/>
                                                          <label for="glare">Glare</label>
                                                        </p>
                                                        <p>
                                                          <input type="checkbox" id="vomitting" name="vomitting" value="6" @if(strpos($data->strPatComplaints , '6') !== false) checked @endif/>
                                                          <label for="vomitting">Vomitting</label>
                                                        </p>
                                                      </form>
                                                  </div>
                                                </div>
                                            </div>
                                          </div>

                                        <br>
                                        <hr>
                                        <br>
                                        <div class="col s12 m6 l6">
                                          <!-- mga bes, wag nested row at col-->
                                          <div class="row">
                                              <div class="col s12">
                                                <h5>Old Rx</h5>
                                                <h6>Spectacles</h6>
                                              </div>
                                              <div class="input-field col l6 m6 s12">
                                                <label for="OD">OD:</label>
                                                <input id="OD" name="OD" type="number" class="validate" value="" />
                                              </div>
                                              <div class="input-field col l6 m6 s12">
                                                <label  for="ODAdd">Add:</label>
                                                <input id="ODAdd" name="ODAdd" type="number" class="validate" value=""/>
                                              </div>
                                              <div class="input-field col l6 m6 s12">
                                                <label for="OS">OS:</label>
                                                <input id="OS" name="OS" type="number" class="validate" value="" />
                                              </div>
                                              <div class="input-field col l6 m6 s12">
                                                  <label  for="OSAdd">Add:</label>
                                                  <input id="OSAdd" name="OSAdd" type="number" class="validate" value=""/>
                                              </div>
                                          </div>
                                          <div class="row">
                                            <div class="col s12">
                                              <h6>VA/Contact Lens</h6>
                                            </div>
                                            <div class="input-field col l6 m6 s12">
                                              <label for="CLOD">OD:</label>
                                              <input id="CLOD" name="OD" type="number" class="validate" value="" />
                                            </div>
                                            <div class="input-field col l6 m6 s12">
                                              <label  for="CLOS">OS:</label>
                                              <input id="CLOS" name="CLOS" type="number" class="validate" value=""/>
                                            </div>
                                          </div>
                                            
                                        </div>
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
} );
  </script>
    <script>
    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
    </script>
@stop

