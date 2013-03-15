     <div id="main" >
          <h2>Categories</h2>
        
    <form method="post" name="layoutsform" action="<?=$_SERVER['REQUEST_URI'] ?>" id="layoutsform" >
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_admin2">
          <tr>
            <th class="bdr_top" width="150">Item</th>
            <th class="bdr_top" >Contents</th>
          </tr>
<?
        $form_hidden_array  = array('id');
        $form_none_array    = array();
        $form_text_array  = array('title','jobtype');
        $form_file_array    = array();
        $form_textarea      = array('content');
        $datafields          = array(	'id','title','category','jobtype','content',
        															'name','company','address','city','state','zipcode','userip','registerdate');
        
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
            <td>Contnet</td>
            <td><? echo '<textarea  name="'.get_class($Model).'['.$v.']" cols="50" rows="9"  >'.$data1[0]['content'].'</textarea>'; ?></td>
          </tr>
<?          }else if($v == 'category'){ ?>
          <tr>
            <td>Category</td>
            <td>
            		<select name="<?=get_class($Model).'['.$v.']' ?>" >
            				<option value=""> -- select -- </option>
            				<? 	
            						foreach($categories as $cv){ 
            							$selected = $Model -> data[$v] == $cv['id'] ? 'selected' : "";
            							?>
            							<option <?=$selected ?> value="<?=$cv['id'] ?>"><?=$cv['title'] ?></option>
            				<? } ?>
            		</select>
            	</td>
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
           
           
        </table>
    
        
        <div id="bt_rt">
            <input type="submit" value="Submit" class="bt_submits" /> <input type="button" value="Cancel" class="bt_cancel" />
        </div>
    </form>    

        
        
    <div class="clear"></div>
    </div>
