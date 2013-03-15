    <div id="main">
        <!-- search_box start -->
          
          <?
            $this ->searchbar($searchoption);
            
            //toplink
            $_topget = $_GET;
            $orderinfo = $_topget['order'];
            $orderinfo = $orderinfo == 'down' ? 'up' : 'down';
            unset($_topget['field']);
            unset($_topget['order']);
            unset($_topget['r']);
            $topurl =  $_SERVER['PHP_SELF']."?r=".$_GET['r'];
            foreach($_topget as $k => $v){
                $topurl .= "&".$k."=".urlencode($v);    
            }
          ?>                

                <!-- search_box end -->
        
          <h2>Articles</h2>
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_admin2">
          <tr>

            <th width="90">ID</th>
            <th>Title</th>
            <th>Topic</th>
            <th>Main Category</th>
            <th>img</th>
            <th><a href="<?=$topurl."&field=output&order=".$orderinfo ?>">Status</a></th>
            <th><a href="<?=$topurl."&field=clicks&order=".$orderinfo ?>">clicks</a></th>
            <th width="50">options</th>
          </tr>
<? foreach($data as $key => $val){
?>
          <tr>
            <td width="90"><?=$val['id'] ?></td>
            <td><a href="<?=Strings::md_article_onlylink($val['id'],$val['registerdate'],$val['keywords']); ?>" target="article"><?=stripslashes($val['title']) ?></a></td>
            <td><? $cat = $val['category'];
            			 echo $categories[$cat];
            	 ?></td>
            <td><? $mcat = $val['mcat'];
            			 echo $mcats[$mcat];	
            			
            	 ?></td>
            <td><? if($val['image_id'] > 0 )
                       echo '<img src="/new/images/photo_img.gif">'; 
            ?></td>     
            <td class="tdstatus"><? 
            		if($publishfnc == 'Y'){
										$arr= array('Q' => 'Queue',
																'P' => 'Published',
																'N' => 'Reject');
										echo '<select  name="publish-'.$val['id'].'" id="publish-'.$val['id'].'" >';
											foreach($arr as $ak => $av){
												$selected = $ak == $val['output'] ? 'selected="selected"' : '';
												echo '<option '.$selected.' value="'.$ak.'">'.$av.'</option>';
											}
										echo '</select>';																
            		}else{
	            		switch($val['output']){
	            			case 'Q': echo 'Queue'; break;
	            			case 'P': echo 'Published'; break;
	            			case 'N': echo 'Reject'; break;
	            			default: echo  'Queue'; break;
	            		}
            		}
            		
            	 ?></td>
            <td><?=number_format($val['clicks']); ?></td>	 	 
            <td width="70">
            <!--input type="button" class="btn" name="Edit" value="Edit"  /-->
                <a href="/manage/index.php?r=articles/edit&id=<?=$val['id'] ?>">Edit</a>
                
            </td>
          </tr>
<?    
}   ?>     <tr>
            <td colspan="5">
            <a href="/manage/index.php?r=articles/add">New</a>
            </td>
            </tr>  
        </table>
<?
    $this ->paging($page,$limittotal,$limitlist,$limitpage);
?>                
    <div class="clear"></div>
    </div>
    <script type="text/javascript">
    	$("td.tdstatus select").change(function(){
					var idstr = $(this).attr("id");
					var idarr = idstr.split('-');
					var idnum  = idarr[1];
					var publish = $(this).val();
					var dataobj= {'id':idnum,'publish':publish}
					$.post('./?r=articles/ajaxpublished',dataobj,function(data){
						alert(data);
					});
					
    		});
    		

    </script>
