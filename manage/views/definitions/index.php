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
        
          <h2><?=$categorydata['title'] ?> - Documents</h2>
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_admin2">
          <tr>

            <th width="90">ID</th>
            <th>Title</th>
            <th>keywords</th>
            
            <th width="150">options</th>
          </tr>
<? foreach($data as $key => $val){
		
?>
          <tr>
            <td width="90"><?=$val['id'] ?></td>
            <td><?=stripslashes($val['title']) ?></td>
            <td><?=$val['keywords'] ?></td>
            
            <td width="150">
            <!--input type="button" class="btn" name="Edit" value="Edit"  /-->
                <a href="/manage/index.php?r=definitions/edit&cat=<?=$cat ?>&id=<?=$val['id'] ?>">Edit</a>
                
            </td>
          </tr>
<?    
}   ?>     <tr>
            <td colspan="5">
            <a href="/manage/index.php?r=definitions/add&cat=<?=$cat ?>">New</a>
            </td>
            </tr>  
        </table>
<?
    $this ->paging($page,$limittotal,$limitlist,$limitpage);
?>                

        
        
    <div class="clear"></div>
    </div>
