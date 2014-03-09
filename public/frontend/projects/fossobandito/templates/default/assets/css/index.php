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
	width: 95%;
	margin: auto;
	text-align: center;
	vertical-align: top;
	min-height: 555px;
}
.homepage_icon {
	margin-right: 0.5em;
	margin-bottom: 2%;
	vertical-align: top
}
@media (max-width: 767px) {
	.home_carousel_rollover img {
		width: 8%
	}
}
@media (min-width: 768px) and (max-width: 979px) {
	.home_carousel_rollover img {
		width: 8%
	}
}
.aligncenter {
	text-align: center;
}
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

/* form error labels */
label.error { color: red; }
input.error { border: 1px solid red; }

/* Accordion */
ul.gdl-accordion { list-style: none; margin-left: 0px; }
ul.gdl-accordion li { list-style: none; margin-bottom: 15px; }
h2.accordion-head { padding: 0px 0px 0px 0px; line-height: 21px; font-size: 16px; cursor: pointer; text-decoration: underline }
div.accordion-content { padding: 0px 0px 20px 37px; overflow: hidden; border: 0px; }
span.accordion-head-image { width: 24px; height: 24px; float: left; margin-right: 13px; cursor: pointer; display: block; }
div.accordion-head p { margin-bottom: 0px; }
ul.gdl-accordion .accordion-content ul li { list-style: disc; border: 0px; margin-bottom: 5px; }

#calendar
{
font-family:verdana;
font-size:12px;
border:1px black solid;
width:175px;
}

#calendar td
{
text-align:center;
}

.today
{
border:1px black solid;
background-color:#0d6aab;
color:white;
}

.days
{
border:1px black solid;
background-color:white;
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