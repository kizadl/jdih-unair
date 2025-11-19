<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package agenshark
 */

/** 
 *
 * agenshark header
 */

function agenshark_check_header()
{
    $agenshark_header_style = function_exists('get_field') ? get_field('header_style') : NULL;
    $agenshark_default_header_style = get_theme_mod('choose_default_header', 'header-style-1');

    if ($agenshark_header_style == 'header-style-1' && empty($_GET['s'])) {
        get_template_part('template-parts/header/header-1');
    } elseif ($agenshark_header_style == 'header-style-2' && empty($_GET['s'])) {
        get_template_part('template-parts/header/header-2');
    } elseif ($agenshark_header_style == 'header-style-3' && empty($_GET['s'])) {
        get_template_part('template-parts/header/header-3');
    } elseif ($agenshark_header_style == 'header-style-4' && empty($_GET['s'])) {
        get_template_part('template-parts/header/header-4');
    } elseif ($agenshark_header_style == 'header-style-5' && empty($_GET['s'])) {
        get_template_part('template-parts/header/header-5');
    } else {

        /** default header style **/
        if ($agenshark_default_header_style == 'header-style-2') {
            get_template_part('template-parts/header/header-2');
        } elseif ($agenshark_default_header_style == 'header-style-3') {
            get_template_part('template-parts/header/header-3');
        } elseif ($agenshark_default_header_style == 'header-style-4') {
            get_template_part('template-parts/header/header-4');
        } elseif ($agenshark_default_header_style == 'header-style-5') {
            get_template_part('template-parts/header/header-5');
        } else {
            get_template_part('template-parts/header/header-1');
        }
    }
}
add_action('agenshark_header_style', 'agenshark_check_header', 10);


/**
 * [agenshark_header_lang description]
 * @return [type] [description]
 */
function agenshark_header_lang_defualt()
{
    $agenshark_header_lang = get_theme_mod('agenshark_header_lang', false);
    if ($agenshark_header_lang) : ?>

        <ul>
            <li><a href="javascript:void(0)" class="lang__btn"><?php print esc_html__('English', 'agenshark'); ?> <i class="fa-light fa-angle-down"></i></a>
                <?php do_action('agenshark_language'); ?>
            </li>
        </ul>

    <?php endif; ?>
<?php
}

/**
 * [agenshark_language_list description]
 * @return [type] [description]
 */
function _agenshark_language($mar)
{
    return $mar;
}
function agenshark_language_list()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul>';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul>';
        $mar .= '<li><a href="#">' . esc_html__('English', 'agenshark') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('Bangla', 'agenshark') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('French', 'agenshark') . '</a></li>';
        $mar .= ' </ul>';
    }
    print _agenshark_language($mar);
}
add_action('agenshark_language', 'agenshark_language_list');


// header logo
function agenshark_header_logo()
{ ?>
    <?php
    $agenshark_logo_on = function_exists('get_field') ? get_field('is_enable_sec_logo') : NULL;
    $agenshark_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
    $agenshark_logo_black = get_template_directory_uri() . '/assets/img/logo/logo-black.png';

    $agenshark_site_logo = get_theme_mod('logo', $agenshark_logo);
    $agenshark_secondary_logo = get_theme_mod('seconday_logo', $agenshark_logo_black);
    ?>

    <?php if (!empty($agenshark_logo_on)) : ?>
        <a class="secondary-logo" href="<?php print esc_url(home_url('/')); ?>"> <img src="<?php print esc_url($agenshark_secondary_logo); ?>" alt="<?php print esc_attr__('logo', 'agenshark'); ?>" /></a>
    <?php else : ?>
        <a class="standard-logo" href="<?php print esc_url(home_url('/')); ?>"><img src="<?php print esc_url($agenshark_site_logo); ?>" alt="<?php print esc_attr__('logo', 'agenshark'); ?>" /></a>
    <?php endif; ?>
<?php
}

