<?php

/**
 * agenshark_scripts description
 * @return [type] [description]
 */
function agenshark_scripts()
{

    /**
     * all css files
     */

    wp_enqueue_style('agenshark-fonts', agenshark_fonts_url(), array(), time());
    if (is_rtl()) {
        wp_enqueue_style('bootstrap-rtl', AGENSHARK_THEME_CSS_DIR . 'bootstrap.rtl.min.css', array());
    } else {
        wp_enqueue_style('bootstrap', AGENSHARK_THEME_CSS_DIR . 'bootstrap.css', array());
    }

    wp_enqueue_style('animate', AGENSHARK_THEME_CSS_DIR . 'animate.css', []);
    wp_enqueue_style('swiper-bundle-min', AGENSHARK_THEME_CSS_DIR . 'swiper-bundle.min.css', []);
    wp_enqueue_style('slick', AGENSHARK_THEME_CSS_DIR . 'slick.css', []);
    wp_enqueue_style('magnific-popup', AGENSHARK_THEME_CSS_DIR . 'magnific-popup.css', []);
    wp_enqueue_style('font-awesome-pro', AGENSHARK_THEME_CSS_DIR . 'font-awesome-pro.css', []);
    wp_enqueue_style('jquery-fancybox', AGENSHARK_THEME_CSS_DIR . 'spacing.css', []);
    wp_enqueue_style('jquery-splitting', AGENSHARK_THEME_CSS_DIR . 'splitting.css', []);
    wp_enqueue_style('nice-select', AGENSHARK_THEME_CSS_DIR . 'nice-select.css', []);
    wp_enqueue_style('agenshark-core', AGENSHARK_THEME_CSS_DIR . 'agenshark-core.css', [], time());
    wp_enqueue_style('agenshark-core-unlocklive', AGENSHARK_THEME_CSS_DIR . 'agenshark-core-unlocklive.css', [], time());
    wp_enqueue_style('agenshark-unit', AGENSHARK_THEME_CSS_DIR . 'agenshark-unit.css', [], time());
    wp_enqueue_style('agenshark-custom', AGENSHARK_THEME_CSS_DIR . 'agenshark-custom.css', []);
    wp_enqueue_style('agenshark-style', get_stylesheet_uri());


    // all js
    wp_enqueue_script('bootstrap-bundle', AGENSHARK_THEME_JS_DIR . 'bootstrap-bundle.js', ['jquery'], '', true);
    wp_enqueue_script('waypoints', AGENSHARK_THEME_JS_DIR . 'waypoints.js', ['jquery'], false, true);
    wp_enqueue_script('meanmenu', AGENSHARK_THEME_JS_DIR . 'meanmenu.js', ['jquery'], false, true);
    wp_enqueue_script('swiper-bundle', AGENSHARK_THEME_JS_DIR . 'swiper-bundle.js', ['jquery'], false, true);
    wp_enqueue_script('slick', AGENSHARK_THEME_JS_DIR . 'slick.js', ['jquery'], false, true);
    wp_enqueue_script('range-slider', AGENSHARK_THEME_JS_DIR . 'range-slider.js', ['jquery'], false, true);
    wp_enqueue_script('magnific-popup', AGENSHARK_THEME_JS_DIR . 'magnific-popup.js', ['jquery'], '', true);
    wp_enqueue_script('jquery-nice-select', AGENSHARK_THEME_JS_DIR . 'nice-select.js', ['jquery'], '', true);
    wp_enqueue_script('purecounter', AGENSHARK_THEME_JS_DIR . 'purecounter.js', ['jquery'], false, true);
    wp_enqueue_script('jquery-counterup', AGENSHARK_THEME_JS_DIR . 'jquery.counterup.min.js', ['jquery'], false, true);
    wp_enqueue_script('splitting-js', AGENSHARK_THEME_JS_DIR . 'splitting.js', ['jquery'], false, true);
    wp_enqueue_script('wow', AGENSHARK_THEME_JS_DIR . 'wow.js', ['jquery'], false, true);
    wp_enqueue_script('isotope-pkgd', AGENSHARK_THEME_JS_DIR . 'isotope-pkgd.js', ['imagesloaded'], false, true);
    wp_enqueue_script('gsap-min', AGENSHARK_THEME_JS_DIR . 'gsap.min.js', ['jquery'], false, true);
    wp_enqueue_script('scroll-trigger-min', AGENSHARK_THEME_JS_DIR . 'scroll-trigger.min.js', ['jquery'], false, true);
    wp_enqueue_script('scroll-smoother-min', AGENSHARK_THEME_JS_DIR . 'scroll-smoother.min.js', ['jquery'], false, true);
    wp_enqueue_script('agenshark-main', AGENSHARK_THEME_JS_DIR . 'main.js', ['jquery'], time(), true);
    wp_enqueue_script('agenshark-main-unlocklive', AGENSHARK_THEME_JS_DIR . 'main-unlocklive.js', ['jquery'], time(), true);




    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'agenshark_scripts');

/*
Register Fonts
 */
function agenshark_fonts_url()
{
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Google font: on or off', 'agenshark')) {
        $font_url = 'https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Space+Grotesk:wght@300..700&display=swap';
    }
    return $font_url;
}


function agenshark_add_editor_styles()
{
    add_editor_style('editor-style.css');
}
add_action('admin_init', 'agenshark_add_editor_styles');