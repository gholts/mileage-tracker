<html>
<head>
<title>Submit Info to the Database</title>
<script type="text/javascript"> 
var nclose = function()
{
	//window.opener.location.reload();
	window.location="routeInfo.php";
}
</script>
</head>
<body>
<div id="submitted" name="submitted">
The route <?php echo $_POST["routeName"]; ?> has been


<?php
//session_start();

include 'databaseConnection.php';
$link = connect();

	$routeName = $_POST["routeName"];
	$description = $_POST["routeDesc"];
	$routeID = $_POST["routeID"]; 
	$task;

	if(isset($_POST['obSql']))
	{
		if($_POST['obSql'] == 2)
		{
		$SQLStatement = $link->query("UPDATE routes SET routeName= '$routeName', routeDescription = '$description' WHERE routeID ='$routeID'");
		$task = ' edited';
		}
		elseif($_POST['obSql'] == 3)
		{
		$SQLStatement = $link->query("DELETE FROM routes WHERE routeID ='$routeID'");
		$task = ' deleted';
		}
		else
		{
		$SQLStatement = $link->query('insert into routes (routeName, routeDescription) values (\''.$routeName.'\',\''.$description.'\')');
		$task = ' added';
		}
	}
	
	print $task;
?>
<br/>
<input id="close" name="close" type="button" value="close" onclick="parent.location='routeInfo.php'" />
</div>
</body>
</html>