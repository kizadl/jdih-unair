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
 * Marketi Core
 *
 * Elementor widget for Headings
 *
 * @since 1.0.0
 */
class WPR_Video_Box extends \Elementor\Widget_Base
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
        return 'wpr_video_box';
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
        return __('Video Box', 'tpcore');
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

        // Content Repeater start
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout_control',
            [
                'label'   => esc_html__(
                    'Layout Style',
                    'tpcore'
                ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => array(
                    '1' => esc_html__('Style 1', 'tpcore'),
                    '2' => esc_html__('Style 2', 'tpcore'),
                ),
            ]
        );

        $this->add_control(
            'tp_hero_banner_video_thumb',
            [
                'label' => esc_html__(
                    'Choose Thumbnail',
                    'tpcore'
                ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => []
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_hero_banner_video_thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
                'condition' => []
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
                'condition' => []
            ]
        );

        $this->add_control(
            'tp_hero_banner_video_btn_text',
            [
                'label' => esc_html__(
                    'Button Text',
                    'tpcore'
                ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'tpcore'),
                'title' => esc_html__(
                    'Enter button text',
                    'tpcore'
                ),
                'label_block' => true,
                'condition' => [
                    'tp_hero_banner_video_link_switcher' => 'yes',
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
                ]
            ]
        );

        $this->add_control(
            'tp_hero_banner_video_link',
            [
                'label' => esc_html__(
                    'Video URL',
                    'tpcore'
                ),
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
                ]
            ]
        );



        $this->end_controls_section();



        // Style controll
        $this->start_controls_section(
            'box_style',
            [
                'label' => esc_html__('Style', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label' => esc_html__(
                    'Icon BG',
                    'tpcore'
                ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-video__btn.inner-page .video-popup' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .video-btn a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__(
                    'Icon Color',
                    'tpcore'
                ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-btn a' => 'color: {{VALUE}};'
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

        <?php if ($settings['layout_control'] == '1') { ?>
            <?php

            // video thumb
            if (! empty($settings['tp_hero_banner_video_thumb']['url'])) {
                $tp_hero_banner_video_thumb_url = ! empty($settings['tp_hero_banner_video_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_video_thumb']['id'], $settings['tp_hero_banner_video_thumb_size']) : $settings['tp_hero_banner_video_thumb']['url'];
                $tp_hero_banner_video_thumb_alt = get_post_meta($settings["tp_hero_banner_video_thumb"]["id"], "_wp_attachment_image_alt", true);
            }

            // video btn
            if ('2' == $settings['tp_hero_banner_video_link_type']) {
                $link_video = get_permalink($settings['tp_hero_banner_video_page_link']);
                $target_video = '_self';
                $rel_video = 'nofollow';
            } else {
                $link_video = ! empty($settings['tp_hero_banner_video_link']['url']) ? $settings['tp_hero_banner_video_link']['url'] : '';
                $target_video = ! empty($settings['tp_hero_banner_video_link']['is_external']) ? '_blank' : '';
                $rel_video = ! empty($settings['tp_hero_banner_video_link']['nofollow']) ? 'nofollow' : '';
            }

            ?>

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
        <?php } elseif ($settings['layout_control'] == '2') { ?>
            <?php

            // video thumb
            if (! empty($settings['tp_hero_banner_video_thumb']['url'])) {
                $tp_hero_banner_video_thumb_url = ! empty($settings['tp_hero_banner_video_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_hero_banner_video_thumb']['id'], $settings['tp_hero_banner_video_thumb_size']) : $settings['tp_hero_banner_video_thumb']['url'];
                $tp_hero_banner_video_thumb_alt = get_post_meta($settings["tp_hero_banner_video_thumb"]["id"], "_wp_attachment_image_alt", true);
            }

            // video btn
            if ('2' == $settings['tp_hero_banner_video_link_type']) {
                $link_video = get_permalink($settings['tp_hero_banner_video_page_link']);
                $target_video = '_self';
                $rel_video = 'nofollow';
            } else {
                $link_video = ! empty($settings['tp_hero_banner_video_link']['url']) ? $settings['tp_hero_banner_video_link']['url'] : '';
                $target_video = ! empty($settings['tp_hero_banner_video_link']['is_external']) ? '_blank' : '';
                $rel_video = ! empty($settings['tp_hero_banner_video_link']['nofollow']) ? 'nofollow' : '';
            }

            ?>

            <div class="banner-video mt-0">
                <div class="container">
                    <?php if (! empty($settings['tp_hero_banner_video_link_switcher'])) : ?>
                        <div class="banner-video__image image">
                            <img src="<?php echo esc_url($tp_hero_banner_video_thumb_url) ?>"
                                alt="<?php echo esc_attr($tp_hero_banner_video_thumb_alt) ?>">
                            <div class="banner-video__btn inner-page">
                                <div class="video-btn video-pulse">
                                    <a class="video-popup" href="<?php echo esc_url($link_video); ?>"
                                        rel="<?php echo esc_attr($rel_video); ?>" target="<?php echo esc_attr($target_video); ?>">
                                        <?php echo tp_kses($settings['tp_hero_banner_video_btn_text']); ?> <i
                                            class="fa-solid fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php } ?>

<?php
    }
}

$widgets_manager->register(new WPR_Video_Box());
