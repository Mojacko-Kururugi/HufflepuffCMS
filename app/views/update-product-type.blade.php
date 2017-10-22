@extends('layouts.admin-master')

@section('content')

  <?php Session::put('upId', $id); ?>  

<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Update Product Type</h5>
  </div>
</div>

  <div class="contents">
    <div class="container">
   <div class="card">
    <div class="card-content">
        <div class="contents">
      <form action="{{ URL::to('/product-type/update') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
        <div class="row">
              <div class="input-field col l12 m8 s12">
                <label for="name">Product Type Name*</label>
                <input id="name" name="name" type="text" class="validate" value="{{$data->strITDesc}}" />
              </div>
        </div>

            <div class="row">
              <div class="input-field col l12 s12 center">
                <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Save</button>
                <a href="{{ URL::to('/product-type') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
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
<script type="text/javascript">
  $().ready(function() {
    $("#signup_validate").validate({
      rules: {
        name: "required"
      },
      errorElement: 'div'
    });
  });
</script>
{{-- Scripts END --}}
@endsection