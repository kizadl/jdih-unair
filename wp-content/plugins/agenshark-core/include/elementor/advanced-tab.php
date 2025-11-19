<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Repeater;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Advanced_Tab extends Widget_Base
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
		return 'advanced-tab';
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
		return __('Advanced Tab', 'tpcore');
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
					'layout-2' => esc_html__('Layout 2', 'tpcore'),
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		// content section
		$this->start_controls_section(
			'tp_advance_tab_content_section',
			[
				'label' => esc_html__('Title & Content', 'tpcore'),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'tp_design_style' => ['layout-1','layout-2']
				]
			]
		);

		$this->add_control(
			'tp_advance_tab_title',
			[
				'label' => esc_html__('Title', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Add Your Title Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your title', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_design_style' => ['layout-1']
				]
			]
		);

		$this->add_control(
			'tp_advance_tab_description',
			[
				'label' => esc_html__('Description', 'tpcore'),
				'description' => tp_get_allowed_html_desc('basic'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Add Your Description Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your description', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_design_style' => ['layout-1']
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_price_tabs',
			[
				'label' => __('Advanced Tabs', 'tpcore'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'type' => Controls_Manager::TEXT,
				'label' => __('Title', 'tpcore'),
				'default' => __('Tab Title', 'tpcore'),
				'placeholder' => __('Type Tab Title', 'tpcore'),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'active_tab',
			[
				'label' => __('Is Active Tab?', 'tpcore'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'tpcore'),
				'label_off' => __('No', 'tpcore'),
				'return_value' => 'yes',
				'default' => 'yes',
				'frontend_available' => true,
			]
		);

		$repeater->add_control(
			'template',
			[
				'label' => __('Section Template', 'tpcore'),
				'placeholder' => __('Select a section template for as tab content', 'tpcore'),

				'type' => Controls_Manager::SELECT2,
				'options' => get_elementor_templates()
			]
		);

		$this->add_control(
			'tabs',
			[
				'show_label' => false,
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{title}}',
				'default' => [
					[
						'title' => 'Tab 1',
					],
					[
						'title' => 'Tab 2',
					]
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __('Style', 'tpcore'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __('Text Transform', 'tpcore'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __('None', 'tpcore'),
					'uppercase' => __('UPPERCASE', 'tpcore'),
					'lowercase' => __('lowercase', 'tpcore'),
					'capitalize' => __('Capitalize', 'tpcore'),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
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


		<?php if ($settings['tp_design_style']  == 'layout-2') :
			if (!empty($settings['tp_image']['url'])) {
				$tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url($settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
				$tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
			}
			$this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
		?>

			<section class="pricing-two-area sub-bg pt-120 pb-120">
				<div class="container">
					<div class="d-flex align-items-end gap-5 flex-wrap justify-content-between mb-80">
						<div class="section-header">
							<h2 class="fw-600 wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_advance_tab_title']) ?> </h2>
							<p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_advance_tab_description']) ?>  </p>
						</div>

						<div class="pricing-two__tab wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
							<img class="price-save" src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/save.png" alt="image">
							<nav>
								<div class="nav nav-tabs" id="nav-tab" role="tablist">
									<?php foreach ($settings['tabs'] as $key => $tab) :
										$active = ($key == 0) ? 'active' : '';
									?>
										<button class="nav-link <?php echo esc_attr($active); ?>" id="pt-1-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#pt-1-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="pt-1-<?php echo esc_attr($key); ?>" aria-selected="true"><?php echo tp_kses($tab['title']); ?></button>
									<?php endforeach; ?>
								</div>
							</nav>
						</div>
					</div>
					<div class="pricing__tab-content">
						<div class="tab-content" id="nav-tabContent">
							<?php foreach ($settings['tabs'] as $key => $tab) :
								$active = ($key == 0) ? 'show active' : '';
							?>
								<div class="tab-pane fade <?php echo esc_attr($active); ?>" id="pt-1-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="pt-1-tab-<?php echo esc_attr($key); ?>">
									<div class="pricing-package-wrapper">
										<?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>






		<?php else :
			if (!empty($settings['tp_image']['url'])) {
				$tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url($settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
				$tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
			}
			$this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
		?>

			<section class="agenshark-wrap pricing-area pt-120 pb-120">
				<div class="pricing__shape1 sway_Y__animation">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/pricing-shape1.png" alt="shape">
				</div>
				<div class="pricing__shape2 sway__animationX">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/pricing-shape2.png" alt="shape">
				</div>
				<div class="pricing__shape3 sway__animationX">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/pricing-shape3.png" alt="shape">
				</div>
				<div class="pricing__shape4 animation__rotateAndScale">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/pricing-shape4.png" alt="shape">
				</div>
				<div class="container">
					<div class="section-header tp-unlock-pricing text-center mb-30">
						<?php if (!empty($settings['tp_advance_tab_title'])) : ?>
							<h2 class="fw-600 wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_advance_tab_title']) ?> </h2>
						<?php endif; ?>
						<?php if (!empty($settings['tp_advance_tab_description'])) : ?>
							<p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_advance_tab_description']) ?> </p>
						<?php endif; ?>
					</div>
					<div class="pricing__tab wow fadeInUp mb-60" data-wow-delay="400ms" data-wow-duration="1500ms">
						<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<?php foreach ($settings['tabs'] as $key => $tab) :
									$active = ($key == 0) ? 'active' : '';
								?>
									<button class="nav-link <?php echo esc_attr($active); ?>" id="pt-1-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#pt-1-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="pt-1-<?php echo esc_attr($key); ?>" aria-selected="true"><?php echo tp_kses($tab['title']); ?></button>
								<?php endforeach; ?>
							</div>
						</nav>
					</div>
					<div class="pricing__tab-content">
						<div class="tab-content" id="nav-tabContent">
							<?php foreach ($settings['tabs'] as $key => $tab) :
								$active = ($key == 0) ? 'show active' : '';
							?>
								<div class="tab-pane fade <?php echo esc_attr($active); ?>" id="pt-1-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="pt-1-tab-<?php echo esc_attr($key); ?>">
									<div class="pricing-package-wrapper">
										<?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($tab['template'], true); ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>

<?php
	}
}
$widgets_manager->register(new TP_Advanced_Tab());
