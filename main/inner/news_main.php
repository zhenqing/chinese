<div id="main_cont"> 
            <!-- wrap_subtitle start --> 
      <div id="wrap_subtitle"> 
                <div class="title"><?=$subtitle ?></div> 
                <div class="page"><a href="/">Home</a> > <?=$subtitle ?> &gt; <span class="over"><?=$special_title ?></span></div> 
                <div class="clear"></div> 
          </div> 
            <!-- wrap_subtitle end --> 
           
            <!-- article start --> 
          <div class="wrap_headline"> 
            <h1><?=$result['title'] ?></h1> 
              <p class="writer"><?=$result['reportername'] ? 'By '.$result['reportername'].' | ' : '' ?> 
              <span  class="date"><?=date("F d, Y",strtotime($result['registerdate'])) ?></span></p> 
</div> 
            <!-- article end --> 
         
            <!-- box_news start --><!-- box_news end --> 
            <!-- box_news start --><!-- box_news end --> 
            <!-- box_news start --> 
            <div class="box_news"><!-- wrap_news start --> 
            <div class="wrap_news_content"> 
            <p>
            <?if($images){ ?><span class="wrap_headline"><img width="271" src="<?=MDconfig::IMGPATH.'/'.$images[0]['path'] ?>" /></span><? } ?>
             <? $content = stripslashes($result['content']);
                echo $content;
             ?>
            </p> 
<div class="clear"></div> 
            </div> 
            <!-- wrap_news start end --> 
          </div> 
            <!-- box_news end -->  
        </div> 
        