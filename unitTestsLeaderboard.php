
<?php
//Unit Testing for Leaderboard Functionality
// Done by Graham and Nick

include "LeaderboardFunctions.php";

$testLeaderData = new Leaderboard();

// If we pass in 1500 as a lo range and 2000 as a hi range, generateLeaderboardData
// should return a multi-dimensional array with two elements (with two elements in each)
// based on our dummy data
$arrayLeaderData = $testLeaderData->generateLeaderboardData(1500, 2000);

if (count($arrayLeaderData) == 2)
{
	printf("Test successful");
}
else
{
	printf("Test failed");
}

printf("<br />");

// If we pass in 0 as a lo range and 500 as a hi range, generateLeaderboardData
// should return a multi-dimensional array with zero elements in it
// based on our dummy data
$arrayLeaderData = $testLeaderData->generateLeaderboardData(0, 500);

if (count($arrayLeaderData) == 0)
{
	printf("Test successful");
}
else
{
	printf("Test failed");
}

printf("<br />");

// If we pass in a number that is lower than 0 for a lo range, it should throw
// an Exception
try
{
	$arrayLeaderData = $testLeaderData->generateLeaderboardData(-1, 500);
}
catch (Exception $e)
{
	printf("Caught an exception: " . $e->getMessage() );
}

printf("<br />");

// If we pass in a hi range that is less than the lo range, it should throw an Exception
try
{
	$arrayLeaderData = $testLeaderData->generateLeaderboardData(1000, 500);
}
catch (Exception $e)
{
	printf("Caught an exception: " . $e->getMessage() );
}

?>