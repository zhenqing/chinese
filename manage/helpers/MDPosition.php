<?
  class MDPosition extends DB{
      public function __construct(){
          
      }
      
      public function showtabar($filename,$section,$sectionid,$pos_id=null){ 
          ?>
      <div class="tabbar">
        <a href="./?r=positions/ajaxedit&filename=<?=$filename ?>&sectionid=<?=$sectionid ?>&section=<?=$section ?>&TB_iframe=true" title="Position" class="thickbox" >Edit</a>
        <? if(is_numeric($pos_id)){ ?>
            <input type="button" onclick="setdata('<?=$section ?>','<?=$filename ?>','<?=$pos_id ?>');" value="save" >
        <? } ?>
      </div>    
      <? }
      
      public function makebar($sectionid){
      ?>
        <div id="makepage">
            <ul>
                <li><a href="./?r=updatepages/makepage&id=<?=$sectionid ?>">Make page</li>
                <li><a href="./?r=layouts/index">Go to admin</a></li>
            </ul>
        </div>
      <?    
      }  
  }
?>