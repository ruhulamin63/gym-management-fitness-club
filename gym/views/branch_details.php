<?php
    session_start();

    if(!isset($_SESSION['flag'])){
        header("location: ../controllers/loginCheck.php");
    }

    	require_once('../models/show_details.php');

	$statement=showBranchDetails();
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
		<div class="input-group">
		  <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
		    aria-describedby="search-addon" />
		  <button type="button" class="btn btn-outline-primary">search</button>	
		</div>
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
	  	?>
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
