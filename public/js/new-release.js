$(function(){

	//var tblAddProduct = $('#table-add-product').DataTable();
	var dataSet;
	var wholesaleprice;
	var prodid;
	var prodname;
	var qty;
	var availqty;
	var indx;
	var row;

	var tblAddProduct = $('#table-add-product').DataTable({
			"data": dataSet,
			"ordering": false,
			"columnDefs":[{
				"targets": 2, 
				"render": function(data, type, full, meta){
					//console.log("data = "+data);

					// if (qty==1){
						return '<input type="number" min="1" value="1" max=qty id="yes">';
					// } else {
					// 	return data;
					// }
				}
			},
			{
				"targets": 3, 
				"render": function(data, type, full, meta){
					//console.log("data = "+data);

					var add = '<div class="center-btn"><a class="waves-effect waves-light btn btn-small center-text product-edit">save</a></div>';
					return add;
				}
			}
			// ,{
			// 	"targets": 4, 
			// 	"render": function(data, type, full, meta){
			// 		console.log("data = "+data);
			// 		return '<input type="number" value="" id="">';
			// 	}
			// }
			]
	});	

	// $('#table-add-product').on('click', 'tr', function()
	// {
	// 	indx = tblAddProduct.row(this).index();
	// 	$(this).toggleClass('selected');
	// 	// console.log(tblAddProduct.rows('.selected').data()[indx]);
	// });

	$(document).on('click', '.product-edit', function()
	{
		var row = tblAddProduct.row($(this).parent().parent().parent());
		row.data()[2] = $($(row.node()).children()[2]).find('input').val();
		// var dataSet1 = 
		// [
		// 	[
		// 		tblAddProduct.row('.selected').data()[0],
		// 		tblAddProduct.row('.selected').data()[1],
		// 		x,
		// 		''
		// 	]
		// ];
		// tblAddProduct.row('.selected').update().draw();
		// tblAddProduct.rows.add(dataSet).draw();
		//console.log(x);
	});

	var tblProducts = $('#table-prod-list').DataTable({
		ajax: {
			url: '/inventory-products',
			dataSrc: '',
		},
		columns: [
			{ data: 'strProdID' },
			{ data: 'strProdName' },
			// { data: 'dblCurRetPrice' },
			// { data: 'dblCurWPrice' },
			{ data: 'intAvailQty' },
			{ data: null, defaultContent: '<div class="center-btn"><a class="waves-effect waves-light btn btn-small center-text product-add">ADD TO ORDER</a></div>'	}
		]
	});

	$('#table-prod-list tbody').on('click', 'tr', function()
	{
		$(this).toggleClass('selected');
		console.log(tblProducts.row('.selected').data());
	});

	$(document).on('click', '.product-add', function()
	{
		//wholesaleprice = tblProducts.row('.selected').data()['dblCurWPrice'];
		prodid = tblProducts.row('.selected').data()['strProdID'];
		prodname = tblProducts.row('.selected').data()['strProdName'];
		qty = tblProducts.row('.selected').data()['intAvailQty'];
		//qty=1;
		// console.log(wahaha);
		// alert('Added!');
		dataSet = 
		[
			[
				tblProducts.row('.selected').data()['strProdID'],
				tblProducts.row('.selected').data()['strProdName'],
				qty,
				''
			]
		];
		
		tblAddProduct.rows.add(dataSet).draw();

		tblProducts.row('.selected').remove().draw();
	});

	$('#submit-release').click(function()
	{
		var itemsOrdered = [];

		for (var i = 0; i < tblAddProduct.rows().data().length; i++) 
		{
			itemsOrdered[i] = tblAddProduct.rows().data()[i];
		};

		console.log('Items Ordered', itemsOrdered);

		$.ajax({
			url: '/add-release',
			type: 'POST',
			data: 
			{
				releaseID: $('#releaseID').val(),
				branchID: $('#branch-select').val(),
				empID : $('#empID').val(),
				itemsRelease: itemsOrdered
			},
			success: function(data)
			{
				window.location = "release";
				alert('products released!');
			},
			error: function(xhr)
			{
				alert($.parseJSON(xhr.responseText)['error']['message']);
			}
		});
		console.log(tblAddProduct.rows().data());
	});
});