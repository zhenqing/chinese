<?
  class ArticlesController extends CDcontrollers {
      public $layout = 'admin';
      public $uses   = array('Article','Articledetail','Articleimage','Category','Articlecategory');
      
      public function ActionIndex(){
          $page         =  isset($_GET['page']) ? $_GET['page'] : 1;
          $getorder     =  isset($_GET['field']) ? $_GET['field'] : '';
          $getasc       =  isset($_GET['order']) ? $_GET['order'] : 'down';
          
          
          $Article      =  new Article();
          $Articleimage =  new Articleimage();
          $Category     = new Category();
          
          $Searchoption = array('title' => 'Title',
                                'reportername' => 'Reportername',
                                'specialcat'    => 'Special Category ID',
                                'output'        => 'Status',
                                'category'      => 'Topic ID');
          $pagelist     = 10;
          $limitlist    = 10;
          $searchwhere  = "";
          $orderby      = "id DESC";
          if(isset($_GET['searchopt']) && isset($_GET['search'])){
            $getsearch = $_GET['search'];
            if(is_numeric($getsearch)){
                $searchwhere = "{$_GET['searchopt']} = '{$_GET['search']}' ";
            }else if(strlen($getsearch) == 1){
                $searchwhere = "{$_GET['searchopt']} = '{$_GET['search']}' ";
            }else
                $searchwhere = "{$_GET['searchopt']} like '%{$_GET['search']}%' ";
          }
          
          if($getorder && $getasc){
            $orderby =  $getasc == 'down' ?   $getorder.' ASC' : $getorder.' DESC';
          }
          
          $countdata    = $Article   -> find_data($searchwhere,array('fields' => 'count(id) as ct'));
          
          $stlimit      = ($page - 1)*$limitlist;
          $limit        = ''.($page - 1)*$limitlist.', '.$limitlist;
          $data1 = $Article -> find_data($searchwhere,array('limit' => $limit,
                                                'order' => $orderby,
                    ));
          $data     = array();                                   
          foreach($data1 as $v){
               $data2 = $Articleimage -> find_data("article_id = ".$v['id'] ,array( 'fields' => 'id','limit' => 1));
               
               if($data2[0]['id'])                                                                                    
                $v['image_id'] = $data2[0]['id'];
               $data[] = $v;
          }                                        
          $mdkey = $Category ->specicalinfo();  
          $this -> render('index',array('Model' => $Layout,
                                        'data' => $data,
                                        'limitlist' => $limitlist,
                                        'limittotal' => $countdata[0]['ct'],
                                        'categories' =>  $Article ->getcategory_array(),
                                        'specialcats' => $Article ->getspecialcat_array(),
                                        'sources'     => $Article ->getsource_array(),
                                        'mcats'       => $mdkey['specicalkey'],
                                        'page' => $page,
                                        'searchoption' => $Searchoption,
                                        'limitpage' => $pagelist,));
                    
      }
      public function ActionPublish(){
          $page         =  isset($_GET['page']) ? $_GET['page'] : 1;
          $Article      =  new Article();
          $Category     = new Category();
          $countdata    = $Article   -> find_data('',array('fields' => 'count(id) as ct'));
          $pagelist     = 10;
          $limitlist    = 10;
          $stlimit      = ($page - 1)*$limitlist;
          $limit        = ''.($page - 1)*$limitlist.', '.$limitlist;
          $data = $Article -> find_data('',array('limit' => $limit,
                                                'order' => 'id DESC',
                    ));
          $mdkey = $Category ->specicalinfo();  
          $this -> render('index',array('Model' => $Layout,
                                        'data' => $data,
                                        'limitlist' => $limitlist,
                                        'limittotal' => $countdata[0]['ct'],
                                        'categories' =>  $Article ->getcategory_array(),
                                        'specialcats' => $Article ->getspecialcat_array(),
                                        'sources'     => $Article ->getsource_array(),
                                        'mcats'       => $mdkey['specicalkey'],
                                        'publishfnc'  => 'Y',   
                                        'page' => $page,
                                        'limitpage' => $pagelist,));
                                        
      }
      
      public function ActionAjaxpublished(){
          $Article = new Article();
          if(isset($_POST) && is_numeric($_POST['id'])){
            $where = " id = '".$_POST['id']."' ";
            $Article -> update_data($where,array(   'publishdate'   => date('Y-m-d H:i:s'),
                                                    'output'        => $_POST['publish']));
            echo "Article is updated";
          }
          
      }
      
      public function ActionEdit(){
          //for Editor
          $Article          = new Article();
          $Articledetail    = new Articledetail();
          $Articlecategory  = new Articlecategory();
          $Articleimage     = new Articleimage();
          $Category         = new Category();
          $id               = isset($_GET['id']) ? $_GET['id'] : '';
          if(!is_numeric($id))
            $this -> redirect('articles/index');
          $data                 = $Article          -> find_primarykey($id);
          $detailData           = $Articledetail    -> find_primarykey($id);  
          $data[0]['content']   = $detailData[0]['content'];
          $Article -> data      = $data[0];
          $uuid                 = $data[0]['uid'];
          
          if(isset($_POST['Article'])){
              $Article -> data =  $_POST['Article'];
              if($Article -> validate()){
                  //Save Article
                  //$Article -> registerdate = date('Y-m-d H:i:s'); 
                  //$Article -> output       = 'Q';
                  $Article -> userid       = 1;
                  $Article -> save();
                  $insert_id = $Article -> insertid();
                  
                  //Save Article Content
                  $Articledetail -> article_id = $insert_id;
                  $Articledetail -> content    = $_POST['Article']['content'];
                  $Articledetail -> save();
                  
                  if($_POST['Article']['tempimages']){
                    $tempstr        = substr($_POST['Article']['tempimages'],0,-1);
                    $imgid_explode  = explode(',',$tempstr);
                    foreach($imgid_explode as $v){
                        $Articleimage -> setarticleid($insert_id,$v);
                    }
                  }
                  //Save Images
                  $this -> redirect('articles/index');
              }
          }
          
          $mdkey = $Category ->specicalinfo();
          $this -> render('write',array('Model' => $Article,
                                        'categories' => $Article ->getcategory(),
                                        'mcats'       => $mdkey['specicalkey'],
                                        'specialcats' => $Article ->getspecialcat(),
                                        'sources'     => $Article ->getsource_array(),                                        
                                        'uid'          => $uuid,
                                        'header_script' => '<script type="text/javascript" src="/js/admin.js" ></script>',
                                        ));
             
      }
      public function ActionAdd(){
          
          //for Editor
          $Article      = new Article();
          $Articledetail= new Articledetail();
          $Articleimage = new Articleimage();
          $Category     = new Category();
          $uuid         = isset($_COOKIE['uid']) ? $_COOKIE['uid'] : uniqid();
          
          if(isset($_POST['Article'])){
              $Article -> data =  $_POST['Article'];
              if($Article -> validate()){
                  
                  
                  //Save Article
                  $Article -> registerdate = date('Y-m-d H:i:s'); 
                  $Article -> output       = 'Q';
                  $Article -> userid       = $_SESSION['userid'];
                  $Article -> save();
                  $insert_id = $Article -> insertid();
                  
                  //Save Article Content
                  $Articledetail -> article_id = $insert_id;
                  $Articledetail -> content    = $_POST['Article']['content'];
                  $Articledetail -> save();
                  
                  
                  if($_POST['Article']['tempimages']){
                    $tempstr        = substr($_POST['Article']['tempimages'],0,-1);
                    $imgid_explode  = explode(',',$tempstr);
                    foreach($imgid_explode as $v){
                        $Articleimage -> setarticleid($insert_id,$v);
                    }
                  }
                  //Save Images
                  setCookie('uid','',time() - 7*3600*24);
                  $this -> redirect('articles/index');
                  
              }
    
          }
          $mdkey = $Category ->specicalinfo();
          $this -> render('write',array('Model' => $Article,
                                        'categories' => $Article ->getcategory(),
                                        'mcats'       => $mdkey['specicalkey'],
                                        'specialcats' => $Article ->getspecialcat(),
                                        'sources'     => $Article ->getsource_array(),                                        
                                        'error_array' => $Article -> errormsg,
                                        'uid'          => $uuid,
                                        'header_script' => '<script type="text/javascript" src="/js/admin.js" ></script>',
                                        ));
      }
  }
  
?>