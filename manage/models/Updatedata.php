<?
  class Updatedata extends CDModels{
      public $tablename = 'md_updatedatas';
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
      
      public function positiondata($section,$file){
          $query = " select * from md_positions where section = '".$section."' and filename = '".$file."' ";
          $r = $this -> selectquery($query);
          return $r[0];
      }
      
      public function updatedata_id($pos_id,$order){
          $query = "select id,num from ".$this ->tablename." 
                        where       pos_id = '".$pos_id."' 
                        and         m_order = '".$order."' ";
          $r = $this -> selectquery($query);
          if($r)
            return $r[0];
          else
            return '';  
      }
      
      public function test(){
          echo "AAA";
      }
  }
?>