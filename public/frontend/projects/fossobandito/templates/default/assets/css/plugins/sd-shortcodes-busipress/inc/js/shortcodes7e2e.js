/*jslint browser: true*/
/*global $, jQuery*/
jQuery(document).ready(function ($) {

    "use strict";

/* ------------------------------------------------------------------------ */
/* Tooltip                                                                  */
/* ------------------------------------------------------------------------ */

/* http://www.red-team-design.com/easy-css3-jquery-tooltips */

    $('[data-tooltip]').addClass('tooltip');
    $('.tooltip').each(function () {
        $(this).append('<span class="tooltip-content">' + $(this).attr('data-tooltip') + '</span>');
    });

    if ($.browser.msie && $.browser.version.substr(0, 1) < 7) {
        $('.tooltip').mouseover(function () {
            $(this).children('.tooltip-content').css('visibility', 'visible');
        }).mouseout(function () {
            $(this).children('.tooltip-content').css('visibility', 'hidden');
        });
    }

/* ------------------------------------------------------------------------ */
/* Skill Bars                                                               */
/* ------------------------------------------------------------------------ */

    $('.skill').each(function () {
        var dataperc;
        dataperc = $(this).attr('data-perc');
        $(this).find('.skill-bar').animate({ "width" : dataperc + "%"}, dataperc * 20);
    });

/* ------------------------------------------------------------------------ */
/* Toggle                                                                   */
/* ------------------------------------------------------------------------ */

    $(".toggle-title").toggle(
        function () {
            $(this).addClass('toggle-active');
            $(this).siblings('.toggle-content').slideDown("fast");
        },
        function () {
            $(this).removeClass('toggle-active');
            $(this).siblings('.toggle-content').slideUp("fast");
        }
    );

/* ------------------------------------------------------------------------ */
/* Tabs                                                                     */
/* ------------------------------------------------------------------------ */

    $(".sd-tabs").tabs().css('visibility', 'visible').removeClass('no-js');

/* ------------------------------------------------------------------------ */
/* Accordion                                                                */
/* ------------------------------------------------------------------------ */

    $(".accordion").each(function () {
        if ($(this).attr('data-id') === 'closed') {
            $(this).accordion({ collapsible: true, active: false  });
        } else {
            $(this).accordion({ collapsible: true});
        }
    });

/* ------------------------------------------------------------------------ */
/* Latest Blog                                                                */
/* ------------------------------------------------------------------------ */

    $(".sd-blog-tabs").tabs({
        show: function (ui) {
            var $target = $(ui.panel);
            $('.sd-tab-content:visible').effect(
                'fade',
                {},
                1000,
                function () {
                    $target.fadeIn();
                }
            );
        }
    }).addClass('ui-tabs-vertical ui-helper-clearfix');


});
/* ------------------------------------------------------------------------ */
/* EOF                                                                      */
/* ------------------------------------------------------------------------ */