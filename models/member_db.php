<?php

	require_once('db.php');

//========================Start Add Job   ===========================================

	function getMemberById($id){

		$conn = getConnection();
		$sql = "select * from member where mem_id=$id";

		$status=oci_parse($conn,$sql);
    	oci_execute($status);

    	//$h=oci_fetch_array($status);

		return $status;
	}

//======================================================================================

	function AddMemberData($user){

		$conn=getConnection();
		$sql="insert into member(mem_id,mem_name, mem_address, mem_gender, mem_email, man_id, p_id, t_id, b_id) VALUES(membersq.nextval,'{user[mem_name]}','{user[mem_address]}','{user[mem_gender]}','{user[mem_email]}','{user[man_id]}','{user[p_id]}','{user[t_id]}','{user[b_id]}')";
		
		$status=oci_parse($conn,$sql);
    	$res=oci_execute($status);
		
		if($status){
			return true;
		}else{
			return false;
		}

		//return $status;
	}

//=======================================================================================

	function MemberUpdateData($user,$mem_id){

		$conn = getConnection();
		$sql = "update member set mem_name='{$user['mem_name']}', mem_address='{$user['mem_address']}' where mem_id='$mem_id'";
		
		$status=oci_parse($conn,$sql);
    	oci_execute($status);
		
		if($status){
			return true;
		}else{
			return false;
		}
	}


//======================================================================================

	function DeleteMemberData($id){

		$conn = getConnection();
		$sql = "delete from member where mem_id=$id";
		
		$status=oci_parse($conn,$sql);
    	$res=oci_execute($status);
		
		if($status){
			return true;
		}else{
			return false;
		}
	}

//======================================================================================

	function showMemberDetails(){

		$conn=getConnection();
		$query="select mem_id,mem_name,mem_address,mem_gender,mem_email,man_id,t_id,b_id
				from member";
		$statement=oci_parse($conn,$query);
		oci_execute($statement);
		
		return $statement;
	}

//======================================================================================

	// function getUserAddJobSearchById($name){

	// 	$conn = getConnection();
	// 	$sql = "select * from add_job where addjob='{$name}'";
	// 	$result = mysqli_query($conn, $sql);

	// 	return $result;
	// }

// //============================================================================

// 	function getMemberById($type){

// 		$conn = getConnection();
// 		$sql = "select * from register where type='{$type}'";
// 		$result = oci_parse($conn, $sql);
// 		oci_execute($result);
// 		$row = oci_fetch_assoc($result);

// 		return $row;
// 	}
// //=======================================================================================

?>