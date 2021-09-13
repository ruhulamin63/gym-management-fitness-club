<?php
	session_start();

	require_once('../models/UserModel.php');
	//require_once('../models/db.php');

	if(isset($_POST['login'])){

		$m_email = $_REQUEST['email'];
		$m_password = $_REQUEST['password'];
		// $m_type = $_REQUEST['type'];

		$result=validateUser();

		while ($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)){

			$id=$row['ID'];
			$password=$row['PASSWORD'];
			$type=$row['TYPE'];
			$name=$row['NAME'];
			$email=$row['EMAIL'];
			$address=$row['ADDRESS'];
			$gender=$row['GENDER'];
			$qualification=$row['QUALIFICATION'];
		//}
		

		if($m_email==$email and $m_password==$password){

				//$_SESSION['type']=$type;

		    	if($type=='Manager'){
			 		$_SESSION['flag']= true;

			 	// 	$data = getUserByType($type);
					$_SESSION['type']=$type;

					header("location:../views/manager_dashboard.php");

				}else if ($type=='Member' || $type=='Trainer') {
					$_SESSION['flag']= true;

					$_SESSION['type']=$type;

					header("location:../views/m_t_dashboard.php");

				}
			}else{
				//echo "Invalide User....";
				//break;

				$check="Invalid User";

				//$_SESSION['error']=$check;
			}
		}

		if($check){
			echo $check;
		}

		//$_SESSION['type']=$type;
		oci_free_statement($result);
		//oci_close($conn);
	}
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Login Page</title>

        <!-- Bootstrap Core CSS -->
        <link  rel="stylesheet" href="../assets/css/bootstrap.min.css"/>

        <!-- MetisMenu CSS -->
        <link href="../assets/js/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../assets/css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="../assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="../assets/js/jquery.min.js" type="text/javascript"></script>

    </head>

    <body>

        <div id="wrapper">
			<div id="page-" class="col-md-4 col-md-offset-4">
				<form method="post" action="loginCheck.php">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">Please Sign In</div>
		
						<div class="panel-body">

							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="text" name="email" class="form-control" required="required" value="">
							</div>
							<div class="form-group">
								<label class="control-label">Password</label>
								<input type="password" name="password" class="form-control" required="required" value="">
							</div>
						
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox">Remember Me
								</label>
							</div>
							
						<!-- 	<div class="alert alert-danger alert-dismissable fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								
							</div> -->
						
							<button type="submit" name="login" class="btn btn-success">Login</button>&nbsp&nbsp
							<label>Create new Account ? <a href="regCheck.php">Goto SignUp </a></label>
						</div>
					</div>
				</form>
				
				<table align="center">
			        <tr>
			            <td><h4>copy-right@2021 by <b><a href="https://www.facebook.com/insan.moon.7/">Ruhul Amin</a><b></h4></td>
			        </tr>
			    </table>			  
			</div>
		</div>
    <!-- /#wrapper -->

    <!-- jQuery -->


    <!-- Bootstrap Core JavaScript -->

        <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../assets/js/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../assets/js/sb-admin-2.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
</body>

</html>
