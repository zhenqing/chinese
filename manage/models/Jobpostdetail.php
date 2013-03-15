<?
  class Jobpostdetail extends CDModels{
      public    $tablename = 'job_requests_details';
 
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
      public function maxid(){
          $return = $this -> selectquery("select max(id) as maxid from ".$this -> tablename);
          if($return){
              return $return[0]['maxid'];
          }else
            return 0;
      }
      public function specicalinfo(){
          $data = array('specicalkey' => $this ->specialcats);
          
          return $data;
      }
  }
?>