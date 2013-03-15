<?
  require('../base.php');
  require(MDconfig::CLASSPATH.'/CDcontrollers.php'); 
  require(MDconfig::CLASSPATH.'/CDmodels.php');
  require(MDconfig::CLASSPATH.'/validate.class.php'); 
  session_start();
  
  $data = $_GET['r'];
  if(!$data)
  	exit();
  $info = explode('/',$data);
  //echo $data;
 
 
  /* Connect Controller */
  $name_controller  = ucfirst($info[0]);
  require('controllers/'.$name_controller.'_controller.php');
  $ctname       =  $name_controller.'Controller';
  $Controller   = new $ctname();
  $ruleoption   = false;
  // Secure level
  
  if(method_exists($Controller,'setrule')){
        
      $Controller -> setrule();
      $ruleoption       = true;
      $levelid          = $_SESSION['userlevel'];
      $level_av         = $Controller -> rules[$levelid];
      //print_r($level_av);
  }
  
  //
  if(get_class($Controller) != 'LoginController' && !$_SESSION['userlevel']){
      $Controller -> redirect('login/index'); 
  }
  
  $actionName = '';
  if($info[1])$actionName = $info[1];
  else        $actionName = 'index';
  
  if($ruleoption){
      if(is_array($level_av) && !in_array(ucfirst($actionName),$level_av)){
            $Controller -> redirect('articles/index');
      }
  }
  

  $name_action      = 'Action'.ucfirst( $actionName);


  $Controller ->   getmodels();
  $Controller ->   $name_action();
  $skin             = $Controller -> layout;
  $information      = $Controller -> showdata($pagename);
  //set viewpage
  if($pagename){
       
       $view_folder = strtolower($name_controller);
       $pagestring = $view_folder.'/'.$pagename.'.php';
             
       require_once(MDconfig::CLASSPATH.'/CDviews.php'); // Common View page functions
       /* Page Setting */
       $CDviews = new CDviews();
       
       if($Controller -> helpers){
            
            $CDviews ->getHelpers($Controller -> helpers);
       }
            
            
       $CDviews -> pagepath = $pagestring;
       $CDviews -> skin =   $skin;
       $CDviews -> forminfo = $Controller -> form;
       if(is_array($information)){
          $CDviews -> pagevar  = $information;  
           /*
          foreach($information as $k => $v){
                $$k = $v;
          }
          */
       }
       $CDviews -> pageexec();
       
  }
  
  
  
  //Include Model;  
    
  //Include Controller
  
  //
  
?>