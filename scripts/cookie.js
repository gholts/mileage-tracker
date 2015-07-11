function setCookie(c_name,value)
{
	document.cookie=c_name + "=" + value ;
}

function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
{
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}

function DateCookie( sDay, sMonth, sYear )
{
	this.pDay = sDay;
	this.pMonth = sMonth;
	this.pYear = sYear;
}
