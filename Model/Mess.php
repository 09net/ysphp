<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Mess extends Model {
private $sqlme	= '*';
 
public function read($id,$mcache=false){
 if($mcache!=false) if($data=$mcache->get(__CLASS__.$id)) return $data;
if($data=$this->format_one($this->find($this->sqlme,array('id'=>$id)),$mcache) and $mcache!=false) $mcache->set(__CLASS__.$id,$data);
return $data;
 } 
public function del($id,$mcache=false){
if($mcache) $mcache->rm(__CLASS__.$id);
return  $this->delete(array('id'=>$id));
}
public function up_int($id,$key,$mcache=false){
if($mcache) $mcache->rm(__CLASS__.$id);
return $this->update($key,array('id'=>$id));
} 





}
