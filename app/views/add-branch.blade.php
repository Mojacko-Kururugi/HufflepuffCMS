@extends('layouts.admin-master')
@section('javascript')

<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
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
      <h3>Add New Branch</h3>
    </div>
  </div>

  <div class="contents z-depth-1">
    <div class="container">
      <form action="{{ URL::to('/save-branch') }}" method="post" id="addbranch_validate"><br><br>
            <div class="row">
                  <div class="input-field col l12 m8 s12">
                    <label for="branchname">Branch Name</label>
                    <input id="branchname" name="branchname" type="text" class="required specialChar" >
                  </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12"> 
                <label for="address">Address</label>
                <input id="address" name="address" type="text" class=" required specialChar" >
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m8 l6">
                <label for="contact_number">Contact Number</label>
                <input id="contact_number" name="contact_number" type="text">
              </div>
            </div>
            <div class="row">
              <div class="input-field col l12 s12 center">
                <button type="submit" class="waves-effect waves-light btn btn-green modal-btn" id="savebranchbtn">Save</button>
                <a href="{{ URL::to('/branches') }}" class="waves-effect waves-light btn btn-green modal-btn" style="margin-right:20px;">Cancel</a>
              </div>
            </div>
            <br><br>
      </form>
    </div>
  </div>

  <script type="text/javascript">

  $(document).ready(function(){

     jQuery.validator.addMethod("specialChar", function(value, element) {
     return this.optional(element) || /([0-9a-zA-Z\s])$/.test(value);
  }, "Please Fill Correct Value in Field.");

  $("#contact_number").mask("(9999) 999-9999");


$("#contact_number").on("blur", function() {
    var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );
    
    if( last.length == 3 ) {
        var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );
        var lastfour = move + last;
        
        var first = $(this).val().substr( 0, 9 );
        
        $(this).val( first + '-' + lastfour );
    }
});
    $('#addbranch_validate').validate({
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
              minlength: 11
             
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

      errorElement: "div",

    errorPlacement : function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    },
       submitHandler: function (form) {
            alert("New Branch Added!");
            return true;
        },
        invalidHandler: function () {
            alert("Form is invalid. Please input data");
        }
    });
  });
  </script>
@endsection
