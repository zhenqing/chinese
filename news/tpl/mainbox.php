            <div class="wrap_headline">
            <? foreach($data as $val){
                ?>
              <?=$val['image'] ?>
                <h2><a href="<?=$val['link'] ?>"><?=$val['title'] ?></a><?=$val['number'] ?></h2>
                <p class="writer"><?=$val['reportername'] ? 'BY '.$val['reportername'].' | ' : ''; ?>  
                <span  class="date"><?=date('F d, Y',strtotime($val['registerdate'])) ?></span></p>
                <p><?=$val['summary'] ?></p>
                <div class="clear"></div>
            <? } ?>    
          </div>
