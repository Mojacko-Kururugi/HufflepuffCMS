@extends('layouts.master')

@section('content')
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <div class="row">
    <div class="center col l12 m12 s12">
      <h3>Job Order</h3>
    </div>
  </div>

<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <form action="{{ URL::to('/') }}" method="POST" id="signup_validate" enctype="multipart/form-data">
       <div class="row">
            <div class="input-field col s12 m4 l4">
                <input type="text" id="search" required="">
                <label class="label-icon" for="search">Customer</label>
            </div>

            <div class="input-field col s12 m4 l4">
              <!-- dapat autogenerated-->
              <input type="text" name="transaction-no" required="">
              <label for="transaction-no">Transaction No.</label>
            </div>
      </div>

      <div class="card">
        <div class="card-content">
            <div class="row">
              <div class="col l12 m6 s6">
                  <div class="row">
                      <div class="col s12 m6 l4">
                          <form action="#" style="font-color: black;">
                              <p>
                                  <input type="checkbox" class="filled-in" id="eyeglass" />
                                  <label for="eyeglass" class="black-text bold">EYE GLASS</label>
                              </p>
                              <p>
                                  <input type="checkbox" id="single">
                                  <label for="single" class="light-blue-text text-darken-4 bold">SINGLE</label>
                              </p>
                              <p style="text-indent: 20px">
                                  <input type="checkbox" id="lhi">
                                  <label for="lhi">LHI MULTI</label>
                              </p>
                              <p style="text-indent: 20px">
                                  <input type="checkbox" id="multi">
                                  <label for="multi">MULTI</label>
                              </p>
                              <p style="text-indent: 20px">
                                  <input type="checkbox" id="multi">
                                  <label for="multi">MULTI</label>
                              </p>
                              <p style="text-indent: 20px">
                                  <input type="checkbox" id="hc">
                                  <label for="hc">H.C.</label>
                              </p>
                              <p style="text-indent: 20px">
                                  <input type="checkbox" id="cr39">
                                  <label for="cr39">CR39</label>
                              </p>
                          </form>
                      </div>
                      <div class="col s12 m6 l4">
                          <form action="#" style="font-color: black;">
                              <p style="padding-top:35px">
                                  <input type="checkbox" id="double">
                                  <label for="double" class="light-blue-text text-darken-4 bold">DOUBLE</label>
                              </p>
                              <p style="text-indent: 20px">
                                  <input type="checkbox" id="kk">
                                  <label for="kk">KK</label>
                              </p>
                              <p style="text-indent: 20px">
                                  <input type="checkbox" id="flattop">
                                  <label for="flattop">FLAT TOP</label>
                              </p>
                              <p style="text-indent: 20px">
                                  <input type="checkbox" id="progressive">
                                  <label for="progressive">PROGRESSIVE</label>
                              </p>
                              <p style="text-indent: 20px">
                                  <input type="checkbox" id="exec">
                                  <label for="exec">EXEC</label>
                              </p>
                              <p style="text-indent: 20px">
                                  <input type="checkbox" id="noline">
                                  <label for="noline">NOLINE</label>
                              </p>
                              
                          </form>
                      </div>
                      <div class="col s12 m6 l4" style="top-margin:50px">
                          <form action="#" style="font-color: black;">
                              <br> <br> <br> <br> <br>
                              <p style="text-indent: 20px">
                                  <input type="checkbox" id="hoyanm">
                                  <label for="hoyanm">HOYA NM</label>
                              </p>
                              <p style="text-indent: 20px">
                                  <input type="checkbox" id="hoyamlti">
                                  <label for="multi">HOYA MLTI</label>
                              </p>
                              <p style="text-indent: 20px">
                                  <input type="checkbox" id="vrx">
                                  <label for="vrx">VRX</label>
                              </p>
                              <p style="text-indent: 20px">
                                  <input type="checkbox" id="pentax">
                                  <label for="pentax">PENTAX</label>
                              </p>
                          </form>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col s12 m6 l4">
                        <form action="#" style="font-color:black;">
                              <p>
                                  <input type="checkbox" class="filled-in" id="glass" />
                                  <label for="glass" class="black-text bold">GLASS</label>
                              </p>
                              <p>
                                  <input type="checkbox" class="filled-in" id="plastic" />
                                  <label for="plastic" class="black-text bold">PLASTIC</label>
                              </p>
                        </form>
                      </div>
                    
                  </div>
              </div>
            </div>
        </div>
      </div>
      <hr>
      
      <div class="card">
          <div class="card-content">
              <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Sph. Cyl</th>
                      <th>Axiz</th>
                      <th>B.C.</th>
                      <th>P.D.</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td>O.D.</td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                      </tr>
                      <tr>
                        <td>O.S.</td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                        <td><input type="text" name=""></td>
                      </tr>
                  </tbody>
              </table>
              <div class="row">
                 <div class="col l4">
                Frame:
                  <select name="cars">
                    <option value="">--Select--</option>
                    <option value="">WP</option>
                  </select> 
                    Lens Tint:<input type="text" name="">
                </div>

                <div class="col l4">
                Add OS:<input type="text" name="">
                Add OS:<input type="text" name="">
                </div>
              </div>
             
          </div>  
      </div>
      <hr>
      <div class="card">
        <div class="card-content">
          <div class="row">
                <div class="col l6 m6 s12">
                    <div class="row">
                      <div class="input-field">
                        <label for="note">Note:</label>
                        <input id="note" name="note" type="text" value="" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field">
                        <label for="doctor">Doctor-in-Charge:</label>
                        <input id="doctor" name="doctor" type="text" value="" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field">
                        <label for="sales">Sales-in-Charge:</label>
                        <input id="sales" name="sales" type="text" value="" />
                      </div>
                    </div>
                </div>
                <div class="col s12 m6 l6">
                    <div class="row">
                      <div class="input-field"> 
                        <label for="amount">Amount:</label>
                        <input type="number" name="amount" id="amount" disabled="disable">
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field">
                        <label for="deposit">Deposit:</label>
                        <input type="number" name="deposit" id="deposit">
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field">
                        <label for="balance">Balance:</label>
                        <input type="number" name="balance" id="balance" disabled="disable">
                      </div>
                    </div>
                </div>
          </div>

          <div class="row">
              <div class="input-field col l12 s12 center">
                <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Save</button>
                <a href="{{ URL::to('/sales') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
              </div>
            </div
        </div>
      </div>

  </form>
</div>


{{-- Scripts START --}}

{{-- Scripts END --}}
@endsection