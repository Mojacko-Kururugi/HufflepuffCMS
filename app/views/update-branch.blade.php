@extends('layouts.admin-master')

@section('content')

  <?php Session::put('upId', $id); ?>             
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script>
  $(document).ready(function(){
    $("#contact_number").keypress(function(e){
      if (e.which != 8 && e.which !=0 && (e.which <48 || e.which> 57)){
        alert ("digits only");
        return false;
      }
    })
    $('#updateBranch').validate({
      rules: {
        'branchname': {
              required : true,
              minlength: 5
        },
        'address': {
              required: true,
        },
        'contact_number': {
              required: true,
              minlength: 11,
              maxlengh: 11
        }
      },
      messages: {
        'branchname':{
          required: "Please enter branchname",
        },
        'address': {
          required: "Please enter Branch address",
        },
     
      },
       submitHandler: function (form) {
            alert("New Updated Added!");
            return true;
        },
        invalidHandler: function () {
            alert("Form is invalid. Please input data");
        }
    });
  });
</script>
  <div class="row"><br>
    <div class="center col l12 m12 s12">
      <h3>Update Branch</h3>

    </div>
  </div>

  <div class="contents z-depth-1">
    <div class="container">
      <form action="{{ URL::to('/update-branch') }}" method="POST" id="updateBranch"><br><br>
        <div class="row">
              <div class="input-field col l12 m8 s12">
                <label for="email">Branch Name</label>
                <input id="branchname" name="branchname" type="text" value="{{ $data->strBranchName }}" class="required specialChar" />
              </div>
        </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
              <label for="address">Address</label>
                <input id="address" name="address" type="text"  value="{{ $data->strBranchAddress }}">
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m8 l6">
               <label for="contact_number">Contact Number</label>
                <input id="contact_number" name="contact_number" type="text" value="{{ $data->strBContactNumb }}">
               
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


{{-- Scripts START --}}
<script type="text/javascript">
 $("#updateBranch").validate();
    jQuery.validator.addMethod("specialChar", function(value, element) {
     return this.optional(element) || /([0-9a-zA-Z\s])$/.test(value);
  }, "Please Fill Correct Value in Field.");
</script>
{{-- Scripts END --}}
@endsection