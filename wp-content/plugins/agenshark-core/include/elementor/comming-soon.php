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
class TP_Comming_Soon extends Widget_Base
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
        return 'comming-soon';
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
        return __('Comming Soon', 'tpcore');
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
        return ['coming soon', 'upcomming', 'construction page'];
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
		if (!class_exists('WPCF7')) {
			return;
		}
		$tp_cfa         = array();
		$tp_cf_args     = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
		$tp_forms       = get_posts($tp_cf_args);
		$tp_cfa         = ['0' => esc_html__('Select Form', 'tpcore')];
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
            'tp_comming_soon_design_layout_section',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_comming_soon_design_layout',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // content section
        $this->start_controls_section(
            'tp_comming_soon_content_section',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_comming_soon_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Sub Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your sub title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_comming_soon_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_comming_soon_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_comming_soon_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_comming_soon_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_comming_soon_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_comming_soon_description_2',
            [
                'label' => esc_html__('Description - 2', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_comming_soon_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_comming_soon_thumb',
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
                'name' => 'tp_comming_soon_thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
            ]
        );

        $this->add_control(
            'tpcore_select_contact_form',
            [
                'label'   => esc_html__('Select Form', 'tpcore'),
                'type'    => Controls_Manager::SELECT,
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

        <?php if ($settings['tp_comming_soon_design_layout']  == 'layout-1') :

            // bg thumb
            if (!empty($settings['tp_comming_soon_thumb']['url'])) {
                $tp_comming_soon_thumb_url = !empty($settings['tp_comming_soon_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_comming_soon_thumb']['id'], $settings['tp_comming_soon_thumb_size']) : $settings['tp_comming_soon_thumb']['url'];
                $tp_comming_soon_thumb_alt = get_post_meta($settings["tp_comming_soon_thumb"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

            <section class="coming-soon-area">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-xl-6 order-2 order-xl-1">
                            <div class="coming-soon__content">
                                <div class="section-header-inner">
                                    <?php if (!empty($settings['tp_comming_soon_sub_title'])) : ?>
                                        <h5> <?php echo tp_kses($settings['tp_comming_soon_sub_title']); ?> </h5>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['tp_comming_soon_title'])) : ?>
                                        <h2> <?php echo tp_kses($settings['tp_comming_soon_title']); ?> </h2>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['tp_comming_soon_description'])) : ?>
                                        <p> <?php echo tp_kses($settings['tp_comming_soon_description']); ?> </p>
                                    <?php endif; ?>
                                </div>
                                <div class="coming-soon__timer pt-50 pb-50">
                                    <div class="timer__content">
                                        <h3 id="day">00</h3>
                                        <p>Days</p>
                                    </div>
                                    <div class="timer__content">
                                        <h3 id="hour">00</h3>
                                        <p>Hours</p>
                                    </div>
                                    <div class="timer__content">
                                        <h3 id="min">00</h3>
                                        <p>Minutes</p>
                                    </div>
                                    <div class="timer__content">
                                        <h3 id="sec">00</h3>
                                        <p>Seconds</p>
                                    </div>
                                </div>
                                <?php if (!empty($settings['tp_comming_soon_description_2'])) : ?>
                                    <p> <?php echo tp_kses($settings['tp_comming_soon_description_2']); ?> </p>
                                <?php endif; ?>
                                <div class="banner-three__content">
                                    <div class="input-feild mt-3">
                                        <svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 14.2917H4C1.985 14.2917 0.875 13.1817 0.875 11.1667V3.66675C0.875 1.65175 1.985 0.541748 4 0.541748H14C16.015 0.541748 17.125 1.65175 17.125 3.66675V11.1667C17.125 13.1817 16.015 14.2917 14 14.2917ZM4 1.79175C2.68583 1.79175 2.125 2.35258 2.125 3.66675V11.1667C2.125 12.4809 2.68583 13.0417 4 13.0417H14C15.3142 13.0417 15.875 12.4809 15.875 11.1667V3.66675C15.875 2.35258 15.3142 1.79175 14 1.79175H4ZM9.85754 7.98258L13.9508 5.00591C14.2299 4.80341 14.2916 4.41175 14.0883 4.13259C13.8858 3.85425 13.4959 3.79091 13.2151 3.99508L9.12166 6.97175C9.04833 7.02508 8.95086 7.02508 8.87752 6.97175L4.7841 3.99508C4.50243 3.79091 4.11339 3.85509 3.91089 4.13259C3.70756 4.41175 3.76925 4.80258 4.04842 5.00591L8.14164 7.98341C8.39831 8.17007 8.69919 8.26258 8.99919 8.26258C9.29919 8.26258 9.60171 8.16925 9.85754 7.98258Z" fill="#06120E" fill-opacity="0.7" />
                                        </svg>
                                        <?php if (!empty($settings['tpcore_select_contact_form'])) : ?>
                                            <?php echo do_shortcode('[contact-form-7  id="' . $settings['tpcore_select_contact_form'] . '"]'); ?>
                                        <?php else : ?>
                                            <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore') . '</p></div>'; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-6 order-1 order-xl-2">
                            <div class="coming-soon__image image">
                                <img src="<?php echo esc_url($tp_comming_soon_thumb_url) ?>" alt="<?php echo esc_url($tp_comming_soon_thumb_alt) ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Comming_Soon());
