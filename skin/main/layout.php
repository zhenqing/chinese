<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/chinese/css/default.css" rel="stylesheet" type="text/css" />
<link href="/chinese/css/homepage.css" rel="stylesheet" type="text/css" />
<title>耶稣青年会 - 中国</title>
<link rel="stylesheet" href="/chinese/css/thickbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="/chinese/js/jquery.js" ></script>
<Script type="text/javascript" src="/chinese/js/thickbox.js" ></script>
<script type="text/javascript" src="/chinese/js/homepage.js"></script>
<script src="/chinese/Scripts/swfobject_modified.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
<!--

function flashWrite(url,w,h,id,bg,win){

    var flashStr=
    "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='"+w+"' height='"+h+"' id='"+id+"' align='middle'>"+
    "<param name='movie' value='"+url+"' />"+
    "<param name='wmode' value='"+win+"' />"+
    "<param name='menu' value='false' />"+
    "<param name='quality' value='high' />"+
    "<param name='bgcolor' value='"+bg+"' />"+
    "<embed src='"+url+"' wmode='"+win+"' menu='false' quality='high' bgcolor='"+bg+"' width='"+w+"' height='"+h+"' name='"+id+"' align='middle' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' />"+
    "</object>";
    document.write(flashStr);

}
-->
</script>
<?=$header_script; ?>

</head>
<body>
<!-- wrap start -->
<div id="wrap">
<!-- header start -->
<? require(MDconfig::TPL_COMMON."/header.tpl"); ?>
<!-- header end -->
<!-- main_img start -->
<div id="main_img">
  <div id="img">
    <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="994" height="450">
      <param name="movie" value=<?echo ROOTPATH?>"/flash/flashimg.swf" />
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="6.0.65.0" />
      <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don��t want users to see the prompt. -->
      <param name="expressinstall" value="/Scripts/expressInstall.swf" />
      <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
      <!--[if !IE]>-->
      <object type="application/x-shockwave-flash" data=$MDconfig::ROOTPATH"/flash/flashimg.swf" width="994" height="450">
        <!--<![endif]-->
        <param name="quality" value="high" />
        <param name="wmode" value="opaque" />
        <param name="swfversion" value="6.0.65.0" />
        <param name="expressinstall" value="/Scripts/expressInstall.swf" />
        <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
        <div>
          <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
          <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
        </div>
        <!--[if !IE]>-->
      </object>
      <!--<![endif]-->
    </object>
  </div>
  <? require(MDconfig::TPL_COMMON."/nav.tpl"); ?>
   <div id="map"><script>flashWrite('/flash/flashmap.swf',260, 177,'','#ffffff','transparent')</script></div>
</div>
<!-- main_img end -->
<!-- content start -->
<div id="content">
<!-- main_content start -->
		<?            
			  if($maininner) //? why, where can i get this var?
              require_once(FOLDER."inner/".$maininner);
        ?>

<div class="clear"></div>
</div>
<!-- wrap end -->
<!-- footer start -->
<div id="wrap_ft">
<? require(MDconfig::TPL_COMMON."/footer.tpl"); ?>
</div>
<!-- footer end -->
<script type="text/javascript">
swfobject.registerObject("FlashID");
</script>
<? if(class_exists('MDPosition')){
    MDPosition::makebar($section_id);
    } ?> 
</body>
</html>
