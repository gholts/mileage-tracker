<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<script type="text/javascript" src="scripts/cookie.js"></script> 
<script type="text/javascript"> 

//creating a new date
ndate = new Date();

<?php
if(isset($_REQUEST['sessionControl']))
{
	$_SESSION['control'] = $_REQUEST['sessionControl'];
}
else
{
	$_SESSION['control'] = 'Visitor';
}
//A little teste
//echo "<!-- " . $_SESSION['control'] . " -->";
?>

/**************
* Function openEventPopup
* Purpose Opens up the pop up for adding,editing and deleting events
**************/
var openEventPopup = function(day)
{
	//set the day cookie
	setCookie("day", day);
	
	//open up the popup window with the session variable passed in
	var load = window.open('ListEvents.php','eventName',
	'width=780,height=500,resizable=no,toolbar=no,menubar=no,location=no, status=no');
	 
	//if the window is closed
	if(load.closed)
	{
		//reload that page
		window.location.reload();
	}
}

/**************
* Function changeMN
* Purpose change the month to the next month
***************/
var changeMN = function()
{
	//set the next month to 1
	var nextMonth = 1;
	
	ndate.setMonth(ndate.getMonth()+nextMonth);
	//set the month cookie to the new month
	setCookie("month",ndate.getMonth());
	
	//set the year cookie to the new year
	setCookie("year", 2012);
	
	//reload the window
	window.location.reload();
}

/**************
* Function changeMP
* Purpose change the month to the previous month
***************/
var changeMP = function()
{
	// set the next month to 1
	var nextMonth = 1;
	
	//set the month for ndate to the previous month
	ndate.setMonth(ndate.getMonth()-nextMonth);
	
	//set the month cookie to the new month
	setCookie("month",ndate.getMonth());
	
	//set the year to the new year
	setCookie("year", ndate.getFullYear());
	
	//reload the page
	window.location.reload();
}

/************************
* Function highlightEvents
* Purpose highlights the days with the
* 		  new events
*************************/
var highlightEvents = function()
{
	var aARefs = document.getElementsByTagName("td");
	for( var i = 0, arrLen = aARefs.length; i < arrLen; i++ )
	{
		var sInnerHTML = aARefs[i].innerHTML;
		if( sInnerHTML.search(/event/) != -1 )
		{
			aARefs[i].style.backgroundColor = '#FFFF00';
			aARefs[i].style.filter = "alpha(opacity:80)";
		}
	}
}

/**************
* Function setAdmin
* Purpose set the session variable to Admin
****************/
var setAdmin = function()
{
	//window.location.replace("eventscal.php?control=Admin");
	document.getElementById('sessionControl').value = 'Admin';
	document.forms[0].submit();
	
}

/**************
* Function setUser
* Purpose set the session variable to User
****************/
var setUser = function()
{
	//window.location.replace("eventscal.php?control=User");
	document.getElementById('sessionControl').value = 'User';
	document.forms[0].submit();
	
}

</script>
<title>Horizon 100 - Calendar</title>



</head>


<body onload='highlightEvents()'  
	style=' background: url(images/logoBack.png);  background-repeat:no-repeat; background-position:10px 200px; '>
<?php
if($_COOKIE["month"] == "" || $_COOKIE["year"] == ""  )
{
?>
<script type="text/javascript" >
setCookie("month",ndate.getMonth());
setCookie("year",ndate.getFullYear());
</script> 
<?php 
}
else
{
?>
<script type="text/javascript" >
ndate.setMonth(getCookie("month"));
ndate.setYear(getCookie("year"));
</script> 
<?php
}
include 'CalendarFunctions.php';
$calender = new calender();
$calender->createCalender();

 ?>
<h3>Links</h3>
<a href="leaderboard.php">Go to the Leaderboard</a> <br />
<a href="routeinfo.php">Go to Route Info Admin Page</a> <br />
<a href="stats.php">Go to Stats Report Page</a> <br />
<a href="drawResults.php">Go to Draw Results Page</a> <br /> <br />
<input type='button' id='setAdmin' name='setAdmin' onclick='setAdmin()' value='Set Control to Admin' />
<input type='button' id='setUser' name='setUser' onclick='setUser()' value='Set Control to User' />
<form id='frmSession' action='EventsCal.php' method='POST'>
	<input type='hidden' name='sessionControl' id='sessionControl' value='' />
</form>
</body>

</html>

