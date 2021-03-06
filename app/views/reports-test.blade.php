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
		<h3>SALES REPORT</h3>
		<p><strong>Date & Time: </strong> {{date('Y-m-d ')}}</p>

		<table>
			<thead>
				<tr>
					@foreach($columns as $header)
						<th>{{$header}}</th>
					@endforeach
				</tr>
			</thead>

			<tbody>
				@foreach($data as $data)
					<tr>
						<td>{{ $data->strSHCode }}</td>
						<td>{{ $data->strPatLast . ', ' . $data->strPatFirst . ' ' . $data->strPatMiddle }}</td>
						<td>{{ $data->dcmSBalance }}</td>
						<td>{{ $data->sum }}</td>
						<td>{{ $data->strPayTDesc }}</td>
						<td>{{ $data->strSaleSDesc }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<br>
		<p><strong>Total Sale: </strong> {{Session::get('sales-total')}} </p>
	</body>
</html>
