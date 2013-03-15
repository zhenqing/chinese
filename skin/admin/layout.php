<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>YD Center Admin Page</title> 
<link href="/skin/admin/style.css" rel="stylesheet" type="text/css" /> 

<link rel="stylesheet" href="/css/thickbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="/js/jquery.js" ></script>
<Script type="text/javascript" src="/js/thickbox.js" ></script>
<script type="text/javascript" src="/js/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
       $('textarea.richtext').tinymce({
           script_url : '/js/tinymce/jscripts/tiny_mce/tiny_mce.js',

            // General options
            theme : "advanced",
            plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
            height: "400px",
            // Theme options
            theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
            theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
            
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,

            // Example content CSS (should be your site CSS)
            

            // Drop lists for link/image/media/template dialogs
            template_external_list_url : "lists/template_list.js",
            external_link_list_url : "lists/link_list.js",
            external_image_list_url : "lists/image_list.js",
            media_external_list_url : "lists/media_list.js",
       });
   }); 
</script>
<? echo $header_script; ?>
</head> 
<body id="orderstatus"> 
 
<!-- container start --> 
<div id="container"> 
    <!-- header start --> 
    <div id="header"> 
    <a href="/index.htm">YD</a> 
    <a href="order_status.htm">Admin</a> 
</div>    <!-- header end --> 
    
    <!-- nav start --> 
    <?
        $rinfo = explode('/',$_GET['r']);
        if($rinfo[1])
            $menu_pnum  = strpos('publish',$rinfo[1]);
        
        if($topmenu != 'NONE'){ ?>
    <div id="nav"> 
    <ul> 
        <li <?=$rinfo[0] == 'categories' ? 'class="selected"' : ''; ?> id="nav_1"><a href="/chinese/manage/?r=categories/index">Categories</a></li>
        <li <?=$rinfo[0] == 'specialcats' ? 'class="selected"' : ''; ?> id="nav_2"><a href="/chinese/manage/?r=specialcats/index">Special Categories</a></li>
        <li <?=($rinfo[0] == 'articles' && $menu_pnum === false) ? 'class="selected"' : ''; ?> id="nav_3"><a href="/chinese/manage/?r=articles/index">Articles</a></li>
        <li <?=$rinfo[0] == 'sources' ? 'class="selected"' : ''; ?> id="nav_5"><a href="/chinese/manage/?r=sources/index">Sources</a></li>
        <li <?=$rinfo[0] == 'layouts' ? 'class="selected"' : ''; ?> id="nav_6"><a href="/chinese/manage/?r=layouts/index">Update pages</a></li>
        <li id="nav_7"><a href="/chinese/manage/?r=login/logout">Logout</a></li>
    </ul> 

</div>    <!-- nav end -->
<? } ?> 
    <div class="clear"></div> 
    
    <!-- main start --> 
    <? 
        // Main innerpage;
        if($this -> pagepath)
            require_once('views/'.$this -> pagepath);
        //right innerpage
        if($rightinner)
            require_once($rightinner);
     ?>
    <!-- main end --> 
    
    <!-- footer start --> 
    <div id="footer"> 
    <p>Copyright &copy; 2010 YD All rights reserved.</p> 

</div>    <!-- footer end --> 
 
<div class="clear"></div> 
</div> 
<!-- container end --> 
 
</body> 
</html> 