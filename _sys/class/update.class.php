<?
 class Update{
     public function updatetpl($filename,$Model){
         if(defined('PAGESTATUS') && PAGESTATUS == 'COMMON'){
             if(is_file(PAGEPATH.$filename)){
                require(PAGEPATH.$filename);    
             }
             
         }else{
             //Model is Layout class
             //print_r($Model);
             
             $section   = $Model -> data['section'];
             $positiondata  =  $Model -> positiondata($section,$filename);
             $anum      = 0;
             $data      = array();
             
             if($positiondata){
                    $pos_id = $positiondata['id'];
                    $anum   = $positiondata['anum'];
                    $data = $Model -> updatedata($pos_id,$anum);      // Save all data in updatedata table
             }
             for($i=0;$i < $anum;$i++){
                $getid = $data[$i]['num'];
                if($data[$i]['img_path']){
                    $data[$i]['image'] = '<img src="'.MDconfig::DATA_FOLDER.'/'.$data[$i]['img_path'].'" alt="'.stripcslashes($data[$i]['title']).' - thumbs" />';
                }
                $data[$i]['number']  = '<input type="text" name="Article[]" size="10" value="'.$getid.'" >';
                if($getid)
                    $data[$i]['number']  .= '<img src="/images/ic_edit.jpg" onclick="tb_show(\'Edit News\',\'./?r=updatepages/ajaxupdata&morder='.$i.'&pos_id='.$pos_id.'\')" />';
                
             }
             
             MDPosition::showtabar($filename,$section,$Model -> data['id'],$pos_id);
			 echo '<div id="'.$section.'-'.$positiondata['id'].'">
                    <form name="ajax'.$section.'-'.$postion['id'].'" id="form-'.$section.'-'.$positiondata['id'].'" >
                        <input type="hidden" name="section" value="'.$section.'" />
                        <input type="hidden" name="filename" value="'.$filename.'" />
                        <input type="hidden" name="position_id" value="'.$positiondata['id'].'" />
             ';
                    require(TPLPATH.$filename);
             echo '     </form>
                    </div>';
              
         }
         
     }

     public function makedata($data,$Model){
         $newdata = array();
        foreach($data as $v){
            $query = 'select id,keywords,reporter_name,category 
                            from md_articles where id = "'.$v['id'].'" ';
        }
         
     }
 }
 ?>