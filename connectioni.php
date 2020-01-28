<?php
$GLOBALS['hostname'] = 'localhost';
$GLOBALS['username'] = 'root';
$GLOBALS['password'] = '';
$GLOBALS['db'] = 'medilab';
 
$GLOBALS['dbinv'] = mysqli_connect($GLOBALS['hostname'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['db']);
 
?>
