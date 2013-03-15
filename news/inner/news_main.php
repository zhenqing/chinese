<div id="main_cont">
            <!-- wrap_subtitle start -->
      <div id="wrap_subtitle">
                <div class="title">新闻中心</div>
                <div class="page"><a href="/chinese">主页</a> > <span class="over"><a href="/news/">新闻中心</a></span></div>
                <div class="clear"></div>
          </div>
            <!-- wrap_subtitle end -->
           
            <!-- article start -->
<?
                  $file = "mainbox.php";
                  Update::updatetpl($file,$Model); 

?>
            <!-- article end -->
         
            <!-- box_news start -->
<?
                  $file = "newsbox1.php";
                  Update::updatetpl($file,$Model); 

?>            
            <!-- box_news end -->
            <!-- box_news start -->
<?
                  $file = "newsbox2.php";
                  Update::updatetpl($file,$Model); 

?>            
            <!-- box_news end -->
            <!-- box_news start -->
<?
                  $file = "newsbox3.php";
                  Update::updatetpl($file,$Model); 

?>            
            <!-- box_news end -->  
        </div>