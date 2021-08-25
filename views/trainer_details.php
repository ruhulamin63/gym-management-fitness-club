<?php
    session_start();

    if(!isset($_SESSION['flag'])){
        header("location: ../controllers/loginCheck.php");
    }
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
    <center>
        <form method="post" action="trainer_details.php">
            <fieldset>
                <div class="input-group">
                  <input type="search" name="t_id_search" class="form-control rounded" placeholder="Search by Trainer Id" aria-label="Search"
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
            <th scope="col">TRAINER ID</th>
            <th scope="col">TRAINER NAME</th>
            <th scope="col">TRAINER GENDER</th>
            <th scope="col">TRAINER ADDRESS</th>
            <th scope="col">TRAINER EMAIL</th>
            <th scope="col">TRINER SALARY</th>
            <th scope="col">BRANCH NAME</th>
            <th scope="col">BRANCH LOCATION</th>
            <th scope="col">Edit</th>
	       <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>


    <?php 
        //require_once('../model/db.php');
        require_once('../models/show_details.php');

	    $statement=showTrainerDetails();

        if(isset($_POST['view_all_btn'])){

      		while(($row=oci_fetch_array($statement,OCI_ASSOC+OCI_RETURN_NULLS))!=false){
    			
    		// 	echo "<tr>\n";
    	    		
    		// 	foreach ($row as $item) {

    	    //        	echo "<td>".($item)."</td>\n";
    	    //     }
    		// 	echo "</tr>\n";	 
    		// }
    		// oci_free_statement($statement);

            //=========================================

            echo"<tr>
                        <td>{$row['T_ID']}</td>
                        <td>{$row['T_NAME']}</td>
                        <td>{$row['T_GENDER']}</td>
                        <td>{$row['T_ADDRESS']}</td>
                        <td>{$row['T_EMAIL']}</td>
                        <td>{$row['T_SALARY']}</td>
                        <td>{$row['B_NAME']}</td>
                        <td>{$row['LOCATION']}</td>
                        <td>
                            <a href='../controllers/trainer_edit.php?T_ID=$row[T_ID]'>Edit</a>
                        </td>
                        <td>
                            <a href='../controllers/trainer_delete.php?T_ID=$row[T_ID]'>Delete</a>
                        </td>
                    </tr>";
            }
            oci_free_statement($statement);
        }
    ?>

    <?php
        if(isset($_POST['search_btn'])){

            $t_id=$_POST['t_id_search'];
            //$result=getMemberSearchById($mem_id);

            require_once('../models/db.php');

            $conn = getConnection();
            //$sql = "select * from trainer where t_id='{$t_id}'";
            $sql="select t.t_id,t.t_name,t.t_gender,t.t_address,t.t_email,t.t_salary,b.b_name,b.location from trainer t,branch b where t.b_id=b.b_id and t_id='{$t_id}'";
            $statement=oci_parse($conn,$sql);
            oci_execute($statement);

            while($row=oci_fetch_array($statement,OCI_ASSOC+OCI_RETURN_NULLS)){
                
                //$_SESSION['MEM_ID']=$row['MEM_ID'];

                //$get_id=$_SESSION['MEM_ID'];

                echo"<tr>
                        <td>{$row['T_ID']}</td>
                        <td>{$row['T_NAME']}</td>
                        <td>{$row['T_GENDER']}</td>
                        <td>{$row['T_ADDRESS']}</td>
                        <td>{$row['T_EMAIL']}</td>
                        <td>{$row['T_SALARY']}</td>
                        <td>{$row['B_NAME']}</td>
                        <td>{$row['LOCATION']}</td>
                        <td>
                            <a href='../controllers/trainer_edit.php?T_ID=$row[T_ID]'>Edit</a>
                        </td>
                        <td>
                            <a href='../controllers/trainer_delete.php?T_ID=$row[T_ID]'>Delete</a>
                        </td>
                    </tr>";
            }
            oci_free_statement($statement);
    ?>
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
