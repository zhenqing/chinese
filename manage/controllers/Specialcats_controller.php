<?
  class SpecialcatsController extends CDcontrollers {
      public $layout = 'admin';
      public $uses   = array('Specialcat');

      public function ActionAdd(){
          $Specialcat       = new Specialcat();
          $listdata         = $Specialcat -> find_data("parentid = 0");
          if(isset($_POST['Specialcat'])){
               $Specialcat -> data = $_POST['Specialcat'];
               $keyid = '';
               if($Specialcat -> validate()){
                   $Specialcat -> save();
                   $this -> redirect('specialcats/index');
               }
          }
          
          $this -> render('write',array('Model' => $Specialcat,
                                        'Lists' => $listdata,
                                        ));
      }
      
      public function ActionEdit(){
          $Specialcat       = new Specialcat();  
          $id               = isset($_GET['id']) ? $_GET['id'] : null;
          $listdata         = $Specialcat -> find_data("parentid = 0");
          $data             = $Specialcat -> find_primarykey($id);
          
          $Specialcat -> data = $data[0];
          if(isset($_POST['Specialcat'])){
              $Specialcat -> data = $_POST['Specialcat'];
              if($Specialcat -> validate()){
                  $Specialcat -> save();
                  $this -> redirect('specialcats/index');
              }
          }
          $this -> render('write',array('data'  => $data,
                                        'Lists' => $listdata,
                                        'Model' => $Specialcat));
                                        
      }
      
      
      public function ActionIndex(){
          
          $page         =  isset($_GET['page']) ? $_GET['page'] : 1;
          $Specialcat       = new Specialcat();
          
          //paging setting and data
          $countdata    = $Specialcat   -> find_data('',array('fields' => 'count(id) as ct'));
          $pagelist     = 10;
          $limitlist    = 10;
          $stlimit      = ($page - 1)*$limitlist;
          $limit   = ''.($page - 1)*$limitlist.', '.$limitlist;
          $data = $Specialcat -> find_data('',array('limit' => $limit,
                                                'order' => 'id DESC',
                    ));
                    
          $this -> render('index',array('Model' => $Layout,
                                        'data' => $data,
                                        'limitlist' => $limitlist,
                                        'limittotal' => $countdata[0]['ct'],
                                        'page' => $page,
                                        'limitpage' => $pagelist,));
          
      }
  }
?>