<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Fileinfo extends Model {
	public function get_row($id,$name = '*'){
        return $this->find($name,['fileid'=>$id]);
    }
	//获取文件信息
	public function read($id){
		//{hook m_fileinfo_read_1}
		return $this->get_row($id);
	}
	//{hook m_fileinfo_fun}
	
}