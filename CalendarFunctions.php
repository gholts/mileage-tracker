<?php
include_once 'databaseConnection.php';
include 'EventObjects.php';
class Calender
{


	public $month;
	public $eventsArray ;
	private $counter = 0;
	
	//this funtion is used by the listEvents page to generate a list box
	function listEvents()
	{
		$link = connect();
		
		$counter =0;	//set counter to 0
		$day =  $_COOKIE["day"]; //set day to the value returned from $_COOKIE["day"]
		$year = $_COOKIE["year"]; //set year to the value returned from $_COOKIE["year"]
		$month = $_COOKIE["month"] +1; //set month to the value returned from $_COOKIE["month"]
		$tDate = "$year-$month-$day";//set tdate to a combonation of all the values from the cookie	
		
		//$result = $link->query("SELECT * FROM eventstable where date='$tDate'"); // make result equal to the result of the query to the database
		$result = $link->query("SELECT eventID, date, eventName, description, r.routeID, routeName, routeDescription FROM eventstable e join routes r on e.routeID = r.routeID where date='$tDate' order by eventID");
		//create the opening tag for the list box
		echo "<select id='events'  size='12' onchange='enable(this)' style=width:400px;background-color:black;'>\n";
		//gets the rows from the query and turn them into option tags for the select tag
		while($row = $result->fetch_array(MYSQL_NUM))
		{
			//$resultSet = $link->query("Select eventID, routeName, routeDescription from eventstable join routes on eventstable.routeID = routes.routeID".
			//							" where eventID = " . $row[0]);
			$tempevent = new Event($row[1],$row[2],$row[3],$row[6],$row[4]); //creates a new event called tempevent
			$this->eventsArray["$counter"] = $tempevent;	//add the tempevent to the the array of events 
			//$name =$this->eventsArray[$counter]->eventName;	// make name equal to the eventName from the object eventsArray[counter]
			$odate = $this->eventsArray[$counter]->ndate; // make odate equal to the ndate from the object eventsArray[counter]
			//='opacity:80%;filter:alpha(opacity=80%);
			if($row[4] != 18)
			{
				
				echo "<option value= '$odate:".$row[0].":".$row[4]."' style='color:#FFFFFF';>"; //create the option tag
			}
			else
			{
				echo "<option value= '$odate:".$row[0].":".$row[4]."' style='color:#FFFF00'>"; //create the option tag
			}
			
			//prints the information from the event to the screen
			//$row = $resultSet->fetch_assoc();
			printf("%s",$this->eventsArray["$counter"]->eventName);
			
			
			echo "</option>\n"; //close the option tag
			
			
		
			$counter++; //increment counter
		}
		echo "</select> <br/>";//close the select tag
			print "<script type='text/javascript'>";
			print "var descArray = new Array();";
			//print "var idArray = new Array();";
			$counter =0;
			foreach( $this->eventsArray as $key => $value)
			{	
				if($this->eventsArray["$counter"]->routeID == 18)
				{
				$temp = $this->eventsArray["$key"]->description;
				
				}
				else
				{
				$temp = $this->eventsArray["$key"]->routeDescription;
				$temp .= '\n\nExtra Notes:\n' . $this->eventsArray["$key"]->description;
				}
				print 'descArray[' . $key . '] = "' . $temp . '";';
				$counter++;
				
				//$temp2 = $this->eventsArray["$key"]->routeID;
				//print 'idArray[' . $key . '] = "' . $temp2 . '";';
							
			}
			print "</script>	";
	}
	
	
	//this function adds the events into the specific dates in the calender 
	function datecheck($date)
	{
		$link = connect();
		$result1 = $link->query("SELECT * FROM eventstable WHERE date = '$date'"); //queries the database for all events on a certain date
		// adds each date to the calender
		while($row = $result1->fetch_array(MYSQL_NUM))
		{
			$tempevent = new Event($row[1],$row[2],$row[3]); // create a new event from the values from the query
			$this->eventsArray["$counter"] = $tempevent;	// add the event to the array
			printf("<span id='event'></span>\n");	// create a span tag
			if($counter <= 1)	//if counter is = to 0 then add a value to the area in the table
			{
				printf("<br/>%s <br/>", $this->eventsArray["$counter"]->eventName); //print the value to the screen
			}
			else	
			{
				printf("<br/>More...<br/>\n"); // if there is more than one value in the table then for the next add the word next
				break;//break out of the loop
			}
			$counter++;// increment counter
		}
	}

