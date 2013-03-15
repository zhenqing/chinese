    <div id="tabbox3">
        <div id="headline">
<? foreach($data as $val){ ?>    
    <ul>
        <? if($val['image']){ ?><li><a href="<?=$val['link'] ?>"><?=$val['image'] ?></a><? } ?></li>
        <li class="title"><a href="<?=$val['link'] ?>"><?=$val['title'] ?></a><?=$val['number'] ?></li>
        <li class="text"><?=$val['summary'] ?>
        <br /><span class="more"><a href="<?=$val['link'] ?>">更多</a></span></li>
    </ul>
<? } ?>    
    <div class="clear"></div>
    </div>
    </div>