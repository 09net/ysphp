<?php 
// +------------------------------------------+
// | YSPHP 44api.com                          |
// +------------------------------------------+
// | Copyright (c) 1997-2004 The 09hnnet      |
// +------------------------------------------+
// | 总框架，版权所有，不允许用于商业目的          |
// +------------------------------------------+
// | 购买授权  09hnnet <719048503@qq.com>      |
// +------------------------------------------+
namespace YS;
class YS {
 public static $_CLASS = array();
 public static $logs = array();
 public static function start() {
$GLOBALS['START_TIME'] = microtime(TRUE);
 if (function_exists('memory_get_usage')) $GLOBALS['START_MEMORY'] = memory_get_usage();
 define('CURL_TIMEOUT', 10);
 define('IS_CGI', (0 === strpos(PHP_SAPI, 'cgi') || false !== strpos(PHP_SAPI, 'fcgi')) ? 1 : 0);
 define('IS_WIN', strstr(PHP_OS, 'WIN') ? 1 : 0);
 define('IS_CLI', PHP_SAPI == 'cli' ? 1 : 0);
 $_SERVER['time'] = $_SERVER['REQUEST_TIME'];
 $_SERVER['ip'] = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
 define('CLIENT_IP', $_SERVER['ip']);
 isset($_SERVER['REQUEST_METHOD']) or $_SERVER['REQUEST_METHOD'] = 'CGI';
 define('IS_GET', $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false);
 define('IS_POST', $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false);
 define('IS_AJAX', ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || !empty($_POST['ajax']) || !empty($_GET['ajax'])) ? true : false);
define('PATH', dirname($_SERVER['SCRIPT_FILENAME']) . '/');
define('ACTION_PATH', PATH . 'Action/');
define('VIEW_PATH', PATH . 'View/');
define('CONF_PATH', PATH . 'Conf/');
define('TMP_PATH', PATH . 'Tmp/');
define('TMPHTML_PATH', PATH . 'TmpHtml/');
define('MYLIB_PATH', PATH . 'Lib/');
define('MODEL_PATH', PATH . 'Model/');
define('YS_PATH', __DIR__ . '/');
if (NOW_LANG=='zh')  define('HTML_LANG', 'zh-Hans');  elseif (NOW_LANG=='cht') define('HTML_LANG', 'zh-Hant');  else  define('HTML_LANG', NOW_LANG);
define('LIB_PATH', realpath(YS_PATH . 'Lib') . '/');
define('DEBUG', true);/*是否开启调试，上线请设置成false;测试请设置成true*/
if (isset($argv) && count($argv) == 3) $GLOBALS['argv'] = $argv;
if (!is_file(CONF_PATH . 'config.php') and !isset($_GET['Inst'])) {header('location: /install');exit;}/*这句上线后可注释掉*/
 spl_autoload_register('YS\\YS::autoload');
 if (DEBUG) {error_reporting(E_ALL | E_STRICT ^ E_NOTICE);ini_set('display_errors', 'ON');
 } else {
 error_reporting(0);
 ini_set('display_errors', 'OFF');
 }
 set_error_handler('YS\\YS::YS_error');
 set_exception_handler('YS\\YS::YS_exception');		
$config = include YS_PATH . 'conf.php';
if(!isset($_GET['Inst'])) /*这句上线后可注释掉*/
$config = array_merge($config, include CONF_PATH . 'config.php');
$protocol = empty($_SERVER['HTTP_X_CLIENT_PROTO']) ? 'http:' : $_SERVER['HTTP_X_CLIENT_PROTO'] . ':';
if(isset($config['DOMAIN'])) $config['DOMAIN_NAME'] = $protocol.'//' . NOW_LANG . '.' . DOMAIN;
include MYLIB_PATH . 'function.php';
 C($config);
 define('EXT', C("url_suffix"));
 define('EXP', C("url_explode"));
 define('IS_MOBILE', YS_is_mobile());
 define('IS_SHOUJI', IS_MOBILE);
 define('IS_WAP', IS_MOBILE);
 $url = '';
 $_GET['YS_ext'] = '';
 if (isset($_GET['s'])) $url = ltrim(strtolower($_GET['s']), C("url_explode"));
 $class = '';
 $Action = 'Index';
 $_Action = 'Index';
 $_Fun = 'Index';
 $_GET['YS_URL'] = array('Index', 'Index');
 if (empty($url)) {
 if (isset($GLOBALS['argv'])) {
 if (isset($GLOBALS['argv'][1]) && isset($GLOBALS['argv'][2])) $class = '\\Action\\' . ucfirst($GLOBALS['argv'][1]);
 $Action = $_Action = ucfirst($GLOBALS['argv'][1]);
 $_Fun = $_Fun = ucfirst($GLOBALS['argv'][2]);
 } else {
 $class = '\\Action\\Index';
 }
 } else {
 $info = explode(C('url_explode'), $url);
 $c = count($info) - 1;
 if ($c > - 1) {
 $d = explode('.', $info[$c]);$info[$c] = $d[0];
 if (isset($d[1])){$_GET['YS_ext'] = $d[1]; if($_GET['YS_ext'] == 'api'){header('Access-Control-Allow-Origin:*');   header('Access-Control-Allow-Methods:POST,GET'); header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
if($_SERVER['REQUEST_METHOD']=='OPTIONS') die('ok');}}
 }
 $_GET['YS_URL'] = $info;
 $Action = isset($info[0]) ? $info[0] : 'Index';
 $Fun = isset($info[1]) ? $info[1] : 'Index';
 $Action = trim($Action, '/');
 $Fun = trim($Fun, '/');
 $Action = $Action == '' ? 'Index' : $Action;
 $Fun = $Fun == '' ? 'Index' : $Fun;
 for ($i = 2;$i < count($info);$i++) {
 $_GET[$info[$i++]] = isset($info[$i]) ? $info[$i] : '';
 }
 if (isset($config['YS_URL']['action'])) {
 $z = array_search($Action, $config['YS_URL']['action']);
 if ($z) {
 $Action = $z;
 if (isset($config['YS_URL']['method'][$z])) {
 $b = array_search($Fun, $config['YS_URL']['method'][$z]);
 if ($b) $Fun = $b;
 }
 }
 }
 $_Action = $Action = ucfirst($Action);
 $_Fun = $Fun = ucfirst($Fun);
 $class = "\\Action\\{$_Action}";
 }
 define('ACTION_NAME', $_Action);
 define('METHOD_NAME', $_Fun);
 if (!file_exists(ACTION_PATH . "{$Action}.php")) {
 if (!file_exists(ACTION_PATH . 'No.php')) {
 E("{$Action}控制器不存在!");
 } else {
 $class = '\\Action\\No';
 }
 }
 $module = new $class();
 if (!method_exists($module, $_Fun) || !preg_match('/^[A-Za-z](\/|\w)*$/', $_Fun)) {
 if (!method_exists($module, '_no')) {
 E("你的{$class}没有存在{$_Fun}操作方法");
 }
 $_Fun = '_no';
 }
 $method = new \ReflectionMethod($module, $_Fun);
 if ($method->isPublic() && !$method->isStatic()) {
 $class = new \ReflectionClass($module);
 $method->invoke($module);
 }
 $GLOBALS['END_TIME'] = microtime(TRUE);
 if (C('DEBUG_PAGE')) {
 $DEBUG_SQL = self::$logs;
 if (empty($url)) {
 $url = '/';
 } else {
 $url = '/' . $url;
 }
 $DEBUG_CLASS = self::$_CLASS;
 require YS_PATH . 'View/Debug.php';
 }
 }
 public static function YS_exception($e) {
 if (!isset($GLOBALS['Exception_save_log'])) $GLOBALS['Exception_save_log'] = true;
 $file = $e->gettrace();
 $getFile = $e->getFile();
 $getLine = $e->getLine();
 if (isset($file[0]['args'][2])) {
 $getFile = $file[0]['args'][2];
 if (isset($file[0]['args'][3])) {
 if (!is_array($file[0]['args'][3])) $getLine = $file[0]['args'][3];
 }
 }
 $s = '';
 $log = New \YS\Lib\Logs;
 $text = $e->getMessage() . ' #发生错误的文件位于: ' . $getFile . ' #行数: ' . $getLine . ' #发生时间: ' . date("Y-m-d H:i:s") . ' ##发生URL: ' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "\r\n";
 if ($GLOBALS['Exception_save_log']) {
 $log->log($text);
 }
 if (DEBUG) {
 if (IS_AJAX) {
 header('HTTP/1.1 200 OK');
 header('Content-Type:application/json; charset=utf-8');
 die(json_encode(array('error' => false, 'info' => $text, 'data' => $text)));
 } else {
 try {
 $s = Lib\Exception::to_html($e);
 }
 catch(Exception $e) {
 $s = get_class($e) . ' thrown within the exception handler. Message: ' . $e->getMessage() . ' on line ' . $e->getLine();
 }
 echo $s;
 }
 } else {
 header('HTTP/1.1 404 Not Found');
 header('status: 404 Not Found');
 $s = $e->getMessage();
 include C("error_404");
 }
 }
 public static function YS_error($Error_Type, $Error_str, $Error_file, $Error_line, $errcontext) {
 if (isset($_SERVER['ob_start']) && DEBUG) {
 unset($_SERVER['ob_start']);
 ob_end_clean();
 }
 $s = "({$Error_Type}) : {$Error_str}";
 if (DEBUG) {
 throw new \Exception($s);
 } else {
 $log = New \YS\Lib\Logs;
 $log->log($s . ' #错误来自于:' . $Error_file . ' #行数:' . $Error_line . "\r\n\r\n");
 }
 return 0;
 }
 public static function autoload($class) {
 if (isset(self::$_CLASS[$class])) {
 return;
 }
 $className = ltrim($class, '\\');
 $fileName = '';
 $namespace = '';
 if ($lastNsPos = strrpos($className, '\\')) {
 $namespace = substr($className, 0, $lastNsPos);
 $className = substr($className, $lastNsPos + 1);
 $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
 }
 $fileName.= $className . '.php';
 if (!is_file(PATH . $fileName)) {
 $vendor_bool = false;
 foreach (C('vendor') as $v) {
 $vendor_path = ltrim($v, '\\/') . DIRECTORY_SEPARATOR . $fileName;
 if (is_file(PATH . $vendor_path)) {
 $fileName = $vendor_path;
 $vendor_bool = true;
 break;
 }
 }
 if (!$vendor_bool) {
 return false;
 }
			 return false;
 }
 $fileName = PATH . $fileName;
 $info = explode('\\', $class);
 $agrs = count($info);
 if ($info[0] == 'Model') {
 $file = $fileName;
 Lib\hook::$include_file[] = $file;

 } elseif ($info[0] == 'Action') {
 $file = $fileName;
 Lib\hook::$include_file[] = $file;

 }
 if (empty($fileName)) {
 return false;
 }
 include_once $fileName;
 self::$_CLASS[$class] = true;
 return $fileName;
 }
 public static function SQL_LOG($log) {
 array_push(self::$logs, $log);
 }
}
YS::start();
