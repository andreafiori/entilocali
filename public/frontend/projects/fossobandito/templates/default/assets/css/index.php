<?php
header('Content-type: text/css');
ob_start("compress");

$cssBasePath = '../../assets/css/';
include_once($cssBasePath.'themes/minimal/framework/css/bootstrap-fontawesome.css');
// include_once($cssBasePath.'themes/minimal/style.css');
// include_once($cssBasePath.'themes/minimal/framework/css/flexslider.css');

/* Fancybox */
include_once($cssBasePath.'fancybox/jquery.fancybox.css');
include_once($cssBasePath.'fancybox/jquery.fancybox-buttons.css');
include_once($cssBasePath.'fancybox/jquery.fancybox-thumbs.css');

?>
.home_carousel_rollover {
	width: 95%; margin: auto;
	text-align: center;
	vertical-align: top
}
.homepage_icon {
	margin-right: 2%;
	margin-bottom: 2%;
	vertical-align: top
}
.aligncenter { text-align: center; }
select {
	width: 300px;
	border: 1px solid #e6e6e6;
	height: 40px;
	line-height: 40px;
	padding: 0 10px;
	color: #5a5a62;
	margin: 5px 0 5px;
	max-width: 100%;
}
<?php
ob_end_flush();

function compress($buffer) {
	/* Remove comments */
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	/* Remove tabs, spaces, newlines, etc. */
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}