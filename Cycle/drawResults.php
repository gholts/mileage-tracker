<?php
session_start();
	if(isset($_SESSION['winner']))
	{
		setcookie("winner", "$winner[1] $winner[2] a.k.a. $winner[0]", time()*3600*24*30);
	}
?>
<html>
<head>
<title>Draw Results</title>
<body>

<form name='frmDraw' id='frmDraw' method='POST' action='drawResults.php'>

	Wanna do a draw? <input type='text' id='txtDraw' name='txtDraw' value='Enter anything...' />
	<input type='submit' value='Do a draw!' />

</form>
<?php
include_once('drawFunctions.php');
if(isset($_REQUEST['txtDraw']))
{
	$userArray = fillUserArray();

	echo '<h3> And the winner is...</h3>';

	$winner = selectRandomUser($userArray);

	
	
	echo "<h1>$winner[1] $winner[2] a.k.a. $winner[0]</h1>";
}
else if(isset($_COOKIE['winner']))
{
	echo '<h3>The winner of the last draw was...</h3>';
	echo "<h1>".$_COOKIE['winner'][0] . " " . $_COOKIE['winner'][1] . " a.k.a. " . $_COOKIE['winner'][2] . "</h1>";
}
?>


</body>
</html>