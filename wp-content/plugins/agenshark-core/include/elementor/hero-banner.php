<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (! defined('ABSPATH'))
	exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Hero_Banner extends Widget_Base
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
		return 'hero-banner';
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
		return __('Hero Banner', 'tpcore');
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
		return ['hero', 'slider', 'header', 'banner'];
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

	public function get_tp_contact_form()
	{
		if (! class_exists('WPCF7')) {
			return;
		}
		$tp_cfa     = array();
		$tp_cf_args = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
		$tp_forms   = get_posts($tp_cf_args);
		$tp_cfa     = ['0' => esc_html__('Select Form', 'tpcore')];
		if ($tp_forms) {
			foreach ($tp_forms as $tp_form) {
				$tp_cfa[$tp_form->ID] = $tp_form->post_title;
			}
		} else {
			$tp_cfa[esc_html__('No contact form found', 'tpcore')] = 0;
		}
		return $tp_cfa;
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
			'tp_hero_banner_design_layout_section',
			[
				'label' => esc_html__('Design Layout', 'tpcore'),
			]
		);

		$this->add_control(
			'tp_hero_banner_design_layout',
			[
				'label' => esc_html__('Select Layout', 'tpcore'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'layout-1' => esc_html__('Layout 1', 'tpcore'),
					'layout-2' => esc_html__('Layout 2', 'tpcore'),
					'layout-3' => esc_html__('Layout 3', 'tpcore'),
					'layout-4' => esc_html__('Layout 4', 'tpcore'),
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		// content section
		$this->start_controls_section(
			'tp_hero_banner_content_section',
			[
				'label' => esc_html__('Title & Content', 'tpcore'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tp_hero_banner_sub_title',
			[
				'label' => esc_html__('Sub Title', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Add Your Sub Title Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your sub title', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_title',
			[
				'label' => esc_html__('Title', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Add Your Title Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your title', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_animated_title',
			[
				'label' => esc_html__('Animated Words', 'tpcore'),
				'description' => __('Seperate words with `,`'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Developer, Designer', 'tpcore'),
				'placeholder' => esc_html__('Enter', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_description',
			[
				'label' => esc_html__('Description', 'tpcore'),
				'description' => tp_get_allowed_html_desc('basic'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Add Your Description Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your description', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_url',
			[
				'label' => esc_html__('Hero URL', 'tpcore'),
				'type' => Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-4']
				]
			]
		);

		$this->add_control(
			'show_award_card',
			[
				'label' => esc_html__('Show Award Card', 'textdomain'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'textdomain'),
				'label_off' => esc_html__('Hide', 'textdomain'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'tp_hero_banner_award_title',
			[
				'label' => esc_html__('Award Title', 'tpcore'),
				'description' => tp_get_allowed_html_desc('basic'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Add Your Title Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your title', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1'],
					'show_award_card' => 'yes'
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_award_number',
			[
				'label' => esc_html__('Award Count', 'tpcore'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('50', 'tpcore'),
				'placeholder' => esc_html__('Enter your number', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1'],
					'show_award_card' => 'yes'
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_thumb',
			[
				'label' => esc_html__('Choose Thumbnail', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'tp_hero_banner_thumb',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_user_thumb',
			[
				'label' => esc_html__('Choose User Thumb', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'tp_hero_banner_user_thumb',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_voice_thumb',
			[
				'label' => esc_html__('Choose Voice Thumb', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-3', 'layout-4']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'tp_hero_banner_voice_thumb',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-3', 'layout-4']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_info_thumb',
			[
				'label' => esc_html__('Choose Info Thumb', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-3', 'layout-4']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'tp_hero_banner_info_thumb',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-3', 'layout-4']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_shape_thumb',
			[
				'label' => esc_html__('Choose Shape Thumb', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-3']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'tp_hero_banner_shape_thumb',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-3']
				]
			]
		);

		// btn one
		$this->add_control(
			'tp_hero_banner_link_switcher',
			[
				'label' => esc_html__('Button Switch', 'tpcore'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tpcore'),
				'label_off' => esc_html__('No', 'tpcore'),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_btn_text',
			[
				'label' => esc_html__('Button Text', 'tpcore'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Button Text', 'tpcore'),
				'title' => esc_html__('Enter button text', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_hero_banner_link_switcher' => 'yes',
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2']
				],
			]
		);

		$this->add_control(
			'tp_hero_banner_link_type',
			[
				'label' => esc_html__('Button URL Type', 'tpcore'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => 'Custom URL',
					'2' => 'Internal Page',
				],
				'default' => '1',
				'condition' => [
					'tp_hero_banner_link_switcher' => 'yes',
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_link',
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
					'tp_hero_banner_link_type' => '1',
					'tp_hero_banner_link_switcher' => 'yes',
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2']
				]
			]
		);


		$this->add_control(
			'tp_hero_banner_page_link',
			[
				'label' => esc_html__('Internal Page Link', 'tpcore'),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => tp_get_all_pages(),
				'condition' => [
					'tp_hero_banner_link_type' => '2',
					'tp_hero_banner_link_switcher' => 'yes',
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2']
				]
			]
		);


		// btn two
		$this->add_control(
			'tp_hero_banner_link_switcher_2',
			[
				'label' => esc_html__('Button Two Switch', 'tpcore'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tpcore'),
				'label_off' => esc_html__('No', 'tpcore'),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_btn_text_2',
			[
				'label' => esc_html__('Button Two Text', 'tpcore'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Button Text', 'tpcore'),
				'title' => esc_html__('Enter button text', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_hero_banner_link_switcher_2' => 'yes',
					'tp_hero_banner_design_layout' => 'layout-1'
				],
			]
		);

		$this->add_control(
			'tp_hero_banner_link_type_2',
			[
				'label' => esc_html__('Button URL Type', 'tpcore'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => 'Custom URL',
					'2' => 'Internal Page',
				],
				'default' => '1',
				'condition' => [
					'tp_hero_banner_link_switcher_2' => 'yes',
					'tp_hero_banner_design_layout' => 'layout-1'
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_link_2',
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
					'tp_hero_banner_link_type_2' => '1',
					'tp_hero_banner_link_switcher_2' => 'yes',
					'tp_hero_banner_design_layout' => 'layout-1'
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_page_link_2',
			[
				'label' => esc_html__('Internal Page Link', 'tpcore'),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => tp_get_all_pages(),
				'condition' => [
					'tp_hero_banner_link_type_2' => '2',
					'tp_hero_banner_link_switcher_2' => 'yes',
					'tp_hero_banner_design_layout' => 'layout-1'
				]
			]
		);

		$this->end_controls_section();


		// marquee repeater - 1
		$this->start_controls_section(
			'tp_hero_banner_marquee_1_content_section',
			[
				'label' => esc_html__('Marquee List - 1 ', 'tpcore'),
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_marquee_title',
			[
				'label' => esc_html__('Title', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Add Your Title Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your title', 'tpcore'),
				'label_block' => true,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tp_hero_banner_marquee_1_thumb',
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
				'name' => 'tp_hero_banner_marquee_1_thumb',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'tp_hero_banner_marquee_1_list',
			[
				'label' => esc_html__('Repeater List', 'tpcore'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();


		// marquee repeater - 2
		$this->start_controls_section(
			'tp_hero_banner_marquee_2_content_section',
			[
				'label' => esc_html__('Marquee List - 2 ', 'tpcore'),
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-1', 'layout-2']
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tp_hero_banner_marquee_2_thumb',
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
				'name' => 'tp_hero_banner_marquee_2_thumb',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'tp_hero_banner_marquee_2_list',
			[
				'label' => esc_html__('Repeater List', 'tpcore'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();

		// content section
		$this->start_controls_section(
			'tp_hero_banner_video_content_section',
			[
				'label' => esc_html__('Video', 'tpcore'),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-2']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_video_thumb',
			[
				'label' => esc_html__('Choose Thumbnail', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-2']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'tp_hero_banner_video_thumb',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-2']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_video_link_switcher',
			[
				'label' => esc_html__('Button Switch', 'tpcore'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tpcore'),
				'label_off' => esc_html__('No', 'tpcore'),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-2']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_video_btn_text',
			[
				'label' => esc_html__('Button Text', 'tpcore'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Button Text', 'tpcore'),
				'title' => esc_html__('Enter button text', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_hero_banner_video_link_switcher' => 'yes',
					'tp_hero_banner_design_layout' => ['layout-2']
				],
			]
		);

		$this->add_control(
			'tp_hero_banner_video_link_type',
			[
				'label' => esc_html__('Button URL Type', 'tpcore'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => 'Custom URL',
					'2' => 'Internal Page',
				],
				'default' => '1',
				'condition' => [
					'tp_hero_banner_video_link_switcher' => 'yes',
					'tp_hero_banner_design_layout' => ['layout-2']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_video_link',
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
					'tp_hero_banner_video_link_type' => '1',
					'tp_hero_banner_video_link_switcher' => 'yes',
					'tp_hero_banner_design_layout' => ['layout-2']
				]
			]
		);

		$this->add_control(
			'tp_hero_banner_video_page_link',
			[
				'label' => esc_html__('Internal Page Link', 'tpcore'),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => tp_get_all_pages(),
				'condition' => [
					'tp_hero_banner_video_link_type' => '2',
					'tp_hero_banner_video_link_switcher' => 'yes',
					'tp_hero_banner_design_layout' => ['layout-2']
				]
			]
		);


		$this->end_controls_section();


		// moving objects
		$this->start_controls_section(
			'tp_hero_banner_marquee_obj_content_section',
			[
				'label' => esc_html__('Moving Objects', 'tpcore'),
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-4']
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tp_hero_banner_marquee_obj_title',
			[
				'label' => esc_html__('Title', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Add Your Title Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your title', 'tpcore'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tp_hero_banner_marquee_obj_url',
			[
				'label' => esc_html__('Text URL', 'tpcore'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);


		$repeater->add_control(
			'tp_hero_banner_marquee_obj_thumb',
			[
				'label' => esc_html__('Choose Icon', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'tp_hero_banner_marquee_obj_thumb',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'tp_hero_banner_marquee_obj_list',
			[
				'label' => esc_html__('Repeater List', 'tpcore'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tp_hero_banner_marquee_obj_title' => esc_html__('Web Development', 'tpcore'),
					],
					[
						'tp_hero_banner_marquee_obj_title' => esc_html__('Graphic Design', 'tpcore')
					],
					[
						'tp_hero_banner_marquee_obj_title' => esc_html__('Product Design', 'tpcore')
					],
					[
						'tp_hero_banner_marquee_obj_title' => esc_html__('UI/UX Design', 'tpcore')
					]
				],
				'title_field' => '{{{ tp_hero_banner_marquee_obj_title }}}',
			]
		);

		$this->end_controls_section();


		// moving objects
		$this->start_controls_section(
			'tp_hero_banner_marquee_obj_content_section_2',
			[
				'label' => esc_html__('Moving Objects - 2', 'tpcore'),
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-4']
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tp_hero_banner_marquee_obj_title_2',
			[
				'label' => esc_html__('Title', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Add Your Title Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your title', 'tpcore'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tp_hero_banner_marquee_obj_url_2',
			[
				'label' => esc_html__('Text URL', 'tpcore'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);


		$repeater->add_control(
			'tp_hero_banner_marquee_obj_thumb_2',
			[
				'label' => esc_html__('Choose Icon', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'tp_hero_banner_marquee_obj_thumb_2',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'tp_hero_banner_marquee_obj_list_2',
			[
				'label' => esc_html__('Repeater List', 'tpcore'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tp_hero_banner_marquee_obj_title_2' => esc_html__('Web Development', 'tpcore'),
					],
					[
						'tp_hero_banner_marquee_obj_title_2' => esc_html__('Graphic Design', 'tpcore')
					],
					[
						'tp_hero_banner_marquee_obj_title_2' => esc_html__('Product Design', 'tpcore')
					],
					[
						'tp_hero_banner_marquee_obj_title_2' => esc_html__('UI/UX Design', 'tpcore')
					]
				],
				'title_field' => '{{{ tp_hero_banner_marquee_obj_title_2 }}}',
			]
		);

		$this->end_controls_section();


		// moving objects 3
		$this->start_controls_section(
			'tp_hero_banner_marquee_obj_content_section_3',
			[
				'label' => esc_html__('Moving Objects - 3', 'tpcore'),
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-4']
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tp_hero_banner_marquee_obj_title_3',
			[
				'label' => esc_html__('Title', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Add Your Title Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your title', 'tpcore'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tp_hero_banner_marquee_obj_url_3',
			[
				'label' => esc_html__('Text URL', 'tpcore'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);


		$repeater->add_control(
			'tp_hero_banner_marquee_obj_thumb_3',
			[
				'label' => esc_html__('Choose Icon', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'tp_hero_banner_marquee_obj_thumb_3',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'tp_hero_banner_marquee_obj_list_3',
			[
				'label' => esc_html__('Repeater List', 'tpcore'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tp_hero_banner_marquee_obj_title_3' => esc_html__('Web Development', 'tpcore'),
					],
					[
						'tp_hero_banner_marquee_obj_title_3' => esc_html__('Graphic Design', 'tpcore')
					],
					[
						'tp_hero_banner_marquee_obj_title_3' => esc_html__('Product Design', 'tpcore')
					],
					[
						'tp_hero_banner_marquee_obj_title_3' => esc_html__('UI/UX Design', 'tpcore')
					]
				],
				'title_field' => '{{{ tp_hero_banner_marquee_obj_title_3 }}}',
			]
		);

		$this->end_controls_section();


		// moving objects 4
		$this->start_controls_section(
			'tp_hero_banner_marquee_obj_content_section_4',
			[
				'label' => esc_html__('Moving Objects - 4', 'tpcore'),
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-4']
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tp_hero_banner_marquee_obj_title_4',
			[
				'label' => esc_html__('Title', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Add Your Title Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your title', 'tpcore'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tp_hero_banner_marquee_obj_url_4',
			[
				'label' => esc_html__('Text URL', 'tpcore'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);


		$repeater->add_control(
			'tp_hero_banner_marquee_obj_thumb_4',
			[
				'label' => esc_html__('Choose Icon', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'tp_hero_banner_marquee_obj_thumb_4',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'tp_hero_banner_marquee_obj_list_4',
			[
				'label' => esc_html__('Repeater List', 'tpcore'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tp_hero_banner_marquee_obj_title_4' => esc_html__('Web Development', 'tpcore'),
					],
					[
						'tp_hero_banner_marquee_obj_title_4' => esc_html__('Graphic Design', 'tpcore')
					],
					[
						'tp_hero_banner_marquee_obj_title_4' => esc_html__('Product Design', 'tpcore')
					],
					[
						'tp_hero_banner_marquee_obj_title_4' => esc_html__('UI/UX Design', 'tpcore')
					]
				],
				'title_field' => '{{{ tp_hero_banner_marquee_obj_title_4 }}}',
			]
		);

		$this->end_controls_section();

		// contact 
		$this->start_controls_section(
			'tpcore_contact',
			[
				'label' => esc_html__('Contact Form', 'tpcore'),
				'condition' => [
					'tp_hero_banner_design_layout' => ['layout-3']
				]
			]
		);

		$this->add_control(
			'tpcore_select_contact_form',
			[
				'label' => esc_html__('Select Form', 'tpcore'),
				'type' => Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->get_tp_contact_form(),
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
		<?php if ($settings['tp_hero_banner_design_layout'] == 'layout-4') :

			// bg thumb
			if (! empty($settings['tp_hero_banner_thumb']['url'])) {
				$tp_hero_banner_thumb_url = ! empty($settings['tp_hero_banner_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_thumb']['id'], $settings['tp_hero_banner_thumb_size']) : $settings['tp_hero_banner_thumb']['url'];
				$tp_hero_banner_thumb_alt = get_post_meta($settings["tp_hero_banner_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// user thumb
			if (! empty($settings['tp_hero_banner_user_thumb']['url'])) {
				$tp_hero_banner_user_thumb_url = ! empty($settings['tp_hero_banner_user_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_user_thumb']['id'], $settings['tp_hero_banner_user_thumb_size']) : $settings['tp_hero_banner_user_thumb']['url'];
				$tp_hero_banner_user_thumb_alt = get_post_meta($settings["tp_hero_banner_user_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// voice thumb
			if (! empty($settings['tp_hero_banner_voice_thumb']['url'])) {
				$tp_hero_banner_voice_thumb_url = ! empty($settings['tp_hero_banner_voice_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_voice_thumb']['id'], $settings['tp_hero_banner_voice_thumb_size']) : $settings['tp_hero_banner_voice_thumb']['url'];
				$tp_hero_banner_voice_thumb_alt = get_post_meta($settings["tp_hero_banner_voice_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// info thumb
			if (! empty($settings['tp_hero_banner_info_thumb']['url'])) {
				$tp_hero_banner_info_thumb_url = ! empty($settings['tp_hero_banner_info_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_info_thumb']['id'], $settings['tp_hero_banner_info_thumb_size']) : $settings['tp_hero_banner_info_thumb']['url'];
				$tp_hero_banner_info_thumb_alt = get_post_meta($settings["tp_hero_banner_info_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			if (! empty($settings['tp_hero_banner_url']['url'])) {
				$this->add_link_attributes('tp_hero_banner_url', $settings['tp_hero_banner_url']);
			}


		?>

			<section class="banner-four-area bg-image" data-background="<?php echo esc_url($tp_hero_banner_thumb_url); ?>">
				<div class="banner-four__line">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/banner-four-arrow.png" alt="image">
				</div>
				<div class="container">
					<div class="banner-four__content mb-50">
						<?php if (! empty($settings['tp_hero_banner_sub_title'])) : ?>
							<h4><span class="title-dot"></span> <?php echo tp_kses($settings['tp_hero_banner_sub_title']); ?> </h4>
						<?php endif; ?>
						<div class="d-flex gap-3 flex-wrap align-items-center justify-content-between">
							<?php if (! empty($settings['tp_hero_banner_title'])) : ?>
								<h1> <?php echo tp_kses($settings['tp_hero_banner_title']); ?> </h1>
							<?php endif; ?>
							<?php if (! empty($settings['tp_hero_banner_description'])) : ?>
								<p> <?php echo tp_kses($settings['tp_hero_banner_description']); ?> </p>
							<?php endif; ?>
						</div>
					</div>

					<div class="banner-four__image">
						<a <?php $this->print_render_attribute_string('tp_hero_banner_url'); ?> class="text-btn">
							<img class="btn-circle animation__rotate" src="<?php echo esc_url($tp_hero_banner_user_thumb_url); ?>"
								alt="<?php echo esc_attr($tp_hero_banner_user_thumb_alt); ?>">
							<img class="btn-arry" src="<?php echo esc_url($tp_hero_banner_voice_thumb_url); ?>"
								alt="<?php echo esc_attr($tp_hero_banner_voice_thumb_alt); ?>">
						</a>
						<img class="w-100" src="<?php echo esc_url($tp_hero_banner_info_thumb_url); ?>"
							alt="<?php echo esc_attr($tp_hero_banner_info_thumb_alt); ?>">
					</div>

				</div>
			</section>
			<section class="marquee-four-area pt-100">
				<div class="marquee-light-area marquee-revers-area">
					<div class="marquee__wrp">
						<div class="marquee__slide marquee-revers">
							<div class="marquee-two__item-wrp">
								<?php foreach ($settings['tp_hero_banner_marquee_obj_list'] as $item) :
									if (! empty($item['tp_hero_banner_marquee_obj_thumb']['url'])) {
										$tp_hero_banner_marquee_obj_thumb_url = ! empty($item['tp_hero_banner_marquee_obj_thumb']['id']) ? wp_get_attachment_image_url($item['tp_hero_banner_marquee_obj_thumb']['id'], $item['tp_hero_banner_marquee_obj_thumb_size']) : $item['tp_hero_banner_marquee_obj_thumb']['url'];
										$tp_hero_banner_marquee_obj_thumb_alt = get_post_meta($item["tp_hero_banner_marquee_obj_thumb"]["id"], "_wp_attachment_image_alt", true);
									}

								?>
									<div class="marquee-light__item">
										<h4>
											<a class="text-white" href="<?php echo $item['tp_hero_banner_marquee_obj_url']['url'] ?>">
												<img class="mr-25 ml-35"
													src=" <?php echo esc_url($tp_hero_banner_marquee_obj_thumb_url) ?>"
													alt="<?php echo esc_attr($tp_hero_banner_marquee_obj_thumb_alt) ?>">

												<?php echo $item['tp_hero_banner_marquee_obj_title'] ?> </a>
										</h4>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="marquee-two__item-wrp">
								<?php foreach ($settings['tp_hero_banner_marquee_obj_list_2'] as $item) :
									if (! empty($item['tp_hero_banner_marquee_obj_thumb_2']['url'])) {
										$tp_hero_banner_marquee_obj_thumb_url_2 = ! empty($item['tp_hero_banner_marquee_obj_thumb_2']['id']) ? wp_get_attachment_image_url($item['tp_hero_banner_marquee_obj_thumb_2']['id'], $item['tp_hero_banner_marquee_obj_thumb_2_size']) : $item['tp_hero_banner_marquee_obj_thumb_2']['url'];
										$tp_hero_banner_marquee_obj_thumb_alt_2 = get_post_meta($item["tp_hero_banner_marquee_obj_thumb_2"]["id"], "_wp_attachment_image_alt", true);
									}

								?>
									<div class="marquee-light__item">
										<h4>
											<a class="text-white" href="<?php echo $item['tp_hero_banner_marquee_obj_url_2']['url'] ?>">
												<img class="mr-25 ml-35"
													src=" <?php echo esc_url($tp_hero_banner_marquee_obj_thumb_url_2) ?>"
													alt="<?php echo esc_attr($tp_hero_banner_marquee_obj_thumb_alt_2) ?>">
												<?php echo $item['tp_hero_banner_marquee_obj_title_2'] ?> </a>
										</h4>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="marquee-light-area">
					<div class="marquee__wrp">
						<div class="marquee__slide">
							<div class="marquee-two__item-wrp">
								<?php foreach ($settings['tp_hero_banner_marquee_obj_list_3'] as $item) :
									if (! empty($item['tp_hero_banner_marquee_obj_thumb_3']['url'])) {
										$tp_hero_banner_marquee_obj_thumb_url_3 = ! empty($item['tp_hero_banner_marquee_obj_thumb_3']['id']) ? wp_get_attachment_image_url($item['tp_hero_banner_marquee_obj_thumb_3']['id'], $item['tp_hero_banner_marquee_obj_thumb_3_size']) : $item['tp_hero_banner_marquee_obj_thumb_3']['url'];
										$tp_hero_banner_marquee_obj_thumb_alt_3 = get_post_meta($item["tp_hero_banner_marquee_obj_thumb_3"]["id"], "_wp_attachment_image_alt", true);
									}

								?>
									<div class="marquee-light__item">
										<h4>
											<a class="text-white" href="<?php echo $item['tp_hero_banner_marquee_obj_url_3']['url'] ?>">
												<img class="mr-25 ml-35"
													src=" <?php echo esc_url($tp_hero_banner_marquee_obj_thumb_url_3) ?>"
													alt="<?php echo esc_attr($tp_hero_banner_marquee_obj_thumb_alt_3) ?>">

												<?php echo $item['tp_hero_banner_marquee_obj_title_3'] ?></a>
										</h4>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="marquee-two__item-wrp">
								<?php foreach ($settings['tp_hero_banner_marquee_obj_list_4'] as $item) :
									if (! empty($item['tp_hero_banner_marquee_obj_thumb_4']['url'])) {
										$tp_hero_banner_marquee_obj_thumb_url_4 = ! empty($item['tp_hero_banner_marquee_obj_thumb_4']['id']) ? wp_get_attachment_image_url($item['tp_hero_banner_marquee_obj_thumb_4']['id'], $item['tp_hero_banner_marquee_obj_thumb_4_size']) : $item['tp_hero_banner_marquee_obj_thumb_4']['url'];
										$tp_hero_banner_marquee_obj_thumb_alt_4 = get_post_meta($item["tp_hero_banner_marquee_obj_thumb_4"]["id"], "_wp_attachment_image_alt", true);
									}

								?>
									<div class="marquee-light__item">
										<h4>
											<a class="text-white" href="<?php echo $item['tp_hero_banner_marquee_obj_url_4']['url'] ?>">
												<img class="mr-25 ml-35"
													src=" <?php echo esc_url($tp_hero_banner_marquee_obj_thumb_url_4) ?>"
													alt="<?php echo esc_attr($tp_hero_banner_marquee_obj_thumb_alt_4) ?>">

												<?php echo $item['tp_hero_banner_marquee_obj_title_4'] ?></a>
										</h4>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</section>


		<?php elseif ($settings['tp_hero_banner_design_layout'] == 'layout-3') :

			// bg thumb
			if (! empty($settings['tp_hero_banner_thumb']['url'])) {
				$tp_hero_banner_thumb_url = ! empty($settings['tp_hero_banner_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_thumb']['id'], $settings['tp_hero_banner_thumb_size']) : $settings['tp_hero_banner_thumb']['url'];
				$tp_hero_banner_thumb_alt = get_post_meta($settings["tp_hero_banner_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// user thumb
			if (! empty($settings['tp_hero_banner_user_thumb']['url'])) {
				$tp_hero_banner_user_thumb_url = ! empty($settings['tp_hero_banner_user_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_user_thumb']['id'], $settings['tp_hero_banner_user_thumb_size']) : $settings['tp_hero_banner_user_thumb']['url'];
				$tp_hero_banner_user_thumb_alt = get_post_meta($settings["tp_hero_banner_user_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// voice thumb
			if (! empty($settings['tp_hero_banner_voice_thumb']['url'])) {
				$tp_hero_banner_voice_thumb_url = ! empty($settings['tp_hero_banner_voice_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_voice_thumb']['id'], $settings['tp_hero_banner_voice_thumb_size']) : $settings['tp_hero_banner_voice_thumb']['url'];
				$tp_hero_banner_voice_thumb_alt = get_post_meta($settings["tp_hero_banner_voice_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// info thumb
			if (! empty($settings['tp_hero_banner_info_thumb']['url'])) {
				$tp_hero_banner_info_thumb_url = ! empty($settings['tp_hero_banner_info_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_info_thumb']['id'], $settings['tp_hero_banner_info_thumb_size']) : $settings['tp_hero_banner_info_thumb']['url'];
				$tp_hero_banner_info_thumb_alt = get_post_meta($settings["tp_hero_banner_info_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// shape thumb
			if (! empty($settings['tp_hero_banner_shape_thumb']['url'])) {
				$tp_hero_banner_shape_thumb_url = ! empty($settings['tp_hero_banner_shape_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_shape_thumb']['id'], $settings['tp_hero_banner_shape_thumb_size']) : $settings['tp_hero_banner_shape_thumb']['url'];
				$tp_hero_banner_shape_thumb_alt = get_post_meta($settings["tp_hero_banner_shape_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

		?>
			<section class="banner-three-area paralax__animation">
				<div class="container">
					<div class="banner-three__content">
						<?php if (! empty($settings['tp_hero_banner_sub_title'])) : ?>
							<span class="wow splt-txt" data-splitting> <?php echo $settings['tp_hero_banner_sub_title']; ?> <img
									src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/roket.png" alt="icon"></span>
						<?php endif; ?>
						<?php if (! empty($settings['tp_hero_banner_title'])) : ?>
							<h1 class="wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
								<?php echo $settings['tp_hero_banner_title']; ?>
							</h1>
						<?php endif; ?>
						<?php if (! empty($settings['tp_hero_banner_description'])) : ?>
							<p class="wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
								<?php echo $settings['tp_hero_banner_description']; ?>
							</p>
						<?php endif; ?>

						<div class="input-feild wow fadeInUp" data-wow-delay="700ms" data-wow-duration="1500ms">
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M8 0C3.5888 0 0 3.5888 0 8C0 12.4112 3.5888 16 8 16C12.4112 16 16 12.4112 16 8C16 3.5888 12.4128 0 8 0ZM14.7395 7.384H11.8723C11.7683 5.4192 11.1713 3.4192 10.1473 1.5856C12.6433 2.4224 14.4931 4.6736 14.7395 7.384ZM8.50586 1.25599C9.77306 3.14879 10.5186 5.2912 10.6418 7.384H5.36172C5.48492 5.2912 6.22889 3.14879 7.49609 1.25599C7.66249 1.24319 7.8304 1.2304 8 1.2304C8.1696 1.2304 8.33786 1.24479 8.50586 1.25599ZM5.85469 1.5856C4.83069 3.4208 4.23369 5.4192 4.12969 7.3856H1.2625C1.5089 4.6736 3.35869 2.4224 5.85469 1.5856ZM1.2625 8.616H4.12969C4.23369 10.5808 4.83069 12.5792 5.85469 14.416C3.35869 13.5776 1.5089 11.3264 1.2625 8.616ZM7.49609 14.744C6.22889 12.8496 5.48332 10.7088 5.36172 8.616H10.6418C10.5186 10.7104 9.77466 12.8512 8.50586 14.744C8.33946 14.7568 8.17116 14.7696 8.00156 14.7696C7.83196 14.7696 7.66249 14.7568 7.49609 14.744ZM10.1473 14.4144C11.1713 12.5792 11.7683 10.5808 11.8723 8.616H14.7395C14.4931 11.3264 12.6433 13.5776 10.1473 14.4144Z"
									fill="#06120E" fill-opacity="0.7" />
							</svg>
							<?php if (! empty($settings['tpcore_select_contact_form'])) : ?>
								<?php echo do_shortcode('[contact-form-7  id="' . $settings['tpcore_select_contact_form'] . '"]'); ?>
							<?php else : ?>
								<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore') . '</p></div>'; ?>
							<?php endif; ?>
						</div>
					</div>

					<div class="banner-three__image">

						<img class="w-100 wow bounceInRight" data-wow-delay="400ms" data-wow-duration="1000ms"
							src="<?php echo esc_url($tp_hero_banner_thumb_url); ?>"
							alt="<?php echo esc_attr($tp_hero_banner_thumb_alt); ?>">

						<img class="here-bg" src="<?php echo esc_url($tp_hero_banner_user_thumb_url); ?>"
							alt="<?php echo esc_attr($tp_hero_banner_user_thumb_alt) ?>">

						<img class="kit1" data-depth="0.03" src="<?php echo esc_url($tp_hero_banner_voice_thumb_url); ?>"
							alt="<?php echo esc_attr($tp_hero_banner_voice_thumb_alt) ?>">

						<img class="kit2" data-depth="0.1" src="<?php echo esc_url($tp_hero_banner_info_thumb_url); ?>"
							alt="<?php echo esc_attr($tp_hero_banner_info_thumb_alt) ?>">

						<img class="kit3" data-depth="0.05" src="<?php echo esc_url($tp_hero_banner_shape_thumb_url); ?>"
							alt="<?php echo esc_attr($tp_hero_banner_shape_thumb_alt) ?>">
					</div>

				</div>
			</section>


		<?php elseif ($settings['tp_hero_banner_design_layout'] == 'layout-2') :

			// bg thumb
			if (! empty($settings['tp_hero_banner_thumb']['url'])) {
				$tp_hero_banner_thumb_url = ! empty($settings['tp_hero_banner_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_thumb']['id'], $settings['tp_hero_banner_thumb_size']) : $settings['tp_hero_banner_thumb']['url'];
				$tp_hero_banner_thumb_alt = get_post_meta($settings["tp_hero_banner_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// btn one
			if ('2' == $settings['tp_hero_banner_link_type']) {
				$link   = get_permalink($settings['tp_hero_banner_page_link']);
				$target = '_self';
				$rel    = 'nofollow';
			} else {
				$link   = ! empty($settings['tp_hero_banner_link']['url']) ? $settings['tp_hero_banner_link']['url'] : '';
				$target = ! empty($settings['tp_hero_banner_link']['is_external']) ? '_blank' : '';
				$rel    = ! empty($settings['tp_hero_banner_link']['nofollow']) ? 'nofollow' : '';
			}

			// user thumb
			if (! empty($settings['tp_hero_banner_user_thumb']['url'])) {
				$tp_hero_banner_user_thumb_url = ! empty($settings['tp_hero_banner_user_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_user_thumb']['id'], $settings['tp_hero_banner_user_thumb_size']) : $settings['tp_hero_banner_user_thumb']['url'];
				$tp_hero_banner_user_thumb_alt = get_post_meta($settings["tp_hero_banner_user_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// video thumb
			if (! empty($settings['tp_hero_banner_video_thumb']['url'])) {
				$tp_hero_banner_video_thumb_url = ! empty($settings['tp_hero_banner_video_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_video_thumb']['id'], $settings['tp_hero_banner_video_thumb_size']) : $settings['tp_hero_banner_video_thumb']['url'];
				$tp_hero_banner_video_thumb_alt = get_post_meta($settings["tp_hero_banner_video_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// video btn 
			if ('2' == $settings['tp_hero_banner_video_link_type']) {
				$link_video   = get_permalink($settings['tp_hero_banner_video_page_link']);
				$target_video = '_self';
				$rel_video    = 'nofollow';
			} else {
				$link_video   = ! empty($settings['tp_hero_banner_video_link']['url']) ? $settings['tp_hero_banner_video_link']['url'] : '';
				$target_video = ! empty($settings['tp_hero_banner_video_link']['is_external']) ? '_blank' : '';
				$rel_video    = ! empty($settings['tp_hero_banner_video_link']['nofollow']) ? 'nofollow' : '';
			}

		?>
			<section class="banner-two-area bg-image" data-background="<?php echo esc_url($tp_hero_banner_thumb_url) ?>">
				<div class="container">
					<div class="banner-two__content">
						<?php if (! empty($settings['tp_hero_banner_title'])) : ?>
							<h1> <?php echo $settings['tp_hero_banner_title']; ?> </h1>
						<?php endif; ?>
						<div class="d-flex align-items-center justify-content-between flex-wrap gap-4 mt-45">
							<?php if (! empty($settings['tp_hero_banner_link_switcher'])) : ?>
								<a href="<?php echo esc_url($link); ?>" class="btn-three" rel="<?php echo esc_attr($rel); ?>"
									target="<?php echo esc_attr($target); ?>">
									<?php echo tp_kses($settings['tp_hero_banner_btn_text']); ?> <i
										class="fa-regular fa-arrow-right"></i></a>
							<?php endif; ?>
							<?php if (! empty($settings['tp_hero_banner_description'])) : ?>
								<p> <?php echo tp_kses($settings['tp_hero_banner_description']); ?> </p>
							<?php endif; ?>
						</div>
					</div>
					<div class="banner-two__user mt-45">
						<img src=" <?php echo esc_url($tp_hero_banner_user_thumb_url) ?>"
							alt="<?php echo esc_attr($tp_hero_banner_user_thumb_alt) ?>">
						<?php if (! empty($settings['tp_hero_banner_sub_title'])) : ?>
							<span class="ml-10"> <?php echo tp_kses($settings['tp_hero_banner_sub_title']); ?> </span>
						<?php endif; ?>
					</div>
				</div>
			</section>
			<div class="banner-video">
				<div class="container">
					<div class="banner-video__image image">
						<img src="<?php echo esc_url($tp_hero_banner_video_thumb_url) ?>"
							alt="<?php echo esc_attr($tp_hero_banner_video_thumb_alt) ?>">
						<?php if (! empty($settings['tp_hero_banner_video_link_switcher'])) : ?>
							<div class="banner-video__btn">
								<div class="video-btn video-pulse">
									<a class="video-popup" href="<?php echo esc_url($link_video); ?>"
										rel="<?php echo esc_attr($rel_video); ?>" target="<?php echo esc_attr($target_video); ?>">
										<?php echo tp_kses($settings['tp_hero_banner_video_btn_text']); ?> <i
											class="fa-solid fa-play"></i></a>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="brand-area pt-80 pb-120">
				<div class="container">
					<div class="marquee-area">
						<div class="marquee__wrp">
							<div class="marquee__slide brand__slider">
								<div class="marquee__item-wrp">
									<?php foreach ($settings['tp_hero_banner_marquee_1_list'] as $item) :
										if (! empty($item['tp_hero_banner_marquee_1_thumb']['url'])) {
											$tp_hero_banner_marquee_1_thumb_url = ! empty($item['tp_hero_banner_marquee_1_thumb']['id']) ? wp_get_attachment_image_url($item['tp_hero_banner_marquee_1_thumb']['id'], $item['tp_hero_banner_marquee_1_thumb_size']) : $item['tp_hero_banner_marquee_1_thumb']['url'];
											$tp_hero_banner_marquee_1_thumb_alt = get_post_meta($item["tp_hero_banner_marquee_1_thumb"]["id"], "_wp_attachment_image_alt", true);
										}
									?>
										<div class="marquee__item">
											<img src=" <?php echo esc_url($tp_hero_banner_marquee_1_thumb_url) ?>"
												alt="<?php echo esc_attr($tp_hero_banner_marquee_1_thumb_alt) ?>">
										</div>
									<?php endforeach; ?>
								</div>
								<div class="marquee__item-wrp">
									<?php foreach ($settings['tp_hero_banner_marquee_2_list'] as $item) :
										if (! empty($item['tp_hero_banner_marquee_2_thumb']['url'])) {
											$tp_hero_banner_marquee_2_thumb_url = ! empty($item['tp_hero_banner_marquee_2_thumb']['id']) ? wp_get_attachment_image_url($item['tp_hero_banner_marquee_2_thumb']['id'], $item['tp_hero_banner_marquee_2_thumb_size']) : $item['tp_hero_banner_marquee_2_thumb']['url'];
											$tp_hero_banner_marquee_2_thumb_alt = get_post_meta($item["tp_hero_banner_marquee_2_thumb"]["id"], "_wp_attachment_image_alt", true);
										}
									?>
										<div class="marquee__item">
											<img src=" <?php echo esc_url($tp_hero_banner_marquee_2_thumb_url) ?>"
												alt="<?php echo esc_attr($tp_hero_banner_marquee_2_thumb_alt) ?>">
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>



		<?php else :
			$this->add_render_attribute('tp_hero_banner_title_attr', 'class', 'tp-section-title');
			$this->add_render_attribute('tp_hero_banner_sub_title_attr', 'class', 'tp-section-title-pre');

			// bg thumb
			if (! empty($settings['tp_hero_banner_thumb']['url'])) {
				$tp_hero_banner_thumb_url = ! empty($settings['tp_hero_banner_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_thumb']['id'], $settings['tp_hero_banner_thumb_size']) : $settings['tp_hero_banner_thumb']['url'];
				$tp_hero_banner_thumb_alt = get_post_meta($settings["tp_hero_banner_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// user thumb
			if (! empty($settings['tp_hero_banner_user_thumb']['url'])) {
				$tp_hero_banner_user_thumb_url = ! empty($settings['tp_hero_banner_user_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_user_thumb']['id'], $settings['tp_hero_banner_user_thumb_size']) : $settings['tp_hero_banner_user_thumb']['url'];
				$tp_hero_banner_user_thumb_alt = get_post_meta($settings["tp_hero_banner_user_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// voice thumb
			if (! empty($settings['tp_hero_banner_voice_thumb']['url'])) {
				$tp_hero_banner_voice_thumb_url = ! empty($settings['tp_hero_banner_voice_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_voice_thumb']['id'], $settings['tp_hero_banner_voice_thumb_size']) : $settings['tp_hero_banner_voice_thumb']['url'];
				$tp_hero_banner_voice_thumb_alt = get_post_meta($settings["tp_hero_banner_voice_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// info thumb
			if (! empty($settings['tp_hero_banner_info_thumb']['url'])) {
				$tp_hero_banner_info_thumb_url = ! empty($settings['tp_hero_banner_info_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_info_thumb']['id'], $settings['tp_hero_banner_info_thumb_size']) : $settings['tp_hero_banner_info_thumb']['url'];
				$tp_hero_banner_info_thumb_alt = get_post_meta($settings["tp_hero_banner_info_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// btn one
			if ('2' == $settings['tp_hero_banner_link_type']) {
				$link   = get_permalink($settings['tp_hero_banner_page_link']);
				$target = '_self';
				$rel    = 'nofollow';
			} else {
				$link   = ! empty($settings['tp_hero_banner_link']['url']) ? $settings['tp_hero_banner_link']['url'] : '';
				$target = ! empty($settings['tp_hero_banner_link']['is_external']) ? '_blank' : '';
				$rel    = ! empty($settings['tp_hero_banner_link']['nofollow']) ? 'nofollow' : '';
			}

			// btn two
			if ('2' == $settings['tp_hero_banner_link_type_2']) {
				$link_2   = get_permalink($settings['tp_hero_banner_page_link_2']);
				$target_2 = '_self';
				$rel_2    = 'nofollow';
			} else {
				$link_2   = ! empty($settings['tp_hero_banner_link_2']['url']) ? $settings['tp_hero_banner_link_2']['url'] : '';
				$target_2 = ! empty($settings['tp_hero_banner_link_2']['is_external']) ? '_blank' : '';
				$rel_2    = ! empty($settings['tp_hero_banner_link_2']['nofollow']) ? 'nofollow' : '';
			}

		?>

			<section class="agenshark-wrap banner-area bg-image"
				data-background="<?php echo esc_url($tp_hero_banner_thumb_url) ?>">

				<?php if ($settings['show_award_card'] == 'yes'): ?>
					<div class="banner__info">
						<div class="content">
							<img src=" <?php echo esc_url($tp_hero_banner_user_thumb_url) ?>"
								alt="<?php echo esc_attr($tp_hero_banner_user_thumb_alt) ?>">
							<h3 class="mt-15 mb-1"><span class="count"><?php echo $settings['tp_hero_banner_award_number']; ?></span>+
							</h3>
							<?php if (! empty($settings['tp_hero_banner_award_title'])) : ?>
								<h6> <?php echo $settings['tp_hero_banner_award_title']; ?> </h6>
							<?php endif; ?>
						</div>
						<div class="image mt-10">
							<img src=" <?php echo esc_url($tp_hero_banner_voice_thumb_url) ?>"
								alt="<?php echo esc_attr($tp_hero_banner_voice_thumb_alt) ?>">
						</div>
						<img class="line" src=" <?php echo esc_url($tp_hero_banner_info_thumb_url) ?>"
							alt="<?php echo esc_attr($tp_hero_banner_info_thumb_alt) ?>">
					</div>
				<?php endif; ?>

				<div class="container">
					<div class="banner__content pb-120">
						<?php if (! empty($settings['tp_hero_banner_sub_title'])) : ?>
							<h5 class="splt-txt wow" data-splitting> <?php echo tp_kses($settings['tp_hero_banner_sub_title']); ?>
							</h5>
						<?php endif; ?>
						<?php if (! empty($settings['tp_hero_banner_title'])) : ?>
							<h1> <?php echo $settings['tp_hero_banner_title']; ?>
								<?php if ($settings['tp_hero_banner_animated_title']): ?>
									<br> <strong id="typing-texttttt" data-words="<?php echo tp_kses($settings['tp_hero_banner_animated_title']) ?>"></strong><span>.</span>
								<?php endif; ?>
							</h1>
						<?php endif; ?>

						<?php if (! empty($settings['tp_hero_banner_description'])) : ?>
							<p> <?php echo tp_kses($settings['tp_hero_banner_description']); ?> </p>
						<?php endif; ?>
						<div class="d-flex align-items-center gap-3">
							<?php if (! empty($settings['tp_hero_banner_link_switcher'])) : ?>
								<a href="<?php echo esc_url($link); ?>" class="btn-one" rel="<?php echo esc_attr($rel); ?>"
									target="<?php echo esc_attr($target); ?>">
									<?php echo tp_kses($settings['tp_hero_banner_btn_text']); ?>
									<span>
										<i class="fa-regular fa-arrow-up-right arry1"></i>
										<i class="fa-regular fa-arrow-up-right arry2"></i>
									</span>
								</a>
							<?php endif; ?>
							<?php if (! empty($settings['tp_hero_banner_link_switcher_2'])) : ?>
								<a href="<?php echo esc_url($link_2); ?>" class="btn-two" rel="<?php echo esc_attr($rel_2); ?>"
									target="<?php echo esc_attr($target_2); ?>">
									<?php echo tp_kses($settings['tp_hero_banner_btn_text_2']); ?>
									<span>
										<i class="fa-regular fa-arrow-right arry1"></i>
										<i class="fa-regular fa-arrow-right arry2"></i>
									</span>
								</a>
							<?php endif; ?>
						</div>
					</div>
					<div class="brand-area pb-120">
						<?php if (! empty($settings['tp_hero_banner_marquee_title'])) : ?>
							<P class="mb-4"><i class="fa-regular me-1 fa-arrow-right"></i>
								<?php echo tp_kses($settings['tp_hero_banner_marquee_title']) ?>
							</P>
						<?php endif; ?>
						<div class="marquee-area">
							<div class="container-fluid">
								<div class="marquee__wrp">
									<div class="marquee__slide brand__slider">
										<div class="marquee__item-wrp">
											<?php foreach ($settings['tp_hero_banner_marquee_1_list'] as $item) :
												if (! empty($item['tp_hero_banner_marquee_1_thumb']['url'])) {
													$tp_hero_banner_marquee_1_thumb_url = ! empty($item['tp_hero_banner_marquee_1_thumb']['id']) ? wp_get_attachment_image_url($item['tp_hero_banner_marquee_1_thumb']['id'], $item['tp_hero_banner_marquee_1_thumb_size']) : $item['tp_hero_banner_marquee_1_thumb']['url'];
													$tp_hero_banner_marquee_1_thumb_alt = get_post_meta($item["tp_hero_banner_marquee_1_thumb"]["id"], "_wp_attachment_image_alt", true);
												}
											?>
												<div class="marquee__item">
													<img src=" <?php echo esc_url($tp_hero_banner_marquee_1_thumb_url) ?>"
														alt="<?php echo esc_attr($tp_hero_banner_marquee_1_thumb_alt) ?>">
												</div>
											<?php endforeach; ?>
										</div>
										<div class="marquee__item-wrp">
											<?php foreach ($settings['tp_hero_banner_marquee_2_list'] as $item) :
												if (! empty($item['tp_hero_banner_marquee_2_thumb']['url'])) {
													$tp_hero_banner_marquee_2_thumb_url = ! empty($item['tp_hero_banner_marquee_2_thumb']['id']) ? wp_get_attachment_image_url($item['tp_hero_banner_marquee_2_thumb']['id'], $item['tp_hero_banner_marquee_2_thumb_size']) : $item['tp_hero_banner_marquee_2_thumb']['url'];
													$tp_hero_banner_marquee_2_thumb_alt = get_post_meta($item["tp_hero_banner_marquee_2_thumb"]["id"], "_wp_attachment_image_alt", true);
												}
											?>
												<div class="marquee__item">
													<img src=" <?php echo esc_url($tp_hero_banner_marquee_2_thumb_url) ?>"
														alt="<?php echo esc_attr($tp_hero_banner_marquee_2_thumb_alt) ?>">
												</div>
											<?php endforeach; ?>
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

$widgets_manager->register(new TP_Hero_Banner());
