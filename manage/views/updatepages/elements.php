    <form method="post" class="edit-form" name="editform" action="<?=$_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data" id="editform1" >
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb_admin2">
          <tr>
            <th class="bdr_top" width="200">Item</th>
            <th class="bdr_top" >Contents</th>
          </tr>
<?
        $datafields          = array('id','pos_id','num','img_num','img_path','category','link','registerdate','m_order','sectionname','publish_id','title','summary','reportername',);
        
        $form_hidden_array  = array('id','pos_id','num','img_num','img_path','category','link','registerdate','m_order','sectionname','publish_id','related','related_num','multimedia');
        $textarea_array     = array('summary');
        $form_file_array    = array('src');
        $form_none_array    = array();
        $autoupdate         = array('data' => array('Y' => 'YES',
                                                    'N' => 'No'));
        var_dump($udata);
        foreach($Model -> fields as $v){ 
            if(in_array($v,$form_none_array))
                contunue;
            else if(in_array($v,$form_hidden_array))
                echo '<input type="hidden" id="data-'.$v.'" name="'.get_class($Model).'['.$v.']" value="'.$Model -> data[$v].'" />';
            else if(in_array($v,$textarea_array)){ ?>
          <tr>
            <td><?=$v ?></td>
            <td><? echo '<textarea  cols="50" rows="5" name="'.get_class($Model).'['.$v.']" >'.$Model -> data[$v].'</textarea>'; ?></td>
          </tr>
<?          }
            else{
            ?>
          <tr>
            <td><?=$v ?></td>
            <td><? echo '<input type="text" size="40" name="'.get_class($Model).'['.$v.']" value="'.$Model -> data[$v].'" />'; ?></td>
          </tr>
<?                
            }                    
      }
?>          
        </table>
        <div id="bt_rt">
            <input type="button" value="Submit" id="btn-submit" class="adsubmit" class="bt_cancel" />
        </div>
    </form>    
<script type="text/javascript">
    $("#btn-submit").click(function(){
        
       $.post('<?=$_SERVER['REQUEST_URI'] ?>',$("#editform1").serialize(),function(data){
           
           var pos      = $("#data-pos_id").val();
           var section  = $("#data-sectionname").val();
           $("#"+section+"-"+pos).html(data);
               alert(section+" + "+ pos);
           tb_remove();
       }); 
    });
</script>
