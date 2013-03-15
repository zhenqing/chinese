<?
  class LayoutsController extends CDcontrollers {
      public $layout = 'admin';
      public $uses   = array('Layout');

      
      public function ActionIndex(){
          
          $page         =  isset($_GET['page']) ? $_GET['page'] : 1;
          $Layout       = new Layout();
          
          //paging setting and data
          $countdata    = $Layout   -> find_data('',array('fields' => 'count(id) as ct'));
          $pagelist     = 10;
          $limitlist    = 10;
          $stlimit      = ($page - 1)*limitlist;
          $limit   = ''.($page - 1)*limitlist.', '.$limitlist;
          $data = $Layout -> find_data('',array('limit' => $limit,
                                                'order' => 'id DESC',
                    ));
                    
          $this -> render('index',array('Model' => $Layout,
                                        'data' => $data,
                                        'limitlist' => $limitlist,
                                        'limittotal' => $countdata[0]['ct'],
                                        'page' => $page,
                                        'limitpage' => $pagelist,));
          
      }
      
      public function ActionEdit(){
          $Layout = new Layout();
          $id   = isset($_GET['id']) ? $_GET['id'] : null;
          $data = $Layout -> find_primarykey($id);
          $Layout -> data = $data[0];
          if(isset($_POST['Layout'])){
              $Layout -> data = $_POST['Layout'];
              if($Layout -> validate()){
                  $Layout -> save();
                  $this -> redirect('layouts/index');
              }
          }
          $this -> render('write',array('data'  => $data,
                                        'Model' => $Layout));
      }
      public function ActionAdd(){
          $Layout = new Layout();
          $this -> render('write',array('Model' => $Layout));
          if(isset($_POST['Layout'])){
              $Layout -> data = $_POST['Layout'];
               
              if($Layout -> validate()){
                $Layout -> save();    
              }
              //print_r($_POST['Layout']);
          }
      }
      
      public function ActionTest(){
          $this -> render('test',array('data'  => $data,
                                        'Model' => $Layout));
      }
      
  }

?>