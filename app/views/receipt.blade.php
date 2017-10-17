<?php
	$columns = 
	[
		'Service Ref #',
		'Patient Name',
		'Total',
		'Balance Paid',
		'Payment Mode',
		'Status'
	];
?>

<!DOCTYPE html>
<html>
	<head>
		<title>COC Management Purchase Receipt</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<style type="text/css">
			table {
    			border-collapse: collapse;
    			margin-left:auto; margin-right:auto;
    			width: 100%;
			}
			table, th, td {
   				border: 1px solid black;
    			padding: 5px 5px;
   				text-align: center;
			} 
			.header{
				text-align: center;
			}
			.row{
				width: 100%;
			}
			.col-6{
				width: 50% !important;
			}
			.text-right{
				text-align: right;
			}
			.text-left{
				text-align: left;
			}
			.small{
				margin: 0;
			}
		</style>
	</head>

	<body>
		<h5 class="header small">Coonnie Optical Clinic</h5>
		<h5 class="header small">{{Session::get('rec-bn')}}</h5>
		<h5 class="header small">{{Session::get('rec-ba')}}</h5>
		<h5 class="header small">{{Session::get('rec-bc')}}</h5>
		<br/>
		<h2 class="header small">Receipt # {{Session::get('rec-code')}} </h2>
		<br/>
		<br/>
		<div class="row">
			<p><strong>Recieved from:</strong> {{Session::get('rec-emp')}} <span class="text-right"></span></p>
			<p><strong>Recieved by:</strong> {{Session::get('rec-pat')}} <span class="text-right"></span></p>
			<p><strong>Date: </strong> {{date('Y-m-d')}}</p>
		</div>
		<br/>
		<br/>

		<table>
			<thead>
				<tr>
					    <th width="30%">Name</th>
                        <th width="40%">Desc</th>
                        <th width="10%">Quantity</th>
                        <th width="20%">Sub-total</th>
				</tr>
			</thead>

			<tbody>
				@if(Session::get('rec-med') != NULL)
					<tr>
					<td>MEDICAL FEE</td>
					<td></td>
					<td></td>
					<td>P {{Session::get('rec-med')}}</td>
					</tr>
				@endif
				@if($data != null)
				 @foreach($data as $data)
                      <tr>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemDesc }}</td>
                        <td>{{ $data->intQty }}</td>
                        <td>P {{ $data->dcTotPrice }}</td>
                      </tr>
                @endforeach
                @endif
                @if(Session::get('rec-jo') != NULL)
					<tr>
					<td>{{Session::get('rec-jon')}}</td>
					<td></td>
					<td></td>
					<td>P {{Session::get('rec-jo')}}</td>
					</tr>
				@endif
                <tr>
	                <td colspan="3" class="text-left"><b>Total<b></td>
                	<td><b>P {{Session::get('rec-total')}} </b></td>
                </tr>
                <tr>
	                <td colspan="3" class="text-left"><b>Amount Paid<b></td>
                	<td><b>P {{Session::get('rec-total-bal')}} </b></td>
                </tr>
                <tr>
	                <td colspan="3" class="text-left"><b>Change<b></td>
	                @if(Session::get('rec-total') <= Session::get('rec-total-bal'))
	                <?php $x = Session::get('rec-total-bal') - Session::get('rec-total') ?>
                	<td><b>P {{$x}} </b></td>
                	@else
                	<td><b>P </b></td>
                	@endif
                </tr>
			</tbody>
		</table>
		<div></div>
		<br>
	</body>
</html>
