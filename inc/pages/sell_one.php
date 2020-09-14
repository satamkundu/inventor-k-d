<!-- Begin Page Content -->
<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800">Received Item Form</h1>
	<div class="row">
	    <div class="col-lg-12">
	    	<div class="card shadow mb-4">
		        <div class="card-header">
		        	<div class="row">
						<div class="col-md-8"><p class="m-0 font-weight-bold text-primary">RECEIVED FROM</p></div>
						<div class="col-md-4"><input type="date" class="form-control" id="inputDate" value="<?= date('Y-m-d');?>"></div>
			      	</div>
		        </div>
		        <div class="card-body">
		        	<form id="received_address">
		        		<table>
		        			<thead>
		        				<tr>
		        					<th>Name</th>
			        				<th>Address</th>
			        				<th>Dist</th>
			        				<th>Pin</th>
			        				<th>State</th>
		        				<tr>
		        			</thead>
		        			<tbody>
		        				<tr>
		        					<td><div class="mar-rig"><textarea class="form-control" id="inputName" placeholder="Company Name"></textarea></div></td>
		        					<td><div class="mar-rig"><textarea class="form-control" id="inputAddress1" placeholder="Address"></textarea></div></td>
		        					<td><div class="mar-rig"><input type="text" class="form-control" id="inputDist" placeholder="Dist."></div></td>
		        					<td><div class="mar-rig"><input type="number" class="form-control" id="inputPin" placeholder="Pin"></div></td>
		        					<td><div class="mar-rig"><input type="text" class="form-control" id="inputState" placeholder="State"></div></td>
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
	          <h6 class="m-0 font-weight-bold text-primary">RECEIVED ITEM</h6>
	        </div>
	        <div class="card-body">
				<form>
					<table style="width: 100%;" id="productTable">
						<thead>
							<tr>
								<th>Description of Goods Delivered</th>
								<th>Qty<select><option>KGS</option><option>PCS</option></select></th>
								<th>Rate(INR)</th>
								<th>HSN</th>
							</tr>
						</thead>
						<tbody>
							<?php
						  		$arrayNumber = 0;
						  		for($x = 1; $x < 2; $x++) { 
						  	?>
						  	<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
							  	<td>
							  		<div class="form-group mar-rig">
										<input type="text" class="form-control" id="inputDescription" placeholder="Enter Description of Goods Delivered" style="margin-right: 15rem;">
									</div>
								</td>
								<td>
									<div class="form-group mar-rig">
										<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" autocomplete="off" class="form-control" min="1" />
									</div>
								</td>
								<td>
									<div class="form-group mar-rig">
										<input type="number" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" class="form-control" />
									</div>
								</td>
								<td>
									<div class="form-group mar-rig">
					  					<input type="text" name="hsn[]" id="hsn<?php echo $x; ?>" autocomplete="off" class="form-control"/>
					  				</div>			  					
				  				</td>
				  				<td>
				  					<div class="form-group mar-rig">
				  						<button class="btn btn-danger btn-circle removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fas fa-trash"></i></button>
				  					</div>
				  				</td>
							</tr>
						  	<?php
					  			$arrayNumber++;
						  	} // /for
						  	?>
						</tbody>
					</table>				
					<div class="form-group col-md-2">
						<button type="button" class="btn btn-success" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fas fa-plus-circle"></i> Add Row </button>
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
	          <h6 class="m-0 font-weight-bold text-primary">RECEIVED ITEM FOR</h6>
	        </div>
	        <div class="card-body">
				<form>
					<table style="width: 100%;" id="productTableForProduced">
						<thead>
							<tr>
								<th>Description of Goods To Be Produced</th>
								<th>Qty<select><option>KGS</option><option>PCS</option></select></th>
								<th>Rate(INR)/UNIT</th>
								<th>HSN</th>
							</tr>
						</thead>
						<tbody>
							<?php
						  		$arrayNumberNext = 0;
						  		for($y = 1; $y < 2; $y++) { 
						  	?>
						  	<tr id="row<?php echo $y; ?>" class="<?php echo $arrayNumberNext; ?>">
							  	<td>
							  		<div class="form-group mar-rig">
										<input type="text" class="form-control" id="inputDescriptionForProduced" placeholder="Enter Description of Goods To Be Produced" style="margin-right: 15rem;">
									</div>
								</td>
								<td>
									<div class="form-group mar-rig">
										<input type="number" name="quantityForProduced[]" id="quantityForProduced<?php echo $y; ?>" autocomplete="off" class="form-control" min="1" />
									</div>
								</td>
								<td>
									<div class="form-group mar-rig">
										<input type="number" name="rateForProduced[]" id="rateForProduced<?php echo $y; ?>" autocomplete="off" class="form-control" />
									</div>
								</td>
								<td>
									<div class="form-group mar-rig">
					  					<input type="text" name="hsnForProduced[]" id="hsnForProduced<?php echo $y; ?>" autocomplete="off" class="form-control"/>	
					  				</div>			  					
				  				</td>
				  				<td>
				  					<div class="form-group mar-rig">
				  						<button class="btn btn-danger btn-circle removeProductRowBtnForProduced" type="button" id="removeProductRowBtnForProduced" onclick="removeProductRowForProduced(<?php echo $y; ?>)"><i class="fas fa-trash"></i></button>
				  					</div>
				  				</td>
							</tr>
						  	<?php
					  			$arrayNumberNext++;
						  	} // /for
						  	?>
						</tbody>
					</table>				
					<div class="form-group col-md-2">
						<button type="button" class="btn btn-success" onclick="addRowForProduced()" id="addRowBtnForProduced" data-loading-text="Loading..."> <i class="fas fa-plus-circle"></i> Add Row </button>
					</div>				
				</form>
	        </div>
	      </div><!-- basic card -->
	    </div><!-- col-12 -->
	</div><!-- row -->
</div><!-- /.container-fluid -->	

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
</style>	