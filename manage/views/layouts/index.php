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
        
          <h2>Layout</h2>
        
        <!-- sub_nav start -->
        <!--div id="sub_nav">
            <ul>
                   <li class="current"><a href="virtualoffice_mail.htm">Client List</a></li>
                <li><a href="virtualoffice_mail2.htm">Mail Update</a></li>

                <li><a href="virtualoffice_mail3.htm">Pick Up</a></li>
                <li><a href="virtualoffice_mail4.htm">Forwarding</a></li>
            </ul>
        <div class="clear"></div>
        </div-->
        <!-- sub_nav end -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_admin2">
          <tr>

            <th width="90">ID</th>
            <th>Section</th>
            <th>Page code</th>
            <th>page folder / page file</th>
            <th width="150">options</th>
          </tr>
<? foreach($data as $key => $val){
?>
          <tr>
            <td width="90">ID</td>
            <td><?=$val['section'] ?></td>
            <td><?=$val['pagename'] ?></td>
            <td><?=$val['folder'] ?> / <?=$val['filename'] ?></td>
            <td width="150">
            <!--input type="button" class="btn" name="Edit" value="Edit"  /-->
                <a href="index.php?r=layouts/edit&id=<?=$val['id'] ?>">Edit</a>
                <input type="button" class="btn" onclick="document.location = 'index.php?r=updatepages/index&id=<?=$val['id'] ?>';"  name="Update" value="Update" />
            </td>
          </tr>
<?    
}   ?>       
        </table>
<?
    $this ->paging($page,$limittotal,$limitlist,$limitpage);
?>                

        
        
    <div class="clear"></div>
    </div>
