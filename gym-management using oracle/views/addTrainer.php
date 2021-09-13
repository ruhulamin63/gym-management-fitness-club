<?php
    session_start();

    if(!isset($_SESSION['flag'])){
        header("location: ../controllers/loginCheck.php");
    }

    	//require_once('../models/show_details.php');
    	//require_once('../models/UserModel.php');
    	require_once('../models/db.php');

	//$statement=showMemberDetails();

	if(isset($_POST['add_train_btn'])){

		$t_name=$_POST['t_name'];
		$t_gender=$_POST['t_gender']; 
		$t_address=$_POST['t_address']; 
		$t_email=$_POST['t_email'];
		$t_salary=$_POST['t_salary'];
		$man_id=$_POST['man_id'];
		$b_id=$_POST['b_id'];  


		$conn=getConnection();
		//$sql="insert into trainer(t_id,t_name,t_gender,t_address,t_email,t_salary,man_id,b_id) values(tainersq.nextval,'$t_name','$t_gender','$t_address','$t_email','$t_salary','$man_id','$b_id')";
		
		$sql="call trainerInsertData('".$t_name."', '".$t_gender."', '".$t_address."', '".$t_email."', '".$t_salary."', '".$man_id."', '".$b_id."')";

		$status=oci_parse($conn,$sql);
    	$res=oci_execute($status);


		 //$status = AddMemberInsertData($user);

		if($res){
			//echo "Successfully inserted!";
			?>
				<script type="text/javascript">
					alert('Inserted data in database');
				</script>
			<?php
			header('location: Trainer_details.php');
			
		}else{

			?>
				<script type="text/javascript">
					alert('You better come in regular working hour ?');
				</script>
			<?php
			//echo"<br>";
		    //echo "Failed to insert";

		}
	}
?>
<!-- ============================================================ -->
<?php 
    $title= "add-trainer";
    require_once('../includes/manager_header.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Trainer</h1>
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

<h1 style="text-align:center;color:black"><em>Trainer Information</em></h1>
  
<form action="addTrainer.php" method="POST" >
	<center>
	<fieldset style="width: 40%; border:2px solid black;" >
	    <div class="form-group">
			<label class="control-label">Trainer Name</label>
			<input type="text" name="t_name" class="form-control" required="required">
		</div>
		<div class="form-group">
			<label class="control-label">Trainer Gender</label>
			<input type="radio" name="t_gender"
	            <?php if (isset($gender) && $gender=="male") echo "checked";?>
	             value="male">Male
	             <input type="radio" name="mem_gender"
	             <?php if (isset($gender) && $gender=="female") echo "checked";?>
	             value="female">Female
		</div>
		<div class="form-group">
			<label class="control-label">Trainer address</label>
			<input type="text" name="t_address" class="form-control" required="required">
		</div>
		<div class="form-group">
			<label class="control-label">Trainer email</label>
			<input type="text" name="t_email" class="form-control" required="required">
		</div>
		<div class="form-group">
			<label class="control-label">Trainer salary</label>
			<input type="text" name="t_salary" class="form-control" required="required">
		</div>
		<div class="form-group">
			<label class="control-label">Manager Id</label>
			<input type="text" name="man_id" class="form-control" required="required">
		</div>
		<div class="form-group">
			<label class="control-label">Branch Id</label>
			<input type="text" name="b_id" class="form-control" required="required">
		</div>


	</fieldset>    
	 
	</center>
	<br>
	 <center> <input type="submit" name="add_train_btn" value="Add" style="color:tomato"></center>
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
