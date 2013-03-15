<?
  class CDviews{
      public $forminfo  = array();
      public $skin      = 'admin';
      public $pagepath  = "";
      public $pagevar   = array();
      
      public function __construct(){
          
      }
      // other resource for View page
      public function getHelpers($arr = array()){
          if(is_array($arr)){
              foreach($arr as $v){
                  require('helpers/'.$v.'.php');
              }
          }
          
      }
      
      public function pageexec(){
          if(is_array($this -> pagevar)){
              foreach($this->pagevar as $k => $v)
                $$k = $v;
          }
          require_once(MDconfig::SKINPATH.'/'.$this ->skin.'/layout.php');
      }
      
      public function formpage(){
          
      }
      
      /* Special Paging */
      public function paging($page=1,$limittotal=1,$limitlist=10,$limitpage=10,$elements='paging.php'){
          
          require_once('views/elements/'.$elements);
      }
      
      public function searchbar($searchoption,$elements = 'searchbar.php'){
          require_once('views/elements/'.$elements);
      }
      
      public function elements(){
          
      }
  }
?>