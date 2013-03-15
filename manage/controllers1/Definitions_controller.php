<?
  class DefinitionsController extends CDcontrollers {
      public $layout = 'admin';
      public $uses   = array('Category','Definition');

      public function ActionAdd(){
          $catid          = $_GET['cat'] ? $_GET['cat'] : '';
          $Definition     = new Definition();             
          $Category       = new Category();
          $categorydata   = $Category -> find_primarykey($catid);
          if(isset($_POST['Definition'])){
               $Definition -> data = $_POST['Definition'];
               if($Definition -> validate()){
                   $Definition -> save();
                   $data1 = $Definition -> insertid();
                   $this -> redirect('definitions/index&cat='.$catid);
               }
               
          }
          $this -> render('write',array('Model' => $Definition,
                                        'categorydata' => $categorydata[0]));
      }
      
      public function ActionEdit(){
          
          $id             = isset($_GET['id']) ? $_GET['id'] : 0;
          $catid          = $_GET['cat'] ? $_GET['cat'] : '';
          $Definition     = new Definition();             
          $Category       = new Category();
          $categorydata   = $Category -> find_primarykey($catid);
          $data           = $Definition -> find_primarykey($id);

          $Definition     -> data = $data[0];
          
          if(!$data)
            $this -> redirect('definitions/index&cat='.$catid);

          if(isset($_POST['Definition'])){
               $Definition -> data = $_POST['Definition'];
               if($Definition -> validate()){
                   $Definition -> save();
                   $data1 = $Definition -> insertid();
                   $this -> redirect('definitions/index&cat='.$catid);
               }
          }
          $this -> render('write',array('Model' => $Definition,
                                        'categorydata' => $categorydata[0]));
      }
      
      
      public function ActionIndex(){
          
          $page         =  isset($_GET['page']) ? $_GET['page'] : 1;
          $Definition     = new Definition();
          $Category       = new Category();
          $catid          = $_GET['cat'] ? $_GET['cat'] : '';
          
          
          if(!is_numeric($catid))
            $this -> redirect('categories/index');
          //paging setting and data
          $categorydata = $Category -> find_primarykey($catid);
          
          $countdata    = $Definition   -> find_data(" category = '{$catid}' ",array('fields' => 'count(id) as ct'));
          $pagelist     = 10;
          $limitlist    = 10;
          $stlimit      = ($page - 1)*$limitlist;
          $limit   = ''.$stlimit.', '.$limitlist;
          
          $data = $Definition -> find_data(" category = '{$catid}' ",
                                                                    array('limit' => $limit,
                                                                    'order' => 'id DESC',
                    ));
          /* */         
          $this -> render('index',array('Model' => $Definition,
                                        'data' => $data,
                                        'categorydata' => $categorydata[0],
                                        'limitlist' => $limitlist,
                                        'limittotal' => $countdata[0]['ct'],
                                        'page' => $page,
                                        'cat'   => $catid,
                                        'limitpage' => $pagelist,));
          
      }
  }
?>