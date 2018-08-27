<?php
namespace YS;
class Tpl{
 public $view='';
 public function init($content,$file_path) {
 $content = $this->parseInclude($content); 
 $content = str_replace("\\","\\\\",$content);
 $content = preg_replace_callback('/({)([$^\d\s{}].+?)(})/is', array($this, 'parseTag'),$content);
 $content = str_replace("\\","\\\\",$content);
 $content = preg_replace_callback('/({)([^\d\s{}].+?)(})/is', array($this, 'parseTag'),$content);
 $content = preg_replace_callback('/({)(.+?)(})/is', array($this, 'parseTag'),$content);
 $content = str_replace("\\\\","\\",$content);
 return $content;
 }
 public function parseTag($tagStr){
 
 if(is_array($tagStr)) $tagStr = $tagStr[2];
  $tagStr = stripslashes($tagStr);
 $flag = substr($tagStr,0,1);
 $name = substr($tagStr,1);

 $a2 = substr($tagStr,0,3);
 $aa2 = substr($tagStr,3);

 $elseif = substr($tagStr,0,7);
 $elseif_v = substr($tagStr,7);

 $for = substr($tagStr,0,4);
 $for_v = substr($tagStr,4);

 $foreach = substr($tagStr,0,8);
 $foreach_v = substr($tagStr,8);
 if($flag=="$"){
  if(strpos($tagStr,'.') && !strpos($tagStr,'[')){
  $d = explode(".",$tagStr);

  if(count($d)>1){
   $flag = $d[0];
   $name = '';
   for ($i=1; $i < count($d); $i++) {
   $name.="['{$d[$i]}']";
   }
  }
  }
  return '<?php echo '.$flag.$name.';?>';
 }elseif($flag=="#"){
  return constant($name);
 }elseif($a2=="if "){
  return '<?php if ('.$aa2.'): ?>';
		}elseif($tagStr=="/if"){
  return '<?php endif ?>';
 }elseif($tagStr=="else"){
  return '<?php else: ?>';
 }elseif($elseif=="elseif "){
  return '<?php elseif ('.$elseif_v.'): ?>';
 }elseif($tagStr=="/foreach"){
  return '<?php endforeach ?>';
 }elseif($foreach=="foreach "){
  return '<?php foreach ('.$foreach_v.'): ?>';
 }elseif($for=="for "){
  return '<?php for ('.$for_v.'): ?>';
 }elseif($for=="lag "){
		if(NOW_LANG=='zh'){
		 return $for_v;
		}else{
  return fy($for_v,'zh', NOW_LANG);
			}
 }elseif($for=="php "){
  return '<?php '.$for_v.' ?>';
 }elseif($tagStr=="/for"){
  return '<?php endfor ?>';
 }
 return C('var_left_tpl') . $tagStr .C('var_right_tpl');
 }

 protected function parseInclude($content) {
 $find = preg_match_all('/'.C('var_left_tpl').'include\s(.+?)\s*?'.C('var_right_tpl').'/is',$content,$matches);
 if($find) {
  for($i=0;$i<$find;$i++) {
  $include = $matches[1][$i];
   $content = str_replace(
   $matches[0][$i],
   $this->parseIncludeItem($include),
   $content
  );
  }
 }
 return $content;
 }
 protected function parseIncludeItem($file) {
 $tmp_view = $this->view;
 $View = $this->view ? $this->view.'/' : '';
 if(strpos($file,"::")){
  $d = explode("::",$file);
  $this->view =$d[0];
  $View = $d[0] . '/';
  $file = $d[1];
 }
 $path = VIEW_PATH .$View. $file;
 if(is_array(C('tpl_suffix'))){
  foreach (C('tpl_suffix') as $v) {
  if (is_file($path . $v)) {
   $path.=$v;
   break;
  }
  }
  
 }
 else{
  $path.=C('tpl_suffix');
 }
 Lib\hook::$include_file[]=$path;
 $content = file_get_contents( $path);
 $content = Lib\hook::re($content,$path);
 $content = $this->parseInclude($content);
 $this->view = $tmp_view;
 return $content;
 }
}