// header logo
function agenshark_header_sticky_logo()
{ ?>
    <?php
    $agenshark_logo_black = get_template_directory_uri() . '/assets/img/logo/logo-black.png';
    $agenshark_secondary_logo = get_theme_mod('seconday_logo', $agenshark_logo_black);
    ?>
    <a class="sticky-logo" href="<?php print esc_url(home_url('/')); ?>">
        <img src="<?php print esc_url($agenshark_secondary_logo); ?>" alt="<?php print esc_attr__('logo', 'agenshark'); ?>" />
    </a>
<?php
}

function agenshark_mobile_logo()
{
    // side info
    $agenshark_mobile_logo_hide = get_theme_mod('agenshark_mobile_logo_hide', false);

    $agenshark_site_logo = get_theme_mod('logo', get_template_directory_uri() . '/assets/img/logo/logo.png');

?>

    <?php if (!empty($agenshark_mobile_logo_hide)) : ?>
        <div class="side__logo mb-25">
            <a class="sideinfo-logo" href="<?php print esc_url(home_url('/')); ?>">
                <img src="<?php print esc_url($agenshark_site_logo); ?>" alt="<?php print esc_attr__('logo', 'agenshark'); ?>" />
            </a>
        </div>
    <?php endif; ?>



<?php }

/**
 * [agenshark_header_social_profiles description]
 * @return [type] [description]
 */
function agenshark_header_social_profiles()
{
    $agenshark_topbar_fb_url = get_theme_mod('agenshark_topbar_fb_url', __('#', 'agenshark'));
    $agenshark_topbar_twitter_url = get_theme_mod('agenshark_topbar_twitter_url', __('#', 'agenshark'));
    $agenshark_topbar_youtube_url = get_theme_mod('agenshark_topbar_youtube_url', __('#', 'agenshark'));
    $agenshark_topbar_linkedin_url = get_theme_mod('agenshark_topbar_linkedin_url', __('#', 'agenshark'));
?>
    <ul>
        <?php if (!empty($agenshark_topbar_fb_url)) : ?>
            <li><a class="icon facebook" href="<?php print esc_url($agenshark_topbar_fb_url); ?>"><i class="fa-brands fa-facebook-f"></i></a> </li>
        <?php endif; ?>

        <?php if (!empty($agenshark_topbar_twitter_url)) : ?>
            <li> <a class="icon twitter" href="<?php print esc_url($agenshark_topbar_twitter_url); ?>"><i class="fa-brands fa-twitter"></i></a> </li>
        <?php endif; ?>

        <?php if (!empty($agenshark_topbar_youtube_url)) : ?>
            <li> <a class="icon youtube" href="<?php print esc_url($agenshark_topbar_youtube_url); ?>"><i class="fa-brands fa-youtube"></i></a> </li>
        <?php endif; ?>

        <?php if (!empty($agenshark_topbar_linkedin_url)) : ?>
            <li> <a class="icon linkedin" href="<?php print esc_url($agenshark_topbar_linkedin_url); ?>"><i class="fa-brands fa-linkedin"></i></a> </li>
        <?php endif; ?>
    </ul>

<?php
}

/**
 * [agenshark_header_social_profiles description]
 * @return [type] [description]
 */
function agenshark_header_2_social_profiles()
{
    $agenshark_topbar_facebook_url_h2 = get_theme_mod('agenshark_topbar_facebook_url_h2', __('#', 'agenshark'));
    $agenshark_topbar_instagram_url_h2 = get_theme_mod('agenshark_topbar_instagram_url_h2', __('#', 'agenshark'));
    $agenshark_topbar_twitter_url_h2 = get_theme_mod('agenshark_topbar_twitter_url_h2', __('#', 'agenshark'));
?>
    <ul>
        <?php if (!empty($agenshark_topbar_facebook_url_h2)) : ?>
            <li><a class="icon facebook" href="<?php print esc_url($agenshark_topbar_facebook_url_h2); ?>"><i class="fa-brands fa-facebook-f"></i></a> </li>
        <?php endif; ?>

        <?php if (!empty($agenshark_topbar_instagram_url_h2)) : ?>
            <li> <a class="icon instagram" href="<?php print esc_url($agenshark_topbar_instagram_url_h2); ?>"><i class="fa-brands fa-instagram"></i></a> </li>
        <?php endif; ?>

        <?php if (!empty($agenshark_topbar_twitter_url_h2)) : ?>
            <li> <a class="icon twitter" href="<?php print esc_url($agenshark_topbar_twitter_url_h2); ?>"><i class="fa-brands fa-twitter"></i></a> </li>
        <?php endif; ?>
    </ul>

<?php
}




