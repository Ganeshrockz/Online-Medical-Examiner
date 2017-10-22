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
$docname=$_SESSION["chatdoctor"];
$patname=$_SESSION["chatpatient"];
	$query="SELECT * FROM chat where doctorname like '$docname' and patientname like '$patname'";
	$records=mysqli_query($con,$query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>CHAT</title>
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	.sender .well-sm{
		margin-left: 75%;
	}
	.well-lg{
		background-color: white;
	}
	.receiver .well-sm{
		margin-right: 75%;
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
	<div class="container">
		<div class="well well-lg" style="margin-top: 20px;">
			<?php
				if(mysqli_num_rows($records)==0)
				{
					echo "<h2>Type message to start conversation.....</h2>";
				}
				else
				{
				while($rec=mysqli_fetch_assoc($records))
				{
					if($_SESSION['currentPerson']=="Patient")
					{
						if($rec['sender']=="Patient")
						{
							echo "<div class=\"sender\">";
							echo "<div class=\"well well-sm\">";
							echo "<h4>".$rec['message']."</h4>";
							echo "</div>";
							echo "</div>";
						}
						else if($rec['sender']=="Doctor")
						{
							echo "<div class=\"receiver\">";
							echo "<div class=\"well well-sm \">";
							echo "<h4>".$rec['message']."</h4>";
							echo "</div>";
						echo "</div>";
						}
					}
					else 
						{
						if($rec['sender']=="Patient")
						{
							echo "<div class=\"receiver\">";
							echo "<div class=\"well well-sm\">";
							echo "<h4>".$rec['message']."</h4>";
							echo "</div>";
						echo "</div>";
						}
						else
						{
							echo "<div class=\"sender\">";
							echo "<div class=\"well well-sm\">";
							echo "<h4>".$rec['message']."</h4>";
							echo "</div>";
						echo "</div>";
						}
				}
				}
}
			?>
		</div>
	</div>
	<form method="POST" action="#"  style="margin-left:200px; margin-right: 200px;">
	<input type="text" name="chatbox" placeholder="Type Message Here....." class="form-control">
	<button class="btn btn-danger form-control" name="msgbtn">Send</button>
	<button class="btn btn-success form-control" name="close">Back</button>
</form>
	<?php
		if(isset($_POST['msgbtn']))
		{
			$msg=$_POST['chatbox'];
			if($_SESSION['currentPerson']=="Patient")
			{
				$sender="Patient";
			}
			else if($_SESSION['currentPerson']=="Doctor")
			{
				$sender="Doctor";
			}
			$date1 = date('Y-m-d H:i:s');
			$query="INSERT INTO chat values('$docname','$patname','$msg','$date1','$sender')";
			$rec=mysqli_query($con,$query);
			if(!$rec)
			{
				echo "error";
			}
			echo "<script>document.location = 'chat.php'</script>";
		}
		if(isset($_POST['close']))
		{
			if($_SESSION['currentPerson']=="Patient")
			{
			echo "<script>document.location = 'patientMain.php'</script>";
			}
			else
			{
			echo "<script>document.location = 'doctorMain.php'</script>";
			}
		}
	?>
</form>
</body>
</html>