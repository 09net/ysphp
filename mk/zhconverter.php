<?php
class ReplacementArray {
var $data = false;
var $fss = false;
 function __construct( $data = array() ) {
 $this->data = $data;
 }
 function __sleep() {
 return array( 'data' );
 }
 function __wakeup() {
 $this->fss = false;
 }
 function setArray( $data ) {
 $this->data = $data;
 $this->fss = false;
 }
 function getArray() {
 return $this->data;
 }
 function setPair( $from, $to ) {
 $this->data[$from] = $to;
 $this->fss = false;
 }
 function mergeArray( $data ) {
 $this->data = array_merge( $this->data, $data );
 $this->fss = false;
 }
 function merge( $other ) {
 $this->data = array_merge( $this->data, $other->data );
 $this->fss = false;
 }
 function removePair( $from ) {
 unset($this->data[$from]);
 $this->fss = false;
 }
 function removeArray( $data ) {
 foreach( $data as $from => $to )
 $this->removePair( $from );
 $this->fss = false;
 }
 function replace( $subject ) {
 if ( function_exists( 'fss_prep_replace' ) ) {
 if ( $this->fss === false ) {
 $this->fss = fss_prep_replace( $this->data );
 }
 $result = fss_exec_replace( $this->fss, $subject );
 } else {
 $result = strtr( $subject, $this->data );
 }
 return $result;
 }
}
class MediaWikiZhConverter {

function __construct() {
$this->mTables = false;
$this->toVariant = false;
 }
 function loadDefaultTables() {
 require( dirname(__FILE__).'/ZhConversion.php' );
 $this->mTables = array(
 'zh' => new ReplacementArray(array_merge($zh2CN,$zh2Hans)),
 'cht' => new ReplacementArray(array_merge($zh2TW,$zh2Hant))
 );
 }
 function captionConvert( $matches) {
 $title = $matches[1];
 $text = $matches[2];
 if( !strpos( $text, '://' ) )
 $text = $this->translate($text, $this->toVariant);
 return " $title=\"$text\"";
 }
 function convert($text, $toVariant=false) {
 if(!in_array($toVariant,array('cht','zh' )) or empty($text))
 return $text;
 $this->toVariant=$toVariant;
 if (isset($wgParser) && $wgParser->UniqPrefix()!=''){
 $marker = '|' . $wgParser->UniqPrefix() . '[\-a-zA-Z0-9]+';
 } else
 $marker = "";
 $htmlfix = '|<[^>]+$|^[^<>]*>';
 $codefix = '<code>.+?<\/code>|';
 $scriptfix = '<script.*?>.*?<\/script>|';
 $prefix = '<pre.*?>.*?<\/pre>|';
 $reg = '/'.$codefix . $scriptfix . $prefix . '<[^>]+>|&[a-zA-Z#][a-z0-9]+;' . $marker . $htmlfix . '/s';
 $matches = preg_split($reg, $text, -1, PREG_SPLIT_OFFSET_CAPTURE);
 $m = array_shift($matches);
 $ret = $this->translate($m[0], $toVariant);
 $mstart = $m[1]+strlen($m[0]);
 $captionpattern = '/\s(title|alt)\s*=\s*"([\s\S]*?)"/';
 foreach($matches as $m) {
 $mark = substr($text, $mstart, $m[1]-$mstart);
 $mark = preg_replace_callback($captionpattern, array(&$this, 'captionConvert'), $mark);
 $ret .= $mark;
 $ret .= $this->translate($m[0], $toVariant);
 $mstart = $m[1] + strlen($m[0]);
 }
 return $ret;
 }
 function translate( $text, $variant ) {
 if(!$this->mTables){$this->loadDefaultTables();}
 $text = $this->mTables[$variant]->replace($text);
 return $text;
 }
 
}
return new MediaWikiZhConverter;
?>