<?
  class CDModels extends DB{
      public $tablename     = "";
      public $primarykey    = "id";
      public $usedesc       = true;
      public $fields        = array();      // field Information
      public $validation    = array();      // Validation information
      public $data          = array();      // For validation
      public $fieldtype     = array();
      public $errormsg      = array();
      
      
      public function __construct(){
        parent::__construct();                          //DB Connect
        
        if($this -> usedesc && $this -> tablename){
            $query = "SHOW  COLUMNS FROM ".$this -> tablename;
            
            $info = $this -> selectquery($query);
            
            foreach($info as $k => $v){
                if($v['Key'] == 'PRI')
                    $this ->primarykey = $v['Field'];
                $this -> fields[]   = $v['Field'];
                $this -> $v['Field']= null;                             
            }
            
        }            
      }
      public function remove_data($whereoption='',$otheroption=array()){
          if($whereoption){
              $where = ' where '.$whereoption;
              $query = 'delete from '.$this -> tablename.'
                                '.$where;
              $this -> sendquery($query);                                                  
          }
      }
      
      /* Select , save , Update = Database */
      public function find_data($whereoption='',$otheroption=array()){
          //field
          if(isset($otheroption['fields'])){
            $field = $otheroption['fields'];    
          }else{
            $field = ' * ' ;
          }
          
          //where
          if($whereoption){
              $where = ' where '.$whereoption;
          }
          $order = '';
          //order by
          if(isset($otheroption['order'])){
              $order = ' order by '.$otheroption['order'];
          }
          
          //limit
          if(isset($otheroption['limit'])){
              $limit = ' limit '.$otheroption['limit'];
          }
          $query = "select {$field} from ".$this->tablename." 
                        {$where} 
                        {$order}
                        {$limit}
                        ";
          
          $result = $this -> selectquery($query);
          
          
          return $result;
      }      
      
      public function find_primarykey($idnum,$otheroption=array()){
           //field
          if(isset($otheroption['field'])){
            $field = $otheroption['field'];    
          }else{
            $field = ' * ' ;
          }        
         $where = ' where '.$this ->primarykey." = '{$idnum}' ";
         
         $query = "select {$field} from ".$this->tablename." 
            {$where} 
            ";
         return $this -> selectquery($query);
      }
      
      public function update_data($whereoption,$data_arr){
          //where
          $where = '';
          if($whereoption){
              $where = ' where '.$whereoption;
          }
          $query = " update ".$this -> tablename ." set ";
          foreach($data_arr as $k => $v){
              $query .= "\r\n {$k} = '".addslashes($v)."' ,";
          }
          $query = substr($query,0,-1);
          $query .=$where; 

          $return = $this -> sendquery($query);
          
          return $return;
      }
      public function save(){
        //make query;
        $query = "replace ".$this -> tablename." set ";
        foreach($this -> fields as $k => $v){
            $query .= "\r\n {$v} = '".addslashes($this -> $v)."' ,";
        }
        $query = substr($query,0,-1);
				//echo $query;
        $return = $this -> sendquery($query);
      }
      
      public function clear(){
        foreach($this -> fields as $k => $v){
            $this -> $v = '';
        }  
      }
      
      public function setdata(){
          $data = $this -> data;
          foreach($data as $k => $v){
            if(property_exists($this,$k)){
                $this -> $k = $v;
            }            
          }
          return true;
      }
      
      /* check data (Validatation) */
      public function validate(){
          if($this -> data){
            $data = $this -> data;
            $errornum = 0;
            $errormsg = array();
            foreach($data as $k => $v){
                if(property_exists($this,$k)){
                    $this -> $k = $v;
                    foreach($this ->validation as $va){
                        if(is_numeric(strpos($va[1],$k))){
                            $result = Validate::$va[0]($this -> $k,$k,$msg);
                            if(!$result){
                                $errornum++;
                                $errormsg[] = $msg;
                            }
                                
                        } 
                    }
                }            
            }
            $this ->errormsg = $errormsg;
            if($errornum > 0) return false;
            else return true;                
    
          }
          return true;
      }
      
      /* check  */
      public function validate_error(){
          return array();
      }
  }
?>