<?
class DB extends mysqli{
    const DBSERVER      = 'localhost';
    const DBNAME        = 'ydintl_chinese';
    const DBUSER        = 'root';
    const DBPASS        = '';
    private $connectdb  = true;
    private $queryresult= null;
    private $record     = array();
    private $connectlink = null;
    
    public function __construct(){
        $result = mysqli_connect(self::DBSERVER,self::DBUSER,self::DBPASS,self::DBNAME);
		print_r($result);

        if (mysqli_connect_error())
            echo mysqli_connect_error();
        else{
            $this -> connectlink = $result;        
            mysqli_query( $this -> connectlink,"set names utf8");      
           
            $this -> connectdb = true;
        }
    }
    
    //Other options - temporary
    public function connDB(){
        
        $result = mysqli_connect(self::DBSERVER,self::DBUSER,self::DBPASS,self::DBNAME);
        $this -> connectlink = $result; 
        $this -> connectdb = true;         
        return $result;
    }
    
    public function sendquery($q){
       
        if($this -> connectdb){                   
        
            $this -> queryresult = mysqli_query( $this -> connectlink,$q);
            
            if(!$this -> queryresult){
                echo mysqli_error($this -> connectlink);
                return false;
            }else
                return true;
        }else
            return false;
    }
    public function insertid(){
            $result = mysqli_insert_id($this -> connectlink);
            return $result;
    }
    
    public function fetch(){
        if($this -> queryresult){
            $lists = array();                         
            while($list     = $this -> queryresult -> fetch_array(MYSQL_ASSOC)){
                $lists[] = array_map('stripslashes',$list);
                //$lists[]    = $list;
            }
            
            return $lists;
        }else
            return array();
    }
    
    public function next_record(){
        if($this -> queryresult){
            $list = $this -> queryresult -> fetch_array(MYSQL_ASSOC);
            if($list){
                $this -> record = $list;
            }else
                return false;
        }else
            return false;            
    }
    
    public function f($id){
        if($this -> record){
            return $this -> record['id'];
        }else
            return '';
    }
    
    public function selectquery($q){
        
        $this   -> sendquery($q);
        $r      = $this -> fetch();
        return  $r;
    }
    
}
?>