<?php
session_start();
$con=mysqli_connect('localhost','root','ganesh6');
if(!$con)
{
echo  "Not connected to server";
}
if(!mysqli_select_db($con,'ooad'))
{
    echo "Not connected to db";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Main</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<script type="text/javascript">
function call(){
   var dropdown1 = document.getElementById('patient');
   var a = dropdown1.options[dropdown1.selectedIndex].value;
   var textbox = document.getElementById('patientName');
     textbox.value = a;  
   }
</script>
<style type="text/css">
		.head{
		text-align:center;
		background-color: darkblue;
		color: white;
		position: relative;
		padding-bottom: 15px;
		padding-top: 15px;
		display: block;
	}
</style>
<body style="background-color: #CD853F;">
		<div class="head">
		<h2><strong>ONLINE MEDICAL EXAMINER</strong></h2>
	</div>
	<span style="color: darkred;  font-size: 20px;"><center><u>List of Doctors</u></center></span>
	<?php
	$query2="SELECT * FROM doctor";
$rec2=mysqli_query($con,$query2);
if(!$rec2)
{
	echo "error";
}
			else
			{
				echo "<div class=\"table-responsive\">";
				echo "<table class=\"table table-striped\">";
				echo "<tr>";
				echo "<th><strong>FirstName </strong></th>";
				echo "<th><strong>LastName </strong></th>";
				echo "<th><strong>Age </strong></th>";
				echo "<th><strong>Field </strong></th>";
				echo "<th><strong>Address </strong></th>";
				echo "<th><strong>City </strong></th>";
				echo "<th><strong>State </strong></th>";
				echo "<th><strong>Email</strong></th>";
				echo "<th><strong>Phone</strong></th>";
				echo "<th><strong>Username</strong></th>";
				echo "<th><strong>SkypeID</strong></th>";
				echo "</tr>";
				while($rec1=mysqli_fetch_assoc($rec2))
				{
					echo "<tr>";
					echo "<td>".$rec1['firstname']."</td>";
					echo "<td>".$rec1['lastname']."</td>";
					echo "<td>".$rec1['age']."</td>";
					echo "<td>".$rec1['field']."</td>";
					echo "<td>".$rec1['address']."</td>";
					echo "<td>".$rec1['city']."</td>";
					echo "<td>".$rec1['state']."</td>";
					echo "<td>".$rec1['email']."</td>";
					echo "<td>".$rec1['phone']."</td>";
					echo "<td>".$rec1['username']."</td>";
					echo "<td>".$rec1['skypeid']."</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
$query="SELECT username FROM patient where username not in (SELECT patientname from link)";
$rec=mysqli_query($con,$query);
if(!$rec)
{
	echo "error";
}

	?>
<form action="#" method="POST">
	<div style="background-color: lightgrey; border-radius: 20px; margin-right: 200px; margin-left: 200px; padding-bottom: 20px;">
	<div class="form-group" style="margin-top: 100px; margin-left: 200px; margin-right: 200px;">
		<label><strong>Select a patient Name:</strong></label>
	<select id="patient" onchange="call()" class="form-control">
		<option value=""></option>
		<?php
			while($rec1=mysqli_fetch_assoc($rec))
			{
				$name=$rec1['username'];
				echo "<option value='$name'>".$rec1['username']."</option>";
			}
		?>
	</select>
	<input type="text" id="patientName" name="patientName" style="display: none;">
	<button name="submit" style="margin-top: 20px;" class="btn btn-danger form-control">Click</button>
</div>
</div>
</form> 
	<?php

		if(isset($_POST['submit']))
		{
			$username=$_POST['patientName'];
			$query="SELECT * FROM patient where username like '$username'";
			$rec=mysqli_query($con,$query);
			if(!$rec)
			{
				echo "Error";
			}
			else
			{
				echo "<div class=\"well well-lg\" style=\"margin-top: 10px; margin-left:200px; margin-right:200px;\">";
				echo "<pre style=\"color: darkblue font-size: 20px;\">";
				while($rec1=mysqli_fetch_assoc($rec))
				{
					echo "<h3><label><strong>FirstName : </strong></label>".$rec1['firstname']."<br>";
					echo "<label><strong>LastName  : </strong></label>".$rec1['lastname']."<br>";
					echo "<label><strong>Age       : </strong></label>".$rec1['age']."<br>";
					echo "<label><strong>Defect    : </strong></label>".$rec1['defect']."<br>";
					echo "<label><strong>Address   : </strong></label>".$rec1['address']."<br>";
					echo "<label><strong>City      : </strong></label>".$rec1['city']."<br>";
					echo "<label><strong>State     : </strong></label>".$rec1['state']."<br>";
					echo "<label><strong>Email     : </strong></label>".$rec1['email']."<br>";
					echo "<label><strong>Phone     : </strong></label>".$rec1['phone']."<br>";
					echo "<label><strong>Username  : </strong></label>".$rec1['username']."<br>";
					echo "<label><strong>SkypeID   : </strong></label>".$rec1['skypeid']."<br></h3>";
				}
				echo "</pre>";
				echo "</div>";
			}
		}
	?>
	<div class="well well-lg" style="margin-left:200px; margin-top : 10px; margin-right: 200px;">
	<form action=" " method="POST" class="form-group">
	<label>Enter Doctor Name</label>
	<input type="text" name="finaldoc" class="form-control">
	<label>Enter Patient name </label>
	<input type="text" name="finalpat" class="form-control">
	<button name="ssubmit" class="form-control btn btn-danger">Click to Assign</button>
</form>
</div>
</form>

<a href="adminLog.php">Logout</a>
<?php
if(isset($_POST['ssubmit']))
{
	$name1=$_POST['finaldoc'];
	$name2=$_POST['finalpat'];
	$query1="INSERT into link VALUES('$name1','$name2')";
	$rec4=mysqli_query($con,$query1);
	if(!$rec4)
	{
		echo "error";
	}
	else
	{
		        $msg="Successfully Assigned";
        echo "<script type='text/javascript'>alert('$msg');</script>";
	}
}
?>
</div>
</body>
</html>