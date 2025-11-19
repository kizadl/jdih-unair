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
class TP_Features extends Widget_Base
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
        return 'features';
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
        return __('Features', 'tpcore');
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
        return ['features'];
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

        $this->start_controls_section(
            'tp_features_layout_panel',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_features_design_layout',
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
            'tp_features_content_title_panel',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
                'condition' => [
                    'tp_features_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_features_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Sub Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your sub title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_features_design_layout' => ['layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_features_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_features_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_features_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_features_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->end_controls_section();


        // features
        $this->start_controls_section(
            'tp_features_content_panel',
            [
                'label' => esc_html__('Features', 'tpcore'),
                'condition' => [
                    'tp_features_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tp_features_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                ],
            ]
        );

        $repeater->add_control(
            'tp_features_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_features_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_features_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_features_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_features_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_features_icon_type' => 'icon'
                    ]
                ]
            );
        } // end icon

        $repeater->add_control(
            'tp_features_link_switcher',
            [
                'label' => esc_html__('Button Switch', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_features_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_features_link_switcher' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'tp_features_link_type',
            [
                'label' => esc_html__('Button URL Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom URL',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_features_link_switcher' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_features_link',
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
                    'tp_features_link_type' => '1',
                    'tp_features_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_features_page_link',
            [
                'label' => esc_html__('Internal Page Link', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_features_link_type' => '2',
                    'tp_features_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_features_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_features_animation_delay',
            [
                'label' => esc_html__('Animation Delay', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('200', 'tpcore'),
                'placeholder' => esc_html__('Enter delay time', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_features_animation_duration',
            [
                'label' => esc_html__('Animation Duration', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('1500', 'tpcore'),
                'placeholder' => esc_html__('Enter duration time', 'tpcore'),
                'label_block' => true,
            ]
        );


        $this->add_control(
            'tp_features_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_features_btn_text' => esc_html__('Strategic Planning', 'tpcore'),
                    ],
                    [
                        'tp_features_btn_text' => esc_html__('Content Strategy', 'tpcore')
                    ],
                    [
                        'tp_features_btn_text' => esc_html__('Keyword Research', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_features_btn_text }}}',
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

        <?php if ($settings['tp_features_design_layout']  == 'layout-2') :
        ?>

            <section class="feature-three-area">
                <div class="feature-three__container">
                    <div class="d-flex flex-wrap mb-80 justify-content-between align-items-end gap-3">
                        <div class="section-header">
                            <?php if (!empty($settings['tp_features_sub_title'])) : ?>
                                <h5 class="wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_features_sub_title']); ?> </h5>
                            <?php endif; ?>
                            <?php if (!empty($settings['tp_features_title'])) : ?>
                                <h2 class="fw-600 wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_features_title']); ?> </h2>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($settings['tp_features_description'])) : ?>
                            <p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_features_description']); ?> </p>
                        <?php endif; ?>
                    </div>
                    <div class="row g-5">
                        <?php foreach ($settings['tp_features_list'] as $key => $item) : ?>

                            <?php
                            if ('2' == $item['tp_features_link_type']) {
                                $link = get_permalink($item['tp_features_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tp_features_link']['url']) ? $item['tp_features_link']['url'] : '';
                                $target = !empty($item['tp_features_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tp_features_link']['nofollow']) ? 'nofollow' : '';
                            }
                            ?>
                            <div class="col-xxl-3 col-md-6 wow bounceInUp" data-wow-delay="<?php echo esc_attr($item['tp_features_animation_delay']) ?>ms" data-wow-duration="<?php echo esc_attr($item['tp_features_animation_duration']) ?>ms">
                                <div class="feature-three__item">
                                    <?php if ($item['tp_features_icon_type'] !== 'image') : ?>
                                        <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                                            <?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if (!empty($item['tp_features_image']['url'])) : ?>
                                            <img src="<?php echo $item['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if (!empty($item['tp_features_link_switcher'])) : ?>
                                        <?php if (!empty($link)) : ?>
                                            <h3 class="mt-20 mb-1"> <a href="<?php echo esc_url($link); ?>" rel="<?php echo esc_attr($rel); ?>" target="<?php echo esc_attr($target); ?>"> <?php echo tp_kses($item['tp_features_btn_text']); ?></a> </h3>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if (!empty($item['tp_features_description'])) : ?>
                                        <p> <?php echo tp_kses($item['tp_features_description']) ?> </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>


        <?php else :
        ?>

            <section class="feature-area pb-120">
                <div class="container">
                    <div class="section-header-flex mb-80">
                        <?php if (!empty($settings['tp_features_title'])) : ?>
                            <h2 class="fw-600 splt-txt wow" data-splitting> <?php echo tp_kses($settings['tp_features_title']); ?> </h2>
                        <?php endif; ?>
                        <?php if (!empty($settings['tp_features_description'])) : ?>
                            <p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_features_description']); ?> </p>
                        <?php endif; ?>
                    </div>
                    <div class="row g-5">

                        <?php foreach ($settings['tp_features_list'] as $key => $item) : ?>

                            <?php
                            if ('2' == $item['tp_features_link_type']) {
                                $link = get_permalink($item['tp_features_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tp_features_link']['url']) ? $item['tp_features_link']['url'] : '';
                                $target = !empty($item['tp_features_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tp_features_link']['nofollow']) ? 'nofollow' : '';
                            }
                            ?>
                            <div class="col-lg-4 wow bounceInUp" data-wow-delay="<?php echo esc_attr($item['tp_features_animation_delay']) ?>ms" data-wow-duration="<?php echo esc_attr($item['tp_features_animation_duration']) ?>ms">
                                <div class="feature__item">
                                    <div class="feature__icon bg<?php echo $key + 1; ?> mb-30">
                                        <?php if ($item['tp_features_icon_type'] !== 'image') : ?>
                                            <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                                                <?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <?php if (!empty($item['tp_features_image']['url'])) : ?>
                                                <img src="<?php echo $item['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($item['tp_features_link_switcher'])) : ?>
                                        <?php if (!empty($link)) : ?>
                                            <h3 class="mb-10"> <a href="<?php echo esc_url($link); ?>" rel="<?php echo esc_attr($rel); ?>" target="<?php echo esc_attr($target); ?>"> <?php echo tp_kses($item['tp_features_btn_text']); ?></a></h3>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if (!empty($item['tp_features_description'])) : ?>
                                        <p> <?php echo tp_kses($item['tp_features_description']) ?> </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>





        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Features());
