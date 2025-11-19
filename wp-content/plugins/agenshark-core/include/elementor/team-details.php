<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;


if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Team_Details extends Widget_Base
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
        return 'team-details';
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
        return __('Team Details', 'tpcore');
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

        // _tp_image
        $this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Profile', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__('Choose Image', 'tpcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'tp_profile_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_profile_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Sub Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter sub your title', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_profile_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum door emmet text', 'tpcore'),
                'placeholder' => esc_html__('Enter your description here', 'tpcore'),
            ]
        );

        $social_repeater = new Repeater();


        $social_repeater->add_control(
            'tp_social_icon_type',
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

        $social_repeater->add_control(
            'tp_social_icon_image',
            [
                'label' => esc_html__('Choose Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_social_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $social_repeater->add_control(
                'tp_social_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_social_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $social_repeater->add_control(
                'tp_social_selected_icon',
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
                        'tp_social_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $social_repeater->add_control(
            'tp_profile_social_url',
            [
                'label' => esc_html__('Social Profile URL', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'tpcore'),
                'placeholder' => esc_html__('Paste URL or type', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_profile_social_list',
            [
                'label' => esc_html__('Social List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $social_repeater->get_controls(),
                'default' => [
                    [
                        'tp_profile_social_url' => esc_html__('', 'tpcore'),
                    ],
                    [
                        'tp_profile_social_url' => esc_html__('', 'tpcore'),
                    ],
                    [
                        'tp_profile_social_url' => esc_html__('', 'tpcore'),
                    ],
                ],
                'title_field' => '{{{ tp_profile_social_url }}}',
            ]
        );

        $this->end_controls_section();


        // Skill
        $this->start_controls_section(
            'tp_progress_bar',
            [
                'label' => esc_html__('Skill Bar', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_skill_title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'tpcore'),
                'default' => esc_html__('Skills', 'tpcore'),
                'placeholder' => esc_html__('Enter title here', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Name', 'tpcore'),
                'default' => esc_html__('Design', 'tpcore'),
                'placeholder' => esc_html__('Type a skill name', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'level',
            [
                'label' => esc_html__('Level (Out Of 100)', 'tpcore'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                    'size' => 95
                ],
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'skills',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print((name || level.size) ? (name || "Skill") + " - " + level.size + level.unit : "Skill - 0%") #>',
                'default' => [
                    [
                        'name' => 'Design',
                        'level' => ['size' => 95, 'unit' => '%']
                    ],
                    [
                        'name' => 'UX',
                        'level' => ['size' => 85, 'unit' => '%']
                    ]
                ]
            ]
        );

        $this->add_control(
            'view',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Layout', 'tpcore'),
                'separator' => 'before',
                'default' => 'progress-bar--1',
                'options' => [
                    'progress-bar--2' => esc_html__('Thin', 'tpcore'),
                    'progress-bar--1' => esc_html__('Normal', 'tpcore'),
                    'progress-bar--3' => esc_html__('Bold', 'tpcore'),
                ],
                'style_transfer' => true,
                'condition' => [
                    'tp_design_layout' => 'layout_1'
                ]
            ]
        );

        $this->end_controls_section();


        // Qualification
        $this->start_controls_section(
            'tp_qualification_section',
            [
                'label' => esc_html__('Qualification', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_qualification_title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'tpcore'),
                'default' => esc_html__('Qualification', 'tpcore'),
                'placeholder' => esc_html__('Enter title here', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_qualification_name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Qualification', 'tpcore'),
                'default' => esc_html__('BSC in CSE', 'tpcore'),
                'placeholder' => esc_html__('Enter Qualification Here', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_qualification_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_qualification_name' => esc_html__('BSC in CSE', 'tpcore'),
                    ],
                    [
                        'tp_qualification_name' => esc_html__('MBA', 'tpcore')
                    ],
                    [
                        'tp_qualification_name' => esc_html__('BBA', 'tpcore')
                    ]

                ],
                'title_field' => '{{{ tp_qualification_name }}}',
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

        if (!empty($settings['tp_image']['url'])) {
            $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url($settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
            $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
        }

        $this->add_render_attribute('title_args', 'class', 'tp-team-details-title');

?>
        <section class="team-details-area pb-120 pt-110">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="image">
                            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt) ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="team-details__item-right">
                            <div class="bor-bottom mb-30 pb-30">
                                <?php if (!empty($settings['tp_profile_title'])) : ?>
                                    <h2 class="fw-300"> <?php echo tp_kses($settings['tp_profile_title']) ?> </h2>
                                <?php endif; ?>
                                <?php if (!empty($settings['tp_profile_sub_title'])) : ?>
                                    <span class="fw-500"> <?php echo tp_kses($settings['tp_profile_sub_title']) ?> </span>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($settings['tp_profile_description'])) : ?>
                                <?php echo $settings['tp_profile_description']; ?>
                            <?php endif; ?>
                            <div class="social-icons mt-30">
                                <?php foreach ($settings['tp_profile_social_list'] as $item) : ?>
                                    <?php if ($item['tp_social_icon_type'] == 'icon') : ?>
                                        <?php if (!empty($item['tp_social_icon']) || !empty($item['tp_social_selected_icon']['value'])) : ?>
                                            <a href="<?php echo esc_url($item['tp_profile_social_url']); ?>">
                                                <?php tp_render_icon($item, 'tp_social_icon', 'tp_social_selected_icon'); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <div class="tp-social-img-icon">
                                            <?php if (!empty($item['tp_social_image']['url'])) : ?>
                                                <div class="tp-offer-wrapper-icon">
                                                    <a href="<?php echo esc_url($item['tp_profile_social_url']); ?>"> <img src="<?php echo $item['tp_social_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_social_image']['url']), '_wp_attachment_image_alt', true); ?>"> </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-80">
                    <div class="row g-5">
                        <div class="col-lg-6">
                            <div class="team-details__item">
                                <?php if (!empty($settings['tp_skill_title'])) : ?>
                                    <h3> <?php echo tp_kses($settings['tp_skill_title']) ?> </h3>
                                <?php endif; ?>
                                <div class="experience-progress-wrapper">
                                    <?php foreach ($settings['skills'] as $index => $skill) : ?>
                                        <div class="experience-progress mb-30">
                                            <div class="experience-title-wrapper d-flex align-items-center justify-content-between">
                                                <h5 class="experience-title pb-2"><?php echo esc_html($skill['name']); ?></h5>
                                                <span class="exp" style="left:<?php echo esc_attr($skill['level']['size']); ?>%"><?php echo esc_attr($skill['level']['size']); ?>%</span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar wow slideInLeft" data-wow-duration=".9s" role="progressbar" style="width: <?php echo esc_attr($skill['level']['size']); ?>%;" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="team-details__item">
                                <?php if (!empty($settings['tp_qualification_title'])) : ?>
                                    <h3> <?php echo tp_kses($settings['tp_qualification_title']) ?> </h3>
                                <?php endif; ?>
                                <ul>
                                    <?php foreach ($settings['tp_qualification_list'] as $index => $item) : ?>
                                        <li> <?php echo tp_kses($item['tp_qualification_name']) ?> </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
    }
}

$widgets_manager->register(new TP_Team_Details());
