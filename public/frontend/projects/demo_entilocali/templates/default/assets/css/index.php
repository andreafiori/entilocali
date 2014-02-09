<?php
header('Content-type: text/css');
ob_start("compress");

$cssBasePath = '../../assets/css/';
$commonBasePath = '../../../../../../../common/bootstrap3/css/';
include_once($commonBasePath.'bootstrap.min.css');
include_once($cssBasePath.'style.css');

ob_end_flush();
function compress($buffer) {
	/* Remove comments */
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	/* Remove tabs, spaces, newlines, etc. */
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}