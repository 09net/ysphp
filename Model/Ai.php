<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Ai extends Model {


public function read($hashid,$mcache=false){
 if($mcache!=false) $data=$mcache->get(__CLASS__.$hashid);
if(empty($data)) $data=$this->find('content',array('hashid'=>$hashid));
if($mcache!=false and $data) $mcache->set(__CLASS__.$hashid,$data);
return $data;
 } 

   
}
