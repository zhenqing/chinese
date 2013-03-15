<?
  class Position extends CDModels{
      public $tablename = 'md_positions';
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
      
      public function test(){
          echo "AAA";
      }
  }
?>