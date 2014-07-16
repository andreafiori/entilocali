<?php
// Include and compress CSS files
header('Content-type: text/css');
ob_start("compress");

$cssBasePath = '../../assets/css/';
$commonBootstrapBasePath = '../../../../../../../common/bootstrap3/css/';
include_once($commonBootstrapBasePath.'cerulean.min.css');
include_once($cssBasePath.'style.css');

ob_end_flush();
function compress($buffer)
{
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}