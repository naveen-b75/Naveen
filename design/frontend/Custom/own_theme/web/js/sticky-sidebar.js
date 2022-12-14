define(["jquery", "matchMedia", "domReady!"], function ($, mediaCheck) {
    "use strict";
    var sidebar = {};
    var a2c = $(".product-add-form");
    var a2c_mobile_target = $(".product-info-main > .price-box");
    // nodes required to calculate sidebar params: width, left, padding-left
    var page_main = $(".page-main");
    var page_main_w;
    var main = $(".main");
    var main_w;
    // nodes required to calculate sidebar params: top
    var header = $(".page-header");
    var nav = $(".nav-sections");
    var breadcrumbs = $(".breadcrumbs");
    // luma specific css values
    var a2c_mb = parseInt($("#product-addtocart-button").css("margin-bottom"));
    var main_pb = parseInt(main.css("padding-bottom"));
    var tabs_mb = parseInt($(".product.info.detailed").css("margin-bottom"));

    sidebar.el = $(".sidebar");
    sidebar.padding_ratio = parseFloat(sidebar.el.css("padding-left")) / page_main.width();
    sidebar.updateHorizontalParams = function () {
        if (sidebar.el.hasClass("fixed")) {
            page_main_w = parseFloat(page_main.width());
            main_w = parseFloat(main.width());

            sidebar.width = page_main_w - main_w;
            sidebar.left = ($(window).width() - page_main_w) / 2 + main_w;
            sidebar.p_left = parseInt(page_main_w * sidebar.padding_ratio);

            sidebar.el.css({
                "width": sidebar.width + "px",
                "left": sidebar.left + "px",
                "padding-left": sidebar.p_left + "px"
            });
        }
    };
    sidebar.updateVerticalParams = function () {
        sidebar.height = sidebar.el.height();

        var scrolled_from_top = $(window).scrollTop();
        var header_h = header.outerHeight(true) || 0;
        var nav_h = nav.outerHeight(true) || 0;
        var breadcrumbs_h = breadcrumbs.outerHeight(true) || 0;
        var content_h = main.outerHeight(true) || 0;
        var sidebar_limit_top = header_h + nav_h + breadcrumbs_h;
        var sidebar_limit_bottom = sidebar_limit_top + content_h;
        var sidebar_limit_bottom_criteria = scrolled_from_top + sidebar.height + main_pb + a2c_mb - tabs_mb;

        if (sidebar_limit_bottom < sidebar_limit_bottom_criteria) {
            // sidebar should start drifting out of viewport on the top
            sidebar.top = sidebar_limit_bottom - sidebar_limit_bottom_criteria;

            sidebar.el.css({"top": sidebar.top + "px"});
        } else if (scrolled_from_top > sidebar_limit_top) {
            // header and breadcrumbs are now above viewport
            if (!sidebar.el.hasClass("fixed")) {
                sidebar.el.addClass("fixed");
                sidebar.updateHorizontalParams();
            }
            sidebar.top = 0;

            sidebar.el.css({"top": sidebar.top + "px"});
        } else {
            sidebar.el.removeClass("fixed").removeAttr("style");
        }
    };

    var onResize = function () {
        $(window).on("resize", function () {
            sidebar.updateHorizontalParams();
        });
    }, onScroll = function () {
        $(window).on("scroll", function () {
            sidebar.updateVerticalParams();
        });
    }, onInit = function () {
        mediaCheck({
            media: "(min-width: 768px)",
            entry: function () {
                sidebar.el
                    .addClass("fixed")
                    .prepend(a2c.detach());

                sidebar.updateHorizontalParams();
                sidebar.updateVerticalParams();

                onResize();
                onScroll();
            },
            exit: function () {
                a2c.detach().insertAfter(a2c_mobile_target);

                sidebar.el
                    .removeClass("fixed")
                    .removeAttr("style");
            }
        });
    };

    onInit();
});