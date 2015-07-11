<html>
<head>

<title>Horizon 100 - Leaderboard</title>

<script type="text/javascript" src="scripts/jquery-1.7.1.min.js"></script> 

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
}

.tableCenter
{
	text-align: center;
}

table
{
	margin-left: auto;
	margin-right: auto;
}

</style>
</head>



<body>
<script type='text/javascript'>
	//TODO: Make the different levels (Gold, Silver, etc) collapseable.
</script>

<h2 class='tableCenter'>Gold Status</h2>
<div class='tableCenter'>
<table id='tblGold'>

	
	<tr id="header" class="row"> 
		<td>Username</td>
		<td>Mileage</td>
	</tr>
	

	<?php
		include "LeaderboardFunctions.php";
		$leaderboard = new Leaderboard();
		
		$leaderData = $leaderboard->generateLeaderboardData();
		
		$leaderGold = array();
		$leaderSilver = array();
		$leaderBronze = array();
		$leaderElse = array();
		$leaderGoldCount = 0;
		$leaderSilverCount = 0;
		$leaderBronzeCount = 0;
		$leaderElseCount = 0;
		
		for($i = 0; $i < count($leaderData); $i++)
		{
			// set the gold table range
			if($leaderData[$i][1] >= 2500)
			{
				$leaderGold[$leaderGoldCount] = array($leaderData[$i][0], $leaderData[$i][1]);
				$leaderGoldCount++;
			}
			// set the silver table range
			else if($leaderData[$i][1] >= 2000)
			{
				$leaderSilver[$leaderSilverCount] = array($leaderData[$i][0], $leaderData[$i][1]);
				$leaderSilverCount++;
			}
			// set the bronze table range
			else if($leaderData[$i][1] >= 1500)
			{
				$leaderBronze[$leaderBronzeCount] = array($leaderData[$i][0], $leaderData[$i][1]);
				$leaderBronzeCount++;
			}
			// set the everytone else table range
			else
			{
				$leaderElse[$leaderElseCount] = array($leaderData[$i][0], $leaderData[$i][1]);
				$leaderElseCount++;
			}
		}
		
		//creates the gold table
		if( count($leaderGold) > 0 )
		{
			for( $i = 0; $i < count($leaderGold); $i++)
			{
				
				printf("<tr>");
							
				
				printf("<td>".$leaderGold[$i][0]."</td>");
				
				printf("<td>".$leaderData[$i][1]."</td>");
		
					
				
				printf("</tr>");
			}
		}
		else
		{
			printf("<tr>");
				
				
			printf("<td>None</td>");
				
			printf("<td>Yet!</td>");
		
			printf("</tr>");
		}
		
	?>
	

</table>
</div>

<h2 class='tableCenter'>Silver Status</h2>
<div class='tableCenter'>
<table id ="tblSilver">
	
	<tr id="header" class="row"> 
		<td>Username</td>
		<td>Mileage</td>
	</tr>
	

	<?php
		
		//creates silver table 
		if( count($leaderSilver) > 0 )
		{
			for( $i = 0; $i < count($leaderSilver); $i++)
			{
				
				printf("<tr>");
							
				
				printf("<td>".$leaderSilver[$i][0]."</td>");
				
				printf("<td>".$leaderSilver[$i][1]."</td>");
		
					
				
				printf("</tr>");
			}
		}
		else
		{
			printf("<tr>");
				
				
			printf("<td>None</td>");
				
			printf("<td>Yet!</td>");
		
			printf("</tr>");
		}
		
		
	?>
	
</table>

<h2 class='tableCenter'>Bronze Status</h2>
<div class='tableCenter'>
<table id ="tblBronze">
	
	<tr id="header" class="row"> 
		<td>Username</td>
		<td>Mileage</td>
	</tr>
	

	<?php
		
		// creates Bronze table
		if( count($leaderBronze) > 0 )
		{
			for( $i = 0; $i < count($leaderBronze); $i++)
			{
				
				printf("<tr>");
							
				
				printf("<td>".$leaderBronze[$i][0]."</td>");
				
				printf("<td>".$leaderBronze[$i][1]."</td>");
		
					
				
				printf("</tr>");
			}
		}
		else
		{
			printf("<tr>");
				
				
			printf("<td>None</td>");
				
			printf("<td>Yet!</td>");
		
			printf("</tr>");
		}
		
		
	?>
	
</table>

<h2 class='tableCenter'>Also Rans</h2>
<div class='tableCenter'>
<table >
	
	<tr id="header" class="row"> 
		<td>Username</td>
		<td>Mileage</td>
	</tr>
	

	<?
		// creates everyone table
		if( count($leaderElse) > 0 )
		{
			for( $i = 0; $i < count($leaderElse); $i++)
			{
				
				printf("<tr>");
							
				
				printf("<td>".$leaderElse[$i][0]."</td>");
				
				printf("<td>".$leaderElse[$i][1]."</td>");
		
					
				
				printf("</tr>");
			}
		}
		else
		{
			printf("<tr>");
				
				
			printf("<td>None</td>");
				
			printf("<td>Yet!</td>");
		
			printf("</tr>");
		}
			
	?>
	
</table>
</div>

<div id='links'>
	<h3>Links</h3>
	<a href='EventsCal.php'>Event Calendar</a>
	
</div>
</body>

</html>