	function nextmonth()
	{
		$month++;
	}
	function createCalender()
	{

 $date =time () ;  //This puts the day, month, and year in seperate variables 
 $day = date('d', $date) ; 
 
 
 $today = time();
 $thisMonth = date('m',$today); 
	$thisYear = date('Y', $today) ;
	$thisDay = date('d', $today);
 
 
 //checks to make sure that the cookies are set
 if(isset($_COOKIE["month"]))
{
	//get the cookies
	$cookieVal = $_COOKIE["month"];
	$cookieVal2 = $_COOKIE["year"];

	
	$year=$cookieVal2;
	$cookieVal = $cookieVal + 1;
	$month = $cookieVal; 
}
 else
 
 {
	$month = date('m',$date); 
	$year = date('Y', $date) ;
}
 

 
 //Here we generate the first day of the month 
 $first_day = mktime(0,0,0,$month, 1, $year) ; 

 //This gets us the month name 
 $title = date('F', $first_day) ; 
//Here we find out what day of the week the first day of the month falls on 
 $day_of_week = date('D', $first_day) ; 

 //Once we know what day of the week it falls on, we know how many blank days occure before it. 
 //If the first day of the week is a Sunday then it would be zero
 switch($day_of_week){ 
 case "Sun": $blank = 0; break; 
 case "Mon": $blank = 1; break; 
 case "Tue": $blank = 2; break; 
 case "Wed": $blank = 3; break; 
 case "Thu": $blank = 4; break; 
 case "Fri": $blank = 5; break; 
 case "Sat": $blank = 6; break; 
 }

 //We then determine how many days are in the current month
 $days_in_month = cal_days_in_month(0, $month, $year) ; 
 
//Here we start building the table heads 

 echo "<table border=1 width=900>\n";
 echo "<tr>\n<th><button name='prevMonth' id='prevMonth' type='button'  onclick='changeMP()'> " .
		"<img alt='left botton' src='images/left_arrow.png' width='60px' height='20px'></button>" .
		"</th>\n<th colspan=5> $title $year </th><th><button name='prevMonth' id='prevMonth'" .
		"type='button' onclick='changeMN()'><img alt='right botton' src='images/right_arrow.png'" .
		"width='60px' height='20px'></button></th>\n</tr>\n";
 echo "<tr>\n<td width=14%>S</td>\n<td width=14%>M</td>\n<td width=14%>T</td>\n<td width=14%>W</td>\n" .
		"<td width=14%>T</td>\n<td width=14%>F</td>\n<td width=14%>S</td>\n</tr>\n";

 //This counts the days in the week, up to 7
 $day_count = 1;

 echo "<tr>\n";
 //first we take care of those blank days
 while ( $blank > 0 ) 
 { 
	 echo "<td></td>\n"; 
	 $blank = $blank-1; 
	 $day_count++;
 } 
 //sets the first day of the month to 1 
 $day_num = 1;

 
 //count up the days, untill we've done all of them in the month
 while ( $day_num <= $days_in_month ) 
 { 
	 if( $thisDay == $day_num && $thisYear == $year && $thisMonth == $month)
	 {
		printf("<td onclick='openEventPopup($day_num)' id='$day_num' height='100px'  background='images/today.png'" . 
				"style='color: white;overflow:auto; vertical-align: top; text-overflow: ellipsis; WORD-BREAK:BREAK-ALL;'>\n");
	 }
	else
	{	
		printf("<td onclick='openEventPopup($day_num)' id='$day_num' height='100px' background='images/blank.png'" .
				"style='overflow:auto; vertical-align: top; text-overflow: ellipsis; WORD-BREAK:BREAK-ALL;'>\n");
	}

	printf("$day_num");
	$this->datecheck("$year-$month-$day_num");
	
	 echo "</td>\n";
	 $day_num++; 
	 $day_count++;

	 //Make sure we start a new row every week
	 if ($day_count > 7)
	 {
	 echo "</tr>\n<tr>\n";
	 $day_count = 1;
	 }
 } 
 //Finaly we finish out the table with some blank details if needed
 while ( $day_count >1 && $day_count <=7 ) 
 { 
	$day_count++; 
 } 
 
 echo "</tr>\n</table>\n"; 

}
	
	
}
?>