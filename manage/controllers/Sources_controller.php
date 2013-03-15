<?
  class SourcesController extends CDcontrollers {
      public $layout = 'admin';
      public $uses   = array('Source');
      

      public function ActionIndex(){
          $page         =  isset($_GET['page']) ? $_GET['page'] : 1;
          $Source       = new Source();
          $Searchoption = array('title' => 'Title',
                                'id' => 'ID',
                                'slug'    => 'Slug',
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
          $countdata    = $Source   -> find_data($searchwhere,array('fields' => 'count(id) as ct'));
          $pagelist     = 10;
          $limitlist    = 10;
          $stlimit      = ($page - 1)*$limitlist;
          $limit   = ''.($page - 1)*$limitlist.', '.$limitlist;
          $data = $Source -> find_data($searchwhere ,array('limit' => $limit,
                                                            'order' => 'title ASC',
                    ));
                    
          $this -> render('index',array('Model' => $Source,
                                        'data' => $data,
                                        'limitlist' => $limitlist,
                                        'limittotal' => $countdata[0]['ct'],
                                        'searchoption' => $Searchoption,
                                        'page' => $page,
                                        'limitpage' => $pagelist,));
          
      }

      public function ActionEdit(){
          $Source      = new Source();
          $idnum = isset($_GET['id']) ? $_GET['id'] : '';
          if(!is_numeric($idnum))
            $this -> redirect("sources/index");
         
          $data = $Source -> find_primarykey($idnum);
          $Source -> data = $data[0];
          $Source -> setdata();
          if(isset($_POST['Source'])){
            $Source -> data = $_POST['Source'];
            if($Source -> validate()){
                $Source -> save();
                $this -> redirect('sources/index');
            }  
          }
          $this -> render('write',array('Model' => $Source,
                                        ));
      }
      
      public function ActionAdd(){
          
          //for Editor
          $Source      = new Source();
          if(isset($_POST['Source'])){
            $Source -> data = $_POST['Source'];
            if($Source -> validate()){
                $Source -> save();
                $this -> redirect('sources/index');
            }
          }
          $this -> render('write',array('Model' => $Source,
                                        ));
      }
  }
  
?>