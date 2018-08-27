<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Usergroup extends Model {
public function read_all($mcache=false){
if($mcache!=false) if($data=$mcache->get(__CLASS__)) return $data;
$data=$this->select(array('id','name','space_size'));
if($mcache!=false and $data) $mcache->set(__CLASS__,$data);
return $data;
}

 public function read($id,$mcache=false,$size=''){
 if($mcache!=false) if($data=$mcache->get(__CLASS__.$id)){if($size and isset($data[$size])) return  $data[$size]; else return $data;}
 $data=$this->find('*',array('id'=>$id));
if($mcache!=false and $data) $mcache->set(__CLASS__.$id,$data);
if($size and isset($data[$size])) return  $data[$size];
return $data;

 }

	
}
