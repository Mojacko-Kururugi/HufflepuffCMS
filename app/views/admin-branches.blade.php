@extends('layouts.admin-master')

@section('content')

<!-- header -->
<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Branches</h5>
  </div>
</div>


<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <div class="container-fluid">
    <div class="card">
      <div class="card-content">

        <div class="row">
          <div class="col s12 m12 l6">
            <a class="waves-effect waves-light btn blue darken-1 btn-small center-text" href="/add-branch">ADD NEW BRANCH</a>
            <button class="modal-trigger waves-effect waves-light btn blue darken-4 btn-small center-text" href="#viewprod">DEACTIVATE ALL BRANCHES</button>
          </div>
        </div>
        <div class="row">
          <div class="col s12 m12 l12">
            <div>
                <div class="col s12 m12 l12 overflow-x">
                <table class="centered">
                    <thead>
                      <tr>
                        <th>Branch Name</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Date Created</th>
                      </tr>
                    </thead>

                    <tbody>
                    @foreach($data as $branch)
                      <tr>
                        <td>{{ $branch->strBranchName }}</td>
                        <td>{{ $branch->strBranchAddress }}</td>
                        <td>{{ $branch->strBContactNumb }}</td>
                        <td>{{ $branch->created_at }}</td>
                        <td>
                            <div class="center-btn">
                             <a class="waves-effect waves-light btn green darken-1 btn-small center-text" href="branch/{{$branch->strBranchCode}}">UPDATE</a>
                             <a class="waves-effect waves-light btn red lighten-1 btn-small center-text" href="d-branch/{{$branch->strBranchCode}}">DEACTIVATE</a>
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

