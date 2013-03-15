<?
  class Updatepage extends CDModels{
      public $tablename = 'md_manage_layout';
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
      public function articleimages($num){
          $q = "select path,article_id,title from  md_articleimages where article_id = '{$num}' order by id DESC limit 1";
          $return = $this -> selectquery($q);
          if($return)
            return $return[0];
          else 
            return array();
      }
      
      public function positiondata($section,$file){
          $query = " select * from md_positions where section = '".$section."' and filename = '".$file."' ";
          $r = $this -> selectquery($query);
          return $r[0];
      }
      public function test(){
          echo "AAA";
      }
  }
?>