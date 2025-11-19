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
class TP_Team extends Widget_Base
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
        return 'wpr-team';
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
        return __('Team', 'tpcore');
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
            'tp_team_desing_layout',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_team_design_style',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // team
        $this->start_controls_section(
            'tp_team_panel',
            [
                'label' => __('Team Member', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_team_design_style' => ['layout-1', 'layout-2', 'layout-3'],
                ],
            ]
        );

        $repeater = new Repeater();


        $repeater->start_controls_tabs(
            'tp_team_info_box_tab_style'
        );

        $repeater->start_controls_tab(
            'tp_team_tab_member_info',
            [
                'label' => __('Information', 'tpcore'),
            ]
        );

        $repeater->add_control(
            'tp_team_thumb',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Choose Image', 'tpcore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_team_thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $repeater->add_control(
            'tp_team_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title', 'tpcore'),
                'default' => __('Jon Smith', 'tpcore'),
                'placeholder' => __('Enter name here', 'tpcore'),
            ]
        );

        $repeater->add_control(
            'tp_team_designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __('Designation', 'tpcore'),
                'default' => __('Senior Consultant ', 'tpcore'),
                'placeholder' => __('Enter designation here', 'tpcore'),
            ]
        );

        $repeater->add_control(
            'tp_team_details_url',
            [
                'label' => esc_html__('Team Details URL', 'tpcore'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        // social 
        $repeater->start_controls_tab(
            'tp_team_social_tab',
            [
                'label' => __('Social', 'tpcore'),
            ]
        );

        $repeater->add_control(
            'tp_team_social_switch',
            [
                'label' => __('Social URL Switch', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'tpcore'),
                'label_off' => __('No', 'tpcore'),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_team_facebook_url',
            [
                'label' => esc_html__('Facebook', 'tpcore'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'tp_team_social_switch' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_team_twitter_url',
            [
                'label' => esc_html__('Twitter', 'tpcore'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'tp_team_social_switch' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_team_instagram_url',
            [
                'label' => esc_html__('Instagram', 'tpcore'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'tp_team_social_switch' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_team_linkedin_url',
            [
                'label' => esc_html__('Linkedin', 'tpcore'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'tp_team_social_switch' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_team_youtube_url',
            [
                'label' => esc_html__('Youtube', 'tpcore'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'tp_team_social_switch' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_team_google_plus_url',
            [
                'label' => esc_html__('Google Plus', 'tpcore'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'tp_team_social_switch' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_team_flickr_url',
            [
                'label' => esc_html__('Flickr', 'tpcore'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'tp_team_social_switch' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_team_vimeo_url',
            [
                'label' => esc_html__('Vimeo', 'tpcore'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'tp_team_social_switch' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_team_behance_url',
            [
                'label' => esc_html__('Behance', 'tpcore'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'tp_team_social_switch' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_team_dribble_url',
            [
                'label' => esc_html__('Dribble', 'tpcore'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'tp_team_social_switch' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_team_pinterest_url',
            [
                'label' => esc_html__('Pinterest', 'tpcore'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'tp_team_social_switch' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_team_github_url',
            [
                'label' => esc_html__('Github', 'tpcore'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'tp_team_social_switch' => 'yes'
                ]
            ]
        );

        $repeater->end_controls_tab(); // social end


        $this->add_control(
            'tp_team_repeater_list',
            [
                'label' => esc_html__('Member List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_team_title' => esc_html__('Eleanor Pena', 'tpcore'),
                    ],
                    [
                        'tp_team_title' => esc_html__('Annette Smith', 'tpcore')
                    ],
                    [
                        'tp_team_title' => esc_html__('Theresa Willem', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_team_title }}}',
            ]
        );

        $this->end_controls_section();

        /**
         * ****
         * Content Box
         */
        $this->start_controls_section(
            'style_content_section',
            [
                'label' => esc_html__('Content', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'conent_margin',
            [
                'label' => esc_html__('Margin', 'tpcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [
                    'px',
                    '%',
                    'em',
                    'rem',
                    'custom'
                ],
                'devices' => [
                    'desktop',
                    'tablet',
                    'mobile'
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr__team_card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // slide dimention
        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__('Padding', 'tpcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [
                    'px',
                    '%',
                    'em',
                    'rem',
                    'custom'
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr__team_card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => esc_html__('Name Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__team_name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'name_hover_color',
            [
                'label' => esc_html__('Name Hover Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__team_name:hover' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .team-four__item h5 a:hover' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .wpr__team_name',
            ]
        );


        $this->add_control(
            'designation_color',
            [
                'label' => esc_html__('Designation Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__team_designation' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'designation_typography',
                'selector' => '{{WRAPPER}} .wpr__team_designation',
            ]
        );

        $this->add_responsive_control(
            'name_margin',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Spacing', 'tpcore'),
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => [
                    'desktop',
                    'tablet',
                    'mobile'
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr__team_name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'social_bg',
            [
                'label' => esc_html__('Social Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-four__social ' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
                'condition' => ['tp_team_design_style' => ['layout-2', 'layout-3']],
            ]
        );

        $this->add_control(
            'social_color',
            [
                'label' => esc_html__('Social Icon Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team__social.tp a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .team-four__social a' => 'color: {{VALUE}}',
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

        <?php if ($settings['tp_team_design_style'] === 'layout-2') :

            $this->add_render_attribute('tp_team_sec_title_attr', 'class', 'tp-section-title');
            $this->add_render_attribute('tp_team_sec_sub_title_attr', 'class', 'tp-section-title-pre');
        ?>


            <section class="team-four-area">
                <div class="container">
                    <div class="swiper team-four__slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['tp_team_repeater_list'] as $key => $item) :
                                if (!empty($item['tp_team_thumb']['url'])) {
                                    $tp_team_thumb = !empty($item['tp_team_thumb']['id']) ? wp_get_attachment_image_url($item['tp_team_thumb']['id'], $item['tp_team_thumb_size']) : $item['tp_team_thumb']['url'];
                                    $tp_team_thumb_alt = get_post_meta($item["tp_team_thumb"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                                <div class="swiper-slide">
                                    <div class="wpr__team_card team-four__item">
                                        <div class="image">
                                            <img src="<?php echo esc_url($tp_team_thumb) ?>" alt="<?php echo esc_attr($tp_team_thumb_alt) ?>">
                                            <?php if (!empty($item['tp_team_social_switch'])) : ?>
                                                <div class="team-four__social">
                                                    <?php if (!empty($item['tp_team_twitter_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_twitter_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_twitter_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_twitter_url']['url']) ?>"><i class="fab fa-twitter"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_facebook_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_facebook_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_facebook_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_facebook_url']['url']) ?>"><i class="fab fa-facebook-f"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_instagram_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_instagram_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_instagram_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_instagram_url']['url']) ?>"><i class="fab fa-instagram"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_linkedin_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_linkedin_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_linkedin_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_linkedin_url']['url']) ?>"><i class="fab fa-linkedin-in"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_youtube_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_youtube_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_youtube_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_youtube_url']['url']) ?>"><i class="fa-brands fa-youtube"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_google_plus_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_google_plus_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_google_plus_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_google_plus_url']['url']) ?>"><i class="fab fa-google-plus-g"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_flickr_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_flickr_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_flickr_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_flickr_url']['url']) ?>"><i class="fab fa-flickr"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_vimeo_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_vimeo_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_vimeo_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_vimeo_url']['url']) ?>"><i class="fab fa-vimeo-v"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_behance_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_behance_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_behance_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_behance_url']['url']) ?>"><i class="fab fa-behance"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_dribble_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_dribble_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_dribble_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_dribble_url']['url']) ?>"><i class="fas fa-basketball-ball"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_pinterest_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_pinterest_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_pinterest_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_pinterest_url']['url']) ?>"><i class="fab fa-pinterest-p"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_github_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_github_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_github_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_github_url']['url']) ?>"><i class="fab fa-github-alt"></i></a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($item['tp_team_title'])) : ?>
                                            <?php
                                            $team_de_url = '#';
                                            $rel         = '';
                                            $target      = '';

                                            if (array_key_exists('tp_team_website_url', $item)) {
                                                $team_de_url = $item['tp_team_details_url']['url'];
                                                $rel         = $item['tp_team_details_url']['nofollow'] ? 'nofollow' : '';
                                                $target      = $item['tp_team_website_url']['is_external'] ? '_blank' : '';
                                            }
                                            ?>
                                            <h5 class="wpr__team_name mt-4">
                                                <a rel="<?php echo esc_attr($rel); ?>" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($team_de_url) ?>"><?php echo esc_html($item['tp_team_title']); ?></a>
                                            </h5>
                                        <?php endif; ?>
                                        <?php if (!empty($item['tp_team_designation'])) : ?>
                                            <span class="wpr__team_designation"> <?php echo esc_html($item['tp_team_designation']) ?> </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-40">
                            <div class="team-four__swiper-scrollbar">
                                <div class="position-relative">
                                    <div class="swiper-scrollbar"></div>
                                </div>
                            </div>
                            <div class="pb-15"></div>
                            <div class="swiper-four__info">
                                <button class="team-four__arry-prev active disable"><i class="fa-regular fa-arrow-left"></i></button>
                                <button class="team-four__arry-next active"><i class="fa-regular fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['tp_team_design_style'] === 'layout-3') :

            $this->add_render_attribute('tp_team_sec_title_attr', 'class', 'tp-section-title');
            $this->add_render_attribute('tp_team_sec_sub_title_attr', 'class', 'tp-section-title-pre');

        ?>

            <section class="team-four-area">
                <div class="container">
                    <div class="row g-4">
                        <?php foreach ($settings['tp_team_repeater_list'] as $key => $item) :
                            if (!empty($item['tp_team_thumb']['url'])) {
                                $tp_team_thumb = !empty($item['tp_team_thumb']['id']) ? wp_get_attachment_image_url($item['tp_team_thumb']['id'], $item['tp_team_thumb_size']) : $item['tp_team_thumb']['url'];
                                $tp_team_thumb_alt = get_post_meta($item["tp_team_thumb"]["id"], "_wp_attachment_image_alt", true);
                            }
                        ?>
                            <div class="col-lg-3 col-sm-6">
                                <div class="wpr__team_card team-four__item">
                                    <div class="image">
                                        <img src="<?php echo esc_url($tp_team_thumb) ?>" alt="<?php echo esc_attr($tp_team_thumb_alt) ?>">
                                        <?php if (!empty($item['tp_team_social_switch'])) : ?>
                                            <div class="team-four__social">
                                                <?php if (!empty($item['tp_team_twitter_url']['url'])) : ?>
                                                    <a rel="<?php echo esc_attr($item['tp_team_twitter_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_twitter_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_twitter_url']['url']) ?>"><i class="fab fa-twitter"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['tp_team_facebook_url']['url'])) : ?>
                                                    <a rel="<?php echo esc_attr($item['tp_team_facebook_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_facebook_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_facebook_url']['url']) ?>"><i class="fab fa-facebook-f"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['tp_team_instagram_url']['url'])) : ?>
                                                    <a rel="<?php echo esc_attr($item['tp_team_instagram_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_instagram_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_instagram_url']['url']) ?>"><i class="fab fa-instagram"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['tp_team_linkedin_url']['url'])) : ?>
                                                    <a rel="<?php echo esc_attr($item['tp_team_linkedin_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_linkedin_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_linkedin_url']['url']) ?>"><i class="fab fa-linkedin-in"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['tp_team_youtube_url']['url'])) : ?>
                                                    <a rel="<?php echo esc_attr($item['tp_team_youtube_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_youtube_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_youtube_url']['url']) ?>"><i class="fa-brands fa-youtube"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['tp_team_google_plus_url']['url'])) : ?>
                                                    <a rel="<?php echo esc_attr($item['tp_team_google_plus_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_google_plus_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_google_plus_url']['url']) ?>"><i class="fab fa-google-plus-g"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['tp_team_flickr_url']['url'])) : ?>
                                                    <a rel="<?php echo esc_attr($item['tp_team_flickr_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_flickr_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_flickr_url']['url']) ?>"><i class="fab fa-flickr"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['tp_team_vimeo_url']['url'])) : ?>
                                                    <a rel="<?php echo esc_attr($item['tp_team_vimeo_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_vimeo_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_vimeo_url']['url']) ?>"><i class="fab fa-vimeo-v"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['tp_team_behance_url']['url'])) : ?>
                                                    <a rel="<?php echo esc_attr($item['tp_team_behance_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_behance_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_behance_url']['url']) ?>"><i class="fab fa-behance"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['tp_team_dribble_url']['url'])) : ?>
                                                    <a rel="<?php echo esc_attr($item['tp_team_dribble_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_dribble_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_dribble_url']['url']) ?>"><i class="fas fa-basketball-ball"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['tp_team_pinterest_url']['url'])) : ?>
                                                    <a rel="<?php echo esc_attr($item['tp_team_pinterest_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_pinterest_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_pinterest_url']['url']) ?>"><i class="fab fa-pinterest-p"></i></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['tp_team_github_url']['url'])) : ?>
                                                    <a rel="<?php echo esc_attr($item['tp_team_github_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_github_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_github_url']['url']) ?>"><i class="fab fa-github-alt"></i></a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($item['tp_team_title'])) : ?>
                                        <?php
                                        $team_de_url = '#';
                                        $rel         = '';
                                        $target      = '';

                                        if (array_key_exists('tp_team_website_url', $item)) {
                                            $team_de_url = $item['tp_team_details_url']['url'];
                                            $rel         = $item['tp_team_details_url']['nofollow'] ? 'nofollow' : '';
                                            $target      = $item['tp_team_website_url']['is_external'] ? '_blank' : '';
                                        }
                                        ?>
                                        <h5 class="wpr__team_name mt-4">
                                            <a rel="<?php echo esc_attr($rel); ?>" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($team_de_url) ?>"><?php echo esc_html($item['tp_team_title']); ?></a>
                                        </h5>
                                    <?php endif; ?>
                                    <?php if (!empty($item['tp_team_designation'])) : ?>
                                        <span class="wpr__team_designation"> <?php echo esc_html($item['tp_team_designation']) ?> </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>


        <?php else :
            $this->add_render_attribute('tp_team_sec_title_attr', 'class', 'tp-section-title');
            $this->add_render_attribute('tp_team_sec_sub_title_attr', 'class', 'tp-section-title-pre');

        ?>

            <section class="team-area">
                <div class="container">
                    <div class="swiper team__slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['tp_team_repeater_list'] as $key => $item) :

                                if (!empty($item['tp_team_thumb']['url'])) {
                                    $tp_team_thumb = !empty($item['tp_team_thumb']['id']) ? wp_get_attachment_image_url($item['tp_team_thumb']['id'], $item['tp_team_thumb_size']) : $item['tp_team_thumb']['url'];
                                    $tp_team_thumb_alt = get_post_meta($item["tp_team_thumb"]["id"], "_wp_attachment_image_alt", true);
                                }

                            ?>
                                <div class="swiper-slide">
                                    <div class="wpr__team_card team__item">
                                        <div class="team__image image">
                                            <img src="<?php echo esc_url($tp_team_thumb) ?>" alt="<?php echo esc_attr($tp_team_thumb_alt) ?>">
                                            <?php if (!empty($item['tp_team_social_switch'])) : ?>
                                                <div class="team__social tp">
                                                    <?php if (!empty($item['tp_team_twitter_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_twitter_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_twitter_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_twitter_url']['url']) ?>"><i class="fab fa-twitter"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_facebook_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_facebook_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_facebook_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_facebook_url']['url']) ?>"><i class="fab fa-facebook-f"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_instagram_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_instagram_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_instagram_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_instagram_url']['url']) ?>"><i class="fab fa-instagram"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_linkedin_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_linkedin_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_linkedin_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_linkedin_url']['url']) ?>"><i class="fab fa-linkedin-in"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_youtube_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_youtube_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_youtube_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_youtube_url']['url']) ?>"><i class="fa-brands fa-youtube"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_google_plus_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_google_plus_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_google_plus_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_google_plus_url']['url']) ?>"><i class="fab fa-google-plus-g"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_flickr_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_flickr_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_flickr_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_flickr_url']['url']) ?>"><i class="fab fa-flickr"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_vimeo_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_vimeo_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_vimeo_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_vimeo_url']['url']) ?>"><i class="fab fa-vimeo-v"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_behance_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_behance_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_behance_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_behance_url']['url']) ?>"><i class="fab fa-behance"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_dribble_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_dribble_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_dribble_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_dribble_url']['url']) ?>"><i class="fas fa-basketball-ball"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_pinterest_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_pinterest_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_pinterest_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_pinterest_url']['url']) ?>"><i class="fab fa-pinterest-p"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($item['tp_team_github_url']['url'])) : ?>
                                                        <a rel="<?php echo esc_attr($item['tp_team_github_url']['nofollow'] ? 'nofollow' : ''); ?>" target="<?php echo esc_attr($item['tp_team_github_url']['is_external'] ? '_blank' : ''); ?>" href="<?php echo esc_url($item['tp_team_github_url']['url']) ?>"><i class="fab fa-github-alt"></i></a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($item['tp_team_title'])) : ?>
                                            <h4 class="wpr__team_name mt-20">
                                                <?php
                                                $team_de_url = '#';
                                                $rel         = '';
                                                $target      = '';

                                                if (array_key_exists('tp_team_website_url', $item)) {
                                                    $team_de_url = $item['tp_team_details_url']['url'];
                                                    $rel         = $item['tp_team_details_url']['nofollow'] ? 'nofollow' : '';
                                                    $target      = $item['tp_team_website_url']['is_external'] ? '_blank' : '';
                                                }
                                                ?>
                                                <a class="wpr__team_name" rel="<?php echo esc_attr($rel); ?>" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($team_de_url) ?>"><?php echo esc_html($item['tp_team_title']); ?></a>
                                            </h4>
                                        <?php endif; ?>
                                        <?php if (!empty($item['tp_team_designation'])) : ?>
                                            <span class="wpr__team_designation"> <?php echo esc_html($item['tp_team_designation']) ?> </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                        <div class="mt-60">
                            <div class="swiper-two__info">
                                <button class="team__arry-prev active"><i class="fa-regular fa-arrow-left-long"></i></button>
                                <div class="dot team__dot"></div>
                                <button class="team__arry-next active"><i class="fa-regular fa-arrow-right-long"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Team());
