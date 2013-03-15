<?
  /*******************************
  *  For Article
  */
  class Articles extends DB{
      public $id;
      public $lang_prefix       = 'md';
      public $data;
      public $theme_table       = 'catect_health';
      public $article_table     = 'md_articles';
      
      public function __construct(){
        $this ->connDB();    
      }
      
      public function get_Article_id($id=""){
          if(is_numeric($id))
            $this ->id = $id;
          $query = "select 
                        id , title  ,   summary  ,  reportername   ,  registerdate ,   specialcat  ,   mcat   ,  category   ,  uid     
                        ,keywords   ,  source , output     
                            from ".$this ->article_table." 
                        where id = ".$this -> id;


          $data        = $this -> selectquery($query);
          
          $query    = "select content from md_articledetails where article_id = ".$this -> id;      
          $data1    = $this -> selectquery($query);
          $data[0]['content'] = $data1[0]['content'];
          
          $query    = "select footer from md_sources where id = '".$data[0]['source']."' ";
          $data1    = $this -> selectquery($query);
          $data[0]['sourcefooter'] = $data1[0]['footer'];
          
          
          
          /*
          if($data[0]['category']){
              $query = "select title,slug from md_categories where id = '".$data[0]['category']."' ";
              $data1    = $this -> selectquery($query);
              $data[0]['categoryname'] = $data1[0]['title'];
              $data[0]['categoryslug'] = $data1[0]['slug'];
          }
          */
          
          
          return $data[0];
          
      }
      
      
      
      public function get_specialcats_data($id,$catid=""){
          /*
            CAT ID
              92   - 80
              91   - 73
              93   - 70
          */
          $match_arr =array(92 =>70,91 => 73 , 93 =>80);
          if(is_numeric($id)){
            $query = "select specialcatid from md_specialcats_index where article_id = $id ";    
            $data1  = $this -> selectquery($query);
            $sp_id = array();
            if($data1){
              foreach($data1 as $v){
                  $sp_id[] = $v['specialcatid'];
              }
              $addwhere = $match_arr[$catid] ? "and parentid = ".$match_arr[$catid] : '';
              $query = "select id,title from md_specialcats where id in (".implode(',',$sp_id).")
                                                and parentid  > 0 $addwhere  limit 1";
              $result = $this -> selectquery($query);                                                                                    
              return $result;
            }
          }
          
      }
      
      public function get_Article_image($id){
          if(is_numeric($id)){
              $query = "select path,title,reporter,source,registerdate from md_articleimages where article_id = ".$id;
              $result = $this -> selectquery($query);
            return  $result;
          }
      }
      
      public function get_topic_articles($selfid,$topicid,$limit){
        $query  = "select id,title,registerdate,keywords from md_articles where 
                        output = 'P'
                        and category = '".$topicid."' 
                        and id != {$selfid}
                    order by id DESC 
                    limit {$limit} ";
        echo $q;            
        $result = $this -> selectquery($query);
        return  $result;
      }
      /* From Data Base */
      public function get_xml($date,$keywords){
          $filepath =  MDconfig::XMLPATH.'/ct/'.substr($date,0,4)."/".
                                                substr($date,4,2)."/".
                                                substr($date,6,2)."/".
                                                $keywords.".xml";
          
          if(file_exists($filepath)){
              $filestring = file_get_contents($filepath);
              require(MDconfig::CLASSPATH.'/xmltoarray.class.php');
              $xmlto = new XmlToArray($filestring);
              $result1 = $xmlto -> createArray();
              $result  = $result1['article'];
              $this    -> data = $result;
          }else{
              $result              = $this -> get_Article($date,$keywords);
              $this                -> data = $result;
          }
              

          // No result -> Error              
          if(!$result);                              
          else
            $this -> id = $result['id'];
            
          $result['body'] = Strings::invert_xml_tohtml($result['body']);
          
          return $result;
      }
      
      public function get_Article($date,$keywords){
         
        $starttime      = mktime(0,0,0,substr($date,4,2),substr($date,6,2),substr($date,0,4));
        $endtime        = $starttime + 86400;
        $article_table  = 'ct_articles';
        $q="SELECT  id,      
                    title, subtitle, maincat_id, category_id, body, summary, reporter_name, keywords,
                    comments, relate, add_xml, source_id, timestamp, featured, city, cCode, cmt_count,
                    tags, etc, rate_average, revision, seo_keywords, votes, themes,
                    urlinfo
                        FROM $article_table 
                        WHERE timestamp >= '{$starttime}' 
                        AND timestamp <= '{$endtime}' 
                        AND keywords='$keywords' 
                        AND allow='Y' ORDER BY id ASC LIMIT 1";
          $result = $this -> selectquery($q);
          return $result;
      }
      
      public function get_source($id){
        $q="SELECT * FROM ".$this -> lang_prefix."_sources WHERE id='$id' ";
        $result = $this->selectquery($q);
        return $result;
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