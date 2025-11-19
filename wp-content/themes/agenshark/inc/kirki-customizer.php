<?php

/**
 * agenshark customizer
 *
 * @package agenshark
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Added Panels & Sections
 */
function agenshark_customizer_panels_sections($wp_customize)
{

    //Add panel
    $wp_customize->add_panel('agenshark_customizer', [
        'priority' => 10,
        'title'    => esc_html__('Agenshark Customizer', 'agenshark'),
    ]);

    /**
     * Customizer Section
     */
    $wp_customize->add_section('header_top_setting', [
        'title'       => esc_html__('Header Info Setting', 'agenshark'),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);

    $wp_customize->add_section('header_social', [
        'title'       => esc_html__('Header Social', 'agenshark'),
        'description' => '',
        'priority'    => 11,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);

    $wp_customize->add_section('section_header_logo', [
        'title'       => esc_html__('Header Setting', 'agenshark'),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);

    $wp_customize->add_section('blog_setting', [
        'title'       => esc_html__('Blog Setting', 'agenshark'),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);

    $wp_customize->add_section('header_side_setting', [
        'title'       => esc_html__('Side Info', 'agenshark'),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);

    $wp_customize->add_section('breadcrumb_setting', [
        'title'       => esc_html__('Breadcrumb Setting', 'agenshark'),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);

    $wp_customize->add_section('blog_setting', [
        'title'       => esc_html__('Blog Setting', 'agenshark'),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);

    $wp_customize->add_section('footer_setting', [
        'title'       => esc_html__('Footer Settings', 'agenshark'),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);

    $wp_customize->add_section('color_setting', [
        'title'       => esc_html__('Color Setting', 'agenshark'),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);

    $wp_customize->add_section('404_page', [
        'title'       => esc_html__('404 Page', 'agenshark'),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);

    $wp_customize->add_section('tutor_course_settings', [
        'title'       => esc_html__('Tutor Course Settings ', 'agenshark'),
        'description' => '',
        'priority'    => 19,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);

    $wp_customize->add_section('learndash_course_settings', [
        'title'       => esc_html__('Learndash Course Settings ', 'agenshark'),
        'description' => '',
        'priority'    => 20,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);

    $wp_customize->add_section('typo_setting', [
        'title'       => esc_html__('Typography Setting', 'agenshark'),
        'description' => '',
        'priority'    => 21,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);

    $wp_customize->add_section('slug_setting', [
        'title'       => esc_html__('Slug Settings', 'agenshark'),
        'description' => '',
        'priority'    => 22,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);
    $wp_customize->add_section('tutor_course_settings', [
        'title'       => esc_html__('Tutor Course Settings ', 'agenshark'),
        'description' => '',
        'priority'    => 23,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agenshark_customizer',
    ]);
}

add_action('customize_register', 'agenshark_customizer_panels_sections');

function _header_top_fields($fields)
{
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_topbar_switch',
        'label'    => esc_html__('Topbar Swicher', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_preloader',
        'label'    => esc_html__('Preloader On/Off', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];


    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_backtotop',
        'label'    => esc_html__('Back To Top On/Off', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_header_right',
        'label'    => esc_html__('Header Right On/Off', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_search',
        'label'    => esc_html__('Header Search On/Off', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_header_lang',
        'label'    => esc_html__('language On/Off', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    // phone
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_phone_num',
        'label'    => esc_html__('Phone Number', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('(629) 555-0129', 'agenshark'),
        'priority' => 10,
    ];

    // email
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_mail_id',
        'label'    => esc_html__('Email Address', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('info@example.com', 'agenshark'),
        'priority' => 10,
    ];

    // address
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_address',
        'label'    => esc_html__('Address', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('6391 Elgin St. Celina, 10299', 'agenshark'),
        'priority' => 10,
    ];

    // address url
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_address_url',
        'label'    => esc_html__('Address URL', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('https://www.google.com/maps/search/6391+Elgin+St,+Wilmington,+DE,+USA/@39.7298967,-75.5645038,13z/data=!3m1!4b1', 'agenshark'),
        'priority' => 10,
    ];

    // address 2
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_address_2_info',
        'label'    => esc_html__('Second Address', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('2972 Westheimer Rd. Santa Ana', 'agenshark'),
        'priority' => 10,
    ];

    // address 2 url text
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_address_url_2_info',
        'label'    => esc_html__('Second Address URL Text', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('Delaware 10299', 'agenshark'),
        'priority' => 10,
    ];

    // address url 2
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_address_url_2',
        'label'    => esc_html__('Second Address URL', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('#', 'agenshark'),
        'priority' => 10,
    ];

    // office day
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_office_day',
        'label'    => esc_html__('Office Day', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('Sunday - Friday:', 'agenshark'),
        'priority' => 10,
    ];

    // office time
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_office_time',
        'label'    => esc_html__('Office Time', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('9 am - 8 pm', 'agenshark'),
        'priority' => 10,
    ];

    // Hotline Text
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_hotline_text',
        'label'    => esc_html__('Hotline Text', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('Need help?', 'agenshark'),
        'priority' => 10,
    ];

    // Hotline Number
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_hotline_number',
        'label'    => esc_html__('Hotline Number', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('(808) 555-0111', 'agenshark'),
        'priority' => 10,
    ];

    // Hotline Text 2
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_hotline_text_2',
        'label'    => esc_html__('Hotline Text 2', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('Requesting A Call:', 'agenshark'),
        'priority' => 10,
    ];

    // Hotline Number 2
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_hotline_number_2',
        'label'    => esc_html__('Hotline Number 2', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('(629) 555-0129', 'agenshark'),
        'priority' => 10,
    ];

    // button
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_button_text',
        'label'    => esc_html__('Button Text', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('Get A Quote', 'agenshark'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'agenshark_header_right',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'link',
        'settings' => 'agenshark_button_link',
        'label'    => esc_html__('Button URL', 'agenshark'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('#', 'agenshark'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'agenshark_header_right',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];





    return $fields;
}
add_filter('kirki/fields', '_header_top_fields');

/*
Header Social
 */
function _header_social_fields($fields)
{
    // header section social
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_topbar_fb_url',
        'label'    => esc_html__('Facebook URL', 'agenshark'),
        'section'  => 'header_social',
        'default'  => esc_html__('#', 'agenshark'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_topbar_twitter_url',
        'label'    => esc_html__('Twitter URL', 'agenshark'),
        'section'  => 'header_social',
        'default'  => esc_html__('#', 'agenshark'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_topbar_linkedin_url',
        'label'    => esc_html__('Linkedin URL', 'agenshark'),
        'section'  => 'header_social',
        'default'  => esc_html__('#', 'agenshark'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_topbar_youtube_url',
        'label'    => esc_html__('Youtube URL', 'agenshark'),
        'section'  => 'header_social',
        'default'  => esc_html__('#', 'agenshark'),
        'priority' => 10,
    ];

    // Header 2
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_topbar_facebook_url_h2',
        'label'    => esc_html__('Facebook URL ( Header - 2 )', 'agenshark'),
        'section'  => 'header_social',
        'default'  => esc_html__('#', 'agenshark'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_topbar_instagram_url_h2',
        'label'    => esc_html__('Instagram URL ( Header - 2 ) ', 'agenshark'),
        'section'  => 'header_social',
        'default'  => esc_html__('#', 'agenshark'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_topbar_twitter_url_h2',
        'label'    => esc_html__('Twitter URL ( Header - 2 ) ', 'agenshark'),
        'section'  => 'header_social',
        'default'  => esc_html__('#', 'agenshark'),
        'priority' => 10,
    ];

    return $fields;
}
add_filter('kirki/fields', '_header_social_fields');

/*
Header Settings
 */
function _header_header_fields($fields)
{
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__('Select Header Style', 'agenshark'),
        'section'     => 'section_header_logo',
        'placeholder' => esc_html__('Select an option...', 'agenshark'),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'header-style-1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
            'header-style-2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
            'header-style-3'  => get_template_directory_uri() . '/inc/img/header/header-3.png',
            'header-style-4'  => get_template_directory_uri() . '/inc/img/header/header-4.png',
        ],
        'default'     => 'header-style-1',
    ];

    // $fields[] = [
    //     'type' => 'radio-image',
    //     'settings' => 'choose_default_header',
    //     'label' => esc_html__('Select Header Style', 'agenshark'),
    //     'section' => 'section_header_logo',
    //     'placeholder' => esc_html__('Select an option...', 'agenshark'),
    //     'priority' => 10,
    //     'multiple' => 1,
    //     'choices'     => [
    //         'header-style-1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
    //         'header-style-2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
    //         'header-style-3'  => get_template_directory_uri() . '/inc/img/header/header-3.png',
    //         'header-style-4'  => get_template_directory_uri() . '/inc/img/header/header-4.png',
    //         'agenshark-template-builder' => get_template_directory_uri() . '/inc/img/header/custom-header.png'
    //     ],
    //     'default'     => 'header-style-1',
    // ];

    // if (class_exists('TP_Core')) {
    //     $fields[] = [
    //         'type' => 'select',
    //         'settings' => 'header_custom_style',
    //         'label' => esc_html__('Select Header', 'agenshark'),
    //         'section' => 'section_header_logo',
    //         'default' => '4',
    //         'placeholder' => esc_html__('Select an option...', 'agenshark'),
    //         'priority' => 10,
    //         'multiple' => 1,
    //         'choices' => Kirki\Util\Helper::get_posts(
    //             array(
    //                 'posts_per_page' => 10,
    //                 'post_type' => 'agenshark-blocks'
    //             ),
    //         ),
    //         'active_callback' => [
    //             [
    //                 'setting' => 'choose_agenshark_header',
    //                 'operator' => '==',
    //                 'value' => 'agenshark-template-builder',
    //             ],
    //         ],
    //     ];
    // }

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__('Header Logo', 'agenshark'),
        'description' => esc_html__('Upload Your Logo.', 'agenshark'),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'seconday_logo',
        'label'       => esc_html__('Header Secondary Logo', 'agenshark'),
        'description' => esc_html__('Header Logo Black', 'agenshark'),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-2.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'preloader_logo',
        'label'       => esc_html__('Preloader Logo', 'agenshark'),
        'description' => esc_html__('Upload Preloader Logo.', 'agenshark'),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/favicon.png',
    ];

    return $fields;
}
add_filter('kirki/fields', '_header_header_fields');

/*
Header Side Info
 */
function _header_side_fields($fields)
{
    // side info settings
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_side_hide',
        'label'    => esc_html__('Side Info On/Off', 'agenshark'),
        'section'  => 'header_side_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'agenshark_side_logo',
        'label'       => esc_html__('Logo Side', 'agenshark'),
        'description' => esc_html__('Logo Side', 'agenshark'),
        'section'     => 'header_side_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];

    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'agenshark_extra_map_url',
        'label'    => esc_html__('Map URL', 'agenshark'),
        'section'  => 'header_side_setting',
        'default'  => esc_html__('https://www.google.com/maps/search/86+Road+Broklyn+Street,+600+New+York,+USA/@40.6897806,-74.0278086,12z/data=!3m1!4b1', 'agenshark'),
        'priority' => 10,
    ];

    // contact
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_contact_title',
        'label'    => esc_html__('Contact', 'agenshark'),
        'section'  => 'header_side_setting',
        'default'  => esc_html__('Contact', 'agenshark'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'agenshark_extra_address',
        'label'    => esc_html__('Office Address', 'agenshark'),
        'section'  => 'header_side_setting',
        'default'  => esc_html__('86 Road Broklyn Street, 600', 'agenshark'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'agenshark_extra_phone',
        'label'    => esc_html__('Phone Number', 'agenshark'),
        'section'  => 'header_side_setting',
        'default'  => esc_html__('+92 666 888 0000', 'agenshark'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'agenshark_extra_email',
        'label'    => esc_html__('Email ID', 'agenshark'),
        'section'  => 'header_side_setting',
        'default'  => esc_html__('Needhelp@company.com', 'agenshark'),
        'priority' => 10,
    ];

    return $fields;
}
add_filter('kirki/fields', '_header_side_fields');

/*
_header_page_title_fields
 */
function _header_page_title_fields($fields)
{
    // Breadcrumb Setting
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__('Breadcrumb Background Image', 'agenshark'),
        'description' => esc_html__('Breadcrumb Background Image', 'agenshark'),
        'section'     => 'breadcrumb_setting',
        'default'     => get_template_directory_uri() . '/assets/img/page-title/page-title.jpg',
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'agenshark_breadcrumb_bg_color',
        'label'       => __('Breadcrumb BG Color', 'agenshark'),
        'description' => esc_html__('This is a Breadcrumb bg color control.', 'agenshark'),
        'section'     => 'breadcrumb_setting',
        'default'     => '#215846',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_info_switch',
        'label'    => esc_html__('Breadcrumb Info switch', 'agenshark'),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    return $fields;
}
add_filter('kirki/fields', '_header_page_title_fields');

/*
Header Social
 */
function _header_blog_fields($fields)
{
    // Blog Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_blog_btn_switch',
        'label'    => esc_html__('Blog BTN On/Off', 'agenshark'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_blog_cat',
        'label'    => esc_html__('Blog Category Meta On/Off', 'agenshark'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_blog_author',
        'label'    => esc_html__('Blog Author Meta On/Off', 'agenshark'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_blog_date',
        'label'    => esc_html__('Blog Date Meta On/Off', 'agenshark'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_blog_comments',
        'label'    => esc_html__('Blog Comments Meta On/Off', 'agenshark'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_blog_btn',
        'label'    => esc_html__('Blog Button text', 'agenshark'),
        'section'  => 'blog_setting',
        'default'  => esc_html__('Read More', 'agenshark'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__('Blog Title', 'agenshark'),
        'section'  => 'blog_setting',
        'default'  => esc_html__('Blog', 'agenshark'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__('Blog Details Title', 'agenshark'),
        'section'  => 'blog_setting',
        'default'  => esc_html__('Blog Details', 'agenshark'),
        'priority' => 10,
    ];
    return $fields;
}
add_filter('kirki/fields', '_header_blog_fields');

/*
Footer
 */
function _header_footer_fields($fields)
{
    // Footer Setting

    $fields[] = [
        'type' => 'radio-image',
        'settings' => 'choose_default_footer',
        'label' => esc_html__('Choose Footer Style', 'agenshark'),
        'section' => 'footer_setting',
        'default' => '5',
        'placeholder' => esc_html__('Select an option...', 'agenshark'),
        'priority' => 10,
        'multiple' => 1,
        'choices' => [
            'footer-style-1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
            'agenshark-template-builder' => get_template_directory_uri() . '/inc/img/footer/custom-footer.png'
        ],
        'default' => 'footer-style-1',
    ];

    if (class_exists('TP_Core')) {
        $fields[] = [
            'type' => 'select',
            'settings' => 'footer_custom_style',
            'label' => esc_html__('Select Footer', 'agenshark'),
            'section' => 'footer_setting',
            'default' => '4',
            'placeholder' => esc_html__('Select an option...', 'agenshark'),
            'priority' => 10,
            'multiple' => 1,
            'choices' => Kirki\Util\Helper::get_posts(
                array(
                    'posts_per_page' => 10,
                    'post_type' => 'agenshark-blocks'
                ),
            ),
            'active_callback' => [
                [
                    'setting' => 'choose_default_footer',
                    'operator' => '==',
                    'value' => 'agenshark-template-builder',
                ],
            ],

        ];
    }

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'footer_widget_number',
        'label'       => esc_html__('Widget Number', 'agenshark'),
        'section'     => 'footer_setting',
        'default'     => '4',
        'placeholder' => esc_html__('Select an option...', 'agenshark'),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            '4' => esc_html__('Widget Number 4', 'agenshark'),
            '3' => esc_html__('Widget Number 3', 'agenshark'),
            '2' => esc_html__('Widget Number 2', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_copyright',
        'label'    => esc_html__('Copy Right', 'agenshark'),
        'section'  => 'footer_setting',
        'default'  => esc_html__('© Agenshark 2023 | All Rights Reserved', 'agenshark'),
        'priority' => 10,
    ];
    return $fields;
}
add_filter('kirki/fields', '_header_footer_fields');

// 404
function agenshark_404_fields($fields)
{
    // 404 settings
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'agenshark_404_bg',
        'label'       => esc_html__('404 Image.', 'agenshark'),
        'description' => esc_html__('404 Image.', 'agenshark'),
        'section'     => '404_page',
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_error_title',
        'label'    => esc_html__('Not Found Title', 'agenshark'),
        'section'  => '404_page',
        'default'  => esc_html__('Page not found', 'agenshark'),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'agenshark_error_desc',
        'label'    => esc_html__('404 Description Text', 'agenshark'),
        'section'  => '404_page',
        'default'  => esc_html__('Oops! The page you are looking for does not exist. It might have been moved or deleted', 'agenshark'),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_error_link_text',
        'label'    => esc_html__('404 Link Text', 'agenshark'),
        'section'  => '404_page',
        'default'  => esc_html__('Back To Home', 'agenshark'),
        'priority' => 10,
    ];
    return $fields;
}
add_filter('kirki/fields', 'agenshark_404_fields');

// course_settings
function agenshark_learndash_fields($fields)
{

    $fields[] = [
        'type'     => 'number',
        'settings' => 'agenshark_learndash_post_number',
        'label'    => esc_html__('Learndash Post Per page', 'agenshark'),
        'section'  => 'learndash_course_settings',
        'default'  => 6,
        'priority' => 10,
    ];

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'agenshark_learndash_order',
        'label'       => esc_html__('Post Order', 'agenshark'),
        'section'     => 'learndash_course_settings',
        'default'     => 'DESC',
        'placeholder' => esc_html__('Select an option...', 'agenshark'),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'ASC' => esc_html__('ASC', 'agenshark'),
            'DESC' => esc_html__('DESC', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_learndash_related',
        'label'    => esc_html__('Show Related?', 'agenshark'),
        'section'  => 'learndash_course_settings',
        'default'  => 1,
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    return $fields;
}

if (class_exists('SFWD_LMS')) {
    add_filter('kirki/fields', 'agenshark_learndash_fields');
}


// tutor_course_settings
function agenshark_tutor_course_fields($fields)
{
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_tutor_course_details_author_meta_switch',
        'label'    => esc_html__('Tutor Course Details Author Meta', 'agenshark'),
        'section'  => 'tutor_course_settings',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_tutor_course_details_payment_switch',
        'label'    => esc_html__('Tutor Course Details Payment', 'agenshark'),
        'section'  => 'tutor_course_settings',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_tutor_course_desc_tab_switch',
        'label'    => esc_html__('Tutor Course Description Tab Swicher', 'agenshark'),
        'section'  => 'tutor_course_settings',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_tutor_course_curriculum_tab_switch',
        'label'    => esc_html__('Tutor Course Curriculum Tab Swicher', 'agenshark'),
        'section'  => 'tutor_course_settings',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_tutor_course_reviews_tab_switch',
        'label'    => esc_html__('Tutor Course Reviews Tab Swicher', 'agenshark'),
        'section'  => 'tutor_course_settings',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agenshark_tutor_course_instructor_tab_switch',
        'label'    => esc_html__('Tutor Course Instructor Tab Swicher', 'agenshark'),
        'section'  => 'tutor_course_settings',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'agenshark'),
            'off' => esc_html__('Disable', 'agenshark'),
        ],
    ];
    return $fields;
}

if (function_exists('tutor')) {
    add_filter('kirki/fields', 'agenshark_tutor_course_fields');
}


/**
 * Added Fields
 */
function agenshark_typo_fields($fields)
{
    // typography settings
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_body_setting',
        'label'       => esc_html__('Body Font', 'agenshark'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h_setting',
        'label'       => esc_html__('Heading h1 Fonts', 'agenshark'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h1',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h2_setting',
        'label'       => esc_html__('Heading h2 Fonts', 'agenshark'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h2',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h3_setting',
        'label'       => esc_html__('Heading h3 Fonts', 'agenshark'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h3',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h4_setting',
        'label'       => esc_html__('Heading h4 Fonts', 'agenshark'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h4',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h5_setting',
        'label'       => esc_html__('Heading h5 Fonts', 'agenshark'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h5',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h6_setting',
        'label'       => esc_html__('Heading h6 Fonts', 'agenshark'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h6',
            ],
        ],
    ];
    return $fields;
}

add_filter('kirki/fields', 'agenshark_typo_fields');


/**
 * Added Fields
 */
function agenshark_slug_setting($fields)
{
    // slug settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_ev_slug',
        'label'    => esc_html__('Event Slug', 'agenshark'),
        'section'  => 'slug_setting',
        'default'  => esc_html__('ourevent', 'agenshark'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agenshark_port_slug',
        'label'    => esc_html__('Portfolio Slug', 'agenshark'),
        'section'  => 'slug_setting',
        'default'  => esc_html__('ourportfolio', 'agenshark'),
        'priority' => 10,
    ];

    return $fields;
}

add_filter('kirki/fields', 'agenshark_slug_setting');


/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function agenshark_THEME_option($name)
{
    $value = '';
    if (class_exists('agenshark')) {
        $value = Kirki::get_option(agenshark_get_theme(), $name);
    }

    return apply_filters('agenshark_THEME_option', $value, $name);
}

/**
 * Get config ID
 *
 * @return string
 */
function agenshark_get_theme()
{
    return 'agenshark';
}
