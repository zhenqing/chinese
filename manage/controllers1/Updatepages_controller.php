<?
    /*****************************
    *  Special Case Class
    *  Get from other layout and setting
    *  1. Make Template boxes
    */
    class UpdatepagesController extends CDcontrollers {
        public $layout = 'update';
        public $uses   = array('Layout','Updatedata','Position','Article','Category','Articleimage');
        public $helpers= array('MDPosition');
        
        public function ActionAjaxupdata(){
             $this -> layout = 'iframe'; 
            $morder=isset($_GET['morder']) ? $_GET['morder'] : ''; 
            $upid = isset($_GET['upid']) ? $_GET['upid'] : '';
            $posid= isset($_GET['pos_id']) ? $_GET['pos_id'] : ''; 
            $Updatedata = new Updatedata();
            if(is_numeric($upid)){
                $udata = $Updatedata -> find_primarykey($upid);
            }else{
                $udata = $Updatedata -> find_data(" pos_id = '{$posid}' and m_order = '{$morder}' ");
            }   
                $Updatedata -> data = $udata[0];
                if($_POST){
                    $Updatedata -> data = $_POST['Updatedata'];
                    if($Updatedata -> validate()){
                        $Updatedata -> save();
                        $this -> ActionAjaxposition($Updatedata -> pos_id);
                    }
                    
                        //print_r($_POST);
                }else
                    $this ->render('elements',array('Model' => $Updatedata));
            
        }
        public function ActionIndex(){
            $Layout         = new Layout();
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            if(!is_numeric($id))
                $this -> redirect('layouts/index');
            
            
            $this -> layout = 'update';
            $data           = $Layout -> find_primarykey($id);
            $Layout         -> data = $data[0];
            $folder         = $data[0]['folder'];                        
            $filename       = $data[0]['filename'];
            
            $header_script  = "<link href=\"/2010/css/admin.css\" rel=\"stylesheet\" type=\"text/css\" /> \r\n
                                <script type=\"text/javascript\" src=\"/js/homepage.js\" ></script> \r\n    
                                <script type=\"text/javascript\" src=\"/js/admin.js\" ></script> \r\n";    
            $maininner      = "body_left.php";
            
            $this -> render('index',array(  'Model'     => $Layout,
                                            'pagepath' => $folder.'/'.$filename,
                                            'section_id' => $id,
                                            'header_script' => $header_script ));
        }
        
        
        public function ActionAjaxposition($pos_id){
                 $Article       = new Article();
                 $Updatedata    = new Updatedata();
                 $Category      = new Category();   
                 $Position      = new Position();
                 $Articleimage  = new Articleimage();
                 $Layout        = new Layout();   
                 
                 
                 if(!is_numeric($pos_id))
                    exit();
                 $positiondatas  = $Position      -> find_primarykey($pos_id);  
                 $positiondata   = $positiondatas[0];
                                                           
                 $ldata      = $Layout -> find_primarykey($positiondata['sectionid']);
                 $layoutdata    = $ldata[0];
                 echo '                
                        <form name="ajax'.$layoutdata['section'].'-'.$positiondata['id'].'" id="form-'.$layoutdata['section'].'-'.$positiondata['id'].'" >
                            <input type="hidden" name="section" value="'.$layoutdata['section'].'" />
                            <input type="hidden" name="filename" value="'.$positiondata['filename'].'" />
                            <input type="hidden" name="position_id" value="'.$positiondata['id'].'" /> ';
                 
                 ob_start();             
                 $data = $Layout -> updatedata($positiondata['id'],$positiondata['anum']);
                 $i=0;
                 foreach($data as $v){
                    $data[$i]['number'] = '<input type="text" name="Article[]" size="10" value="'.$v['num'].'" > ';
                    if($v['num'] >0)
                        $data[$i]['number'] .= '<img src="/images/ic_edit.jpg" onclick="tb_show(\'Edit News\',\'./?r=updatepages/ajaxupdata&morder='.$i.'&pos_id='.$positiondata['id'].'\')" />';
                        
                    if($data[$i]['img_path']){
                        $data[$i]['image'] = '<img src="'.MDconfig::DATA_FOLDER.'/'.$data[$i]['img_path'].'" alt="'.stripcslashes($data[$i]['title']).' - thumbs" />';
                    }                     
                    $i++;
                 }
                 
                 require(MDconfig::ROOTPATH.'/'.$layoutdata ['folder'].'/tpl/'.$positiondata['filename']);
                 $output =  ob_get_contents();
                 ob_end_clean();
                 echo $output;
                 echo '     </form>';
            
        }
        
        public function ActionAjaxdataupdate(){
         $Article       = new Article();
         $Updatedata    = new Updatedata();
         $Category      = new Category();   
         $Position      = new Position();
         $Articleimage  = new Articleimage();
         $Layout        = new Layout();
         if(isset($_POST)){
             if(is_numeric($_POST['position_id'])){
                 $positionid  = $_POST['position_id'];
                 $pdata       = $Position ->  find_primarykey($positionid);
                 $positiondata= $pdata[0];
                 require_once("external/thumbs/ThumbLib.inc.php");
                 
                 foreach($_POST['Article'] as $k => $v){
                    $id_arr = $Updatedata ->updatedata_id($positionid,$k);    
                    if($id_arr)
                        $Updatedata -> id = $id_arr['id'];
                    $Updatedata ->m_order   =  $k;
                    $Updatedata ->pos_id    =  $positionid;
                    
                    //Article Information
                    $Updatedata ->num       =  $v;
                    $articleinfo= $Article  -> find_primarykey($v);
                    $Updatedata ->title     =  Strings::cutString($articleinfo[0]['title'],$positiondata['cut_str_min'],'');
                    $Updatedata ->summary   =  Strings::cutString($articleinfo[0]['summary'],$positiondata['cut_str_max']);
                    if($articleinfo[0]['category']){
                        $catinfo = $Category    -> find_primarykey($articleinfo[0]['category']);
                        $Updatedata ->category  = $catinfo[0]['title'];
                    }
                    $Updatedata ->registerdate  = $articleinfo[0]['registerdate'];
                    $Updatedata ->reportername  = $articleinfo[0]['reportername'];
                    $Updatedata ->link          = Strings::md_article_onlylink($v,$articleinfo[0]['registerdate'],$articleinfo[0]['keywords']);                                                                        
                    $Updatedata ->  img_path    = "";
                    //Image
                    if($positiondata['image'] == 'A' || $positiondata['image'] == 'M'){
                        $imagedata =$Articleimage -> find_data("article_id = '".$articleinfo[0]['id']."' ",array('order' => 'id ASC',
                                                            'limit' => ' 1'));
                        $filepath = $imagedata[0]['path'];                                                                                                                              
                        $fpoint = stripos($filepath,'/');
                        $filename = substr($filepath,$fpoint+3);
                        
                        
                        if($positiondata['image_fixed'] == 'T' && $imagedata){
                            $Updatedata ->  img_num = $imagedata[0]['id'];
                            $Updatedata ->  img_path= 'thumbs/'.$imagedata[0]['path'];
                        }else if($positiondata['image_fixed'] == 'F' && $imagedata){
                             $imageinfo = @getimagesize(Mdconfig::ROOTPATH.'/datainfo/images/'.$imagedata[0]['path']);
                             if($imageinfo){
                                 if($positiondata['image_width']/$positiondata['image_height'] < $imageinfo[0]/$imageinfo[1]){
                                    $thumb      = PhpThumbFactory::create(Mdconfig::ROOTPATH.'/datainfo/images/'.$imagedata[0]['path']);
                                    $thumb      -> resize($positiondata['image_height']*3,$positiondata['image_height']) -> cropFromCenter($positiondata['image_width'], $positiondata['image_height']);
                                    $path       = Mdconfig::ROOTPATH.'/datainfo/thumbs/main/'.$positiondata['image_width'].'-'.$filename;
                                    $thumb->save($path);
                                    $Updatedata ->  img_num = $imagedata[0]['id'];
                                    $Updatedata ->  img_path= 'thumbs/main/'.$positiondata['image_width'].'-'.$filename;
                                    
                                 }else{
                                    $thumb      = PhpThumbFactory::create(Mdconfig::ROOTPATH.'/datainfo/images/'.$imagedata[0]['path']);
                                    $thumb      -> resize($positiondata['image_width'],$positiondata['image_width']*3) -> cropFromCenter($positiondata['image_width'], $positiondata['image_height']);
                                    $path       = Mdconfig::ROOTPATH.'/datainfo/thumbs/main/'.$positiondata['image_width'].'-'.$filename;
                                    $thumb->save($path);
                                    $Updatedata ->  img_num = $imagedata[0]['id'];
                                    $Updatedata ->  img_path= 'thumbs/main/'.$positiondata['image_width'].'-'.$filename;
                                    
                                 
                                 }
                             }
                             
                             
                             
                        }
                                                                                                                                                    
                    }
                    $Updatedata ->sectionname= $_POST['section'];
                    $Updatedata ->publish_id = 1;
                    $Updatedata -> save();
                    $Updatedata -> clear();
                 }
                 
                 $this -> ActionAjaxposition($positiondata['id']);
                 /*
                 $ldata      = $Layout -> find_primarykey($positiondata['sectionid']);
                 $layoutdata = $ldata[0];

                 echo '                
                        <form name="ajax'.$layoutdata['section'].'-'.$positiondata['id'].'" id="form-'.$layoutdata['section'].'-'.$positiondata['id'].'" >
                            <input type="hidden" name="section" value="'.$layoutdata['section'].'" />
                            <input type="hidden" name="filename" value="'.$positiondata['filename'].'" />
                            <input type="hidden" name="position_id" value="'.$positiondata['id'].'" /> ';
                 
                 ob_start();             
                 $data = $Layout -> updatedata($positiondata['id'],$positiondata['anum']);
                 $i=0;
                 foreach($data as $v){
                    $data[$i]['number'] = '<input type="text" name="Article[]" size="10" value="'.$v['num'].'" > ';
                    //if($v['num'] >0)
                        //$data[$i]['number'] .= '<img src="/images/ic_edit.jpg" onclick="tb_show(\'Edit News\',\'./?r=updatepages/ajaxupdata&upid='.$v['num'].'\')" />';
                        
                    if($data[$i]['img_path']){
                        $data[$i]['image'] = '<img src="'.MDconfig::DATA_FOLDER.'/'.$data[$i]['img_path'].'" alt="'.stripcslashes($data[$i]['title']).' - thumbs" />';
                    }                     
                    $i++;
                 }
                 
                 require(MDconfig::ROOTPATH.'/'.$layoutdata ['folder'].'/tpl/'.$positiondata['filename']);
                 $output =  ob_get_contents();
                 ob_end_clean();
                 echo $output;
                 echo '     </form>';
                 */
             }
         }
            
        }
        
        public function ActionMakepage(){
            $Layout     = new Layout();
            $Position   = new Position();
            $idnum = isset($_GET['id']) ? $_GET['id'] : '';
            if(is_numeric($idnum)){
                $layoutdata     = $Layout -> find_primarykey($idnum);
                $ldata          = $layoutdata[0];
                $Layout         -> data = $ldata;
                $folder         = $ldata['folder'];                        
                $filename       = $ldata['filename'];
                
                $posdata        = $Position -> find_data("sectionid = '{$idnum}'",array('order' => 'id ASC'));
                foreach($posdata as $pk => $pv){
                   ob_start();
                   $data1 = $Layout -> updatedata($pv['id'],$pv['anum']);
                   $positiondata = $pv;
                   $data  = array();
                   foreach($data1 as $v){
                       if($v['img_path']){
                            $v['image'] = '<img src="/datainfo/'.$v['img_path'].'"  alt="thumbnail" />';    
                       }
                       $data[]     = $v;
                   }
                   
                   require(MDconfig::ROOTPATH.'/'.$ldata['folder'].'/tpl/'.$pv['filename']);
                   $output =  ob_get_contents();
                   ob_end_clean();
                   $filepath = MDconfig::ROOTPATH.'/'.$ldata['folder'].'/page/'.$pv['filename'];
                   $fp      = fopen($filepath,'w');
                   $result  = fwrite($fp,$output);
                   fclose($fp);
                }
                $header_script  = " <link href=\"/new/css/homepage.css\" rel=\"stylesheet\" type=\"text/css\" /> \r\n
                                    <script type=\"text/javascript\" src=\"/js/homepage.js\" ></script> \r\n    
                                    <script type=\"text/javascript\" src=\"/js/admin.js\" ></script> \r\n";    
                define('PAGESTATUS','COMMON');                    
                                
                $this -> render('index',array(  'Model'     => $Layout,
                                            'pagepath' => $folder.'/'.$filename,
                                            'section_id' => $id,
                                            'header_script' => $header_script ));                
                //$layoutdata[0]
                
            }
        }
        
    }

?>