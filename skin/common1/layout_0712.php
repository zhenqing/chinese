<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Subject" content="Daily source of timely and informative medical news and health news" />
<meta name="Keywords" content="Daily source of timely and informative medical news and health news" />
<meta name="Description" content="Daily source of timely and informative medical news and health news" />

<title>Medical Daily : Daily Medical News and Health News </title>
<style type="text/css">
<!--
.png24 { tmp:expression(setPng24(this));}

-->
</style>
<script type="text/javascript">
function setPng24(obj) {
 obj.width=obj.height="1";
 obj.className=obj.className.replace(/\bpng24\b/i,"");
 obj.style.filter= "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+ obj.src +"',sizingMethod='image');"
 obj.src="";
 return "";
}
</script>

<link href="/new/css/default.css" rel="stylesheet" type="text/css" />
<link href="/new/css/health.css" rel="stylesheet" type="text/css" />
<link href="/css/thickbox.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="/js/jquery.js" ></script>
<Script type="text/javascript" src="/js/thickbox.js" ></script>

<? echo $header_script; ?>
</head>

<body>

<!-- wrap start -->
<div id="wrap">

    <!-- wrap header start -->
       <!-- wrap header end -->
    <!-- wrap contents start -->
  
  <div id="wrap_contents">

        <? // Main innerpage;
            if($maininner)
                require_once(FOLDER.'inner/'.$maininner);
            //right innerpage
            if($rightinner)
                require_once(FOLDER.'inner/'.$rightinner);
         ?>
        <!-- sidebar end -->
        <div class="clear"></div>
        <?
        			if($bottombox == 'MAINPAGE'){
 									$file = "bottom_topics.php";
									Update::updatetpl($file,$Model); 
							}else{
									$file = "bottom_topics.php";
									require(MDconfig::ROOTPATH.'/main/page/'.$file);
							}
        	
        ?>

</div>

  <div class="clear"></div>

<!-- footer start --> 
    <div id="footer">
        <a href="/">Home</a>  |  <a href="/sections/top-headlines.htm">Top Headlines</a>  |  <a href="/sections/healthcare.htm">Healthcare</a>  |  <a href="/sections/medical-research.htm">Medical Research</a>  |  <a href="/sections/pharma-medicine.htm">Pharma & Medicine</a>  |  <a href="/topics/common.htm">Health Topics</a><br/>

 &copy; Copyright 2010 <span>MedicalDaily</span>. <a href="/mediinfo/terms_of_service.htm">Terms of service</a>  |  
 																									<a href="/mediinfo/privacy_policy.htm">Privacy Policy</a>  |  
 																									<a href="/mediinfo/advertising.htm">Advertising</a>  |  
 																									<a href="/mediinfo/about_us.htm">About Us</a>  |  
 																									<a href="/mediinfo/contact_us.htm">Contact Us</a>  |  
 																									<a href="/sections/top-headlines.htm">Archives</a>

     </div>
    <!-- footer end -->
  </div>
<!-- wrap  end-->
<? if(class_exists('MDPosition')){
    MDPosition::makebar($section_id);
    }else{ ?> 
<script type="text/javascript"> 
var sc_project=5964806;  
var sc_invisible=1;  
var sc_security="9f0365ef";  
</script> 

<script type="text/javascript" 
src="http://www.statcounter.com/counter/counter.js"></script><noscript><div 
class="statcounter"><a title="customizable counter" 
href="http://www.statcounter.com/free_hit_counter.html" 
target="_blank"><img class="statcounter" 
src="http://c.statcounter.com/5964806/0/9f0365ef/1/" 
alt="customizable counter" ></a></div></noscript> 
<!-- End of StatCounter Code -->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17209748-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script src="http://static.getclicky.com/js" type="text/javascript"></script>
<script type="text/javascript">clicky.init(229698);</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="http://in.getclicky.com/229698ns.gif" /></p></noscript>


<? } ?>
</body>
</html>
