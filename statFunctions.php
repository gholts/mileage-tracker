<?php
include "databaseConnection.php";

/************************************************
* Function:		getAll
* Purpose:		[ADD THIS]
* Prams:		$isUser - boolean value for whether person chooses User or Ride
* Returns:		list of users or rides
*************************************************/
function getAll($isUser)
{
	// connect to the DB
	$db = connect();
	// variable to hold database info
	$aResult = array();

	// check to see if they selected User or Ride
	if ($isUser)
	{
		$table = "rider";
	}
	else
	{
		$table = "eventstable";
	}
	
	// query DB
	$aData = $db->query("SELECT * FROM $table");
	
	// while there is data in $aData
	while( $row = $aData->fetch_array(MYSQL_NUM) )
	{
		$aResult[] = $row;
	}
	
	// return result array
	return $aResult;
}

/************************************************
* Function:		getUserStats
* Purpose:		[ADD THIS]
* Prams:		$aUsers - array of users chosen from select box
* Returns:		n/a
*************************************************/
function getUserStats($aUsers)
{
	// connect to the DB
	$db = connect();
	
	// create variables to hold mileage & rider info
	$aMileage = array();
	$aRider = array();
	
	// for each username in $aUsers
	foreach( $aUsers as $key => $rider )
	{		
		// gets all corresponding info from DB tables
		$dbMileage = $db->query("SELECT * FROM mileage WHERE username = '" . $rider . "'");
		$dbRider = $db->query("SELECT * FROM rider WHERE user_name='" . $rider . "'");
		
		// fetch mileage rows
		while( $row = $dbMileage->fetch_array(MYSQL_NUM) )
		{
			$aMileage[] = $row;
		}
		// fetch rider rows
		while( $row = $dbRider->fetch_array(MYSQL_NUM) )
		{
			$aRider[] = $row;
		}
		
		/*
		_______________________________________________________________________________________
	   | 																					   |
	   | At this point, $aMileage and $aRider hold ALL information related to the current      |
	   | user in the foreach loop (users chosen from the select box on the stats.php page.)    |
	   |																					   |
	   | Array is set up as follows:														   |
	   | $aRider[#][0] - username															   |
	   | $aRider[#][1] - first name															   |
	   | $aRider[#][2] - last name															   |
	   |																					   |
	   | $aMileage[#][0] - 																	   |
	   | $aMileage[#][1] - 																	   |
	   | $aMileage[#][2] - 																	   |
	   |																					   |
	   | PARTY ON, DUDES!						   											   |
	   |   ____________________________________________________________________________________|
		\ |
		 \|
		   _,-""`""-~`)
		(`~_,=========\
		 |---,___.-.__,\
		 |        o     \ ___  _,,,,_     _.--.
		  \      `^`    /`_.-"~      `~-;`     \
		   \_      _  .'                 `,     |
			 |`-                           \'__/
			/                      ,_       \  `'-.
		   /    .-""~~--.            `"-,   ;_    /
		  |              \               \  | `""`
		   \__.--'`"-.   /_               |'
					  `"`  `~~~---..,     |
									 \ _.-'`-.
									  \       \
									   '.     /
										 `"~"`
		*/	
		
		// print out user's info
		print "<div id='stats' style='border: 1px solid grey'>";
		// print first & last name
		print "<h2>" . $aRider[$key][1] . " " . $aRider[$key][2] . "</h2>";
		// print username
		print "<p>Username: " . $aRider[$key][0] . "</p>";
		
		// variables to hold event & mileage sums
		$count = 0;
		$miles = 0;
		
		// for each event that $aRider[$key] has taken part in
		foreach( $aMileage as $aMile )
		{
			print "<p>Event Name: " . $aMile[1] . "<br/>";
			print "Mileage: " . $aMile[2] . "<br/>";
			print "Date: " . $aMile[3] . "</p>";
			$count++; // increment event count
			$miles += $aMile[2]; // add miles to total
		}
		
		// table to print num events and total mileage together
		print "<table>";
		print "<tr>";
		print "<td>";
			print "Number of events: " . $count;
		print "</td>";
		print "<td>";
			print "Total mileage: " . $miles;
		print "</td>";
		print "</tr>";
		print "</table>";
		
		print "</div>"; // end div
		print "<br/>"; // break between user divs
		
		// clear $aMileage array
		$aMileage = "";
		
	} // end foreach
}

/************************************************
* Function:		getRideStats
* Purpose:		[ADD THIS]
* Prams:		$aUsers - array of users chosen from select box
* Returns:		n/a
*************************************************/
function getRideStats($aRides)
{
	// connect to the DB
	$db = connect();
	
	// create variables to hold mileage & rider info
	$aMileage = array();
	$aEvents = array();
	
	// for each username in $aUsers
	foreach( $aRides as $key => $ride )
	{		
		// gets all corresponding info from DB tables
		$dbMileage = $db->query("SELECT * FROM mileage WHERE eventName = '" . $ride . "'");
		$dbEvents = $db->query("SELECT * FROM eventstable WHERE eventName='" . $ride . "'");
		
		// fetch mileage rows
		while( $row = $dbMileage->fetch_array(MYSQL_NUM) )
		{
			$aMileage[] = $row;
		}
		// fetch rider rows
		while( $row = $dbEvents->fetch_array(MYSQL_NUM) )
		{
			$aEvents[] = $row;
		}
		
		
		// print out event's info
		print "<div id='stats' style='border: 1px solid grey'>";
		// print event name & date
		print "<h2>" . $aEvents[$key][2] . " " . $aEvents[$key][1] . "</h2>";
		// print description
		print "<p>Description: " . $aEvents[$key][3] . "</p>";
		
		// variables to hold event & mileage sums
		$count = 0;
		$miles = 0;
		
		// for each event that $aRider[$key] has taken part in
		foreach( $aMileage as $aMile )
		{
			print "<p>Username: " . $aMile[0] . "<br/>";
			print "Mileage: " . $aMile[2] . "<br/>";
			$count++; // increment event count
			$miles += $aMile[2]; // add miles to total
		}
		
		// table to print num events and total mileage together
		print "<table>";
		print "<tr>";
		print "<td>";
			print "Number of riders: " . $count;
		print "</td>";
		print "<td>";
			print "Total mileage: " . $miles;
		print "</td>";
		print "</tr>";
		print "</table>";
		
		print "</div>"; // end div
		print "<br/>"; // break between user divs
		
		// clear $aMileage array
		$aMileage = "";
		
		
		
	}
	
	
}

/************************************************
* Function:		statsQuery
* Purpose:		[ADD THIS]
* Prams:		n/a
* Returns:		n/a
*************************************************/
function statsQuery()
{
	// if they choose User from the drop-down box
	if(isset($_REQUEST['selSelectedUsers']))
	{
		// $data holds an array of usernames chosen
		$data = $_REQUEST['selSelectedUsers'];
		
		// get user stats and prints stats to page
		getUserStats($data);
	}
	// if they choose Rides from the drop-down box
	else if( isset($_REQUEST['selSelectedRides']) )
	{
		$rideData = $_REQUEST['selSelectedRides'];
		
		getRideStats($rideData); 
	}
}

/************************************************
* Function:		setTitle
* Purpose:		Prints out page title for statsReport.php based on whether the user chooses
				to generate a User report or a Ride report.
* Prams:		n/a
* Returns:		n/a
*************************************************/
function setTitle()
{
	if (isset($_REQUEST['selSelectedUsers']))
	{
		print 'User Stats';
	}
	else
	{
		print 'Ride Stats';
	}
	
}