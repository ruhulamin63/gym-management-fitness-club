<?php

	require_once('db.php');

//=======================Validatin for login==================================================

	function validateUser(){

		//error_reporting(0);
		$conn=getConnection();
	    $sql = 'select * from emp where deptno= :d_no';
	    $result = oci_parse($conn, $sql);
	    $d_no = 10;
	    $e_no=7782;
	    oci_bind_by_name($result,':d_no', $d_no);
	    oci_execute($result);

	    return $result;	
	}

//======================================================================================

	function getUserByEmail($email){

		$conn = getConnection();
		$sql = "select * from register where eamil='{$eamil}'";
		$result = oci_parse($conn, $sql);
		oci_execute($result);
		$row = oci_fetch_assoc($result);

		return $row;
	}

//======================================================================================

	function getAllData(){

		$conn=getConnection();
		$sql="select ename from emp";
		$result=oci_parse($conn,$sql);
		oci_execute($result);
	
		return $result;
	}

//===========================================================================

	function eachData(){

		    error_reporting(0);

            $conn=getConnection();
            $sql = 'select job from emp where deptno= :d_no order by ename';
            $result = oci_parse($conn, $sql);
            $d_no = 10;
            oci_bind_by_name($result, ':d_no', $d_no);
            oci_execute($result);
	
		return $result;
	}

//===========================================================================
	
	function EmailQuery($email){

		$conn = getConnection();
		$sql = "select * from register where email='{$email}'";
		$result = oci_parse($conn, $sql);
		oci_execute($result);
		$row = oci_num_rows($result);

		return $row;
	}

//======================================================================================

	function insertUser($user){

		$conn = getConnection();
		$sql = "insert into register values('', '{$user['name']}', '{$user['password']}', '{$user['email']}', '{$user['address']}', '{$user['gender']}', '{$user['qualification']}', '{$user['type']}')";
		
		if(oci_parse($conn, $sql)){
			return true;
		}else{
			return false;
		}
	}

//======================================================================================
?>