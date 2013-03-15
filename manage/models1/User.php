<?
  class User extends CDModels{
      public $tablename     = "md_userinfos";
      public $validation    = array(
                                array('user_id,user_pw','required'),
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

      public function test(){
          echo "AAA";
      }
  }
?>