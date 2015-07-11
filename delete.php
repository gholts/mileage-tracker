<html>
<head>
<title>Delete Event in the Database</title>
<script type="text/javascript"> 
/**************
* Function nClose
* Purpose reload the page
****************/
var nClose = function()
{
	
	//window.opener.location.reload();
	window.location="ListEvents.php";
}

</script>
</head>
<body>

<div id="submitted" name="submitted">
<?php
	include 'databaseConnection.php';

	$eventName = getEventName($_GET["eventID"]);

	echo "The event $eventName has been";



	//create link to DB
	$link = connect();
	
	// get event name
	$eventID = $_GET["eventID"];
	
	// get date
	$date = $_GET["sdate"];

	//Make sure you concatenate the strings!
	$deleted = $link->query('delete from eventstable where eventID='.$eventID.' and date = \''.$date.'\'');
	
	
	if($deleted)
	{
		echo " successfully deleted";
	}  
?>
<br/>
<input id="close" name="close" type="button" value="close" onclick="nClose()" />
</div>
</body>
</html>