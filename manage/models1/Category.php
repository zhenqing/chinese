<?
  class Category extends CDModels{
      public    $tablename = 'md_categories';
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