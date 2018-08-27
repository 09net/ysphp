<?php
function A($name) {
    $class = "\Action\\{$name}";
    return new $class;
}

function g($name) {
    return $GLOBALS[$name];
}
function X($name) {
    $data = explode(".", $name);
    if (count($data) == 2) {
        $v = $data[1];
        if ($data[0] == 'get') {
            return isset($_GET[$v]) ? trim($_GET[$v]) : '';
        } elseif ($data['0'] == 'post') {
            return isset($_POST[$v]) ? trim($_POST[$v]) : '';;
        } elseif ($data['0'] == 'session') {
            return isset($_SESSION[$v]) ? $_SESSION[$v] : '';;
        } elseif ($data['0'] == 'cookie') {
            return isset($_COOKIE[$v]) ? $_COOKIE[$v] : '';;
        } elseif ($data['0'] == 'server') {
            return isset($_SERVER[$v]) ? $_SERVER[$v] : '';;
        }
    }
    return '';
}
function S($name, $more = '') {
    return new YSModel(strtolower($name) , $more);
}
function M($name, $more = '') {
    $class = "\Model\\{$name}";
    return new $class(strtolower($name) , $more);
}
function L($name) {
    $class = "Lib\\{$name}";
    return new $class;
}
function mk($text, $toVariant=false){
    static $mk =false;
	  static $mk_i=0;
	  if($mk_i>5) return $text;
	  if($toVariant==false)  return $text;
	if($mk==false) $mk=require(INDEX_PATH.'mk/zhconverter.php');
	return $mk->convert($text, $toVariant);
}

