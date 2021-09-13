<?php
    session_start();

    if(!isset($_SESSION['flag'])){
        header("location: ../controllers/loginCheck.php");
    }
?>
<!-- ============================================================ -->
<?php 
    $title= "Member List";
    
    if($_SESSION['type']=='Manager'){
        include('../includes/manager_header.php');
    }else{
        include('../includes/header.php');
    }
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Member List</h1>
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

	<center>
		<form method="post" action="m_t_member_details.php">
			<fieldset>
				<div class="input-group">
				  <input type="search" name="mem_id_search" class="form-control rounded" placeholder="Search" aria-label="Search"
				    aria-describedby="search-addon" />
				  <input type="submit" name="search_btn" value="Search" class="btn btn-outline-primary">
				  &nbsp &nbsp&nbsp&nbsp
				    <input type="submit" name="view_all_btn" value="View All" class="btn btn-outline-primary">
				</div>
		  </fieldset>
		</form>
	</center>

	<table class="table">
	  <thead class="thead-dark">
	    <tr>
	       <th scope="col">MEM ID</th>
	       <th scope="col">NAME</th>
	       <th scope="col">ADDRESS</th>
	       <th scope="col">GENDER</th>
	       <th scope="col">EMAIL</th>
	       <th scope="col">Manager ID</th>
	       <th scope="col">Triner ID</th>
	       <th scope="col">Branch ID</th>
	    </tr>
	  </thead>
	  <tbody>

	<hr>
<!-- ========================================================= -->

	
	<?php 
		//require_once('../model/db.php');
		//require_once('../model/JobTitleModel.php');
		require_once('../models/show_details.php');

		if(isset($_POST['view_all_btn'])){

	?>

	<?php

		$statement=showMemberDetails();

  		while($row=oci_fetch_array($statement,OCI_ASSOC+OCI_RETURN_NULLS)){
	    	
  			$_SESSION['MEM_ID']=$row['MEM_ID'];

  			//$get_id=$_SESSION['MEM_ID'];

			echo"<tr>
					<td>{$row['MEM_ID']}</td>
					<td>{$row['MEM_NAME']}</td>
					<td>{$row['MEM_ADDRESS']}</td>
					<td>{$row['MEM_GENDER']}</td>
					<td>{$row['MEM_EMAIL']}</td>
					<td>{$row['MAN_ID']}</td>
					<td>{$row['T_ID']}</td>
					<td>{$row['B_ID']}</td>
				</tr>";
			}
			oci_free_statement($statement);
		}
	?>

<!-- ========================================================= -->
	<?php 
		//require_once('../model/db.php');
		//require_once('../model/JobTitleModel.php');

		if(isset($_POST['search_btn'])){

	?>
	<?php
		
			$mem_id=$_POST['mem_id_search'];
			//$result=getMemberSearchById($mem_id);

			require_once('../models/db.php');

			$conn = getConnection();
			$sql = "select * from member where mem_id='{$mem_id}'";
			$statement=oci_parse($conn,$sql);
			oci_execute($statement);

	  		while($row=oci_fetch_array($statement,OCI_ASSOC+OCI_RETURN_NULLS)){
		    	
	  			$_SESSION['MEM_ID']=$row['MEM_ID'];

	  			//$get_id=$_SESSION['MEM_ID'];

				echo"<tr>
						<td>{$row['MEM_ID']}</td>
						<td>{$row['MEM_NAME']}</td>
						<td>{$row['MEM_ADDRESS']}</td>
						<td>{$row['MEM_GENDER']}</td>
						<td>{$row['MEM_EMAIL']}</td>
						<td>{$row['MAN_ID']}</td>
						<td>{$row['T_ID']}</td>
						<td>{$row['B_ID']}</td>
					</tr>";
			}
			oci_free_statement($statement);
	?>

	  	<!-- ================================================================ -->

		  </tbody>
		</table>
	<?php
		}
	?>
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
