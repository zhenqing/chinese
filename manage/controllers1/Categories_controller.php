<?
  class CategoriesController extends CDcontrollers {
      public $layout = 'admin';
      public $uses   = array('Category');

      public function setrule(){
            $data = array( 10    => array('Add','Index','Edit'),
                            1    => array('Index'));
            $this -> rules = $data;                
      }
      
      public function ActionAdd(){
          $Category       = new Category();
          $Category_data  = $Category ->specicalinfo();
          if(isset($_POST['Category'])){
               $Category -> data = $_POST['Category'];
               $keyid = '';
               if(is_array($_POST['Category']['selectcat'])){
                    foreach($_POST['Category']['selectcat'] as $v){
                        $keyid .= $v.'-';
                    }   
                    $Category -> specialkeys = implode('|',$_POST['Category']['selectcat']);
               }else
                    $Category -> specialkeys = '';
               
               $keyid .= ($Category ->maxid() + 1);
               $Category -> mdkey = $keyid;
               if($Category -> validate()){
                   $Category -> save();
                   $data1 = $Category -> insertid();
                   $this -> redirect('categories/index');
               }
               
          }
          $this -> render('write',array('Model' => $Category,
                                        'specialcat' => $Category_data['specicalkey']));
      }
      
      public function ActionEdit(){
          
          $Category         = new Category();   
          $Category_data    = $Category ->specicalinfo();
          $id               = isset($_GET['id']) ? $_GET['id'] : 0;
          
          $data             = $Category -> find_primarykey($id);
          if(!$data)
            $this -> redirect('categories/index');
          $Category -> data = $data[0];
          if(isset($_POST['Category'])){
               $Category -> data = $_POST['Category'];
               $keyid = '';
               if(is_array($_POST['Category']['selectcat'])){
                    foreach($_POST['Category']['selectcat'] as $v){
                        $keyid .= $v.'-';
                    }   
                    $Category -> specialkeys = implode('|',$_POST['Category']['selectcat']);
               }else
                    $Category -> specialkeys = '';
               
               $keyid       .= $id;
               $Category    -> mdkey = $keyid;
               if($Category -> validate()){
                   $Category -> save();
                   $data1 = $Category -> insertid();
                   $this -> redirect('categories/index');
               }
          }
          
          $this -> render('write',array('data'  => $data,
                                        'Model' => $Category,
                                        'specialcat' => $Category_data['specicalkey']));
          
          
          
      }
      
      
      public function ActionIndex(){
          
          $page         =  isset($_GET['page']) ? $_GET['page'] : 1;
          $Category       = new Category();
          $Searchoption = array('title' => 'Title',
                                'id' => 'ID',
                                'categorykey'    => 'Category Key',
                                );
          $pagelist     = 10;
          $limitlist    = 10;
          $searchwhere  = "";
          if(isset($_GET['searchopt']) && isset($_GET['search'])){
            $getsearch = $_GET['search'];
            if(is_numeric($getsearch)){
                $searchwhere = "{$_GET['searchopt']} = '{$_GET['search']}' ";
            }else
                $searchwhere = "{$_GET['searchopt']} like '%{$_GET['search']}%' ";
          }
          
          //paging setting and data
          $countdata    = $Category   -> find_data($searchwhere,array('fields' => 'count(id) as ct'));
          $stlimit      = ($page - 1)*$limitlist;
          $limit   = ''.$stlimit.', '.$limitlist;
          $data = $Category -> find_data($searchwhere,array('limit' => $limit,
                                                'order' => 'title ASC',
                    ));
                    
          $this -> render('index',array('Model' => $Category,
                                        'data' => $data,
                                        'limitlist' => $limitlist,
                                        'limittotal' => $countdata[0]['ct'],
                                        'searchoption' => $Searchoption,
                                        'page' => $page,
                                        'limitpage' => $pagelist,));
          
      }
  }
?>