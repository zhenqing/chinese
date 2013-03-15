<?
  class Articleimage extends CDModels{
      public    $tablename = 'md_articleimages';
      public function __construct(){

          $this -> connDB();
          $query = "SHOW  COLUMNS FROM ".$this -> tablename;
            
            $info = $this -> selectquery($query);
            
            foreach($info as $k => $v){
                if($v['Key'] == 'PRI')
                    $this ->primarykey = $v['Field'];
                $this -> fields[]   = $v['Field'];
                $this -> $v['Field']= null;                             
            }
      }
      
      public function setarticleid($articleid,$imageid){
          $q = "update ".$this -> tablename." set article_id = ".$articleid." where id = '".$imageid."' ";
          $this -> sendquery($q);
      }
      
      public function getlists($aid,$uid){
          if(is_numeric($aid)){
              $q = "select id,path,article_id,title from ".$this -> tablename." 
                        where article_id = '".$aid."' ";
          }else if($uid){
              $q = "select id,path,article_id,title from ".$this -> tablename." 
                        where uid = '".$uid."' ";
          }
          if(!$q){
              return array();
          }else{
              $result = $this -> selectquery($q);
              return $result;
          }
          
      }

      public function maxid(){
          $return = $this -> selectquery("select max(id) as maxid from ".$this -> tablename);
          if($return){
              return $return[0]['maxid'];
          }else
            return 0;
      }
  }
?>