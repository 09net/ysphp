<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Cdnt extends Model {

 public function read($id,$mcache=false){
 if($mcache!=false) $data=$mcache->get(__CLASS__.$id);
if(empty($data)) $data=$this->format_one($this->find($this->sqlme,array('id'=>$id)));
if($mcache!=false and $data) $mcache->set(__CLASS__.$id,$data);
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

 



 public function read_all($mcache=false){
if($mcache!=false) $data=$mcache->get(__CLASS__.NOW_LANG);
if(empty($data)) $data=$this->select(array('name','id','mode','img','uid'),array('LIMIT'=>array(0,4),'lang'=>NOW_LANG,"ORDER"=>'atime DESC'));
if($mcache!=false) $mcache->set(__CLASS__.NOW_LANG,$data?$data:'f');
return $data=='f'?false:$data;
 }
 
 
  public function read_fid($fid,$mcache=false){
if($mcache==false){
 $data2=$this->select(array('name','id','mode','img','uid'),array('LIMIT'=>array(0,4),'fid'=>$fid,"ORDER"=>'atime DESC'));
}else{
$data2=$mcache->get('ctf'.$fid);
if(empty($data2)){
if($data2 = $this->select(array('name','id','mode','img','uid'),array('LIMIT'=>array(0,4),'fid'=>$fid,"ORDER"=>'atime DESC'))) $mcache->set('ctf'.$fid,$data2);else  $mcache->set('ctf'.$fid,'f');
}
}
return  $data2=='f'?false:$data2;
 }
 

 public function search_list($size,$key,$mcache=false){
if($mcache==false){
 $data2=$this->select(array('name','id','mode','img','uid'),array('LIMIT'=>array($size*4,4),'MATCH'=>array('columns'=>array('pinyin'),'keyword'=>$key.' IN BOOLEAN MODE')));
}else{
$data2=$mcache->get(md5('slc2_'.$size.'_'.$key));
if(empty($data2)){
if($data2 = $this->select(array('name','id','mode','img','uid'),array('LIMIT'=>array($size*4,4),'MATCH'=>array('columns'=>array('pinyin'),'keyword'=>$key.' IN BOOLEAN MODE'))))  
$mcache->set(md5('slc2_'.$size.'_'.$key),$data2); else  $mcache->set(md5('slc2_'.$size.'_'.$key),'f');
}
}
return  $data2=='f'?false:$data2;
 }

 
  public function read_list($page,$mode,$mcache=false){
 $data = array("ORDER"=>'atime DESC',"LIMIT" => array(0,10));
 if($page>0){
 $data['AND']=array('uid'=>NOW_UID,"mode"=>$mode,'atime[<]'=>$page);
 }else{
 $data['AND']=array('uid'=>NOW_UID,"mode"=>$mode);
 }
 
 if($mcache==false){
 $data=$this->select(array('img','id','name','mode','fid'),$data);
 return $data;
 }else{
$data2=$mcache->get('cdnt'.$page.'_'.NOW_UID.'_'.$mode);
if(empty($data2)){
 $data2=$this->select(array('img','id','name','mode','fid'),$data);
$mcache->set('cdnt'.$page.'_'.NOW_UID.'_'.$mode,$data2);
}
 return $data2;
 }
 
 }
 
 
    
}
