<div id="main_cont">
            <!-- wrap_subtitle start -->
      <div id="wrap_subtitle">
                <div class="title">资源仓库</div>
                <div class="page"><a href="../index.htm">主页</a> > <span class="over"><a href="index.htm">资源仓库</a></span></div>
                <div class="clear"></div>
            </div>
            <!-- wrap_subtitle end -->
              <!-- resource start-->
            <div id="resource">
            <!-- wrap_resources_left start-->
            <div id="wrap_resources_left">
            <?
                  $file = "box_lt.php";
                  Update::updatetpl($file,$Model); 
                  $file = "box_lb.php";
                  Update::updatetpl($file,$Model); 

            ?>

            
            <!-- wrap_resources end-->
            </div>
            <!-- wrap_resources_left end-->
            <!-- wrap_resources_right start-->
            <div id="wrap_resources_right">
            <!-- book start -->
                      <?php //// 
                  $file = "box_rt.php";
                  Update::updatetpl($file,$Model); 
                  ?>
            <!-- book end -->
            <div id="banner">
            <a href="#"><img src="/images/banner_resources.gif" /></a>
            </div>
            <?            
                  $file = "box_rb.php";
                  Update::updatetpl($file,$Model); 
            
            ?>    
            </div>
            <!-- wrap_resources_right end-->
            </div>
            <div class="clear"></div>
            <!-- resources end -->
            <!-- resources_tool start -->
          <div id="resources_tool">
            <p><img src="../images/title_resources.gif" /></p>
            <a href="#"><img src="../images/pic_resources01.gif" /></a><a href="#"><img src="../images/pic_resources02.gif" /></a><a href="#"><img src="../images/pic_resources03.gif" /></a><a href="#"><img src="../images/pic_resources04.gif" /></a>
            </div>
            <!-- resources_tool end-->
        </div>