<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Post extends Model {
public function in($arr,$mcache=false){
if($data=$this->read_hash($arr['hashid'],$mcache))
return $data;
return $this->insert($arr);
}


public function read_hash_amp($hashid,$mcache=false){
if($mcache){if($data=$mcache->get(__CLASS__.'_'.$hashid)) return $data;}
if($data= preg_replace_callback("/<img(.*?src=[\"|\'].*?[\"|\'].*?)>/", 'ampimg',str_replace('{m}',bucketcdn,$this->find('content',array('hashid'=>$hashid)))) and $mcache)
$mcache->set(__CLASS__.'_'.$hashid,$data);
return $data;
}
public function read_hash($hashid,$mcache=false,$title=''){
if($mcache){if($data=$mcache->get(__CLASS__.$hashid)) return $data;}
if($data= preg_replace("/<img.*?src=[\"|\'](.*?)[\"|\'].*?>/", '<img src="$1" alt="'.addslashes($title).'" onerror="nf(this);">',str_replace('{m}',bucketcdn,$this->find('content',array('hashid'=>$hashid)))) and $mcache) $mcache->set(__CLASS__.$hashid,$data);
return $data;
}




}
