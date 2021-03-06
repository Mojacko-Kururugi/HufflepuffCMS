@extends('layouts.admin-master')

@section('content')

  <?php Session::put('upId', $id); ?>  

<!--   <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h3>Update Product</h3>

    </div>
  </div> -->


  <div class="row page-title">
    <div class="col s12 m12 l12">
      <h5>Update Product</h5>
    </div>
  </div>

  <div class="contents">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-content">
                  <form action="{{ URL::to('/products/update-prod') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
        <div class="row">
              <div class="input-field col l12 m8 s12">
                <label for="name">Product Name*</label>
                <input id="name" name="name" type="text" class="validate" value="{{ $prod->strItemName }}"  data-error=".name_error"/>
               <div class="name_error"></div>
              </div>
        </div>
        <div class="row">
              <div class="input-field col l12 m8 s12">
                <label for="brand">Product Brand*</label>
                <input id="brand" name="brand" type="text" class="validate" value="{{ $prod->strItemBrand }}"  data-error=".brand_error"/>
                <div class="brand_error"></div>
              </div>
        </div>
        <div class="row">
                      <div class="input-field col l12 m8 s12">
                        <label for="model">Product Description</label>
                        <input id="model" name="model" type="text" class="validate" value="{{ $prod->strItemDesc }}" />
                      </div>
                </div>
        <div class="row">
              <div class="form-group col l6 ">
                <label for="price">Price per piece*</label>
                <input type="number" class="form-control" name="price" id="price" value="{{ $prod->dcPrice }}" data-error=".price_error">
                <div class="price_error"></div>
              </div>
        </div>
                    <div class="input-field col l6 m6 s12">
                        <select class="initialized browser-default" name="type" value="{{ $prod->intItemType }}" id="type" data-error=".school_error">
                          <option value="" disabled>Type*</option>
                          @foreach($data as $data)
                            <option value="{{ $data->intITID}}" @if(Input::old('type') == $data->intITID) selected="selected" @endif>{{ $data->strITDesc}}</option>
                          @endforeach
                        </select>
                       <div class="school_error"></div>
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
        </div>
      </div>

          </div>
        </div>



{{-- Scripts START --}}
<script type="text/javascript">
  $().ready(function() {
    var price = document.getElementById("price");
       
       $("#price").blur(function(){
          price.value = parseFloat(price.value).toFixed(2);
          //alert(price.value); 
       });

    $("#signup_validate").validate({
      rules: {
        type: "required",
        name: "required",
        brand: "required",
        price: "required"
      },
      errorElement: 'div'
    });
  });
</script>
{{-- Scripts END --}}
@endsection