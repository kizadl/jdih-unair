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
class TP_Portfolio_Details extends Widget_Base
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
		return 'portfolio-details';
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
		return __('Case Study Details', 'tpcore');
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
	 * Retrieve the list of keywords the portfolio widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['project', 'portfolio', 'details page'];
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

		// Desing layout Panel
		$this->start_controls_section(
			'tp_portfolio_layout_panel',
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
					'layout-1' => esc_html__('Layout 1', 'tpcore')
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'tp_portfolio_content_panel',
			[
				'label' => esc_html__('Title & Content', 'tpcore'),
				'condition' => [
					'tp_portfolio_design_layout' => ['layout-1']
				]
			]
		);

		$this->add_control(
			'tp_portfolio_thumb',
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
				'name' => 'tp_portfolio_thumb',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'tp_portfolio_platforms',
			[
				'label' => esc_html__('Platforms', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('ABC Cafe House', 'tpcore'),
				'placeholder' => esc_html__('Enter your platforms', 'tpcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tp_portfolio_service',
			[
				'label' => esc_html__('Service', 'tpcore'),
				'description' => tp_get_allowed_html_desc('basic'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Social Media Marketing', 'tpcore'),
				'placeholder' => esc_html__('Enter your service', 'tpcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tp_portfolio_timeline',
			[
				'label' => esc_html__('Timeline', 'tpcore'),
				'description' => tp_get_allowed_html_desc('basic'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('2023-2024', 'tpcore'),
				'placeholder' => esc_html__('Enter your timeline', 'tpcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tp_portfolio_revenue',
			[
				'label' => esc_html__('Revenue', 'tpcore'),
				'description' => tp_get_allowed_html_desc('basic'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('30', 'tpcore'),
				'placeholder' => esc_html__('Enter your revenue', 'tpcore'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tp_portfolio_content',
			[
				'label' => esc_html__('Content', 'tpcore'),
				'default' => esc_html__('Enter Your Content Here', 'tpcore'),
				'type' => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__('Enter your content', 'tpcore')
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
			$this->add_render_attribute('tp_infobox_title_attr', 'class', 'tp-section-title');
			$this->add_render_attribute('tp_infobox_sub_title_attr', 'class', 'tp-section-title-pre');

			if (!empty($settings['tp_portfolio_thumb']['url'])) {
				$tp_portfolio_thumb_url = !empty($settings['tp_portfolio_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_portfolio_thumb']['id'], $settings['tp_portfolio_thumb_size']) : $settings['tp_portfolio_thumb']['url'];
				$tp_portfolio_thumb_alt = get_post_meta($settings["tp_portfolio_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

		?>
			<section class="case-details-area pb-120 pt-110">
				<div class="container">
					<div class="image case-details__image">
						<img src="<?php echo esc_url($tp_portfolio_thumb_url); ?>" alt="<?php echo esc_attr($tp_portfolio_thumb_alt) ?>">
					</div>
					<div class="case-details__wrp">
						<div class="case-details__info pt-60 pb-60 bor-top mt-60">
							<div>
								<h5>Platforms</h5>
								<span><?php echo tp_kses($settings['tp_portfolio_platforms']) ?></span>
							</div>
							<div>
								<h5>Service</h5>
								<span><?php echo tp_kses($settings['tp_portfolio_service']) ?></span>
							</div>
							<div>
								<h5>Project Timeline</h5>
								<span><?php echo tp_kses($settings['tp_portfolio_timeline']) ?></span>
							</div>
							<div>
								<h5>Increased in ROI revenue</h5>
								<span> <?php echo tp_kses($settings['tp_portfolio_revenue']) ?>%</span>
							</div>
						</div>
						<?php echo $settings['tp_portfolio_content']; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>
<?php
	}
}

$widgets_manager->register(new TP_Portfolio_Details());
