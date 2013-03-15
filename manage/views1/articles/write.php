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
        $datafields          = array('id','tempimages','uid','title','mcat','specialcat','category','reportername','summary','content','keywords','source','registerdate','clicks','output');
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
          
          <tr>
            <td>Main Category</td>
            <td>
            
            <select class="select250" name="<?=get_class($Model) ?>[mcat]" >
                    <option value="" >-Select-</option>
                <?
                    foreach($mcats as $k =>  $vv ){
                        $selected = $Model -> data[$v] == $k ? 'selected="selected"' : '';
                        echo '<option '.$selected.' value="'.$k.'">'.stripslashes($vv).'</option>';
                    }
                ?>
            </select></td>
          </tr>

<?           }else if('category' == $v){ ?>
          
          <tr>
            <td>Topics</td>
            <td><select class="select250" name="<?=get_class($Model) ?>[category]" >
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
            <td><select class="select250" name="<?=get_class($Model) ?>[specialcat]" >
                    <option value="" >-Select-</option>
                <?
                
                    foreach($specialcats as $vv ){
                        $selected = $Model -> data[$v] == $vv['id'] ? 'selected="selected"' : '';
                        echo '<option '.$selected.' value="'.$vv['id'].'">'.$vv['title'].'</option>';
                    }
                ?>
                </select>
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