function agenshark_footer_social_profiles()
{
    $agenshark_footer_fb_url = get_theme_mod('agenshark_footer_fb_url', __('#', 'agenshark'));
    $agenshark_footer_twitter_url = get_theme_mod('agenshark_footer_twitter_url', __('#', 'agenshark'));
    $agenshark_footer_instagram_url = get_theme_mod('agenshark_footer_instagram_url', __('#', 'agenshark'));
    $agenshark_footer_linkedin_url = get_theme_mod('agenshark_footer_linkedin_url', __('#', 'agenshark'));
    $agenshark_footer_youtube_url = get_theme_mod('agenshark_footer_youtube_url', __('#', 'agenshark'));
?>

    <ul>
        <?php if (!empty($agenshark_footer_fb_url)) : ?>
            <li>
                <a href="<?php print esc_url($agenshark_footer_fb_url); ?>">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($agenshark_footer_twitter_url)) : ?>
            <li>
                <a href="<?php print esc_url($agenshark_footer_twitter_url); ?>">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($agenshark_footer_instagram_url)) : ?>
            <li>
                <a href="<?php print esc_url($agenshark_footer_instagram_url); ?>">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($agenshark_footer_linkedin_url)) : ?>
            <li>
                <a href="<?php print esc_url($agenshark_footer_linkedin_url); ?>">
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($agenshark_footer_youtube_url)) : ?>
            <li>
                <a href="<?php print esc_url($agenshark_footer_youtube_url); ?>">
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
        <?php endif; ?>
    </ul>
<?php
}

/**
 * [agenshark_header_menu description]
 * @return [type] [description]
 */
function agenshark_header_menu()
{
?>
    <?php
    wp_nav_menu([
        'theme_location' => 'main-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Agenshark_Navwalker_Class::fallback',
        'walker'         => new Agenshark_Navwalker_Class,
    ]);
    ?>
<?php
}

/**
 * [agenshark_header_menu description]
 * @return [type] [description]
 */
function agenshark_mobile_menu()
{
?>
    <?php
    $agenshark_menu = wp_nav_menu([
        'theme_location' => 'main-menu',
        'menu_class'     => '',
        'container'      => '',
        'menu_id'        => 'mobile-menu-active',
        'echo'           => false,
    ]);

    $agenshark_menu = str_replace("menu-item-has-children", "menu-item-has-children has-children", $agenshark_menu);
    echo wp_kses_post($agenshark_menu);
    ?>
<?php
}

/**
 * [agenshark_search_menu description]
 * @return [type] [description]
 */
function agenshark_header_search_menu()
{
?>
    <?php
    wp_nav_menu([
        'theme_location' => 'header-search-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Agenshark_Navwalker_Class::fallback',
        'walker'         => new Agenshark_Navwalker_Class,
    ]);
    ?>
<?php
}

/**
 * [agenshark_footer_menu description]
 * @return [type] [description]
 */
function agenshark_footer_menu()
{
    wp_nav_menu([
        'theme_location' => 'footer-menu',
        'menu_class'     => 'm-0',
        'container'      => '',
        'fallback_cb'    => 'Agenshark_Navwalker_Class::fallback',
        'walker'         => new Agenshark_Navwalker_Class,
    ]);
}


/**
 * [agenshark_category_menu description]
 * @return [type] [description]
 */
