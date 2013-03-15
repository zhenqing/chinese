<?php
    class Sections extends DB{
          public $tablename = 'md_articles';
          public $limitlist = 10;
          public $limitpage = 10;
          public $totalrow  = 100;
          public $page      = 1;
          protected $specialcats = array(   
                                "AGI" => 'Aging',
                                "ALL" => 'Allergy',
                                "ALM" => 'Alternative Medicine',
                                "CNC" => 'Cancer'               ,
                                "DEC" => 'Dental Care'           ,
                                "DIT" => 'Diet'                   ,
                                "FIT" => 'Fitness'                 ,
                                "GAS" => 'Gastroenterology'         ,
                                "HTL" => 'Healthy Living'           ,
                                "HTD" => 'Heart Disease'            ,
                                "IMS" => 'Immune System'            ,
                                "IFD" => 'Infectious Disease'       ,
                                "MDC" => 'Medicine'                 ,
                                "MNH" => 'Mens Health'              ,
                                "MTH" => 'Mental Health'            ,
                                "NUR" => 'Nursing'                  ,
                                "NUT" => 'Nutrition'                ,
                                "PPR" => 'Parenting & Pregnancy'    ,
                                'PED' => 'Pediatrics',
                                "QSM" => 'Quit Smoking'             ,
                                "RAD" => 'Radiology'                ,
                                "RES" => 'Relationship & Sex'       ,
                                "REH" => 'Reproductive Health'      ,
                                "REP" => 'Respiratory'              ,
                                "SEH" => 'Senior Health'            ,
                                'SCA' => 'Skin Care',
                                "VIS" => 'Vision'                   ,
                                 "WEL" => 'Weight Loss'             ,
                                 "WNH" => 'Womens Health'           ,);

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
        
        public function right_topics(){
            $query  = "select id,slug,title from md_categories where mainpage = 'Y' order by slug ASC ";
            $r      = $this  -> selectquery($query);
            return  $r;
        }
        
        public function recently_articles(){
            $r = $this ->getdata("output = 'P' ",array('fields' => array('title','id','keywords','registerdate'),
                                                    'limit' => 10,
                                                    'order' => 'registerdate DESC'));
            return $r;                                                                                            
        }
        
        
        public function getarticles($whereoption,$options=array()){
            $rdata = $this -> getdata($whereoption,$options);
            $data  = array();
            foreach($rdata as $v){
                if($options['image'] == 'Y'){
                    
                    $imgdata = $this -> getdata('article_id = '.$v['id'],array('fiedls' => ' path,id,title ',
                                                                    'order' => 'id ASC',
                                                                    'limit' => 1,
                                                                    'table' => 'md_articleimages'));    
                    if($imgdata)
                        $v['image'] = '<img src="'.MDconfig::DATA_FOLDER.'/thumbs/'.$imgdata[0]['path'].'" alt="'.addslashes($imgdata[0]['title']).'" />';                                                
                }
                if($options['category'] == 'Y'){
                        $catdata = $this -> getdata(" id = '".$v['category']."' ",array('fields' => array('title'),'id',
                                                                                  'table' => 'md_categories'));    
                        if($catdata)
                            $v['categoryname'] = $catdata[0]['title'];
                }
                if($options['cut_str_max'] > 0){
                        $v['summary'] = Strings::cutString($v['summary'],$options['cut_str_min'],$options['cut_str_max']);    
                }
                $data[]     = $v;    
            }
            return $data;
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