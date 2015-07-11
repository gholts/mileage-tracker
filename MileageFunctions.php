<?php
include_once 'databaseConnection.php';
session_start();
/*
	Mileage class
	Has methods relating to adding mileage, possibly removing mileage (TODO)
*/
class Mileage
{
	function __construct()
	{
		//does nothing
	}

	function addMileage( $username, $milesToAdd, $eventID, $nDate)
	{
		if ( $milesToAdd < 0 )
		{
			throw new Exception("Miles to be added cannot be less than zero");
		}
		
		$link = connect();
		
		
		//echo "$userName, $milesToAdd,$eventName,$ndate";
		//$resultSet = mysql_query("SELECT mileage FROM userStats where userName = '".$userName."'");
		
		//if( $resultSet != false )
		//{
			//$dbMiles = mysql_result($resultSet,0);
			//$currentMileage = $dbMiles + $milesToAdd;
			//echo "<br />$username $milesToAdd " . $row['eventID'] . " $nDate";
			
			//echo "UPDATE userstats set mileage = " .$currentMileage. " where userName = '".$userName."'";
			$link->query('insert into mileage values (\''.$username.'\','.$eventID.', '.$milesToAdd.',\''.$nDate.'\')');
			//("INSERT INTO mileage VALUES( '" . $userID . "');
		//}
		disconnect($link);
	}
	
	function getMileage( $userName )
	{
		$link = connect();
		$toReturn = null;
		$resultSet = $link->query('select sum ( mileage ) from mileage where user_name = \"'.$userName.'\"');
		
		if ( mysql_num_rows($resultSet) )
		{
			echo "Username does not exist";
		}
		else
		{
			$currRow = $resultSet->fetch_array(MYSQL_NUM);
			$toReturn = $currRow[0];
			echo $toReturn;
		}
	}

}