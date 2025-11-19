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
class TP_Offer extends Widget_Base
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
        return 'offer';
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
        return __('Offer', 'tpcore');
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
        return ['offer', 'disount', 'free quote'];
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
            'tp_offer_design_layout_section',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_offer_design_layout',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // content section
        $this->start_controls_section(
            'tp_offer_content_section',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_offer_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Sub Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your sub title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_offer_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_offer_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_offer_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_offer_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_offer_design_layout' => ['layout-1']
                ]
            ]
        );

        // btn 
        $this->add_control(
            'tp_offer_link_switcher',
            [
                'label' => esc_html__('Button Switch', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'tp_offer_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_offer_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_offer_link_switcher' => 'yes',
                    'tp_offer_design_layout' => ['layout-1']
                ],
            ]
        );

        $this->add_control(
            'tp_offer_link_type',
            [
                'label' => esc_html__('Button URL Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom URL',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_offer_link_switcher' => 'yes',
                    'tp_offer_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_offer_link',
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
                    'tp_offer_link_type' => '1',
                    'tp_offer_link_switcher' => 'yes',
                    'tp_offer_design_layout' => ['layout-1']
                ]
            ]
        );


        $this->add_control(
            'tp_offer_page_link',
            [
                'label' => esc_html__('Internal Page Link', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_offer_link_type' => '2',
                    'tp_offer_link_switcher' => 'yes',
                    'tp_offer_design_layout' => ['layout-1']
                ]
            ]
        ); // btn end

        $this->add_control(
            'tp_offer_thumb',
            [
                'label' => esc_html__('Choose Thumbnail', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_offer_thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
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

        <?php if ($settings['tp_offer_design_layout']  == 'layout-1') :
            // btn
            if ('2' == $settings['tp_offer_link_type']) {
                $link = get_permalink($settings['tp_offer_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_offer_link']['url']) ? $settings['tp_offer_link']['url'] : '';
                $target = !empty($settings['tp_offer_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_offer_link']['nofollow']) ? 'nofollow' : '';
            }

            // bg thumb
            if (!empty($settings['tp_offer_thumb']['url'])) {
                $tp_offer_thumb_url = !empty($settings['tp_offer_thumb']['id']) ? wp_get_attachment_image_url($settings['tp_offer_thumb']['id'], $settings['tp_offer_thumb_size']) : $settings['tp_offer_thumb']['url'];
                $tp_offer_thumb_alt = get_post_meta($settings["tp_offer_thumb"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>
            <section class="start-now-four-area pb-100 pt-120">
                <div class="container">
                    <div class="row g-0">
                        <div class="col-lg-7">
                            <div class="start-now-four__item-left">
                                <div class="section-header-four line-title mb-80">
                                    <?php if (!empty($settings['tp_offer_sub_title'])) : ?>
                                        <h5 class="wow splt-txt" data-splitting><span class="title-dot"></span> <?php echo tp_kses($settings['tp_offer_sub_title']) ?> </h5>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['tp_offer_title'])) : ?>
                                        <h2 class="wow splt-txt" data-splitting> <?php echo tp_kses($settings['tp_offer_title']) ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/section-title-four-shape.png" alt="sahpe"></span> </h2>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['tp_offer_description'])) : ?>
                                        <p class="mt-4 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms"> <?php echo tp_kses($settings['tp_offer_description']) ?> </p>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['tp_offer_link_switcher'])) : ?>
                                        <a href="<?php echo esc_url($link); ?>" class="btn-four mt-40 wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms" rel="<?php echo esc_attr($rel); ?>" target="<?php echo esc_attr($target); ?>"> <?php echo tp_kses($settings['tp_offer_btn_text']); ?>
                                            <span>
                                                <i class="fa-regular fa-arrow-right arry1"></i>
                                                <i class="fa-regular fa-arrow-right arry2"></i>
                                            </span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="start-now-four__image">
                                <img class="w-100" src="<?php echo esc_url($tp_offer_thumb_url);?>" alt="<?php echo esc_url($tp_offer_thumb_alt);?>">
                                <img class="shape1 animation__arryLeftRight" src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/start-now-four-shape1.png" alt="shape">
                                <img class="shape2" src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/start-now-four-shape2.png" alt="shape">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Offer());
