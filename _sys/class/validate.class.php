<?
  class Validate{
      public $error = array();
      
      function errorsummary(){
          return array();
      }
      
      function required($str,$name,&$msg,$options=array()){
          if(!$str){
              $msg = $name.' is required.';
              return false;
          }else
              return true;
          
      }
  }
?>