<?php
    session_start();

    if(!isset($_SESSION['flag'])){
        header("location: ../controllers/loginCheck.php");
    }

    	require_once('../models/db.php');
    	require_once('../models/member_db.php');


	if(isset($_POST['update_mem_btn'])){

		$user = [	
			'mem_name'=>$_POST['mem_name'],
			'mem_address'=>$_POST['mem_address']
		];


		$get_id=$_POST['mem_id'];
		//print($get_id);

		$result=MemberUpdateData($user,$get_id);

		//print($result);

		if($result){

			?>
				<script type="text/javascript">
					alert('Updated data in member table.');
				</script>
			<?php

			header('location: ../views/member_details.php');
		}else{
			?>
				<script type="text/javascript">
					alert('Not Updated data');
				</script>
			<?php
		}

	}else{


		$mem_id=$_GET['MEM_ID'];
		$result = getMemberById($mem_id);

    	while ($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)){

    		$_SESSION['mem_id']=$row['MEM_ID'];
			$_SESSION['mem_name']=$row['MEM_NAME'];
			$_SESSION['mem_address']=$row['MEM_ADDRESS'];
		}
	}
?>
<!-- ============================================================ -->
<?php 
    $title= "edit-member";
    require_once('../includes/manager_header.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Member</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

    <a href="../views/member_details.php"><button type="button">Back</button></a>
	<a href="../controllers/logout.php"><button type="button" onclick="alert('Are you sure..?')">logout</button></a>

<!-- ========================================================= -->

<h1 style="text-align:center;color:black"><em>Member Information</em></h1>
  
<form action="member_edit.php" method="POST" >
	<center>
	<fieldset style="width: 40%; border:2px solid black;" >
	    <table>
	    	<tr>
				<td><label>Member Id :</label> </td>
				<td><input type="text" name="mem_id" value="<?php echo $_SESSION['mem_id'];?>"></td>
			
			</tr>
	      	<tr>
				<td><label>Member Name :</label> </td>
				<td><input type="text" name="mem_name" value="<?php echo $_SESSION['mem_name'];?>"></td>
			
			</tr>
			<br>
			
			<tr>
		   	   <td><label>Member Address :</label></td>
		   	   <td><input type="text" name="mem_address" value="<?php echo $_SESSION['mem_address'];?>"></td>
		   </tr>
	    </table>
	</fieldset>    
	 
	</center>
	<br>
	 <center> <input type="submit" name="update_mem_btn" value="Update" style="color:tomato"></center>
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
