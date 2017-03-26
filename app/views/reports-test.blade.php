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
		<title>COC Management System Sales Report</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<style type="text/css">
			table {
    			border-collapse: collapse;
    			margin-left:auto; margin-right:auto;
			}
			table, th, td {
   				border: 1px solid black;
   				text-align: center;
			} 
		</style>
	</head>

	<body>
		<h1>Sales Report</h1>

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
