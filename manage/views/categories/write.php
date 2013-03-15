     <div id="main" >
          <h2>Categories</h2>
        
        <!-- sub_nav start -->
        <? /*
        <div id="sub_nav">
            <ul>
                         <li><a href="virtualoffice_mail.htm">Client List</a></li>
                <li><a href="virtualoffice_mail2.htm">Mail Update</a></li>

                <li><a href="virtualoffice_mail3.htm">Pick Up</a></li>
                <li class="current"><a href="virtualoffice_mail4.htm">Forwarding</a></li>
            </ul>
        <div class="clear"></div>
        </div>
        <!-- sub_nav end -->
        <h3>Virtual Office Mail</h3>
        <h4>Mail Status</h4>
        
         * 
         * 
         */ ?>
    <form method="post" name="layoutsform" action="<?=$_SERVER['REQUEST_URI'] ?>" id="layoutsform" >
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_admin2">
          <tr>
            <th class="bdr_top" width="150">Item</th>
            <th class="bdr_top" >Contents</th>
          </tr>
<?
        $form_hidden_array  = array('id');
        $form_none_array    = array();
        $form_text_array  = array('title','slug');
        $form_file_array    = array();
        $form_textarea      = array('definition');
        $datafields          = array('id','title','slug','definition');
        
        foreach($datafields as $v){ 
            if(in_array($v,$form_none_array))
                contunue;
            else if(in_array($v,$form_hidden_array))
                echo '<input type="hidden" name="'.get_class($Model).'['.$v.']" value="'.$Model -> data[$v].'" />';
            else if(in_array($v,$form_file_array)){ ?>
          <tr>
            <td><?=$v ?></td>
            <td><? echo '<input type="file" name="'.get_class($Model).'['.$v.']" value="'.$Model -> data[$v].'" />'; ?></td>
          </tr>
<?          }else if(in_array($v , $form_textarea)){ ?>
          <tr>
            <td>Intro</td>
            <td><? echo '<textarea class="richtext" type="file" name="'.get_class($Model).'['.$v.']" value="'.$Model -> data[$v].'" ></textarea>'; ?></td>
          </tr>
<?          }else{
            ?>
          <tr>
            <td><?=$v ?></td>
            <td><? echo '<input type="text" name="'.get_class($Model).'['.$v.']" value="'.$Model -> data[$v].'" />'; ?></td>
          </tr>
<?                
            }                    
      }
?>          
           
           <tr>
            <Td>Main(Main page right box)</Td>
            <td><select name="<?=get_class($Model) ?>[mainpage]" >
                 <option value="">- select -</option>
                <?
                	 $mainkey = array('N' => 'No','Y' => 'Yes');
                    foreach($mainkey as $k => $v){
                    		if($k == $Model -> data['mainpage']){
                    			$selected = 'selected="selected"';
                    		}else{
                    			$selected = '';
                    		}
                        echo "<option ".$selected." value='{$k}' >{$v}</option> \r\n";
                    }
                ?>
            </select>
            
           </tr>
           <tr>
            <Td>Common(topic main) </Td>
            <td><select name="<?=get_class($Model) ?>[commonpage]" >
                 <option value="">- select -</option>
                <?
                	 $mainkey = array('N' => 'No','Y' => 'Yes');
                    foreach($mainkey as $k => $v){
                    		if($k == $Model -> data['commonpage']){
                    			$selected = 'selected="selected"';
                    		}else{
                    			$selected = '';
                    		}
                        echo "<option ".$selected." value='{$k}' >{$v}</option> \r\n";
                    }
                ?>
            </select>
            
           </tr>
           
        </table>
    
        
        <div id="bt_rt">
            <input type="submit" value="Submit" class="bt_submits" /> <input type="button" value="Cancel" class="bt_cancel" />
        </div>
    </form>    

        
        
    <div class="clear"></div>
    </div>
