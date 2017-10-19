@extends('layouts.admin-master')

@section('content')

  <?php Session::put('upId', $id); ?>  

<!--   <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h3>Update Services</h3>

    </div>
  </div> -->

 <div class="row page-title">
    <div class="col s12 m12 l12">
      <h5>Update Services</h5>
    </div>
  </div>

  <div class="contents">
    <div class="container">
     <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-content">
                  <form action="{{ URL::to('/services/update-serv') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
        <div class="row">
              <div class="input-field col l12 m8 s12">
                <label for="name">Service Name*</label>
                <input id="name" name="name" type="text" class="validate" value="{{$data->strServName}}"  data-error=".name_error"/>
                <div class="name_error"></div>
              </div>
        </div>
      <br>
          <div class="row">
                <div class="col s12">
                <label for="desc">Description:</label>
                <textarea id="desc" name="desc" class="materialize-textarea">{{$data->strServDesc}}</textarea>
                </div>
          </div> 
            <div class="row">
              <div class="input-field col l12 s12 center">
                <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Save</button>
                <a href="{{ URL::to('/services') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
              </div>
            </div>
            <br><br>
            </form>
            </div>
          </div>
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
        name: "required"
      },
      errorElement: 'div'
    });
  });
</script>
@endsection