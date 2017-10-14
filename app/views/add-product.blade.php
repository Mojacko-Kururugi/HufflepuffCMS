@extends('layouts.admin-master')
@section('javascript')

<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery.validate.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#addProduct_validate').validate({
      rules: {
        'brand': {
          required: true
        },
        'name': {
          required: true
        },
        'model': {
          required: true,
        }
      },
      messages: {
        'brand': {
          required: "Please input product brand name"
        },
        'name':{
          required: "Please input product name"
        },
        'model': {
          required: "Please input product model"
        }
      },

      errorElement: 'div',

      errorPlacement : function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    },
      submitHandler: function (form) {
            alert("New Product Added!");
            return true;
        },
        invalidHandler: function () {
            alert("Form is invalid. Please input data");
        }
    });
  });    
</script>
@stop
<style type="text/css">
  div.error {
  color: red;
  margin-top: -15px;
  padding: 0;
  font-size: 0.9em;
}
</style>
@section('content')

  <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h3>Add New Product</h3>
    </div>
  </div>

  <div class="contents z-depth-1">
    <div class="container">
      <form action="{{ URL::to('/products/add-prod') }}" method="post" id="addProduct_validate"><br><br>
                          
         <div class="input-field col l6 m6 s12">
            <select class="initialized browser-default" name="type" id="type" required>
                <option value="" disabled selected>Type</option>
                    @foreach($data as $data)
                      <option value="{{ $data->intITID}}" @if(Input::old('type') == $data->intITID) selected="selected" @endif>{{ $data->strITDesc}}
                      </option>
                    @endforeach
            </select>
        </div>
        <div class="row">
            <div class="input-field col l12 m8 s12">
              <label for="brand">Product Brand</label>
              <input id="brand" name="brand" type="text" required />
            </div>
        </div>
        <div class="row">
          <div class="input-field col l12 m8 s12">
              <label for="name">Product Name</label>
              <input id="name" name="name" type="text" required />
          </div>
        </div>
        <div class="row">
          <div class="input-field col l12 m8 s12">
              <label for="model">Product Description</label>
              <input id="model" name="model" type="text" required/>
          </div>
        </div>
        <div class="row">
          <div class="form-group col l6 ">
              <label for="price">Price per piece</label>
              <input type="number" class="form-control" name="price" id="price" value="1">
          </div>
        </div>
        <div class="row">
          <div class="input-field col l12 s12 center">
              <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Save</button>
                <a href="{{ URL::to('/products') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
           </div>
        </div>
            <br><br>
            </form>
          </div>
        </div>
@endsection