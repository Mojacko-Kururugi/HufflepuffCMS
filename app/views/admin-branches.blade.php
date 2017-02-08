@extends('layouts.admin-master')

@section('content')
      <div class="main-wrapper">
        <!-- ACTUAL PAGE CONTENT GOES HERE -->
        <div class="row">
          <div class="col s12 m12 l12">
            <span class="page-title">Branches</span>
          </div>

          <div class="row">
      <div class="col s12 m12 l6">
        <div class="col s12 m12 l10">

            <a class="waves-effect waves-light btn btn-small center-text" href="/add-branch">ADD NEW BRANCH</a>
            <button class="modal-trigger waves-effect waves-light btn btn-small center-text" href="#viewprod">VIEW ALL BRANCHES</button>
        </div>
      </div>
     </div>

  


          <div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <span class="card-title">Branches</span>
                <div class="divider"></div>
                <div class="card-content">
                  
                  </div>

                  <div class="col s12 m12 l12 overflow-x">
                    <table class="centered">
                      <thead>
                        <tr>
                          <th>Branch ID</th>
                          <th>Branch Name</th>
                         <!--  <th>Brand</th>
                          <th>Model</th> -->
                          <th>Date Added</th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach($branches as $branch)
                        <tr>
                          <td>{{ $branch->strBranchCode }}</td>
                          <td>{{ $branch->strBanchName }}</td>
                          <td>01/10/2001</td>
                          <td>
                              <div class="center-btn">
                               <a class="waves-effect waves-light btn btn-small center-text" href="">UPDATE</a>
                               <a class="waves-effect waves-light btn btn-small center-text" href="">DEACTIVATE</a>
                              </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- <p>
                    You have no items.
                  </p> -->

                  <div class="clearfix">

                  </div>
                </div>
              </div>
            </div>
          </div>

@stop

@section('scripts')
<!--{{ HTML::script('js/new-order.js') }}-->
<script type="text/javascript" src="js/jquery.js"></script>
<script src="js/materialize.js"></script>
<script>   
    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  }); 
</script>
@stop

