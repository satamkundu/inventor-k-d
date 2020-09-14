<!-- Add Client Model -->
<div class="modal fade" id="addClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="submitClientForm" action="php_action/createclient.php" method="POST">
			<div class="form-row">
				<div class="form-group col-md-12">
					<b><label for="inputName">Company Name</label></b>
					<input type="text" name="inputName" class="form-control" id="inputName" placeholder="abc...">
				</div>

				<div class="form-group col-md-12">
					<b><label for="inputDesc">Client Description</label></b>
					<input type="text" name="inputDesc" class="form-control" id="inputDesc" placeholder="Some Short Description">
				</div>

				<div class="form-group col-md-12">
					<b><label for="inputType">Client Type</label><?=str_repeat('&nbsp;',10);?></b>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="inputType" id="inlineRadio1" value="1">
					  <label class="form-check-label" for="inlineRadio1">Customer</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="inputType" id="inlineRadio2" value="2">
					  <label class="form-check-label" for="inlineRadio2">Supplyer</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="inputType" id="inlineRadio3" value="3">
					  <label class="form-check-label" for="inlineRadio3">Both</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="inputType" id="inlineRadio4" value="3">
					  <label class="form-check-label" for="inlineRadio4">Miscellaneous</label>
					</div>
				</div>
			
				<div class="form-group col-md-6">
				  <b><label for="inputEmail4">Email</label></b>
				  <input type="email" name="inputEmail" class="form-control" id="inputEmail" placeholder="Email">
				</div>
			
				<div class="form-group col-md-6">
				  <b><label for="inputContact">Contact Number</label></b>
				  <input type="number" name="inputContact" class="form-control" id="inputContact" placeholder="0123456789">
				</div>
			
				<div class="form-group col-md-12">
					<b><label for="inputAddress">Address</label></b>
					<input type="text" name="inputAddress" class="form-control" id="inputAddress" placeholder="1234 Main St">
				</div>			
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
				  <b><label for="inputDist">Dist.</label></b>
				  <input type="text" class="form-control" name="inputDist" id="inputDist">
				</div>
				<div class="form-group col-md-4">
				  <b><label for="inputState">State</label></b>
				  <input type="text" class="form-control" name="inputstate" id="inputstate">
				</div>
				<div class="form-group col-md-4">
				  <b><label for="inputZip">Zip</label></b>
				  <input type="number" class="form-control" name="inputZip" id="inputZip">
				</div>
			</div>	
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="addClientBtn" class="btn btn-primary" data-loading-text="Loading..." autocomplete="off">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>