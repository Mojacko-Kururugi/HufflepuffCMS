@extends('layouts.admin-master')

@section('content')

<!--   <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h3>Add New Product Type</h3>

    </div>
  </div> -->

  <div class="row page-title">
    <div class="col s12 m12 l12">
      <h5>Add New Product Type</h5>
    </div>
  </div>


  <div class="contents">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="card">
          <div class="card-content">
              <form action="{{ URL::to('/product-type/save') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
                <div class="row">
                      <div class="input-field col l12 m8 s12">
                        <label for="name">Item Type Name*</label>
                        <input id="name" name="name" type="text" class="validate" value="" data-error=".item_error" />
                        <div class="item_error"></div>
                      </div>
                </div>

                    <div class="row">
                      <div class="col s6">
                        <label for="stype">Item Super Type*:</label>
                        <select class="browser-default" name="stype" id="stype" data-error=".stype_error">
                           <option value="" disabled selected>- select -</option>
                           <option value="1">Product</option>
                           <option value="2">Raw Material</option>
                        </select>
                        <div class="stype_error"></div>
                      </div> 

                      <div class="row">
                      <div class="col s6">
                        <label for="exp">Is Expirable?*:</label>
                        <select class="browser-default" name="exp" id="exp" data-error=".exp_error">
                           <option value="" disabled selected>- select -</option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                        <div class="exp_error"></div>
                      </div> 

                    <div class="row">
                      <div class="input-field col l12 s12 center">
                        <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Save</button>
                        <a href="{{ URL::to('/product-type') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
                      </div>
                    </div>
                    </form>
          </div>
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
        name: "required",
        stype: "required",
        exp: "required",
      },
      errorElement: 'div'
    });
  });
</script>
{{-- Scripts END --}}
@endsection