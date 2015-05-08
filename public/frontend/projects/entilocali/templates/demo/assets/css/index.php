<?php
// Include and compress CSS files
header('Content-type: text/css');
ob_start("compress");

$cssBasePath = '../../assets/css/';
$commonBootstrapBasePath = '../../../../../../../common/bootstrap3/css/';
$fontAwesomeBasePath = '../../../../../../../common/font-awesome/css/';
include_once($commonBootstrapBasePath.'bootstrap.validated.min.css');
include_once($fontAwesomeBasePath.'font-awesome.min.css');
include_once($cssBasePath.'style.css');

ob_end_flush();
function compress($buffer)
{
    /* Remove comments */
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    /* Remove tabs, spaces, newlines, etc. */
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}