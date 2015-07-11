<?php
//Unit Testing for Events Functionality
// Done by Graham and Joel

include_once('databaseConnection.php');
include_once('CalendarFunctions.php');

echo '<h2>Events Object Testing</h2>';

testeventObject();

function testeventObject()
{
	$eventObject = new Event("2011-11-11","something","fake description");
	if( $eventObject != null )
	{
		echo "Event's __construct is working successfully <br />";
	}
	testGetDate($eventObject);
	testGetEventName($eventObject);
	testGetDescription($eventObject);
}

function testGetDate($eventObject)
{
	if($eventObject->getDate() == "2011-11-11")
	{
		echo "The function getDate() passed<br />";
	}
	else
	{
		echo "The function getDate() failed<br />";
	}
}

function testGetEventName($eventObject)
{
	if($eventObject->getEventName() == "something")
	{
		echo "  The function getEventName() passed<br />";
	}
	else
	{
		echo "  The function getEventName() failed<br />";
	}
}

function testGetDescription($eventObject)
{
	if($eventObject->getDescription() == "fake description")
	{
		echo "  The function getDescription() passed<br />";
	}
	else
	{
		echo "  The function getDescription() failed<br />";
	}
}

?>