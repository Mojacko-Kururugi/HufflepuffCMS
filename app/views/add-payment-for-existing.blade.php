@extends('layouts.master')

@section('content')

<!-- header -->
<div class="row page-title">
  <div class="col s12 m12 l12">
    <h5>Add Payment on Existing</h5>
  </div>
</div>

<div class="main-wrapper">
  <!-- ACTUAL PAGE CONTENT GOES HERE -->
  <div class="container-fluid">
    <div class="card">
      <div class="card-content">

        <div class="row">
          <div class="nav-wrapper">
            <div class="container-fluid">
			 <span class="card-title">Transactions</span>
			  <div class="input-field col s12 m4 l4 right">
                      <input id="last_name_sa" name="last_name_sa" type="text" class="validate">
                      <label for="last_name_sa">Patient Name</label>
                    </div>
			 <hr>
              <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Transaction ID</th>
                        <th>Description</th>
                        <th>Total</th>
                        <th>Balance</th>
                        <th>Status</th>
                    </tr>
                </thead>
                </tbody>
              </table>
            <br>
            <br>
            </div>
            <!-- dito naman yung mga susunod na shits kung may idadagdag pa ^_^ -->
          </div>
        </div>
      </div>
	 </div>
	 
	 <div class="row">
    <div class="col s12 m12 l5">
			<div class="card-panel">
			<span class="card-title">Payment History</span>
			<a class="waves-effect waves-light btn blue darken-1 btn-small center-text right" href="/add-payment" >Add</a>
			<hr>
			<div class="card-content">
			<table class="centered">
				<thead>
				<tr>
					<th>Date</th>
					<th>Amount</th>
					<th>Balance</th>
				</tr>
				</thead>
			</table>
			</div>
		</div>
  </div>
 
  
   <div class="col s12 m12 l7">
   <div class="card-panel">
        <span class="card-title">Products Bought with Transaction</span>
        <hr>
        <div class="card-content">
          <table class="centered">
            <thead>
              <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
              </tr>
            </thead>
          </table>
        </div>
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
 <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.material.min.js"></script>

@stop

