<h3>查经</h3>

    <? foreach($data as $val){ ?>  
            <!-- wrap_resources start-->
            <div class="wrap_resources">
            <?=$val['image'] ?>
            
            <h4><a href="<?=$val['link'] ?>"><?=$val['title'] ?></a><?=$val['number'] ?></h4>
            <p class="writer"><?=$val['reportername'] ? 'BY '.$val['reportername'].' | ' : ''; ?>  
                <span  class="date"><?=date('F d, Y',strtotime($val['registerdate'])) ?></span></p>
            <div class="clear"></div>
            </div>
            <!-- wrap_resources end-->
    <? } ?>        
            <div class="click_bg mat10">
            <a href="/chinese/resources/bible-study.htm"><p class="click">查看更多查经</p></a>
            </div>