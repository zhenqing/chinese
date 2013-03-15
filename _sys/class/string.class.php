<?
  class Strings{
      public function cutString($str,$min=100,$max=300,$endstr='...'){
          $strnum = strlen($str);
          //echo $strnum."AA"."\r\n";
          if($strnum <= $max){
              return $str;
          }else{
              $findpoint = strpos($str,'.',$min);
              
              if($findpoint <= $max){
                  return substr($str,0,$findpoint).$endstr;
              }else{
                  $findpoint = strpos($str,' ',$max - 15);
                  return substr($str,0,$findpoint).$endstr;
              }
          }
      }
      
      public function invert_xml_tohtml($text){
             $result = htmlspecialchars_decode($text, ENT_NOQUOTES);
             $arr=Array("&amp;"=>"&","&apos;"=>"'","&quot;"=>"\"");
             foreach($arr as $k => $v){
                 $result = str_replace($k,$v,$result);
             }
             return $result;
      }

      public function xml_char_convert($text){
            $text=html_entity_decode($text);
            $arr=Array("<"=>"&lt;",">"=>"&gt;");
            foreach($arr as $key=>$value){
                $text=str_replace($key,$value,$text);
            }
            return $text;
      }      
      
      public function makeslug($text){
            $code_entities_match = array('&amp;',' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=');
            $code_entities_replace = array('','-','-','','','','','','','','','','','','','','','','','','','','','','','','');
            $string = strtolower(str_replace($code_entities_match, $code_entities_replace, trim($text))); 
          return $string;
          
          
      }
      public function md_article_onlylink($id,$date,$keywords){
          
          $keywords = Strings::makeslug($keywords);
          $datekey  = substr($date,0,4).substr($date,5,2).substr($date,8,2);
          $str		  = "/chinese/main/news.php?id={$id}&date={$datekey}&keywords={$keywords}";
		  //$str      = '/news/'.$datekey.'/'.$id.'/'.$keywords.'.htm' ;
          
          return $str;
      }
      
      public function article_link($title,$stamp,$keywords,$id=""){
          
          $str = '<a href="/news/'.date('Ymd',$stamp).'/'.$keywords.'.htm" >'.$title.'</a>';
          return $str;
      }
      
      public function article_onlylink($stamp,$keywords,$id=""){
          $str = "/news/".date('Ymd',$stamp).'/'.$keywords.'.htm';
          return $str;
      }
  }
  
     
?>