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
class TP_Process extends Widget_Base
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
        return 'process';
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
        return __('Process', 'tpcore');
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
            'tp_design_layout',
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

        // title
        $this->start_controls_section(
            'tp_process_title_panel',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_process_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Sub Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your sub title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_process_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_process_desctiption',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_process_priority_thumb',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_process_priority_thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ],
            ]
        );


        $this->add_control(
            'tp_process_priority_thumb_2',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_process_priority_thumb_2',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'tp_process',
            [
                'label' => esc_html__('Repeater', 'tpcore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control(
            'tp_process_step',
            [
                'label' => esc_html__('Process Step', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('1', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_process_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_process_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_process_thumb_switcher',
            [
                'label' => esc_html__('Thumbnail Switch', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );


        $repeater->add_control(
            'tp_process_thumb',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_process_thumb_switcher' => 'yes'
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_process_thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
                'condition' => [
                    'tp_process_thumb_switcher' => 'yes'
                ],
            ]
        );


        $this->add_control(
            'tp_process_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_process_title' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_process_title' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_process_title' => esc_html__('Develop', 'tpcore')
                    ]

                ],
                'title_field' => '{{{ tp_process_title }}}',
            ]
        );

        $this->end_controls_section();


        // Repeater 2
        $this->start_controls_section(
            'tp_process_2',
            [
                'label' => esc_html__('Repeater', 'tpcore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ]

            ]
        );

        $repeater = new Repeater();


        $repeater->add_control(
            'tp_process_step_2',
            [
                'label' => esc_html__('Process Step', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('1', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_process_title_2',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_process_description_2',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_process_thumb_switcher_2',
            [
                'label' => esc_html__('Thumbnail Switch', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );


        $repeater->add_control(
            'tp_process_thumb_2',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_process_thumb_switcher_2' => 'yes'
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_process_thumb_2',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
                'condition' => [
                    'tp_process_thumb_switcher_2' => 'yes'
                ],
            ]
        );


        $this->add_control(
            'tp_process_list_2',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_process_title_2' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_process_title_2' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_process_title_2' => esc_html__('Develop', 'tpcore')
                    ]

                ],
                'title_field' => '{{{ tp_process_title_2 }}}',
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

            if (!empty($settings['tp_process_priority_thumb']['url'])) {
                $tp_process_priority_thumb_url = !empty($settings['tp_process_priority_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_process_priority_thumb']['id'], $settings['tp_process_priority_thumb_size']) : $settings['tp_process_priority_thumb']['url'];
                $tp_process_priority_thumb_alt = get_post_meta($settings["tp_process_priority_thumb"]["id"], "_wp_attachment_image_alt", true);
            }

            if (!empty($settings['tp_process_priority_thumb_2']['url'])) {
                $tp_process_priority_thumb_url_2 = !empty($settings['tp_process_priority_thumb_2']['id']) ? wp_get_attachment_image_url($settings['tp_process_priority_thumb_2']['id'], $settings['tp_process_priority_thumb_2_size']) : $settings['tp_process_priority_thumb_2']['url'];
                $tp_process_priority_thumb_alt_2 = get_post_meta($settings["tp_process_priority_thumb_2"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>


            <section class="process-four-area pt-120">
                <div class="container">
                    <div class="d-flex flex-wrap mb-80 process-four__header justify-content-between gap-3">
                        <?php if (!empty($settings['tp_process_sub_title'])) : ?>
                            <div class="section-header-four">
                                <h5 class="splt-txt wow" data-splitting><span class="title-dot"></span> <?php echo tp_kses($settings['tp_process_sub_title']) ?> </h5>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($settings['tp_process_desctiption'])) : ?>
                            <h3> <?php echo $settings['tp_process_desctiption'] ?> </h3>
                        <?php endif; ?>
                    </div>
                    <div class="row g-5 g-lg-0 align-items-center">
                        <div class="col-lg-3">
                            <?php foreach ($settings['tp_process_list'] as $key => $item) :
                                if (!empty($item['tp_process_thumb']['url'])) {
                                    $tp_process_thumb_url = !empty($item['tp_process_thumb']['id']) ? wp_get_attachment_image_url($item['tp_process_thumb']['id'], $item['tp_process_thumb_size']) : $item['tp_process_thumb']['url'];
                                    $tp_process_thumb_alt = get_post_meta($item["tp_process_thumb"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                                <div class="process-four__item <?php echo ($key == 0) ? '' : 'mt-80' ?>">
                                    <?php if (!empty($item['tp_process_thumb_switcher'])) : ?>
                                        <span class="tp-process-steps-img"> <img src="<?php echo esc_url($tp_process_thumb_url); ?>" alt="<?php echo esc_attr($tp_process_thumb_alt) ?>"> </span>

                                    <?php endif; ?>
                                    <h3><span><?php echo $item['tp_process_step']; ?></span> <?php echo $item['tp_process_title']; ?> </h3>
                                    <p> <?php echo $item['tp_process_description']; ?> </p>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="col-lg-6">
                            <div class="process-four__image">
                                <img class="w-100" src="<?php echo esc_url($tp_process_priority_thumb_url); ?>" alt="<?php echo esc_attr($tp_process_priority_thumb_alt) ?>">
                                <img class="process-point" src="<?php echo esc_url($tp_process_priority_thumb_url_2); ?>" alt="<?php echo esc_attr($tp_process_priority_thumb_alt_2) ?>">
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <?php foreach ($settings['tp_process_list_2'] as $key => $item) :
                                if (!empty($item['tp_process_thumb_2']['url'])) {
                                    $tp_process_thumb_url_2 = !empty($item['tp_process_thumb_2']['id']) ? wp_get_attachment_image_url($item['tp_process_thumb_2']['id'], $item['tp_process_thumb_2_size']) : $item['tp_process_thumb_2']['url'];
                                    $tp_process_thumb_alt_2 = get_post_meta($item["tp_process_thumb_2"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                                <div class="process-four__item <?php echo ($key == 0) ? '' : 'mt-80' ?>">
                                    <?php if (!empty($item['tp_process_thumb_switcher_2'])) : ?>
                                        <span class="tp-process-steps-img"> <img src="<?php echo esc_url($tp_process_thumb_url_2); ?>" alt="<?php echo esc_attr($tp_process_thumb_alt_2) ?>"> </span>

                                    <?php endif; ?>
                                    <h3><span><?php echo $item['tp_process_step_2']; ?></span> <?php echo $item['tp_process_title_2']; ?> </h3>
                                    <p> <?php echo $item['tp_process_description_2']; ?> </p>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </section>





        <?php else : ?>

            <section class="process-area pt-120 pb-120">
                <div class="container">
                    <div class="d-flex flex-wrap mb-80 justify-content-between align-items-end gap-3">
                        <div class="section-header">
                            <?php if (!empty($settings['tp_process_sub_title'])) : ?>
                                <h5 class="wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_process_sub_title']) ?> </h5>
                            <?php endif; ?>
                            <?php if (!empty($settings['tp_process_title'])) : ?>
                                <h2 class="fw-600 wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_process_title']) ?> </h2>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($settings['tp_process_desctiption'])) : ?>
                            <p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_process_desctiption']) ?> </p>
                        <?php endif; ?>
                    </div>
                    <div class="process__wrp">
                        <div class="process__line">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/process-line.png" alt="line">
                        </div>
                        <div class="row g-5">
                            <?php foreach ($settings['tp_process_list'] as $key => $item) :

                                if (!empty($item['tp_process_thumb']['url'])) {
                                    $tp_process_thumb_url = !empty($item['tp_process_thumb']['id']) ? wp_get_attachment_image_url($item['tp_process_thumb']['id'], $item['tp_process_thumb_size']) : $item['tp_process_thumb']['url'];
                                    $tp_process_thumb_alt = get_post_meta($item["tp_process_thumb"]["id"], "_wp_attachment_image_alt", true);
                                }

                            ?>
                                <div class="col-lg-4">
                                    <div class="process__item">
                                        <div class="process__number bg<?php echo $key + 1; ?>">
                                            <h4> <?php echo $item['tp_process_step']; ?> </h4>
                                            <?php if (!empty($item['tp_process_thumb_switcher'])) : ?>
                                                <img src="<?php echo esc_url($tp_process_thumb_url); ?>" alt="<?php echo esc_attr($tp_process_thumb_alt) ?>">
                                            <?php endif; ?>
                                        </div>
                                        <h3 class="mb-10 mt-25 wow splt-txt" data-splitting> <?php echo $item['tp_process_title']; ?> </h3>
                                        <p class="fs-16"> <?php echo $item['tp_process_description']; ?> </p>
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

$widgets_manager->register(new TP_Process());
