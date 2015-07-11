<?php
session_start();
?>
<html>
<head>
<title>Horizon 100 - Event List</title>

<script type="text/javascript">
var ndelete = function()	
{

	var index = document.getElementById('events').selectedIndex;
	var select = document.getElementById("events").options[index].value;
	var name = document.getElementById("events").options[index].text;
	//holds an array of the splited values
	var sarray = select.split(":");
	//assign the value from sarray[0] to sdate
	var sdate = sarray[0];
	//assign the value from sarray[1] to sEventName
	var sEventName = sarray[1];

	var answer = confirm("Are you sure you want to delete " + name +"?");
	if(answer)
	{
		window.location="delete.php?sdate=" + sdate + "&eventID=" 
			+ sEventName.split(" ").join("+");
	}
	

}
var edit = function()
{
	var index = document.getElementById('events').selectedIndex;
	window.location = "addEvent.php?index=" + index;
}
var add = function(datePassed)
{
	if(datePassed)
	{
		var answer = confirm("The date you have selected has already passed. Are you sure you want to add an event?");
		if(answer)
		{
			window.location = "addEvent.php?index=-1";
		}
	}
	else
	{
		window.location = "addEvent.php?index=-1";
	}
}
var enable = function(listBox)
{
	
	if(listBox.selectedIndex > -1)
	{
		popDescription(listBox);
		document.getElementById('add_mileage').disabled=false;
		document.getElementById('edit').disabled=false;
		document.getElementById('delete').disabled=false;
	}
}
var nclose = function()
{
	//window.opener.location.reload();
	window.close();
}
var addMileage = function(datePassed)
{
	var nindex = document.getElementById("events").selectedIndex;
	var nselect = document.getElementById("events").options[nindex].value;
	
	//holds an array of the splited values
	var sarray = nselect.split(":");
	//assign the value from sarray[0] to sdate
	var sdate = sarray[0];
	//assign the value from sarray[1] to sEventName
	var sEventID = sarray[1];
	
	var routeID = sarray[2];
	
	if (!datePassed)
	{
		//var answer = confirm("You cannot enter mileage for an event that has yet to occur");
		alert("You cannot enter mileage for an event that has yet to occur");
	}
	else if (routeID == 18)
	{
		alert("This is a non-ride event");
	}
	else
	{
		window.location="AddMileage.php?sdate=" + sdate + "&eventID=" + sEventID;
		// Split and join is necessary to make GET work better
			//.split(" ").join("+")
	}
}
var routePage = function()
{
	window.location = "routeInfo.php";
}

var popDescription = function(listBox)
{
	document.getElementById('description').value =descArray[listBox.selectedIndex];
}
</script>
</head>
<body >
<script type="text/javascript">

</script>
<?php
include_once 'CalendarFunctions.php';
include_once 'databaseConnection.php';

$past = false;
$calender = new calender();

$connect = connect();

$month = $_COOKIE["month"] + 1;

if($month < 10)
{
	$month = '0' . $month;
}

$day = $_COOKIE["day"];

if($day < 10)
{
	$day = '0' . $day;
}

$date = $_COOKIE["year"] . "-" . $month . "-" . $day;

if(strtotime($date) < time())
{
	$past = true;
}
echo "<h2>Events for $date</h2>";

echo "<p>";
	print "<table>";
	print "<td>";
	$calender->listEvents();
	print "</td>";
	print '<td><textarea id="description" name="description" readonly="readonly" style="height: 200px; width: 350px; resize:none;"></textarea></td>';
	print "</table>";
	 echo "</p>";
	 
disconnect($connect);


?>

<div id='footer'>

<?php

if( $_SESSION['control'] == 'Admin' )
	{
	
		print "<input type='button' id='add' onclick='add($past)' value='Add' />";?>
		<input type='button' id='edit' onclick='edit()' value='Edit'disabled="disabled" />
		<input type='button' id='delete' onclick='ndelete()' value='Delete' disabled="disabled" />
		<input type='button' id='add_mileage' onclick='addMileage()' value='Add Mileage' style="display:none" />
	<?php
	}
else if( $_SESSION['control'] == 'User' )
	{

		print "<input type='button' id='add_mileage' onclick='addMileage($past)' value='Add Mileage' disabled='disabled' />";	

	}
	?>
<input type='button' id='Close' onclick='nclose()' value='Close' /> 


</div>
</body>
</html>

