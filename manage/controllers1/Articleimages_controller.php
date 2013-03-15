<?
  class ArticleimagesController extends CDcontrollers {
      public $layout = 'admin';
      public $uses   = array('Articleimage','Source');
      
      public function Actionajaxindex(){
          $page         =  isset($_GET['page']) ? $_GET['page'] : 1;
          $Articleimage      =  new Articleimage();
          $countdata    = $Article   -> find_data('',array('fields' => 'count(id) as ct'));
          $pagelist     = 10;
          $limitlist    = 10;
          $stlimit      = ($page - 1)*limitlist;
          $limit        = ''.($page - 1)*limitlist.', '.$limitlist;
          $data = $Article -> find_data('',array('limit' => $limit,
                                                'order' => 'id DESC',
                    ));
                    
          $this -> render('index',array('Model' => $Layout,
                                        'data' => $data,
                                        'limitlist' => $limitlist,
                                        'limittotal' => $countdata[0]['ct'],
                                        'page' => $page,
                                        'limitpage' => $pagelist,));
                    
      }
      
      public function Actionajaxadd(){
          $this -> layout = 'adminnone';
          $Articleimage      =  new Articleimage();
          $Source            =  new Source();
          $uid               = isset($_GET['uid']) ? $_GET['uid'] : '';
          $articleid         = isset($_GET['articleid']) ? $_GET['articleid'] : '';
          $sourcedata        = $Source -> find_data('',array('order' => 'title ASC'));
          
          $this -> render('ajaxwrite',array('Model' => $Articleimage,
                                            'uid' => $uid,
                                            'articleid' => $articleid,
                                            'sourcedata'=> $sourcedata));
      }
      
      public function ActionAjaxlist(){
        $Articleimage      =  new Articleimage();  
        $aid    = $_GET['aid']  ? $_GET['aid'] : '';
        $uid    = $_GET['uid']  ? $_GET['uid'] : '';
        $result = $Articleimage ->getlists($aid,$uid);
        echo json_encode($result);
      }

      public function ActionAjaxdelete(){
        $Articleimage      =  new Articleimage();  
        $imageid  = isset($_POST['imageid']) ? $_POST['imageid'] : '';
        if(is_numeric($imageid)){
            $Articleimage      -> update_data('id = '.$imageid,array('article_id' => 0,
                                                                     'uid' => ''));    
        }
                  
      }
      
      public function Actionajaxinsert(){
          
          require_once("external/thumbs/ThumbLib.inc.php");
          $Articleimage = new Articleimage();
          $maxid        = $Articleimage -> maxid() + 1;
          $filename     = str_replace(' ','-',strtolower($_POST['tmpfile']));
          
          //dest
          if(isset($_POST['tmpfile']) && isset($_POST['Articleimage'])){

                // Old File Path //
                $oldfilepath = MDconfig::ROOTPATH.'/tmp/'.$_POST['tmpfile'];
                $imageinfo   = getimagesize($oldfilepath);
                $setsize     = array("maxwidth" => 500 ,"setwidth" => 0, "maxheight" => 500 );
                // New File Path //
                $newfilename = $maxid.$filename;
                $path        = MDconfig::ROOTPATH.'/datainfo/images/'.date('Y/n').'/'.$newfilename;
                
                if($setsize['maxwidth'] < $imageinfo[0] || $setsize['maxheight'] < $imageinfo[1]){
                     $thumb = PhpThumbFactory::create($oldfilepath);
                     $thumb->resize($setsize['maxwidth'], $setsize['maxheight']);
                     $thumb->save($path);
                     unlink($oldfilepath);
                     $return = 1;
                }else{
                    copy($oldfilepath,$path);
                    unlink($oldfilepath);
                    $return = 1;
                    
                }
                if($return){
                // Make Thumbnai //
                    $setsize        = array("maxwidth" => 100 ,"setwidth" => 0, "maxheight" => 100 );
                    $thumb1         = PhpThumbFactory::create($path);
                    $path1          = MDconfig::ROOTPATH.'/datainfo/thumbs/'.date('Y/n').'/'.$newfilename;
                    $thumb1          ->resize($setsize['maxwidth'], $setsize['maxheight']);
                    $thumb1         -> save($path1);
                
                    $Articleimage -> data = $_POST['Articleimage'];
                    if($Articleimage -> validate()){
                        $Articleimage -> path = date('Y/n').'/'.$newfilename;
                        $Articleimage -> registerdate = date('Y-m-d H:i:s');
                        
                        $Articleimage -> save();    
                        echo "Save";
                    }
                }
          }
      }
      public function ActionAdd(){
          
          //for Editor
          $Article      = new Article();
          $Articledetail= new Articledetail();
          if(isset($_POST['Article'])){
              
          }
          $this -> render('write',array('Model' => $Article,
                                        'categories' => $Article ->getcategory(),
                                        'specialcats' => $Article ->getspecialcat(),
                                        
                                        ));
      }
  }
  
?>