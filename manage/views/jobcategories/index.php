    <div id="main">
        <!-- search_box start -->
        <? 
        
        
        $this -> searchbar($searchoption); ?>
        <!-- search_box end -->
        
          <h2>Job Categories</h2>
        
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
                <a href="/manage/index.php?r=jobcategories/edit&id=<?=$val['id'] ?>">Edit</a>
                <a href="/manage/index.php?r=definitions/index&cat=<?=$val['id'] ?>">Definitions</a>
            </td>
          </tr>
<?    
}   ?>     <tr>
            <td colspan="5">
            <a href="/manage/index.php?r=jobcategories/add">New</a>
            </td>
            </tr>  
        </table>
<?
    $this ->paging($page,$limittotal,$limitlist,$limitpage);
?>                

        
        
    <div class="clear"></div>
    </div>
