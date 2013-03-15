<?
  class ArticlesController extends CDcontrollers {
      public $layout = 'admin';
      public $uses   = array(   'Article',
                                'Articledetail',
                                'Articleimage',
                                'Category',
                                'Articlecategory',
                                'Specialcat',
                                'Specialcat_index');
      
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
      /* For Specialcat */
      public function ActionsetData(){
          
          $Article = new Article();
          $Specialcat_index  =  new Specialcat_index();
          $result = $Article -> find_data('id = 609',array( 'order'  => ' id ASC ',
                                                    
                                                    'fields' => 'id,specialcat,specialcatsm'));
          foreach($result as $row){
            
            if($row['specialcat'] > 0){
                echo $row['specialcat']. " ";
                $Specialcat_index -> article_id = $row['id'];
                $Specialcat_index -> specialcatid = $row['specialcat'];
                $Specialcat_index -> save();
            }
          }
          
      }
      
      public function ActionPublish(){
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
          $pagelist     = 10;
          $limitlist    = 10;
          $stlimit      = ($page - 1)*$limitlist;
          $limit        = ''.($page - 1)*$limitlist.', '.$limitlist;
          $data = $Article -> find_data($searchwhere,array('limit' => $limit,
                                                'order' => $orderby,
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
          $Specicalcat      = new Specialcat();
          $Specialcat_index = new Specialcat_index();
          $id               = isset($_GET['id']) ? $_GET['id'] : '';
          if(!is_numeric($id))
            $this -> redirect('articles/index');
          $data                 = $Article          -> find_primarykey($id);
          $detailData           = $Articledetail    -> find_primarykey($id);  
          $data[0]['content']   = $detailData[0]['content'];
          $Article -> data      = $data[0];
          $uuid                 = $data[0]['uid'];
          $myspecialcats       = array(); 
          $myspdata          = $Specialcat_index -> find_data("article_id = '{$id}' ");
          
          if($myspdata){
              foreach($myspdata as $mv){
                $myspecialcats[] = $mv['specialcatid'];        
              }
              
          }
          
            
          
          if(isset($_POST['Article']) && $_POST['Article']){
              $Article -> data =  $_POST['Article'];
              if($Article -> validate()){
                  
                  if(is_array($Article -> data['specialcats'])){
                     $Specialcat_index -> remove_data("article_id = '".$Article -> id."' ");
                     if($Article -> specialcats[0] > 0)
                        $Article ->  specialcatid = $Article -> specialcats[0];    
                     foreach($Article -> data['specialcats'] as $spv){
                        $Specialcat_index -> article_id     = $Article -> id;
                        $Specialcat_index -> specialcatid   = $spv;
                        $Specialcat_index -> save();  
                     } 
                  }
                  /*
                  if($Article -> specialcat > 0){
                     //$Specialcat_index -> remove_data("article_id = '".$Article -> id."' ");
                    
                    $specialdata = $Specicalcat -> find_primarykey($Article -> specialcat);      
                    if($specialdata[0]['parentid'] > 0){
                        $Article -> specialcat     = $specialdata[0]['parentid'];
                        $Article -> specialcatsm   = $specialdata[0]['id'];
                    }else{
                        $Article -> specialcatsm = 0;
                    }
                  }
                  */
                  
                  
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
                                        'myspecialcats' => $myspecialcats,
                                        'sources'     => $Article ->getsource_array(),                                        
                                        'uid'          => $uuid,
                                        'header_script' => '<script type="text/javascript" src="/chinese/js/admin.js" ></script>',
                                        ));
             
      }
      public function ActionAdd(){
          
          //for Editor
          $Article      = new Article();
          $Articledetail= new Articledetail();
          $Articleimage = new Articleimage();
          $Category     = new Category();
          $Specicalcat  = new Specialcat();
          $Specialcat_index = new Specialcat_index();
          $uuid         = isset($_COOKIE['uid']) ? $_COOKIE['uid'] : uniqid();
          
          if(isset($_POST['Article'])){
              $Article -> data =  $_POST['Article'];
              if($Article -> validate()){
                  
                  $Articlespdata = $Article -> data['specialcats']; //special Categories
                  if($Articlespdata && is_array($Articlespdata))
                    $Article -> specialcat = $Articlespdata[0];
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
                  
                 if(is_array($Articlespdata)){
                     
                     if($Article -> specialcats[0] > 0)
                        $Article ->  specialcatid = $Article -> specialcats[0];    
                     foreach($Articlespdata as $spv){
                        $Specialcat_index -> article_id     = $insert_id;
                        $Specialcat_index -> specialcatid   = $spv;
                        $Specialcat_index -> save();  
                     } 
                  }

                  
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