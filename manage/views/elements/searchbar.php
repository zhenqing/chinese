<div id="search_box">
            <form method="get" action="<?=$_SERVER['PHP_SELF'] ?>" >
            <input type="hidden" name="r" value="<?=$_GET['r'] ?>" />
        search
        <select name="searchopt" class="input_drop"> 
            <? if(isset($searchoption)){
                foreach($searchoption as $k => $v){
                   $selected = $k == $_GET['searchopt'] ? 'selected="selected"' : '';
                   echo "<option ".$selected." value='".$k."'>".$v."</option> \r\n";
                }
            }       ?>
        </select>
        <input  value="<?=$_GET['search'] ?>" name="search" type="text" class="input170" />
        <input type="submit" value="Search" class="bt_submit mg_20 bgred" /> 
        
        </form>
        

</div>