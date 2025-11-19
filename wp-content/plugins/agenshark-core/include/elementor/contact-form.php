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
class TP_Contact_Form extends Widget_Base
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
		return 'contactform';
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
		return __('Contact Form', 'tpcore');
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

		// layout Panel
		$this->start_controls_section(
			'tp_layout',
			[
				'label' => esc_html__('Design Layout', 'tpcore'),
			]
		);
		$this->add_control(
			'tp_design_style',
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

		$this->start_controls_section(
			'tp_contact_title_and_Content',
			[
				'label' => esc_html__('Title & Content', 'tpcore'),
			]
		);

		$this->add_control(
			'tp_title',
			[
				'label' => esc_html__('Title', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Add Your Title Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your title', 'tpcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tp_description',
			[
				'label' => esc_html__('Description', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Add Your Description Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your description', 'tpcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tp_contact_email',
			[
				'label' => esc_html__('Email', 'tpcore'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Add Your Email Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your email', 'tpcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tp_contact_phone',
			[
				'label' => esc_html__('Phone', 'tpcore'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Add Your Phone Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your phone', 'tpcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tp_contact_address',
			[
				'label' => esc_html__('Address', 'tpcore'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Add Your Address Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your address', 'tpcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tp_contact_office_time',
			[
				'label' => esc_html__('Office Hours', 'tpcore'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Add Your Office Hours', 'tpcore'),
				'placeholder' => esc_html__('Enter your office hours', 'tpcore'),
				'label_block' => true,
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

		<?php if ($settings['tp_design_style']  == 'layout-1') : ?>
			<section class="contact-area pt-120 pb-120">
				<div class="contact__shape1 sway_Y__animation">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/contact-dots.png" alt="shape">
				</div>
				<div class="contact__shape2 sway_Y__animationY">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/contact-roket.png" alt="shape">
				</div>
				<div class="container">
					<div class="row g-4 align-items-center justify-content-between">
						<div class="col-lg-5">
							<div class="contact__item-left">
								<div class="section-header mb-60">
									<?php if (!empty($settings['tp_title'])) : ?>
										<h2 class="fw-600 wow splt-txt" data-splitting><?php echo tp_kses($settings['tp_title']) ?></h2>
									<?php endif; ?>
									<?php if (!empty($settings['tp_description'])) : ?>
										<p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_description']) ?> </p>
									<?php endif; ?>
								</div>
								<div class="contact__content">
									<?php if (!empty($settings['tp_contact_email'])) : ?>
										<div class="mb-30">
											<h5>Email Address</h5>
											<p> <?php echo tp_kses($settings['tp_contact_email']) ?> </p>
										</div>
									<?php endif; ?>
									<?php if (!empty($settings['tp_contact_phone'])) : ?>
										<div class="mb-30">
											<h5>Phone Number</h5>
											<p> <?php echo tp_kses($settings['tp_contact_phone']) ?> </p>
										</div>
									<?php endif; ?>
									<?php if (!empty($settings['tp_contact_address'])) : ?>
										<div class="mb-30">
											<h5>Headquarters Address</h5>
											<p> <?php echo tp_kses($settings['tp_contact_address']) ?> </p>
										</div>
									<?php endif; ?>
									<?php if (!empty($settings['tp_contact_office_time'])) : ?>
										<div>
											<h5>Business Hours</h5>
											<p> <?php echo tp_kses($settings['tp_contact_office_time']) ?> </p>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="contact__item-right">
								<div class="contact__item">
									<h3>Contact Us</h3>
									<?php if (!empty($settings['tpcore_select_contact_form'])) : ?>
										<?php echo do_shortcode('[contact-form-7  id="' . $settings['tpcore_select_contact_form'] . '"]'); ?>
									<?php else : ?>
										<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore') . '</p></div>'; ?>
									<?php endif; ?>
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

$widgets_manager->register(new TP_Contact_Form());
