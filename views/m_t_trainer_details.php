<?php
    session_start();

    if(!isset($_SESSION['flag'])){
        header("location: ../controllers/loginCheck.php");
    }

    	require_once('../models/show_details.php');

	$statement=showM_T_TrainerDetails();
?>
<!-- ============================================================ -->
<?php 
    $title= "Trainer List";

    if($_SESSION['type']=='Manager'){
        include('../includes/manager_header.php');
    }else{
        include('../includes/header.php');
    }
    
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
	
	<hr>
<!-- ========================================================= -->

    <table class="table">
      <thead class="thead-dark">
        <tr>
            <th scope="col">TRAINER NAME</th>
            <th scope="col">TRAINER ADDRESS</th>
            <th scope="col">TRAINER GENDER</th>
            <th scope="col">TRAINER EMAIL</th>
            <th scope="col">TRINER PHONE</th>
            <th scope="col">BRANCH ID</th>
            <th scope="col">BRANCH NAME</th>
            <th scope="col">BRANCH LOCATION</th>
        </tr>
      </thead>
      <tbody>
      	<?php
      		while(($row=oci_fetch_array($statement,OCI_ASSOC+OCI_RETURN_NULLS))!=false){
    			
    			echo "<tr>\n";
    	    		
    			foreach ($row as $item) {

    	           	echo "<td>".($item)."</td>\n";
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
