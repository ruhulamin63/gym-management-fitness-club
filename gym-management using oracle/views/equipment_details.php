<?php
    session_start();

    if(!isset($_SESSION['flag'])){
        header("location: ../controllers/loginCheck.php");
    }

    	require_once('../models/show_details.php');

	$statement=showEquipmentDetails();
?>
<!-- ============================================================ -->
<?php 
    $title= "Equipment Quality";

    if($_SESSION['type']=='Manager'){
        include('../includes/manager_header.php');
    }else{
        include('../includes/header.php');
    }
    
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Equipment Quality</h1>
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
            <th scope="col">EQUIPMENT NAME</th>
            <th scope="col">EQUIPMENT QUALITY</th>
            <th scope="col">TRAINER NAME</th>
            <th scope="col">TRINER ADDRESS</th>
            <th scope="col">TRINER PHONE</th>
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
