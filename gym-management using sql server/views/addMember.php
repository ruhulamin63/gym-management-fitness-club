<?php
    session_start();

    if(!isset($_SESSION['flag'])){
        header("location: ../controllers/loginCheck.php");
    }

    	//require_once('../models/show_details.php');
    	require_once('../models/db.php');
    	//require_once('../models/member_db.php');


	if(isset($_POST['add_mem_btn'])){

		$mem_name=$_POST['mem_name'];
		$mem_address=$_POST['mem_address']; 
		$mem_gender=$_POST['mem_gender']; 
		$mem_email=$_POST['mem_email'];
		$man_id=$_POST['man_id'];
		$p_id=$_POST['p_id'];
		$t_id=$_POST['t_id'];
		$b_id=$_POST['b_id'];    

		$conn=getConnection();
		//$sql="insert into member(mem_id,mem_name, mem_address, mem_gender, mem_email, man_id, p_id, t_id, b_id) VALUES(membersq.nextval,'$mem_name','$mem_address','$mem_gender','$mem_email','$man_id','$p_id','$t_id','$b_id')";
		
		$sql="call memberInsertData('".$mem_name."', '".$mem_address."', '".$mem_gender."', '".$mem_email."', '".$man_id."', '".$p_id."', '".$t_id."',  '".$b_id."')";
		
		$status=oci_parse($conn,$sql);
    	$res=oci_execute($status);

		if($res){
			//echo "Successfully inserted!";
			?>
				<script type="text/javascript">
					alert('Inserted data in database');
				</script>
			<?php
			header('location: member_details.php');
			
		}else{

			?>
				<script type="text/javascript">
					alert('You can insert regular working hour ?');
				</script>
			<?php
			//echo"<br>";
		    //echo "Failed to insert";

		}
	}
?>
<!-- ============================================================ -->
<?php 
    $title= "add-member";
    require_once('../includes/manager_header.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Member</h1>
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

<h1 style="text-align:center;color:black"><em>Member Information</em></h1>
  
<form action="addMember.php" method="POST" >
	<center>
	<fieldset style="width: 40%; border:2px solid black;" >
	    <table>
	      	<tr>
				<td><label>MEMBER NAME :</label> </td>
				<td><input type="text" id="mem_name" name="mem_name" required="required"></td>
			
			</tr>
			<br>
			
			<tr>
		   	   <td><label>MEMBER ADDRESS:</label></td>
		   	   <td><input type="text" id="mem_address" name="mem_address" required="required"></td>
		   </tr>
		   
			<tr>
                <td> <label>Gender:</label></td>
                <td><input type="radio" name="mem_gender"
                <?php if (isset($gender) && $gender=="male") echo "checked";?>
                 value="male">Male
                 <input type="radio" name="mem_gender"
                 <?php if (isset($gender) && $gender=="female") echo "checked";?>
                 value="female">Female</td>
            </tr>
		 	
		 	<tr>
		   	   <td><label>EMAIL:</label></td>
		   	   <td><input type="text" id="mem_email" name="mem_email" required="required"></td>
		    </tr>
		     		
		    <tr>
		   	   <td><label>MANAGER ID:</label></td>
		   	   <td><input type="text" id="man_id" name="man_id" required="required"></td>
		    </tr>
		     	
		    <tr>
		   	   <td><label>PAYMENT ID:</label></td>
		   	   <td><input type="text" id="p_id" name="p_id" required="required"></td>
		    </tr>
		     	
		    <tr>
		   	   <td><label>TRAINER ID:</label></td>
		   	   <td><input type="text" id="t_id" name="t_id" required="required"></td>
		    </tr>
		     	
		    <tr>
		   	   <td><label>BRANCH ID:</label></td>
		   	   <td><input type="text" id="b_id" name="b_id" required="required"></td>
		    </tr>
	    </table>
	</fieldset>    
	 
	</center>
	<br>
	 <center> <input type="submit" name="add_mem_btn" value="Add" style="color:tomato"></center>
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
