<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Subject" content="Daily source of timely and informative medical news and health news" />
<meta name="Keywords" content="Daily source of timely and informative medical news and health news" />
<meta name="Description" content="Daily source of timely and informative medical news and health news" />

<title>Medical Daily : Daily Medical News and Health News </title>

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
<link href="/css/addclass.css" rel="stylesheet" type="text/css" /> 
<style type="text/css"> 
.png24 { tmp:expression(setPng24(this));}
body{padding:0; margin:0;}
</style> 
<script type="text/javascript" src="/js/jquery.js" ></script>
<script type="text/javascript" src="/js/common.js" ></script>
<script src="/js/swfobject.js" type="text/javascript"></script>
<? echo $header_script; ?>
</head> 
<body>
    <?
     // Main innerpage;
    
        if($this -> pagepath)
            require_once('views/'.$this -> pagepath);
        //right innerpage
        if($rightinner)
            require_once($rightinner);
     ?>
</body>
</html> 