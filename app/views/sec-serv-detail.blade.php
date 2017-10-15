@extends('layouts.secretary-master')

@section('content')

  <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h3>Service Details</h3>
    </div>
  </div>

  <div class="contents z-depth-1">
    <div class="container">

              <div class="row">
                <div class="input-field col l6 m6 s12">
                  <input id="user_id" name="user_id" type="text" class="validate" data-error=".id_error" value="{{$serv_id}}" readonly/>
                  <label for="user_id">Service Ref #:</label>
                  <div class="id_error"></div>
                </div>
              </div>
      @if($med != null)
              <div class="row">
                <div class="input-field col l6 m6 s12">
                  <input id="user_id" name="user_id" type="text" class="validate" data-error=".id_error" value="{{$med->strDocLast . ", " . $med->strDocFirst}}" readonly/>
                  <label for="user_id">Optometrist:</label>
                  <div class="id_error"></div>
                </div>
              </div>

                  <hr>
        <div class="row">
          <div class="col l12 m6 s6">
              <div class="row">
                 <div class="col s12 m6 l4">
                  <h5>Complaints:</h5>
                      <p>
                        <input type="checkbox" id="BOVfar" name="BOVfar" value="1" @if(strpos($med->strPatComplaints , '1') !== false) checked @endif/>
                        <label for="BOVfar">BOV Far</label>
                      </p>
                      <p>
                        <input type="checkbox" id="BOVnear" name="BOVnear" value="2" @if(strpos($med->strPatComplaints , '2') !== false) checked @endif/>
                        <label for="BOVnear">BOV Near</label>
                      </p>
                      <p>
                        <input type="checkbox" id="headache" name="headache" value="3" @if(strpos($med->strPatComplaints , '3') !== false) checked @endif/>
                        <label for="headache">Headache</label>
                      </p>
                      <p>
                        <input type="checkbox" id="dizziness" name="dizziness" value="4" @if(strpos($med->strPatComplaints , '4') !== false) checked @endif/>
                        <label for="dizziness">Dizziness</label>
                      </p>
                      <p>
                        <input type="checkbox" id="glare" name="glare" value="5" @if(strpos($med->strPatComplaints , '5') !== false) checked @endif/>
                        <label for="glare">Glare</label>
                      </p>
                      <p>
                        <input type="checkbox" id="vomitting" name="vomitting" value="6" @if(strpos($med->strPatComplaints , '6') !== false) checked @endif/>
                        <label for="vomitting">Vomitting</label>
                      </p>
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
              <h5>Rx</h5>
              <h6>Spectacles</h6>
            </div>
            <div class="input-field col l6 m6 s12">
              <label for="OD">OD:</label>
              <input id="OD" name="OD" type="number" class="" value="{{$rx->strSOD}}" />
            </div>
            <div class="input-field col l6 m6 s12">
              <label  for="ODAdd">Add:</label>
              <input id="ODAdd" name="ODAdd" type="number" class="" value="{{$rx->strSODAdd}}"/>
            </div>
            <div class="input-field col l6 m6 s12">
              <label for="OS">OS:</label>
              <input id="OS" name="OS" type="number" class="" value="{{$rx->strSOS}}" />
            </div>
            <div class="input-field col l6 m6 s12">
                <label  for="OSAdd">Add:</label>
                <input id="OSAdd" name="OSAdd" type="number" class="" value="{{$rx->strSOSAdd}}"/>
            </div>
        </div>
        <div class="row">
          <div class="col s12">
            <h6>VA/Contact Lens</h6>
          </div>
          <div class="input-field col l6 m6 s12">
            <label for="CLOD">OD:</label>
            <input id="CLOD" name="CLOD" type="number" class="" value="{{$rx->strCLOD}}" />
          </div>
          <div class="input-field col l6 m6 s12">
            <label  for="CLOS">OS:</label>
            <input id="CLOS" name="CLOS" type="number" class="" value="{{$rx->strCLOS}}"/>
          </div>
        </div>
          
      </div>


                  <div class="row">
                        <div class="col s12">
                        <label for="desc">Consultation Diagnosis and Details:</label>
                        <textarea id="desc" name="desc" class="materialize-textarea">{{$med->strCRDiagnosis}}</textarea>
                        </div>
                  </div> 


                  <div class="row">
                        <div class="col s12">
                        <label for="asc">Prescription and Recommendations:</label>
                        <textarea id="asc" name="asc" class="materialize-textarea">{{$med->strCRPrescriptions}}</textarea>
                        </div>
                  </div> 

            <br><br>
        @endif


        @if($purch != null || $list2 != null)
        <div class="row">
          <div class="nav-wrapper">
            <div class="container-fluid">
              <h5>Purchases</h5>
              <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Desc</th>
                        <th>Quantity</th>
                        <th>Sub-total</th>
                    </tr>
                </thead>
                <tbody>
                <?php $total = 0 ?>
                @foreach($purch as $data)
                      <tr>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemDesc }}</td>
                        <td>{{ $data->intQty }}</td>
                         <?php $subtotal = $data->dcTotPrice ?>
                        <td>P {{ $subtotal }}</td>
                      </tr>
                      <?php $total += $subtotal ?> 
                @endforeach
                 @foreach($list2 as $l2)
                        <tr>
                          <td>{{$l2->strJODetails}}</td>
                          <td><a class="waves-effect waves-light btn btn-small red center-text">DETAILS</a></td>
                          <?php $subtotal = $l2->dcJOFee ?>
                          <td>1</td>
                          <td>P {{$subtotal}}</td>
                        </tr>
                        <?php $total += $subtotal ?>
                 @endforeach
                @foreach($list3 as $l3)
                        <tr>
                          <td>Medical Fee</td>
                          <td></td>
                          <?php $subtotal = $l3->dcCRFee ?>
                          <td></td>
                          <td>P {{$subtotal}}</td>
                        </tr>
                        <?php $total += $subtotal ?>
                 @endforeach
                <tr class="dashed" id="summary-grand-total">
                  <td><h6 class="sales-info">TOTAL: </h6></td>
                  <td></td>
                  <td></td>
                  <td>
                      <h6 class="sales-info">P {{$total}}</h6>
                      <strong class="text-success"></strong>
                  </td>
              </tr>  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <br>
          @endif

          </div>
        </div>


