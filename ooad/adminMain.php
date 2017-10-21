<?php
session_start();
echo $_SESSION['adminName'];
$con=mysqli_connect('localhost','root','ganesh6');
if(!$con)
{
echo  "Not connected to server";
}
if(!mysqli_select_db($con,'ooad'))
{
    echo "Not connected to db";
}
$query2="SELECT * FROM doctor";
$rec2=mysqli_query($con,$query2);
if(!$rec2)
{
	echo "error";
}
			else
			{
				echo "<table>";
				echo "<tr>";
				echo "</th><strong>FirstName </strong></th>";
				echo "</th><strong>LastName </strong></th>";
				echo "</th><strong>Age </strong></th>";
				echo "</th><strong>Field </strong></th>";
				echo "</th><strong>Address </strong></th>";
				echo "</th><strong>City </strong></th>";
				echo "</th><strong>State </strong></th>";
				echo "</th><strong>Email</strong></th>";
				echo "</th><strong>Phone</strong></th>";
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
					echo "</tr>";
				}
				echo "</table>";
			}
$query="SELECT username FROM patient";
$rec=mysqli_query($con,$query);
if(!$rec)
{
	echo "error";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Main</title>
</head>
<script type="text/javascript">
function call(){
   var dropdown1 = document.getElementById('patient');
   var a = dropdown1.options[dropdown1.selectedIndex].value;
   var textbox = document.getElementById('patientName');
     textbox.value = a;  
   }
</script>
<body>
<form action="#" method="POST">
	<select id="patient" onchange="call()">
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
	<button name="submit">Click</button>
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
				echo "<p>";
				while($rec1=mysqli_fetch_assoc($rec))
				{
					echo "<label><strong>FirstName : </strong></label>".$rec1['firstname']."<br>";
					echo "<label><strong>LastName : </strong></label>".$rec1['lastname']."<br>";
					echo "<label><strong>Age : </strong></label>".$rec1['age']."<br>";
					echo "<label><strong>Defect : </strong></label>".$rec1['defect']."<br>";
					echo "<label><strong>Address : </strong></label>".$rec1['address']."<br>";
					echo "<label><strong>City : </strong></label>".$rec1['city']."<br>";
					echo "<label><strong>State : </strong></label>".$rec1['state']."<br>";
					echo "<label><strong>Email : </strong></label>".$rec1['email']."<br>";
					echo "<label><strong>Phone : </strong></label>".$rec1['phone']."<br>";
				}
				echo "</p>";
			}
		}
	?>
	<form action=" " method="POST">
	<label>Enter Doctor Name</label>
	<input type="text" name="finaldoc">
	<label>Enter Patient name </label>
	<input type="text" name="finalpat">
	<button name="ssubmit">Click to Assign</button>
</form>
<?php
if(isset($_POST['ssubmit']))
{
	$name1=$_POST['finaldoc'];
	$name2=$_POST['finalpat'];
	$query1="INSERT into link VALUES('$name1','$name2');"
	$rec3=mysqli_query($con,$query1);
	if(!$rec3)
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
</body>
</html>