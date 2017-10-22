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
	<title>Patient Main</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
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
		<li><a href="patientMain.php">My Profile</a></li>
		<li><a href="docProf.php">Doctor Profile</a></li>
		<li><a href="index.html">Logout</a></li>
		<li style="float: right; color: white; padding-top: 15px; padding-right: 15px;">Hi <?php echo $_SESSION['currentpatient'];?> </li>		
	</ul>
<?php
			$patname=$_SESSION['currentpatient'];
			$query="SELECT doctorname FROM link where patientname like '$patname'";
			$rec=mysqli_query($con,$query);
			if(!$rec)
			{
				echo "Error";
			}
			else
			{
				echo "<pre>";
				$data=mysqli_fetch_assoc($rec);
				$record=$data['doctorname'];
				$query2="SELECT * FROM doctor where username like '$record'";
				$execute=mysqli_query($con,$query2);
				while($rec1=mysqli_fetch_assoc($execute))
				{
					echo "<h3><label><strong>    FirstName    : </strong></label>".$rec1['firstname']."<br>";
					echo "<label><strong>    LastName     : </strong></label>".$rec1['lastname']."<br>";
					echo "<label><strong>    Age          : </strong></label>".$rec1['age']."<br>";
					echo "<label><strong>    Field        : </strong></label>".$rec1['field']."<br>";
					echo "<label><strong>    Address      : </strong></label>".$rec1['address']."<br>";
					echo "<label><strong>    City         : </strong></label>".$rec1['city']."<br>";
					echo "<label><strong>    State        : </strong></label>".$rec1['state']."<br>";
					echo "<label><strong>    Email        : </strong></label>".$rec1['email']."<br>";
					echo "<label><strong>    Phone        : </strong></label>".$rec1['phone']."<br>";
					echo "<label><strong>    Username     : </strong></label>".$rec1['username']."<br>";
					echo "<label><strong>    SkypeID      : </strong></label>".$rec1['skypeid']."<br></h3>";

				}

				echo "</pre>";
			}
			?>
			<form action="#" method="POST" class="form-group">
			<button name="chat" class="btn btn-success" style="margin-left: 610px;">Chat with Patient</button>
		</form>
			<a href="https://www.skype.com/en/" target="_blank" style="text-decoration: none; background-color: black; color: white; padding-left: 50px; padding-top: 10px; padding-right: 40px; padding-bottom: 10px; margin-left: 600px; border-radius: 20px;">Video Call</a>

			<?php
				$query="SELECT * from timings where doctorname like '$record'";
				$rec=mysqli_query($con,$query);
				$rec2=mysqli_fetch_assoc($rec);
				echo "<br><br><center><strong>Doctor available Timings : ".$rec2['timing']."</center></strong>";
			?>
			<?php
				$_SESSION['chatdoctor']=" ";
				$_SESSION['chatpatient']=" ";
				if(isset($_POST['chat']))
				{
					$_SESSION['chatdoctor']=$record;
					$_SESSION['chatpatient']=$_SESSION['currentpatient'];
					$_SESSION['currentPerson']="Patient";
					echo "<script>document.location = 'chat.php'</script>";
				}
			?>
</body>
</html>