<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- <h1 class="h3 mb-4 text-gray-800">Received Item Form</h1> -->
	<div class="row">
	    <div class="col-lg-12">
	    	<div class="card shadow mb-4">
		        <div class="card-header">
		        	<div class="row">
						<div class="col-md-4"><p class="m-0 font-weight-bold text-primary">CLIENT</p></div>
						<div class="col-md-4">
							<select class="form-control" name="job_type" id="job_type">
								<option value="0">Choose Work Type</option>
								<option value="1">Job Work</option>
								<option value="2">Sell Product</option>                                                                                               
							</select>
						</div>
						<div class="col-md-4"><input type="date" class="form-control" id="inputDate" value="<?= date('Y-m-d');?>"></div>
			      	</div>
		        </div>
		        <div class="card-body">
		        	<form id="received_address">
		        		<table style="width:100%">
		        			<thead>
		        				<tr>
		        					<th>Name</th>
			        				<th>Address</th>
			        				<th>GSTIN</th>
		        				<tr>
		        			</thead>
		        			<tbody>
		        				<tr>
		        					<td style="width:33%">
										<div class="mar-rig"><input type="text" id="c_name" class="form-control" placeholder="Client Name"></div>
										<ul id="searchResult"></ul>
									</td>
									<td><div class="mar-rig" id="userAddress"></div></td>
									<td><div class="mar-rig" id="userGSTIN"></div></td>		        					
		        				</tr>		        				
		        			</tbody>		        			
		        		</table>		        		
		        	</form>
		        </div>
		    </div>
    	</div>
    </div>
</div>

<div class="container-fluid">
	<div class="row">
	    <div class="col-lg-12">
	      <div class="card shadow mb-4">	        
	        <div class="card-body">
			<table style="width:100%">
				<tr>
					<td style="width:33%">Challan Number</td>
					<td>Total Weight Received</td>
					<td>Remaining Weight</td>
				<tr>
					<td style="width:33%">
						<select class="form-control" id="respected_challan_no">
							<option value="0">Choose Respected Challan Number</option>
							<?php
								require __DIR__ . '/../../process/config.php';
								$res = mysqli_query($con, "SELECT challan_no FROM received_item_main WHERE remain_weight > '0'");
								if(mysqli_num_rows($res)>0){
									while($row = mysqli_fetch_assoc($res)){
										echo "<option value='".$row['challan_no']."'>".$row['challan_no']."</option>";
									}
								}
								mysqli_close($con);	
							?>
						</select>
					</td>
					<td><input type="text" id="respected_challan_total" placeholder="Total Weight" class="form-control" readonly></td>
					<td><input type="text" id="respected_challan_remind" placeholder="Remain Weight" class="form-control" readonly></td>
				</tr>
			</table>
	        </div>
	      </div><!-- basic card -->
	    </div><!-- col-12 -->
	</div><!-- row -->
</div><!-- /.container-fluid -->

<div class="container-fluid">
	<div class="row">
	    <div class="col-lg-12">
	      <div class="card shadow mb-4">	        
	        <div class="card-body">
			<table style="width:100%">
				<tr>
					<td><input type="text" id="veichel_no" class="form-control mb-2" placeholder="Veichel Number" ></td>
					<td><input type="text" id="challan_no" class="form-control mb-2" placeholder="Challan Number" ></td>
				</tr>
			</table>
	        </div>
	      </div><!-- basic card -->
	    </div><!-- col-12 -->
	</div><!-- row -->
</div><!-- /.container-fluid -->

