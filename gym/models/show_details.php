<?php
	
	require_once('db.php');

	function showMemberDetails(){

		$conn=getConnection();
		$query="select m.mem_id,m.mem_name,m.mem_address,m.mem_gender,m.mem_email,mm.mem_phone
				from member m,member_1 mm where m.mem_id=mm.mem_id";
		$statement=oci_parse($conn,$query);
		oci_execute($statement);
		
		return $statement;
	}

	function showTrainerDetails(){

		$conn=getConnection();
		$query="select t.t_id,t.t_name,t.t_address,t.t_email,tt.t_phone from trainer t,trainer_1 tt where t.t_id=tt.t_id";
		$statement=oci_parse($conn,$query);
		oci_execute($statement);
		
		return $statement;
	}
?>