<style type="text/css">
	body{padding:10px;}
	.tb_admin2{margin-top:10px;}
	.tb_admin2 td,.tb_admin2 th{border:1px #CCCCCC solid;  border-collapse:collapse;padding:5px 10px;}
	</style>
	

          <h3><?=$section ?> - <?=$filename ?></h3>
        
        <!-- sub_nav start -->

		<? if($poststatus =='success'){
					echo "<h4>Data is saved</h4>";
					exit();
			 }
				
				?>    
    <form class="editposition" method="post" name="layoutsform" action="<?=$_SERVER['REQUEST_URI'] ?>"  >
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_admin2">
          <tr>
            <th class="bdr_top" width="200">Item</th>
            <th class="bdr_top" >Contents</th>
          </tr>
<?
				
        $form_hidden_array  = array('id','section','filename','sectionid','datatype');
        $form_none_array    = array('country');
        $form_select_array  = array('autoupdate');
        $form_file_array    = array('src');
        $autoupdate         = array('data' => array('Y' => 'YES',
                                                    'N' => 'No'));
        $Model -> data['section']                   = $section;
        $Model -> data['sectionid']									= $sectionid;
        $Model -> data['filename']                  = $filename;
        
        $name_key = array('anum' => 'Article num',
        									'm_order' => 'Order',
        									'showtype' => 'Showtype',
        									'dataname' => 'Data',
        									'textbox'   => 'Textbox',
        									'boxtitle'   => 'Box Title',
        									'image_width' => 'Image Width',
        									'image_height' => 'Image Height',
        									'cut_str_min ' => 'cut Summary min',
        									'cut_str_max ' => 'cut Summary max',
        									'duplicate' =>'Allow to duplicate',
        									'image_fixed' => 'Image Option',
        									);    
        $form_select_array 				= array('showtype','duplicate','image','category','image_fixed');   
        $select_image_array  			= array('N' => 'None','A' => 'Auto','M' => 'Manual');   									                                                                                                    
        $select_duplicate_array  	= array('Y' => 'To allow','N' => 'Not to allow');   									                                                                                                    
        $select_image_fixed_array = array('T' => 'Thumb','F' => 'Fixed','W' => 'Width','H' => 'Height');
        $select_category_array  	= array('Y' => 'Yes','N' => 'No');   									                                                                                                    
        $select_showtype_array  	= array('M' => 'Manual','A' => 'Auto');   									                                                                                                    
        $select_duplicate_array  	= array('Y' => 'Yes','N' => 'No');   									                                                                                                    
        foreach($Model -> fields as $v){ 
            if(in_array($v,$form_none_array))
                contunue;
            else if(in_array($v,$form_hidden_array))
                echo '<input type="hidden" id="'.$v.'" name="'.get_class($Model).'['.$v.']" value="'.$Model -> data[$v].'" />';
            else if(in_array($v,$form_select_array)){
							echo "<Tr><td>";
							echo $name_key[$v] ? $name_key[$v] : ucfirst($v);
							echo "</td><td> ";	
							
							echo '	<select id="form-'.$v.'" name="'.get_class($Model).'['.$v.']"  />
												<option value="">-Select-</option>';
							foreach(${'select_'.$v.'_array'} as $k => $vv){
								$selected = $k == $Model -> data[$v] ? 'selected="selected"' : '';
								echo '<option '.$selected.' value="'.$k.'">'.$vv.'</option> ';
							}
							
												
							echo "		</select>
											</td></tr>";
            }    
            else{
            ?>
          <tr>
            <td><?
            			if($name_key[$v])
            				echo $name_key[$v];
            			else 	
            				echo ucfirst($v);
            	 ?></td>
            <td><? echo '<input type="text"  id="'.$v.'" name="'.get_class($Model).'['.$v.']" value="'.$Model -> data[$v].'" />'; ?></td>
          </tr>
<?                
            }                    
      }
?>          
        </table>
    
        
        <div id="bt_rt">
            <input type="submit" id="submitbtn" value="Submit" class="bt_submits"  /> 

        </div>
    </form>    

        
        
  