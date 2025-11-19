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


if (!defined('ABSPATH')) exit; // Exit if accessed directly


/**
 * Marketi Core
 *
 * Elementor widget for Pricing
 *
 * @since 1.0.0
 */
class WPR_Pricing extends \Elementor\Widget_Base
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
        return 'wpr_pricing';
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
        return __('Pricing Table', 'tpcore');
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


        /**
         * 
         * Start control for content tab
         */
        $this->start_controls_section(
            'laout_section',
            [
                'label' => esc_html__('Layout', 'marketi'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        /**
         * Select style
         * =========================
         */
        $this->add_control(
            'design_layout',
            [
                'label' => esc_html__('Style', 'marketi'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                    'style-1' => esc_html__('Style 1', 'marketi'),
                    'style-2' => esc_html__('Style 2', 'marketi'),
                    'style-3' => esc_html__('Style 3', 'marketi'),

                ],
            ]
        );

        $this->end_controls_section();
        //End control for content tab

        /**
         * 
         * Start control for content tab
         */
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Contents', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_style_two',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'default' => 'Explore Our Best Pricing for You',
                'condition'    => ['design_layout' => ['style-2']],
            ]
        );

        $this->add_control(
            'description_style_two',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Description', 'tpcore'),
                'placeholder' => esc_html__('Description', 'tpcore'),
                'default'      => 'An enim nullam tempor sapien gravida donec enim ipsum porta justo congue magna at pretium',
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => ['design_layout' => ['style-2']]
            ]
        );

        $this->add_control(
            'annual_toggle',
            [
                'label' => esc_html__('Show Annual toggle', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => ['design_layout' => ['style-1', 'style-2']]
            ]
        );
        $this->add_control(
            'toggle_text_left',
            [
                'label' => esc_html__('Left title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Billed Monthly', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'toggle_text_right',
            [
                'label' => esc_html__('Right title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Billed Annually', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'currency',
            [
                'label' => esc_html__('Currency', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('$', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'period',
            [
                'label' => esc_html__('Period', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Per user/month', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $this->add_control(
            'period_sec',
            [
                'label' => esc_html__('Second Period', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Per Year', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();


        /**
         * 
         * Start control for content tab
         */
        $this->start_controls_section(
            'pricing_section',
            [
                'label' => esc_html__('Pricings', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'featured',
            [
                'label' => esc_html__('Featured', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'thumbnail',
            [
                'label' => esc_html__('Popular Pack', 'tpcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('List Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'pack_desc',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Perfect to get started', 'tpcore'),
            ]
        );
        $repeater->add_control(
            'second_price_switch',
            [
                'label' => esc_html__('Enable Secondary price', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'prim_price',
            [
                'label' => esc_html__('Price', 'tpcore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 10,
            ]
        );
        $repeater->add_control(
            'sec_price',
            [
                'label' => esc_html__('Secondary Price', 'tpcore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 99,
                'condition' => ['second_price_switch' => 'yes']
            ]
        );

        $repeater->add_control(
            'list_content',
            [
                'label' => esc_html__('Content', 'tpcore'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('List Content', 'tpcore'),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'btn',
            [
                'label' => esc_html__('Button', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Start 15 days trial', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'btn_link',
            [
                'label' => esc_html__('Link', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__('Pricing List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__('Title #1', 'tpcore')
                    ],
                    [
                        'title' => esc_html__('Title #2', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
        //End control for content tab

        $this->start_controls_section(
            'section_heading',
            [
                'label' => esc_html__('Heading Style', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'    => ['design_layout' => ['style-2']],
            ]
        );

        $this->add_control(
            'section_title_color',
            [
                'label' => esc_html__('Title Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-header .wpr__pricing_heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'section_title',
                'selector' => '{{WRAPPER}} .section-header .wpr__pricing_heading',
            ]
        );
        $this->add_control(
            'section_desc_color',
            [
                'label' => esc_html__('Description Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-header .wpr__pricing_desc' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'section_desc_typo',
                'selector' => '{{WRAPPER}} .wpr__pricing_card .wpr__pricing_desc',
            ]
        );

        $this->add_responsive_control(
            'section_title_gap',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Spacing', 'tpcore'),
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 80, // Set default margin-bottom to 80px
                    'unit' => 'px', // Ensure it's in pixels
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .wpr__pricing-title' => 'margin-bottom: {{SIZE}}{{UNIT}};', // Corrected "marging" to "margin"
                ],
            ]
        );


        $this->end_controls_section();

        /**
         * 
         * Start control for Tab 
         */
        $this->start_controls_section(
            'tab_section',
            [
                'label' => esc_html__('Toggle Style', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tab_color',
            [
                'label' => esc_html__('Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing__tab .nav-tabs .nav-link' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tab_active_color',
            [
                'label' => esc_html__('Active Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing__tab .nav-tabs .nav-link.active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tab_switch_bg',
            [
                'label' => esc_html__('Toogle Background', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing__tab .nav-tabs .nav-link::before' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .pricing-two__tab .nav-tabs .nav-link::before ' => 'background: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_section();
        //End control for tab button


        /**
         * 
         * Start control for Style
         */
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Box Style', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background',
            [
                'label' => esc_html__('Background', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__pricing_card' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'featured_background',
            [
                'label' => esc_html__('Featured Background', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__pricing_card.active' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__pricing_card .pricing__head .pricing-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .wpr__pricing_card .pricing__head .pricing-name',
            ]
        );
        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__('Description Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__pricing_card .pricing__head p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'price',
                'selector' => '{{WRAPPER}} .wpr__pricing_card .pricing__head p',
            ]
        );
        $this->add_control(
            'list_color',
            [
                'label' => esc_html__('List Items Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__pricing_card ul li' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .wpr__pricing_card ul li',
            ]
        );
        $this->end_controls_section();
        //End control for Typography tab

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__('Button Style', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'btn_txt_color',
            [
                'label' => esc_html__('Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__pricing_btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_bg',
            [
                'label' => esc_html__('Background', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__pricing_btn' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'fetured_btn_bg',
            [
                'label' => esc_html__('Fetured Background', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__pricing_btn.active' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'selector' => '{{WRAPPER}} .wpr__pricing_btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button',
                'selector' => '{{WRAPPER}} .wpr__pricing_btn',
            ]
        );

        $this->end_controls_section();
        //End control for Typography tab

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
        $layout = $settings['design_layout'];

?>

        <?php if ($layout === 'style-10') : ?>

        <?php elseif ($layout == 'style-1') : ?>
            <section class="pricing-area">
                <div class="container">
                    <?php if ($settings['annual_toggle'] == 'yes') : ?>
                        <div class="pricing__tab wow fadeInUp mb-60" data-wow-delay="400ms" data-wow-duration="1500ms">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="pt-1-tab" data-bs-toggle="tab"
                                        data-bs-target="#pt-1" type="button" role="tab" aria-controls="pt-1"
                                        aria-selected="true"><?php echo esc_html($settings['toggle_text_left']) ?></button>

                                    <button class="nav-link" id="pt-2-tab" data-bs-toggle="tab" data-bs-target="#pt-2"
                                        type="button" role="tab" aria-controls="pt-2"
                                        aria-selected="false"><?php echo esc_html($settings['toggle_text_right']) ?></button>
                                </div>
                            </nav>
                        </div>
                    <?php endif; ?>

                    <div class="pricing__tab-content">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="pt-1" role="tabpanel" aria-labelledby="pt-1-tab">
                                <div class="pricing-package-wrapper">
                                    <div class="row g-4">
                                        <?php foreach ($settings['list'] as $item) : ?>
                                            <?php $is_active = ($item['featured'] == 'yes') ? 'active' : ''; ?>
                                            <div class="col-xl-4 col-md-6">
                                                <div class="wpr__pricing_card pricing__item <?php echo $is_active; ?> p-4">

                                                    <div class="popular-badge">
                                                        <?php
                                                        if (!empty($item['thumbnail'])) {
                                                            print wp_get_attachment_image($item['thumbnail']['id'], 'full', '', ['class' => '']);
                                                        }
                                                        ?>
                                                    </div>

                                                    <div class="pricing-head pricing__head  pb-20 pt-15 bor-bottom">
                                                        <?php
                                                        if (!empty($item['title'])) {
                                                            echo '<h4 class="pricing-name mb-1">' . esc_html($item['title']) . '</h4>';
                                                        }

                                                        $currency   = ($settings['currency'] != '') ? '<span class="dollar-icon">' .  esc_html($settings['currency']) . '</span>' : false;
                                                        $period     = ($settings['period'] != '') ? '<span class="month">' . esc_html($settings['period']) . '</span>' : false;
                                                        $period_sec = ($settings['period_sec'] != '') ? '<span class="month">' . esc_html($settings['period_sec']) . '</span>' : false;
                                                        $price      = ($item['prim_price'] != '') ? $item['prim_price'] : false;
                                                        $price_sec  = ($item['sec_price'] != '') ? $item['sec_price'] : false;

                                                        if ($item['second_price_switch'] == 'yes') {
                                                            printf('<h2 class="text2">%1$s%2$s%3$s</h2>', $currency, $price, $period);
                                                            printf('<h2 class="text1 d-none">%1$s%2$s%3$s</h2>', $currency, $price_sec, $period_sec);
                                                        } else {
                                                            printf('<h2>%1$s%2$s%3$s</h2>', $currency, $price, $period);
                                                        }

                                                        ?>
                                                    </div>

                                                    <!-- List Content -->
                                                    <div class="mt-4">
                                                        <?php
                                                        $list_content = $this->parse_text_editor($item['list_content']);
                                                        echo $list_content;
                                                        ?>
                                                    </div>

                                                    <?php if ($item['featured'] == 'yes') : ?>
                                                        <?php
                                                        if (!empty($item['btn']) && !empty($item['btn_link']['url'])) {
                                                            // Add link attributes for the featured button
                                                            $this->add_link_attributes('btn_links', $item['btn_link'], true);
                                                            echo '<a class="wpr__pricing_btn btn-two border-none bg-white mt-40 w-100 text-center" ' . $this->get_render_attribute_string('btn_links') . '>';
                                                            echo esc_html($item['btn']);
                                                            echo '<span>
                                                                    <i class="fa-regular fa-arrow-up-right arry1"></i>
                                                                    <i class="fa-regular fa-arrow-up-right arry2"></i>
                                                                 </span>
                                                                 </a>';
                                                        }
                                                        ?>
                                                        <!-- Button for Non-Featured (Inactive) -->
                                                    <?php else : ?>
                                                        <?php
                                                        if (!empty($item['btn']) && !empty($item['btn_link']['url'])) {
                                                            // Add link attributes for the non-featured button
                                                            $this->add_link_attributes('btn_links', $item['btn_link'], true);
                                                            echo '<a class="wpr__pricing_btn btn-one mt-40 w-100 text-center" ' . $this->get_render_attribute_string('btn_links') . '>';
                                                            echo esc_html($item['btn']);
                                                            echo '<span>
                                                                  <i class="fa-regular fa-arrow-up-right arry1"></i>
                                                                  <i class="fa-regular fa-arrow-up-right arry2"></i>
                                                                  </span> 
                                                                  </a>';
                                                        }
                                                        ?>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php elseif ($layout == 'style-2') : ?>
            <!-- Pricing area start here -->
            <section class="pricing-two-area">
                <div class="container">
                    <div class="d-flex align-items-end gap-5 flex-wrap justify-content-between wpr__pricing-title">
                        <div class="section-header">
                            <h2 class="fw-600 wow splt-txt wpr__pricing_heading" data-splitting><?php echo tp_kses($settings['title_style_two']); ?></h2>
                            <p class="wow fadeInUp wpr__pricing_desc" data-wow-delay="200ms" data-wow-duration="1500ms"><?php echo tp_kses($settings['description_style_two']); ?></p>
                        </div>

                        <div class="pricing-two__tab pricing__tab wow fadeInUp mb-60" data-wow-delay="400ms" data-wow-duration="1500ms">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="pt-1-tab" data-bs-toggle="tab"
                                        data-bs-target="#pt-1" type="button" role="tab" aria-controls="pt-1"
                                        aria-selected="true"><?php echo esc_html($settings['toggle_text_left']) ?></button>
                                    <button class="nav-link" id="pt-2-tab" data-bs-toggle="tab" data-bs-target="#pt-2"
                                        type="button" role="tab" aria-controls="pt-2"
                                        aria-selected="false"><?php echo esc_html($settings['toggle_text_right']) ?></button>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="pricing__tab-content">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="pt-1" role="tabpanel" aria-labelledby="pt-1-tab">
                                <div class="pricing-package-wrapper">
                                    <div class="row g-4">
                                        <?php foreach ($settings['list'] as $item) : ?>
                                            <?php $is_active = ($item['featured'] == 'yes') ? 'active' : ''; ?>
                                            <div class="col-xl-4 col-md-6">
                                                <div class="wpr__pricing_card pricing-two__item pricing__item">

                                                    <div class="pricing-head pricing__head  pb-30 bor-bottom">

                                                        <?php
                                                        if (!empty($item['title'])) {
                                                            echo '<h4 class="pricing-name mb-20">' . esc_html($item['title']) . '</h4>';
                                                        }
                                                        ?>

                                                        <?php
                                                        $currency   = ($settings['currency'] != '') ? esc_html($settings['currency']) : false;
                                                        $period     = ($settings['period'] != '') ? '<span class="month">' . esc_html($settings['period']) . '</span>' : false;
                                                        $period_sec = ($settings['period_sec'] != '') ? '<span class="month">' . esc_html($settings['period_sec']) . '</span>' : false;
                                                        $price      = ($item['prim_price'] != '') ? $item['prim_price'] : false;
                                                        $price_sec  = ($item['sec_price'] != '') ? $item['sec_price'] : false;

                                                        if ($item['second_price_switch'] == 'yes') {
                                                            printf('<h2 class="text2">%1$s%2$s%3$s</h2>', $currency, $price, $period);
                                                            printf('<h2 class="text1 d-none">%1$s%2$s%3$s</h2>', $currency, $price_sec, $period_sec);
                                                        } else {
                                                            printf('<h2>%1$s%2$s%3$s</h2>', $currency, $price, $period);
                                                        }

                                                        ?>

                                                        <!-- <h2>$ 49.00 USD<span class="month">/month</span>
                                                        </h2> -->

                                                        <?php
                                                        if (!empty($item['pack_desc'])) {
                                                            echo '<p>' . tp_kses($item['pack_desc']) . '</p>';
                                                        }
                                                        ?>

                                                    </div>
                                                    <!-- List Content -->
                                                    <div class="mt-4">
                                                        <?php
                                                        $list_content = $this->parse_text_editor($item['list_content']);
                                                        echo $list_content;
                                                        ?>
                                                    </div>

                                                    <?php
                                                    if (!empty($item['btn']) && !empty($item['btn_link']['url'])) {
                                                        // Add link attributes
                                                        $this->add_link_attributes('btn_links', $item['btn_link'], true);
                                                        echo '<a class="wpr__pricing_btn btn-one ' . esc_attr($is_active) . ' mt-60 w-100 text-center" ' . $this->get_render_attribute_string('btn_links') . '>';
                                                        echo esc_html($item['btn']);
                                                        echo '</a>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- Pricing area end here -->

<?php endif;
    }
}

$widgets_manager->register(new WPR_Pricing());
