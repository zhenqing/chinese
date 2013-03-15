<?
  class Layout extends CDModels{
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
      
      public function positiondata($section,$file){
          $query = " select * from md_positions where section = '".$section."' and filename = '".$file."' ";
          $r = $this -> selectquery($query);
          return $r[0];
      }
      
      public function updatedata($pos_id,$anum){
          $query = " select * from md_updatedatas where pos_id = '{$pos_id}' and       m_order < {$anum} ";
          $r     = $this -> selectquery($query);
          return $r;
          
      }
      public function test(){
          echo "AAA";
      }
  }
?>