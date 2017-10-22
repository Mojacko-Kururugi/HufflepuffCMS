@extends('layouts.admin-master')

@section('content')

<!--   <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h3>Add New Services</h3>

    </div>
  </div>
 -->
   <div class="row page-title">
    <div class="col s12 m12 l12">
      <h5>Add Quantities for the Delivery</h5>
    </div>
  </div>

  <div class="contents">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-content">
          <form action="{{ URL::to('admin/delivery/') }}" method="POST" id="signup_validate" enctype="multipart/form-data"><br><br>
              <div class="col s12 m12 l12 overflow-x">
                <table class="centered">
                    <thead>
                      <tr>
                        <th>Requested Item</th>
                        <th>Requested Quantity</th>
                        <th>Available Lot and Quantity</th>
                        <th>Quantity to Deliver</th>
                      </tr>
                    </thead>

                    <tbody>
                    @foreach($data as $list)
                    <tr>
                      <td>{{ $list->strItemName }} - {{ $list->strItemDesc }}</td>
                      <td>{{ $list->intOQty }}</td>
                      <td>
                        <div class="input-field col l12 m12 s12">
                        <select class="initialized browser-default" name="item[]" id="item" data-error=".school_error">
                          <option value="" disabled selected>Items*</option>
                           @foreach($inv as $invi)
                           @if($invi->intInvPID == $list->intOProdID)
                            <option value="{{ $invi->strInvLotNum}}" @if(Input::old('branch') == $invi->strInvLotNum) selected="selected" @endif>{{ $invi->strInvLotNum }} - {{ $invi->intInvQty }} stocks</option>
                          @endif
                          @endforeach
                        </select>
                       <div class="school_error"></div>
                    </div>
                      </td>
                      <td>
                      <div class="input-field col l12 m8 s12">
                      <label for="name">Quantity*</label>
                      <input id="name" name="name[]" type="text" class="validate" value="" data-error=".name_error"/>
                      <div class="name_error"></div>
                      </div>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="row">
                  <div class="input-field col l12 s12 center">
                    <button type="submit" class="waves-effect waves-light btn btn-green modal-btn">Save</button>
                    <a href="{{ URL::to('/admin') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
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
{{-- Scripts END --}}@endsection