<?php
header('Content-type: text/css');
ob_start("compress");

$cssBasePath = '../../assets/css/';
include_once($cssBasePath.'style.css');
include_once($cssBasePath.'skeleton-responsive.css');
include_once($cssBasePath.'layout-responsive.css');
include_once($cssBasePath.'style-custom.css');
include_once($cssBasePath.'superfish.css');

/* Fancybox */
include_once($cssBasePath.'fancybox/jquery.fancybox.css');
include_once($cssBasePath.'fancybox/jquery.fancybox-buttons.css');
include_once($cssBasePath.'fancybox/jquery.fancybox-thumbs.css');

?>
canvas { -ms-touch-action: double-tap-zoom; }
.recentcomments a{ display:inline !important;padding:0 !important;margin:0 !important; }
#gdl-contact-form label.error { color: red; }
#gdl-contact-form input.error { border: 1px solid red; }
<?php
ob_end_flush();

function compress($buffer) {
	/* Remove comments */
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	/* Remove tabs, spaces, newlines, etc. */
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}