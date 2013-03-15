<?php
    class Jobs extends DB{
          public $tablename = 'job_requests';
          public $limitlist = 10;
          public $limitpage = 10;
          public $totalrow  = 100;
          public $page      = 1;
          public $state_list = array('AL'=>"Alabama",  
                        'AK'=>"Alaska",  
                        'AZ'=>"Arizona",  
                        'AR'=>"Arkansas",  
                        'CA'=>"California",  
                        'CO'=>"Colorado",  
                        'CT'=>"Connecticut",  
                        'DE'=>"Delaware",  
                        'DC'=>"District Of Columbia",  
                        'FL'=>"Florida",  
                        'GA'=>"Georgia",  
                        'HI'=>"Hawaii",  
                        'ID'=>"Idaho",  
                        'IL'=>"Illinois",  
                        'IN'=>"Indiana",  
                        'IA'=>"Iowa",  
                        'KS'=>"Kansas",  
                        'KY'=>"Kentucky",  
                        'LA'=>"Louisiana",  
                        'ME'=>"Maine",  
                        'MD'=>"Maryland",  
                        'MA'=>"Massachusetts",  
                        'MI'=>"Michigan",  
                        'MN'=>"Minnesota",  
                        'MS'=>"Mississippi",  
                        'MO'=>"Missouri",  
                        'MT'=>"Montana",
                        'NE'=>"Nebraska",
                        'NV'=>"Nevada",
                        'NH'=>"New Hampshire",
                        'NJ'=>"New Jersey",
                        'NM'=>"New Mexico",
                        'NY'=>"New York",
                        'NC'=>"North Carolina",
                        'ND'=>"North Dakota",
                        'OH'=>"Ohio",  
                        'OK'=>"Oklahoma",  
                        'OR'=>"Oregon",  
                        'PA'=>"Pennsylvania",  
                        'RI'=>"Rhode Island",  
                        'SC'=>"South Carolina",  
                        'SD'=>"South Dakota",
                        'TN'=>"Tennessee",  
                        'TX'=>"Texas",  
                        'UT'=>"Utah",  
                        'VT'=>"Vermont",  
                        'VA'=>"Virginia",  
                        'WA'=>"Washington",  
                        'WV'=>"West Virginia",  
                        'WI'=>"Wisconsin",  
                        'WY'=>"Wyoming");

            
        public function __construct(){ 
            $this -> connDB();
            
        }
        
        public function changedata($whereoption,$data,$options=array()){
            $join = $table = $where = $limit = $order = "";
            
            if($whereoption){
                $where = ' where '.$whereoption;
            }
            if($options['table'])
                $table = $options['table'] ;
            else
                $table = $this -> tablename;   
            
            $query = " update  ".$table." set ";                                    
            foreach($data as $k => $v){
                $query .= " $k ='".$v."' ,";
            }
            $query   = substr($query,0,-1);
            $query   .= $where;
            $this -> sendquery($query);
        }
        public function getdata($whereoption,$options=array()){
            $table = $where = $limit = $order = "";
            if($whereoption){
                $where = 'where '.$whereoption;
            }
            
            if($options['limit'])
                $limit = 'limit '.$options['limit'];
             
            if($options['order'])    
                $order = 'order by '.$options['order'];
            if($options['table'])
                $table = $options['table'] ;
            else
                $table = $this -> tablename;   
            if($options['fields'])
                $fields = implode(',',$options['fields']);
            else
                $fields = ' * ';   
            
            if($options['join']){
                $join = $options['join'];
            }
            
            $query = "select $fields
            
                            from {$table}
                            $join
                            $where
                            $order
                            $limit
                            ";
             
                            
             $r = $this -> selectquery($query);               
             return $r;
        }
        
        
        public function right_categories(){
            $query  = "select id,slug,title from job_categories where commonpage = 'Y' order by slug ASC ";
            $r      = $this  -> selectquery($query);
            return  $r;
        }
        
        public function all_categories(){
            $query  = "select id,slug,title from job_categories  order by slug ASC ";
            $r      = $this  -> selectquery($query);
            return  $r;
        }
        
        
        
        
        
        
        public function paging(){
          $totalpage = ceil($this -> totalrow/$this -> limitlist);  
          $startpage = floor(($this -> page - 1)/$this -> limitpage)*$this -> limitpage + 1;
          $endpage   = $startpage + $this -> limitpage  - 1 > $totalpage ? $totalpage : $startpage + $this -> limitpage  - 1  ;
          $pageinfo = array('start' => $startpage,
                            'end'   => $endpage,
                            'total'   => $totalpage,
                            'current' => $this -> page);
          
          return $pageinfo;                                              
          
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
      
    }
    
    
?>