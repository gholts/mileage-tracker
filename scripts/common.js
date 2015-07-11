/**************
* Function nclose
* Purpose close the page
****************/ 
var nclose = function(farBack)
{
	if(farBack == 0)
	{
		window.close();
	}
	else
	{
		window.opener.location.reload();
		history.go(farBack);
	}
}