<div class="container-fluid">
	<div class="row">
	    <div class="col-lg-12">
	      <!-- Basic Card Example -->
	      <div class="card shadow mb-4">
	        <div class="card-header py-3">
	          <h6 class="m-0 font-weight-bold text-primary">ITEM</h6>
	        </div>
	        <div class="card-body">
				<form>
				<table class="table" style="width: 100%;" id="productTable">
					<tbody>
						<?php
							$arrayNumber = 0;
							for($x = 1; $x < 2; $x++) { 
						?>                            
						<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
							<td>
								<div class="form-group row">                                        
									<div class="col-sm-8">
										<input type="text" id="item_name<?php echo $x; ?>" class="form-control mb-2" placeholder="Item Name" >
									</div>
									<div class="col-sm-4">
										<input type="text" id="item_HSN_SAC<?php echo $x; ?>" class="form-control mb-2" placeholder="HSN/SACCODE" >
									</div>
								</div>
								<!-- <input type="text" id="item_rate<?php echo $x; ?>" class="form-control mb-2" placeholder="Item Rate" > -->
								<div class="form-group row">                                        
									<div class="col-sm-4">
										<input type="number" id="item_qty_pic<?php echo $x; ?>" class="form-control mb-2" placeholder="Quantity (PIC)" >
									</div>
									<div class="col-sm-4">
										<input type="number" id="item_qty_kg<?php echo $x; ?>" class="form-control mb-2" placeholder="Quantity (KG)" >
									</div>
									<div class="col-sm-4">
										<input type="number" id="item_qty_bag<?php echo $x; ?>" class="form-control mb-2" placeholder="Quantity (BAG)" >
									</div>                                                        
								</div>                                    
								<!-- <select class="form-control mb-2" name="material_tyle" id="material_tyle<?php echo $x; ?>">
									<option value="1">Job Work</option>
									<option value="2">Sell Product</option>                                                                                               
								</select> -->
							</td>
							<?php } ?>
						</tr>
					</tbody>
				</table>
					<div class="form-group col-md-2">
						<button type="button" class="btn btn-success" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fas fa-plus-circle"></i> Add Item </button>
					</div>				
				</form>
	        </div>
	      </div><!-- basic card -->
	    </div><!-- col-12 -->
	</div><!-- row -->
</div><!-- /.container-fluid -->	

<div class="container-fluid">
	<div class="row">
	    <div class="col-lg-12">
			<button id="gen_challan" class="btn btn-block btn-info">Generate Challan</button>
		</div>
	</div>
</div>

<div style="display:none" id="res"></div>

<style type="text/css">
	.pad-lef{
		margin-left: 2rem;
	}
	.mar-rig{
		margin-right: 1rem;
	}
	.wid-50{
		width: 50%;
	}

	#searchResult{
        list-style: none;
        padding: 0px;
        width: 100%;
        margin: 0;
    }

    #searchResult li{
        background: lavender;
        padding: 4px;
        margin-bottom: 1px;
    }

    #searchResult li:nth-child(even){
        background: cadetblue;
        color: white;
    }

    #searchResult li:hover{
        cursor: pointer;
    }
</style>	

