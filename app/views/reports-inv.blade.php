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
		<h3>INVENTORY REPORT</h3>
		<p><strong>Date & Time: </strong> {{date('Y-m-d ')}}</p>

		<table>
			<thead>
			<tr>
				 		<th>Batch Code</th>
				 		<th>Lot Number</th>
                        <th>Product Name</th>
                        <th>Product Model</th>
                        <th>Product Type</th>
                        <th>Price</th>
                        <th>Available Stock</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        </tr>
			</thead>

			<tbody>
				 @foreach($data as $data)
                      <tr>
                        <td>{{ $data->strInvBatCode }}</td>
                        <td>{{ $data->strInvLotNum }}</td>
                        <td>{{ $data->strItemName }}</td>
                        <td>{{ $data->strItemDesc }}</td>
                        <td>{{ $data->strITDesc }}</td>
                        <td>{{ $data->dcPrice }}</td>
                        <td>{{ $data->intInvQty }}</td>
                        @if($data->dtInvExpiry == NULL)
                        <td>N/A</td>
                        @else
                        <td>{{ $data->dtInvExpiry }}</td>
                        @endif 
                        @if($data->intInvQty > 10)
                        <td class="green-text bold">GOOD</td>
                        @elseif($data->intInvQty <= 10)
                        <td class="yellow-text bold">CRITICAL</td>
                        @elseif($data->intInvQty == 0)
                        <td class="red-text bold">DEPLETED</td>
                        @endif
                    </tr>
                   @endforeach 
			</tbody>
		</table>
		<br>

	</body>
</html>
