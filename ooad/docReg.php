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
if(isset($_POST['submit']))
{
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $username=$_POST['username'];
    $pass=$_POST['password'];
    $age=$_POST['age'];
    $field=$_POST['field'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $email=$_POST['emailid'];
    $phone=$_POST['phone'];
    $docid=$_POST['doctorid'];
    $skypeName=$_POST['skypeid'];
    $que1="SELECT * FROM doctor where username='$username'";
    $rec=mysqli_query($con,$que1);
    if(!$rec)
    {
        echo "Query Error";
    }
    else if(mysqli_num_rows($rec)>0)
    {
        $msg="Username Already Exists....Choose a different one";
        echo "<script type='text/javascript'>alert('$msg');</script>";
        mysqli_free_result($rec);
    }
    else
    {
    	    $query="INSERT INTO doctor VALUES('$fname','$lname','$age','$username','$pass','$field','$address','$city','$state','$email','$phone','$docid','$skypeName')";
 		   $record=mysqli_query($con,$query);
 		   if(!$record)
 		   {
 		   	echo "error";
 		   }
 		   else
 		   {
 	function myAlert($msg, $url){
 	   echo '<script language="javascript">alert("'.$msg.'");</script>';
    	echo "<script>document.location = '$url'</script>";
	}
	myAlert("Successfully Registered", "index.html");

 		   }
    }
}
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Doctor Registration</title>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	label{
		text-decoration: bold;
		font-size: 20px;
	}
	form{
		margin-top: 20px;
		margin-left:150px;
		margin-right: 150px;
	}
</style>
<body style="background-color: #CD853F">
	<div class="container">
<form class="well well-lg" action="#" method="POST">
		<center><label><strong>Doctor Registration</strong></label></center>
	<div class="form-group">
	<label>FirstName :</label>
	<input type="text" name="firstname" class="form-control" placeholder="Enter FirstName" required><br>
	<label>LastName :</label>
	<input type="text" name="lastname" class="form-control" placeholder="Enter LastName" required><br>
	<label>DocID :</label>
	<input type="text" name="doctorid" class="form-control" placeholder="Enter Doctor LicenseID" required><br>
	<label>UserName :</label>
	<input type="text" name="username" class="form-control" placeholder="Enter UserName" required><br>
	<label>Password :</label>
	<input type="password" name="password" class="form-control" placeholder="Enter Password" required><br>
	<label>Age :</label>
	<input type="number" name="age" class="form-control" placeholder="Enter Age" required><br>
	<label>Field of Specialization :</label>
	<input type="text" name="field" class="form-control" placeholder="Enter Field" required><br>
	<label>Address :</label>
	<input type="text" name="address" class="form-control" placeholder="Enter Address" required><br>
	<label>City :</label>
	<input type="text" name="city" class="form-control" placeholder="Enter City" required><br>
	<label>State :</label>
	<input type="text" name="state" class="form-control" placeholder="Enter State" required><br>
	<label>Email :</label>
	<input type="email" name="emailid" class="form-control" placeholder="Enter Email" required><br>
	<label>Phone :</label>
	<input type="number" name="phone" class="form-control" placeholder="Enter Number" required><br>
	<label>SkypeId :</label>
	<input type="text" name="skypeid" class="form-control" placeholder="Enter SkypeID" required><br>
	<center><button type="Submit" name="submit" class="btn btn-danger btn-lg">Submit</button></center>
</div>
</form>
</div>
</body>
</html>