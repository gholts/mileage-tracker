<?php
/***************************************************************
 * Function:	fillUserArray()
 * Purpose:		Draws forth user information from the rider table in the
 *				database, and puts them in an array.
 * Returns:		Array of users, their first names and last names
 ***************************************************************/
function fillUserArray()
{
	include_once 'databaseConnection.php';
	$rLink = connect();
	$userArray;
	$counter = 0;

	$result = $rLink->query("SELECT user_name, first_name, last_name FROM rider r join mileage m on m.username = r.user_name where mileage is not null");
	
	while($row = $result->fetch_assoc())
	{
		if($row['user_name'] != "")
		{
			$userArray[] = array($row['user_name'], $row['first_name'], $row['last_name']); 
		}
	}
		
	disconnect($rLink);
	
	return $userArray;
}

/***************************************************************
 * Function:	selectRandomUser()
 * Purpose:		Selects a random entry from an array
 * Returns:		An array of users, non-associative (0-n indexes)
 ***************************************************************/
function selectRandomUser($userArray)
{
	return $userArray[rand(0, count($userArray))];
}
?>