//Default FeedBack Values
var ratings = 3;
var title = document.title;
var URL = location.href.replace(location.hash,"");
var version = 2009;

/*************************************************************************
 * Methods ********************************************************
 *************************************************************************/

function DeliveryType()
{
 	if (URL.indexOf("ms-help://")!=-1) {return("h");}
	else if (URL.indexOf(".chm::/")!=-1) {return("c");}
	else if (URL.indexOf("http://")!=-1) {return("w");}
	else if (URL.indexOf("file:")!=-1) {return("f");}
	else return("0");
}

function DeliverableValue(deliverable)
{
 	if (URL.indexOf("ms-help://")!=-1) 
	{
		delvalue  = location.href.slice(0,location.href.lastIndexOf("/html/"));
		delvalue  = delvalue.slice(delvalue.lastIndexOf("/")+1);
		return delvalue;
	}
	else return(deliverable);
}

function URLValue()
{
	if (URL.indexOf(".chm::")!=-1) 
	{
		a = URL;
		while (a.indexOf("\\") < a.indexOf(".chm::") || a.indexOf("//") > a.indexOf(".chm::")) 
		{
			if (a.indexOf("\\")==-1)
			{
				break;
			}
			a = a.substring(a.indexOf("\\")+1,a.length);
		}
		return("ms-its:"+a)
	}
	else if (URL.indexOf("file:///")!=-1) 
	{
		a = URL;

		b = a.substring(a.lastIndexOf("html")+5,a.length);
		return("file:///"+b);
	}
	else return(URL);
}

function GetLanguage()
{
	var langauge;
  	if(navigator.userAgent.indexOf("Firefox")!=-1)
  	{
  		var index = navigator.userAgent.indexOf('(');
   		var string = navigator.userAgent.substring(navigator.userAgent.indexOf('('), navigator.userAgent.length);
   		var splitString = string.split(';');
	   	language = splitString[3].substring(1, splitString[3].length);
  	}
  	else language = navigator.systemLanguage;
	return(language);
}


//---Gets topic rating.---
function GetRating()
{

	sRating = "0";
	for(var x = 0;x < 5;x++)
  	{
		if(document.formRating) {
		if(document.formRating.fbRating[x].checked) {sRating = x + 1;}}
		else return sRating;
  	}
	return sRating;
}

function SubmitFeedback(alias, product, deliverable, productVersion, documentationVersion, defaultBody)
{
	var subject = title
  		+ " ("
		+ "/1:"
  		+ product
  		+ "/2:"
  		+ productVersion
  		+ "/3:"
  		+ documentationVersion
  		+ "/4:"
  		+ DeliverableValue(deliverable)
  		+ "/5:"
  		+ URLValue()
  		+ "/6:"
  		+ GetRating() 
  		+ "/7:"
  		+ DeliveryType()
  		+ "/8:"
  		+ GetLanguage()
		+ "/9:"
  		+ version
		+ ")"; 
  
	defaultBody = '%0\dYour%20feedback%20is%20used%20to%20improve%20the%20documentation%20and%20the%20product.%20Your%20e-mail%20address%20will%20not%20be%20used%20for%20any%20other%20purpose%20and%20is%20disposed%20of%20after%20the%20issue%20you%20report%20is%20resolved.%20%20While%20working%20to%20resolve%20the%20issue%20that%20you%20report,%20you%20may%20be%20contacted%20via%20e-mail%20to%20get%20further%20details%20or%20clarification%20on%20the%20feedback%20you%20sent.%20After%20the%20issue%20you%20report%20has%20been%20addressed,%20you%20may%20receive%20an%20e-mail%20to%20let%20you%20know%20that%20your%20feedback%20has%20been%20addressed.%0\A%0\d';	
	
	location.href = "mailto:" + alias + "?subject=" + subject
	+ "&body=" + defaultBody;
}

function AltFeedback(src, title) {
	src.title=title;
	return;
	}
