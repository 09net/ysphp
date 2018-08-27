<?php
namespace YS;
abstract class Action{
 protected $var = array();
 public $Tpl;
 public $view = '';
 protected function GetHtml($file_name){
 $View = $this->view ? $this->view . '/' : '';
 $view_file_md5 = md5($View . $file_name);
 $tmp_path = TMP_PATH . 'View_'.NOW_LANG.'_'.$file_name . '_' . $view_file_md5 . C("tmp_file_suffix");
 $plugin_name = '';
 $plugin_view = '';

 
 if (!is_file($tmp_path) || DEBUG) {
 //写入缓存文件
 $tpl_path = VIEW_PATH . $View . $file_name; //模板文件路劲
 if(!empty($plugin_name) && !empty($plugin_view)){$tpl_path = PLUGIN_PATH . "{$plugin_name}/{$plugin_view}";}
 if(is_array(C('tpl_suffix'))){
 $tpl_is = false;
 $tpl_str='';
 foreach (C('tpl_suffix') as $v) {
  if (is_file($tpl_path . $v)) {$tpl_path.=$v;$tpl_is=true;break;}
  $tpl_str.=$v.',';
 }
 if(!$tpl_is)
  E('not find(file_path): ' . $View . $file_name . "($tpl_str)");
 
 }else{
 $tpl_path.=C('tpl_suffix');
 if (!is_file($tpl_path )) {E('not find(file_path): ' . $View . $file_name . C('tpl_suffix'));}
 }
 
 $content = file_get_contents($tpl_path);
 Lib\hook::$include_file[]=$tpl_path;
 $this->Tpl = new \YS\Tpl();
 $this->Tpl->view = $this->view;

 $content = $this->Tpl->init($content,$tpl_path);
 put_tmp_file($tmp_path, $content);
 }
 extract($this->var, EXTR_OVERWRITE);
 include $tmp_path;
 }
 protected function display($file_name, $html = false){
 $this->GetHtml($file_name);
 }
 protected function v($name, $value = ''){
 if (is_array($name)) {
 $this->var = array_merge($this->var, $name);
 } else {
 $this->var[$name] = $value;
 }
 }
 protected function json($data){
 header('Content-Type:application/json; charset=utf-8');
 die(json_encode($data));
 }
 protected function jsonp($data, $fun = ''){
 header('Content-Type:application/json; charset=utf-8');
 if (empty($fun)) {
 $fun = X('get.jsoncallback');
 }
 die($fun . '(' . json_encode($data) . ');');
 }
}
