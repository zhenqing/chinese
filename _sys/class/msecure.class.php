<?
  class MSecure{
      private $_validation='SHA1';

      public function hashData($str){
        $hmac=$this->computeHMAC($data);
        return $hmac.$data;
      }

        public function validateData($data)
        {
                $len=$this->_validation==='SHA1'?40:32;
                if(strlen($data)>=$len)
                {
                        $hmac=substr($data,0,$len);
                        $data2=substr($data,$len);
                        return $hmac===$this->computeHMAC($data2)?$data2:false;
                }
                else
                        return false;
        }

        
        protected function computeHMAC($data)
        {
                if($this->_validation==='SHA1')
                {
                        $pack='H40';
                        $func='sha1';
                }
                else
                {
                        $pack='H32';
                        $func='md5';
                }
                $key=$this->getValidationKey();
                $key=str_pad($func($key), 64, chr(0));
                return $func((str_repeat(chr(0x5C), 64) ^ substr($key, 0, 64)) . pack($pack, $func((str_repeat(chr(0x36), 64) ^ substr($key, 0, 64)) . $data)));
        }
  }
?>