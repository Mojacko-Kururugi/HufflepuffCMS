@extends('layouts.admin-master')

@section('content')

<!--   <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h3>Add New Branch</h3>

    </div>
  </div>
 -->


<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Add New Branch</h5>
  </div>
</div>

  <div class="contents">
    <div class="container">

          <div class="row">
            <div class="col s12">
               <div class="card-panel">

                <form action="{{ URL::to('/save-branch') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
                  <div class="row">
                        <div class="input-field col l12 m8 s12">
                          <label for="number">Branch Name*</label>
                          <input id="number" name="number" type="text" class="validate" value="" data-error=".branch_error"/>
                          <div class="branch_error"></div>
                        </div>
                  </div>
                      <div class="row">
                        <div class="input-field col s12 m12 l12">
                          <input id="address" name="address" type="text" class="validate" value="" data-error=".address_error">
                          <label for="address">Address*</label>
                          <div class="address_error"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12 m8 l6">
                          <input id="stud_id_no" name="stud_id_no" type="number" class="validate" value=""  data-error=".num_error">
                          <label for="stud_id_no">Contact Number*</label>
                          <div class="num_error"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col l12 s12 center">
                          <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Save</button>
                          <a href="{{ URL::to('/branches') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
                        </div>
                      </div>
                      <br><br>
                      </form>
               </div>
            </div>
          </div>

          </div>
        </div>


{{-- Scripts START --}}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script type="text/javascript">
  $().ready(function() {
    $("#signup_validate").validate({
      rules: {
        number: "required",
        address: "required",
        stud_id_no: "required",
      },
      errorElement: 'div'
    });
  });

</script>
{{-- Scripts END --}}
@endsection