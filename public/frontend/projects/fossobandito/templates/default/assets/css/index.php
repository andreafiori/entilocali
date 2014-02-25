<?php
header('Content-type: text/css');
ob_start("compress");

$cssBasePath = '../../assets/css/';
include_once($cssBasePath.'themes/minimal/framework/css/bootstrap-fontawesome.css');
// include_once($cssBasePath.'themes/minimal/style.css');
// include_once($cssBasePath.'themes/minimal/framework/css/flexslider.css');

// include_once($cssBasePath.'mediaelement/mediaelementplayer.min80e2.css');
// include_once($cssBasePath.'mediaelement/wp-mediaelement.css');

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

/* form */
form ol { list-style-type: none; }

form { margin-bottom: 20px; }
fieldset { margin-bottom: 20px; }
input[type="text"],
input[type="password"],
input[type="email"],
textarea,
select {
	border: 1px solid #ccc;
	padding: 6px 4px;
	outline: none;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	font: 13px "HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif;
	color: #777;
	margin: 0;
	width: 210px;
	max-width: 100%;
	display: block;
	margin-bottom: 20px;
	background: #fff; }
select {
	padding: 1%; }
input[type="text"]:focus,
input[type="password"]:focus,
input[type="email"]:focus,
textarea:focus {
	border: 1px solid #aaa;
	color: #444;
	-moz-box-shadow: 0 0 3px rgba(0,0,0,.2);
	-webkit-box-shadow: 0 0 3px rgba(0,0,0,.2);
	box-shadow:  0 0 3px rgba(0,0,0,.2); }
textarea {
	min-height: 60px; }
label,
legend {
	display: block; }
select {
	width: 220px; }
input[type="checkbox"] {
	display: inline; }
label span,
legend span {
	font-weight: normal;
	font-size: 13px;
	color: #444; }
	
div label, legend { font-weight: bold; margin-bottom: 7px; }
div.error{ font-family: 'Droid Serif'; font-style: italic; margin-bottom: 15px; }
div#contactForm input, div #contactForm textarea { width: 100%;  }
<?php
ob_end_flush();

function compress($buffer) {
	/* Remove comments */
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	/* Remove tabs, spaces, newlines, etc. */
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}