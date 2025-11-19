<?php

namespace TPCore\Widgets;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Stroke;
use Elementor\Plugin;

/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class WPR_Testimonial extends Widget_Base
{

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'wpr-testimonial';
    }

    /**
     * Get widget title.
     * Retrieve button widget title.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Testimonial Slider', 'tpcore');
    }

    /**
     * Get widget icon.
     * Retrieve button widget icon.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'tp-icon';
    }

    /**
     * Get widget categories.
     * Retrieve the list of categories the button widget belongs to.
     * Used to determine where to display the widget in the editor.
     *
     * @since  2.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['tpcore'];
    }

    /**
     * Register button widget controls.
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        /**
         * **
         * Layout 
         */
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__('Layout', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Controls start 
        $this->add_control(
            'layout_control',
            [
                'label'   => esc_html__('Layout Style', 'tpcorei'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => array(
                    '1' => esc_html__('Style 1', 'tpcorei'),
                    '2' => esc_html__('Style 2', 'tpcorei'),
                    '3' => esc_html__('Style 3', 'tpcorei'),
                    '4' => esc_html__('Style 4', 'tpcorei'),
                    '5' => esc_html__('Style 5', 'tpcorei'),
                ),
            ]
        );
        $this->end_controls_section();

        // testimonial card
        $this->start_controls_section(
            'wpr_card_content_section',
            [
                'label' => esc_html__('Card Content', 'tpcore'),
                'condition' => [
                    'layout_control' => ['5']
                ]
            ]
        );

        $this->add_control(
            'wpr__card_bg_thumb',
            [
                'label' => esc_html__('Choose Background', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'wpr__card_logo',
            [
                'label' => esc_html__('Choose Logo', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'card_star_rating',
            [
                'label' => esc_html__('Star Rating', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [''],
                'range' => [
                    '' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 5, // Default number of stars
                ],
            ]
        );

        $this->add_control(
            'wpr__card_review',
            [
                'label' => esc_html__('Card Review', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Review Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your review', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'wpr_card_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'wpr_card_btn_link',
            [
                'label' => esc_html__('Button URL', 'tpcore'),
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
            ]
        );

        $this->end_controls_section();


        /**
         * **
         * Contents Start
         */
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'enable_margin',
            [
                'label' => esc_html__('Enable Margin', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => esc_html__('Applicable only for Layout 2', 'tpcore'),
            ]
        );

        $repeater->add_control(
            'list_image',
            [
                'label' => esc_html__('Choose Image', 'tpcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $repeater->add_control(
            'list_name',
            [
                'label' => esc_html__('Name', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Joh Doe', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_designation',
            [
                'label' => esc_html__('Designation', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Item content. CEO, Apple INC.', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Item Title. Click the edit button to change this text.', 'tpcore'),
                'description' => esc_html__('Applicable only for Layout 1 & 2', 'tpcore'),
            ]
        );

        $repeater->add_control(
            'list_content',
            [
                'label' => esc_html__('Contents', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Item content. Click the edit button to change this text.', 'tpcore'),
            ]
        );
        $repeater->add_control(
            'list_rating',
            [
                'label' => esc_html__('Rating', 'tpcore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );


        $this->add_control(
            'list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_name' => esc_html__('John Doe', 'tpcore'),
                        'list_designation' => esc_html__('CEO, Upple INC.', 'tpcore'),
                        'list_content' => esc_html__('Item content. Click the edit button to change this text.', 'tpcore'),
                        'list_rating' => 5
                    ],
                    [
                        'list_name' => esc_html__('Eme Watson', 'tpcore'),
                        'list_designation' => esc_html__('WordPress Developer', 'tpcore'),
                        'list_content' => esc_html__('Item content. Click the edit button to change this text.', 'tpcore'),
                        'list_rating' => 4
                    ]
                ],
                'title_field' => '{{{ list_name }}}',
            ]
        );

        $this->end_controls_section();

        /**
         * ****
         *  Slide Box
         */

        $this->start_controls_section(
            'card__section',
            [
                'label' => esc_html__('Card Style', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => ['layout_control' => ['5']]
            ]
        );

        // box background
        $this->add_control(
            'card_bg',
            [
                'label' => esc_html__('Background color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-four__card' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'card_star_color',
            [
                'label' => esc_html__('Star Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-four__card .star i' => 'color: {{VALUE}}',
                ],

            ]
        );

        $this->end_controls_section();

        /**
         * ****
         *  Slide Box
         */

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Slide Box', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        // box background
        $this->add_control(
            'slide_bg_lower',
            [
                'label' => esc_html__('Lower Background', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__testimonial_bg' => 'background: {{VALUE}}',
                ],
                'condition' => ['layout_control' => ['3']]
            ]
        );

        // box background
        $this->add_control(
            'slide_bg',
            [
                'label' => esc_html__('Background', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__testimonial_box' => 'background: {{VALUE}}',
                ],
            ]
        );

        // Qoute Color
        $this->add_control(
            'qoute_color',
            [
                'label' => esc_html__('Qoute Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__testimonial_box svg' => 'color: {{VALUE}}',
                ],
                'default' => '#256E56',
                'condition' => ['layout_control' => ['2']]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'slide_border',
                'selector' => '{{WRAPPER}} .wpr__testimonial_box',
            ]
        );

        $this->add_control(
            'slide_border_radius',
            [
                'label' => __('Border Radius', 'your-plugin-textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpr__testimonial_box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // slide dimention
        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__('Padding', 'tpcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .wpr__testimonial_box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bottom_gap',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Bottom Gap', 'tpcore'),
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
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr__bottom_gap' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * ****
         * Content
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
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .wpr__testimonial_box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__review_title' => 'color: {{VALUE}}',
                ],
                'condition' => ['layout_control' => ['1', '2']]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .wpr__review_title',
                'condition' => ['layout_control' => ['1', '2']]

            ]
        );

        $this->add_control(
            'review_color',
            [
                'label' => esc_html__('Content Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__testimonial_review' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'designation_typography',
                'selector' => '{{WRAPPER}} .wpr__testimonial_review',
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => esc_html__('Name Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__testimonial_name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .wpr__testimonial_name',
            ]
        );

        $this->add_control(
            'designation_color',
            [
                'label' => esc_html__('Designation Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__testimonial_desc' => 'color: {{VALUE}}',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'review_typography',
                'selector' => '{{WRAPPER}} .wpr__testimonial_desc',
            ]
        );

        $this->end_controls_section();
    }

    protected function ratings($rating)
    {
        $floor_rating    = floor($rating);
        $fraction_number = $rating -  $floor_rating;
?>
        <ul class="star d-flex gap-2 mb-2">
            <?php
            for ($i = 1; $i <= $floor_rating; $i++) {
                echo '<li><i class="fa-solid fa-star"></i></i></li>';
            }
            if ($fraction_number != 0 && is_float($fraction_number)) {
                echo '<li><i class="fa-regular fa-star-half-stroke"></i></i></li>';
            }
            ?>
        </ul>
        <?php
    }

    protected function render()
    {
        $settings    = $this->get_settings_for_display();
        $widget_id    = $this->get_id();
        $allowed_tags = wp_kses_allowed_html('post');

        if ($settings['layout_control'] == '1'):

        elseif ($settings['layout_control'] == '2'):

        endif;

        // $this->add_render_attribute(
        //     'testimonial-slider-attr',
        //     [
        //         'data-testimonial-slide-settings'    => json_encode($slider_settings),
        //     ]
        // );


        if ($settings['layout_control'] == '2'): ?>
            <section class="testimonial-two-area">
                <div class="testimonial-two__line">
                </div>
                <div class="swiper testimonial-two__slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['list'] as $item): ?>
                            <div class="swiper-slide">
                                <?php $mt_class = $item['enable_margin'] === 'yes' ? 'mt-80' : ''; ?>
                                <div class="testimonial-two__item wpr__testimonial_box <?php echo esc_attr($mt_class); ?>">
                                    <svg class="coma" width="48" height="48" viewBox="0 0 48 48" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.89997 28.8599C8.91 31.3499 7.35003 33.8099 5.26501 36.18C4.60501 36.93 4.51501 38.0099 5.055 38.8499C5.47504 39.5099 6.16498 39.8699 6.91498 39.8699C7.125 39.8699 7.33503 39.855 7.54504 39.7799C11.955 38.4899 22.26 33.9149 22.545 19.2449C22.65 13.59 18.51 8.72998 13.125 8.17498C10.14 7.87496 7.17004 8.8499 4.965 10.8299C2.76004 12.8249 1.5 15.675 1.5 18.6449C1.5 23.5949 5.01004 27.93 9.89997 28.8599Z"
                                            fill="currentColor" />
                                        <path
                                            d="M37.0652 8.17498C34.0951 7.87496 31.1251 8.8499 28.9202 10.8299C26.7151 12.8249 25.4551 15.675 25.4551 18.6449C25.4551 23.5949 28.9651 27.9299 33.8551 28.8599C32.8651 31.3499 31.3051 33.8099 29.2201 36.1799C28.5601 36.9299 28.4701 38.0099 29.0102 38.8499C29.4301 39.5099 30.1202 39.8699 30.8702 39.8699C31.0801 39.8699 31.2901 39.855 31.5001 39.7799C35.9101 38.4899 46.2151 33.9149 46.5001 19.2449V19.035C46.5001 13.4699 42.4052 8.72998 37.0652 8.17498Z"
                                            fill="currentColor" />
                                    </svg>

                                    <?php $this->ratings(esc_html($item['list_rating'])); ?>

                                    <?php
                                    printf(' <h5 class="wpr__review_title mb-10">%s</h5>', tp_kses($item['list_title'], $allowed_tags));
                                    printf('<p class="wpr__testimonial_review">%s</p>', tp_kses($item['list_content'], $allowed_tags));
                                    ?>
                                    <div class="d-flex align-items-center gap-3 mt-30">
                                        <?php echo wp_get_attachment_image($item['list_image']['id'], 'full', '', ['class' => '']); ?>
                                        <div>
                                            <?php
                                            printf('<h5 class="wpr__testimonial_name">%s</h5>', wp_kses($item['list_name'], $allowed_tags));
                                            printf('<span class="wpr__testimonial_desc">%s</span>', wp_kses($item['list_designation'], $allowed_tags));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="wpr__bottom_gap">
                        <div class="swiper-two__info">
                            <button class="testimonial-two__arry-prev active"><i
                                    class="fa-regular fa-arrow-left"></i></button>
                            <div class="dot testimonial-two__dot"></div>
                            <button class="testimonial-two__arry-next active"><i
                                    class="fa-regular fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </section>


        <?php elseif ($settings['layout_control'] == '3'): ?>
            <section class="testimonial-three-area">
                <div class="container">
                    <div class="swiper testimonial-three__slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['list'] as $item): ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-three__item-wrp wpr__testimonial_bg">
                                        <div class="testimonial-three__item wpr__testimonial_box">
                                            <div class="coma-top">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/testimonial-three-coma-top.png" alt="icon">
                                            </div>
                                            <div class="coma-bottom">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/testimonial-three-coma-bottom.png" alt="icon">
                                            </div>

                                            <?php
                                            $this->ratings(esc_html($item['list_rating']));

                                            printf('<p class="wpr__testimonial_review">%s</p>', tp_kses($item['list_content'], $allowed_tags));
                                            ?>

                                            <div class="d-flex gap-3 align-items-center mt-30 pt-30 bor-top">
                                                <?php echo wp_get_attachment_image($item['list_image']['id'], 'full', '', ['class' => '']); ?>
                                                <h5 class="wpr__testimonial_name"><?php echo tp_kses($item['list_name']) ?><span
                                                        class="wpr__testimonial_desc fw-normal text-font"><?php echo tp_kses($item['list_designation']) ?></span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="wpr__bottom_gap">
                            <div class="swiper__info">
                                <button class="testimonial-three__arry-prev"><i
                                        class="fa-regular fa-arrow-left-long"></i></button>
                                <div class="dot testimonial-three__dot"></div>
                                <button class="testimonial-three__arry-next active"><i
                                        class="fa-regular fa-arrow-right-long"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['layout_control'] == '4'): ?>
            <section class="testimonial-four-area">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="swiper testimonial-four__slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($settings['list'] as $item): ?>
                                        <div class="swiper-slide">
                                            <div class="testimonial-four__item wpr__testimonial_box">

                                                <?php $this->ratings(esc_html($item['list_rating'])); ?>

                                                <?php echo wp_get_attachment_image($item['list_image']['id'], 'full', '', ['class' => 'mt-20 mb-20']); ?>

                                                <?php

                                                printf('<p class="wpr__testimonial_review">%s</p>', tp_kses($item['list_content'], $allowed_tags));

                                                printf('<h5 class="wpr__testimonial_name">%s</h5>', wp_kses($item['list_name'], $allowed_tags));

                                                printf('<span class="wpr__testimonial_desc">%s</span>', wp_kses($item['list_designation'], $allowed_tags));

                                                ?>

                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wpr__bottom_gap">
                        <div class="team-four__swiper-scrollbar">
                            <div class="position-relative">
                                <div class="testimonial-four__scrollbar"></div>
                            </div>
                        </div>
                        <div class="pb-15"></div>
                        <div class="swiper-four__info">
                            <button class="testimonial-four__arry-prev active disable"><i
                                    class="fa-regular fa-arrow-left"></i></button>
                            <button class="testimonial-four__arry-next active"><i
                                    class="fa-regular fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </section>
        <?php elseif ($settings['layout_control'] == '5'): ?>
            <?php
            // button attributes
            $this->add_render_attribute('button', 'href', esc_url($settings['wpr_card_btn_link']['url']));
            $star_rating = $settings['card_star_rating']['size'];
            ?>
            <!-- Testimonial area start here -->
            <section class="testimonial-four-area">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="testimonial-four__card">
                                <div class="bg">
                                    <?php echo wp_get_attachment_image($settings['wpr__card_bg_thumb']['id'], 'full', '', ['class' => '']); ?>
                                </div>
                                <div class="mt-120">
                                    <?php echo wp_get_attachment_image($settings['wpr__card_logo']['id'], 'full', '', ['class' => '']); ?>
                                    <div class="star d-flex justify-content-center mt-15 align-items-center gap-1">
                                        <?php for ($i = 0; $i < $star_rating; $i++) : ?>
                                            <i class="fa-solid fa-star"></i>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <div>
                                    <a <?php echo $this->get_render_attribute_string('button'); ?> class="btn-four">
                                        <?php echo esc_html($settings['wpr_card_btn_text']); ?>
                                        <span>
                                            <i class="fa-regular fa-arrow-right arry1"></i>
                                            <i class="fa-regular fa-arrow-right arry2"></i>
                                        </span>
                                    </a>
                                </div>

                                <span class="fs-18 text-white">
                                    <?php echo tp_kses($settings['wpr__card_review']); ?>
                                </span>

                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="swiper testimonial-four__slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($settings['list'] as $item): ?>
                                        <div class="swiper-slide">
                                            <div class="testimonial-four__item wpr__testimonial_box">

                                                <?php $this->ratings(esc_html($item['list_rating'])); ?>

                                                <?php echo wp_get_attachment_image($item['list_image']['id'], 'full', '', ['class' => 'mt-20 mb-20']); ?>

                                                <?php

                                                printf('<p class="wpr__testimonial_review">%s</p>', tp_kses($item['list_content'], $allowed_tags));

                                                printf('<h5 class="wpr__testimonial_name">%s</h5>', wp_kses($item['list_name'], $allowed_tags));

                                                printf('<span class="wpr__testimonial_desc">%s</span>', wp_kses($item['list_designation'], $allowed_tags));

                                                ?>

                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wpr__bottom_gap">
                        <div class="team-four__swiper-scrollbar">
                            <div class="position-relative">
                                <div class="testimonial-four__scrollbar"></div>
                            </div>
                        </div>
                        <div class="pb-15"></div>
                        <div class="swiper-four__info">
                            <button class="testimonial-four__arry-prev active disable"><i
                                    class="fa-regular fa-arrow-left"></i></button>
                            <button class="testimonial-four__arry-next active"><i
                                    class="fa-regular fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Testimonial area end here -->
        <?php
        /// Layout style 1 or default
        else:
        ?>
            <div class="testimonial__item-right">
                <svg class="coma" width="88" height="68" viewBox="0 0 88 68" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.10885 62.0247C3.19219 56.6164 0.242188 50.7164 0.242188 40.8831C0.242188 23.6747 12.5339 8.43307 29.7422 0.566406L34.1672 6.95807C17.9422 15.8081 14.5005 27.1164 13.5172 34.4914C15.9755 33.0164 19.4172 32.5247 22.8589 33.0164C31.7089 33.9997 38.5922 40.8831 38.5922 50.2247C38.5922 54.6497 36.6255 59.0747 33.6755 62.5164C30.2339 65.9581 26.3005 67.4331 21.3839 67.4331C15.9755 67.4331 11.0589 64.9747 8.10885 62.0247ZM57.2755 62.0247C52.3589 56.6164 49.4089 50.7164 49.4089 40.8831C49.4089 23.6747 61.7005 8.43307 78.9089 0.566406L83.3339 6.95807C67.1089 15.8081 63.6672 27.1164 62.6839 34.4914C65.1422 33.0164 68.5839 32.5247 72.0255 33.0164C80.8755 33.9997 87.7589 40.8831 87.7589 50.2247C87.7589 54.6497 85.7922 59.0747 82.8422 62.5164C79.8922 65.9581 75.4672 67.4331 70.5505 67.4331C65.1422 67.4331 60.2255 64.9747 57.2755 62.0247Z"
                        fill="#151314" fill-opacity="0.1" />
                </svg>
                <div class="swiper testimonial__slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['list'] as $item): ?>
                            <div class="swiper-slide wpr__testimonial_box">
                                <div class="testimonial__item">
                                    <?php $this->ratings(esc_html($item['list_rating'])); ?>
                                </div>
                                <?php
                                printf(' <h3 class="wpr__review_title mb-10">%s</h3>', tp_kses($item['list_title'], $allowed_tags));
                                printf('<p class="wpr__testimonial_review">%s</p>', tp_kses($item['list_content'], $allowed_tags));
                                ?>
                                <div
                                    class="bor-top pt-4 mt-30 d-flex align-items-center gap-3 flex-wrap justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <?php echo wp_get_attachment_image($item['list_image']['id'], 'full', '', ['class' => '']); ?>
                                        <div class="wpr__user_info">
                                            <?php
                                            printf('<h5 class="wpr__testimonial_name">%s</h5>', wp_kses($item['list_name'], $allowed_tags));
                                            printf('<span class="wpr__testimonial_desc">%s</span>', wp_kses($item['list_designation'], $allowed_tags));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="swiper__info m-0">
                                        <button class="testimonial__arry-prev"><i
                                                class="fa-regular fa-arrow-left-long"></i></button>
                                        <div class="dot testimonial__dot"></div>
                                        <button class="testimonial__arry-next active"><i
                                                class="fa-regular fa-arrow-right-long"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
<?php
        endif; // layout end
    }
}

$widgets_manager->register(new WPR_Testimonial());