function C($name = null, $value = null, $default = null) {
    static $_config = array();
    if (empty($name)) {
        return $_config;
    }
    if (is_string($name)) {
        if (!strpos($name, '.')) {
            $name = strtoupper($name);
            if (is_null($value)) return isset($_config[$name]) ? $_config[$name] : $default;
            $_config[$name] = $value;
            return null;
        }
        $name = explode('.', $name);
        $name[0] = strtoupper($name[0]);
        if (is_null($value)) return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : $default;
        $_config[$name[0]][$name[1]] = $value;
        return null;
    }
    if (is_array($name)) {
        $_config = array_merge($_config, array_change_key_case($name, CASE_UPPER));
        return null;
    }
    return null;
}
function cookie($name = '', $value = '', $expire = 0) {
    $name = str_replace('.', '_', $name);
    if ('' === $value) {
        if ('' === $name) {
            return $_COOKIE;
        } elseif (isset($_COOKIE[$name])) {
            $value = $_COOKIE[$name];
            return $value;
        } else {
            return null;
        }
    } else {
        if (is_null($value)) {
            setcookie($name, '', NOW_TIME - 3600, '/', DOMAIN);
            unset($_COOKIE[$name]);
        } else {
            $expire = !empty($expire) ? NOW_TIME + intval($expire) : NOW_TIME + 8640000;
            setcookie($name, $value, $expire, '/', DOMAIN);
            $_COOKIE[$name] = $value;
        }
    }
    return null;
}
function session($name = '', $value = '') {
    if ('' === $value) {
        if ('' === $name) {
            return $_SESSION;
        } elseif (0 === strpos($name, '[')) {
            if ('[pause]' == $name || '[stop]' == $name) {
                session_write_close();
            } elseif ('[start]' == $name) {
                session_start();
            } elseif ('[destroy]' == $name || '[end]' == $name) {
                $_SESSION = array();
                session_unset();
                session_destroy();
            } elseif ('[regenerate]' == $name) {
                session_regenerate_id();
            }
        } elseif (0 === strpos($name, '?')) {
            $name = substr($name, 1);
            if (strpos($name, '.')) {
                list($name1, $name2) = explode('.', $name);
                return isset($_SESSION[$name1][$name2]);
            } else {
                return isset($_SESSION[$name]);
            }
        } elseif (is_null($name)) {
            $_SESSION = array();
        } else {
            if (strpos($name, '.')) {
                list($name1, $name2) = explode('.', $name);
                return isset($_SESSION[$name1][$name2]) ? $_SESSION[$name1][$name2] : null;
            } else {
                return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
            }
        }
    } elseif (is_null($value)) {
        if (strpos($name, '.')) {
            list($name1, $name2) = explode('.', $name);
            unset($_SESSION[$name1][$name2]);
        } else {
            unset($_SESSION[$name]);
        }
    } else {
        if (strpos($name, '.')) {
            list($name1, $name2) = explode('.', $name);
            $_SESSION[$name1][$name2] = $value;
        } else {
            $_SESSION[$name] = $value;
        }
    }
    return null;
}
function put_tmp_file($path, $content) {
    if (!is_dir(TMP_PATH)) return;
    file_put_contents($path, "<?php !defined('YS_PATH') && exit('YS_PATH not defined.'); ?>\r\n" . $content);
}
function URL($action, $method, $age = '', $ext = '') {
    $action_arr = C("YS_URL.action");
    $method_arr = C("YS_URL.method");
    if (preg_match('/^[A-Za-z](\/|\w)*$/', $action)) $url = (isset($action_arr[$action]) ? $action_arr[$action] : $action);
    else $url = $action;
    if (preg_match('/^[A-Za-z](\/|\w)*$/', $method)) $url.= (isset($method_arr[$action][$method]) ? EXP . $method_arr[$action][$method] : ($method == '' ? '' : EXP . $method)) . ($age == '' ? '' : '' . $age);
    else $url.= ($method == '' ? '' : EXP . $method) . ($age == '' ? '' : '' . $age);
    return $url . (empty($ext) ? EXT : $ext);
}
function E($str, $save_log = true) {
    $GLOBALS['Exception_save_log'] = $save_log;
    throw new Exception($str);
}
function YS_is_mobile() {
    static $is_mobile;
    if (isset($is_mobile)) return $is_mobile;
    if (empty($_SERVER['HTTP_USER_AGENT'])) {
        $is_mobile = false;
    } else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false) {
        $is_mobile = true;
    } else {
        $is_mobile = false;
    }
    return $is_mobile;
}
function cache($name, $value = '', $options = null) {
    static $cache = '';
    if (is_array($options)) {
        $type = isset($options['type']) ? $options['type'] : '';
        $cache = YSLibCache::getInstance($type, $options);
    } elseif (is_array($name)) {
        $type = isset($name['type']) ? $name['type'] : '';
        $cache = YSLibCache::getInstance($type, $name);
        return $cache;
    } elseif (empty($cache)) {
        $cache = YSLibCache::getInstance();
    }
    if ('' === $value) {
        return $cache->get($name);
    } elseif (is_null($value)) {
        return $cache->rm($name);
    } else {
        if (is_array($options)) {
            $expire = isset($options['expire']) ? $options['expire'] : NULL;
        } else {
            $expire = is_numeric($options) ? $options : NULL;
        }
        return $cache->set($name, $value, $expire);
    }
}
function to_guid_string($mix) {
    if (is_object($mix)) {
        return spl_object_hash($mix);
    } elseif (is_resource($mix)) {
        $mix = get_resource_type($mix) . strval($mix);
    } else {
        $mix = serialize($mix);
    }
    return md5($mix);
}
function F($name, $value = '', $expire = null) {
    static $file_cache = '';
    if (empty($file_cache)) $file_cache = cache(array(
        'type' => 'file'
    ));
    if (is_null($value)) return $file_cache->rm($name);
    elseif ($value === '') return $file_cache->get($name);
    else return $file_cache->set($name, $value, $expire);
}
function vendor($path) {
    $vendor_arr = C('vendor');
    array_push($vendor_arr, $path);
    C('vendor', $vendor_arr);
}
function fy2($query, $from, $to) {
    $q = '';
    $query = str_replace('
', '
<br>', $query);
    $query = str_replace('<', '
<', $query);
    $query = str_replace('>', '>
', $query);
    foreach (explode('
', $query) as $value) {
        $value = trim($value);
        if ($value <> '' and substr($value, 0, 1) <> '<' and $from != $to and $GLOBALS['fynum'] < 2) {
            $hash = md5($from . '_' . $to . '_' . $value) . $from . $to;
            if (($from == 'zh' and $to == 'cht') or ($to == 'zh' and $from == 'cht')) {
                $q.= fy($value, $from, $to);
            } else {
                $q.= '<p><span id="' . $hash . '2">' . fy($value, $from, $to) . '</span><a href="javascript:void(0);" onclick="fyadd(this)" id="' . $hash . '"><abbr>' . fy('优化') . '</abbr></a></p>' . '<blockquote>' . $value . '</blockquote>';
            }
        } else {
            $q.= $value;
        }
    }
    return $q;
}
function fy_true($query, $from = 'zh', $to = NOW_LANG) {
    global $mk;
    static $ossClient = '';
    $query = trim($query);
    if ($from == $to or $query == '') {
        return $query;
    }
    $md5 = md5($from . '_' . $to . '_' . $query);
    $sha1 = sha1($from . '_' . $to . '_' . $query);
    if (!$ossClient) {
        $ossClient = require INDEX_PATH . 'oss/samples/Common.php';
    }
    $doesExist = $ossClient->doesObjectExist('huaren-hk', 'fy/' . substr($md5, 0, 3) . '/' . $sha1);
    if ($doesExist) {
        return $ossClient->getObject('huaren-hk', 'fy/' . substr($md5, 0, 3) . '/' . $sha1);
    }
    if (($from == 'zh' and $to == 'cht') or ($to == 'zh' and $from == 'cht')) {
        $query2 = $GLOBALS['mk']->convert($query, $to);
    } else {
        $query2 = trim(translate2($query, $to));
    }
    if ($query2) {
        $ossClient->putObject('huaren-hk', 'fy/' . substr($md5, 0, 3) . '/' . $sha1, $query2);
        return $query2;
    }
    return $query;
}
function fy($query, $from = 'zh', $to = NOW_LANG) {
    global $mk;
    global $fynum;
    $query = trim($query);
    if ($from == $to or $query == '') {
        return $query;
    }
    $hash = md5($from . '_' . $to . '_' . $query) . $from . $to;
    $str = F($hash);
    if ($str !== false) {
        return $str;
    }
    if ($GLOBALS['fynum'] > 1) {
        return $query;
    }
    if (($from == 'zh' and $to == 'cht') or ($to == 'zh' and $from == 'cht')) {
        $query2 = $GLOBALS['mk']->convert($query, $to);
        $GLOBALS['fynum'] = $GLOBALS['fynum'] + 0.2;
    } else {
        $query2 = trim(translate($query, $to));
        $GLOBALS['fynum'] = $GLOBALS['fynum'] + 1;
    }
    if ($query2) {
        F($hash, $query2, 0);
        return $query2;
    } else {
        return $query;
    }
}
function translate2($query, $to) {
    $curl = curl_init();
    $url = 'https://translation.googleapis.com/language/translate/v2?key=AIzaSyCO7v-bJFhZZ2jUgCSu9k2zH8ttTUD6xn0&target=' . $to . '&q=' . urlencode($query);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    $json = json_decode($data, true);
    if (isset($json['error'])) {
        return false;
    }
    if (isset($json['data'])) {
        return $json['data']['translations'][0]['translatedText'];
    }
    return false;
}
function translate($query, $to) {
    if (preg_match('/[=\(\[\{;]+/', $query)) {
        return $query;
    }
    $curl = curl_init();
    $url = 'https://translation.googleapis.com/language/translate/v2?key=AIzaSyCO7v-bJFhZZ2jUgCSu9k2zH8ttTUD6xn0&target=' . $to . '&q=' . urlencode($query);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    $json = json_decode($data, true);
    if (isset($json['error'])) {
        return false;
    }
    if (isset($json['data'])) {
        return $json['data']['translations'][0]['translatedText'];
    }
    return false;
}
function br2nl($text) {
    return preg_replace('/<br\\s*?\/??>/i', '
', $text);
}
function geshihua($text) {
    if ($text == '') return '';
    if (stripos($text, '</strong>' === 0)) $text = substr($text, 9);
    $text = str_replace(array(
        '[img]',
        '[/img]'
    ) , '', $text);
    $text = explode('
', br2nl($text));
    $str = '';
    foreach ($text as $value) {
        if ($value != '' and $value != '报错') $str.= $value . '
';
        if ($value == '。') $str = str_replace('
。', '。', $str);
    }
    return str_replace('
', '<br>', trim($str));
}
function bool_ads_url($linka = '') { /*允许的外链*/
    if ($linka == '') return false;
    if ($link = parse_url($linka) and isset($link['host']) and isset($link['scheme'])) {
        if (in_array(get_host($link['host']) , array(
            'ysv8.com',
            'taobao.com'
        )) and in_array($link['scheme'], array(
            "http",
            "https"
        ))) return true;
    }
    return false;
}
function get_host($url) {
    $data = explode('.', $url);
    $co_ta = count($data);
    if ($co_ta > 2) return $data[$co_ta - 2] . '.' . $data[$co_ta - 1];
    return false;
}
function conkeys($text, $mode = true) {
    if ($text == '') return '';
    /*下面两句是错误临时处理*/
    if (stripos($text, '</strong>' === 0)) $text = substr($text, 9);
    $text = str_replace(array(
        '[img]',
        '[/img]',
        '[/u]',
        '[u=',
        ']'
    ) , array(
        '',
        '',
        '</a>',
        '<a href=',
        '>'
    ) , $text);
    if ($mode) {
        if (substr($text, 0, 3) == '{m}') {
            $ta = explode('[t]', $text);
            $ta[0] = '<img src="' . $ta[0] . '" />';
            return turl(implode('<br>', $ta));
        }
    } else {
        if (substr($text, 0, 3) == '{m}') {
            $ta = explode('[t]', $text);
            return turl($ta[0]);
        }
    }
    return nl2br(turl($text));
}
function dbcache($name) {
    return $cache = YSLibCache::getInstance('Db');
}

