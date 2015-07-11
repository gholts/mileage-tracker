<?php
include_once 'databaseConnection.php';

/*
	Leaderboard class
	Has methods relating to the Leaderboard
	Written mostly by Graham and Nick :)
*/
class Leaderboard
{
	/*
		generateLeaderboardData
		Purpose	This method will query the database and return a 2-dimensional array
				with the data that is returned by the query.
		Params	loRange - The low bound of the query on the database
				hiRange - The high bound of the query on the database
		Returns	resultsReturn - A 2-dimensional array containing the results of the query
	*/
	function generateLeaderboardData()
	{
		// If the loRange variable is less than 0, throw an Exception
		if( $loRange < 0 )
		{
			throw new Exception("Lo range must be 0 or higher");
		}
		// Otherwise if the hiRange is less than the loRange, throw an Exception
		else if ($hiRange < $loRange)
		{
			throw new Exception("Hi range must be higher than the lo range");
		}
		// Otherwise, query the database and perform other operations
		else
		{
			// Make a link to the database
			$link = connect();
			// Query the database based on the parameters passed in
			$resultSet = $link->query("SELECT username, sum(mileage) FROM mileage where mileage group by username order by sum(mileage) desc");
			
			$resultsReturn = array();
			$counter = 0;
			// While there are still rows in the resultSet
			while($currRow = $resultSet->fetch_array(MYSQL_NUM))
				{
					// Makes an array at the current location with the current
					// rows data
					$resultsReturn[$counter] = array( $currRow[0],$currRow[1] );
					$counter++;
				}
			// Disconnect from the database
			$link = disconnect($link);
		}
		// Return the array.
		return $resultsReturn;
		
	}
}
?>