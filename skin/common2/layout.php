<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Subject" content="Daily source of timely and informative medical news and health news" />
<meta name="Keywords" content="Daily source of timely and informative medical news and health news" />
<meta name="Description" content="Daily source of timely and informative medical news and health news" />

<title><?=$pagetitle ? $pagetitle : 'Medical Daily : Daily Medical News and Health News' ?> </title>

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
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
 
<link href="/css/default.css" rel="stylesheet" type="text/css" /> 
<link href="/new/css/article_new.css" rel="stylesheet" type="text/css" /> 
<link href="/css/addclass.css" rel="stylesheet" type="text/css" /> 
<link href="/css/thickbox.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="/js/jquery.js" ></script>
<script type="text/javascript" src="/js/common.js" ></script>
<Script type="text/javascript" src="/js/thickbox.js" ></script>
<script src="/js/swfobject.js" type="text/javascript"></script>

<? echo $header_script; ?>
</head> 
 
<body> 
<!-- wrap start --> 
<div id="wrap"> 
    <!-- wrap header start --> 
    <?php
    $skin1 = 'common1';
    if($bottombox == 'MAINPAGE')
        require(MDconfig::SKINPATH.'/'.$skin1.'/header.php');
    else        
        require(MDconfig::SKINPATH.'/'.$skin1.'/subheader.php');
    ?>    
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
         
        <div class="clear"></div> 
        
        <!-- topic guide start --> 
        <div id="topic_guide"> 
            <div class="title">TOPIC GUIDE</div>
            <!-- content start -->
            <div class="content">
                <!-- box_topic start -->
                <div class="box_topic">
                    <p class="name">TOPIC GUIDE</p>
                  <a href="http://www.medicaldaily.com/news/20100603/caffeine-get-no-real-perk-from-morning-cup.htm"><img src="/images/img_topic1.jpg" alt="img"><br></a>
                    <h6><a href="http://www.medicaldaily.com/news/20100603/caffeine-get-no-real-perk-from-morning-cup.htm">Drugs and Alcohol</a></h6>
                </div>
                <!-- box_topic end -->
                <!-- box_topic start -->
                <div class="box_topic">
                    <p class="name">TOPIC GUIDE</p>
                  <a href="http://www.medicaldaily.com/news/20100603/who-says-h1n1-flu-pandemic-continues.htm"><img src="/images/img_topic.jpg" alt="img"><br></a>
                    <h6><a href="http://www.medicaldaily.com/news/20100603/who-says-h1n1-flu-pandemic-continues.htm">H1N1</a></h6>
                </div>
                <!-- box_topic end -->
                <!-- box_topic start -->
                <div class="box_topic">
                    <p class="name">TOPIC GUIDE</p>
                  <a href="http://www.medicaldaily.com/news/20100602/dentalrays-increase-cancer-risk.htm"><img src="/images/img_topic2.jpg" alt="img"><br></a>
                    <h6><a href="http://www.medicaldaily.com/news/20100602/dentalrays-increase-cancer-risk.htm">X-ray</a></h6>
                </div>
                <!-- box_topic end -->
                <!-- box_topic start -->
                <div class="box_topic">
                    <p class="name">TOPIC GUIDE</p>
                  <a href="http://www.medicaldaily.com/news/20100602/genes-and-lifestyle-pose-separate-breast-cancer-risks.htm"><img src="/images/img_topic3.jpg" alt="img"><br></a>
                    <h6><a href="http://www.medicaldaily.com/news/20100602/genes-and-lifestyle-pose-separate-breast-cancer-risks.htm">Cancer</a></h6>
                </div>
                <!-- box_topic end -->
                <!-- box_topic start -->
                <div class="box_topic">
                    <p class="name">TOPIC GUIDE</p>
                  <a href="http://www.medicaldaily.com/news/20100601/two-thousand-calories-insingle-drink.htm"><img src="/images/img_topic4.jpg" alt="img"><br></a>
                    <h6><a href="http://www.medicaldaily.com/news/20100601/two-thousand-calories-insingle-drink.htm">Calories</a></h6>
                </div>
                <!-- box_topic end -->
                <!-- box_topic start -->
                <div class="box_topic m_none">
                    <p class="name">TOPIC GUIDE</p>
                  <a href="http://www.medicaldaily.com/news/20100601/g8-seeks-drive-meet-2015-aid-goals-poor.htm"><img src="/images/img_topic5.jpg" alt="img"><br></a>
                    <h6><a href="http://www.medicaldaily.com/news/20100601/g8-seeks-drive-meet-2015-aid-goals-poor.htm">G8</a></h6>
                </div>
                <!-- box_topic end -->
                <div class="clear"></div>
            </div>
            <!-- content end -->            
            
        </div> 
        <!-- topic guide end --> 
    
    </div> 
    <!-- wrap contents end --> 
    <!-- footer start --> 
      <div id="footer"> 
        <a href="/">Home</a>  |  <a href="/sections/news-blogs.htm">News &amp; Blogs</a>  |  
        <a href="/sections/health-living.htm">Healthy Living</a>  |  
        <a href="/sections/diet-fitness.htm">Diet &amp; Fitness</a>  |  
        <a href="/sections/work-health.htm">Workd &amp; Health</a>  |  
        <br/> 
 &copy; Copyright 2010 <span>MedicalDaily</span>. 
 <a href="http://www.medicaldaily.com/mediinfo/terms_of_service.htm">Terms of service</a>  |  
 <a href="http://www.medicaldaily.com/mediinfo/privacy_policy.htm">Privacy Policy</a>  |  
 <a href="http://www.medicaldaily.com/mediinfo/advertising.htm">Advertising</a>  |  
 <a href="http://www.medicaldaily.com/mediinfo/about_us.htm">About Us</a>  |  
 <a href="http://www.medicaldaily.com/mediinfo/contact_us.htm">Contact Us</a>  |  <? /* <a href="#">Archives</a>  */ ?>
     </div> 
    <!-- footer end --> 
</div> 
<!-- wrap end --> 
<!-- Start of StatCounter Code -->
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
<? } ?>
</body> 
</html> 