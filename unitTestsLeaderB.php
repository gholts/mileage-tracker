<?php
//Unit Testing for Leaderboard Functionality
// Done by Graham and Joel

include "LeaderboardFunctions.php";
echo '<h2>Leaderboard Testing</h2>';

$leaderBoard = new Leaderboard();

$leaderData = $leaderBoard->generateLeaderboardData();
if(count($leaderData) > 0)
{
	echo "generateLeaderboardData() returned " . count($leaderData)
		. " elements<br />";
	echo "generateLeaderboardData() passed<br />";
}

$leader50 = $leaderBoard->separateByRange($leaderData, 0, 50);
if(count($leader50) == 2)
{
	//According to our current sample data, there are two users with mileage
	// between 0 and 50, so this should succeed.
	echo "separateByRange() is successful<br />";
}

// If we pass in a hi range that is less than the lo range, it should throw an Exception
try
{
	$leader50 = $leaderBoard->separateByRange($leaderData, 500, 50);
}
catch (Exception $e)
{
	echo $e->getMessage() . "<br />";
	echo "separateByRange()'s range check is successful<br />";
}

// If we pass in a number that is lower than 0 for a lo range, it should throw
// an Exception
try
{
	$arrayLeaderData = $leaderBoard->separateByRange($leaderData, -1, 500);
}
catch (Exception $e)
{
	echo "Caught an exception: " . $e->getMessage() . "<br />";
	echo "separateByRange()'s range check is successful<br />";
}
?>