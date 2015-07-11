<?php
//Unit Testing for Database Connection Functionality
// Done by Graham and Joel

include_once 'databaseConnection.php';
include 'CalendarFunctions.php';

echo '<h2>Database Connection Testing</h2>';
//this page is going to be used to test database functions
testDatabaseConnect();
testDatabaseDisconnect();

//this function tests connection to the database and ensures that the 
//database was properly connected to. 
function testDatabaseConnect()
{
	//connects to the database
	$connect =  connect();
	//test to make sure that the right database was selected
	$selected = mysql_select_db('cycledatabase',$connect);
	if($selected)
	{
		//if connected to the right database print a message saying that the 
		//function pased the test
		echo "  The function connect() passed <br />";
	}
}
function testDatabaseDisconnect()
{
	//connects to the database
	$connect =  connect();
	//disconnect will return true is it was able to disconnect
	$closed = disconnect($connect);
	//test to see if the connection closed
	if(!$closed)
	{
		//if the connection is still connencted then 
		//diplay a message saying it failed 
		echo "  The function disconnect() failed<br />";
	}
	else
	{
		//if the connection is not still connencted then 
		//diplay a message saying it passed 
		echo "  The function disconnect() passed<br />";
	}
}
?>