<?php
    session_start();

    if(!isset($_SESSION['flag'])){
        header("location: ../controllers/loginCheck.php");
    }

    	require_once('../models/show_details.php');

	$statement=showTrainerDetails();
?>
<!-- ============================================================ -->
<?php 
    $title= "Trainer List";
    include('../includes/header.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Trainer List</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

    <a href="../views/manager_dashboard.php"><button type="button">Back</button></a>
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
            <th scope="col">ID</th>
            <th scope="col">NAME</th>
            <th scope="col">ADDRESS</th>
            <th scope="col">EMAIL</th>
            <th scope="col">PHONE</th>
        </tr>
      </thead>
      <tbody>
      	<?php
      		while(($row=oci_fetch_array($statement,OCI_ASSOC+OCI_RETURN_NULLS))!=false){
    			
    			echo "<tr>\n";
    	    		
    			foreach ($row as $item) {

    	           	echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    	        }
    			echo "</tr>\n";	 
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
