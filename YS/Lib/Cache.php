<?php
namespace YS\Lib;
class Cache {
 protected $handler ;
 protected $options = array();
 public function connect($type='',$options=array()) {
 if(empty($type)) $type = C("DATA_CACHE_TYPE");
 $class = strpos($type,'\\')? $type : 'YS\\Lib\\Cache\\'.ucwords(strtolower($type)); 
 if(class_exists($class))
 $cache = new $class($options);
 else
 E('无法加载该类库:'.$type);
 return $cache;
 }
 static function getInstance($type='',$options=array()) {
 static $_instance = array();
 $guid = $type.to_guid_string($options);
 if(!isset($_instance[$guid])){
  $obj = new Cache();
  $_instance[$guid] = $obj->connect($type,$options);
 }
 return $_instance[$guid];
 }

 public function __get($name) {
 return $this->get($name);
 }

 public function __set($name,$value) {
 return $this->set($name,$value);
 }

 public function __unset($name) {
 $this->rm($name);
 }
 public function setOptions($name,$value) {
 $this->options[$name] = $value;
 }

 public function getOptions($name) {
 return $this->options[$name];
 }

 public function __call($method,$args){
 if(method_exists($this->handler, $method)){
 return call_user_func_array(array($this->handler,$method), $args);
 }else{
 E(__CLASS__.'::'.$method.' 该缓存类没有定义你所调用的方法');
 return;
 }
 }
}