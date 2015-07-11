<html>
<head>
<title>Submit Info to the Database</title>
<script type="text/javascript"> 
var nclose = function()
{
	//window.opener.document.getElementById("sessionControl").value = 'Admin';
	//window.opener.location.reload();
	window.location="ListEvents.php";
}
</script>
</head>
<body>
<div id="submited" name="submited">
The event <?php echo $_POST["eventName"]; ?> has been


<?php
include 'databaseConnection.php';
$link = connect();

	$eventName = $_POST["eventName"];
	//$date = $_POST["date"];
	$day =  $_COOKIE["day"];
	$year = $_COOKIE["year"];
	$month = $_COOKIE["month"] +1;
	$tDate = "$year-$month-$day";
	$description = $_POST["description"];
	$routeID = $_POST['selRoute'];
	#Make sure you concatenate the strings!
	$added = $link->query('insert into eventstable (eventID, eventName, date,description,routeID) values ("NULL",\''.$eventName.
							'\', \''.$tDate.'\',\''.$description.'\','.$routeID.')');
	
	if($added)
	{
		echo "added successfully to the database";
	}  
?>
<br/>
<input id="close" name="close" type="button" value="Close" onclick="nclose()" />
</div>
</body>
</html>
