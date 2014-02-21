(function(e){e.fn.preloader=function(t){var n={delay:200,preload_parent:"a",check_timer:300,ondone:function(){},oneachload:function(e){},fadein:500};var t=e.extend(n,t),r=e(this),i=r.find("img").css({visibility:"hidden",opacity:0}),s,o=0,u=0,a=[],f=t.delay,l=function(){s=setInterval(function(){if(o>=a.length){clearInterval(s);t.ondone();return}for(u=0;u<i.length;u++){if(i[u].complete==true){if(a[u]==false){a[u]=true;t.oneachload(i[u]);o++;f=f+t.delay}e(i[u]).css("visibility","visible").delay(f).animate({opacity:1},t.fadein,function(){e(this).parent().removeClass("preloader")})}}},t.check_timer)};i.each(function(){if(e(this).parent(t.preload_parent).length==0)e(this).wrap("<a class='preloader' />");else e(this).parent().addClass("preloader");a[u++]=false});i=e.makeArray(i);var c=jQuery("<img />",{id:"loadingicon",src:jsimagepath+"/framework/images/ajax-loader.gif"}).hide().appendTo("body");s=setInterval(function(){if(c[0].complete==true){clearInterval(s);l();c.remove();return}},100)}})(jQuery)

/* ------------------------------------------------------------------------ */
/* Initialize Preloader
/* ------------------------------------------------------------------------ */

jQuery(function () {
	jQuery(".entry-thumb, .gallery-item, .recent-blog-thumb, .framed-img, .sd-portfolio-item").preloader();
    });

/* ------------------------------------------------------------------------ */
/* EOF
/* ------------------------------------------------------------------------ */