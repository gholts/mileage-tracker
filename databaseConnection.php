<?php

/****************
* Function dbConnect()
* Purpose creates a connection to the database
*****************/
function connect()
{

// creates a link to the database
$mysqli = new mysqli('127.0.0.1','root','','cycledatabase');

//if the link doesn't exist
if ($mysqli->connect_errno) 
{
	//throw error
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}


return $mysqli;
}

/******************
 * Function getEventName
 * Purpose	Retrieves an eventName using an eventID passed in
 * Params	eventID - ID number of an event
 * Returns	eventName - The name associated with the ID passed in
 ******************/
function getEventName($eventID)
{
	$link = connect();
	$result = $link->query('select eventName from eventstable where eventID='.$eventID);
	while($row = $result->fetch_assoc())
	{
		$eventName = $row['eventName'];
	}
	return $eventName;
}

/******************
* Function dbDisconnect
* Purpose disconnects from the database
**********************/
function disconnect($rLink)
{
	$rLink->close();
}
?>