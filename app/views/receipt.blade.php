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
		<h5 class="header small">Barangay Sangandaan, Quezon City</h5>
		<h5 class="header small">#contactNo</h5>
		<br/>
		<h2 class="header small">Receipt</h2>
		<br/>
		<br/>
		<div class="row">
			<p><strong>Recieved from:</strong> #name <span class="text-right"></span></p>
			<p><strong>Recieved to:</strong> #name <span class="text-right"></span></p>
			<p><strong>Date & Time: </strong> {{date('Y-m-d ')}}</p>
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
				 @foreach($data as $data)
                      <tr>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemDesc }}</td>
                        <td>{{ $data->intQty }}</td>
                        <td>P {{ $data->dcTotPrice }}</td>
                      </tr>
                @endforeach
                <tr>
	                <td colspan="3" class="text-left"><b>Total<b></td>
                	<td><b>P {{Session::get('rec-total')}} </b></td>
                </tr>
                <tr>
	                <td colspan="3" class="text-left"><b>Amount Paid<b></td>
                	<td><b>P  </b></td>
                </tr>
                <tr>
	                <td colspan="3" class="text-left"><b>Change<b></td>
                	<td><b>P  </b></td>
                </tr>
			</tbody>
		</table>
		<div></div>
		<br>
	</body>
</html>
