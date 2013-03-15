<?
  class PositionsController extends CDcontrollers {
      public $layout = 'admin';
      public $uses       = array('Position');
      public $components = array(); 
      public function ActionAjaxadd(){
          $this -> layout = 'adminnone';
          
      }
      public function ActionAjaxedit(){
          $this -> layout = 'iframe';
          $section      = isset($_GET['section']) ? $_GET['section'] : null;
          $filename     = isset($_GET['filename']) ? $_GET['filename'] : null;
          $sectionid    = isset($_GET['sectionid']) ? $_GET['sectionid'] : null;
          $Position     = new Position();
          $poststatus   = "";
          if(isset($_POST['Position'])){
              $Position -> data = $_POST['Position'];
              if($Position -> validate()){
                $Position -> save();
                $poststatus =  "success";   
              }
          }
          
          $data = $Position -> find_data("sectionid = '{$sectionid}' and filename = '{$filename}' ");
          if($data)
            $Position -> data = $data[0];
            
            
          $this -> render('ajaxwrite',array('Model' => $Position,
                                        'filename' => $filename,
                                        'poststatus' => $poststatus,
                                        'sectionid'    => $sectionid,
                                        'section' => $section));
          
      }
      
  }    
            
?>