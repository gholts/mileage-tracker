<html>
<head>
<title>Edit event in the Database</title>
<script type="text/javascript">
/**************
* Function nClose
* Purpose reload the page
****************/ 
var nClose = function()
{	
	//window.opener.document.getElementById('sessionControl').value = 'Admin';
	//window.opener.location.reload();
	window.location="ListEvents.php";
}
</script>
</head>
<body>
<div id="submited" name="submited">
The event <?php echo $_POST["eventName"]; ?> has been


<?php


//get the event id
$eventid= $_GET["eventid"];

//include the db connection file
include_once 'databaseConnection.php';

//connect to the db
$link = connect();

	//get the event name
	$eventName = $_POST["eventName"];
	
	//get the date
	$date = $_POST["date"];
	
	//get the description
	$description = $_POST["description"];
	
	$routeID = $_POST["selRoute"];
	
	#Make sure you concatenate the strings!
	$added = $link->query('UPDATE eventstable SET eventName=\''.$eventName.'\', date = \''.$date.'\', description = \''.$description.'\', routeID = \''.$routeID.'\''.
	'WHERE eventID=\''.$eventid.'\'');
	
	if($added)
	{
		echo " successfully changed";
	}  
?>
<br/>
<input id="close" name="close" type="button" value="close" onclick="nClose()" />
</div>
</body>
</html>