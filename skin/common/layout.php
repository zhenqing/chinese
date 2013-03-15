<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/chinese/css/default.css" rel="stylesheet" type="text/css" />
<link href="/chinese/css/subpage.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/chinese/css/thickbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="/chinese/js/jquery.js" ></script>
<Script type="text/javascript" src="/chinese/js/thickbox.js" ></script>

<title>耶稣青年会 - 中国</title>
<?=$header_script; ?>
</head>

<body id="<?=$bodyid ? $bodyid : 'news' ?>">
<!-- wrap start -->
<div id="wrap">
<!-- header start -->
<? require(MDconfig::TPL_COMMON."/header.tpl"); ?>
<!-- header end -->
<!-- img_ministry start -->
<?  if($toptpl)
        require(MDconfig::TPL_COMMON."/".$toptpl);
?>
<!-- img_ministry end -->
<!-- cont start -->
<div id="cont">
        <!-- sub_sidebar start -->
        <?
          if($leftinner)
            require_once(FOLDER."inner/".$leftinner);
        ?>
        <!-- wrap_subbox end -->
        <!-- main_cont start -->
        <?
            if($maininner)
              require_once(FOLDER."inner/".$maininner);
        ?>
        <!-- main_cont end -->
        <div class="clear"></div>
</div>
 <!-- cont end -->
<div class="clear"></div>
<!-- footer start -->
<? require(MDconfig::TPL_COMMON."/footer.tpl"); ?>
<!-- footer end -->
</div>
<!-- wrap end -->
<? if(class_exists('MDPosition')){
    MDPosition::makebar($section_id);
    } ?> 
</body>
</html>
