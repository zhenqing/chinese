    <!-- main start -->
<?
    
    print_r($this ->form);
?>
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
        <? /*
        <div id="sub_nav">
            <ul>
                         <li><a href="virtualoffice_mail.htm">Client List</a></li>
                <li><a href="virtualoffice_mail2.htm">Mail Update</a></li>

                <li><a href="virtualoffice_mail3.htm">Pick Up</a></li>
                <li class="current"><a href="virtualoffice_mail4.htm">Forwarding</a></li>
            </ul>
        <div class="clear"></div>
        </div>
        <!-- sub_nav end -->
        <h3>Virtual Office Mail</h3>
        <h4>Mail Status</h4>
        
         * 
         * 
         */ ?>
    <form method="post" name="layoutsform" action="<?=$_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data" id="layoutsform" >
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_admin2">
          <tr>
            <th class="bdr_top" width="200">Item</th>
            <th class="bdr_top" >Contents</th>
          </tr>
<?
        $datafields          = array('id','title','summary','content');
        
        $form_hidden_array  = array('id');
        $form_none_array    = array('country');
        $form_select_array  = array('autoupdate');
        $form_file_array    = array('src');
        $autoupdate         = array('data' => array('Y' => 'YES',
                                                    'N' => 'No'));
        
        foreach($Model -> fields as $v){ 
            if(in_array($v,$form_none_array))
                contunue;
            else if(in_array($v,$form_hidden_array))
                echo '<input type="hidden" name="'.get_class($Model).'['.$v.']" value="'.$Model -> data[$v].'" />';
            else if(in_array($v,$form_file_array)){ ?>
          <tr>
            <td><?=$v ?></td>
            <td><? echo '<input type="file" name="'.get_class($Model).'['.$v.']" value="'.$Model -> data[$v].'" />'; ?></td>
          </tr>
<?          }
            else{
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
