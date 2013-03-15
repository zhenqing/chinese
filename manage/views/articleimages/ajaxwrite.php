 <script type="text/javascript">
    function ajaxsubmit(){
        var oForm   = document.forms.imageform;      
        var tmpfile = oForm.tmpfile.value;
        
        if(tmpfile){
            var postvars = {title   :$(".ajaxtable #title").val() , 
                            reporter:$(".ajaxtable #reporter").val(),
                            summary : $(".ajaxtable #reporter").val(),
                            tmp_file: tmpfile } ;
                                                        
            $.post("./index.php?r=articleimages/ajaxinsert",$("#tbimageform").serialize(),function(data){
                var oForm1   = document.forms.imageform;      
                if(data){
                    var uidvalue = oForm1.elements[0].value;
                    var aidvalue = oForm1.elements[1].value;
                    
                    //var aidvalue = $(".ajaxtable #tableaid").val();
                    showimages(uidvalue,aidvalue);
                    //tb_remove();
                }
            });
            
            //alert($(".ajaxtable #title").val());
            //$("#imageboxes").html("TEST111");
            //
        }else
            alert("Upload files");
    }
    
    function callback_fn(filename){
        var oForm = document.forms.imageform;
        $(".ajaxtable #tmpfile").attr('value',filename);
        oForm.tmpfile.value = filename;
        
    }
 </script>
 <div class="uploadbox">
    <h4>Image Upload</h4>
    <div class="imagelists">
        <form method="post" name="imageform" id="tbimageform"  enctype="multipart/form-data" action="./?r=articleimages/ajaxadd" >
            <input type="hidden" name="Articleimage[uid]"      id="tableuid"    value="<?=$uid ?>" />
            <input type="hidden" name="Articleimage[articleid]" id="tableaid"   value="<?=$Model -> article_id ?>" />
            <input type="hidden" id="tmpfile" name="tmpfile" value=""  />
            <table class="ajaxtable" cellspacing="0">
                <tr>
                    <th width="70">item</td>
                    <th width="300">content</td>
                </tr>
                <tr>
                    <td>File</td>
                    <td>
<?  
    require_once '../uploader/class.FlashUploader.php';
    IFU_display_js();
    $uploader   = new FlashUploader('uploader', '../uploader/uploader', '../uploader/upload.php');
    $uploader   ->set('callback','callback_fn');
    $uploader   ->set('valid_extensions','*.jpg,*.gif,*.png');
    $uploader   ->display();
    
?>
                    </td>
                </tr>
                <tr>
                    <td> Title
                    </td>
                    <td> <input id="title" type="text" size="50" name="Articleimage[title]" value="<?=$Model -> title ?>" />
                    </td>
                </tr>                        
                <tr>
                    <td> Summary
                    </td>
                    <td> <textarea type="text" id="summary" rows="5" cols="40"  name="Articleimage[summary]" value="<?=$Model -> summary ?>" />
                    </td>
                </tr>                        
                <tr>
                    <td> Source
                    </td>
                    <td> <select  id="source"   name="Articleimage[source]" >
                                <option value="">- select - </option>
                            <? foreach($sourcedata as $v){ 
                                    $selected = $Model -> source == $v['id'] ? 'selected = "selected"' : '';
                                ?>
                                <option <?= $selected ?> value="<?=$v['id'] ?>" ><?=$v['title'] ?></option>
                            <? } ?>
                         </select>   
                    
                    </td>
                </tr>
                <tr>
                    <td> Reporter
                    </td>
                    <td> <input id="reporter" type="text" size="50"  name="Articleimage[reporter]" value="<?=$Model -> reporter ?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input onclick="ajaxsubmit();" type="button" value="submit" /></td>
                </tr>
                
            </table>
        </form>
    </div>
</div>