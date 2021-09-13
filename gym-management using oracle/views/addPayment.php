<?php
    session_start();

    if(!isset($_SESSION['flag'])){
        header("location: ../controllers/loginCheck.php");
    }

    	//require_once('../models/show_details.php');
    	//require_once('../models/UserModel.php');
    	require_once('../models/db.php');

	//$statement=showMemberDetails();

	if(isset($_POST['add_pay_btn'])){

		$mem_id=$_POST['mem_id'];
		$amount=$_POST['amount']; 
		$payment=$_POST['payment']; 
		$man_id=$_POST['man_id'];   



		$conn=getConnection();
		$sql="insert into payment(p_id,mem_id,amount,payment_date,man_id) VALUES(paymentsq.nextval,'$mem_id','$amount','$payment','$man_id')";
		
		$status=oci_parse($conn,$sql);
    	$res=oci_execute($status);


		 //$status = AddMemberInsertData($user);

		if($res){
			//echo "Successfully inserted!";
			?>
				<script type="text/javascript">
					
					var proceed = confirm("Are you sure ?");
					if (proceed) {
						alert('Inserted data in database');

					} else {
					  //don't proceed
					  header('location: ../views/addPayment.php');
					}
				</script>
			<?php
			header('location: addMember.php');
			
		}else{

			?>
				<script type="text/javascript">
					
					var proceed = confirm("Are you sure ?");
					if (proceed) {
						alert('You can insert regular working hour');

					} else {
					  //don't proceed
					  header('location: ../views/addPayment.php');
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
    $title= "add-payment";
    require_once('../includes/manager_header.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Payment</h1>
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

<h1 style="text-align:center;color:black"><em>Payment Information</em></h1>
  
<form action="addPayment.php" method="POST" >
	<center>
	<fieldset style="width: 30%; border:2px solid black;" >
	    	<div class="form-group">
				<label class="control-label">Member Id</label>
				<input type="text" name="mem_id" class="form-control" required="required">
			</div>
			<div class="form-group">
				<label class="control-label">Amount</label>
				<input type="text" name="amount" class="form-control" required="required">
			</div>
			<div class="form-group">
				<label class="control-label">Payment Date</label>
				<input type="text" name="payment" class="form-control" required="required">
			</div>
			<div class="form-group">
				<label class="control-label">Manager Id</label>
				<input type="text" name="man_id" class="form-control" required="required">
			</div>				
	</fieldset>    
	 
	</center>
	<br>
	 <center> <input type="submit" name="add_pay_btn" value="Add" style="color:tomato"></center>
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
