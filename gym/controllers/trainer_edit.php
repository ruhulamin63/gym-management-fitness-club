<?php
    session_start();

    if(!isset($_SESSION['flag'])){
        header("location: ../controllers/loginCheck.php");
    }

    	require_once('../models/db.php');
        require_once('../models/trainer_db.php');


	if(isset($_POST['update_t_btn'])){

		$user = [	
            't_id'=>$_POST['t_id'],
			't_name'=>$_POST['t_name'],
			't_address'=>$_POST['t_address'],
            't_branch_name'=>$_POST['t_branch_name'],
            'b_location'=>$_POST['b_location']
		];


		$get_id=$_POST['t_id'];
		//print($get_id);

		$result=TrainerUpdateData($user,$get_id);

		//print($result);

		if($result){

			?>
				<script type="text/javascript">
					alert('Updated data in trainer table.');
				</script>
			<?php

			header('location: ../views/trainer_details.php');
		}else{
			?>
				<script type="text/javascript">
					alert('Not Updated data');
				</script>
			<?php
		}

	}else{


		$t_id=$_GET['T_ID'];
		$result = getTrainerById($t_id);

    	while ($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)){

    		$_SESSION['t_id']=$row['T_ID'];
			$_SESSION['t_name']=$row['T_NAME'];
			$_SESSION['t_address']=$row['T_ADDRESS'];
			$_SESSION['t_branch_name']=$row['B_NAME'];
			$_SESSION['b_location']=$row['LOCATION'];
		}
	}
?>
<!-- ============================================================ -->
<?php 
    $title= "edit-trainer";
    require_once('../includes/manager_header.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Trainer</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

    <a href="../views/trainer_details.php"><button type="button">Back</button></a>
	<a href="../controllers/logout.php"><button type="button" onclick="alert('Are you sure..?')">logout</button></a>

<!-- ========================================================= -->

<h1 style="text-align:center;color:black"><em>Trainer Information</em></h1>
  
<form action="trainer_edit.php" method="POST" >
	<center>
	<fieldset style="width: 40%; border:2px solid black;" >
	    <table>
	    	<tr>
				<td><label>Trainer Id :</label> </td>
				<td><input type="text" name="t_id" value="<?php echo $_SESSION['t_id'];?>"></td>
			
			</tr>
	      	<tr>
				<td><label>Trainer Name :</label> </td>
				<td><input type="text" name="t_name" value="<?php echo $_SESSION['t_name'];?>"></td>
			
			</tr>
			<br>
			
			<tr>
		   	   <td><label>Trainer Address :</label></td>
		   	   <td><input type="text" name="t_address" value="<?php echo $_SESSION['t_address'];?>"></td>
		   </tr>
	    </table>
	</fieldset>    
	 
	</center>
	<br>
	 <center> <input type="submit" name="update_t_btn" value="Update" style="color:tomato"></center>
</form>	
<!-- ========================================================= -->


    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">


            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">

            <!-- /.panel .chat-panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<?php include_once('../includes/footer.php'); ?>
