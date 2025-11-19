<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function agenshark_widgets_init()
{
    /**
     * Sidebar sidebar
     */
    register_sidebar([
        'name'          => esc_html__('Blog Sidebar', 'agenshark'),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="tp-sidebar-widget mb-60 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="tp-sidebar-widget-head mb-35"><h3 class="tp-sidebar-widget-title">',
        'after_title'   => '</h3></div>',
    ]);

    $footer_widgets = get_theme_mod('footer_widget_number', 4);

    // footer default
    for ($num = 1; $num <= $footer_widgets; $num++) {
        register_sidebar([
            'name'          => sprintf(esc_html__('Footer %1$s', 'agenshark'), $num),
            'id'            => 'footer-' . $num,
            'description'   => sprintf(esc_html__('Footer column %1$s', 'agenshark'), $num),
            'before_widget' => '<div id="%1$s" class="tp-footer-widget default-footer-widget tp-footer-col-' . $num . ' mb-50 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="tp-footer-widget-title">',
            'after_title'   => '</h3>',
        ]);
    }
}
add_action('widgets_init', 'agenshark_widgets_init');
