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
class TP_Portfolio extends Widget_Base
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
        return 'portfolio-list';
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
        return __('Portfolio', 'tpcore');
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
        return ['portfolio', 'project', 'case studies', 'profile'];
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
            'tp_portfolio_design_layout_section',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_portfolio_design_layout',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // content section
        $this->start_controls_section(
            'tp_portfolio_content_section',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_portfolio_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_portfolio_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_portfolio_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_portfolio_design_layout' => ['layout-1']
                ]
            ]
        );

        // btn
        $this->add_control(
            'tp_portfolio_explore_more_link_switcher',
            [
                'label' => esc_html__('Button Switch', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tp_portfolio_explore_more_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_portfolio_explore_more_link_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'tp_portfolio_explore_more_link_type',
            [
                'label' => esc_html__('Button URL Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom URL',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolio_explore_more_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_portfolio_explore_more_link',
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
                    'tp_portfolio_explore_more_link_type' => '1',
                    'tp_portfolio_explore_more_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_portfolio_explore_more_page_link',
            [
                'label' => esc_html__('Internal Page Link', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_explore_more_link_type' => '2',
                    'tp_portfolio_explore_more_link_switcher' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        // portfolio repeater 
        $this->start_controls_section(
            'tp_portfolio_repeater_content_section',
            [
                'label' => esc_html__('Portfolio Repeater ', 'tpcore'),
                'condition' => [
                    'tp_portfolio_design_layout' => ['layout-1']
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_portfolio_repeater_categories',
            [
                'label' => esc_html__('Categories', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Categories Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your categories', 'tpcore'),
                'label_block' => true,
            ]
        );

        // btn
        $repeater->add_control(
            'tp_portfolio_repeater_link_switcher',
            [
                'label' => esc_html__('Button Switch', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_portfolio_repeater_link_switcher' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_link_type',
            [
                'label' => esc_html__('Button URL Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom URL',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolio_repeater_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_link',
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
                    'tp_portfolio_repeater_link_type' => '1',
                    'tp_portfolio_repeater_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_page_link',
            [
                'label' => esc_html__('Internal Page Link', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_repeater_link_type' => '2',
                    'tp_portfolio_repeater_link_switcher' => 'yes',
                ]
            ]
        );

        // btn 2
        $repeater->add_control(
            'tp_portfolio_repeater_link_switcher_2',
            [
                'label' => esc_html__('Button Switch - 2', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_btn_text_2',
            [
                'label' => esc_html__('Button Text - 2', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_portfolio_repeater_link_switcher_2' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_link_type_2',
            [
                'label' => esc_html__('Button URL Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom URL',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolio_repeater_link_switcher_2' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_link_2',
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
                    'tp_portfolio_repeater_link_type_2' => '1',
                    'tp_portfolio_repeater_link_switcher_2' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_page_link_2',
            [
                'label' => esc_html__('Internal Page Link', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_repeater_link_type_2' => '2',
                    'tp_portfolio_repeater_link_switcher_2' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_thumb',
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
                'name' => 'tp_portfolio_repeater_thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'tp_portfolio_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_portfolio_repeater_btn_text' => esc_html__('Dashboard Analytics', 'tpcore'),
                    ],
                    [
                        'tp_portfolio_repeater_btn_text' => esc_html__('Sequence - Financial Dashboard', 'tpcore')
                    ],
                    [
                        'tp_portfolio_repeater_btn_text' => esc_html__('ARTVISTA - Art Gallery Website', 'tpcore')
                    ],
                    [
                        'tp_portfolio_repeater_btn_text' => esc_html__('Dashboard Analytics', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_portfolio_repeater_btn_text }}}',
            ]
        );

        $this->end_controls_section();

        // portfolio repeater v_2 
        $this->start_controls_section(
            'tp_portfolio_repeater_content_section_v_2',
            [
                'label' => esc_html__('Portfolio Repeater - 2 ', 'tpcore'),
                'condition' => [
                    'tp_portfolio_design_layout' => ['layout-1']
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_portfolio_repeater_categories_v_2',
            [
                'label' => esc_html__('Categories', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Categories Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your categories', 'tpcore'),
                'label_block' => true,
            ]
        );

        // btn
        $repeater->add_control(
            'tp_portfolio_repeater_link_switcher_v_2',
            [
                'label' => esc_html__('Button Switch', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_btn_text_v_2',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_portfolio_repeater_link_switcher_v_2' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_link_type_v_2',
            [
                'label' => esc_html__('Button URL Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom URL',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolio_repeater_link_switcher_v_2' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_link_v_2',
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
                    'tp_portfolio_repeater_link_type_v_2' => '1',
                    'tp_portfolio_repeater_link_switcher_v_2' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_page_link_v_2',
            [
                'label' => esc_html__('Internal Page Link', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_repeater_link_type_v_2' => '2',
                    'tp_portfolio_repeater_link_switcher_v_2' => 'yes',
                ]
            ]
        );

        // btn 2
        $repeater->add_control(
            'tp_portfolio_repeater_link_switcher_2_v_2',
            [
                'label' => esc_html__('Button Switch - 2', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_btn_text_2_v_2',
            [
                'label' => esc_html__('Button Text - 2', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_portfolio_repeater_link_switcher_2_v_2' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_link_type_2_v_2',
            [
                'label' => esc_html__('Button URL Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom URL',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolio_repeater_link_switcher_2_v_2' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_link_2_v_2',
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
                    'tp_portfolio_repeater_link_type_2_v_2' => '1',
                    'tp_portfolio_repeater_link_switcher_2_v_2' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_page_link_2_v_2',
            [
                'label' => esc_html__('Internal Page Link', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_repeater_link_type_2_v_2' => '2',
                    'tp_portfolio_repeater_link_switcher_2_v_2' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_thumb_v_2',
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
                'name' => 'tp_portfolio_repeater_thumb_v_2',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'tp_portfolio_list_v_2',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_portfolio_repeater_btn_text_v_2' => esc_html__('Dashboard Analytics', 'tpcore'),
                    ],
                    [
                        'tp_portfolio_repeater_btn_text_v_2' => esc_html__('Sequence - Financial Dashboard', 'tpcore')
                    ],
                    [
                        'tp_portfolio_repeater_btn_text_v_2' => esc_html__('ARTVISTA - Art Gallery Website', 'tpcore')
                    ],
                    [
                        'tp_portfolio_repeater_btn_text_v_2' => esc_html__('Dashboard Analytics', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_portfolio_repeater_btn_text_v_2 }}}',
            ]
        );

        $this->end_controls_section();


        // portfolio repeater v_2 
        $this->start_controls_section(
            'tp_portfolio_repeater_content_section_v_3',
            [
                'label' => esc_html__('Portfolio Repeater - 3 ', 'tpcore'),
                'condition' => [
                    'tp_portfolio_design_layout' => ['layout-1']
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_portfolio_repeater_categories_v_3',
            [
                'label' => esc_html__('Categories', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Categories Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your categories', 'tpcore'),
                'label_block' => true,
            ]
        );

        // btn
        $repeater->add_control(
            'tp_portfolio_repeater_link_switcher_v_3',
            [
                'label' => esc_html__('Button Switch', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_btn_text_v_3',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_portfolio_repeater_link_switcher_v_3' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_link_type_v_3',
            [
                'label' => esc_html__('Button URL Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom URL',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolio_repeater_link_switcher_v_3' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_link_v_3',
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
                    'tp_portfolio_repeater_link_type_v_3' => '1',
                    'tp_portfolio_repeater_link_switcher_v_3' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_page_link_v_3',
            [
                'label' => esc_html__('Internal Page Link', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_repeater_link_type_v_3' => '2',
                    'tp_portfolio_repeater_link_switcher_v_3' => 'yes',
                ]
            ]
        );

        // btn 2
        $repeater->add_control(
            'tp_portfolio_repeater_link_switcher_2_v_3',
            [
                'label' => esc_html__('Button Switch - 2', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_btn_text_2_v_3',
            [
                'label' => esc_html__('Button Text - 2', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_portfolio_repeater_link_switcher_2_v_3' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_link_type_2_v_3',
            [
                'label' => esc_html__('Button URL Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom URL',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolio_repeater_link_switcher_2_v_3' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_link_2_v_3',
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
                    'tp_portfolio_repeater_link_type_2_v_3' => '1',
                    'tp_portfolio_repeater_link_switcher_2_v_3' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_page_link_2_v_3',
            [
                'label' => esc_html__('Internal Page Link', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_repeater_link_type_2_v_3' => '2',
                    'tp_portfolio_repeater_link_switcher_2_v_3' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_repeater_thumb_v_3',
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
                'name' => 'tp_portfolio_repeater_thumb_v_3',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'tp_portfolio_list_v_3',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_portfolio_repeater_btn_text_v_3' => esc_html__('Dashboard Analytics', 'tpcore'),
                    ],
                    [
                        'tp_portfolio_repeater_btn_text_v_3' => esc_html__('Sequence - Financial Dashboard', 'tpcore')
                    ],
                    [
                        'tp_portfolio_repeater_btn_text_v_3' => esc_html__('ARTVISTA - Art Gallery Website', 'tpcore')
                    ],
                    [
                        'tp_portfolio_repeater_btn_text_v_3' => esc_html__('Dashboard Analytics', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_portfolio_repeater_btn_text_v_3 }}}',
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

        <?php if ($settings['tp_portfolio_design_layout']  == 'layout-2') :
        ?>


        <?php else :
            // btn 
            if ('2' == $settings['tp_portfolio_explore_more_link_type']) {
                $link_explore_more = get_permalink($settings['tp_portfolio_explore_more_page_link']);
                $target_explore_more = '_self';
                $rel_explore_more = 'nofollow';
            } else {
                $link_explore_more = !empty($settings['tp_portfolio_explore_more_link']['url']) ? $settings['tp_portfolio_explore_more_link']['url'] : '';
                $target_explore_more = !empty($settings['tp_portfolio_explore_more_link']['is_external']) ? '_blank' : '';
                $rel_explore_more = !empty($settings['tp_portfolio_explore_more_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>

            <section class="agenshark-wrap story-area pt-120 pb-120">
                <div class="container">
                    <div class="section-header-flex line-title mb-80">
                        <?php if (!empty($settings['tp_portfolio_title'])) : ?>
                            <h2 class="fw-600 splt-txt wow" data-splitting> <?php echo tp_kses($settings['tp_portfolio_title']) ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/title-line-store.png" alt=""></span>
                            </h2>
                        <?php endif; ?>
                        <?php if (!empty($settings['tp_portfolio_description'])) : ?>
                            <p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_portfolio_description']) ?> </p>
                        <?php endif; ?>
                    </div>
                    <div class="swiper story__slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="row g-5 align-items-star">
                                    <?php foreach ($settings['tp_portfolio_list'] as $key => $item) :
                                        
                                        // btn one
                                        if ('2' == $item['tp_portfolio_repeater_link_type']) {
                                            $portfolio_link = get_permalink($item['tp_portfolio_repeater_page_link']);
                                            $portfolio_target = '_self';
                                            $portfolio_rel = 'nofollow';
                                        } else {
                                            $portfolio_link = !empty($item['tp_portfolio_repeater_link']['url']) ? $item['tp_portfolio_repeater_link']['url'] : '';
                                            $portfolio_target = !empty($item['tp_portfolio_repeater_link']['is_external']) ? '_blank' : '';
                                            $portfolio_rel = !empty($item['tp_portfolio_repeater_link']['nofollow']) ? 'nofollow' : '';
                                        }

                                        // btn two
                                        if ('2' == $item['tp_portfolio_repeater_link_type_2']) {
                                            $portfolio_link_2 = get_permalink($item['tp_portfolio_repeater_page_link_2']);
                                            $portfolio_target_2 = '_self';
                                            $portfolio_rel_2 = 'nofollow';
                                        } else {
                                            $portfolio_link_2 = !empty($item['tp_portfolio_repeater_link_2']['url']) ? $item['tp_portfolio_repeater_link_2']['url'] : '';
                                            $portfolio_target_2 = !empty($item['tp_portfolio_repeater_link_2']['is_external']) ? '_blank' : '';
                                            $portfolio_rel_2 = !empty($item['tp_portfolio_repeater_link_2']['nofollow']) ? 'nofollow' : '';
                                        }

                                        if (!empty($item['tp_portfolio_repeater_thumb']['url'])) {
                                            $tp_portfolio_repeater_thumb_url = !empty($item['tp_portfolio_repeater_thumb']['id']) ? wp_get_attachment_image_url($item['tp_portfolio_repeater_thumb']['id'], $item['tp_portfolio_repeater_thumb_size']) : $item['tp_portfolio_repeater_thumb']['url'];
                                            $tp_portfolio_repeater_thumb_alt = get_post_meta($item["tp_portfolio_repeater_thumb"]["id"], "_wp_attachment_image_alt", true);
                                        }

                                    ?>
                                        <div class="col-lg-6">
                                            <div class="story__item <?php echo ($key == 2) ? 'mt-minus' : ''; ?>">
                                                <div class="image">
                                                    <img src="<?php echo esc_url($tp_portfolio_repeater_thumb_url) ?>" alt="<?php echo esc_attr($tp_portfolio_repeater_thumb_alt) ?>">
                                                </div>
                                                <div class="d-flex align-items-center flex-wrap gap-3 justify-content-between mt-20">
                                                    <div>
                                                        <?php if (!empty($item['tp_portfolio_repeater_link_switcher'])) : ?>
                                                            <h3 class="mb-2"> <a href="<?php echo esc_url($portfolio_link); ?>" rel="<?php echo esc_attr($portfolio_rel); ?>" target="<?php echo esc_attr($portfolio_target); ?>"> <?php echo tp_kses($item['tp_portfolio_repeater_btn_text']); ?></a></h3>
                                                        <?php endif; ?>
                                                        <div class="story__info">
                                                            <?php echo $item['tp_portfolio_repeater_categories']; ?>
                                                        </div>
                                                    </div>
                                                    <?php if (!empty($item['tp_portfolio_repeater_link_switcher_2'])) : ?>
                                                        <div>
                                                            <a class="btn-one" href="<?php echo esc_url($portfolio_link_2); ?>" rel="<?php echo esc_attr($portfolio_rel_2); ?>" target="<?php echo esc_attr($portfolio_target_2); ?>"> <?php echo tp_kses($item['tp_portfolio_repeater_btn_text_2']); ?>
                                                                <span>
                                                                    <i class="fa-regular fa-arrow-up-right arry1"></i>
                                                                    <i class="fa-regular fa-arrow-up-right arry2"></i>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="row g-5 align-items-star">
                                    <?php foreach ($settings['tp_portfolio_list_v_2'] as $key => $item) :

                                        // btn one
                                        if ('2' == $item['tp_portfolio_repeater_link_type_v_2']) {
                                            $portfolio_link_v_2 = get_permalink($item['tp_portfolio_repeater_page_link_v_2']);
                                            $portfolio_target_v_2 = '_self';
                                            $portfolio_rel_v_2 = 'nofollow';
                                        } else {
                                            $portfolio_link_v_2 = !empty($item['tp_portfolio_repeater_link_v_2']['url']) ? $item['tp_portfolio_repeater_link_v_2']['url'] : '';
                                            $portfolio_target_v_2 = !empty($item['tp_portfolio_repeater_link_v_2']['is_external']) ? '_blank' : '';
                                            $portfolio_rel_v_2 = !empty($item['tp_portfolio_repeater_link_v_2']['nofollow']) ? 'nofollow' : '';
                                        }

                                        // btn two
                                        if ('2' == $item['tp_portfolio_repeater_link_type_2_v_2']) {
                                            $portfolio_link_2_v_2 = get_permalink($item['tp_portfolio_repeater_page_link_2_v_2']);
                                            $portfolio_target_2_v_2 = '_self';
                                            $portfolio_rel_2_v_2 = 'nofollow';
                                        } else {
                                            $portfolio_link_2_v_2 = !empty($item['tp_portfolio_repeater_link_2_v_2']['url']) ? $item['tp_portfolio_repeater_link_2_v_2']['url'] : '';
                                            $portfolio_target_2_v_2 = !empty($item['tp_portfolio_repeater_link_2_v_2']['is_external']) ? '_blank' : '';
                                            $portfolio_rel_2_v_2 = !empty($item['tp_portfolio_repeater_link_2_v_2']['nofollow']) ? 'nofollow' : '';
                                        }


                                        if (!empty($item['tp_portfolio_repeater_thumb_v_2']['url'])) {
                                            $tp_portfolio_repeater_thumb_url_v_2 = !empty($item['tp_portfolio_repeater_thumb_v_2']['id']) ? wp_get_attachment_image_url($item['tp_portfolio_repeater_thumb_v_2']['id'], $item['tp_portfolio_repeater_thumb_v_2_size']) : $item['tp_portfolio_repeater_thumb_v_2']['url'];
                                            $tp_portfolio_repeater_thumb_alt_v_2 = get_post_meta($item["tp_portfolio_repeater_thumb_v_2"]["id"], "_wp_attachment_image_alt", true);
                                        }

                                    ?>
                                        <div class="col-lg-6">
                                            <div class="story__item <?php echo ($key == 2) ? 'mt-minus' : ''; ?>">
                                                <div class="image">
                                                    <img src="<?php echo esc_url($tp_portfolio_repeater_thumb_url_v_2) ?>" alt="<?php echo esc_attr($tp_portfolio_repeater_thumb_alt_v_2) ?>">
                                                </div>
                                                <div class="d-flex align-items-center flex-wrap gap-3 justify-content-between mt-20">
                                                    <div>
                                                        <?php if (!empty($item['tp_portfolio_repeater_link_switcher_v_2'])) : ?>
                                                            <h3 class="mb-2"> <a href="<?php echo esc_url($portfolio_link_v_2); ?>" rel="<?php echo esc_attr($portfolio_rel_v_2); ?>" target="<?php echo esc_attr($portfolio_target_v_2); ?>"> <?php echo tp_kses($item['tp_portfolio_repeater_btn_text_v_2']); ?></a></h3>
                                                        <?php endif; ?>
                                                        <div class="story__info">
                                                            <?php echo $item['tp_portfolio_repeater_categories_v_2']; ?>
                                                        </div>
                                                    </div>
                                                    <?php if (!empty($item['tp_portfolio_repeater_link_switcher_2_v_2'])) : ?>
                                                        <div>
                                                            <a class="btn-one" href="<?php echo esc_url($portfolio_link_2_v_2); ?>" rel="<?php echo esc_attr($portfolio_rel_2_v_2); ?>" target="<?php echo esc_attr($portfolio_target_2_v_2); ?>"> <?php echo tp_kses($item['tp_portfolio_repeater_btn_text_2_v_2']); ?>
                                                                <span>
                                                                    <i class="fa-regular fa-arrow-up-right arry1"></i>
                                                                    <i class="fa-regular fa-arrow-up-right arry2"></i>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="row g-5 align-items-star">
                                    <?php foreach ($settings['tp_portfolio_list_v_3'] as $key => $item) :
                                        // btn one
                                        if ('2' == $item['tp_portfolio_repeater_link_type_v_3']) {
                                            $portfolio_link_v_3 = get_permalink($item['tp_portfolio_repeater_page_link_v_3']);
                                            $portfolio_target_v_3 = '_self';
                                            $portfolio_rel_v_3 = 'nofollow';
                                        } else {
                                            $portfolio_link_v_3 = !empty($item['tp_portfolio_repeater_link_v_3']['url']) ? $item['tp_portfolio_repeater_link_v_3']['url'] : '';
                                            $portfolio_target_v_3 = !empty($item['tp_portfolio_repeater_link_v_3']['is_external']) ? '_blank' : '';
                                            $portfolio_rel_v_3 = !empty($item['tp_portfolio_repeater_link_v_3']['nofollow']) ? 'nofollow' : '';
                                        }

                                        // btn two
                                        if ('2' == $item['tp_portfolio_repeater_link_type_2_v_3']) {
                                            $portfolio_link_2_v_3 = get_permalink($item['tp_portfolio_repeater_page_link_2_v_3']);
                                            $portfolio_target_2_v_3 = '_self';
                                            $portfolio_rel_2_v_3 = 'nofollow';
                                        } else {
                                            $portfolio_link_2_v_3 = !empty($item['tp_portfolio_repeater_link_2_v_3']['url']) ? $item['tp_portfolio_repeater_link_2_v_3']['url'] : '';
                                            $portfolio_target_2_v_3 = !empty($item['tp_portfolio_repeater_link_2_v_3']['is_external']) ? '_blank' : '';
                                            $portfolio_rel_2_v_3 = !empty($item['tp_portfolio_repeater_link_2_v_3']['nofollow']) ? 'nofollow' : '';
                                        }


                                        if (!empty($item['tp_portfolio_repeater_thumb_v_3']['url'])) {
                                            $tp_portfolio_repeater_thumb_url_v_3 = !empty($item['tp_portfolio_repeater_thumb_v_3']['id']) ? wp_get_attachment_image_url($item['tp_portfolio_repeater_thumb_v_3']['id'], $item['tp_portfolio_repeater_thumb_v_3_size']) : $item['tp_portfolio_repeater_thumb_v_3']['url'];
                                            $tp_portfolio_repeater_thumb_alt_v_3 = get_post_meta($item["tp_portfolio_repeater_thumb_v_3"]["id"], "_wp_attachment_image_alt", true);
                                        }

                                    ?>
                                        <div class="col-lg-6">
                                            <div class="story__item <?php echo ($key == 2) ? 'mt-minus' : ''; ?>">
                                                <div class="image">
                                                    <img src="<?php echo esc_url($tp_portfolio_repeater_thumb_url_v_3) ?>" alt="<?php echo esc_attr($tp_portfolio_repeater_thumb_alt_v_3) ?>">
                                                </div>
                                                <div class="d-flex align-items-center flex-wrap gap-3 justify-content-between mt-20">
                                                    <div>
                                                        <?php if (!empty($item['tp_portfolio_repeater_link_switcher_v_3'])) : ?>
                                                            <h3 class="mb-2"> <a href="<?php echo esc_url($portfolio_link_v_3); ?>" rel="<?php echo esc_attr($portfolio_rel_v_3); ?>" target="<?php echo esc_attr($portfolio_target_v_3); ?>"> <?php echo tp_kses($item['tp_portfolio_repeater_btn_text_v_3']); ?></a></h3>
                                                        <?php endif; ?>
                                                        <div class="story__info">
                                                            <?php echo $item['tp_portfolio_repeater_categories_v_3']; ?>
                                                        </div>
                                                    </div>
                                                    <?php if (!empty($item['tp_portfolio_repeater_link_switcher_2_v_3'])) : ?>
                                                        <div>
                                                            <a class="btn-one" href="<?php echo esc_url($portfolio_link_2_v_3); ?>" rel="<?php echo esc_attr($portfolio_rel_2_v_3); ?>" target="<?php echo esc_attr($portfolio_target_2_v_3); ?>"> <?php echo tp_kses($item['tp_portfolio_repeater_btn_text_2_v_3']); ?>
                                                                <span>
                                                                    <i class="fa-regular fa-arrow-up-right arry1"></i>
                                                                    <i class="fa-regular fa-arrow-up-right arry2"></i>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="story__btn mt-80">
                        <?php if (!empty($settings['tp_portfolio_explore_more_link_switcher'])) : ?>
                            <?php if (!empty($link_explore_more)) : ?>
                                <a class="btn-one active" href="<?php echo esc_url($link_explore_more); ?>" rel="<?php echo esc_attr($rel_explore_more); ?>" target="<?php echo esc_attr($target_explore_more); ?>"> <?php echo tp_kses($settings['tp_portfolio_explore_more_btn_text']); ?>
                                    <span>
                                        <i class="fa-regular fa-arrow-up-right arry1"></i>
                                        <i class="fa-regular fa-arrow-up-right arry2"></i>
                                    </span>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="story__scrollbar">
                            <div class="position-relative">
                                <div class="swiper-scrollbar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Portfolio());
