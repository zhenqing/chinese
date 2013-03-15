    <div id="main">
        <!-- search_box start -->
        <? 
        
        
        $this -> searchbar($searchoption); ?>
        <!-- search_box end -->
        
          <h2>Categories</h2>
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_admin2">
          <tr>

            <th width="90">ID</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Category Key</th>
            <th width="150">options</th>
          </tr>
<? foreach($data as $key => $val){
?>
          <tr>
            <td width="90"><?=$val['id'] ?></td>
            <td><?=stripslashes($val['title']) ?></td>
            <td><?=$val['slug'] ?></td>
            <td><?=$val['mdkey'] ?></td>
            <td width="150">
            <!--input type="button" class="btn" name="Edit" value="Edit"  /-->
                <a href="index.php?r=categories/edit&id=<?=$val['id'] ?>">Edit</a>
            </td>
          </tr>
<?    
}   ?>     <tr>
            <td colspan="5">
            <a href="index.php?r=categories/add">New</a>
            </td>
            </tr>  
        </table>
<?
    $this ->paging($page,$limittotal,$limitlist,$limitpage);
?>                

        
        
    <div class="clear"></div>
    </div>
