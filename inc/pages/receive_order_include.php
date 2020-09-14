<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- <h1 class="h3 mb-4 text-gray-800">Received Item Form</h1> -->
	<div class="row">
	    <div class="col-lg-12">
	    	<div class="card shadow mb-4">
		        <div class="card-header">
		        	<div class="row">
						<div class="col-md-3">
                            <input type="text" class="form-control" id="received_challan" placeholder="Enter Channal Number">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="vehical_no" placeholder="Enter Vehical Number">
                        </div>
						<div class="col-md-3">
							<select class="form-control" name="job_type" id="job_type">
								<option value="0">Choose Work Type</option>
								<option value="1">Job Work</option>
								<option value="2">Sell Product</option>                                                                                               
							</select>
						</div>
						<div class="col-md-3"><input type="date" class="form-control" id="inputDate" value="<?= date('Y-m-d');?>"></div>
			      	</div>
		        </div>
		        <div class="card-body">
		        	<form id="received_address">
		        		<table style="width:100%">		        			
		        			<tbody>
		        				<tr>
		        					<td style="width:100%">
										<div class="mar-rig"><input type="text" id="c_name" class="form-control" placeholder="Client Name"></div>
										<ul id="searchResult"></ul>
                                        <input type="hidden" id="client_id">
									</td>									      					
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
	      <!-- Basic Card Example -->
	      <div class="card shadow mb-4">
	        <div class="card-header py-3">
	          <h6 class="m-0 font-weight-bold text-primary">DESCRIPTION OF GOODS DELIVERED</h6>
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
									<div class="col-sm-6">
										<input type="text" id="item_name<?php echo $x; ?>" class="form-control mb-2" placeholder="Item Name" >
									</div>
									<div class="col-sm-3">
										<input type="text" id="item_HSN_SAC<?php echo $x; ?>" class="form-control mb-2" placeholder="HSN/SACCODE" >
									</div>
                                    <div class="col-sm-3">
										<input type="number" id="item_qty<?php echo $x; ?>" class="form-control mb-2" placeholder="Quantity (KG)" >
									</div>
								</div>								
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
	      <!-- Basic Card Example -->
	      <div class="card shadow mb-4">
	        <div class="card-header py-3">
	          <h6 class="m-0 font-weight-bold text-primary">DESCRIPTION OF GOODS TO BE PRODUCED</h6>
	        </div>
	        <div class="card-body">
				<form>
				<table class="table" style="width: 100%;" id="productTable_one">
					<tbody>
						<?php
							$arrayNumber = 0;
							for($x = 1; $x < 2; $x++) { 
						?>                            
						<tr id="row_one<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
							<td>
								<div class="form-group row">                                        
									<div class="col-sm-6">
										<input type="text" id="item_name_one<?php echo $x; ?>" class="form-control mb-2" placeholder="Item Name" >
									</div>
									<div class="col-sm-2">
										<input type="text" id="item_HSN_SAC_one<?php echo $x; ?>" class="form-control mb-2" placeholder="HSN/SACCODE" >
									</div>
                                    <div class="col-sm-2 pr-0">
										<input type="number" id="item_qty_one<?php echo $x; ?>" class="form-control mb-2" placeholder="Quantity" >
									</div>
                                    <div class="col-sm-2 pl-0">
										<select class="form-control mb-1" id="unit_one<?php echo $x; ?>">
                                            <option value="0">Select Unit</option>
                                            <option value="kg">KG</option>
                                            <option value="pic">PIC</option>
                                            <option value="bag">BAG</option>
                                        </select>
									</div>
								</div>								
							</td>
							<?php } ?>
						</tr>
					</tbody>
				</table>
					<div class="form-group col-md-2">
						<button type="button" class="btn btn-success" onclick="addRow_one()" id="addRowBtn_one" data-loading-text="Loading..."> <i class="fas fa-plus-circle"></i> Add Item </button>
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
			<button id="rec_order" class="btn btn-block btn-success">Receive Order</button>
		</div>
	</div>
