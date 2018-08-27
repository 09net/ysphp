<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Keyno extends Model {


public function up($str,$mcache=false){
if($str=='')return '';
if($mcache==false) return false;

if(is_array($str)){
/*数组处理*/
if(!$id=$mcache->get('keyno_'.$str[0].'_'.$str[1])){
$id=$this->find("id",array('AND'=>array('kid'=>$str[0],'aid'=>$str[1])));
if($id) $mcache->set('keyno_'.$str[0].'_'.$str[1],$id);
}
if($id){$this->update(array('sid'=>NOW_TIME),array('id'=>$id));}else{$this->insert(array('id'=>0,'kid'=>$str[0],'aid'=>$str[1],'sid' =>NOW_TIME));}


}else{
/*字符处理*/
if(!$id=$mcache->get('keyno_'.$str)){
$id=$this->find("id",array('kid'=>$str));
if($id) $mcache->set('keyno_'.$str,$id);
}
if($id){$this->update(array('sid'=>NOW_TIME),array('id'=>$id));}else{$this->insert(array('id'=>0,'kid'=>$str,'aid'=>0,'sid' =>NOW_TIME));}


 }
 
}
  
  
  
   
}
