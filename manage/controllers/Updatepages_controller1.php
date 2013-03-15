<?
    /*****************************
    *  Special Case Class
    *  Get from other layout and setting
    *  1. Make Template boxes
    */
    class UpdatepageController extends CDcontrollers {
        public $layout = 'common';
        public $uses   = array('Layout');
        public $helpers= array('MDPosition');
        
        public function ActionIndex(){
            $Layout         = new Layout();
            $id             = 1;
            
            $this -> layout = 'common';
            $data           = $Layout -> find_primarykey($id);
            $Layout         -> data = $data[0];
            
            
            
            define('FOLDER','/home/medicaldaily.com/www/main/');
            define('TPLPATH','/home/medicaldaily.com/www/main/tpl/');
            define('PAGEPATH','/home/medicaldaily.com/www/main/pages/');
            $header_script  = "<link href=\"/css/homepage.css\" rel=\"stylesheet\" type=\"text/css\" /> \r\n
                                <script type=\"text/javascript\" src=\"/js/admin.js\" ></script> \r\n";
            $maininner      = "body_left.php";
            $this -> render('index',array(  'Model'     => $Layout,
                                            'maininner' => $maininner,
                                            'header_script' => $header_script ));
        }
        
    }

?>