<?php include 'inc/require_page_content/bottom.php'; ?>
<script>
	var details = 
	{
		delivery_option : "",
		date:"",
		client_details : {
			name : "",
			address : "",
			gstin : ""
		},
		item_details :[],
		challan_no:"",
		amount:"",
		veichel_no:"",
		received_challan_date:"",
		received_challan_no:""
	}

	$(document).ready(function(){
		$("#c_name").keyup(function(){
            var search = $(this).val();
            if(search != ""){
                $.ajax({
                    url: 'process/data.php',
                    type: 'post',
                    data: {search:search, type:1},
                    dataType: 'json',
                    success:function(response){
                    
                        var len = response.length;
                        $("#searchResult").empty();
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var name = response[i]['name'];

                            $("#searchResult").append("<li value='"+id+"'>"+name+"</li>");

                        }
                        // binding click event to li
                        $("#searchResult li").bind("click",function(){
                            setText(this);
                        });

                    }
                });
            }
		});

		$("#respected_challan_no").change(function(){
			if($(this).val() == 0){
				$("#respected_challan_total").val("");
				$("#respected_challan_remind").val("");
			}else{
				var ch_no = $(this).val().toString();
				$.ajax({
					url:'process/data.php',
					type:'post',
					data:{rec_challan_no:$(this).val(),purpose:"fetch_received_challan_data"},
					success:function(response){
						response = $.parseJSON(response);
						$("#respected_challan_total").val(response.total_weight);
						$("#respected_challan_remind").val(response.remain_weight);
						details.received_challan_date = response.timestamp;
						details.received_challan_no = ch_no;
					}
				});
			}
		});

	});

	// Set Text to search client name and get details
	function setText(element){
		var value = $(element).text();
		var userid = $(element).val();
		$("#c_name").val(value);
		$("#searchResult").empty();
		// Request User Details
		$.ajax({
			url: 'process/data.php',
			type: 'post',
			data: {userid:userid, type:2},
			dataType: 'json',
			success: function(response){
				// console.log(response);
				var len = response.length;
				// $("#userDetail").empty();
				if(len > 0){
					if(len == 1){
						$("#userAddress").html('<input id="client_add" class="form-control" type="text" value="' + response[0]['client_address'] + ', ' + response[0]['client_pin'] + '" readonly>');
						$("#userGSTIN").html('<input id="client_gstin" class="form-control" type="text" value="'+response[0]['client_gstin']+'" readonly>');
					}else{
						var newHTML = [];
						newHTML.push('<select id="client_add" class="form-control"><option>Choose address</option>');
						for (var i = 0; i < len; i++) {
							newHTML.push('<option value="'+response[i]['client_address']+', '+ response[i]['client_pin']+'">'+response[i]['client_address']+', '+ response[i]['client_pin'] + '</option>');
						}
						newHTML.push('</select>');
						$("#userAddress").html(newHTML.join(""));
						$("#userGSTIN").html('<input id="client_gstin" class="form-control" type="text" value="'+response[0]['client_gstin']+'" readonly>');
					}
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert(textStatus);
			}
		});
	}

	function addRow() {
		$("#addRowBtn").button("loading");

		var tableLength = $("#productTable tbody tr").length;

		var tableRow;
		var arrayNumber;
		var count;

		if(tableLength > 0) {		
			tableRow = $("#productTable tbody tr:last").attr('id');
			arrayNumber = $("#productTable tbody tr:last").attr('class');
			count = tableRow.substring(3);	
			count = Number(count) + 1;
			arrayNumber = Number(arrayNumber) + 1;					
		} else {
			count = 1;
			arrayNumber = 0;
		}

		var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
		'<td>'+
			'<div class="form-group row">'+                                      
				'<div class="col-sm-8">'+
					'<input type="text" id="item_name'+count+'" class="form-control mb-2" placeholder="Item Name" >'+
				'</div>'+
				'<div class="col-sm-4">'+
					'<input type="text" id="item_HSN_SAC'+count+'" class="form-control mb-2" placeholder="HSN/SACCODE" >'+
				'</div>'+
			'</div>'+			
			'<div class="form-group row">'+                                      
				'<div class="col-sm-4">'+
					'<input type="number" id="item_qty_pic'+count+'" class="form-control mb-2" placeholder="Quantity (PIC)" >'+
				'</div>'+
				'<div class="col-sm-4">'+
					'<input type="number" id="item_qty_kg'+count+'" class="form-control mb-2" placeholder="Quantity (KG)" >'+
				'</div>'+
				'<div class="col-sm-4">'+
					'<input type="number" id="item_qty_bag'+count+'" class="form-control mb-2" placeholder="Quantity (BAG)" >'+
				'</div>'+
			'</div>'+ 
		'</td>';

		if(tableLength > 0) {
			$("#productTable tbody").append(tr);
		}
	}

	$("#gen_challan").click(function(){
		details.client_details.name = $("#c_name").val();
        details.client_details.address = $("#client_add").val();
		details.client_details.gstin = $("#client_gstin").val();

		details.veichel_no = $("#veichel_no").val();
		details.challan_no = $("#challan_no").val();

		details.date = $("#inputDate").val();

		details.delivery_option =$("#job_tyle").val();
		
		var tableLength = $("#productTable tbody tr").length;

        var tableRow;
        var arrayNumber;
        var count;

        if(tableLength > 0) {		
            tableRow = $("#productTable tbody tr:last").attr('id');
            count = tableRow.substring(3);

            for(var i = 1; i <= count; i++){
                details.item_details.push({"item_name":$("#item_name"+i).val(), "hsn":$("#item_HSN_SAC"+i).val(), "qty_pic":$("#item_qty_pic"+i).val(), "qty_kg":$("#item_qty_kg"+i).val(), "qty_bag":$("#item_qty_bag"+i).val()});
            }
		}

		console.log(details);

		var hand_written = [];
        hand_written.push('<div id="content2" style="width: 11in;">'+
        '<style>@media print{@page{size: 8.5in 11in;margin-top: 0;}}</style>'+
        '<div style="text-align: center;">'+
            '<div style="width: 33%;display: inline-block;">ORIGINAL</div> '+
            '<div style="width: 33%;display: inline-block;">DUPLICATE</div>'+
            '<div style="width: 33%;display: inline-block;">TRIPLICATE</div>'+
        '</div>'+
        '<hr/>'+
        '<div style="text-align: center;line-height: 0.8rem;">'+
            '<h4>DELIVERY CHALLAN</h4>'+
            '<h1>A.K.SHIT & COMPANY</h1>'+
            '<h4>VILL. + POST. - BARGACHIA, DIST. - HOWRAH-711404, W.B.(19)</h4>'+
            '<h4>GSTIN - 19ALBPS5301A1ZK</h4>'+
        '</div>'+
        '<div style="border-top: 1px dotted;border-bottom: 1px dotted;font-weight: bold;">'+
            '<div style="width: 49%;display: inline-block;">CHALLAN NO. ' + details.challan_no + '</div>'+
            '<div style="width: 49%;display: inline-block;text-align: right;">DATE . ' + details.date + '</div>'+
        '</div>'+
        '<div style="line-height: 0.2rem;">'+
            '<h3>TO : ' + details.client_details.name.toUpperCase() + '</h3>'+
            '<h3>ADDRESS : ' + details.client_details.address + '</h3>'+
            '<h4>GSTIN : ' + details.client_details.gstin + '</h4>'+
        '</div>'+
        '<div>'+
            '<table style="width: 100%;border-collapse: collapse;border:0.1rem dotted;height: 5rem;" border="1">'+
                '<tr style="height: 2rem;">'+
                    '<th>S/N</th>'+
                    '<th>HSN/SAC</th>'+
                    '<th>DESCRIPTION</th>'+
                    '<th>QUATNTITY (PCS)</th>'+
                    '<th>WEIGHT (KG)</th>'+
                    '<th>BAG</th>'+
                '</tr>');

                var cnt = 1;
                for(var i = 0; i < details.item_details.length; i++){
                    hand_written.push('<tr style="height: 2rem;">'+
                            '<td style="border: 0.1rem dotted;text-align: center;">'+cnt+'</td>'+
                            '<td style="border: 0.1rem dotted;text-align: center;">'+details.item_details[i].hsn+'</td>'+
                            '<td style="border: 0.1rem dotted">'+details.item_details[i].item_name+'</td>'+
                            '<td style="border: 0.1rem dotted;text-align: center;">'+details.item_details[i].qty_pic+'</td>'+
                            '<td style="border: 0.1rem dotted;text-align: center;">'+details.item_details[i].qty_kg+'</td>'+
                            '<td style="border: 0.1rem dotted;text-align: center;">'+details.item_details[i].qty_bag+'</td>'+                            
                        '</tr>');
                    cnt++;
                }

                for(var i = 0; i < 4; i++){
                    hand_written.push('<tr style="height: 2rem;">'+
                    '<td style="border: 0.1rem dotted;text-align: center;"></td>'+
                    '<td style="border: 0.1rem dotted;text-align: center;"></td>'+
                    '<td style="border: 0.1rem dotted"></td>'+
                    '<td style="border: 0.1rem dotted;text-align: center;"></td>'+
                    '<td style="border: 0.1rem dotted;text-align: center;"></td>'+
                    '<td style="border: 0.1rem dotted;text-align: center;"></td>'+
                '</tr>');
                    cnt++;
                }

                hand_written.push('<tr style="height: 2rem;">'+
                    '<td style="text-align: center;font-weight: bold;" colspan="3">A.N.X : '+ details.received_challan_no +'</td>'+
                    '<td style="text-align: center;font-weight: bold;" colspan="3">DATE : '+ details.received_challan_date +'</td>'+
                '</tr>'+
            '</table>'+
        '</div>'+
        '<div style="border-bottom: 1px dotted;font-weight: bold;">'+
            '<div style="font-weight: bold;">BY VEHICLE NO. : ' + details.veichel_no + '</div>'+
        '</div>'+
        '<div style="text-align: right;padding-right: 5.3rem;">FOR A. K. SHIT & COMPANY</div>'+
        '<div style="margin-top: 7rem;text-align: center;">'+
            '<div style="width: 49%;display: inline-block;">RECEIVER\'S SIGNATORY</div>'+
            '<div style="width: 49%;display: inline-block;">AUTHORIZED SIGNATORY</div>'+
        '</div>'+
    '</div>');

    $("#res").html(hand_written.join(""));
    printDiv();

	});

	function printDiv(){
		// var divToPrint=document.getElementById('DivIdToPrint');
		var divToPrint=document.getElementById('content2');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
		newWin.document.close();
		setTimeout(function(){newWin.close();},10);
	}



</script>