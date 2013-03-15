<?
    /* Foundation Class */
    $folder = dirname(__FILE__);
    require($folder.'/_sys/config/config.php');
    /* Set Database Connect */  
    require(MDconfig::CLASSPATH.'/db.class.php');
    /* Set String Class */
    require(MDconfig::CLASSPATH.'/string.class.php');
    /* Section Update Class */
    require(MDconfig::CLASSPATH.'/update.class.php');
    /* Secure class */
    require(MDconfig::CLASSPATH.'/msecure.class.php');
   /* Util class */
   require(MDconfig::CLASSPATH.'/util.class.php');
   
    
?>