<?php
include "statFunctions.php";

$users = statsquery();

print "<html>";
print "<head>";
print "<title> User Stats</title>";
print "</head>";
print "<body>";
echo $users;
foreach($users as $sKey->$sElem)
{
	echo "User $sKey is $sElem";
}
print "</body>";
print "<html>";
?>