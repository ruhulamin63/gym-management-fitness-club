<?php

	require_once('test.php');

	function getAllData(){

		$conn=getConnection();
		$sql="select ename from emp";
		$result=oci_parse($conn,$sql);
		oci_execute($result);
	
		return $result;
	}

	function eachData(){

		    error_reporting(0);

            $conn=getConnection();
            $sql = 'select * from emp where deptno= :d_no';
            $result = oci_parse($conn, $sql);
            $d_no = 10;
            $e_no=7782;
            oci_bind_by_name($result,':d_no', $d_no);
            oci_execute($result);
	
		return $result;
	}
?>