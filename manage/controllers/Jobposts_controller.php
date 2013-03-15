<?php
  class JobpostsController extends CDcontrollers {
      public $layout = 'admin';
      public $uses   = array('Jobpost','Jobcategory','Jobpostdetail');

      public function setrule(){
            $data = array( 10    => array('Add','Index','Edit'),
                            1    => array('Index'));
            $this -> rules = $data;                
      }

      public function ActionAdd(){
          $Category       = new Jobcategory();
          $Category_data  = $Category ->specicalinfo();
          if(isset($_POST['Jobcategory'])){
               $Category -> data = $_POST['Jobcategory'];
               $keyid = '';

               if(!$_POST['Jobcategory']['slug'])
                    $Category -> slug = Strings::makeslug(!$_POST['Jobcategory']['title']);
               
               
               $keyid .= ($Category ->maxid() + 1);
               $Category -> mdkey = $keyid;
               if($Category -> validate()){
                   $Category -> save();
                   $data1 = $Category -> insertid();
                   $this -> redirect('jobcategories/index');
               }
               
          }
          $this -> render('write',array('Model' => $Category,
                                        'specialcat' => $Category_data['specicalkey']));
      }
      
      public function ActionDelete(){
          $Post         	= new Jobpost();   
          $Detail					= new Jobpostdetail();
          $id               = isset($_GET['id']) ? $_GET['id'] : 0;
          $data             = $Post 		-> find_primarykey($id);
          if(!$data)
            $this -> redirect('jobposts/index');
           
          $Post 	-> remove_data(" id = ".$id);
          $Detail -> remove_data(" jobid = ".$id);
          $this -> redirect('jobposts/index');
            
      
      }
      public function ActionEdit(){
          
          $Post         	= new Jobpost();   
          $Category				= new Jobcategory();
          $Detail					= new Jobpostdetail();
          $Category_data    = $Category ->find_data();
          
          
          
          $id               = isset($_GET['id']) ? $_GET['id'] : 0;
          
          $data             = $Post 		-> find_primarykey($id);
          $data1						= $Detail		-> find_primarykey($id);
          if(!$data)
            $this -> redirect('jobposts/index');
          $Post -> data = $data[0];
          if(isset($_POST['Jobpost'])){
               $Post -> data = $_POST['Jobpost'];
               if($Post -> validate()){
                   $Post -> save();
                   
                   $Detail -> jobid 			= $id;
                   $Detail -> content = $_POST['Jobpost']['content'];
                   $Detail -> save();
                   //echo mysql_error();
                   $this -> redirect('jobposts/index');
               }
          }
          
          $this -> render('write',array('data'  => $data,
          															'data1' => $data1,
                                        'Model' => $Post,
                                        'categories' => $Category_data));
          
          
          
      }
      
      
      public function ActionIndex(){
          
          $page         =  isset($_GET['page']) ? $_GET['page'] : 1;
          $Category     =  new Jobcategory();
          $Post         =  new Jobpost();
          $Searchoption = array('title' => 'Title',
                                'id' => 'ID',
                                'category'    => 'Category ID',
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
          $countdata    = $Post   -> find_data($searchwhere,array('fields' => 'count(id) as ct'));
          $stlimit      = ($page - 1)*$limitlist;
          $limit   = ''.$stlimit.', '.$limitlist;
          $data = $Post -> find_data($searchwhere,array('limit' => $limit,
                                                'order' => 'id DESC',
                    ));
                    
          $this -> render('index',array('Model' => $Post,
                                        'data' => $data,
                                        'limitlist' => $limitlist,
                                        'limittotal' => $countdata[0]['ct'],
                                        'searchoption' => $Searchoption,
                                        'page' => $page,
                                        'limitpage' => $pagelist,));
          
      }            
  }    
?>