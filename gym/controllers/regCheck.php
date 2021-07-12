<?php
	session_start();

	require_once('../models/UserModel.php');
	//require_once('../model/usernameModel.php');

//================================================================
	if(isset($_POST['submit'])){

		$name = $_REQUEST['name'];
		$password = $_REQUEST['password'];
		$email = $_REQUEST['email'];
		$address = $_REQUEST['address'];
		$gender = $_REQUEST['gender'];
		$qualification = $_REQUEST['qualification'];
		$type = $_REQUEST['type'];

//=========================================================================
	
		$count = EmailQuery($email);

		//print_r($count);

		if($count>0){
			echo "Email Already Exits";
		}else{

			$user = [	
					'name'=>$name,
					'password'=>$password,
					'email'=> $email,
					'address'=>$address,
					'gender'=>$gender,
					'department'=>$department,
					'type'=>$type
				];
				
			$status = insertUser($user);

			if($status){
				echo "success";	
				header('location: ../views/login.php');			
			}else{
				echo "missing Information";
			}
		}
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

        <title>Regiser Page</title>

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
				<form class="form loginform" method="POST" action="../controllers/regCheck.php">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">Please Sign Up</div>
						<div class="panel-body">
							<div class="form-group">
								<label class="control-label">Name</label>
								<input type="text" name="name" class="form-control" required="required">
							</div>
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="text" name="email" class="form-control" required="required">
							</div>
							<div class="form-group">
								<label class="control-label">password</label>
								<input type="password" name="password" class="form-control" required="required">
							</div>
							<div class="form-group">
								<label class="control-label">Address</label>
								<textarea name="address" class="form-control" required="required"></textarea>
							</div>
							<div class="form-group">
								<label class="control-label">Gender</label>
								<select name="gender" class="form-control">
									<option value="">-Choose-</option>
									<option value="male">Male</option>
									<option value="female">Female</option>
									<option value="others">Others</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label">Qualification</label>
								<select name="qualification" class="form-control">
									<option value="">-Choose-</option>
									<option value="education">Education</option>
									<option value="job">Job</option>
									<option value="others">Others</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label">Type</label>
								<select name="type" class="form-control">
									<option value="">-Choose-</option>
									<option value="manager">Manager</option>
									<option value="member">Member</option>
									<option value="trainer">Trainer</option>
								</select>
							</div>
							
							<div class="alert alert-danger alert-dismissable fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								
							</div>
						
							<button type="submit" name="register" class="btn btn-success">SignUp</button>&nbsp&nbsp
							<label>Already register ? <a href="loginCheck.php">Goto Login </a></label>
						</div>
					</div>
				</form>
				
				<table align="center">
			        <tr>
			            <td><h4>copy-right@2021 by <b><a href="https://www.facebook.com/insan.moon.7/">Ruhul Amin</a><b></h4></td>
			        </tr>
			    </table>
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

