    <!-- main start -->
    <div id="main">
    <h2>Articles</h2>
    <? if($error_array){ ?>
        <div class="errorbox">
        <ul>
        <?
            foreach($error_array as $errormsg){
                echo '<li>'.$errormsg.'</li>';
            }
         ?>   
        </ul>
        </div>
    <? } ?>
    <form method="post" name="articleform" action="<?=$_SERVER['REQUEST_URI'] ?>" id="articleform" >
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_admin2">
          <tr>
            <th class="bdr_top" width="150">Item</th>
            <th class="bdr_top" >Contents</th>
          </tr>
<?
        $form_hidden_array  = array('id',"tempimages","uid","output",'clicks');
        $form_none_array    = array('country');
        $form_select_array  = array('autoupdate');
        $form_file_array    = array('src');
        $form_textarea      = array('content');
        $form_textarea1      = array('summary');
        $datafields          = array('id','tempimages','uid','title','specialcat','category','reportername','summary','content','keywords','source','registerdate','clicks','output');
        if(!$Model -> data['uid'])
            $Model -> data['uid'] = $uid;
        if(!$Model -> data['output'])
            $Model -> data['output'] = 'Q';
        if(!$Model -> data['registerdate'])            
        	 $Model -> data['registerdate'] = date('Y-m-d H:i:s');
        foreach($datafields as $v){ 
            if(in_array($v,$form_none_array))
                contunue;
            else if(in_array($v,$form_hidden_array))
                echo '<input type="hidden" id="'.strtolower(get_class($Model)).'_'.$v.'" name="'.get_class($Model).'['.$v.']" value="'.$Model -> data[$v].'" />';
            else if('mcat' == $v){ ?>
          


<?           }else if('category' == $v){ ?>
          
          <tr>
            <td>Category</td>
            <td>
            <? echo $Model -> data[$v]; ?>
            <select class="select250" name="<?=get_class($Model) ?>[category]" >
                    <option value="" >-Select-</option>
                <?
                
                    foreach($categories as $vv ){
                        $selected = $Model -> data[$v] == $vv['id'] ? 'selected="selected"' : '';
                        echo '<option '.$selected.'  value="'.$vv['id'].'">'.stripslashes($vv['title']).'</option>';
                    }
                ?>
            </select></td>
          </tr>
<?          }else if('specialcat' == $v){ ?>
          <tr>
            <td>Special Category</td>
            <td>   
                    
                    
            <ul class="spdata">
            <? 
                $sp_p_arr = array();
                $sp_s_arr = array();
                if(!$myspecialcats)
                    $myspecialcats = array();
                
                foreach($specialcats as $vv){
                    if($vv['parentid'] > 0){
                        $pid = $vv['parentid'];
                        $sp_s_arr[$pid][] = $vv;
                    }else{
                        $sp_p_arr[] = $vv;    
                    }
                }
                foreach($sp_p_arr as $vv){
                    $checked = in_array($vv['id'],$myspecialcats) ? 'checked="checked"' : '';
                    echo "<li><input {$checked} type=\"checkbox\" value=\"{$vv['id']}\" name=\"".get_class($Model)."[specialcats][]\" >  {$vv['title']}</li> \r\n";
                    $pid = $vv['id'];
                    if($sp_s_arr[$pid]){
                        echo "<ul id=\"spdata_{$pid}\">";
                        foreach($sp_s_arr[$pid] as $vvs){
                            $checked = in_array($vvs['id'],$myspecialcats) ? 'checked="checked"' : '';
                            echo "<li><input {$checked} type=\"checkbox\" value=\"{$vvs['id']}\" name=\"".get_class($Model)."[specialcats][]\" /> {$vvs['title']}</li> \r\n";
                        }
                        echo "</ul>";
                    }
                }
                
            /*
            <select class="select250" name="<?=get_class($Model) ?>[specialcat]" >
                    <option value="" >-Select-</option>
                <?
                    $specialid  = $Model -> data[$v];
                    $specialsmid= $Model -> data['specialcatsm'];  
                    if($specialsmid > 0)
                        $specialid = $specialsmid;
                    foreach($specialcats as $vv ){
                        $selected = $specialid == $vv['id'] ? 'selected="selected"' : '';
                        $addstepchar = $vv['parentid'] > 0 ? ' -- ' : '';
                        echo '<option '.$selected.' value="'.$vv['id'].'">'.$addstepchar.$vv['title'].'</option>';
                    }
                ?>
                </select>
                */ ?>
                </ul>
            </td>
          </tr>
<?          }else if('source' == $v){ ?>
          <tr>
            <td>Source</td>
            <td>

            <select class="select250" name="<?=get_class($Model) ?>[source]" >
                    <option value="" >-Select-</option>
                <?
                    foreach($sources as $k => $vv ){
                        $selected = $Model -> data[$v] == $k ? 'selected="selected"' : '';
                        echo '<option '.$selected.' value="'.$k.'">'.$vv.'</option>';
                    }
                ?>
                </select>
            </td>
          </tr>
          
<?          }else if(in_array($v,$form_file_array)){ ?>
          <tr>
            <td><?=$v ?></td>
            <td><? echo '<input type="file" name="'.get_class($Model).'['.$v.']" value="'.$Model -> data[$v].'" />'; ?></td>
          </tr>
<?          }else if(in_array($v , $form_textarea)){ ?>
          <tr>
            <td><?=$v ?></td>
            <td><? echo '<textarea class="richtext"  name="'.get_class($Model).'['.$v.']"  >'.$Model -> data[$v].'</textarea>'; ?></td>
          </tr>
<?          }else if(in_array($v , $form_textarea1)){ ?>
          <tr>
            <td><?=$v ?></td>
            <td><? echo '<textarea cols="70" rows="
            5"  name="'.get_class($Model).'['.$v.']"  >'.$Model -> data[$v].'</textarea>'; ?></td>
          </tr>
<?          }else{
            ?>
          <tr>
            <td><?=$v ?></td>
            <td><? echo '<input size="70" type="text" name="'.get_class($Model).'['.$v.']" value="'.$Model -> data[$v].'" />'; ?></td>
          </tr>
<?                
            }                    
      }
?>
           <tr>
            <td>Images</td>
            <td><div class="btn"><a href="./?r=articleimages/ajaxadd&uid=<?=$uid ?>&articleid=<?=$Model -> id ?>&height=400&width=600" title="Position" class="thickbox" >Add</a></div>
                <div id="imageboxes" >
                </div>
                <script type="text/javascript">
                    showimages('<?=$Model -> data['uid'] ? $Model -> data['uid'] : $uuid; ?>','<? echo $Model -> data['id'] ?>');
                </script>
            </td>
           </tr>          
        </table>
       
    
        
        <div id="bt_rt">
            <input type="submit" value="Submit" class="bt_submits" /> 
            <input type="button" value="Cancel" class="bt_cancel" />
        </div>
    </form>    

        
        
    <div class="clear"></div>
    </div>
    <script type="text/javascript">
        showimages('<?=$uid ?>','<?=$Model -> id ?>');
    </script>