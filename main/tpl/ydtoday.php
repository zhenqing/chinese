<div class="box_today">
        <!--wrap_title start -->
        <div class="wrap_title">
            <img src="/images/icon_rss.gif" alt="RSS" align="right" />
            <img src="/images/title_today.gif" alt="YD Today and Event" />
            <div class="clear"></div> 
        </div>
        <!--  wrap_title end -->
        <? foreach($data as $val){
         ?>
          <div class="news_con">
                <? if($val['image']){ ?><a href="<?=$val['link'] ?>"><img src="/chinese/datainfo/<?=$val['img_path'] ?>" align="left" /></a><? } ?>
                <p class="date"><?=date('d-M-y, H:i',strtotime($val['registerdate'])) ?></p>
                <p><a href="<?=$val['link'] ?>"><?=$val['title'] ?></a><?=$val['number'] ?></p>
                <div class="clear"></div>
          </div>
         <? } ?> 
          <div class="clear"></div>
          <p class="see"><a href="/pulse/ydtoday.htm">See Archives</a></p>
    </div>