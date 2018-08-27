<?php
return array('var_left_tpl' => '{','var_right_tpl' => '}','tpl_suffix' => '.php','url_suffix' => '.html','tmp_file_suffix' => '.php','url_explode' => '/','DEBUG_PAGE' => true,'error_404'  => YS_PATH . "View/404.php",'lang' => 'zh',
 'DATA_CACHE_TYPE' => 'File',
 'DATA_CACHE_TIME' => 0,
 'DATA_CACHE_TABLE' => 'cache',
 'DATA_CACHE_PREFIX' => '',
 'DATA_CACHE_COMPRESS' => false, 
 'DATA_CACHE_PATH' => INDEX_PATH . 'Cache',
 'DATA_CACHE_KEY' => '',
 "SQL_IP"  => "localhost",
 'SQL_PREFIX' => 'ys_',
 'SQL_PORT'  => 3306,
 'SQL_CHARSET'  => 'utf8',
 'SQL_OPTION'  => array(
     PDO::ATTR_CASE => PDO::CASE_NATURAL,
     //PDO::ATTR_PERSISTENT => true,
    ),
 'vendor'  => array('vendor'),
);