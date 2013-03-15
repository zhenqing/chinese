<?
  class Article extends CDModels{
      public    $tablename = 'md_articles';
      public    $validation = array(
                                    array('required','title,summary,content'),
                                    );
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
      public function getcategory(){
          $query  = "select id,title,slug from md_categories order by title ASC ";
          $result  = $this -> selectquery($query);
          return $result;
      }
      
      public function getcategory_array(){
          $query  = "select id,title,slug from md_categories order by title ASC ";
          $result  = $this -> selectquery($query);
          $data = array();
          foreach($result as $k => $v){
              $vkey = $v['id'];
              $data[$vkey] = $v['title'];
              
          }
          return $data;
      }
      public function getspecialcat(){
          $query  = "select id,parentid,title from md_specialcats order by parentid ASC , title ASC ";
          $result  = $this -> selectquery($query);
          return $result;
      }
      
      public function getspecialcat_array(){
          $query  = "select id,title from md_specialcats order by title ASC ";
          $result  = $this -> selectquery($query);
          $data = array();
          foreach($result as $k => $v){
              $vkey = $v['id'];
              $data[$vkey] = $v['title'];
              
          }
          return $data;
      }

      public function getsource_array(){
          $query  = "select id,title from md_sources order by title ASC ";
          $result  = $this -> selectquery($query);
          $data = array();
          foreach($result as $k => $v){
              $vkey = $v['id'];
              $data[$vkey] = $v['title'];
              
          }
          return $data;
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