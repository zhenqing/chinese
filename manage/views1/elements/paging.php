<?

    $totalpage = ceil($limittotal / $limitlist);
    $startpage = floor(($page - 1)/$limitpage)*$limitpage + 1;
    $endpage   = $startpage + $limitpage - 1 >=  $totalpage ? $totalpage : $startpage + $limitpage - 1;
            
    
    
?>
        <div class="pages">
            <ul>
             <? 
             
                $url = preg_replace("/\&page\=[0-9]+/" ,'',$_SERVER['REQUEST_URI']);
                for($i=$startpage;$i <= $endpage ;$i++){   
                    $current = $page == $i ? 'current' : '';
                    echo  "<li class=\"pageli {$current}\"><a href=\"".$url.'&page='.$i."\">{$i}</a></li> \r\n"; 
                }   
                ?>
                <li><a href="#">next &gt;</a></li>
            </ul>
          </div>
