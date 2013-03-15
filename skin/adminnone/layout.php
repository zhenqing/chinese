    <? // Main innerpage;
        if($this -> pagepath)
            require_once('views/'.$this -> pagepath);
        //right innerpage
        if($rightinner)
            require_once($rightinner);
     ?>
