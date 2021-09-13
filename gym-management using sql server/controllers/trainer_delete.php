<?php
	session_start();
	
	if(!isset($_SESSION['flag'])){
		header('location: ../controllers/loginCheck.php');
	}

//=============================================================================	

    require_once('../models/trainer_db.php');

	$get_id=$_GET['T_ID'];
	$status = DeleteTrainerData($get_id);

	header('location: ../views/trainer_details.php');
					
?>
