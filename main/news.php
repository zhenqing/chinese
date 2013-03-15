<?
      /********************************************
    *  Article Pages
    *  1. Need class for this page
    *   - XML Parse
    *   - Database
    *   - Article Class
    */
    require_once("../base.php");
    require("class/articles.class.php");
    require_once(MDconfig::CLASSPATH."/sections.class.php");

    $curfolder = dirname(__FILE__).'/';
    define('FOLDER',$curfolder);
    $Articles = new Articles();
    $skin     = 'common';
    $date       = $_GET['date'];
    $keywords   = $_GET['keywords'];
    $related    = array();
    $id         = $_GET['id'];
    
    if(!(is_numeric($date) && strlen($date))){
        die("Error");
    }
	
    $result = $Articles ->get_Article_id($id);
    
        $sources= $Articles ->getsource_array();
        $images = $Articles ->get_Article_image($id);
        //print_r($images);
    //related Articles
    $relateds = array();
    /*    
    if($result['category']){
        //echo $result['category'];
        $relateds = $Articles -> get_topic_articles($result['id'],$result['category'],4) ;
        
    }
     */
    $Sections       = new Sections();
    if(!isset($_SESSION['userid'])){ 
        $query          = " update md_articles set clicks = clicks + 1 where id = '{$id}'  ";
        $Sections       ->sendquery($query);
    }    
    
    //$rightTopics    = $Sections ->right_topics();
    //$rightArticles  = $Sections ->recently_articles();
    
        
    // For view Page - header paart
    $header_script = '
    
    <link href="/new/css/article_new.css" rel="stylesheet" type="text/css" /> 
    <script type="text/javascript" src="/js/articles.js" ></script>
    <script type="text/javascript">
        var exURL     = escape("http://www.medicaldaily.com/news/'.$date.'/'.$id.'/'.$keywords.'");
        var exHed     = encodeURIComponent("'.addslashes($result['title']).'");
        var exDek     = encodeURIComponent("'.addslashes(strip_tags($result['summary'])).'");
        var http_host = encodeURIComponent("www.medicaldaily.com");
        var artid     = encodeURIComponent('.$result['id'].');
        var c_date    = encodeURIComponent("'.$date.'");
        var keywords  = encodeURIComponent("'.$result['keywords'].'");
        var maincat   = encodeURIComponent("'.$result['maincat_id'].'");
    </script>
    ';
    $header_script = '';
    $maininner  = 'news_main.php';
    $spdata = $Articles ->get_specialcats_data($id,$result['category']);
    if($spdata){
        $specialid      = $spdata[0]['id'];
        $special_title  = $spdata[0]['title'];
    }
    
    
    if($result['category'] == 92){
        $leftinner = '../../news/inner/news_left.php'; 
        $toptpl         = "img_news.tpl";
        $subtitle       ="News Room";
		$bodyid         = "news";


        
    }else if($result['category'] == 91){
        $leftinner = '../../resources/inner/resources_left.php'; 
        $toptpl         = "img_resources.tpl";
        $subtitle       ="Resources";
		$bodyid         = "resources";
        
    }else{
        // YD Pulse
        $leftinner = '../../pulse/inner/pulse_left.php'; 
        $toptpl         = "img_pulse.tpl";
        $subtitle       ="YD Pulse";
		$bodyid         = "pulse";
    }
    
    $result = array_map('stripslashes',$result);
    $page_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $pagetitle= 'Medical Daily: '.$result['title'];
    
    require_once(MDconfig::SKINPATH.'/'.$skin.'/layout.php');

?>