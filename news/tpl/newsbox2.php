<div class="box_news">        
            <h3>世界宣教</h3>
            <!-- wrap_news start -->
           <? foreach($data as $val){ ?>  
            <div class="wrap_news">
                <? if($val['image']){ ?><p><?=$val['image'] ?></p><? } ?>
                <h4><a href="<?=$val['link'] ?>"><?=$val['title'] ?></a><?=$val['number'] ?></h4>
                <p><?=$val['summary'] ?></p>
                <p class="writer"><?=$val['reportername'] ? 'BY '.$val['reportername'].' | ' : ''; ?>   
                <span  class="date">><?=date('F d, Y',strtotime($val['registerdate'])) ?></span></p>
                <div class="clear"></div>
            </div>
            <? } ?>
            <div class="click_bg">
            <a href="global.htm"><p class="click">点击这里查看更多世界宣教</p></a>
            </div>
            <!-- wrap_news start end -->
            </div>