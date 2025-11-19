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
class TP_Testimonial extends Widget_Base
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
        return 'testimonial';
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
        return __('Testimonial', 'tpcore');
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
        return ['testimonial', 'feedback'];
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
            'tp_testimonial_design_layout_section',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_testimonial_design_layout',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                    'layout-4' => esc_html__('Layout 4', 'tpcore'),
                    'layout-5' => esc_html__('Layout 5', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // content section
        $this->start_controls_section(
            'tp_testimonial_content_section',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_testimonial_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Sub Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your sub title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-3', 'layout-4', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_testimonial_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_testimonial_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_testimonial_review_number',
            [
                'label' => esc_html__('Reviews Number', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('10', 'tpcore'),
                'placeholder' => esc_html__('Enter your number', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-4', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_testimonial_review_title',
            [
                'label' => esc_html__('Reviews Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('verified reviews on Clutch', 'tpcore'),
                'placeholder' => esc_html__('Enter your number', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-4', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_testimonial_review_rating',
            [
                'label' => esc_html__('Reviews Rating', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('5.0', 'tpcore'),
                'placeholder' => esc_html__('Enter your text here', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-4', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_testimonial_review__rating_title',
            [
                'label' => esc_html__('Reviews Rating Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Average rating on Clutch', 'tpcore'),
                'placeholder' => esc_html__('Enter your text here', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-4', 'layout-5']
                ]
            ]
        );

        $this->end_controls_section();


        // testimonial repeater 
        $this->start_controls_section(
            'tp_testimonial_repeater_content_section',
            [
                'label' => esc_html__('Award ', 'tpcore'),
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_testimonial_award_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_testimonial_award_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-1']
                ]
            ]
        );


        $repeater = new Repeater();

        $repeater->add_control(
            'tp_testimonial_award_thumb',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_testimonial_award_thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'tp_testimonial_award_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();


        // testimonial quotation repeater 
        $this->start_controls_section(
            'tp_testimonial_quotation_content_section',
            [
                'label' => esc_html__('Quotation ', 'tpcore'),
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4']
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_testimonial_quotation_title',
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
            'tp_testimonial_quotation_description',
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
            'tp_testimonial_quotation_client_name',
            [
                'label' => esc_html__('Name', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Name Here', 'tpcore'),
                'placeholder' => esc_html__('Enter name', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_testimonial_quotation_client_designation',
            [
                'label' => esc_html__('Designation', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Designation Here', 'tpcore'),
                'placeholder' => esc_html__('Enter designation', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_testimonial_quotation_client_thumb',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_testimonial_quotation_client_thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'tp_testimonial_quotation_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_testimonial_quotation_client_name' => esc_html__('Kawser Ahmed', 'tpcore'),
                    ],
                    [
                        'tp_testimonial_quotation_client_name' => esc_html__('Mahadi Hassan', 'tpcore')
                    ],
                    [
                        'tp_testimonial_quotation_client_name' => esc_html__('Moeen Khan', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_testimonial_quotation_client_name }}}',
            ]
        );

        $this->end_controls_section();

        // testimonial 5 quotation repeater 
        $this->start_controls_section(
            'tp_testimonial_quotation_content_section_v_5',
            [
                'label' => esc_html__('Quotation ', 'tpcore'),
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-5']
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_testimonial_quotation_title_v_5',
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
            'tp_testimonial_quotation_description_v_5',
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
            'tp_testimonial_quotation_client_name_v_5',
            [
                'label' => esc_html__('Name', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Name Here', 'tpcore'),
                'placeholder' => esc_html__('Enter name', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_testimonial_quotation_client_designation_v_5',
            [
                'label' => esc_html__('Designation', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Designation Here', 'tpcore'),
                'placeholder' => esc_html__('Enter designation', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_testimonial_quotation_client_thumb_v_5',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_testimonial_quotation_client_thumb_v_5',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'tp_testimonial_quotation_list_v_5',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_testimonial_quotation_client_name_v_5' => esc_html__('Kawser Ahmed', 'tpcore'),
                    ],
                    [
                        'tp_testimonial_quotation_client_name_v_5' => esc_html__('Mahadi Hassan', 'tpcore')
                    ],
                    [
                        'tp_testimonial_quotation_client_name_v_5' => esc_html__('Moeen Khan', 'tpcore')
                    ],
                    [
                        'tp_testimonial_quotation_client_name_v_5' => esc_html__('Moeen Khan', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_testimonial_quotation_client_name_v_5 }}}',
            ]
        );

        $this->end_controls_section();

    
        // testimonial award thumb
        $this->start_controls_section(
            'tp_testimonial_award_content_section',
            [
                'label' => esc_html__('Award Thumbnail ', 'tpcore'),
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-4', 'layout-5']
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_testimonial_award_thumb',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_testimonial_award_thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'tp_testimonial_award_thumb_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();


        // testimonial card
        $this->start_controls_section(
            'tp_testimonial_card_content_section',
            [
                'label' => esc_html__('Card ', 'tpcore'),
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_testimonial_card_bg_thumb',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_testimonial_card_bg_thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'tp_testimonial_card_logo',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_testimonial_card_logo',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'tp_testimonial_card_review',
            [
                'label' => esc_html__('Card Review', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Review Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your review', 'tpcore'),
                'label_block' => true,
            ]
        );

        // btn one
        $this->add_control(
            'tp_testimonial_card_link_switcher',
            [
                'label' => esc_html__('Button Switch', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'tp_testimonial_design_layout' => ['layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_testimonial_card_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_testimonial_card_link_switcher' => 'yes',
                    'tp_testimonial_design_layout' => ['layout-4']
                ],
            ]
        );

        $this->add_control(
            'tp_testimonial_card_link_type',
            [
                'label' => esc_html__('Button URL Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom URL',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_testimonial_card_link_switcher' => 'yes',
                    'tp_testimonial_design_layout' => ['layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_testimonial_card_link',
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
                    'tp_testimonial_card_link_type' => '1',
                    'tp_testimonial_card_link_switcher' => 'yes',
                    'tp_testimonial_design_layout' => ['layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_testimonial_card_page_link',
            [
                'label' => esc_html__('Internal Page Link', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_testimonial_card_link_type' => '2',
                    'tp_testimonial_card_link_switcher' => 'yes',
                    'tp_testimonial_design_layout' => ['layout-4']
                ]
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

        <?php if ($settings['tp_testimonial_design_layout']  == 'layout-5') :

            // card bg thumb
            if (!empty($settings['tp_testimonial_card_bg_thumb']['url'])) {
                $tp_testimonial_card_bg_thumb_url = !empty($settings['tp_testimonial_card_bg_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_testimonial_card_bg_thumb']['id'], $settings['tp_testimonial_card_bg_thumb_size']) : $settings['tp_testimonial_card_bg_thumb']['url'];
                $tp_testimonial_card_bg_thumb_alt = get_post_meta($settings["tp_testimonial_card_bg_thumb"]["id"], "_wp_attachment_image_alt", true);
            }

            // card logo
            if (!empty($settings['tp_testimonial_card_logo']['url'])) {
                $tp_testimonial_card_logo_url = !empty($settings['tp_testimonial_card_logo']['id']) ? wp_get_attachment_image_url($settings['tp_testimonial_card_logo']['id'], $settings['tp_testimonial_card_logo_size']) : $settings['tp_testimonial_card_logo']['url'];
                $tp_testimonial_card_logo_alt = get_post_meta($settings["tp_testimonial_card_logo"]["id"], "_wp_attachment_image_alt", true);
            }

            // btn 
            if ('2' == $settings['tp_testimonial_card_link_type']) {
                $link = get_permalink($settings['tp_testimonial_card_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_testimonial_card_link']['url']) ? $settings['tp_testimonial_card_link']['url'] : '';
                $target = !empty($settings['tp_testimonial_card_link']['is_external']) ? '_blank' : '';
                $rel  = !empty($settings['tp_testimonial_card_link']['nofollow']) ? 'nofollow' : '';
            }


        ?>

            <section class="testimonial-four-area pt-120 pb-120">
                <div class="container">
                    <div class="d-flex flex-wrap mb-80 justify-content-between align-items-end gap-3">
                        <div class="section-header-inner">
                            <?php if (!empty($settings['tp_testimonial_sub_title'])) : ?>
                                <h5><span class="title-dot"></span> <?php echo tp_kses($settings['tp_testimonial_sub_title']) ?> </h5>
                            <?php endif; ?>
                            <?php if (!empty($settings['tp_testimonial_title'])) : ?>
                                <h2><?php echo tp_kses($settings['tp_testimonial_title']) ?></h2>
                            <?php endif; ?>

                        </div>
                        <?php if (!empty($settings['tp_testimonial_description'])) : ?>
                            <p> <?php echo tp_kses($settings['tp_testimonial_description']) ?>
                            <p>
                            <?php endif; ?>
                    </div>
                    <div class="testimonial-four__info mb-80">
                        <div class="testi-conter-wrp">
                            <div class="testi-conter">
                                <?php if (!empty($settings['tp_testimonial_review_number'])) : ?>
                                    <h3><span class="count"> <?php echo tp_kses($settings['tp_testimonial_review_number']) ?> </span>+</h3>
                                <?php endif; ?>
                                <?php if (!empty($settings['tp_testimonial_review_title'])) : ?>
                                    <span class="fs-18"> <?php echo tp_kses($settings['tp_testimonial_review_title']) ?> </span>
                                <?php endif; ?>
                            </div>
                            <div class="line"></div>
                            <div class="testi-conter">
                                <?php if (!empty($settings['tp_testimonial_review_rating'])) : ?>
                                    <h3><span class="count"><?php echo tp_kses($settings['tp_testimonial_review_rating']) ?> </span>+</h3>
                                <?php endif; ?>
                                <?php if (!empty($settings['tp_testimonial_review__rating_title'])) : ?>
                                    <span class="fs-18"><?php echo tp_kses($settings['tp_testimonial_review__rating_title']) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="testi-brand d-flex gap-4">
                            <?php foreach ($settings['tp_testimonial_award_thumb_list'] as $key => $item) :
                                if (!empty($item['tp_testimonial_award_thumb']['url'])) {
                                    $tp_testimonial_award_thumb_url = !empty($item['tp_testimonial_award_thumb']['id']) ? wp_get_attachment_image_url($item['tp_testimonial_award_thumb']['id'], $item['tp_testimonial_award_thumb_size']) : $item['tp_testimonial_award_thumb']['url'];
                                    $tp_testimonial_award_thumb_alt = get_post_meta($item["tp_testimonial_award_thumb"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                                <img src="<?php echo esc_url($tp_testimonial_award_thumb_url); ?>" alt="<?php echo esc_url($tp_testimonial_award_thumb_alt); ?>">
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="swiper testimonial-two__slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['tp_testimonial_quotation_list_v_5'] as $key => $item) :
                            if (!empty($item['tp_testimonial_quotation_client_thumb_v_5']['url'])) {
                                $tp_testimonial_quotation_client_thumb_v_5_url = !empty($item['tp_testimonial_quotation_client_thumb_v_5']['id']) ? wp_get_attachment_image_url($item['tp_testimonial_quotation_client_thumb_v_5']['id'], $item['tp_testimonial_quotation_client_thumb_v_5_size']) : $item['tp_testimonial_quotation_client_thumb_v_5']['url'];
                                $tp_testimonial_quotation_client_thumb_v_5_alt = get_post_meta($item["tp_testimonial_quotation_client_thumb_v_5"]["id"], "_wp_attachment_image_alt", true);
                            }
                        ?>
                            <div class="swiper-slide">
                                <div class="testimonial-two__item <?php echo ($key % 2 == 0) ? '' : 'mt-80'; ?>">
                                    <svg class="coma" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.89997 28.8599C8.91 31.3499 7.35003 33.8099 5.26501 36.18C4.60501 36.93 4.51501 38.0099 5.055 38.8499C5.47504 39.5099 6.16498 39.8699 6.91498 39.8699C7.125 39.8699 7.33503 39.855 7.54504 39.7799C11.955 38.4899 22.26 33.9149 22.545 19.2449C22.65 13.59 18.51 8.72998 13.125 8.17498C10.14 7.87496 7.17004 8.8499 4.965 10.8299C2.76004 12.8249 1.5 15.675 1.5 18.6449C1.5 23.5949 5.01004 27.93 9.89997 28.8599Z" fill="#256E56" />
                                        <path d="M37.0652 8.17498C34.0951 7.87496 31.1251 8.8499 28.9202 10.8299C26.7151 12.8249 25.4551 15.675 25.4551 18.6449C25.4551 23.5949 28.9651 27.9299 33.8551 28.8599C32.8651 31.3499 31.3051 33.8099 29.2201 36.1799C28.5601 36.9299 28.4701 38.0099 29.0102 38.8499C29.4301 39.5099 30.1202 39.8699 30.8702 39.8699C31.0801 39.8699 31.2901 39.855 31.5001 39.7799C35.9101 38.4899 46.2151 33.9149 46.5001 19.2449V19.035C46.5001 13.4699 42.4052 8.72998 37.0652 8.17498Z" fill="#256E56" />
                                    </svg>
                                    <div class="star d-flex gap-2 mb-2">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <h5 class="mb-10"> <?php echo tp_kses($item['tp_testimonial_quotation_title_v_5']) ?> </h5>
                                    <p> <?php echo tp_kses($item['tp_testimonial_quotation_description_v_5']) ?> </p>
                                    <div class="d-flex align-items-center gap-3 mt-30">

                                        <img src="<?php echo esc_url($tp_testimonial_quotation_client_thumb_v_5_url); ?>" alt="<?php echo esc_url($tp_testimonial_quotation_client_thumb_v_5_alt); ?>">
                                        <div>
                                            <h5> <?php echo tp_kses($item['tp_testimonial_quotation_client_name_v_5']) ?> </h5>
                                            <span> <?php echo tp_kses($item['tp_testimonial_quotation_client_designation_v_5']) ?> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="mt-60">
                        <div class="swiper-two__info">
                            <button class="testimonial-two__arry-prev active"><i class="fa-regular fa-arrow-left"></i></button>
                            <div class="dot testimonial-two__dot"></div>
                            <button class="testimonial-two__arry-next active"><i class="fa-regular fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </section>


        <?php elseif ($settings['tp_testimonial_design_layout']  == 'layout-4') :

            // card bg thumb
            if (!empty($settings['tp_testimonial_card_bg_thumb']['url'])) {
                $tp_testimonial_card_bg_thumb_url = !empty($settings['tp_testimonial_card_bg_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_testimonial_card_bg_thumb']['id'], $settings['tp_testimonial_card_bg_thumb_size']) : $settings['tp_testimonial_card_bg_thumb']['url'];
                $tp_testimonial_card_bg_thumb_alt = get_post_meta($settings["tp_testimonial_card_bg_thumb"]["id"], "_wp_attachment_image_alt", true);
            }

            // card logo
            if (!empty($settings['tp_testimonial_card_logo']['url'])) {
                $tp_testimonial_card_logo_url = !empty($settings['tp_testimonial_card_logo']['id']) ? wp_get_attachment_image_url($settings['tp_testimonial_card_logo']['id'], $settings['tp_testimonial_card_logo_size']) : $settings['tp_testimonial_card_logo']['url'];
                $tp_testimonial_card_logo_alt = get_post_meta($settings["tp_testimonial_card_logo"]["id"], "_wp_attachment_image_alt", true);
            }

            // btn 
            if ('2' == $settings['tp_testimonial_card_link_type']) {
                $link = get_permalink($settings['tp_testimonial_card_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_testimonial_card_link']['url']) ? $settings['tp_testimonial_card_link']['url'] : '';
                $target = !empty($settings['tp_testimonial_card_link']['is_external']) ? '_blank' : '';
                $rel  = !empty($settings['tp_testimonial_card_link']['nofollow']) ? 'nofollow' : '';
            }


        ?>

            <section class="testimonial-four-area pt-120 pb-120">
                <div class="container">
                    <div class="d-flex flex-wrap mb-80 justify-content-between align-items-end gap-3">
                        <div class="section-header-four">
                            <?php if (!empty($settings['tp_testimonial_sub_title'])) : ?>
                                <h5 class="wow splt-txt" data-splitting><span class="title-dot"></span> <?php echo tp_kses($settings['tp_testimonial_sub_title']) ?></h5>
                            <?php endif; ?>
                            <?php if (!empty($settings['tp_testimonial_title'])) : ?>
                                <h2 class="wow splt-txt" data-splitting><?php echo tp_kses($settings['tp_testimonial_title']) ?> </h2>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($settings['tp_testimonial_description'])) : ?>
                            <p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                                <?php echo tp_kses($settings['tp_testimonial_description']) ?>
                            <p>
                            <?php endif; ?>
                    </div>
                    <div class="testimonial-four__info mb-60">
                        <div class="testi-conter-wrp">
                            <div class="testi-conter">
                                <?php if (!empty($settings['tp_testimonial_review_number'])) : ?>
                                    <h3><span class="count"> <?php echo tp_kses($settings['tp_testimonial_review_number']) ?> </span>+</h3>
                                <?php endif; ?>
                                <?php if (!empty($settings['tp_testimonial_review_title'])) : ?>
                                    <span class="fs-18"> <?php echo tp_kses($settings['tp_testimonial_review_title']) ?> </span>
                                <?php endif; ?>

                            </div>
                            <div class="line"></div>
                            <div class="testi-conter">
                                <?php if (!empty($settings['tp_testimonial_review_rating'])) : ?>
                                    <h3><span class="count"> <?php echo tp_kses($settings['tp_testimonial_review_rating']) ?> </span>+</h3>
                                <?php endif; ?>
                                <?php if (!empty($settings['tp_testimonial_review__rating_title'])) : ?>
                                    <span class="fs-18"> <?php echo tp_kses($settings['tp_testimonial_review__rating_title']) ?> </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="testi-brand d-flex gap-4">
                            <?php foreach ($settings['tp_testimonial_award_thumb_list'] as $key => $item) :
                                if (!empty($item['tp_testimonial_award_thumb']['url'])) {
                                    $tp_testimonial_award_thumb_url = !empty($item['tp_testimonial_award_thumb']['id']) ? wp_get_attachment_image_url($item['tp_testimonial_award_thumb']['id'], $item['tp_testimonial_award_thumb_size']) : $item['tp_testimonial_award_thumb']['url'];
                                    $tp_testimonial_award_thumb_alt = get_post_meta($item["tp_testimonial_award_thumb"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                                <img src="<?php echo esc_url($tp_testimonial_award_thumb_url); ?>" alt="<?php echo esc_url($tp_testimonial_award_thumb_alt); ?>">
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-4">

                            <div class="testimonial-four__card">
                                <div class="bg">
                                    <img src="<?php echo esc_url($tp_testimonial_card_bg_thumb_url); ?>" alt="<?php echo esc_attr($tp_testimonial_card_bg_thumb_alt); ?>">
                                </div>
                                <div class="mt-120">
                                    <img src="<?php echo esc_url($tp_testimonial_card_logo_url); ?>" alt="<?php echo esc_attr($tp_testimonial_card_logo_alt); ?>">
                                    <div class="star d-flex justify-content-center mt-15 align-items-center gap-1">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                                <div>
                                    <?php if (!empty($settings['tp_testimonial_card_link_switcher'])) : ?>
                                        <a href="<?php echo esc_url($link); ?>" class="btn-four" rel="<?php echo esc_attr($rel); ?>" target="<?php echo esc_attr($target); ?>"> <?php echo tp_kses($settings['tp_testimonial_card_btn_text']); ?>
                                            <span>
                                                <i class="fa-regular fa-arrow-right arry1"></i>
                                                <i class="fa-regular fa-arrow-right arry2"></i>
                                            </span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <span class="fs-18 text-white">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.5778 3.80882C13.5378 3.05551 15.6674 2.78977 17.7586 2.91985C20.709 3.11376 23.5834 4.30917 25.793 6.27067C26.1602 6.59227 26.5162 6.92583 26.8826 7.24823C25.4994 8.63037 24.113 10.0101 22.7298 11.3923C22.1458 10.9127 21.6026 10.3788 20.9602 9.97501C19.573 9.07406 17.8874 8.6599 16.2394 8.77561C14.6626 8.85381 13.085 9.3781 11.8594 10.3884C10.6778 11.3428 9.87138 12.7201 9.54498 14.1957C9.17218 15.8707 9.30738 17.671 10.0074 19.2446C10.685 20.7896 11.9506 22.064 13.493 22.7559C15.7402 23.7645 18.4858 23.6752 20.6114 22.4055C21.3946 21.9642 22.0258 21.3187 22.7026 20.7393C24.1074 22.1175 25.5194 23.4884 26.9106 24.8801C26.3258 25.4308 25.753 25.9974 25.1138 26.4849C23.0978 28.0466 20.6266 29.0122 18.0834 29.2285C15.9162 29.4024 13.6962 29.1455 11.6666 28.3459C9.18658 27.3851 7.02178 25.6303 5.59298 23.3903C4.17858 21.1958 3.46738 18.5743 3.49698 15.9712C3.47698 13.3274 4.20658 10.6573 5.69378 8.45641C7.10498 6.34409 9.20098 4.70818 11.5778 3.80882Z" fill="white" />
                                        <path d="M15.8835 11.713C16.9035 11.5638 17.9763 11.7713 18.8539 12.3147C19.8843 12.934 20.6363 13.9937 20.8803 15.1684C21.1355 16.3311 20.8955 17.5951 20.2219 18.5791C19.5115 19.6444 18.3163 20.3698 17.0403 20.5047C16.0299 20.618 14.9787 20.3873 14.1267 19.8295C13.1347 19.1991 12.4139 18.1593 12.1811 17.0078C11.9723 15.9616 12.1283 14.838 12.6643 13.9091C13.3259 12.7377 14.5459 11.8966 15.8835 11.713Z" fill="#FF3D2E" />
                                    </svg>
                                    <?php if (!empty($settings['tp_testimonial_card_review'])) : ?>
                                        <?php echo tp_kses($settings['tp_testimonial_card_review']); ?>
                                    <?php endif; ?>
                                </span>
                            </div>

                        </div>
                        <div class="col-lg-8">
                            <div class="swiper testimonial-four__slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($settings['tp_testimonial_quotation_list'] as $key => $item) :
                                        if (!empty($item['tp_testimonial_quotation_client_thumb']['url'])) {
                                            $tp_testimonial_quotation_client_thumb_url = !empty($item['tp_testimonial_quotation_client_thumb']['id']) ? wp_get_attachment_image_url($item['tp_testimonial_quotation_client_thumb']['id'], $item['tp_testimonial_quotation_client_thumb_size']) : $item['tp_testimonial_quotation_client_thumb']['url'];
                                            $tp_testimonial_quotation_client_thumb_alt = get_post_meta($item["tp_testimonial_quotation_client_thumb"]["id"], "_wp_attachment_image_alt", true);
                                        }
                                    ?>
                                        <div class="swiper-slide">
                                            <div class="testimonial-four__item">
                                                <div class="star d-flex align-items-center gap-1 mb-60">
                                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.1301 3.3329C11.8451 2.67375 13.7085 2.44123 15.5383 2.55505C18.1199 2.72473 20.635 3.77071 22.5684 5.48702C22.8897 5.76842 23.2012 6.06029 23.5218 6.34238C22.3115 7.55176 21.0984 8.75904 19.8881 9.96842C19.3771 9.54876 18.9018 9.08163 18.3397 8.72832C17.1259 7.93999 15.651 7.57759 14.209 7.67884C12.8293 7.74727 11.4489 8.20602 10.3765 9.09001C9.34257 9.92512 8.63697 11.1303 8.35137 12.4214C8.02517 13.887 8.14347 15.4623 8.75597 16.8392C9.34887 18.1911 10.4563 19.3062 11.8059 19.9116C13.7722 20.7942 16.1746 20.7159 18.0345 19.605C18.7198 19.2189 19.2721 18.654 19.8643 18.1471C21.0935 19.353 22.329 20.5526 23.5463 21.7703C23.0346 22.2521 22.5334 22.7479 21.9741 23.1745C20.2101 24.541 18.0478 25.3859 15.8225 25.5751C13.9262 25.7273 11.9837 25.5025 10.2078 24.8028C8.03777 23.9621 6.14357 22.4267 4.89337 20.4667C3.65577 18.5465 3.03347 16.2527 3.05937 13.975C3.04187 11.6617 3.68027 9.32532 4.98157 7.39954C6.21637 5.55126 8.05037 4.11984 10.1301 3.3329Z" fill="#151314" />
                                                        <path d="M13.8978 10.2491C14.7903 10.1186 15.729 10.3001 16.4969 10.7756C17.3985 11.3175 18.0565 12.2448 18.27 13.2726C18.4933 14.2899 18.2833 15.396 17.6939 16.2569C17.0723 17.1891 16.0265 17.8238 14.91 17.9418C14.0259 18.041 13.1061 17.8392 12.3606 17.3511C11.4926 16.7995 10.8619 15.8896 10.6582 14.8821C10.4755 13.9667 10.612 12.9835 11.081 12.1707C11.6599 11.1457 12.7274 10.4097 13.8978 10.2491Z" fill="#FF3D2E" />
                                                    </svg>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <span class="ms-1 fw-500 fs-18 secondary-color"><?php echo tp_kses($item['tp_testimonial_quotation_title']) ?> </span>
                                                </div>
                                                <img class="mb-20" src="<?php echo esc_url($tp_testimonial_quotation_client_thumb_url); ?>" alt="<?php echo esc_attr($tp_testimonial_quotation_client_thumb_alt); ?>">
                                                <p> <?php echo tp_kses($item['tp_testimonial_quotation_description']) ?> </p>
                                                <h5 class="mt-25"> <?php echo tp_kses($item['tp_testimonial_quotation_client_name']) ?> </h5>
                                                <span> <?php echo tp_kses($item['tp_testimonial_quotation_client_designation']) ?> </span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-40">
                        <div class="team-four__swiper-scrollbar">
                            <div class="position-relative">
                                <div class="testimonial-four__scrollbar"></div>
                            </div>
                        </div>
                        <div class="pb-15"></div>
                        <div class="swiper-four__info">
                            <button class="testimonial-four__arry-prev active disable"><i class="fa-regular fa-arrow-left"></i></button>
                            <button class="testimonial-four__arry-next active"><i class="fa-regular fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </section>




        <?php elseif ($settings['tp_testimonial_design_layout']  == 'layout-3') :
        ?>


            <section class="testimonial-three-area pb-120">
                <div class="container">
                    <div class="section-header mb-80 text-center">
                        <?php if (!empty($settings['tp_testimonial_sub_title'])) : ?>
                            <h5 class="wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_testimonial_sub_title']); ?> </h5>
                        <?php endif; ?>
                        <?php if (!empty($settings['tp_testimonial_title'])) : ?>
                            <h2 class="fw-600 wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_testimonial_title']); ?> </h2>
                        <?php endif; ?>
                        <?php if (!empty($settings['tp_testimonial_description'])) : ?>
                            <p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_testimonial_description']); ?> </p>
                        <?php endif; ?>
                    </div>
                    <div class="swiper testimonial-three__slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['tp_testimonial_quotation_list'] as $key => $item) :
                                if (!empty($item['tp_testimonial_quotation_client_thumb']['url'])) {
                                    $tp_testimonial_quotation_client_thumb_url = !empty($item['tp_testimonial_quotation_client_thumb']['id']) ? wp_get_attachment_image_url($item['tp_testimonial_quotation_client_thumb']['id'], $item['tp_testimonial_quotation_client_thumb_size']) : $item['tp_testimonial_quotation_client_thumb']['url'];
                                    $tp_testimonial_quotation_client_thumb_alt = get_post_meta($item["tp_testimonial_quotation_client_thumb"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-three__item-wrp">
                                        <div class="testimonial-three__item">
                                            <div class="coma-top">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/testimonial-three-coma-top.png" alt="icon">
                                            </div>
                                            <div class="coma-bottom">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/testimonial-three-coma-bottom.png" alt="icon">
                                            </div>
                                            <div class="star d-flex gap-2 mb-4 justify-content-end">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                            <p> <?php echo tp_kses($item['tp_testimonial_quotation_description']); ?> </p>
                                            <div class="d-flex gap-3 align-items-center mt-30 pt-30 bor-top">
                                                <img src="<?php echo esc_url($tp_testimonial_quotation_client_thumb_url); ?>" alt="<?php echo esc_attr($tp_testimonial_quotation_client_thumb_alt); ?>">
                                                <h5>
                                                    <a href="" class="fw-600"> <?php echo tp_kses($item['tp_testimonial_quotation_client_name']) ?> </a>
                                                    <span class="fw-normal text-font"> <?php echo tp_kses($item['tp_testimonial_quotation_client_designation']); ?> </span>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-60">
                            <div class="swiper__info">
                                <button class="testimonial-three__arry-prev"><i class="fa-regular fa-arrow-left-long"></i></button>
                                <div class="dot testimonial-three__dot"></div>
                                <button class="testimonial-three__arry-next active"><i class="fa-regular fa-arrow-right-long"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['tp_testimonial_design_layout']  == 'layout-2') :
        ?>

            <section class="testimonial-two-area pt-120 pb-120">
                <div class="testimonial-two__line">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/testimonial-line.png" alt="shape">
                </div>

                <div class="section-header text-center mb-80">
                    <?php if (!empty($settings['tp_testimonial_title'])) : ?>
                        <h2 class="fw-600 wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_testimonial_title']) ?> </h2>
                    <?php endif; ?>
                    <?php if (!empty($settings['tp_testimonial_description'])) : ?>
                        <p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_testimonial_description']) ?> </p>
                    <?php endif; ?>
                </div>

                <div class="swiper testimonial-two__slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['tp_testimonial_quotation_list'] as $key => $item) :
                            if (!empty($item['tp_testimonial_quotation_client_thumb']['url'])) {
                                $tp_testimonial_quotation_client_thumb_url = !empty($item['tp_testimonial_quotation_client_thumb']['id']) ? wp_get_attachment_image_url($item['tp_testimonial_quotation_client_thumb']['id'], $item['tp_testimonial_quotation_client_thumb_size']) : $item['tp_testimonial_quotation_client_thumb']['url'];
                                $tp_testimonial_quotation_client_thumb_alt = get_post_meta($item["tp_testimonial_quotation_client_thumb"]["id"], "_wp_attachment_image_alt", true);
                            }
                        ?>
                            <div class="swiper-slide">
                                <div class="testimonial-two__item <?php echo ($key % 2 == 0) ? '' : 'mt-80'; ?>">
                                    <svg class="coma" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.89997 28.8599C8.91 31.3499 7.35003 33.8099 5.26501 36.18C4.60501 36.93 4.51501 38.0099 5.055 38.8499C5.47504 39.5099 6.16498 39.8699 6.91498 39.8699C7.125 39.8699 7.33503 39.855 7.54504 39.7799C11.955 38.4899 22.26 33.9149 22.545 19.2449C22.65 13.59 18.51 8.72998 13.125 8.17498C10.14 7.87496 7.17004 8.8499 4.965 10.8299C2.76004 12.8249 1.5 15.675 1.5 18.6449C1.5 23.5949 5.01004 27.93 9.89997 28.8599Z" fill="#256E56" />
                                        <path d="M37.0652 8.17498C34.0951 7.87496 31.1251 8.8499 28.9202 10.8299C26.7151 12.8249 25.4551 15.675 25.4551 18.6449C25.4551 23.5949 28.9651 27.9299 33.8551 28.8599C32.8651 31.3499 31.3051 33.8099 29.2201 36.1799C28.5601 36.9299 28.4701 38.0099 29.0102 38.8499C29.4301 39.5099 30.1202 39.8699 30.8702 39.8699C31.0801 39.8699 31.2901 39.855 31.5001 39.7799C35.9101 38.4899 46.2151 33.9149 46.5001 19.2449V19.035C46.5001 13.4699 42.4052 8.72998 37.0652 8.17498Z" fill="#256E56" />
                                    </svg>
                                    <div class="star d-flex gap-2 mb-2">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <h5 class="mb-10"> <?php echo tp_kses($item['tp_testimonial_quotation_title']); ?> </h5>
                                    <p> <?php echo tp_kses($item['tp_testimonial_quotation_description']); ?> </p>
                                    <div class="d-flex align-items-center gap-3 mt-30">
                                        <img src="<?php echo esc_url($tp_testimonial_quotation_client_thumb_url); ?>" alt="<?php echo esc_attr($tp_testimonial_quotation_client_thumb_alt); ?>">
                                        <div>
                                            <h5> <?php echo tp_kses($item['tp_testimonial_quotation_client_name']) ?> </h5>
                                            <span> <?php echo tp_kses($item['tp_testimonial_quotation_client_designation']); ?> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <div class="mt-60">
                        <div class="swiper-two__info">
                            <button class="testimonial-two__arry-prev active"><i class="fa-regular fa-arrow-left"></i></button>
                            <div class="dot testimonial-two__dot"></div>
                            <button class="testimonial-two__arry-next active"><i class="fa-regular fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

            </section>


        <?php else :  ?>

            <section class="agenshark-wrap testimonial-area pb-120">
                <div class="container">
                    <div class="row g-4 justify-content-between">
                        <div class="col-lg-5">
                            <div class="testimonial__item-left">
                                <?php if (!empty($settings['tp_testimonial_title'])) : ?>
                                    <h2 class="fw-600 wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_testimonial_title']) ?> </h2>
                                <?php endif; ?>

                                <?php if (!empty($settings['tp_testimonial_description'])) : ?>
                                    <p class="mb-50 fs-20 fw-500 text-uppercase wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_testimonial_description']) ?> </p>
                                <?php endif; ?>

                                <div class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                                    <?php if (!empty($settings['tp_testimonial_award_title'])) : ?>
                                        <p class="award-title"> <?php echo tp_kses($settings['tp_testimonial_award_title']) ?> </p>
                                    <?php endif; ?>
                                    <div class="d-flex align-items-center gap-4 mb-20">

                                        <?php foreach ($settings['tp_testimonial_award_list'] as $item) :
                                            if (!empty($item['tp_testimonial_award_thumb']['url'])) {
                                                $tp_testimonial_award_thumb_url = !empty($item['tp_testimonial_award_thumb']['id']) ? wp_get_attachment_image_url($item['tp_testimonial_award_thumb']['id'], $item['tp_testimonial_award_thumb_size']) : $item['tp_testimonial_award_thumb']['url'];
                                                $tp_testimonial_award_thumb_alt = get_post_meta($item["tp_testimonial_award_thumb"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                        ?>
                                            <img src=" <?php echo esc_url($tp_testimonial_award_thumb_url) ?>" alt="<?php echo esc_attr($tp_testimonial_award_thumb_alt) ?>">
                                        <?php endforeach; ?>
                                    </div>
                                    <?php if (!empty($settings['tp_testimonial_award_description'])) : ?>
                                        <p> <?php echo tp_kses($settings['tp_testimonial_award_description']); ?> </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="testimonial__item-right">
                                <svg class="coma" width="88" height="68" viewBox="0 0 88 68" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.10885 62.0247C3.19219 56.6164 0.242188 50.7164 0.242188 40.8831C0.242188 23.6747 12.5339 8.43307 29.7422 0.566406L34.1672 6.95807C17.9422 15.8081 14.5005 27.1164 13.5172 34.4914C15.9755 33.0164 19.4172 32.5247 22.8589 33.0164C31.7089 33.9997 38.5922 40.8831 38.5922 50.2247C38.5922 54.6497 36.6255 59.0747 33.6755 62.5164C30.2339 65.9581 26.3005 67.4331 21.3839 67.4331C15.9755 67.4331 11.0589 64.9747 8.10885 62.0247ZM57.2755 62.0247C52.3589 56.6164 49.4089 50.7164 49.4089 40.8831C49.4089 23.6747 61.7005 8.43307 78.9089 0.566406L83.3339 6.95807C67.1089 15.8081 63.6672 27.1164 62.6839 34.4914C65.1422 33.0164 68.5839 32.5247 72.0255 33.0164C80.8755 33.9997 87.7589 40.8831 87.7589 50.2247C87.7589 54.6497 85.7922 59.0747 82.8422 62.5164C79.8922 65.9581 75.4672 67.4331 70.5505 67.4331C65.1422 67.4331 60.2255 64.9747 57.2755 62.0247Z" fill="#151314" fill-opacity="0.1" />
                                </svg>
                                <div class="swiper testimonial__slider">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($settings['tp_testimonial_quotation_list'] as $item) :
                                            if (!empty($item['tp_testimonial_quotation_client_thumb']['url'])) {
                                                $tp_testimonial_quotation_client_thumb_url = !empty($item['tp_testimonial_quotation_client_thumb']['id']) ? wp_get_attachment_image_url($item['tp_testimonial_quotation_client_thumb']['id'], $item['tp_testimonial_quotation_client_thumb_size']) : $item['tp_testimonial_quotation_client_thumb']['url'];
                                                $tp_testimonial_quotation_client_thumb_alt = get_post_meta($item["tp_testimonial_quotation_client_thumb"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                        ?>
                                            <div class="swiper-slide">
                                                <div class="testimonial__item">
                                                    <div class="star d-flex gap-2 mb-2">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                    </div>
                                                    <h3 class="pt-15 pb-10"> <?php echo tp_kses($item['tp_testimonial_quotation_title']); ?> </h3>
                                                    <p> <?php echo tp_kses($item['tp_testimonial_quotation_description']); ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/quote.svg" alt=""> </p>
                                                    <div class="bor-top pt-4 mt-30 d-flex align-items-center gap-3 flex-wrap justify-content-between">
                                                        <div class="d-flex align-items-center gap-3">
                                                            <img src="<?php echo esc_url($tp_testimonial_quotation_client_thumb_url); ?>" alt="<?php echo esc_attr($tp_testimonial_quotation_client_thumb_alt) ?>">
                                                            <div>
                                                                <h5> <?php echo tp_kses($item['tp_testimonial_quotation_client_name']) ?> </h5>
                                                                <span> <?php echo tp_kses($item['tp_testimonial_quotation_client_designation']) ?> </span>
                                                            </div>
                                                        </div>
                                                        <div class="swiper__info m-0">
                                                            <button class="testimonial__arry-prev"><i class="fa-regular fa-arrow-left-long"></i></button>
                                                            <div class="dot testimonial__dot"></div>
                                                            <button class="testimonial__arry-next active"><i class="fa-regular fa-arrow-right-long"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
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

$widgets_manager->register(new TP_Testimonial());
