<html>
<head>
<title> Submit Event to the Database </title>
</head>
<body>
<script type="text/javascript">
	
/***************
* Function nClose
* Purpose reloads the page
****************/
var nClose = function()
{
	//window.opener.document.getElementById('sessionControl').value = 'Admin';
	//reloads the page
	//window.opener.location.reload();
	
	//navigates to List events
	<?php $_SESSION['control'] = 'Admin' ?>
	window.location="ListEvents.php";
}	

<?php fillRouteArray(); ?>

var hideDescription = function()
{
	//document.getElementById("formSubmit").style.visibility = "visible";
	var selRoute = document.getElementById("selRoute");
	var selectedOption = selRoute.options[selRoute.selectedIndex].value;
	
	if(selectedOption == 18)
	{
		document.getElementById("description").value = "";
		document.getElementById("description").readOnly = false;
	}
	else
	{
		document.getElementById("description").value = arrayRoutes[selectedOption];
		document.getElementById("description").readOnly = true;
	}
}
</script>
<?php
// includes databaseConnection file that allows connection to the database
include_once 'databaseConnection.php';


if($_GET["index"] > -1)
{
	$index = $_GET["index"];
	
	//connect to the database
	$connect = connect();
	
	//set year cookie value to day variable
	$day =  $_COOKIE["day"];
	$row;
	
	//set year cookie value to year variable
	$year = $_COOKIE["year"];
	
	//set month cookie value to month variable
	$month = $_COOKIE["month"] +1;
	
	if($day < 10)
	{
		$day = '0' . $day;
	}
	if($month < 10)
	{
		$month = '0' . $month;
	}
	
	//set a temp date variable with the year, month and day variable
	$tDate = "$year-$month-$day";
	
	// query the database for the date
	$result = $connect->query("SELECT * FROM eventstable where date='$tDate'"); 
	
	//loop until i is equal to index
	for($i = 0; $i <=$index;$i++)
	{
		//set row to the location in the array
		$row = $result->fetch_array(MYSQL_NUM);
	}
	
		
?>
<h3>Enter Event to the Calendar</h3>
<form id="evFrm" action=<?php echo "Edit.php?eventid=$row[0]"; ?> method="POST" >
Enter the event name: <input type='text' id='eventName' name='eventName' value='<?php echo $row[2];?>' /> <br />
Event date (YYYY-MM-DD): <input type='text' id='date' name='date' value=<?php echo $row[1];?> /> <br />
Which route are you taking: <select id='selRoute' ><?php addRoutes() ?></select><br />
Enter the events description: <br/><textarea id='description' name='description' style='height: 100px; width: 300px; resize:none;' value='<?php echo $row[3];?>'><?php echo $row[3];?></textarea> <br/>
<input type='submit' value="Edit" />
<input type='button' id='Close' onclick='nClose()' value='Close' />
</form>

<br/>
<?php	
	// disconnect from the database
	disconnect($connect);
}
else
{
	//set year cookie value to day variable
	$day =  $_COOKIE["day"];
	
	//set year cookie value to year variable
	$year = $_COOKIE["year"];
	
	//set month cookie value to month variable
	$month = $_COOKIE["month"] +1;
	if($day < 10)
	{
		$day = '0' . $day;
	}
	if($month < 10)
	{
		$month = '0' . $month;
	}
	
	//set a temp date variable with the year, month and day variable
	$tDate = "$year-$month-$day";
?>
<h3>Enter Event to the Calendar</h3>
<form id="evFrm" action="submit.php" method="POST" >
Enter the event name: <input type='text' id='eventName' name='eventName' /> <br />
 <?php echo "Event date (YYYY-MM-DD): $tDate"?><br />
Which route are you taking: <select id='selRoute' name='selRoute' onchange='hideDescription()'><?php addRoutes(); ?></select><br />
Enter the events description: <br/><textarea id='description' name='description' style='height: 100px; width: 300px; resize:none;'></textarea> <br/>
<input type='submit' value="Add Event"/>

<input type='button' id='Close' onclick='nClose()' value='Close' /> 
</form>

<br/>
<?php
}

function addRoutes()
{
	$link = connect();
	
	$qryResults = $link->query('select routeID, routeName from routes where routeID !=18');
	
	while($row = $qryResults->fetch_assoc())
	{
		echo "<option value=".$row['routeID'].">".$row['routeName']."</option>";
	}
	echo "<option selected='selected' value=18>Non-Ride</option>";
	disconnect($link);
}

/********************************************
 * Function:	fillRouteArray
 * Purpose:		Makes an array with all the route numbers and descriptions
 *				and prints it out as a JavaScript array
 * NOTE:		This function must be called within <script> tags
 ********************************************/
function fillRouteArray()
{
	include_once('databaseConnection.php');
	
	$secondLink = connect();
	
	$qryResults = $secondLink->query('select routeID, routeDescription from routes');
	
	//echo "<script type='text/javascript'>";
	echo "var arrayRoutes = new Array();\n";
	while($row = $qryResults->fetch_assoc())
	{
		echo "arrayRoutes[".$row['routeID']."] = \"".$row['routeDescription']."\";\n";
	}
	//echo "</script>";
	
	disconnect($secondLink);
}
?>
</body>
</html>

