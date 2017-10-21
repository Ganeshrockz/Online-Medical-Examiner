<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Patient Main</title>
</head>
<body>
<?php
echo $_SESSION['currentuser'];
?>
</body>
</html>