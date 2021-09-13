<?php
    session_start();

    if(!isset($_SESSION['flag'])){
        header("location: ../controllers/loginCheck.php");
    }
?>
<!-- ============================================================ -->
<?php 
    $title= "Branch Details";
    
    if($_SESSION['type']=='Manager'){
        include('../includes/manager_header.php');
    }else{
        include('../includes/header.php');
    }
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">All Branches Information</h1>
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
		<form method="post" action="branch_details.php">
			<fieldset>
				<div class="input-group">
				  <input type="search" name="b_id_search" class="form-control rounded" placeholder="Search by Branch Id" aria-label="Search"
				    aria-describedby="search-addon" />
				  <input type="submit" name="search_btn" value="Search" class="btn btn-outline-primary">
				  &nbsp &nbsp&nbsp&nbsp
				    <input type="submit" name="view_all_btn" value="View All" class="btn btn-outline-primary">
				</div>
		  </fieldset>
		</form>
	</center>
	
	<hr>
<!-- ========================================================= -->
	<table class="table">
	  <thead class="thead-dark">
	    <tr>
	       <th scope="col">BRANCH ID</th>
	       <th scope="col">BRANCH NAME</th>
	       <th scope="col">LOCATION</th>
	       <th scope="col">BRANCH PHONE NO</th>
	       <th scope="col">MANAGER NAME</th>
	       <th scope="col">MANAGER EMAIL</th>
	    </tr>
	  </thead>
	  <tbody>
<?php

    require_once('../models/show_details.php');

    if(isset($_POST['view_all_btn'])){

        $statement=showBranchDetails();

        while($row=oci_fetch_array($statement,OCI_ASSOC+OCI_RETURN_NULLS)){
                
            echo"<tr>
                    <td>{$row['B_ID']}</td>
                    <td>{$row['B_NAME']}</td>
                    <td>{$row['LOCATION']}</td>
                    <td>{$row['B_PHONE']}</td>
                    <td>{$row['MAN_NAME']}</td>
                    <td>{$row['MAN_EMAIL']}</td>				
                </tr>";
        }
        oci_free_statement($statement);
    }
?>
<!-- ========================================================= -->
<?php 

    if(isset($_POST['search_btn'])){

        $b_id=$_POST['b_id_search'];

        require_once('../models/db.php');

        $conn = getConnection();
        $sql = "select b.b_id,b.b_name,b.location,bb.b_phone,m.man_name,m.man_email
		from branch b,branch_1 bb,manager m where b.b_id=bb.b_id and b.b_id=m.b_id and b.b_id='{$b_id}'";
        $statement=oci_parse($conn,$sql);
        oci_execute($statement);

        while($row=oci_fetch_array($statement,OCI_ASSOC+OCI_RETURN_NULLS)){
            
            echo"<tr>
                <td>{$row['B_ID']}</td>
                <td>{$row['B_NAME']}</td>
                <td>{$row['LOCATION']}</td>
                <td>{$row['B_PHONE']}</td>
                <td>{$row['MAN_NAME']}</td>
                <td>{$row['MAN_EMAIL']}</td>				
            </tr>";
        }
        oci_free_statement($statement);
    }
?>

  <!-- ================================================================ -->
	  </tbody>
	</table>
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
