<?php
namespace Lib;
class Local{
   
    private $rootPath;

   
    private $error = ''; 


    public function __construct($config = null){

    }

    
    public function checkRootPath($rootpath){
        if(!(is_dir($rootpath) && is_writable($rootpath))){
            $this->error = '上传根目录不存在！请尝试手动创建:'.$rootpath;
            return false;
        }
        $this->rootPath = $rootpath;
        return true;
    }

    /**
     * 检测上传目录
     * @param  string $savepath 上传目录
     * @return boolean          检测结果，true-通过，false-失败
     */
    public function checkSavePath($savepath){
        /* 检测并创建目录 */
        if (!$this->mkdir($savepath)) {
            return false;
        } else {
            /* 检测目录是否可写 */
            if (!is_writable($this->rootPath . $savepath)) {
                $this->error = '上传目录 ' . $savepath . ' 不可写！';
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * 保存指定文件
     * @param  array   $file    保存的文件信息
     * @param  boolean $replace 同名文件是否覆盖
     * @return boolean          保存状态，true-成功，false-失败
     */
    public function save($file, $replace=true) {
	$this->checkSavePath($file['spath']);
        $filename = $this->rootPath . $file['savename'];
		if($GLOBALS['conf']['OSS_ENDPOINT'] and $GLOBALS['conf']['OSS_ACCESS_ID'] and $GLOBALS['conf']['OSS_ACCESS_KEY'] and $GLOBALS['conf']['OSS_BUCKET']){/*oss*/
   $osfile=str_replace(INDEX_PATH,'', $filename);
   
if(!oss($osfile, 'doesObjectExist')) oss($osfile, 'multiuploadFile',$file['tmp_name']);
 return true;

		//if(!oss($file['savename'], 'doesObjectExist')) oss($file['savename'], 'multiuploadFile',$file['tmp_name']);
         // return true;
		}
		
		
        if (!is_file($filename) and !move_uploaded_file($file['tmp_name'], $filename)) {
            $this->error = '文件上传保存错误！';
            return false;
        }

        return true;
    }


 public function save_http($img,$ext,$replace=true) {
        $md5=md5($img);
        $sha1=sha1($img);
	    $this->checkSavePath(substr($md5, 0, 3).'/');
        $filename = $this->rootPath . substr($md5, 0, 3).'/'.$sha1.$ext;
if($GLOBALS['conf']['OSS_ENDPOINT'] and $GLOBALS['conf']['OSS_ACCESS_ID'] and $GLOBALS['conf']['OSS_ACCESS_KEY'] and $GLOBALS['conf']['OSS_BUCKET']){/*oss*/
   $osfile=str_replace(INDEX_PATH,'', $filename);
if(!oss($osfile, 'doesObjectExist')) oss($osfile, 'putObject',$img);
return substr($md5, 0, 3).'/'.$sha1.$ext;
		}
		
        if (!is_file($filename) and !file_put_contents($filename , $img)) {
            $this->error = '文件上传保存错误！';
            return false;
        }

        return substr($md5, 0, 3).'/'.$sha1.$ext;
    }



    /**
     * 创建目录
     * @param  string $savepath 要创建的穆里
     * @return boolean          创建状态，true-成功，false-失败
     */
    public function mkdir($savepath){
        $dir = $this->rootPath . $savepath;
        if(is_dir($dir)){
            return true;
        }

        if(mkdir($dir, 0777, true)){
            return true;
        } else {
            $this->error = "目录 {$savepath} 创建失败！";
            return false;
        }
    }

    /**
     * 获取最后一次上传错误信息
     * @return string 错误信息
     */
    public function getError(){
        return $this->error;
    }

}