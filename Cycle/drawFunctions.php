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

	$result = mysql_query("SELECT * FROM rider");
	
	while($row = mysql_fetch_array($result, MYSQL_NUM))
	{
		$userArray[] = array($row[0], $row[1], $row[2]); 
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