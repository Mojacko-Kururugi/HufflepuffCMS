@extends('layouts.secretary-master')

@section('content')

  <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h3>Medical Service</h3>

    </div>
  </div>

  <div class="contents z-depth-1">
    <div class="container">
      <form action="{{ URL::to('/save-service') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
              <div class="row">
                <div class="input-field col l6 m6 s12">
                  <input id="user_id" name="user_id" type="text" class="validate" data-error=".id_error" value="{{$count}}" readonly/>
                  <label for="user_id">Service Ref #:</label>
                  <div class="id_error"></div>
                </div>
              </div>

                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="doc" id="doc" data-error=".school_error">
                          <option value="" disabled selected>Optometrist Name</option>
                          @foreach($doc as $doc)
                            <option value="{{ $doc->intDocID}}" @if(Input::old('doc') == $doc->intDocID) selected="selected" @endif>{{ $doc->strDocLast . ', ' . $doc->strDocFirst . ' ' . $doc->strDocMiddle}}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="patient" id="patient" data-error=".school_error">
                          <option value="" disabled selected>Patient Name</option>
                          @foreach($patient as $patient)
                            <option value="{{ $patient->intPatID}}" @if(Input::old('patient') == $patient->intPatID) selected="selected" @endif>{{ $patient->strPatLast . ', ' . $patient->strPatFirst . ' ' . $patient->strPatMiddle}}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>

                  <hr>
        <div class="row">
          <div class="col l12 m6 s6">
              <div class="row">
                 <div class="col s12 m6 l4">
                  <h5>Complaints:</h5>
                      <p>
                        <input type="checkbox" id="BOVfar" />
                        <label for="BOVfar">BOV Far</label>
                      </p>
                      <p>
                        <input type="checkbox" id="BOVnear" />
                        <label for="BOVnear">BOV Near</label>
                      </p>
                      <p>
                        <input type="checkbox" id="headache" />
                        <label for="headache">Headache</label>
                      </p>
                      <p>
                        <input type="checkbox" id="dizziness" />
                        <label for="dizziness">Dizziness</label>
                      </p>
                      <p>
                        <input type="checkbox" id="glare" />
                        <label for="glare">Glare</label>
                      </p>
                      <p>
                        <input type="checkbox" id="vomitting" />
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
              <h5>New Rx</h5>
              <h6>Spectacles</h6>
            </div>
            <div class="input-field col l6 m6 s12">
              <label for="OD">OD:</label>
              <input id="OD" name="OD" type="number" class="" value="" />
            </div>
            <div class="input-field col l6 m6 s12">
              <label  for="ODAdd">Add:</label>
              <input id="ODAdd" name="ODAdd" type="number" class="" value=""/>
            </div>
            <div class="input-field col l6 m6 s12">
              <label for="OS">OS:</label>
              <input id="OS" name="OS" type="number" class="" value="" />
            </div>
            <div class="input-field col l6 m6 s12">
                <label  for="OSAdd">Add:</label>
                <input id="OSAdd" name="OSAdd" type="number" class="" value=""/>
            </div>
        </div>
        <div class="row">
          <div class="col s12">
            <h6>VA/Contact Lens</h6>
          </div>
          <div class="input-field col l6 m6 s12">
            <label for="CLOD">OD:</label>
            <input id="CLOD" name="OD" type="number" class="" value="" />
          </div>
          <div class="input-field col l6 m6 s12">
            <label  for="CLOS">OS:</label>
            <input id="CLOS" name="CLOS" type="number" class="" value=""/>
          </div>
        </div>
          
      </div>

                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="service" id="service" data-error=".school_error">
                          <option value="" disabled selected>Service</option>
                          @foreach($service as $service)
                            <option value="{{ $service->intServID}}" @if(Input::old('service') == $service->intServID) selected="selected" @endif>{{ $service->strServName }}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>

                  <div class="row">
                        <div class="col s12">
                        <label for="desc">Consultation Diagnosis and Details:</label>
                        <textarea id="desc" name="desc" class="materialize-textarea"></textarea>
                        </div>
                  </div> 


                  <div class="row">
                        <div class="col s12">
                        <label for="asc">Prescription and Recommendations:</label>
                        <textarea id="asc" name="asc" class="materialize-textarea"></textarea>
                        </div>
                  </div> 

               <div class="row">
                  <div class="col s12">
                    <label for="claim">Will Purchase A Product?</label>
                    <select name="claim" id="claim">
                 <option value="" selected disabled>- Choose Option -</option>
                 <option value="1">Yes</option>
               <option value="2">No</option>
                   </select>
                  </div>
                </div>

              <div class="row">
                <div class="input-field col l6 m6 s12">
                  <input id="fee" name="fee" type="number" data-error=".id_error" />
                  <label for="fee">Specified Total Fee:</label>
                  <div class="id_error"></div>
                </div>
              </div>

              <!--    <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="type" id="type" data-error=".school_error">
                          <option value="" disabled selected>Payment Type</option>
                          @foreach($type as $type)
                            <option value="{{ $type->intPayTID}}" @if(Input::old('type') == $type->intPayTID) selected="selected" @endif>{{ $type->strPayTDesc }}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="status" id="status" data-error=".school_error">
                          <option value="" disabled selected>Payment status</option>
                          @foreach($status as $status)
                            <option value="{{ $status->intServStatID}}" @if(Input::old('status') == $status->intServStatID) selected="selected" @endif>{{ $status->strServStatDesc }}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div> -->

            <div class="row">
              <div class="input-field col l12 s12 center">
                <button type="submit" class="waves-effect waves-light btn btn-green">Save</button>
                <a href="{{ URL::to('/sec-home') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
              </div>
            </div>
            <br><br>
            </form>
          </div>
        </div>


{{-- Scripts START --}}
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