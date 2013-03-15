    <div id="main">
        <!-- search_box start -->
          <div id="search_box">
        search
        <select name="" class="input_drop"> </select>
        <input name="input" type="text" class="input170" />
        <input type="button" value="Search" class="bt_submit mg_20" /> 
        <select name="" class="input_drop"> </select>
        <input type="button" value="Update" class="bt_cancel" />

</div>        <!-- search_box end -->
        
          <h2>Articles</h2>
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_admin2">
          <tr>

            <th width="90">ID</th>
            <th>Title</th>
            <th>Topic</th>
            <th>Main Category</th>
            <th>Status</th>
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
            <td><? 
            		switch($val['output']){
            			case 'Q': echo 'Queue'; break;
            			case 'P': echo 'Published'; break;
            			case 'N': echo 'Reject'; break;
            			default: echo  'Queue'; break;
            		}
            	 ?></td>	 
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

</script>