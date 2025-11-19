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
class TP_Service_Details extends Widget_Base
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
		return 'service-details';
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
		return __('Service Details', 'tpcore');
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
		return ['service', 'service details', 'details', 'page'];
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
			'tp_service_layout_panel',
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
					'layout-1' => esc_html__('Layout 1', 'tpcore')
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		// content section
		$this->start_controls_section(
			'tp_service_details_content_section',
			[
				'label' => esc_html__('Title & Content', 'tpcore'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tp_service_details_sub_title',
			[
				'label' => esc_html__('Sub Title', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Add Your Sub Title Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your sub title', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_design_style' => ['layout-1']
				]
			]
		);

		$this->add_control(
			'tp_service_details_title',
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
			'tp_service_details_thumb',
			[
				'label' => esc_html__('Choose Thumbnail', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'tp_design_style' => ['layout-1'],
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'tp_service_details_thumb',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
				'condition' => [
					'tp_design_style' => ['layout-1'],
				]
			]
		);

		$this->add_control(
			'tp_service_details_content',
			[
				'label' => esc_html__('Content', 'tpcore'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Add Your Content Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your content', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_design_style' => ['layout-1']
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

		<?php if ($settings['tp_design_style']  == 'layout-2') :
		?>


		<?php else :
			if (!empty($settings['tp_service_details_thumb']['url'])) {
				$tp_service_details_thumb_url = !empty($settings['tp_service_details_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_service_details_thumb']['id'], $settings['tp_service_details_thumb_size']) : $settings['tp_service_details_thumb']['url'];
				$tp_service_details_thumb_alt = get_post_meta($settings["tp_service_details_thumb"]["id"], "_wp_attachment_image_alt", true);
			}
		?>

			<section class="service-details-area pb-120 pt-110">
				<div class="container">
					<div class="section-header-inner text-center mb-80">
						<?php if (!empty($settings['tp_service_details_sub_title'])) : ?>
							<h5><span class="title-dot"></span> <?php echo tp_kses($settings['tp_service_details_sub_title']) ?> </h5>
						<?php endif; ?>
						<?php if (!empty($settings['tp_service_details_title'])) : ?>
							<h2> <?php echo tp_kses($settings['tp_service_details_title']) ?> </h2>
						<?php endif; ?>
					</div>
					<div class="image service-details__image">
						<img src="<?php echo esc_url($tp_service_details_thumb_url); ?>" alt="<?php echo esc_attr($tp_service_details_thumb_alt) ?>">
					</div>
					<?php if (!empty($settings['tp_service_details_content'])) : ?>
						<div class="service-details__wrp">
							<?php echo $settings['tp_service_details_content']; ?>
						</div>
					<?php endif; ?>
				</div>
			</section>

		<?php endif; ?>

<?php
	}
}

$widgets_manager->register(new TP_Service_Details());
