<?php
	session_start();
	require_once('../models/member_db.php');


	if(!isset($_SESSION['flag'])){
		header('location: ../controllers/loginCheck.php');
	}

//=============================================================================	

	$get_id=$_GET['MEM_ID'];
	$status = DeleteMemberData($get_id);

	header('location: ../views/member_details.php');
					
?>
