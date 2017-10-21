<?php
$con=mysqli_connect('localhost','root','ganesh6');
if(!$con)
{
echo  "Not connected to server";
}
if(!mysqli_select_db($con,'ooad'))
{
    echo "Not connected to db";
}
session_start();
$_SESSION["adminName"]=" ";
if(isset($_POST['submit']))
{
    $username=$_POST['username'];
    $pass=$_POST['password'];
    if($username=="abc"&&$pass=="123")
    {
        echo "<script>document.location= 'adminMain.php'</script>";
        $_SESSION["adminName"]=$username;
    }
    else
    {
 	function myAlert($msg, $url){
 	   echo '<script language="javascript">alert("'.$msg.'");</script>';
    	echo "<script>document.location = '$url'</script>";
	}
	myAlert("Invalid Username or Password", "adminLog.php");
 		   
}
}
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	label{
			font-size: 20px;
	}
	form{
		margin-top: 20%;
		margin-left:25%;
		margin-right: 25%;
	}
</style>
<body style="background-color: #CD853F">
	<div class="container">
<form class="well well-lg" action="#" method="POST">
	<center><label><strong>Admin Login</strong></label></center>
	<div class="form-group">
	<label>UserName :</label>
	<input type="text" name="username" class="form-control" placeholder="Enter UserName" required><br>
	<label>Password :</label>
	<input type="password" name="password" class="form-control" placeholder="Enter Password" required><br>
		<center><button type="Submit" name="submit" class="btn btn-danger btn-lg">Login</button></center>
</div>
</form>
</div>
</body>
</html>