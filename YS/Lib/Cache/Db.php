<?php
namespace YS\Lib\Cache;
use YS\Lib\Cache;
defined('YS_PATH') or exit();
class Db extends Cache {
public function __construct($options=array()) {
if(empty($options)) $options = array ('table'     =>  C('DATA_CACHE_TABLE'),);
$this->options  =   $options;   
$this->options['prefix']    =   isset($options['prefix'])?  $options['prefix']  :   C('DATA_CACHE_PREFIX');
$this->options['expire']    =   isset($options['expire'])?  $options['expire']  :   C('DATA_CACHE_TIME');
$this->handler   = S($this->options['table']);
}
public function get($name) {
$name       =  $this->options['prefix'].addslashes($name);
if(!$result     =  $this->handler->find(array('expire','data'),array('cachekey'  =>  $name )))    return false;
if($result['expire']>0 and $result['expire']<NOW_TIME) return false;
if(C('DATA_CACHE_COMPRESS') && function_exists('gzcompress')) $result['data']   =   gzuncompress($result['data']);
return unserialize($result['data']);   
}
public function set($name, $value,$expire=null) {
$data   =  serialize($value);
$name   =  $this->options['prefix'].addslashes($name);
if( C('DATA_CACHE_COMPRESS') && function_exists('gzcompress')) $data   =   gzcompress($data,3);   
$crc  =  '';    
if(is_null($expire)) $expire  =  $this->options['expire'];
$expire	    =   ($expire==0)?0: (NOW_TIME+$expire) ;//缓存有效期为0表示永久缓存     
if($result     =   $this->handler->find("cachekey",array("cachekey"=>$name))) 
return  $result  =  $this->handler->update(array('data'=>$data,'datacrc'=>$crc,'expire'=>$expire),array('cachekey'=>$name));
else
return $result  =  $this->handler->insert(array('cachekey'  =>  $name,'data'      =>  $data,'datacrc'   =>  $crc,'expire'    =>  $expire));
}
public function rm($name) {
$name  =  $this->options['prefix'].addslashes($name);
return $this->handler->delete(array('cachekey'=>$name));
}
public function clear() {
return $this->handler->delete(array());
}

}