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
							<div id="job_type_div"></div>
						</div>
						<div class="col-md-4"><input type="date" class="form-control" id="inputDate" value="<?= date('Y-m-d');?>"></div>
			      	</div>
		        </div>
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
		    </div>
    	</div>
    </div>
</div>

<div class="container-fluid">
	<div class="row">
	    <div class="col-lg-12">
	      <div class="card shadow mb-4">	        
	        <div class="card-body">
				<form id="received_address">
					<table style="width:100%">
						<thead>
							<tr>
								<th>Name</th>
								<th>Address</th>
								<th>GSTIN</th>
							</tr>
						</thead>
						<tbody>							
							<tr id="client_details"></tr>
						</tbody>		        			
					</table>		        		
				</form>
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
					<td><input type="text" id="challan_no" class="form-control mb-2" placeholder="Challan Number" ></td>
					<td><input type="text" id="veichel_no" class="form-control mb-2" placeholder="Veichel Number" ></td>					
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
					<tbody id="item_produced">
						
					</tbody>
				</table>		
				</form>
	        </div>
	      </div><!-- basic card -->
	    </div><!-- col-12 -->
	</div><!-- row -->
</div><!-- /.container-fluid -->	

<div class="container-fluid">
	<div class="row">
	    <div class="col-lg-12">
			<button id="gen_challan" class="btn btn-block btn-info">Record Data</button>
			<button id="chln_jen" onclick="print_content()" class="btn btn-block btn-info">Generate Challan</button>
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
		date:"",
		client_details : {
			name : "",
			address : "",
			gstin : ""
		},
		item_details :[],
		challan_no:"",		
		veichel_no:"",
		received_challan_date:"",
		received_challan_no:""
	}

	var details_final = 
	{
		order_id : 0,
		date:"",
		client_details : {
			client_id : "",
			address_id : ""
		},
		item_details :[],
		challan_no:"",		
		veichel_no:"",
		received_challan_no:"",
		prev_qty : 0,
		received_total_qty : 0
	}

	$(document).ready(function(){		

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

						details_final.order_id = response.order_id;
						details_final.prev_qty = response.remain_weight;

						// print work type start
						var newHTML = [];

						(response.work_type_id==1)?
						newHTML.push('<input class="form-control" readonly type="text" id="job_type" value="Job Work">')
						:
						newHTML.push('<input class="form-control" readonly type="text" id="job_type" value="Sell Product">')
						
						newHTML.push('<input type="hidden" id="job_type_id" value="'+ response.work_type_id +'">');

						$("#job_type_div").html(newHTML.join(""));
						// print work type end

						
						// print client details end
						$("#client_details").html(
							'<td style="width:33%">'+
								'<div class="mar-rig"><input type="hidden" id="client_id" value="'+response[0].client.id+'"><input type="text" readonly id="c_name" class="form-control" placeholder="Client Name" value="'+response[0].client.name+'"></div>'+
							'</td>'+
							'<td><div class="mar-rig" id="userAddress"><span id="src_add" onclick="src_add('+response[0].client.id+')" class="btn btn-info btn-block">Search Address</span></div></td>'+
							'<td><input id="client_gstin" class="form-control" type="text" value="'+response[0].client.GSTIN+'" readonly></td>'
						);
						// print client details end

						var cli_html = [];
						for(var i = 0; i < response.prod.length; i++){
							cli_html.push('<tr id="row'+(i+1)+'" class="'+i+'">'+
								'<td>'+
									'<div class="form-group row">'+
										'<div class="col-sm-8">'+
											'<input type="hidden" readonly id="item_id'+(i+1)+'" class="form-control mb-2" value="'+response.prod[i].id+'">'+
											'<input type="text" readonly id="item_name'+(i+1)+'" class="form-control mb-2" placeholder="Item Name" value="'+response.prod[i].item+'">'+
										'</div>'+
										'<div class="col-sm-4">'+
											'<input type="text" readonly id="item_HSN_SAC'+(i+1)+'" class="form-control mb-2" placeholder="HSN/SACCODE" value="'+response.prod[i].hsn+'">'+
										'</div>'+
									'</div>'+
									'<div class="form-group row">'+
										'<div class="col-sm-4">'+
											'<label>Quantity (PIC)</label>'+
											'<input type="number" id="item_qty_pic'+(i+1)+'" class="form-control mb-2" placeholder="Quantity (PIC)" value="0">'+											
										'</div>'+
										'<div class="col-sm-4">'+
											'<label>Quantity (KG)</label>'+
											'<input type="number" id="item_qty_kg'+(i+1)+'" class="form-control mb-2" placeholder="Quantity (KG)"  value="0">'+
										'</div>'+
										'<div class="col-sm-4">'+
											'<label>Quantity (BAG)</label>'+
											'<input type="number" id="item_qty_bag'+(i+1)+'" class="form-control mb-2" placeholder="Quantity (BAG)" value="0">'+
										'</div>'+
									'</div>'+
								'</td>'+
							'</tr>')
						}
						
						$("#item_produced").html(cli_html.join(""));
					}
				});
			}
		});

	});

	$("#gen_challan").click(function(){
		if($("#c_name").val() != "" && $("#veichel_no").val() != "" && $("#challan_no").val() != ""){
			details.client_details.name = $("#c_name").val();
			details.client_details.address = $("#client_add").val();
			details.client_details.gstin = $("#client_gstin").val();

			details.veichel_no = $("#veichel_no").val();
			details.challan_no = $("#challan_no").val();

			details.date = $("#inputDate").val();

			// -------------------------------------------------------------------------
			details_final.client_details.client_id = $("#client_id").val();
			details_final.challan_no = $("#challan_no").val();
			details_final.received_challan_no = $("#respected_challan_no").val();
			details_final.veichel_no = $("#veichel_no").val();
			details_final.date = $("#inputDate").val();

			// -------------------------------------------------------------------------
			
			var tableLength = $("#productTable tbody tr").length;

			var tableRow;
			var arrayNumber;
			var count;

			if(tableLength > 0) {		
				tableRow = $("#productTable tbody tr:last").attr('id');
				count = tableRow.substring(3);

				for(var i = 1; i <= count; i++){
					details.item_details.push({"item_name":$("#item_name"+i).val(), "hsn":$("#item_HSN_SAC"+i).val(), "qty_pic":$("#item_qty_pic"+i).val(), "qty_kg":$("#item_qty_kg"+i).val(), "qty_bag":$("#item_qty_bag"+i).val()});
					details_final.item_details.push({"item_id":$("#item_id"+i).val(), "qty_pic":$("#item_qty_pic"+i).val(), "qty_kg":$("#item_qty_kg"+i).val(), "qty_bag":$("#item_qty_bag"+i).val()});
					details_final.received_total_qty = parseInt(details_final.received_total_qty) + parseInt($("#item_qty_kg"+i).val());
				}
			}

			if(details_final.received_total_qty < details_final.prev_qty){

				swal({
					icon: 'warning',
					text : "Do you want to Record This Info?",
					buttons: true
				})
				.then((value) => {
					if (value) {
						var dataString = JSON.stringify(details_final);
						$.ajax({
							type: 'POST',    
							url:'process/data.php',
							data:{myData2: dataString},
							success: function(msg){
								if(msg == "Delivery Order Received Successfully"){
									swal({
										text: msg,
										icon: "success",
									});
									$("chln_jen").show();
								}else{
									swal({
										text: msg,
										icon: "error",
									});
								}						
							}
						});
					}else{}
				});	
			}else{
				swal("Remaining Weight is Less", "warning");
			}
		}else{
			swal("Please Fill All Data", "warning");
		}
	});

	function print_content(){
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
	}

	function printDiv(){
		// var divToPrint=document.getElementById('DivIdToPrint');
		var divToPrint=document.getElementById('content2');
		var newWin=window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
		newWin.document.close();
		setTimeout(function(){newWin.close();},10);
	}

	function src_add(client_id){
		$.ajax({
			url: 'process/data.php',
			type: 'post',
			data: {userid:client_id, type:2},
			dataType: 'json',
			success: function(response){
				var len = response.length;
				$("#src_add").hide();
				if(len > 0){
					if(len == 1){
						$("#userAddress").html('<input id="client_add" class="form-control" type="text" value="' + response[0]['client_address'] + ', ' + response[0]['client_pin'] + '" readonly>');
						details_final.client_details.address_id = response[0]['id'];
					}else{
						var newHTML = [];
						newHTML.push('<select id="client_add" onchange="str_cli_add_id(this)" class="form-control"><option>Choose address</option>');
						for (var i = 0; i < len; i++) {
							newHTML.push('<option id="'+response[i]['id']+'" value="'+response[i]['client_address']+', '+ response[i]['client_pin']+'">'+response[i]['client_address']+', '+ response[i]['client_pin'] + '</option>');
						}
						newHTML.push('</select>');
						$("#userAddress").html(newHTML.join(""));
					}
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert(textStatus);
			}
		});
	}

	function str_cli_add_id(s){
		var cli_id = s[s.selectedIndex].id;
		details_final.client_details.address_id = cli_id;
	}
</script>

<style>
	/* Chrome, Safari, Edge, Opera */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	-webkit-appearance: none;
	margin: 0;
	}

	/* Firefox */
	input[type=number] {
	-moz-appearance: textfield;
	}
</style>