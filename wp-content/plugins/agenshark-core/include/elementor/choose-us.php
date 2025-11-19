<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Choose_Us extends Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'choose-us';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Choose Us', 'tpcore');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'tp-icon';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['tpcore'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the title widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['Choose Us'];
    }


    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['tpcore'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {

        // design layout
        $this->start_controls_section(
            'tp_choose_us_design_layout_section',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_choose_us_design_layout',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // content section
        $this->start_controls_section(
            'tp_choose_us_content_section',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_choose_us_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Sub Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your sub title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2', 'layout-3']
                ]
            ]
        );

        $this->add_control(
            'tp_choose_us_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2', 'layout-3']
                ]
            ]
        );

        $this->add_control(
            'tp_choose_us_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2', 'layout-3']
                ]
            ]
        );

        $this->add_control(
            'tp_choose_us_link_switcher',
            [
                'label' => esc_html__('Button Switch', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_choose_us_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_choose_us_link_switcher' => 'yes',
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2']
                ],
            ]
        );

        $this->add_control(
            'tp_choose_us_link_type',
            [
                'label' => esc_html__('Button URL Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom URL',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_choose_us_link_switcher' => 'yes',
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_choose_us_link',
            [
                'label' => esc_html__('Custom URL', 'tpcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_choose_us_link_type' => '1',
                    'tp_choose_us_link_switcher' => 'yes',
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_choose_us_page_link',
            [
                'label' => esc_html__('Internal Page Link', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_choose_us_link_type' => '2',
                    'tp_choose_us_link_switcher' => 'yes',
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        // thhumb - 1
        $this->add_control(
            'tp_choose_us_thumb_1',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2', 'layout-3']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_choose_us_thumb_1',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
                'condition' => [
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2', 'layout-3']
                ]
            ]
        );

        // thhumb - 2
        $this->add_control(
            'tp_choose_us_thumb_2',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2', 'layout-3']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_choose_us_thumb_2',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
                'condition' => [
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2', 'layout-3']
                ]
            ]
        );

        // thhumb - 3
        $this->add_control(
            'tp_choose_us_thumb_3',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_choose_us_thumb_3',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
                'condition' => [
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->end_controls_section();


        // choose us repeater 
        $this->start_controls_section(
            'tp_choose_us_repeater_content_section',
            [
                'label' => esc_html__('Features Repeater ', 'tpcore'),
                'condition' => [
                    'tp_choose_us_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control(
            'tp_choose_us_features',
            [
                'label' => esc_html__('Features', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Text Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_choose_us_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_choose_us_features' => esc_html__('Technology Solutions', 'tpcore'),
                    ],
                    [
                        'tp_choose_us_features' => esc_html__('Consulting and Strategy', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_choose_us_features }}}',
            ]
        );

        $this->end_controls_section();

        // choose us repeater 
        $this->start_controls_section(
            'tp_choose_us_repeater_content_section_2',
            [
                'label' => esc_html__('Features Repeater - 2 ', 'tpcore'),
                'condition' => [
                    'tp_choose_us_design_layout' => ['layout-2']
                ]
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control(
            'tp_choose_us_features_2',
            [
                'label' => esc_html__('Features', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Text Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_choose_us_list_2',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_choose_us_features_2' => esc_html__('Technology Solutions', 'tpcore'),
                    ],
                    [
                        'tp_choose_us_features_2' => esc_html__('Consulting and Strategy', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_choose_us_features_2 }}}',
            ]
        );

        $this->end_controls_section();



        // choose us list 
        $this->start_controls_section(
            'tp_choose_us_list_content_section',
            [
                'label' => esc_html__('Repeater', 'tpcore'),
                'condition' => [
                    'tp_choose_us_design_layout' => ['layout-3']
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_choose_us_list_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_choose_us_list_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_list_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                ],
            ]
        );

        $repeater->add_control(
            'tp_list_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_list_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_list_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_list_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_list_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_list_icon_type' => 'icon'
                    ]
                ]
            );
        } // end icon


        $repeater->add_control(
            'tp_choose_us_list_animation_delay',
            [
                'label' => esc_html__('Animation Delay', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('200', 'tpcore'),
                'placeholder' => esc_html__('Enter animation delay', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_choose_us_list_animation_duration',
            [
                'label' => esc_html__('Animation Duration', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('1500', 'tpcore'),
                'placeholder' => esc_html__('Enter animation duration', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_choose_us_item_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_choose_us_list_title' => esc_html__('First Working Process', 'tpcore'),
                    ],
                    [
                        'tp_choose_us_list_title' => esc_html__('Dedicated Expert Team', 'tpcore')
                    ],
                    [
                        'tp_choose_us_list_title' => esc_html__('24/7 Customer Support', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_choose_us_list_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>
        <?php if ($settings['tp_choose_us_design_layout']  == 'layout-3') :

            // thumb - 1 
            if (!empty($settings['tp_choose_us_thumb_1']['url'])) {
                $tp_choose_us_thumb_1_url = !empty($settings['tp_choose_us_thumb_1']['id']) ? wp_get_attachment_image_url($settings['tp_choose_us_thumb_1']['id'], $settings['tp_choose_us_thumb_1_size']) : $settings['tp_choose_us_thumb_1']['url'];
                $tp_choose_us_thumb_1_alt = get_post_meta($settings["tp_choose_us_thumb_1"]["id"], "_wp_attachment_image_alt", true);
            }

            // thumb - 2 
            if (!empty($settings['tp_choose_us_thumb_2']['url'])) {
                $tp_choose_us_thumb_2_url = !empty($settings['tp_choose_us_thumb_2']['id']) ? wp_get_attachment_image_url($settings['tp_choose_us_thumb_2']['id'], $settings['tp_choose_us_thumb_2_size']) : $settings['tp_choose_us_thumb_2']['url'];
                $tp_choose_us_thumb_2_alt = get_post_meta($settings["tp_choose_us_thumb_2"]["id"], "_wp_attachment_image_alt", true);
            }


        ?>


            <section class="about-area pt-120 pb-120">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-6">
                            <div class="about__image">
                                <img class="w-100" src="<?php echo esc_url($tp_choose_us_thumb_1_url); ?>" alt="<?php echo esc_attr($tp_choose_us_thumb_1_alt); ?>">
                                <img class="about-line" src=" <?php echo get_template_directory_uri(); ?>/assets/img/shape/about-three-shape.png" alt="shape">
                                <img class="about-kit" src="<?php echo esc_url($tp_choose_us_thumb_2_url); ?>" alt="<?php echo esc_attr($tp_choose_us_thumb_2_alt); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about__item-right">
                                <div class="section-header">
                                    <?php if (!empty($settings['tp_choose_us_sub_title'])) : ?>
                                        <h5 class="wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_choose_us_sub_title']) ?> </h5>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['tp_choose_us_title'])) : ?>
                                        <h2 class="fw-600 wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_choose_us_title']) ?> </h2>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['tp_choose_us_description'])) : ?>
                                        <p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_choose_us_description']) ?> </p>
                                    <?php endif; ?>
                                </div>
                                <ul class="mt-40">
                                    <?php foreach ($settings['tp_choose_us_item_list'] as $key => $item) : ?>
                                        <li class="d-flex align-items-center wow bounceInUp gap-4" data-wow-delay="<?php echo $item['tp_choose_us_list_animation_delay']?>ms" data-wow-duration="<?php echo $item['tp_choose_us_list_animation_duration']?>ms">
                                            <div class="icon bg<?php echo $key+1;?>">
                                                <?php if ($item['tp_list_icon_type'] !== 'image') : ?>
                                                    <?php if (!empty($item['tp_list_icon']) || !empty($item['tp_list_selected_icon']['value'])) : ?>
                                                        <?php tp_render_icon($item, 'tp_list_icon', 'tp_list_selected_icon'); ?>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <?php if (!empty($item['tp_list_image']['url'])) : ?>
                                                        <img src="<?php echo $item['tp_list_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_list_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <h3> <?php echo $item['tp_choose_us_list_title'];?>  </h3>
                                                <p> <?php echo $item['tp_choose_us_list_description'];?> </p>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        <?php elseif ($settings['tp_choose_us_design_layout']  == 'layout-2') :

            // btn 
            if ('2' == $settings['tp_choose_us_link_type']) {
                $link = get_permalink($settings['tp_choose_us_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_choose_us_link']['url']) ? $settings['tp_choose_us_link']['url'] : '';
                $target = !empty($settings['tp_choose_us_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_choose_us_link']['nofollow']) ? 'nofollow' : '';
            }

            // thumb - 1 
            if (!empty($settings['tp_choose_us_thumb_1']['url'])) {
                $tp_choose_us_thumb_1_url = !empty($settings['tp_choose_us_thumb_1']['id']) ? wp_get_attachment_image_url($settings['tp_choose_us_thumb_1']['id'], $settings['tp_choose_us_thumb_1_size']) : $settings['tp_choose_us_thumb_1']['url'];
                $tp_choose_us_thumb_1_alt = get_post_meta($settings["tp_choose_us_thumb_1"]["id"], "_wp_attachment_image_alt", true);
            }

            // thumb - 2 
            if (!empty($settings['tp_choose_us_thumb_2']['url'])) {
                $tp_choose_us_thumb_2_url = !empty($settings['tp_choose_us_thumb_2']['id']) ? wp_get_attachment_image_url($settings['tp_choose_us_thumb_2']['id'], $settings['tp_choose_us_thumb_2_size']) : $settings['tp_choose_us_thumb_2']['url'];
                $tp_choose_us_thumb_2_alt = get_post_meta($settings["tp_choose_us_thumb_2"]["id"], "_wp_attachment_image_alt", true);
            }

            // thumb - 3 
            if (!empty($settings['tp_choose_us_thumb_3']['url'])) {
                $tp_choose_us_thumb_3_url = !empty($settings['tp_choose_us_thumb_3']['id']) ? wp_get_attachment_image_url($settings['tp_choose_us_thumb_3']['id'], $settings['tp_choose_us_thumb_3_size']) : $settings['tp_choose_us_thumb_3']['url'];
                $tp_choose_us_thumb_3_alt = get_post_meta($settings["tp_choose_us_thumb_3"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>

            <section class="grow-area sub-bg pt-120 pb-120">
                <div class="container">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6 wow bounceInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
                            <div class="grow__image">
                                <div class="row g-2 g-sm-4">
                                    <div class="col-7">
                                        <div class="image">
                                            <img src="<?php echo esc_url($tp_choose_us_thumb_1_url); ?>" alt="<?php echo esc_attr($tp_choose_us_thumb_1_alt); ?>">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="image">
                                            <img src="<?php echo esc_url($tp_choose_us_thumb_2_url); ?>" alt="<?php echo esc_attr($tp_choose_us_thumb_2_alt); ?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="image">
                                            <img src="<?php echo esc_url($tp_choose_us_thumb_3_url); ?>" alt="<?php echo esc_attr($tp_choose_us_thumb_3_alt); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="grow__item-left">
                                <div class="section-header mb-30">
                                    <?php if (!empty($settings['tp_choose_us_title'])) : ?>
                                        <h2 class="fw-600 wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_choose_us_title']) ?> </h2>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['tp_choose_us_description'])) : ?>
                                        <p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_choose_us_description']) ?> </p>
                                    <?php endif; ?>
                                </div>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <ul>
                                            <?php foreach ($settings['tp_choose_us_list'] as $key => $item) : ?>
                                                <li class="mb-15"><i class="fa-regular fa-check"></i> <?php echo $item['tp_choose_us_features'] ?> </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul>
                                            <?php foreach ($settings['tp_choose_us_list_2'] as $key => $item) : ?>
                                                <li class="mb-15"><i class="fa-regular fa-check"></i> <?php echo $item['tp_choose_us_features_2'] ?> </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php if (!empty($settings['tp_choose_us_link_switcher'])) : ?>
                                    <a href="<?php echo esc_url($link); ?>" class="btn-three mt-45"> <?php echo tp_kses($settings['tp_choose_us_btn_text']); ?> <i class="fa-regular fa-arrow-right"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        <?php else :

            // btn 
            if ('2' == $settings['tp_choose_us_link_type']) {
                $link = get_permalink($settings['tp_choose_us_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_choose_us_link']['url']) ? $settings['tp_choose_us_link']['url'] : '';
                $target = !empty($settings['tp_choose_us_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_choose_us_link']['nofollow']) ? 'nofollow' : '';
            }

            // thumb - 1 
            if (!empty($settings['tp_choose_us_thumb_1']['url'])) {
                $tp_choose_us_thumb_1_url = !empty($settings['tp_choose_us_thumb_1']['id']) ? wp_get_attachment_image_url($settings['tp_choose_us_thumb_1']['id'], $settings['tp_choose_us_thumb_1_size']) : $settings['tp_choose_us_thumb_1']['url'];
                $tp_choose_us_thumb_1_alt = get_post_meta($settings["tp_choose_us_thumb_1"]["id"], "_wp_attachment_image_alt", true);
            }

            // thumb - 2 
            if (!empty($settings['tp_choose_us_thumb_2']['url'])) {
                $tp_choose_us_thumb_2_url = !empty($settings['tp_choose_us_thumb_2']['id']) ? wp_get_attachment_image_url($settings['tp_choose_us_thumb_2']['id'], $settings['tp_choose_us_thumb_2_size']) : $settings['tp_choose_us_thumb_2']['url'];
                $tp_choose_us_thumb_2_alt = get_post_meta($settings["tp_choose_us_thumb_2"]["id"], "_wp_attachment_image_alt", true);
            }

            // thumb - 3 
            if (!empty($settings['tp_choose_us_thumb_3']['url'])) {
                $tp_choose_us_thumb_3_url = !empty($settings['tp_choose_us_thumb_3']['id']) ? wp_get_attachment_image_url($settings['tp_choose_us_thumb_3']['id'], $settings['tp_choose_us_thumb_3_size']) : $settings['tp_choose_us_thumb_3']['url'];
                $tp_choose_us_thumb_3_alt = get_post_meta($settings["tp_choose_us_thumb_3"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>
            <section class="choose-area sub-bg pt-120 pb-120">
                <div class="container">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6">
                            <div class="choose__item-left">
                                <div class="section-header mb-30">
                                    <?php if (!empty($settings['tp_choose_us_title'])) : ?>
                                        <h2 class="fw-600 wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_choose_us_title']) ?> </h2>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['tp_choose_us_description'])) : ?>
                                        <p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_choose_us_description']) ?> </p>
                                    <?php endif; ?>
                                </div>
                                <ul class="wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                                    <?php foreach ($settings['tp_choose_us_list'] as $key => $item) : ?>
                                        <li class="mb-15"><span></span> <?php echo $item['tp_choose_us_features'] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php if (!empty($settings['tp_choose_us_link_switcher'])) : ?>
                                    <a href="<?php echo esc_url($link); ?>" class="btn-three wow fadeInUp mt-45" data-wow-delay="700ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_choose_us_btn_text']); ?> <i class="fa-regular fa-arrow-right"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 wow bounceInRight" data-wow-delay="400ms" data-wow-duration="1500ms">
                            <div class="choose__image">
                                <div class="row g-2 g-sm-4">
                                    <div class="col-6">
                                        <div class="image">
                                            <img src="<?php echo esc_url($tp_choose_us_thumb_1_url); ?>" alt="<?php echo esc_attr($tp_choose_us_thumb_1_alt); ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="image">
                                            <img src="<?php echo esc_url($tp_choose_us_thumb_2_url); ?>" alt="<?php echo esc_attr($tp_choose_us_thumb_2_alt); ?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="image">
                                            <img src="<?php echo esc_url($tp_choose_us_thumb_3_url); ?>" alt="<?php echo esc_attr($tp_choose_us_thumb_3_alt); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Choose_Us());
