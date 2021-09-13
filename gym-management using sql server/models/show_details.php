<?php
	
	require_once('db.php');

	function showMemberDetails(){

		$conn=getConnection();
		$sql="select mem_id,mem_name,mem_address,mem_gender,mem_email,man_id,t_id,b_id
				from member";
		$statement=sqlsrv_query($conn,$sql);
		
		return $statement;
	}
	
	function showProgramDetails(){
		$conn=getConnection();
		$sql="select pro_id,duration,cost from program";
        $statement=sqlsrv_query($conn,$sql);
		
		return $statement;

	}
	function showBranchDetails(){
		$conn=getConnection();
		$sql="select b.b_id,b.b_name,b.location,bb.b_phone,m.man_name,m.man_email
		from branch b,branch_1 bb,manager m where b.b_id=bb.b_id and b.b_id=m.b_id";
        $statement=sqlsrv_query($conn,$sql);
		
		return $statement;

	}

	function showPaymentDetails(){
		$conn=getConnection();
		$sql="select m.mem_name,m.mem_address,p.p_id,p.amount,p.payment_date
        from member m,payment p where m.p_id=p.p_id";
        $statement=sqlsrv_query($conn,$sql);
		
		return $statement;

	}

	

	function showTrainerDetails(){

		$conn=getConnection();
		$sql="select t.t_id,t.t_name,t.t_gender,t.t_address,t.t_email,t.t_salary,b.b_name,b.location from trainer t,branch b where t.b_id=b.b_id";
		$statement=sqlsrv_query($conn,$sql);
		
		return $statement;
	}

	function UpdateSalary($update_salary){
		$conn=getConnection();
		$sql="update trainer set t_salary=t_salary+'{$update_salary['u_salary']}' where t_id='{$update_salary['t_id']}'";
		$statement=sqlsrv_query($conn,$sql);

    	return $statement;
	}

	function showManagerDetails(){

		$conn=getConnection();
		$sql="select m.man_id,m.man_name,m.man_email,m.man_address,mm.man_phone,b.b_name,b.location
			from manager m,manager_1 mm,branch b where m.man_id=mm.man_id and m.b_id=b.b_id";
		$statement=sqlsrv_query($conn,$sql);
		
		return $statement;
	}

	function showM_T_TrainerDetails(){

		$conn=getConnection();
		$sql="select t.t_name,t.t_address,t.t_gender,t.t_email,tt.t_phone,b.b_id,b.b_name,b.location from trainer t,trainer_1 tt, branch b where t.t_id=tt.t_id and t.b_id=b.b_id";
		$statement=sqlsrv_query($conn,$sql);
		
		return $statement;
	}

	function showEquipmentDetails(){

		$conn=getConnection();
		$sql="select e.e_name,e.e_quality,t.t_name,t.t_address,tt.t_phone from equipment  e, trainer t,trainer_1 tt where e.t_id=t.t_id and t.t_id=tt.t_id";
		$statement=sqlsrv_query($conn,$sql);
		
		return $statement;
	}
?>