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
?>