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
class TP_Infobox extends Widget_Base
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
		return 'infobox';
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
		return __('Info Box', 'tpcore');
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
		return ['info', 'box', 'about', 'company'];
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
			'tp_infobox_layout_panel',
			[
				'label' => esc_html__('Design Layout', 'tpcore'),
			]
		);

		$this->add_control(
			'tp_infobox_design_layout',
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
			'tp_infobox_content_panel',
			[
				'label' => esc_html__('Title & Content', 'tpcore'),
			]
		);

		$this->add_control(
			'tp_infobox_sub_title',
			[
				'label' => esc_html__('Sub Title', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Add Your Sub Title Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your sub title', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_infobox_design_layout' => ['layout-1']
				]
			]
		);

		$this->add_control(
			'tp_infobox_title',
			[
				'label' => esc_html__('Title', 'tpcore'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Add Your Title Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your title', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_infobox_design_layout' => ['layout-1']
				]
			]
		);

		$this->add_control(
			'tp_infobox_description',
			[
				'label' => esc_html__('Description', 'tpcore'),
				'description' => tp_get_allowed_html_desc('basic'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Add Your Description Here', 'tpcore'),
				'placeholder' => esc_html__('Enter your description', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_infobox_design_layout' => ['layout-1']
				]
			]
		);

		$this->add_control(
			'tp_infobox_thumb',
			[
				'label' => esc_html__('Choose Thumbnail', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'tp_infobox_design_layout' => ['layout-1']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'tp_infobox_thumb',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
				'condition' => [
					'tp_infobox_design_layout' => ['layout-1']
				]
			]
		);

		$this->add_control(
			'tp_infobox_link_switcher',
			[
				'label' => esc_html__('Button Switch', 'tpcore'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'tpcore'),
				'label_off' => esc_html__('No', 'tpcore'),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
				'condition' => [
					'tp_infobox_design_layout' => ['layout-1']
				]
			]
		);

		$this->add_control(
			'tp_infobox_btn_text',
			[
				'label' => esc_html__('Button Text', 'tpcore'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Button Text', 'tpcore'),
				'title' => esc_html__('Enter button text', 'tpcore'),
				'label_block' => true,
				'condition' => [
					'tp_infobox_link_switcher' => 'yes',
					'tp_infobox_design_layout' => ['layout-1']
				],
			]
		);

		$this->add_control(
			'tp_infobox_link_type',
			[
				'label' => esc_html__('Button URL Type', 'tpcore'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => 'Custom URL',
					'2' => 'Internal Page',
				],
				'default' => '1',
				'condition' => [
					'tp_infobox_link_switcher' => 'yes',
					'tp_infobox_design_layout' => ['layout-1']
				]
			]
		);

		$this->add_control(
			'tp_infobox_link',
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
					'tp_infobox_link_type' => '1',
					'tp_infobox_link_switcher' => 'yes',
					'tp_infobox_design_layout' => ['layout-1']
				]
			]
		);

		$this->add_control(
			'tp_infobox_page_link',
			[
				'label' => esc_html__('Internal Page Link', 'tpcore'),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => tp_get_all_pages(),
				'condition' => [
					'tp_infobox_link_type' => '2',
					'tp_infobox_link_switcher' => 'yes',
					'tp_infobox_design_layout' => ['layout-1']
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

		<?php if ($settings['tp_infobox_design_layout']  == 'layout-2') :
		?>



		<?php else :

			if (!empty($settings['tp_infobox_thumb']['url'])) {
				$tp_infobox_thumb_url = !empty($settings['tp_infobox_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_infobox_thumb']['id'], $settings['tp_infobox_thumb_size']) : $settings['tp_infobox_thumb']['url'];
				$tp_infobox_thumb_alt = get_post_meta($settings["tp_infobox_thumb"]["id"], "_wp_attachment_image_alt", true);
			}

			// btn
			if ('2' == $settings['tp_infobox_link_type']) {
				$link = get_permalink($settings['tp_infobox_page_link']);
				$target = '_self';
				$rel = 'nofollow';
			} else {
				$link = !empty($settings['tp_infobox_link']['url']) ? $settings['tp_infobox_link']['url'] : '';
				$target = !empty($settings['tp_infobox_link']['is_external']) ? '_blank' : '';
				$rel = !empty($settings['tp_infobox_link']['nofollow']) ? 'nofollow' : '';
			}

		?>

			<section class="start-now-area bg-image pt-120 pb-120" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/bg/start-now-bg.png">
				<div class="container">
					<div class="start-now__item">
						<div class="section-header">
							<?php if (!empty($settings['tp_infobox_sub_title'])) : ?>
								<h5 class="wow splt-txt" data-splitting> <?php echo  tp_kses($settings['tp_infobox_sub_title']) ?></h5>
							<?php endif; ?>
							<?php if (!empty($settings['tp_infobox_title'])) : ?>
								<h2 class="fw-600 text-white wow splt-txt" data-splitting> <?php echo  tp_kses($settings['tp_infobox_title']) ?> </h2>
							<?php endif; ?>
							<?php if (!empty($settings['tp_infobox_description'])) : ?>
								<p class="mt-20 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo  tp_kses($settings['tp_infobox_description']) ?> </p>
							<?php endif; ?>

							<?php if (!empty($settings['tp_infobox_link_switcher'])) : ?>
								<?php if (!empty($link)) : ?>
									<a href="<?php echo esc_url($link); ?>" class="btn-one mt-40 active yellow-btn wow fadeInUp" rel="<?php echo esc_attr($rel); ?>" target="<?php echo esc_attr($target); ?>" data-wow-delay="400ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_infobox_btn_text']); ?> </a>
								<?php endif; ?>
							<?php endif; ?>

						</div>
					</div>
				</div>
				<?php if (!empty($settings['tp_infobox_thumb']['url'])) : ?>
					<div class="start-now__hero">
						<img src="<?php echo esc_url($tp_infobox_thumb_url) ?>" alt="<?php echo esc_attr($tp_infobox_thumb_alt) ?>">
					</div>
				<?php endif; ?>
			</section>

		<?php endif; ?>

<?php
	}
}

$widgets_manager->register(new TP_Infobox());