{{-- Scripts START --}}
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


<script type="text/javascript">
  var date = new Date();
  var nameRegex = /^([ \u00c0-\u01ffa-zA-Z'\-])+$/;
  var contactRegex = /((\+63)|0)\d{10}/;

  $(document).ready(function() {
    $('#b_day').pickadate({
      format: "yyyy-mm-dd",
      selectYears: true,
      selectMonths: true,
      selectYears: 100, // scroll shits of years
      min: new Date(1929,12,31),
      max: new Date(2009,12,01)
    });

    $('#user_image_input').on('change', function() {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#image_div').attr('src', e.target.result);
      };

      reader.readAsDataURL(this.files[0]);
    });

    $.validator.addMethod("regex", function(value, element, regexp) {
      return regexp.test(value);
    }, "Please enter a valid format.");

    $('#signup_validate').validate({
      rules: {
        stud_id_no: {
          required: true
        },
        
        user_type: "required",

        first_name_sa: {
          required: true,
          regex: nameRegex
        },

        // middle_name_sa: {
        //   regex: nameRegex
        // },

        last_name_sa: {
          required: true,
          regex: nameRegex
        },

        school: "required",

        gender: "required",

        b_day: {
          required: true
        },

        number: {
          required: true,
          regex: contactRegex
        },

        address: {
          required: true
        },

      },
      errorElement: 'div'
    });
  });

// function alphaOnly(event) {
//   var key = event.keyCode;
//   return ((key >= 65 && key <= 90) || key == 8 || key == 32);
// };
</script>
{{-- Scripts END --}}
@endsection