function agenshark_category_menu()
{
    wp_nav_menu([
        'theme_location' => 'category-menu',
        'menu_class'     => 'cat-submenu m-0',
        'container'      => '',
        'fallback_cb'    => 'Agenshark_Navwalker_Class::fallback',
        'walker'         => new Agenshark_Navwalker_Class,
    ]);
}

/**
 *
 * Agenshark footer
 */
add_action('agenshark_footer_area', 'agenshark_call_default_footer', 10);
function agenshark_call_default_footer()
{
    // Display Default Footer
    if (!class_exists('TP_Core')) {
        get_template_part('template-parts/footer/footer-1');
    }
}

// agenshark_copyright_text
function agenshark_copyright_text()
{
    print get_theme_mod('agenshark_copyright', esc_html__('© Agenshark 2024 | All Rights Reserved', 'agenshark'));
}



/**
 *
 * pagination
 */
if (!function_exists('agenshark_pagination')) {

    function _agenshark_pagi_callback($pagination)
    {
        return $pagination;
    }

    //page navegation
    function agenshark_pagination($prev, $next, $pages, $args)
    {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if (!$pages) {
                $pages = 1;
            }
        }

        $pagination = [
            'base'      => add_query_arg('paged', '%#%'),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ($wp_rewrite->using_permalinks()) {
            $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
        }

        if (!empty($wp_query->query_vars['s'])) {
            $pagination['add_args'] = ['s' => get_query_var('s')];
        }

        $pagi = '';
        if (paginate_links($pagination) != '') {
            $paginations = paginate_links($pagination);
            $pagi .= '<ul>';
            foreach ($paginations as $key => $pg) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _agenshark_pagi_callback($pagi);
    }
}


// header top bg color
function agenshark_breadcrumb_bg_color()
{
    $color_code = get_theme_mod('agenshark_breadcrumb_bg_color', '#222');
    wp_enqueue_style('agenshark-custom', AGENSHARK_THEME_CSS_DIR . 'agenshark-custom.css', []);
    if ($color_code != '') {
        $custom_css = '';
        $custom_css .= ".breadcrumb-bg.gray-bg{ background: " . $color_code . "}";

        wp_add_inline_style('agenshark-breadcrumb-bg', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'agenshark_breadcrumb_bg_color');

// breadcrumb-spacing top
function agenshark_breadcrumb_spacing()
{
    $padding_px = get_theme_mod('agenshark_breadcrumb_spacing', '160px');
    wp_enqueue_style('agenshark-custom', AGENSHARK_THEME_CSS_DIR . 'agenshark-custom.css', []);
    if ($padding_px != '') {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-top: " . $padding_px . "}";

        wp_add_inline_style('agenshark-breadcrumb-top-spacing', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'agenshark_breadcrumb_spacing');

// breadcrumb-spacing bottom
function agenshark_breadcrumb_bottom_spacing()
{
    $padding_px = get_theme_mod('agenshark_breadcrumb_bottom_spacing', '160px');
    wp_enqueue_style('agenshark-custom', AGENSHARK_THEME_CSS_DIR . 'agenshark-custom.css', []);
    if ($padding_px != '') {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-bottom: " . $padding_px . "}";

        wp_add_inline_style('agenshark-breadcrumb-bottom-spacing', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'agenshark_breadcrumb_bottom_spacing');

// scrollup
function agenshark_scrollup_switch()
{
    $scrollup_switch = get_theme_mod('agenshark_scrollup_switch', false);
    wp_enqueue_style('agenshark-custom', AGENSHARK_THEME_CSS_DIR . 'agenshark-custom.css', []);
    if ($scrollup_switch) {
        $custom_css = '';
        $custom_css .= "#scrollUp{ display: none !important;}";

        wp_add_inline_style('agenshark-scrollup-switch', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'agenshark_scrollup_switch');

// theme color
function agenshark_custom_color()
{
    $color_code = get_theme_mod('agenshark_color_option', '#2b4eff');
    wp_enqueue_style('agenshark-custom', AGENSHARK_THEME_CSS_DIR . 'agenshark-custom.css', []);
    if ($color_code != '') {
        $custom_css = '';
        $custom_css .= ".demo-class { background-color: " . $color_code . "}";

        $custom_css .= ".demo-class { color: " . $color_code . "}";

        $custom_css .= ".demo-class { border-color: " . $color_code . "}";
        $custom_css .= ".demo-class { border-left-color: " . $color_code . "}";
        $custom_css .= ".demo-class { stroke: " . $color_code . "}";
        $custom_css .= ".demo-class { border-color: " . $color_code . "}";
        wp_add_inline_style('agenshark-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'agenshark_custom_color');


// theme color
function agenshark_custom_color_primary()
{
    $color_code = get_theme_mod('agenshark_color_option_2', '#f2277e');
    wp_enqueue_style('agenshark-custom', AGENSHARK_THEME_CSS_DIR . 'agenshark-custom.css', []);
    if ($color_code != '') {
        $custom_css = '';
        $custom_css .= ".demo-class { background-color: " . $color_code . "}";

        $custom_css .= ".demo-class { color: " . $color_code . "}";

        $custom_css .= ".demo-class { border-left-color: " . $color_code . "}";
        wp_add_inline_style('agenshark-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'agenshark_custom_color_primary');

// theme color
function agenshark_custom_color_scrollup()
{
    $color_code = get_theme_mod('agenshark_color_scrollup', '#2b4eff');
    wp_enqueue_style('agenshark-custom', AGENSHARK_THEME_CSS_DIR . 'agenshark-custom.css', []);
    if ($color_code != '') {
        $custom_css = '';
        $custom_css .= ".demo-class { color: " . $color_code . "}";
        $custom_css .= ".demo-class { stroke: " . $color_code . "}";
        wp_add_inline_style('agenshark-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'agenshark_custom_color_scrollup');

// theme color
function agenshark_custom_color_secondary()
{
    $color_code = get_theme_mod('agenshark_color_option_3', '#30a820');
    wp_enqueue_style('agenshark-custom', AGENSHARK_THEME_CSS_DIR . 'agenshark-custom.css', []);
    if ($color_code != '') {
        $custom_css = '';
        $custom_css .= ".demo-class { background-color: " . $color_code . "}";

        $custom_css .= ".demo-class { color: " . $color_code . "}";

        $custom_css .= ".asdf { border-color: " . $color_code . "}";
        wp_add_inline_style('agenshark-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'agenshark_custom_color_secondary');

// theme color
function agenshark_custom_color_secondary_2()
{
    $color_code = get_theme_mod('agenshark_color_option_3_2', '#ffb352');
    wp_enqueue_style('agenshark-custom', AGENSHARK_THEME_CSS_DIR . 'agenshark-custom.css', []);
    if ($color_code != '') {
        $custom_css = '';
        $custom_css .= ".demo-class { background-color: " . $color_code . "}";

        $custom_css .= ".demo-class { color: " . $color_code . "}";

        $custom_css .= ".demo-class { border-color: " . $color_code . "}";
        wp_add_inline_style('agenshark-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'agenshark_custom_color_secondary_2');


// agenshark_kses_intermediate
function agenshark_kses_intermediate($string = '')
{
    return wp_kses($string, agenshark_get_allowed_html_tags('intermediate'));
}

function agenshark_get_allowed_html_tags($level = 'basic')
{
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function agenshark_kses($raw)
{

    $allowed_tags = array(
        'a'                         => array(
            'class'   => array(),
            'href'    => array(),
            'rel'  => array(),
            'title'   => array(),
            'target' => array(),
        ),
        'abbr'                      => array(
            'title' => array(),
        ),
        'b'                         => array(),
        'blockquote'                => array(
            'cite' => array(),
        ),
        'cite'                      => array(
            'title' => array(),
        ),
        'code'                      => array(),
        'del'                    => array(
            'datetime'   => array(),
            'title'      => array(),
        ),
        'dd'                     => array(),
        'div'                    => array(
            'class'   => array(),
            'title'   => array(),
            'style'   => array(),
        ),
        'dl'                     => array(),
        'dt'                     => array(),
        'em'                     => array(),
        'h1'                     => array(),
        'h2'                     => array(),
        'h3'                     => array(),
        'h4'                     => array(),
        'h5'                     => array(),
        'h6'                     => array(),
        'i'                         => array(
            'class' => array(),
        ),
        'img'                    => array(
            'alt'  => array(),
            'class'   => array(),
            'height' => array(),
            'src'  => array(),
            'width'   => array(),
        ),
        'li'                     => array(
            'class' => array(),
        ),
        'ol'                     => array(
            'class' => array(),
        ),
        'p'                         => array(
            'class' => array(),
        ),
        'q'                         => array(
            'cite'    => array(),
            'title'   => array(),
        ),
        'span'                      => array(
            'class'   => array(),
            'title'   => array(),
            'style'   => array(),
        ),
        'iframe'                 => array(
            'width'         => array(),
            'height'     => array(),
            'scrolling'     => array(),
            'frameborder'   => array(),
            'allow'         => array(),
            'src'        => array(),
        ),
        'strike'                 => array(),
        'br'                     => array(),
        'strong'                 => array(),
        'data-wow-duration'            => array(),
        'data-wow-delay'            => array(),
        'data-wallpaper-options'       => array(),
        'data-stellar-background-ratio'   => array(),
        'ul'                     => array(
            'class' => array(),
        ),
        'svg' => array(
            'class' => true,
            'aria-hidden' => true,
            'aria-labelledby' => true,
            'role' => true,
            'xmlns' => true,
            'width' => true,
            'height' => true,
            'viewbox' => true, // <= Must be lower case!
        ),
        'g'     => array('fill' => true),
        'title' => array('title' => true),
        'path'  => array('d' => true, 'fill' => true,),
    );

    if (function_exists('wp_kses')) { // WP is here
        $allowed = wp_kses($raw, $allowed_tags);
    } else {
        $allowed = $raw;
    }

    return $allowed;
}

function ag_get_page_by_title($page_title, $output = OBJECT, $post_type = 'page')
{
    global $wpdb;

    if (is_array($post_type)) {
        $post_type           = esc_sql($post_type);
        $post_type_in_string = "'" . implode("','", $post_type) . "'";
        $sql                 = $wpdb->prepare(
            "SELECT ID
			FROM $wpdb->posts
			WHERE post_title = %s
			AND post_type IN ($post_type_in_string)",
            $page_title
        );
    } else {
        $sql = $wpdb->prepare(
            "SELECT ID
			FROM $wpdb->posts
			WHERE post_title = %s
			AND post_type = %s",
            $page_title,
            $post_type
        );
    }

    $page = $wpdb->get_var($sql);

    if ($page) {
        return get_post($page, $output);
    }

    return null;
}

function agenshark_register_my_patterns()
{
    $pattern = array(
        'title'       => __('My Block Pattern', 'agenshark'),
        'description' => _x('A description of the pattern', 'Block pattern description', 'agenshark'),
        'content'     => '<!-- wp:paragraph --><p>My custom block pattern content.</p><!-- /wp:paragraph -->',
    );

    register_block_pattern('my-pattern', $pattern);
}
add_action('init', 'agenshark_register_my_patterns');


function agenshark_register_custom_block_styles()
{
    // Register a custom style for the core/paragraph block.
    register_block_style(
        'core/paragraph',
        array(
            'name'         => 'custom-paragraph-style',
            'label'        => __('Custom Paragraph Style', 'agenshark'),
            'inline_style' => '.wp-block-paragraph.is-style-custom-paragraph-style { font-weight: inharit; }',
        )
    );
}
add_action('init', 'agenshark_register_custom_block_styles');
