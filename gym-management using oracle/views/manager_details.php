<?php
    session_start();

    if(!isset($_SESSION['flag'])){
        header("location: ../controllers/loginCheck.php");
    }
?>
<!-- ============================================================ -->
<?php 
    $title= "Manager List";

    if($_SESSION['type']=='Manager'){
        include('../includes/manager_header.php');
    }else{
        include('../includes/header.php');
    }
    
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manager Information</h1>
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
        <form method="post" action="manager_details.php">
            <fieldset>
                <div class="input-group">
                  <input type="search" name="m_name_search" class="form-control rounded" placeholder="Search by Manager Name" aria-label="Search"
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
            <th scope="col">MANAGER ID</th>
            <th scope="col">MANAGER NAME</th>
            <th scope="col">MANAGER EMAIL</th>
            <th scope="col">MANAGER ADDRESS</th>
            <th scope="col">PHONE N0</th>
            <th scope="col">BRANCH NAME</th>
            <th scope="col">BRANCH LOCATION</th>
        </tr>
      </thead>
      <tbody>

      	<?php
      		// while(($row=oci_fetch_array($statement,OCI_ASSOC+OCI_RETURN_NULLS))!=false){
    			
    		// 	echo "<tr>\n";
    	    		
    		// 	foreach ($row as $item) {

    	    //        	echo "<td>".($item)."</td>\n";
    	    //     }
    		// 	echo "</tr>\n";	 
    		// }
    		// oci_free_statement($statement);


            
    	require_once('../models/show_details.php');
        $statement=showManagerDetails();


            if(isset($_POST['view_all_btn'])){

                while(($row=oci_fetch_array($statement,OCI_ASSOC+OCI_RETURN_NULLS))!=false){

                    echo"<tr>
                            <td>{$row['MAN_ID']}</td>
                            <td>{$row['MAN_NAME']}</td>
                            <td>{$row['MAN_EMAIL']}</td>
                            <td>{$row['MAN_ADDRESS']}</td>
                            <td>{$row['MAN_PHONE']}</td>
                            <td>{$row['B_NAME']}</td>
                            <td>{$row['LOCATION']}</td>
                        </tr>";
                    }
                    oci_free_statement($statement);
            }
      	?>

        <?php
            if(isset($_POST['search_btn'])){

                $man_name=$_POST['m_name_search'];
                //$result=getMemberSearchById($mem_id);

                require_once('../models/db.php');

                $conn = getConnection();
                //$sql = "select * from manager where t_id='{$t_id}'";
                $sql="select m.man_id,m.man_name,m.man_email,m.man_address,mm.man_phone,b.b_name,b.location
                    from manager m,manager_1 mm,branch b where m.man_id=mm.man_id and m.b_id=b.b_id and m.man_name='{$man_name}'";
                $statement=oci_parse($conn,$sql);
                oci_execute($statement);

                while($row=oci_fetch_array($statement,OCI_ASSOC+OCI_RETURN_NULLS)){
                    
                    //$_SESSION['MEM_ID']=$row['MEM_ID'];

                    //$get_id=$_SESSION['MEM_ID'];

                    echo"<tr>
                            <td>{$row['MAN_ID']}</td>
                            <td>{$row['MAN_NAME']}</td>
                            <td>{$row['MAN_EMAIL']}</td>
                            <td>{$row['MAN_ADDRESS']}</td>
                            <td>{$row['MAN_PHONE']}</td>
                            <td>{$row['B_NAME']}</td>
                            <td>{$row['LOCATION']}</td>
                        </tr>";
                }
                oci_free_statement($statement);
            }
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
