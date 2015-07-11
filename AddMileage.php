<?php
include_once 'databaseConnection.php';
session_start();
echo "<!-- " . $_SESSION['control'] . " -->";
?>
<html>
<head>
<title>Add Mileage for a User</title>

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

	var addMileage = function()
	{
		//window.open('addMiles.php');
	}
</script>
</head>
<body>
<?php
	$eventID = $_REQUEST['eventID'];
	$date = $_REQUEST['sdate'];
	$eventName = "";
	$link = connect();
	$result = $link->query('select eventName from eventstable where eventID='.$eventID);
	while($row = $result->fetch_assoc())
	{
		$eventName = $row['eventName'];
	}
?>
<form id='frmAdd' METHOD="post" action="addMiles.php" >
	Username: <select id='selUser' name='selUser'><?php echo addUsers(); ?></select><br />
	Kilometers to add: <select type='' id='txtMiles' name='txtMiles' />
						<option value="50">50</option>
						<option value="100">100</option>	
						</select><br />
	Event name: <?php echo $eventName; ?> <input type='hidden' id='txtEventName' name='txtEventName'
				value='<?php echo $_REQUEST['eventID']; ?>' /><br />
	Date: <?php echo $date; ?> 
	<input type='hidden' id='txtDate' name='txtDate' value='<?php echo $date; ?>' /><br />
	<input type='submit'/>
	<input id="close" name="close" type="button" value="Close" onclick="nClose()" />
</form>
</body>
</html>

<?php
	/*********************************************
	* Function	addUsers()
	* Purpose	Adds all the users in the database to the list of users that can be selected
	*			to add mileage to.
	* NOTE:		This can be moved somewhere else in the future
	**********************************************/
	function addUsers()
	{
		include_once 'databaseConnection.php';
		
		$handle = connect();
		
		$query = 'select user_name from rider';
		
		$queryResult = $handle->query($query);
		
		while( $row = $queryResult->fetch_assoc() )
		{
			echo '<option value='.$row['user_name'].'>'.$row['user_name'].'</option>';
		}
		
		
		disconnect($handle);
		
	}
?>