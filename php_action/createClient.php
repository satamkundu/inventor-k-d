<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$inputName = $_POST['inputName'];
	$inputDesc = $_POST['inputDesc'];
	$inputType = $_POST['inputType'];
	$inputEmail = $_POST['inputEmail'];
	$inputContact = $_POST['inputContact'];
	$inputAddress = $_POST['inputAddress'];
	$inputDist = $_POST['inputDist'];
	$inputstate = $_POST['inputstate'];
	$inputZip = $_POST['inputZip'];


	$sql = "INSERT INTO `client` (`name`, `description`, `type`, `email`, `contact_no`, `address`, `dist`, `state`, `pin`) VALUES ('$inputName', '$inputDesc', '$inputType', '$inputEmail', '$inputContact', '$inputAddress', '$inputDist', '$inputstate', '$inputZip')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST