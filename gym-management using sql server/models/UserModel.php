<?php

	require_once('db.php');

//=======================Validatin for login===========================================

	function validateUser(){

	//    error_reporting(0);

		$conn=getConnection();
		$sql="select * from register";
		$status=sqlsrv_query($conn,$sql);

	    return $status;	
	}

//============================================================================

	function getUserByType($type){

		$conn = getConnection();
		$sql = "select * from register where type='{$type}'";
		$status=sqlsrv_query($conn,$sql);
		
		$row = sqlsrv_fetch_assoc($status);

		return $row;
	}
//=======================================================================================

	// function AddMemberUpdateData($user,$id){

	// 	$conn = getConnection();
	// 	$sql = "update member set addjob='{$user['addjob']}' where id='{$id}'";
		
	// 	if(mysqli_query($conn, $sql)){
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
	// }

//======================================================================================
	
	function EmailQuery($email){

		$conn = getConnection();
		$sql = "select * from register where email='{$email}'";
		$status=sqlsrv_query($conn,$sql);
		$row = sqlsrv_num_rows($result);

		return $row;
	}

//======================================================================================

	function insertUser($user){

		$conn=getConnection();
		$sql="insert into register(name, email, password, address, gender, qualification, type) VALUES('{$user['name']}','{$user['email']}','{$user['password']}','{$user['address']}', '{$user['gender']}', '{$user['qualification']}', '{$user['type']}')";
		$status=sqlsrv_query($conn,$sql);
		
		if($status){
			return true;
		}else{
			return false;
		}
		return $status;
	}

//======================================================================================
?>