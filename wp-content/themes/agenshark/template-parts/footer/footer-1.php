<?php

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agenshark
 */

$footer_bg_img = get_theme_mod('agenshark_footer_bg');
$agenshark_footer_logo = get_theme_mod('agenshark_footer_logo');
$agenshark_footer_top_space = function_exists('get_field') ? get_field('agenshark_footer_top_space') : '0';
$agenshark_copyright_center = $agenshark_footer_logo ? 'col-lg-4 offset-lg-4 col-md-6 text-right' : 'col-lg-12 text-center';
$agenshark_footer_bg_url_from_page = function_exists('get_field') ? get_field('agenshark_footer_bg') : '';
$agenshark_footer_bg_color_from_page = function_exists('get_field') ? get_field('agenshark_footer_bg_color') : '';
$footer_bg_color = get_theme_mod('agenshark_footer_bg_color', __('#101b17', 'agenshark'));

// bg image
$bg_img = !empty($agenshark_footer_bg_url_from_page['url']) ? $agenshark_footer_bg_url_from_page['url'] : $footer_bg_img;

// bg color
$bg_color = !empty($agenshark_footer_bg_color_from_page) ? $agenshark_footer_bg_color_from_page : $footer_bg_color;

// footer_columns
$footer_columns = 0;
$footer_widgets = get_theme_mod('footer_widget_number', 4);


?>

<!-- footer area start -->
<footer class="tp-footer-area p-relative z-index-1" data-bg-color="<?php print esc_attr($bg_color); ?>">
    <?php if (is_active_sidebar('footer-1') or is_active_sidebar('footer-2') or is_active_sidebar('footer-3') or is_active_sidebar('footer-4')) : ?>
        <div class="pt-80" data-top-space="<?php print esc_attr($agenshark_footer_top_space); ?>px">
            <div class="tp-footer-bg" data-background="<?php print esc_url($bg_img); ?>"></div>
            <div class="tp-footer-main-area tp-footer-border">
                <div class="container">
                    <div class="row">
                        <?php
                        if ($footer_columns < 4) {
                            print '<div class="col-xl-3 col-lg-4 col-md-6">';
                            dynamic_sidebar('footer-1');
                            print '</div>';

                            print '<div class=col-xl-4 col-lg-5 col-md-6">';
                            dynamic_sidebar('footer-2');
                            print '</div>';

                            print '<div class="col-xl-2 col-lg-3 col-md-6">';
                            dynamic_sidebar('footer-3');
                            print '</div>';

                            print '<div class="col-xl-3 col-lg-5 col-md-6">';
                            dynamic_sidebar('footer-4');
                            print '</div>';
                        } else {
                            for ($num = 1; $num <= $footer_columns; $num++) {
                                if (!is_active_sidebar('footer-' . $num)) {
                                    continue;
                                }
                                print '<div class="' . esc_attr($footer_class[$num]) . '">';
                                dynamic_sidebar('footer-' . $num);
                                print '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="tp-footer-copyright-area p-relative">
        <div class="container">
            <div class="row">
                <div class="<?php echo (has_nav_menu('footer-menu')) ? 'col-md-12 col-lg-6' : 'col-xxl-12 text-center'; ?>">
                    <div class="tp-footer-copyright-inner">
                        <p><?php print agenshark_copyright_text(); ?></p>
                    </div>
                </div>
                <?php if (has_nav_menu('footer-menu')) : ?>
                    <div class="col-md-12 col-lg-6">
                        <div class="tp-footer-copyright-inner text-lg-end">
                            <?php agenshark_footer_menu(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->