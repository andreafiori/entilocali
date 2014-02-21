/**
 * jQuery Mobile Menu 
 * Turn unordered list menu into dropdown select menu
 * version 1.0(31-OCT-2011)
 * 
 * Built on top of the jQuery library
 *   http://jquery.com
 * 
 * Documentation
 * 	 http://github.com/mambows/mobilemenu
 */
(function(e){e.fn.mobileMenu=function(t){var n={defaultText:"Navigate to...",className:"mnav",subMenuClass:"sub-menu",subMenuDash:"–"},r=e.extend(n,t),i=e(this);this.each(function(){i.find("ul").addClass(r.subMenuClass);e("<select />",{"class":r.className}).insertAfter(i);e("<option />",{value:"#",text:r.defaultText}).appendTo("."+r.className);i.find("a").each(function(){var t=e(this),n=" "+t.text(),i=t.parents("."+r.subMenuClass),s=i.length,o;if(t.parents("ul").hasClass(r.subMenuClass)){o=Array(s+1).join(r.subMenuDash);n=o+n}e("<option />",{value:this.href,html:n,selected:this.href==window.location.href}).appendTo("."+r.className)});e("."+r.className).change(function(){var t=e(this).val();if(t!=="#"){window.location.href=e(this).val()}})});return this}})(jQuery)

/* ------------------------------------------------------------------------ */
/* Initialize Mobile Menu
/* ------------------------------------------------------------------------ */

jQuery('#menu-nav').mobileMenu({
	defaultText: 'Navigate to...',
	className: 'mnav',
	subMenuDash: '&ndash;'
	});

/* ------------------------------------------------------------------------ */
/* EOF
/* ------------------------------------------------------------------------ */