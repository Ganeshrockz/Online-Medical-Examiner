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
	<title>Doctor Main</title>
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
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

/* Change the link color to #111 (black) on hover */
li a:hover {
    background-color: #111;
    text-decoration: none;
    color: white;
}
	.head{
		text-align:center;
		background-color: darkblue;
		color: white;
		position: relative;
		padding-bottom: 15px;
		padding-top: 15px;
	}
</style>
<body>
			<div class="head">
		<h1><strong>ONLINE MEDICAL EXAMINER</strong></h1>
	</div>
	<ul>
		<li><a href="doctorMain.php">My Profile</a></li>
		<li><a href="#">Patients Profile</a></li>
		<li><a href="index.html">Logout</a></li>
		<li style="float: right; color: white; padding-top: 15px; padding-right: 15px;">Hi <?php echo $_SESSION['currentdoctor'];?> </li>		
	</ul>
<?php
			$docname=$_SESSION['currentdoctor'];
			$query="SELECT patientname FROM link where doctorname like '$docname'";
			$rec=mysqli_query($con,$query);
			if(!$rec)
			{
				echo "Error";
			}
?>
<form action="#" method="POST">
		<div style="background-color: lightgrey; border-radius: 20px; margin-right: 200px; margin-left: 200px; padding-bottom: 20px;">
	<div class="form-group" style="margin-top: 10px; margin-left: 200px; margin-right: 200px;">
		<label><strong>Select a patient Name:</strong></label>
	<select id="patient" onchange="call()" class="form-control">
		<option value=""></option>
		<?php
			while($rec1=mysqli_fetch_assoc($rec))
			{
				$name=$rec1['patientname'];
				echo "<option value='$name'>".$rec1['patientname']."</option>";
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
				$_SESSION["selectedPatient"]=$username;
				echo "<pre style=\"margin-top: 10px; margin-left:200px; margin-right: 200px;\">";
				while($rec1=mysqli_fetch_assoc($rec))
				{
					echo "<h3><label><strong>    FirstName   : </strong></label>".$rec1['firstname']."<br>";
					echo "<label><strong>    LastName    : </strong></label>".$rec1['lastname']."<br>";
					echo "<label><strong>    Age         : </strong></label>".$rec1['age']."<br>";
					echo "<label><strong>    Defect      : </strong></label>".$rec1['defect']."<br>";
					echo "<label><strong>    Address     : </strong></label>".$rec1['address']."<br>";
					echo "<label><strong>    City        : </strong></label>".$rec1['city']."<br>";
					echo "<label><strong>    State       : </strong></label>".$rec1['state']."<br>";
					echo "<label><strong>    Email       : </strong></label>".$rec1['email']."<br>";
					echo "<label><strong>    Phone       : </strong></label>".$rec1['phone']."<br>";
					echo "<label><strong>    Username    : </strong></label>".$rec1['username']."<br>";
					echo "<label><strong>    SkypeID     : </strong></label>".$rec1['skypeid']."<br></h3>";
				}

				echo "</pre>";
			}
	}
?>
			<form action="#" method="POST" class="form-group">
			<button name="chat" class="btn btn-success" style="margin-left: 610px;">Chat with Patient</button>
		</form>
			<a href="https://www.skype.com/en/" target="_blank" style="text-decoration: none; background-color: black; color: white; padding-left: 50px; padding-top: 10px; padding-right: 40px; padding-bottom: 10px; margin-left: 600px; border-radius: 20px;">Video Call</a>

			<?php
				$_SESSION['chatdoctor']=" ";
				$_SESSION['chatpatient']=" ";
				if(isset($_POST['chat']))
				{
					$_SESSION['chatdoctor']=$_SESSION['currentdoctor'];
					$_SESSION['chatpatient']=$_SESSION['selectedPatient'];
					$_SESSION['currentPerson']="Doctor";
					echo "<script>document.location = 'chat.php'</script>";
				}
			
			?>
</body>
</html>