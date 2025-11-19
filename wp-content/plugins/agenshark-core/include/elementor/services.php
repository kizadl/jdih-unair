<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Services extends Widget_Base
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
        return 'services';
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
        return __('Services', 'tpcore');
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
        return ['services'];
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
            'tp_service_design_layout',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                    'layout-4' => esc_html__('Layout 4', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // content section
        $this->start_controls_section(
            'tp_service_content_section',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_service_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Sub Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your sub title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_service_design_layout' => ['layout-3', 'layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_service_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_service_design_layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_service_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_service_design_layout' => ['layout-1', 'layout-3', 'layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_service_link_switcher',
            [
                'label' => esc_html__('Button Switch', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'tp_service_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_service_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_service_link_switcher' => 'yes',
                    'tp_service_design_layout' => 'layout-1'
                ],
            ]
        );

        $this->add_control(
            'tp_service_link_type',
            [
                'label' => esc_html__('Button URL Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom URL',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_service_link_switcher' => 'yes',
                    'tp_service_design_layout' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'tp_service_link',
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
                    'tp_service_link_type' => '1',
                    'tp_service_link_switcher' => 'yes',
                    'tp_service_design_layout' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'tp_service_page_link',
            [
                'label' => esc_html__('Internal Page Link', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_service_link_type' => '2',
                    'tp_service_link_switcher' => 'yes',
                    'tp_service_design_layout' => 'layout-1'
                ]
            ]
        );

        $this->end_controls_section();


        // service repeater 
        $this->start_controls_section(
            'tp_service_repeater_content_section',
            [
                'label' => esc_html__('Repeater ', 'tpcore'),
                'condition' => [
                    'tp_service_design_layout' => ['layout-1', 'layout-2', 'layout-3']
                ]
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control(
            'tp_service_repeater_title',
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
            'tp_service_repeater_description',
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
            'tp_service_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                ],
            ]
        );

        $repeater->add_control(
            'tp_service_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_service_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_service_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_service_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_service_selected_icon',
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
                        'tp_service_icon_type' => 'icon'
                    ]
                ]
            );
        } // end icon

        // btn
        $repeater->add_control(
            'tp_service_repeater_link_switcher',
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
            'tp_service_repeater_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_service_repeater_link_switcher' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'tp_service_repeater_link_type',
            [
                'label' => esc_html__('Button URL Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom URL',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_service_repeater_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_service_repeater_link',
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
                    'tp_service_repeater_link_type' => '1',
                    'tp_service_repeater_link_switcher' => 'yes',
                ]
            ]
        );


        $repeater->add_control(
            'tp_service_repeater_page_link',
            [
                'label' => esc_html__('Internal Page Link', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_service_repeater_link_type' => '2',
                    'tp_service_repeater_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_service_repeater_animation_delay',
            [
                'label' => esc_html__('Animation Delay', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('200', 'tpcore'),
                'placeholder' => esc_html__('Enter animation delay', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_repeater_animation_duration',
            [
                'label' => esc_html__('Animation Duration', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('1500', 'tpcore'),
                'placeholder' => esc_html__('Enter animation duration', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_repeater_thumb_switcher',
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
            'tp_service_repeater_thumb',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_service_repeater_thumb_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_service_repeater_thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
                'condition' => [
                    'tp_service_repeater_thumb_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_service_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_service_repeater_title' => esc_html__('Technology Solutions', 'tpcore'),
                    ],
                    [
                        'tp_service_repeater_title' => esc_html__('Consulting and Strategy', 'tpcore')
                    ],
                    [
                        'tp_service_repeater_title' => esc_html__('Data Analytics', 'tpcore')
                    ],
                    [
                        'tp_service_repeater_title' => esc_html__('Product Development', 'tpcore')
                    ],
                    [
                        'tp_service_repeater_title' => esc_html__('Financial Consulting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_service_repeater_title }}}',
            ]
        );

        $this->end_controls_section();


        // service repeater v_4
        $this->start_controls_section(
            'tp_service_v_4_content_section',
            [
                'label' => esc_html__('Repeater ', 'tpcore'),
                'condition' => [
                    'tp_service_design_layout' => ['layout-4']
                ]
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control(
            'tp_service_v_4_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_service_v_4_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_service_v_4_title' => esc_html__('Technology Solutions', 'tpcore'),
                    ],
                    [
                        'tp_service_v_4_title' => esc_html__('Consulting and Strategy', 'tpcore')
                    ],
                    [
                        'tp_service_v_4_title' => esc_html__('Data Analytics', 'tpcore')
                    ],
                    [
                        'tp_service_v_4_title' => esc_html__('Product Development', 'tpcore')
                    ],
                    [
                        'tp_service_v_4_title' => esc_html__('Financial Consulting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_service_v_4_title }}}',
            ]
        );

        $this->end_controls_section();

        // service repeater v_5
        $this->start_controls_section(
            'tp_service_v_5_content_section',
            [
                'label' => esc_html__('Repeater ', 'tpcore'),
                'condition' => [
                    'tp_service_design_layout' => ['layout-4']
                ]
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control(
            'tp_service_v_5_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_service_v_5_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_service_v_5_title' => esc_html__('Technology Solutions', 'tpcore'),
                    ],
                    [
                        'tp_service_v_5_title' => esc_html__('Consulting and Strategy', 'tpcore')
                    ],
                    [
                        'tp_service_v_5_title' => esc_html__('Data Analytics', 'tpcore')
                    ],
                    [
                        'tp_service_v_5_title' => esc_html__('Product Development', 'tpcore')
                    ],
                    [
                        'tp_service_v_5_title' => esc_html__('Financial Consulting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_service_v_5_title }}}',
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
        <?php if ($settings['tp_service_design_layout'] == 'layout-4'):
            ?>

            <section class="service-four-area pt-120 pb-120">
                <div class="container">
                    <div class="section-header-four mb-40 text-center">
                        <?php if (!empty($settings['tp_service_sub_title'])): ?>
                            <h5 class="wow splt-txt" data-splitting><span class="title-dot"></span>
                                <?php echo tp_kses($settings['tp_service_sub_title']) ?> </h5>
                        <?php endif; ?>
                        <?php if (!empty($settings['tp_service_title'])): ?>
                            <h2 class="wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_service_title']) ?> </h2>
                        <?php endif; ?>
                        <?php if (!empty($settings['tp_service_description'])): ?>
                            <p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                                <?php echo tp_kses($settings['tp_service_description']) ?> </p>
                        <?php endif; ?>
                    </div>

                    <div class="service-four__accordion accordion-four">
                        <div class="accordion" id="accordionExample-<?php echo esc_attr($this->get_id()); ?>">
                            <?php foreach ($settings['tp_service_v_4_list'] as $index => $item):
                                $collapsed = ($index == '0') ? '' : 'collapsed';
                                $aria_expanded = ($index == '0') ? "true" : "false";
                                $show = ($index == '0') ? "show" : "";
                                ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne-<?php echo esc_attr($index); ?>">
                                        <button class="accordion-button <?php echo esc_attr($collapsed); ?>" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>"
                                            aria-expanded="true" aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
                                            <span class="main-wrp">
                                                <span class="sub-wrp">
                                                    <span class="acc-number">01</span>
                                                    <span class="acc-title"><?php echo tp_kses($item['tp_service_v_4_title']) ?></span>
                                                </span>
                                                <span class="acc-text">Craft visually appealing and user-friendly
                                                    interfaces.
                                                    Enhance user
                                                    experience
                                                    through intuitive design.</span>
                                            </span>
                                        </button>
                                    </h2>
                                    <div id="collapseOne-<?php echo esc_attr($index); ?>"
                                        class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
                                        aria-labelledby="headingOne-<?php echo esc_attr($index); ?>"
                                        data-bs-parent="#accordionExample-<?php echo esc_attr($this->get_id()); ?>">
                                        <div class="accordion-body">
                                            <div class="swiper service-four__slider">
                                                <div class="swiper-wrapper">
                                                    <?php foreach ($settings['tp_service_v_5_list'] as $key => $item): ?>
                                                        <div class="swiper-slide">
                                                            <div class="service-four__item">
                                                                <div class="service-four__image mb-40">
                                                                    <img class="img-fluid"
                                                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service-four-image2.png"
                                                                        alt="image">
                                                                </div>
                                                                <div
                                                                    class="d-flex align-items-center  justify-content-between gap-3 sflex-wrap px-3">
                                                                    <div class="content">
                                                                        <h3><a
                                                                                href="https://wprealizer.com/wp/agenshark/project-details/"><?php echo tp_kses($item['tp_service_v_5_title']) ?></a>
                                                                        </h3>
                                                                        <p class="fs-16">Create visual materials such as
                                                                            logos,
                                                                            branding materials, marketing
                                                                            collateral,
                                                                            and web graphics.</p>
                                                                    </div>
                                                                    <a href="https://wprealizer.com/wp/agenshark/project-details/"
                                                                        class="btn-four">View
                                                                        Full
                                                                        Project
                                                                        <span>
                                                                            <i class="fa-regular fa-arrow-right arry1"></i>
                                                                            <i class="fa-regular fa-arrow-right arry2"></i>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="mt-40">
                                                <div class="position-relative">
                                                    <div class="service-four__scrollbar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>


        <?php elseif ($settings['tp_service_design_layout'] == 'layout-3'):
            ?>

            <section class="service-three-area">
                <div class="container">
                    <div class="section-header mb-80 text-center">

                        <?php if (!empty($settings['tp_service_sub_title'])): ?>
                            <h5 class="wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_service_sub_title']) ?> </h5>
                        <?php endif; ?>

                        <?php if (!empty($settings['tp_service_title'])): ?>
                            <h2 class="fw-600 wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_service_title']) ?> </h2>
                        <?php endif; ?>

                        <?php if (!empty($settings['tp_service_description'])): ?>
                            <p class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                                <?php echo tp_kses($settings['tp_service_description']) ?> </p>
                        <?php endif; ?>

                    </div>

                    <div class="row g-4">
                        <?php foreach ($settings['tp_service_list'] as $key => $item):
                            if ('2' == $item['tp_service_repeater_link_type']) {
                                $service_link = get_permalink($item['tp_service_repeater_page_link']);
                                $service_target = '_self';
                                $service_rel = 'nofollow';
                            } else {
                                $service_link = !empty($item['tp_service_repeater_link']['url']) ? $item['tp_service_repeater_link']['url'] : '';
                                $service_target = !empty($item['tp_service_repeater_link']['is_external']) ? '_blank' : '';
                                $service_rel = !empty($item['tp_service_repeater_link']['nofollow']) ? 'nofollow' : '';
                            }

                            if (!empty($item['tp_service_repeater_thumb']['url'])) {
                                $tp_service_repeater_thumb_url = !empty($item['tp_service_repeater_thumb']['id']) ? wp_get_attachment_image_url($item['tp_service_repeater_thumb']['id'], $item['tp_service_repeater_thumb_size']) : $item['tp_service_repeater_thumb']['url'];
                                $tp_service_repeater_thumb_alt = get_post_meta($item["tp_service_repeater_thumb"]["id"], "_wp_attachment_image_alt", true);
                            }


                            ?>
                            <div class="col-xl-<?php if ($key == 3) {
                                echo $key + 5;
                            } elseif ($key == 6) {
                                echo $key + 2;
                            } else {
                                echo "4";
                            } ?>">
                                <div
                                    class="<?php echo ($key == 3 || $key == 6) ? 'service-three__item gap-3 d-flex align-items-end' : ''; ?>">
                                    <div class=" service-three__item <?php echo ($key == 3 || $key == 6) ? 'p-0' : ''; ?>">
                                        <div class="service-three__icon mb-20">
                                            <?php if ($item['tp_service_icon_type'] !== 'image'): ?>
                                                <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])): ?>
                                                    <?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if (!empty($item['tp_service_image']['url'])): ?>
                                                    <img src="<?php echo $item['tp_service_image']['url']; ?>"
                                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($item['tp_service_repeater_link_switcher'])): ?>
                                            <h3 class="mb-10">
                                                <?php if (!empty($service_link)): ?>
                                                    <a class="splt-txt wow" href="<?php echo esc_url($service_link); ?>"
                                                        rel="<?php echo esc_attr($service_rel); ?>"
                                                        target="<?php echo esc_attr($service_target); ?>" data-splitting>
                                                        <?php echo tp_kses($item['tp_service_repeater_btn_text']); ?> </a>
                                                <?php endif; ?>
                                            </h3>
                                        <?php endif; ?>
                                        <p> <?php echo tp_kses($item['tp_service_repeater_description']); ?> </p>
                                    </div>
                                    <?php if (!empty($item['tp_service_repeater_thumb_switcher'])): ?>
                                        <div class="service-three__image">
                                            <img src="<?php echo esc_url($tp_service_repeater_thumb_url); ?>"
                                                alt="<?php echo esc_url($tp_service_repeater_thumb_alt); ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['tp_service_design_layout'] == 'layout-2'):
            ?>

            <section class="service-two-area pt-120 pb-120">
                <div class="container">
                    <div class="section-header text-center mb-80">
                        <?php if (!empty($settings['tp_service_title'])): ?>
                            <h2 class="fw-600 splt-txt wow" data-splitting> <?php echo tp_kses($settings['tp_service_title']); ?> </h2>
                        <?php endif; ?>
                    </div>
                    <div class="row g-4">
                        <?php foreach ($settings['tp_service_list'] as $key => $item):
                            if ('2' == $item['tp_service_repeater_link_type']) {
                                $service_link = get_permalink($item['tp_service_repeater_page_link']);
                                $service_target = '_self';
                                $service_rel = 'nofollow';
                            } else {
                                $service_link = !empty($item['tp_service_repeater_link']['url']) ? $item['tp_service_repeater_link']['url'] : '';
                                $service_target = !empty($item['tp_service_repeater_link']['is_external']) ? '_blank' : '';
                                $service_rel = !empty($item['tp_service_repeater_link']['nofollow']) ? 'nofollow' : '';
                            }

                            ?>
                            <div class="col-lg-6 wow bounceInUp"
                                data-wow-delay="<?php echo $item['tp_service_repeater_animation_delay'] ?>ms"
                                data-wow-duration="<?php echo $item['tp_service_repeater_animation_duration'] ?>ms">
                                <div class="service-two__item bg<?php echo $key + 1; ?>">
                                    <div class="icon">
                                        <?php if ($item['tp_service_icon_type'] !== 'image'): ?>
                                            <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])): ?>
                                                <?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if (!empty($item['tp_service_image']['url'])): ?>
                                                <img src="<?php echo $item['tp_service_image']['url']; ?>"
                                                    alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="service-two__content">
                                        <h3 class="mb-10"> <?php echo tp_kses($item['tp_service_repeater_title']); ?> </h3>
                                        <p class="mb-20"> <?php echo tp_kses($item['tp_service_repeater_description']); ?> </p>
                                        <?php if (!empty($item['tp_service_repeater_link_switcher'])): ?>
                                            <?php if (!empty($service_link)): ?>
                                                <a class="explore-btn" href="<?php echo esc_url($service_link); ?>"
                                                    rel="<?php echo esc_attr($service_rel); ?>"
                                                    target="<?php echo esc_attr($service_target); ?>">
                                                    <?php echo tp_kses($item['tp_service_repeater_btn_text']); ?> <i
                                                        class="fa-light ms-1 fa-arrow-right"></i></a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

        <?php else:

            // btn 
            if ('2' == $settings['tp_service_link_type']) {
                $link = get_permalink($settings['tp_service_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_service_link']['url']) ? $settings['tp_service_link']['url'] : '';
                $target = !empty($settings['tp_service_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_service_link']['nofollow']) ? 'nofollow' : '';
            }

            ?>

            <section class="agenshark-wrap service-area sub-bg pt-120 pb-120">
                <div class="service__shape1 sway__animationX">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/service-shape1.png" alt="shape">
                </div>
                <div class="service__shape2 sway_Y__animationY">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/service-shape2.png" alt="shape">
                </div>
                <div class="container">
                    <div class="row g-4">
                        <div class="col-xl-4 col-md-6">
                            <div class="section-header line-title">
                                <?php if (!empty($settings['tp_service_title'])): ?>
                                    <h2 class="fw-600 splt-txt wow" data-splitting>
                                        <span> <?php echo tp_kses($settings['tp_service_title']); ?> <img
                                                src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/title-line-service.png"
                                                alt="shape"></span>
                                    </h2>
                                <?php endif; ?>
                                <?php if (!empty($settings['tp_service_description'])): ?>
                                    <p class="wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                        <?php echo tp_kses($settings['tp_service_description']); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($settings['tp_service_link_switcher'])): ?>
                                    <a href="<?php echo esc_url($link); ?>" class="btn-one active wow fadeInUp mt-30"
                                        data-wow-delay="600ms" data-wow-duration="1500ms" rel="<?php echo esc_attr($rel); ?>"
                                        target="<?php echo esc_attr($target); ?>">
                                        <?php echo tp_kses($settings['tp_service_btn_text']); ?>
                                        <span>
                                            <i class="fa-regular fa-arrow-up-right arry1"></i>
                                            <i class="fa-regular fa-arrow-up-right arry2"></i>
                                        </span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php foreach ($settings['tp_service_list'] as $key => $item):
                            if ('2' == $item['tp_service_repeater_link_type']) {
                                $service_link = get_permalink($item['tp_service_repeater_page_link']);
                                $service_target = '_self';
                                $service_rel = 'nofollow';
                            } else {
                                $service_link = !empty($item['tp_service_repeater_link']['url']) ? $item['tp_service_repeater_link']['url'] : '';
                                $service_target = !empty($item['tp_service_repeater_link']['is_external']) ? '_blank' : '';
                                $service_rel = !empty($item['tp_service_repeater_link']['nofollow']) ? 'nofollow' : '';
                            }

                            ?>
                            <div class="col-xl-4 col-md-6">
                                <div class="service__item <?php echo ($key) ? '' : 'active'; ?>">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="icon">
                                            <?php if ($item['tp_service_icon_type'] !== 'image'): ?>
                                                <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])): ?>
                                                    <?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if (!empty($item['tp_service_image']['url'])): ?>
                                                    <img src="<?php echo $item['tp_service_image']['url']; ?>"
                                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <h4 class="splt-txt wow" data-splitting>
                                            <?php echo tp_kses($item['tp_service_repeater_title']); ?> </h4>
                                    </div>
                                    <p class="mt-20 pb-20 fs-16"> <?php echo tp_kses($item['tp_service_repeater_description']); ?> </p>
                                    <?php if (!empty($item['tp_service_repeater_link_switcher'])): ?>
                                        <?php if (!empty($service_link)): ?>
                                            <a class="tp-text-black" href="<?php echo esc_url($service_link); ?>"
                                                rel="<?php echo esc_attr($service_rel); ?>" target="<?php echo esc_attr($service_target); ?>">
                                                <?php echo tp_kses($item['tp_service_repeater_btn_text']); ?> <i
                                                    class="fa-light ms-1 fa-arrow-right"></i></a>
                                        <?php endif; ?>
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

$widgets_manager->register(new TP_Services());
