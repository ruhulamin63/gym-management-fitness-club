<?php
    session_start();

    if(!isset($_SESSION['flag'])){
        header("location: ../controllers/loginCheck.php");
    }

    	require_once('../models/show_details.php');
    	//require_once('../models/UserModel.php');
    	require_once('../models/db.php');

	//$statement=showMemberDetails();

	if(isset($_POST['update_pay_btn'])){

		$t_id=$_POST['t_id'];
		$u_salary=$_POST['update_salary']; 
		//$pay_date=$_POST['u_payment_date'];   


		$update_salary =[
			't_id'=>$_POST['t_id'],
			'u_salary'=>$_POST['update_salary']
		];

		$res=UpdateSalary($update_salary);


		 //$status = AddMemberInsertData($user);

		if($res){
			//echo "Successfully inserted!";
			?>
				<script type="text/javascript">
					
					var proceed = confirm("Are you sure ?");
					if (proceed) {
						alert('Update salary in trainer table');

					} else {
					  //don't proceed
					}
				</script>
			<?php
			header('location: trainer_details.php');
			
		}else{

			?>
				<script type="text/javascript">
					//alert('Warning: Large percentage change in salary is not allowed ?');
					var proceed = confirm("Are you sure ?");
					if (proceed) {
						alert('Warning: Large percentage change in salary is not allowed ?');

					} else {
					  //don't proceed
					}
				</script>
			<?php
			//echo"<br>";
		    //echo "Failed to insert";

		}
	}
?>



<!-- ============================================================ -->
<?php 
    $title= "update-salary";
    require_once('../includes/manager_header.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Salary</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

    <?php
        if($_SESSION['type']=='Manager'){
    ?>
        <a href="../views/manager_dashboard.php"><button type="button">Back</button></a>
 
    <?php
        }else{
    ?>
        <a href="../views/m_t_dashboard.php"><button type="button">Back</button></a>
    <?php
    }
?>
	<a href="../controllers/logout.php"><button type="button" onclick="alert('Are you sure..?')">logout</button></a>

<!-- ========================================================= -->

<h1 style="text-align:center;color:black"><em>Salary Information</em></h1>
  
<form action="update_salary.php" method="POST" >
	<center>
	<fieldset style="width: 30%; border:2px solid black;" >
	    	<div class="form-group">
				<label class="control-label">Trainer Id</label>
				<input type="text" name="t_id" class="form-control" required="required">
			</div>
			<div class="form-group">
				<label class="control-label">Update Salary</label>
				<input type="text" name="update_salary" class="form-control" required="required">
			</div>
			<!-- <div class="form-group">
				<label class="control-label">Payment Date</label>
				<input type="text" name="u_payment_date" class="form-control" required="required">
			</div>	 -->		
	</fieldset>    
	 
	</center>
	<br>
	 <center> <input type="submit" name="update_pay_btn" value="Update" style="color:tomato"></center>
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
