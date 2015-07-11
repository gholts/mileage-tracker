<?php
include "databaseConnection.php";
include "routeObjects.php";
session_start();

print "<html>";
print "<title>Horizon 100 - Route Admin Page</title>";
print "<head></head>";
print "<body>";
class routeList
{
public $eventsArray;
public $counter = 0;


function listEvents()
	{   

		$rlink =connect();

		$counter =0;	//set counter to 0

		$result = $rlink->query("SELECT * FROM routes"); // make result equal to the result of the query to the database

		
		//gets the rows from the query and turn them into option tags for the select tag
		while($row = $result->fetch_array(MYSQL_NUM))
		{
			
			$tempevent = new route($row[1],$row[2], $row[0]); //creates a new event called tempevent
			$this->eventsArray["$counter"] = $tempevent;	//add the tempevent to the the array of events 
			$name =$this->eventsArray["$counter"]->routeName;	// make name equal to the eventName from the object eventsArray[counter]
			$id =$this->eventsArray["$counter"]->routeID;
			
			print "<option  value= '$name' style='opacity:80%;filter:alpha(opacity=80%)'>"; //create the option tag
			//prints the information from the event to the screen
				printf("%s",$this->eventsArray["$counter"]->routeName);

			print "</option>"; //close the option tag
			
			$counter++; //increment counter
		}
		print "</select></td>";
		// need to fix
		
		print "<script type='text/javascript'>";
		print "var descArray = new Array();";
		print "var idArray = new Array();";
		foreach( $this->eventsArray as $key => $value)
		{
			$temp = $this->eventsArray["$key"]->description;
			print 'descArray[' . $key . '] = "' . $temp . '";';
			
			
			$temp2 = $this->eventsArray["$key"]->routeID;
			print 'idArray[' . $key . '] = "' . $temp2 . '";';
						
		}
		print "</script>	";
		//close the select tag
		disconnect($rlink);
		
		
	}
	

}

	$routeList = new routeList();
	print "<h1>Routes</h1>";
	print "<a href='EventsCal.php'>Back to Event Calendar</a>";
	print "<table class='auto'>";
	print "<tr><td><select id='routes'  size='10' onchange='enable(this)' style='width:200px'>";
	$routeList->listEvents();
	print '<td><textarea id="description" name="description" readonly="readonly" style="height: 170px; width: 200px; resize:none;"></textarea></td></tr>';
	
	
	print "<tr><td><input type='button' id='add' onclick='addRoute()' value='Add'/>";
	print "<input type='button' id='edit' onclick='editRoute()' value='Edit'disabled='disabled' />";
	print "<input type='button' id='delete' onclick='deleteRoute()' value='Delete' disabled='disabled' /></td></tr>";
	print "</table>";		
	 


	 
	 // this is hidden

print "<div id='formSubmit' style='visibility: hidden'>";
	print "<form id='routeForm' name='routeForm' method='post' action='submitRoute.php' />";
	print "<table class='auto'>";
	print "<tr><td>Route Name</td>";
	print "<td><input type='text' name='routeName' id='routeName' /></td></tr>";
	print "<tr><td>Route Description</td>";
	print "<td><textarea name='routeDesc' id='routeDesc' style='height: 100px; width: 290px; resize:none;' ></textarea></td>";
	print "<tr><td><input type='submit' value='Save'/>";
	print "<input type='reset' />";
	print "<input type='button' id='cancel' onclick='cancelRoute()' value='Cancel'</td></tr>";
	print "</table>";
	
	print "<input type='text' name='obSql' id='obSql' style='visibility: hidden'>";
	print "<input type='hidden' name='routeID' id='routeID' />";
	print "</form>";
print "<div>";

?>

<script type="text/javascript" src="scripts\jquery-1.7.1.js" ></script>
<script type="text/javascript" >

var enable = function(listBox)
{
	var index = document.getElementById('routes').selectedIndex;
	
	document.getElementById('description').value =descArray[listBox.selectedIndex];
	document.getElementById('routeName').value =listBox.value;
	document.getElementById('routeDesc').value =descArray[listBox.selectedIndex];
	
	document.getElementById('routeID').value =idArray[listBox.selectedIndex];
	
	if(listBox.selectedIndex > -1)
	{
		document.getElementById('edit').disabled=false;
		document.getElementById('delete').disabled=false;
		document.getElementById('add').disabled=false;
	}
}

var addRoute = function()
{
	var rName = document.getElementById('routeName').value = "";
	var rDesc = document.getElementById('routeDesc').value = "";
	document.getElementById('obSql').value = 1;
	document.getElementById("formSubmit").style.visibility = "visible";
	document.getElementById('add').disabled=true;
}

var editRoute = function()
{
	document.getElementById('obSql').value = 2;
	document.getElementById("formSubmit").style.visibility = "visible";
	document.getElementById('add').disabled=true;
}
var deleteRoute = function()
{
	
	var answer = confirm("Are you sure you want to delete " + document.getElementById('routeName').value + "?");
	//if answer is confirmed in the positive.
	if(answer)
	{

		document.getElementById('obSql').value = 3;
		document.forms[0].submit();
	}
}

var cancelRoute = function()
{
	var rName = document.getElementById('routeName').value = "";
	var rDesc = document.getElementById('routeDesc').value = "";
	document.getElementById("formSubmit").style.visibility = "hidden";
	document.getElementById('add').disabled=false;
}
</script>

</body>
</html>