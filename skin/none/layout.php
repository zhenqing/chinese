<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title><?=$pagetitle ? $pagetitle : 'Medical Daily' ?></title> 
<style type="text/css"> 
<!--
.png24 { tmp:expression(setPng24(this));}
 
-->
</style> 
<? echo $header_script; ?>
</head> 
<body> 
<!-- wrap start --> 
 <?
            if($maininner)
                require_once(FOLDER.'inner/'.$maininner);
            //right innerpage
            if($rightinner)
                require_once(FOLDER.'inner/'.$rightinner);
         ?>
         
</body> 
</html> 