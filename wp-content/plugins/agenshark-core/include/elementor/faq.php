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
class TP_FAQ extends Widget_Base
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
		return 'tp-faq';
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
		return __('FAQ', 'tpcore');
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


		// design layout
		$this->start_controls_section(
			'tp_faq_design_layout_section',
			[
				'label' => esc_html__('Design Layout', 'tpcore'),
			]
		);

		$this->add_control(
			'tp_faq_design_layout',
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

		$this->start_controls_section(
			'_accordion',
			[
				'label' => esc_html__('Accordion', 'tpcore'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'accordion_title',
			[
				'label' => esc_html__('Accordion Item', 'tpcore'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('This is accordion item title', 'tpcore'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'accordion_description',
			[
				'label' => esc_html__('Description', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Facilis fugiat hic ipsam iusto laudantium libero maiores minima molestiae mollitia repellat rerum sunt ullam voluptates? Perferendis, suscipit.',
				'label_block' => true,
			]
		);

		$this->add_control(
			'accordions',
			[
				'label' => esc_html__('Repeater Accordion', 'tpcore'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'accordion_title' => esc_html__('This is accordion item title #1', 'tpcore'),
					],
					[
						'accordion_title' => esc_html__('This is accordion item title #2', 'tpcore'),
					],
					[
						'accordion_title' => esc_html__('This is accordion item title #3', 'tpcore'),
					],
					[
						'accordion_title' => esc_html__('This is accordion item title #4', 'tpcore'),
					],
				],
				'title_field' => '{{{ accordion_title }}}',
			]
		);

		$this->end_controls_section();


		// Style controll
		$this->start_controls_section(
			'accordion_style',
			[
				'label' => esc_html__('Content Style', 'tpcore'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_active-bg',
			[
				'label' => esc_html__('Background', 'tpcore'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .accordion .accordion-item h2 button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'active-color',
			[
				'label' => esc_html__('Color', 'tpcore'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr__accordion-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .wpr__accordion-title',
			]
		);


		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Title Padding', 'tpcore'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [
					'px',
					'%',
					'em',
					'rem',
					'custom'
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}} .wpr__accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_active-bg',
			[
				'label' => esc_html__('Background', 'tpcore'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .accordion .accordion-item' => 'background-color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'active-color_body',
			[
				'label' => esc_html__(
					'Content Color',
					'tpcore'
				),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr__accordion-body p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' =>
				'{{WRAPPER}} .wpr__accordion-body p',
			]
		);

		$this->add_control(
			'content_padding',
			[
				'label' => esc_html__('Description Padding', 'tpcore'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [
					'px',
					'%',
					'em',
					'rem',
					'custom'
				],
				'selectors' => [
					'{{WRAPPER}} .wpr__accordion-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		<?php if ($settings['tp_faq_design_layout']  == 'layout-2') : ?>

			<section class="faq-four-area">
				<div class="container">
					<div class="faq-four__accordion accordion-two">
						<div class="accordion" id="accordionExample-<?php echo esc_attr($this->get_id()); ?>">
							<?php foreach ($settings['accordions'] as $index => $item) :
								$collapsed = ($index == '0') ? '' : 'collapsed';
								$aria_expanded = ($index == '0') ? "true" : "false";
								$show = ($index == '1') ? "show" : "";
							?>
								<div class="accordion-item">
									<h2 class="accordion-header" id="headingTwo">
										<button class="accordion-button wpr__accordion-title <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo esc_attr($index); ?>" aria-expanded="false" aria-controls="collapse-<?php echo esc_attr($index); ?>">
											<?php echo esc_html($item['accordion_title']); ?>
										</button>
									</h2>
									<div id="collapse-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="heading-<?php echo esc_attr($index); ?>" data-bs-parent="#accordionExample-<?php echo esc_attr($this->get_id()); ?>">
										<div class="accordion-body wpr__accordion-body">
											<p> <?php echo tp_kses($item['accordion_description']); ?> </p>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>

		<?php else : ?>

			<section class="faq-area">
				<div class="container">
					<div class="row g-4">
						<div class="col-lg-12">
							<div class="accordion" id="accordionExample-<?php echo esc_attr($this->get_id()); ?>">
								<?php foreach ($settings['accordions'] as $index => $item) :
									$collapsed = ($index == '0') ? '' : 'collapsed';
									$aria_expanded = ($index == '0') ? "true" : "false";
									$show = ($index == '1') ? "show" : "";
								?>
									<div class="accordion-item mb-4 border-none">
										<h2 class="accordion-header" id="headingTwo">
											<button class="accordion-button wpr__accordion-title <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo esc_attr($index); ?>" aria-expanded="false" aria-controls="collapse-<?php echo esc_attr($index); ?>">
												<?php echo esc_html($item['accordion_title']); ?>
											</button>
										</h2>
										<div id="collapse-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="heading-<?php echo esc_attr($index); ?>" data-bs-parent="#accordionExample-<?php echo esc_attr($this->get_id()); ?>">
											<div class="accordion-body wpr__accordion-body">
												<p> <?php echo tp_kses($item['accordion_description']); ?> </p>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php endif;  ?>


<?php
	}
}

$widgets_manager->register(new TP_FAQ());
