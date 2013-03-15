<div id="main_cont">
            <!-- wrap_subtitle start -->
      <div id="wrap_subtitle">
                <div class="title"><?=$section_title ?></div>
                <div class="page"><a href="/chinese">主页</a> > <?echo $subtitle; ?> > <span class="over"><? echo $special_title; ?></span></div>
                <div class="clear"></div>
          </div>
            <!-- wrap_subtitle end -->
        <? if($data){
            foreach($data as $v){
                ?>
            <!-- wrap_news start -->
            <div class="wrap_news">
                <? if($v['image']){ ?><p><?=$v['image'] ?></p><? } ?>
                <h4><a href="<?=Strings::md_article_onlylink($v['id'],$v['registerdate'],$v['keywords']) ?>"><?=$v['title'] ?></a></h4>
                <p>
                <?=$v['summary'] ?></p>
                <p class="writer"><?=$v['reportername'] ? 'By '.$v['reportername'].' | ' : '' ?> 
                 <span  class="date"><?=date("F d, Y",strtotime($v['registerdate'])) ?></span></p>
                <div class="clear"></div>
            </div>
            <!-- wrap_news end -->
        <? } } ?> 
            <!-- pulsepagepage start -->
          <div id="page">
       <?
         //<a href="#"><img src="../images/icon_back_left01.gif"align="absmiddle" /></a> 
         //<a href="#"><img src="../images/icon_pre_right01.gif" align="absmiddle" /></a>
         if(1 <  $pagedata['curent'])
            echo ' <a href="'.$_SERVER['PHP_SELF'].'?page='.($pagedata['current']  - 1).'"><img src="/images/icon_back_left02.gif" align="absmiddle" /></a> ';
            

         for($i = $pagedata['start'];$i <= $pagedata['end'];$i++){ 
            $aclass = ""; 
            if($i == $pagedata['current']){
                $aclass .= "current ";
            }
            
            if($i !=  $pagedata['end']){
               $aclass .= "bd_r "; 
            }
            echo '  <a '.$aclass.' href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a> ';
         }
         echo " of ".$pagedata['total'];
         
         if($pagedata['total'] > $pagedata['current'])
            echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($pagedata['current'] + 1).'"><img src="/images/icon_pre_right02.gif" align="absmiddle" /></a></span>';
         ?>
                
          </div>
            <!-- pulsepage end -->
    </div>