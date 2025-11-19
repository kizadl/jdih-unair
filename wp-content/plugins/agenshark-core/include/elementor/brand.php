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
class TP_Brand extends Widget_Base
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
        return 'brand';
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
        return __('Brand', 'tpcore');
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
        return ['brand'];
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
            'tp_brand_design_layout_section',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_brand_design_layout',
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

        // brand repeater 
        $this->start_controls_section(
            'tp_brand_content_section',
            [
                'label' => esc_html__('Brand Repeater - 1 ', 'tpcore'),
                'condition' => [
                    'tp_brand_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_brand_thumb',
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
                'name' => 'tp_brand_thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'tp_brand_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        // brand repeater 2
        $this->start_controls_section(
            'tp_brand_content_section_2',
            [
                'label' => esc_html__('Brand Repeater - 2 ', 'tpcore'),
                'condition' => [
                    'tp_brand_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_brand_thumb_2',
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
                'name' => 'tp_brand_thumb_2',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'tp_brand_list_2',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
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

        <?php if ($settings['tp_brand_design_layout']  == 'layout-2') :
        ?>

            <div class="brand-area pt-120 pb-120">
                <div class="container">
                    <div class="marquee-area">
                        <div class="marquee__wrp">
                            <div class="marquee__slide brand__slider">
                                <div class="marquee__item-wrp">
                                    <?php foreach ($settings['tp_brand_list'] as $key => $item) :
                                        if (!empty($item['tp_brand_thumb']['url'])) {
                                            $tp_brand_thumb_url = !empty($item['tp_brand_thumb']['id']) ? wp_get_attachment_image_url($item['tp_brand_thumb']['id'], $item['tp_brand_thumb_size']) : $item['tp_brand_thumb']['url'];
                                            $tp_brand_thumb_alt = get_post_meta($item["tp_brand_thumb"]["id"], "_wp_attachment_image_alt", true);
                                        }
                                    ?>
                                        <div class="marquee__item">
                                            <img src="<?php echo esc_url($tp_brand_thumb_url) ?>" alt="<?php echo esc_url($tp_brand_thumb_alt) ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="marquee__item-wrp">
                                    <?php foreach ($settings['tp_brand_list_2'] as $key => $item) :
                                        if (!empty($item['tp_brand_thumb_2']['url'])) {
                                            $tp_brand_thumb_url_2 = !empty($item['tp_brand_thumb_2']['id']) ? wp_get_attachment_image_url($item['tp_brand_thumb_2']['id'], $item['tp_brand_thumb_2_size']) : $item['tp_brand_thumb_2']['url'];
                                            $tp_brand_thumb_alt_2 = get_post_meta($item["tp_brand_thumb_2"]["id"], "_wp_attachment_image_alt", true);
                                        }
                                    ?>
                                        <div class="marquee__item">
                                            <img src="<?php echo esc_url($tp_brand_thumb_url_2) ?>" alt="<?php echo esc_url($tp_brand_thumb_alt_2) ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else : ?>

            <div class="brand-area pb-120">
                <div class="container">
                    <div class="marquee-area">
                        <div class="marquee__wrp">
                            <div class="marquee__slide brand__slider">
                                <div class="marquee__item-wrp">
                                    <?php foreach ($settings['tp_brand_list'] as $key => $item) :
                                        if (!empty($item['tp_brand_thumb']['url'])) {
                                            $tp_brand_thumb_url = !empty($item['tp_brand_thumb']['id']) ? wp_get_attachment_image_url($item['tp_brand_thumb']['id'], $item['tp_brand_thumb_size']) : $item['tp_brand_thumb']['url'];
                                            $tp_brand_thumb_alt = get_post_meta($item["tp_brand_thumb"]["id"], "_wp_attachment_image_alt", true);
                                        }
                                    ?>
                                        <div class="marquee__item">
                                            <img src="<?php echo esc_url($tp_brand_thumb_url) ?>" alt="<?php echo esc_url($tp_brand_thumb_alt) ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="marquee__item-wrp">
                                    <?php foreach ($settings['tp_brand_list_2'] as $key => $item) :
                                        if (!empty($item['tp_brand_thumb_2']['url'])) {
                                            $tp_brand_thumb_url_2 = !empty($item['tp_brand_thumb_2']['id']) ? wp_get_attachment_image_url($item['tp_brand_thumb_2']['id'], $item['tp_brand_thumb_2_size']) : $item['tp_brand_thumb_2']['url'];
                                            $tp_brand_thumb_alt_2 = get_post_meta($item["tp_brand_thumb_2"]["id"], "_wp_attachment_image_alt", true);
                                        }
                                    ?>
                                        <div class="marquee__item">
                                            <img src="<?php echo esc_url($tp_brand_thumb_url_2) ?>" alt="<?php echo esc_url($tp_brand_thumb_alt_2) ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Brand());
