<html>
<head>
<title>Leaderboard</title>
<style type="text/css">

#header
{
	font-weight: 700;
	font-variant: small-caps;
}

td
{
	text-align: center;
	padding-left: 25px;
	padding-right: 25px;
	padding-top: 5px;
	padding-bottom: 5px;
	border: 1px solid black;
}

#tblGold
{
	border:7px solid gold;
	margin-left: auto;
	margin-right: auto;
}

#tblSilver
{
	border:7px solid silver;
}

#tblBronze
{
	border: 7px solid #8C7853;
	<!--#BA5500-->
}

.tableCenter
{
	margin-left: auto;
	margin-right: auto;
	text-align: center;
}

</style>
</head>



<body>

<h2 class='tableCenter'>Gold Status</h2>
<div class='tableCenter'>
<table id='tblGold'>

	
	<tr id="header" class="row"> 
		<td>Rank</td>
		<td>Username</td>
		<td>Mileage</td>
	</tr>
	

	<?php
		include "LeaderboardFunctions.php";
		$leaderboard = new Leaderboard();
		
		//if 
		
		$leaderData = $leaderboard->generateLeaderboardData(2000, 99999999);
		
		$counter = 1;
		for( $i = 0; $i < count($leaderData); $i++)
		{
			//printf("$i");
			//for ( $j = 0; $j < 
			
			printf("<tr>");
			
			printf("<td>$counter</td>");
			
			
			printf("<td>".$leaderData[$i][0]."</td>");
			
			printf("<td>".$leaderData[$i][1]."</td>");
	
				
			
			$counter++;
			printf("</tr>");
		}
		
		
	?>
	

</table>
</div>

<h2 class='tableCenter'>Silver Status</h2>
<div class='tableCenter'>
<table id ="tblSilver">
	
	<tr id="header" class="row"> 
		<td>Rank</td>
		<td>Username</td>
		<td>Mileage</td>
	</tr>
	

	<?php
		
		$leaderData = $leaderboard->generateLeaderboardData(1500, 1999);
		
		
		for( $i = 0; $i < count($leaderData); $i++)
		{
			//printf("$i");
			//for ( $j = 0; $j < 
			
			printf("<tr>");
			
			printf("<td>$counter</td>");
			
			
			printf("<td>".$leaderData[$i][0]."</td>");
			
			printf("<td>".$leaderData[$i][1]."</td>");
	
				
			
			$counter++;
			printf("</tr>");
		}
		
		
	?>
	
</table>

<h2 class='tableCenter'>Bronze Status</h2>
<div class='tableCenter'>
<table id ="tblBronze">
	
	<tr id="header" class="row"> 
		<td>Rank</td>
		<td>Username</td>
		<td>Mileage</td>
	</tr>
	

	<?php
		
		$leaderData = $leaderboard->generateLeaderboardData(1000, 1499);
		
		
		for( $i = 0; $i < count($leaderData); $i++)
		{
			//printf("$i");
			//for ( $j = 0; $j < 
			
			printf("<tr>");
			
			printf("<td>$counter</td>");
			
			
			printf("<td>".$leaderData[$i][0]."</td>");
			
			printf("<td>".$leaderData[$i][1]."</td>");
	
				
			
			$counter++;
			printf("</tr>");
		}
		
		
	?>
	
</table>

<h2 class='tableCenter'>Everyone Else</h2>
<div class='tableCenter'>
<table >
	
	<tr id="header" class="row"> 
		<td>Rank</td>
		<td>Username</td>
		<td>Mileage</td>
	</tr>
	

	<?
	
		$leaderData = $leaderboard->generateLeaderboardData(0, 999);
		
		
		for( $i = 0; $i < count($leaderData); $i++)
		{
			//printf("$i");
			//for ( $j = 0; $j < 
			
			printf("<tr>");
			
			printf("<td>$counter</td>");
			
			
			printf("<td>".$leaderData[$i][0]."</td>");
			
			printf("<td>".$leaderData[$i][1]."</td>");
	
				
			
			$counter++;
			printf("</tr>");
		}
			
	?>
	
</table>
</div>
</body>

</html>