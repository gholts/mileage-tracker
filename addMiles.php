<?php
session_start();
echo "<!-- " . $_SESSION['control'] . " -->";
?>
<html>
<head>
<title>Submit Info to the Database</title>
<script type="text/javascript"> 
/***************
* Function nClose
* Purpose reloads the page
****************/
var nClose = function()
{
	//reloads the page
	//window.opener.location.reload();
	
	//navigates to List events
	window.location = "ListEvents.php";
}
</script>
</head>
<body>
<div id="submitted" name="submitted">


<?php

	foreach ( $_SESSION as $sKey=>$sElem)
	{
		//echo "$sKey as $sElem";
	}
	//print $_SESSION['control'];
	// includes mileage functions file
	include_once 'MileageFunctions.php';
	
	//creates a new instance of the mileage 
	$mileAdder = new Mileage();
	
	// gets the username
	$userName = $_POST["selUser"];
	//echo $userName;
	
	// gets the users mileage
	$mileage = $_POST["txtMiles"];
	
	// gets the event name
	$eventName = $_POST["txtEventName"];
	//echo $eventName;
	
	// gets the date of the 
	$ndate = $_POST["txtDate"];
	
	try
	{
		$mileAdder->addMileage($userName, $mileage,$eventName,$ndate);
		echo "<br />$mileage miles have been added to $userName's total<br />";
	}
	catch(Exception $e)
	{
		echo "Negative mileage not allowed";
	}
	
	
?>

<br/>
<input id="close" name="close" type="button" value="Close" onclick="nClose()" />
</div>
</body>
</html>

