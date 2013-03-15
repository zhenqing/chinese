<script type="text/javascript">
		function deletepost(idnum){
			if(confirm("Do you want to delete this?")){
				document.location = "/manage/index.php?r=jobposts/delete&id="+idnum;
			}
		}
</script>

    <div id="main">
        <!-- search_box start -->
        <? 
        $this -> searchbar($searchoption); ?>
        <!-- search_box end -->
        
          <h2>Job Posts</h2>
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_admin2">
          <tr>

            <th width="90">ID</th>
            <th>Title</th>
            <th>Job type</th>
            <th>Address</th>
            <th>Date</th>
            <th width="150">options</th>
          </tr>
<? foreach($data as $key => $val){
?>
          <tr>
            <td width="90"><?=$val['id'] ?></td>
            <td><?=stripslashes($val['title']) ?></td>
            <td><?=$val['jobtype'] ?></td>
            <td><?=$val['city'] ?>, <?=$val['state'] ?> <?=$val['zipcode'] ?></td>
            <td><?=$val['registerdate'] ?></td>
            <td width="100">
            <!--input type="button" class="btn" name="Edit" value="Edit"  /-->
                
                <a href="/jobs/description.htm?id=<?=$val['id'] ?>" target="_blank">View</a>
                <a href="/manage/index.php?r=jobposts/edit&id=<?=$val['id'] ?>" >Edit</a>
                <a href="javascript:void(0);" onclick="deletepost('<?=$val['id'] ?>');">Delete</a>
            </td>
          </tr>
<?    
}   ?>     <tr>
            <td colspan="6">
            <a href="/manage/index.php?r=jobcategories/add">New</a>
            </td>
            </tr>  
        </table>
<?
    $this ->paging($page,$limittotal,$limitlist,$limitpage);
?>                

        
        
    <div class="clear"></div>
    </div>
