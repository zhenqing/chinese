<div id="main_content">
    <!-- wrap_resources start -->
    <div id="wrap_resources">
    <!-- tab start --> 
    <div id="tab_headline"> 
        <ul> 
            <li id="tabli1" class="current first"><a onclick="javascript:settab(1);" href="javascript:void(0);">资源仓库</a></li> 
            <li id="tabli2"><a onclick="javascript:settab(2);" href="javascript:void(0);">发展</a></li> 
            <li id="tabli3"><a onclick="javascript:settab(3);" href="javascript:void(0);">世界宣教</a></li> 
            <li id="tabli4"><a onclick="javascript:settab(4);" href="javascript:void(0);">基督徒生活</a></li> 
        </ul> 
        <div id="arrow"> 
            <img id="tab_arrow_left" onclick="javascript:settabminus();"  src="/images/icon_argray_left.gif" /><img id="tab_arrow_right" src="/images/icon_argray_right.gif" onclick="javascript:settabplus();" />        </div> 
        <div class="clear"></div> 
    </div> 
    <!-- tab end -->
    <div class="clear"></div> 
    <!-- headline start -->
    <div id="tabbox1">
    <?
          $file = "tabbox1.php";
          Update::updatetpl($file,$Model); 
    ?>
    </div>
    <div id="tabbox2">
    <?
          $file = "tabbox2.php";
          Update::updatetpl($file,$Model); 
    ?>
    </div>
    <div id="tabbox3">
    <?
          $file = "tabbox3.php";
          Update::updatetpl($file,$Model); 
    ?>
    </div>
    <div id="tabbox4">
    <?
          $file = "tabbox4.php";
          Update::updatetpl($file,$Model); 
    ?>
    </div>
    
    <!-- headline end -->
    </div>
    <div class="clear"></div>
    <!-- wrap_resources end -->
    <!-- picture start -->
    <div id="picture">
        <a href="#"><img src="/images/pic_main04.gif" class="img" /></a> <a href="/pulse/devotional.htm"><img src="/images/pic_main05.gif" /></a>
    </div>
    <!-- picture end -->
</div>
<!-- main_content end -->
<!-- main_sidebar -->
<div id="main_sidebar">
    <!-- box_today start -->
    <?
          $file = "ydtoday.php";
          Update::updatetpl($file,$Model); 
    ?>
    <!-- box_today end -->
    <!-- box_newsletter start -->
    <div id="box_newsletter">    
        <div class="title"><img src="/chinese/images/title_newsletter.gif" /></div>
        <input type="tex" onfocus="this.value='';" class="form_subscribe" value="Email" /><input type="button" value="订阅" class="bt_subscribe" />
        <br/>即时获取最新事工新闻和灵修小品
    </div>
    <!-- box_newsletter end -->
</div>
<!-- main_sidebar end -->
<!-- content end -->