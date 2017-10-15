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
			}
			table, th, td {
   				border: 1px solid black;
   				text-align: center;
			} 
		</style>
	</head>

	<body>
		<h1>Purchases</h1>

		<p><strong>Date & Time: </strong> {{date('Y-m-d ')}}</p>

		<table>
			<thead>
				<tr>
					    <th>Name</th>
                        <th>Desc</th>
                        <th>Quantity</th>
                        <th>Sub-total</th>
				</tr>
			</thead>

			<tbody>
				 @foreach($data as $data)
                      <tr>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemDesc }}</td>
                        <td>{{ $data->intQty }}</td>
                        <td>P {{ $data->dcTotPrice }}</td>
                      </tr>
                @endforeach
			</tbody>
		</table>
		<br>
		<p><strong>Total: </strong> {{Session::get('rec-total')}} </p>
	</body>
</html>
