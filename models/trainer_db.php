<?php

	require_once('db.php');

//========================Start Add Job   ===========================================

	function getTrainerById($t_id){

		$conn = getConnection();
		//$sql = "select * from member where mem_id=$id";
        $sql="select t.t_id,t.t_name,t.t_gender,t.t_address,t.t_email,t.t_salary,b.b_name,b.location from trainer t,branch b where t.b_id=b.b_id and t_id='$t_id'";
		$status=oci_parse($conn,$sql);
    	oci_execute($status);

    	//$h=oci_fetch_array($status);

		return $status;
	}

//=======================================================================================

	function TrainerUpdateData($user,$t_id){

		$conn = getConnection();
		$sql = "update trainer set t_name='{$user['t_name']}', t_address='{$user['t_address']}' where t_id='$t_id'";
        //$sql="update t.t_id='{$user['t_id']}',t.t_name='{$user['t_name']}',t.t_address='{$user['t_address']}',b.b_name='{$user['b_']}',b.location from trainer t,branch b where t.b_id=b.b_id and t_id='$t_id'";
		$status=oci_parse($conn,$sql);
    	oci_execute($status);
		
		if($status){
			return true;
		}else{
			return false;
		}
	}


//======================================================================================

	function DeleteTrainerData($id){

		$conn = getConnection();
		$sql = "delete from trainer where t_id='$id'";
		
		$status=oci_parse($conn,$sql);
    	$res=oci_execute($status);
		
		if($status){
			return true;
		}else{
			return false;
		}
	}

//======================================================================================

	// function showMemberDetails(){

	// 	$conn=getConnection();
	// 	$query="select mem_id,mem_name,mem_address,mem_gender,mem_email,man_id,t_id,b_id
	// 			from member";
	// 	$statement=oci_parse($conn,$query);
	// 	oci_execute($statement);
		
	// 	return $statement;
	// }
?>