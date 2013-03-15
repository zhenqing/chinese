<?
  class LoginController extends CDcontrollers {
      public $layout = 'admin';
      public $uses       = array('User');
      public $components = array(); 
      
      public function ActionIndex(){
          
          $User         = new User();
          $form_error   = array();

          if(isset($_POST['User'])){
              
              $User -> data = $postdata = $_POST['User'];
              if($User -> validate()){
                  
                  $data_in = $User ->find_data(" userid = '".$postdata['user_id']."' ");
                  
                  $data_pw = $User -> selectquery("select password('".$postdata['user_pw']."') as pw ");
                  
                  if($data_in[0]['userid'] && $data_in[0]['userpass'] ==  $data_pw[0]['pw']){
                      $_SESSION['userid']       = $data_in[0]['userid'];
                      $_SESSION['userlevel']    = $data_in[0]['level'];
                      $this -> redirect('layouts/index');
                  }else{
                      $form_error = array('user_pw' => 'User or password is wrong.');
                  }
              }else{
                  $form_error = $User -> validate_error();
              }
             
          } 

          $this ->render('index',array('title'          => 'Login Page',
                                        'form_error'    => $form_error,
                                        'topmenu'       => 'NONE'));
                                        
      }
  }

?>