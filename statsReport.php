<?php
include "statFunctions.php";

print '<html>';
print '<head>';
print "	<title>"; 
	setTitle();
print "</title>";
print '</head>';

print '<body>';
print '<h1>'; 
	setTitle(); 
print '</h1>';

	statsQuery();

print '</body>';

print '<html>';
?>