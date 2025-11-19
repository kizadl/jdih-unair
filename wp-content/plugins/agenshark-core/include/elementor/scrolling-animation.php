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
class TP_Scrolling_Animation extends Widget_Base
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
        return 'scrolling-animation';
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
        return __('Scrolling Animation', 'tpcore');
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
        return ['scrolling animation'];
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
            'tp_service_design_layout_section',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_scrolling_animation_design_layout',
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

        // repeater 1
        $this->start_controls_section(
            'tp_scrolling_animation_content_section',
            [
                'label' => esc_html__('Repeater - 1 ', 'tpcore'),
                'condition' => [
                    'tp_scrolling_animation_design_layout' => ['layout-1']
                ]
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control(
            'tp_scrolling_animation_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_scrolling_animation_link',
            [
                'label' => esc_html__('Link', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_scrolling_animation_icon_type',
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
            'tp_scrolling_animation_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_scrolling_animation_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_scrolling_animation_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_scrolling_animation_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_scrolling_animation_selected_icon',
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
                        'tp_scrolling_animation_icon_type' => 'icon'
                    ]
                ]
            );
        } // end icon

        $this->add_control(
            'tp_scrolling_animation_title_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_scrolling_animation_title' => esc_html__('Lets Talk Now', 'tpcore'),
                    ],
                    [
                        'tp_scrolling_animation_title' => esc_html__('Lets Talk Now', 'tpcore')
                    ],
                    [
                        'tp_scrolling_animation_title' => esc_html__('Lets Talk Now', 'tpcore')
                    ],
                    [
                        'tp_scrolling_animation_title' => esc_html__('Lets Talk Now', 'tpcore')
                    ],
                    [
                        'tp_scrolling_animation_title' => esc_html__('Lets Talk Now', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_scrolling_animation_title }}}',
            ]
        );

        $this->end_controls_section();


        // repeater 2
        $this->start_controls_section(
            'tp_scrolling_animation_content_section_2',
            [
                'label' => esc_html__('Repeater - 2 ', 'tpcore'),
                'condition' => [
                    'tp_scrolling_animation_design_layout' => ['layout-1']
                ]
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control(
            'tp_scrolling_animation_title_2',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_scrolling_animation_link_2',
            [
                'label' => esc_html__('Link', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_scrolling_animation_icon_type_2',
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
            'tp_scrolling_animation_image_2',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_scrolling_animation_icon_type_2' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_scrolling_animation_icon_2',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_scrolling_animation_icon_type_2' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_scrolling_animation_selected_icon_2',
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
                        'tp_scrolling_animation_icon_type_2' => 'icon'
                    ]
                ]
            );
        } // end icon

        $this->add_control(
            'tp_scrolling_animation_title_list_2',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_scrolling_animation_title_2' => esc_html__('Lets Talk Now', 'tpcore'),
                    ],
                    [
                        'tp_scrolling_animation_title_2' => esc_html__('Lets Talk Now', 'tpcore')
                    ],
                    [
                        'tp_scrolling_animation_title_2' => esc_html__('Lets Talk Now', 'tpcore')
                    ],
                    [
                        'tp_scrolling_animation_title_2' => esc_html__('Lets Talk Now', 'tpcore')
                    ],
                    [
                        'tp_scrolling_animation_title_2' => esc_html__('Lets Talk Now', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_scrolling_animation_title_2 }}}',
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

        <?php if ($settings['tp_scrolling_animation_design_layout']  == 'layout-2') :
        ?>


        <?php else : ?>

            <section class="marquee-two-area">
                <div class="marquee__wrp">
                    <div class="marquee__slide">
                        <div class="marquee-two__item-wrp">
                            <?php foreach ($settings['tp_scrolling_animation_title_list'] as $key => $item) : ?>
                                <div class="marquee-two__item">
                                    <h4>
                                        <a class="text-white" href="<?php echo esc_url($item['tp_scrolling_animation_link']['url']); ?>">
                                            <?php if ($item['tp_scrolling_animation_icon_type'] !== 'image') : ?>
                                                <?php if (!empty($item['tp_scrolling_animation_icon']) || !empty($item['tp_scrolling_animation_selected_icon']['value'])) : ?>
                                                    <?php tp_render_icon($item, 'tp_scrolling_animation_icon', 'tp_scrolling_animation_selected_icon'); ?>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <?php if (!empty($item['tp_scrolling_animation_image']['url'])) : ?>
                                                    <img src="<?php echo $item['tp_scrolling_animation_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_scrolling_animation_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php echo $item['tp_scrolling_animation_title']; ?> </a>
                                    </h4>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="marquee-two__item-wrp">
                            <?php foreach ($settings['tp_scrolling_animation_title_list_2'] as $key => $item) : ?>
                                <div class="marquee-two__item">
                                    <h4>
                                        <a class="text-white" href="<?php echo esc_url($item['tp_scrolling_animation_link_2']['url']); ?>">
                                            <?php if ($item['tp_scrolling_animation_icon_type_2'] !== 'image') : ?>
                                                <?php if (!empty($item['tp_scrolling_animation_icon_2']) || !empty($item['tp_scrolling_animation_selected_icon_2']['value'])) : ?>
                                                    <?php tp_render_icon($item, 'tp_scrolling_animation_icon_2', 'tp_scrolling_animation_selected_icon_2'); ?>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <?php if (!empty($item['tp_scrolling_animation_image_2']['url'])) : ?>
                                                    <img src="<?php echo $item['tp_scrolling_animation_image_2']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_scrolling_animation_image_2']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php echo $item['tp_scrolling_animation_title_2']; ?> </a></a>
                                    </h4>
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

$widgets_manager->register(new TP_Scrolling_Animation());