</div>

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

    let details = {
        challan_no : "",
        vehical_no : "",
        work_type : "",
        date : "",
        user_id : "",
        delivered_item : [],
        received_total_qty : 0,
        received_item : [],
    };


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

                            $("#searchResult").append("<li class='mar-rig' value='"+id+"'>"+name+"</li>");

                        }
                        // binding click event to li
                        $("#searchResult li").bind("click",function(){
                            setText(this);
                        });

                    }
                });
            }
		});

        $("#rec_order").click(function(){         

            let error = 0;

            if($("#received_challan").val() == ""){
                swal("Oppsss...", "Please Fill The Challan Number", "error");
                error = 1;
            }

            if($("#vehical_no").val() == ""){
                swal("Oppsss...", "Please Fill The Vehical Number", "error");
                error = 1;
            }

            if($("#job_type").val() == "0"){
                swal("Oppsss...", "Please Choose Job Type", "error");
                error = 1;
            }

            if($("#c_name").val() == ""){
                swal("Oppsss...", "Please Fill Client Name", "error");
                error = 1;
            }

            if(error == 0){
                details.challan_no = $("#received_challan").val();
                details.vehical_no = $("#vehical_no").val();
                details.work_type = $("#job_type").val();
                details.date = $("#inputDate").val();

                details.user_id = $("#client_id").val();

                details.delivered_item = [];
                details.received_item = [];

                var tableLength = $("#productTable tbody tr").length;

                var tableRow;
                var arrayNumber;
                var count;

                if(tableLength > 0) {		
                    tableRow = $("#productTable tbody tr:last").attr('id');
                    count = tableRow.substring(3);

                    for(var i = 1; i <= count; i++){
                        details.delivered_item.push({"item":$("#item_name"+i).val(), "hsn":$("#item_HSN_SAC"+i).val(), "qty":$("#item_qty"+i).val()});
                        details.received_total_qty = parseInt(details.received_total_qty) + parseInt($("#item_qty"+i).val());
                    }

                }

                var tableLength = $("#productTable_one tbody tr").length;

                var tableRow;
                var arrayNumber;
                var count;

                if(tableLength > 0) {		
                    tableRow = $("#productTable_one tbody tr:last").attr('id');
                    count = tableRow.substring(7);

                    for(var i = 1; i <= count; i++){
                        details.received_item.push({"item":$("#item_name_one"+i).val(), "hsn":$("#item_HSN_SAC_one"+i).val(), "qty":$("#item_qty_one"+i).val(), "unit":$("#unit_one"+i).val()});
                    }
                }

                // console.log(details);

                swal({
                    icon: 'warning',
                    text : "Do you want to proceed for Received Order?",
                    buttons: true
                })
                .then((value) => {
                    if (value) {
                        var dataString = JSON.stringify(details);
                        $.ajax({
                            type: 'POST',    
                            url:'process/data.php',
                            data:{myData: dataString},
                            success: function(msg){
                                swal({
                                    text: msg,
                                    icon: "success",
                                });
                            }
                        });
                    }else{}                       
                });               

            }

        });
	});

	// Set Text to search client name and get details
	function setText(element){
		var value = $(element).text();
		var userid = $(element).val();
		$("#c_name").val(value);
        $("#client_id").val(userid);
		$("#searchResult").empty();		
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
                '<div class="col-sm-6">'+
                    '<input type="text" id="item_name'+count+'" class="form-control mb-2" placeholder="Item Name" >'+
                '</div>'+
                '<div class="col-sm-3">'+
                    '<input type="text" id="item_HSN_SAC'+count+'" class="form-control mb-2" placeholder="HSN/SACCODE" >'+
                '</div>'+
                '<div class="col-sm-3">'+
                    '<input type="number" id="item_qty'+count+'" class="form-control mb-2" placeholder="Quantity (KG)" >'+
                '</div>'+
            '</div>'+ 
		'</td>';

		if(tableLength > 0) {
			$("#productTable tbody").append(tr);
		}
	}

    function addRow_one() {

		var tableLength = $("#productTable_one tbody tr").length;

		var tableRow;
		var arrayNumber;
		var count;

		if(tableLength > 0) {		
			tableRow = $("#productTable_one tbody tr:last").attr('id');
			tableRow = $("#productTable_one tbody tr:last").attr('id');
			arrayNumber = $("#productTable_one tbody tr:last").attr('class');
			count = tableRow.substring(7);	
			count = Number(count) + 1;
			arrayNumber = Number(arrayNumber) + 1;					
		} else {
			count = 1;
			arrayNumber = 0;
		}

		var tr = '<tr id="row_one'+count+'" class="'+arrayNumber+'">'+
		'<td>'+
			'<div class="form-group row">'+
                '<div class="col-sm-6">'+
                    '<input type="text" id="item_name_one'+count+'" class="form-control mb-2" placeholder="Item Name" >'+
                '</div>'+
                '<div class="col-sm-2">'+
                    '<input type="text" id="item_HSN_SAC_one'+count+'" class="form-control mb-2" placeholder="HSN/SACCODE" >'+
                '</div>'+
                '<div class="col-sm-2 pr-0">'+
                    '<input type="number" id="item_qty_one'+count+'" class="form-control mb-2" placeholder="Quantity" >'+
                '</div>'+
                '<div class="col-sm-2 pl-0">'+
                    '<select class="form-control mb-1" id="unit_one'+count+'">'+
                        '<option value="0">Select Unit</option>'+
                        '<option value="kg">KG</option>'+
                        '<option value="pic">PIC</option>'+
                        '<option value="bag">BAG</option>'+
                    '</select>'+
                '</div>'+
            '</div>'+ 
		'</td>';

		if(tableLength > 0) {
			$("#productTable_one tbody").append(tr);
		}
	}
</script>