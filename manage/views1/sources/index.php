    <div id="main">
         <? $this -> searchbar($searchoption); ?>   
        
          <h2>Sources</h2>
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_admin2">
          <tr>

            <th width="90">ID</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Footer</th>
            <th width="150">options</th>
          </tr>
<? foreach($data as $key => $val){
?>
          <tr>
            <td width="90"><?=$val['id'] ?></td>
            <td><?=stripslashes($val['title']) ?></td>
            <td><?=$val['slug'] ?></td>
            <td><?=$val['footer'] ?></td>
            <td width="150">
            <!--input type="button" class="btn" name="Edit" value="Edit"  /-->
                <a href="/manage/index.php?r=sources/edit&id=<?=$val['id'] ?>">Edit</a>
                
            </td>
          </tr>
<?    
}   ?>     <tr>
            <td colspan="5">
            <a href="/manage/index.php?r=sources/add">New</a>
            </td>
            </tr>  
        </table>
<?
    $this ->paging($page,$limittotal,$limitlist,$limitpage);
?>                

        
        
    <div class="clear"></div>
    </div>
