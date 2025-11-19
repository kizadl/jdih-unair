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
class TP_About extends Widget_Base
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
        return 'about';
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
        return __('About Us', 'tpcore');
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
        return ['about', 'company', 'company intro', 'intro'];
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
            'tp_about_design_layout_section',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_about_design_layout',
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

        // content section
        $this->start_controls_section(
            'tp_about_content_section',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_about_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Sub Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your sub title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_about_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_about_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_about_mission_title',
            [
                'label' => esc_html__('Mission Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_about_mission_description',
            [
                'label' => esc_html__('Mission Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_about_vission_title',
            [
                'label' => esc_html__('Vission Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_about_vission_description',
            [
                'label' => esc_html__('Vission Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1']
                ]
            ]
        );


        $this->end_controls_section();


        // info content section
        $this->start_controls_section(
            'tp_about_funfact_content_section',
            [
                'label' => esc_html__('Funfact', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_about_funfact_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_about_funfact_porject_count',
            [
                'label' => esc_html__('Project Count', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('10', 'tpcore'),
                'placeholder' => esc_html__('Enter number here', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_about_funfact_project_title',
            [
                'label' => esc_html__('Project Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1']
                ]
            ]
        );


        $this->add_control(
            'tp_about_funfact_clients_count',
            [
                'label' => esc_html__('Clients Count', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('97', 'tpcore'),
                'placeholder' => esc_html__('Enter number here', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_about_funfact_clients_title',
            [
                'label' => esc_html__('Clients Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_about_funfact_project_complete_count',
            [
                'label' => esc_html__('Project Completed Count', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('84', 'tpcore'),
                'placeholder' => esc_html__('Enter number here', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_about_funfact_project_complete_title',
            [
                'label' => esc_html__('Project Completed Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_about_funfact_experience_count',
            [
                'label' => esc_html__('Experience Count', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('15', 'tpcore'),
                'placeholder' => esc_html__('Enter number here', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_about_funfact_experience_title',
            [
                'label' => esc_html__('Experience Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_about_design_layout' => ['layout-1']
                ]
            ]
        );


        $this->end_controls_section();


        // fact v_2
        $this->start_controls_section(
            'tp_about_fact_content_section',
            [
                'label' => esc_html__('Funfact', 'tpcore'),
                'condition' => [
                    'tp_about_design_layout' => ['layout-2']
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tp_about_fact_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Sub Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your sub title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_about_fact_number',
            [
                'label' => esc_html__('Number', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('800', 'tpcore'),
                'placeholder' => esc_html__('Enter your number', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_about_fact_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_about_fact_animation_delay',
            [
                'label' => esc_html__('Animation Delay', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('200', 'tpcore'),
                'placeholder' => esc_html__('Enter animation delay', 'tpcore'),
                'label_block' => true,
            ]

        );
        $repeater->add_control(
            'tp_about_fact_animation_duration',
            [
                'label' => esc_html__('Animation Duration', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('500', 'tpcore'),
                'placeholder' => esc_html__('Enter animation duration', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_about_fact_icon_type',
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
            'tp_about_fact_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_about_fact_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_about_fact_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_about_fact_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_about_fact_selected_icon',
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
                        'tp_about_fact_icon_type' => 'icon'
                    ]
                ]
            );
        } // end icon


        $this->add_control(
            'tp_about_fact_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_about_fact_sub_title' => esc_html__('Projects Completed', 'tpcore'),
                    ],
                    [
                        'tp_about_fact_sub_title' => esc_html__('Satisfied Clients', 'tpcore')
                    ],
                    [
                        'tp_about_fact_sub_title' => esc_html__('Years of Expertise', 'tpcore')
                    ],
                    [
                        'tp_about_fact_sub_title' => esc_html__('Dynamic Team Members', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_about_fact_sub_title }}}',
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

        <?php if ($settings['tp_about_design_layout']  == 'layout-2') :
        ?>

            <section class="about-four-area pt-120">
                <div class="container">
                    <div class="d-flex flex-wrap mb-80 justify-content-between align-items-end gap-3">
                        <div class="section-header-four">
                            <?php if ($settings['tp_about_sub_title']) : ?>
                                <h5 class="wow splt-txt" data-splitting><span class="title-dot"></span> <?php echo tp_kses($settings['tp_about_sub_title']) ?> </h5>
                            <?php endif; ?>
                            <?php if ($settings['tp_about_title']) : ?>
                                <h2 class="wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_about_title']) ?> </h2>
                            <?php endif; ?>
                        </div>
                        <?php if ($settings['tp_about_description']) : ?>
                            <p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_about_description']) ?> </p>
                        <?php endif; ?>

                    </div>

                    <div class="about-four__wrp pt-60 pb-60">
                        <div class="row g-5">

                            <?php foreach ($settings['tp_about_fact_list'] as $key => $item) : ?>
                                <div class="col-xxl-3 col-md-6 wow bounceInUp" data-wow-delay="<?php echo $item['tp_about_fact_animation_delay'] ?>ms" data-wow-duration="<?php echo $item['tp_about_fact_animation_duration'] ?>ms">
                                    <div class="about-four__item">
                                        <h5 class="mb-20">/ <?php echo tp_kses($item['tp_about_fact_sub_title']) ?> </h5>
                                        <div class="d-flex align-items-center justify-content-between gap-4">
                                            <h2><span class="count"> <?php echo tp_kses($item['tp_about_fact_number']) ?> </span>+</h2>
                                            <?php if ($item['tp_about_fact_icon_type'] !== 'image') : ?>
                                                <?php if (!empty($item['tp_about_fact_icon']) || !empty($item['tp_about_fact_selected_icon']['value'])) : ?>
                                                    <?php tp_render_icon($item, 'tp_about_fact_icon', 'tp_about_fact_selected_icon'); ?>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <?php if (!empty($item['tp_about_fact_image']['url'])) : ?>
                                                    <img src="<?php echo $item['tp_about_fact_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_about_fact_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <p class="fs-16 mt-2"> <?php echo tp_kses($item['tp_about_fact_description']) ?> </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </section>
        <?php else : ?>

            <section class="agenshark-wrap fanfact-area fanfact-radius pt-120 pb-120">
                <div class="container">
                    <div class="row g-4 justify-content-between">
                        <div class="col-lg-5">
                            <div class="fanfact__item-left">
                                <?php if (!empty($settings['tp_about_title'])) : ?>
                                    <h2 class="splt-txt wow" data-splitting> <?php echo tp_kses($settings['tp_about_title']) ?> </h2>
                                <?php endif; ?>
                                <?php if (!empty($settings['tp_about_description'])) : ?>
                                    <p class="mb-40 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"><?php echo tp_kses($settings['tp_about_description']) ?> </p>
                                <?php endif; ?>
                                <?php if (!empty($settings['tp_about_mission_title'])) : ?>
                                    <h2 class="splt-txt wow" data-splitting> <?php echo tp_kses($settings['tp_about_mission_title']) ?> </h2>
                                <?php endif; ?>
                                <?php if (!empty($settings['tp_about_mission_description'])) : ?>
                                    <p class="mb-30"> <?php echo tp_kses($settings['tp_about_mission_description']) ?> </p>
                                <?php endif; ?>
                                <?php if (!empty($settings['tp_about_vission_title'])) : ?>
                                    <h2 class="splt-txt wow" data-splitting> <?php echo tp_kses($settings['tp_about_vission_title']) ?> </h2>
                                <?php endif; ?>
                                <?php if (!empty($settings['tp_about_vission_description'])) : ?>
                                    <p> <?php echo tp_kses($settings['tp_about_vission_description']) ?> </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="tp-fanfact-area">
                                <?php if (!empty($settings['tp_about_funfact_title'])) : ?>
                                    <h2 class="mb-60 wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_about_funfact_title']) ?> </h2>
                                <?php endif; ?>
                                <div class="fanfact__item-right">
                                    <div class="fanfact__item mb-60">
                                        <?php if (!empty($settings['tp_about_funfact_porject_count'])) : ?>
                                            <h2 class="mb-10"><span class="count"><?php echo esc_html($settings['tp_about_funfact_porject_count']); ?></span>K+</h2>
                                        <?php endif; ?>
                                        <?php if (!empty($settings['tp_about_funfact_project_title'])) : ?>
                                            <strong> <?php echo tp_kses($settings['tp_about_funfact_project_title']) ?> </strong>
                                        <?php endif; ?>
                                    </div>
                                    <div class="fanfact__item">
                                        <?php if (!empty($settings['tp_about_funfact_clients_count'])) : ?>
                                            <h2 class="mb-10"><span class="count"><?php echo esc_html($settings['tp_about_funfact_clients_count']); ?></span>%</h2>
                                        <?php endif; ?>
                                        <?php if (!empty($settings['tp_about_funfact_clients_title'])) : ?>
                                            <strong> <?php echo tp_kses($settings['tp_about_funfact_clients_title']) ?></strong>
                                        <?php endif; ?>
                                    </div>
                                    <div class="fanfact__item">
                                        <?php if (!empty($settings['tp_about_funfact_project_complete_count'])) : ?>
                                            <h2 class="mb-10"><span class="count"><?php echo esc_html($settings['tp_about_funfact_project_complete_count']); ?></span>%</h2>
                                        <?php endif; ?>
                                        <?php if (!empty($settings['tp_about_funfact_project_complete_title'])) : ?>
                                            <strong> <?php echo tp_kses($settings['tp_about_funfact_project_complete_title']) ?> </strong>
                                        <?php endif; ?>
                                    </div>
                                    <div class="fanfact__item">
                                        <?php if (!empty($settings['tp_about_funfact_experience_count'])) : ?>
                                            <h2 class="mb-10"><span class="count"><?php echo esc_html($settings['tp_about_funfact_experience_count']); ?></span>+</h2>
                                        <?php endif; ?>
                                        <?php if (!empty($settings['tp_about_funfact_experience_title'])) : ?>
                                            <strong> <?php echo tp_kses($settings['tp_about_funfact_experience_title']) ?> </strong>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_About());
