@extends('layouts.secretary-master')

@section('content')

<!--   <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h3>Medical Service</h3>

    </div>
  </div> -->

  <div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Medical Service</h5>
  </div>
</div>

  <div class="contents">
    <div class="container">
      <div class="card">
    <div class="card-content">
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
                          <option value="" disabled selected>Optometrist Name*</option>
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
                          <option value="" disabled selected>Patient Name*</option>
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
                        <input type="checkbox" id="BOVfar" name="BOVfar" value="1"/>
                        <label for="BOVfar">BOV Far</label>
                      </p>
                      <p>
                        <input type="checkbox" id="BOVnear" name="BOVnear" value="2"/>
                        <label for="BOVnear">BOV Near</label>
                      </p>
                      <p>
                        <input type="checkbox" id="headache" name="headache" value="3"/>
                        <label for="headache">Headache</label>
                      </p>
                      <p>
                        <input type="checkbox" id="dizziness" name="dizziness" value="4"/>
                        <label for="dizziness">Dizziness</label>
                      </p>
                      <p>
                        <input type="checkbox" id="glare" name="glare" value="5"/>
                        <label for="glare">Glare</label>
                      </p>
                      <p>
                        <input type="checkbox" id="vomitting" name="vomitting" value="6"/>
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
              <input id="OD" name="OD" type="text" class="" value="" />
            </div>
            <div class="input-field col l6 m6 s12">
              <label  for="ODAdd">Add:</label>
              <input id="ODAdd" name="ODAdd" type="text" class="" value=""/>
            </div>
            <div class="input-field col l6 m6 s12">
              <label for="OS">OS:</label>
              <input id="OS" name="OS" type="text" class="" value="" />
            </div>
            <div class="input-field col l6 m6 s12">
                <label  for="OSAdd">Add:</label>
                <input id="OSAdd" name="OSAdd" type="text" class="" value=""/>
            </div>
        </div>
        <div class="row">
          <div class="col s12">
            <h6>VA/Contact Lens</h6>
          </div>
          <div class="input-field col l6 m6 s12">
            <label for="CLOD">OD:</label>
            <input id="CLOD" name="CLOD" type="text" class="" value="" />
          </div>
          <div class="input-field col l6 m6 s12">
            <label  for="CLOS">OS:</label>
            <input id="CLOS" name="CLOS" type="text" class="" value=""/>
          </div>
        </div>
          
      </div>

                  <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="service" id="service" data-error=".school_error">
                          <option value="" disabled selected>Service*</option>
                          @foreach($service as $service)
                            <option value="{{ $service->intServID}}" @if(Input::old('service') == $service->intServID) selected="selected" @endif>{{ $service->strServName }}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                  </div>

                  <div class="row">
                        <div class="col s12">
                        <label for="desc">Consultation Diagnosis and Details*:</label>
                        <textarea id="desc" name="desc" class="materialize-textarea"></textarea>
                        </div>
                  </div> 


                  <div class="row">
                        <div class="col s12">
                        <label for="asc">Prescription and Recommendations*:</label>
                        <textarea id="asc" name="asc" class="materialize-textarea"></textarea>
                        </div>
                  </div> 

               <div class="row">
                  <div class="col s12">
                    <label for="claim">Will Purchase A Product?*</label>
                    <select name="claim" id="claim" class="browser-default">
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
          </div>
        </div>


{{-- Scripts START --}}
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
  $().ready(function() {
    $("#signup_validate").validate({
      rules: {
        doc: "required",
        patient: "required",
        service: "required",
        service: "required",
        asc: "required",
        desc: "required",
        claim: "required",
      },
      errorElement: 'div'
    });
  });

</script>
{{-- Scripts END --}}
@endsection