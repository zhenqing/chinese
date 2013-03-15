<?
  class CDcontrollers{
      private $page     = "";
      private $data     = array();
      public  $uses     = array();
      public  $form     = array();
      public  $helpers  = array();
      public  $rules    = array();
      
      
      public function render($page="",$info=array()){
          $this -> page = $page;
          $this -> data = $info;
          return true; 
      }
      
      public function getmodels(){
          $uses = $this -> uses;
          foreach($uses as $v){
            require('models/'.$v.'.php');
          }
      }
      
      
      public function showdata(&$pagename){
          if($this -> page){
              $pagename = $this -> page;
              return $this ->data;
          }
      }
      
      
      public function redirect($info){
          $path  = $_SERVER['PHP_SELF'];
          $path .= '?r='.$info;
          header('location: '.$path);
          
      }
  }
?>