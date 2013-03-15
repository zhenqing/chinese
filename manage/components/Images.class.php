<?
    /************
    *  1. Set variables
    *  2. Set checkimage
    *  3. Upload images
    *  4. Make Thumbnails
    */
    class Images{
        const UPLOADFOLDER = '../datainfo/';
        public $maxwidth  = 600;
        public $setwidth  = "";
        public $maxheight = ""; 
        public $path      = '/images/';
        public $imagepath = '';
        
        
        
        public function __consturct(){
            
        }
        /*
            set Inage size & Information
        */
        public function setvar($imagesize=array()){
            if(is_numeric($imagesize['maxwidth']))
                $this -> maxwidth = $imagesize['maxwidth'];
            if(is_numeric($imagesize['maxheight']))
                $this -> maxheight = $imagesize['maxheight'];
            if(is_numeric($imagesize['setwidth']))           
                $this -> setwidth= $imagesize['setwidth'];         
        }
        //check image
        public function checkimage(){
            return true;
        }
        
        public function imageupload($fileinfo,$stamp){
            $this -> path = 'images/'.date('Y/m',$stamp);
            $imgsize      = getimagesize ($fileinfo['tmp_name']);
            if($imgsize[0] <= $this -> maxwidth){
                
            }else{
                
            }
        }
        
        function saveimage($oldpath,$newpath,$orlpathdel=false){
            $imgsize      = getimagesize ($oldpath);
            if($imgsize[0]  < $this -> maxwidth && $imgsize[1]  < $this -> maxheight ){
                $return1 = copy($oldpath,$newpath);
            }else{
                $size = array();
                if($this -> setwidth > 0){
                    $size['w'] = $this -> maxwidth;    
                }else
                    $size['w']  = $this -> maxwidth;
                    $size[2]    = $imgsize[2];
                $size['h']  = $this -> maxheight;
                $return1 = $this -> resize_image($newpath,$oldpath,$size); 
            }
            /*
            if($orlpathdel == true)
                 $return = unlink($oldpath);
                 */
            return $return1;     
        }

        


        /**
         * ***
         * Make thumbnail 
         *  
         * @param string $destination
         * @param string $departure // Original Image Path
         * @param int $size        ex) 200
         * @param int $quality    ex) 80
         * @param string $ratio ex) 4:3
         * @return Imagepath
         */
        function resize_image($destination, $departure, $size, $quality='80', $ratio='false'){
            echo $destination."\r\n $departure  \r\n";
            
            if($size[2] == 1)    //-- GIF
                $src = imageCreateFromGIF($departure);
            elseif($size[2] == 2) //-- JPG
                $src = imageCreateFromJPEG($departure);
            else    //-- $size[2] == 3, PNG
                $src = imageCreateFromPNG($departure);
            
            $dst = imagecreatetruecolor($size['w'], $size['h']);
        
            
            $dstX = 0;
            $dstY = 0;
            $dstW = $size['w'];
            $dstH = $size['h'];
        
            if($ratio != 'false' && $size['w']/$size['h'] <= $size[0]/$size[1]){
                $srcX = ceil(($size[0]-$size[1]*($size['w']/$size['h']))/2);
                $srcY = 0;
                $srcW = $size[1]*($size['w']/$size['h']);
                $srcH = $size[1];
            }elseif($ratio != 'false'){
                $srcX = 0;
                $srcY = ceil(($size[1]-$size[0]*($size['h']/$size['w']))/2);
                $srcW = $size[0];
                $srcH = $size[0]*($size['h']/$size['w']);
            }else{
                $srcX = 0;
                $srcY = 0;
                $srcW = $size[0];
                $srcH = $size[1];
            }
        
            imagecopyresampled($dst, $src, $dstX, $dstY, $srcX, $srcY, $dstW, $dstH, $srcW, $srcH);
            imagejpeg($dst, $destination, $quality);
            imagedestroy($src);
            imagedestroy($dst);
        
            return TRUE;
        }

        /**
         * * get information for making Thumbnail
         *
         * @param string $img                 // original image
         * @param int $m                    // width or heigh px
         * @param string $ratio                // String
         * @return array                    // Image Information
         */
        function _getimagesize($img, $m, $ratio='false'){
        
            $v = @getImageSize($img);
        
            if($v === FALSE || $v[2] < 1 || $v[2] > 3)
                return FALSE;
        
            $m = intval($m);
        
            if($m > $v[0] && $m > $v[1])
                return array_merge($v, array("w"=>$v[0], "h"=>$v[1]));
        
            if($ratio != 'false'){
                $xy = explode(':',$ratio);
                return array_merge($v, array("w"=>$m, "h"=>ceil($m*intval(trim($xy[1]))/intval(trim($xy[0])))));
            }elseif($v[0] > $v[1]){
                $t = $v[0]/$m;
                $s = floor($v[1]/$t);
                $m = ($m > 0) ? $m : 1;
                $s = ($s > 0) ? $s : 1;
                return array_merge($v, array("w"=>$m, "h"=>$s));
            } else {
                $t = $v[1]/intval($m);
                $s = floor($v[0]/$t);
                $m = ($m > 0) ? $m : 1;
                $s = ($s > 0) ? $s : 1;
                return array_merge($v, array("w"=>$s, "h"=>$m));
            }
        }
        
        function getThumb(){
            return $this -> thumbfile;
        }
        
        
    }
?>