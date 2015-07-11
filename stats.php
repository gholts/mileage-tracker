<html>
<head>
<title>Horizon 100 - Stats Report</title>
<script type="text/javascript"> 
var selectIndex;
var moveItems = function(isAdded)
{
	var frmToRemove, frmToAdd;
	if (isAdded)
	{
		frmToRemove = 1;
		frmToAdd = 2;
	}
	else
	{
		frmToRemove = 2;
		frmToAdd = 1;
	}
	
	var list = document.getElementsByTagName("select")[frmToRemove];
	var adding = document.getElementsByTagName("select")[frmToAdd];
	var selectedVal = list.selectedIndex;
	var opValue = list.options.item(selectedVal);
	adding.add(opValue);
	sortItems(adding);
}

var sortItems = function(listbox)
{
	var arrtxt = new Array();
	var arrvalue = new Array();
	
	for(i=0;i<listbox.length;i++)
	{
		arrtxt[i] = listbox.options[i].text;
		arrvalue[i] = listbox.options[i].value;
	}
	arrtxt.sort();
	arrvalue.sort();
	for(i=0;i<listbox.length;i++)
	{
		listbox.options[i].text = arrtxt[i];
		listbox.options[i].value = arrvalue[i];
		
	}
	
}
var selectAll = function(isSelected)
{
	var listbox = document.getElementById("selSUsers");
	
	if(isSelected)
	{
		selectIndex = listbox.selectedIndex;
		for(i = 0; i < listbox.options.length; i++)
		{
			listbox.options[i].selected = isSelected;
		}
	}
	else
	{
		listbox.selectedIndex = selectIndex ;
	}
}

</script>

</head>
<body>
<div id='Combo' name='Combo'>
<form name='frmOptions' id='frmOptions' method='POST' action='stats.php'>
<select name='selOptions' id='selOptions' >
	<option value="">Select...</option> 
	<option value="optUser">Users</option>
	<option value="optRide">Ride</option>
</select>
<input type='submit' value='Search' />
</form>
</div>


<?php
include "statFunctions.php";
if(isset($_REQUEST['selOptions']))
{
	if ($_REQUEST['selOptions'] == 'optUser')
	{
		$allUsers = getAll(true);
		echo "<form name='frmUsers' id ='frmUsers' method='GET' action='statsReport.php'>
		<select name='selAllUsers[]' id='selAllUsers' size='12' style='width:150px'>";
		foreach($allUsers as $user)
		{
			echo"<option value='" . $user[0] . "' id='resultsCriteria' name='resultsCriteria'>" . $user[0] . "</option>";
		}
		echo"</select>";
		echo"<input type='button' onclick='moveItems(true)' id='add' name='add' value='-->' style='position:absolute; left:165px; top:120px; '>" .
		"<input type='button' onclick='moveItems(false)' id='remove' name='remove' value='<--'  style='position:absolute; left:165px; top:150px; '>";
		
		echo"<select name='selSelectedUsers[]' id='selSelectedUsers' size='12' style='position:relative;width:150px;left:50px' multiple='multiple'>" .
		"</select>";
		echo "<br> <input type='submit' value='Submit Query' style='position:relative;left:125px'/>";
		
		echo"</form>";
	
	}
	else if ($_REQUEST['selOptions'] == 'optRide')
	{
		$allRides = getAll(false);
		echo "<form name='frmRides' id ='frmRides' method='GET' action='statsReport.php'>
		<select name='selAllRides' id='selAllRides' size='12' style='width:150px'>";
		foreach($allRides as $ride)
		{
			echo"<option value='" . $ride[1] . "' id='resultsCriteria' name='resultsCriteria'>" .  $ride[2] . "</option>";
		}
		echo"</select>";
		echo"<input type='button' onclick='moveItems(true)' id='add' name='add' value='-->' style='position:absolute; left:165px; top:120px;" .
		" '><input type='button' onclick='moveItems(false)' id='remove' name='remove' value='<--'  style='position:absolute; left:165px; top:150px; '>";
		
		echo"<select name='selSelectedRides[]' id='selSelectedRides' size='12' style='position:relative;width:150px;left:50px' multiple='true'>" .
		"</select>";
		echo "<br> <input type='submit' value='Submit Query' style='position:relative;left:125px'/>";
		
		echo"</form>";
	
	}
	else
	{
		echo "Please select an option.";
	}	
}
?>


</body>
</html>