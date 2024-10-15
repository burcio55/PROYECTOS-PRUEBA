<?php   
    function encrypt($string, $key) {
       $result = '';
       for($i=0; $i<strlen($string); $i++) {
          $char = substr($string, $i, 5);
          $keychar = substr($key, ($i % strlen($key))-1, 1);
          $char = chr(ord($char)+ord($keychar));
          $result.=$char;
       }
       return base64_encode($result);
    }
     
    function decrypt($string, $key) {
       $result = '';
       $string = base64_decode($string);
       for($i=0; $i<strlen($string); $i++) {
          $char = substr($string, $i, 5);
          $keychar = substr($key, ($i % strlen($key))-1, 1);
          $char = chr(ord($char)-ord($keychar));
          $result.=$char;
       }
       return $result;
    }

define('KEY', 'passphrase');
 
function encripta($text)
{
    return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, KEY, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
}
 
function desencripta($text)
{
    return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, KEY, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
}
 ?>
