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
class WPR_Headings extends Widget_Base
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
        return 'wpr-headings';
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
        return esc_html__('Headings', 'tpcore');
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
     * Register button widget controls.
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'heading',
            [
                'label' => esc_html__('Agenshark heading', 'tpcore'),

            ]
        );
        $this->add_control(
            'layout_control',
            [
                'label'   => esc_html__('Layout Style', 'tpcore'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => array(
                    '1' => esc_html__('Style 1 ', 'tpcore'),
                    '2' => esc_html__('Style 2 ', 'tpcore'),
                    '3' => esc_html__('Style 3 ', 'tpcore'),
                    '4' => esc_html__('Style 4 ', 'tpcore'),
                ),
            ]
        );

        //Sub Headings
        $this->add_control(
            'sub_heading_text',
            [
                'label'       => __('Sub Headings', 'tpcore'),
                'type'        => Controls_Manager::TEXT,
                'default'      =>  __('Sub heading', 'tpcore'),
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your Heading', 'tpcore'),
            ]
        );
        //Heading
        $this->add_control(
            'heading_text',
            [
                'label'       => __('Heading', 'tpcore'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'      => 'Headings',
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your Heading', 'tpcore'),
                'description' => __('Use the following classes to define the shape: "shape", "shape-lrg", or "shape-pink".', 'tpcore'),

            ]
        );

        $this->add_control(
            'animated_title',
            [
                'label' => esc_html__('Animated Words', 'tpcore'),
                'description' => __('Seperate words with `,`'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Developer, Designer', 'tpcore'),
                'placeholder' => esc_html__('Enter', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'layout_control' => ['2']
                ]
            ]
        );

        // paragraph contents
        $this->add_control(
            'headings_contents',
            [
                'label'       => __('Contents', 'tpcore'),
                'type'        => Controls_Manager::TEXTAREA,
                'default' => __('Lorem is a long established fact that a reader will be distracted by the readable content of a page.', 'tpcore'),
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your Heading', 'tpcore'),
            ]
        );
        $this->add_control(
            'heading_tags',
            [
                'label' => esc_html__('Heading Tag', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'description' => esc_html__('You can change Heading Tags from here.', 'tpcore'),
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tpcore'),
                        'icon' => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tpcore'),
                        'icon' => 'eicon-editor-h2',
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tpcore'),
                        'icon' => 'eicon-editor-h3',
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tpcore'),
                        'icon' => 'eicon-editor-h4',
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tpcore'),
                        'icon' => 'eicon-editor-h5',
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tpcore'),
                        'icon' => 'eicon-editor-h6',
                    ],
                ],
                'default' => 'h2',
            ]
        );
        $this->end_controls_section();

        //heading Style		
        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__('Heading Style', 'tpcore'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'general_align',
            [
                'label' => esc_html__('Alignment', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'heading_margin',
            [
                'label'      => esc_html__('margin', 'tpcorecore'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .section__title-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Heading Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section__title-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => __('Typography', 'tpcore'),
                'selector' => '{{WRAPPER}} .section__title-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'heading_text_stroke',
                'selector' => '{{WRAPPER}} .section__title-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'heading_shadow',
                'selector' => '{{WRAPPER}} .section__title-title',
            ]
        );

        $this->add_control(
            'animated_circle_color',
            [
                'label' => esc_html__('Full Stop Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner__content h1 span' => 'color: {{VALUE}};',
                ],
                'separator'  => 'before',
                'condition' => ['layout_control' => ['2']],
            ]
        );

        $this->add_control(
            'heading_animated_color',
            [
                'label' => esc_html__('Animated Word Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section__animated-words' => 'color: {{VALUE}};',
                ],
                'condition' => ['layout_control' => ['2']],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'animated_typography',
                'label' => __('Typography', 'tpcore'),
                'selector' => '{{WRAPPER}} .section__animated-words',
                'condition' => ['layout_control' => ['2']],
            ]
        );

        $this->add_control(
            'subheading_color',
            [
                'label' => esc_html__('Sub Heading Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section__title-sub' => 'color: {{VALUE}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_typography',
                'label' => __('Typography', 'tpcore'),
                'selector' => '{{WRAPPER}} .section__title-sub',
            ]
        );

        $this->add_control(
            'sub_dot_color',
            [
                'label' => esc_html__('Dot Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-dot' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['layout_control' => ['4']],
            ]
        );

        $this->end_controls_section();


        //content Style		
        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__('Content', 'tpcore'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //Heading
        $this->add_control(
            'heading_content_color',
            [
                'label' => esc_html__('Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section__title-desc' => 'color: {{VALUE}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __('Typography', 'tpcore'),
                'selector' => '{{WRAPPER}} .section__title-desc',
            ]
        );

        $this->add_responsive_control(
            'content_text_width',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Content Width', 'tpcorecore'),
                'size_units' => ['%', 'custom'],
                'default' => [
                    'size' => '80',
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .section__title-desc' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'cw_auto_center',
            [
                'label' => esc_html__('Auto center', 'tpcorecore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcorecore'),
                'label_off' => esc_html__('Hide', 'tpcorecore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render button widget output on the frontend.
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $allowed_tags = wp_kses_allowed_html('post');
        $layout = $settings['layout_control'];
        $cw_auto_cls = ($settings['cw_auto_center'] == 'yes') ? 'mx-auto' : false;
        $h_tag = $settings['heading_tags'];
?>

        <?php if ($layout === '2'): ?>
            <div class="banner__content">
                <?php if ($settings['sub_heading_text']) : ?>
                    <h5 class="section__title-sub splt-txt wow" data-splitting><?php echo tp_kses($settings['sub_heading_text']) ?></h5>
                <?php endif; ?>
                <?php if (! empty($settings['heading_text'])) : ?>
                    <h1 class="section__title-title"> <?php echo $settings['heading_text']; ?>
                        <?php if ($settings['animated_title']): ?>
                            <br> <strong class="section__animated-words" id="typing-text" data-words="<?php echo tp_kses($settings['animated_title']); ?>"></strong><span>.</span>
                        <?php endif; ?>
                    </h1>
                <?php endif; ?>
                <?php if ($settings['headings_contents']) : ?>
                    <p class="section__title-desc"><?php echo tp_kses($settings['headings_contents']) ?></p>
                <?php endif; ?>
            </div>
        <?php elseif ($layout === '3'): ?>
            <div class="banner-two__content">
                <?php
                // title
                !empty($settings['heading_text']) ? printf('<%1$s class="section__title-title">%2$s</%1$s>',  wp_kses($h_tag, $allowed_tags), wp_kses($settings['heading_text'], $allowed_tags)) : false;
                ?>
            </div>
            <!-- Hero Heading Two -->
        <?php elseif ($layout === '4'): ?>
            <!-- Header style Four -->
            <div class="section-header-four">
                <?php
                // sub title
                !empty($settings['sub_heading_text']) ? printf('<h5 class="section__title-sub wow splt-txt"><span class="title-dot"></span>%s</h5>', wp_kses($settings['sub_heading_text'], $allowed_tags)) : false;

                // title
                !empty($settings['heading_text']) ? printf('<%1$s class="section__title-title wow splt-txt" data-splitting>%2$s</%1$s>',  wp_kses($h_tag, $allowed_tags), wp_kses($settings['heading_text'], $allowed_tags)) : false;

                // content
                !empty($settings['headings_contents']) ? printf('<p class="section__title-desc wow fadeInUp %s" data-wow-delay="200ms" data-wow-duration="1500ms">%s</p>', esc_attr($cw_auto_cls), wp_kses($settings['headings_contents'], $allowed_tags)) : false;
                ?>
            </div>

        <?php else: ?>
            <!-- Default Section Header -->
            <div class="section-header">
                <?php
                // sub title
                !empty($settings['sub_heading_text']) ? printf('<h5 class="section__title-sub wow splt-txt">%s</h5>', wp_kses($settings['sub_heading_text'], $allowed_tags)) : false;

                // title
                !empty($settings['heading_text']) ? printf('<%1$s class="section__title-title wow splt-txt" data-splitting>%2$s</%1$s>',  wp_kses($h_tag, $allowed_tags), tp_kses($settings['heading_text'], $allowed_tags)) : false;

                // content
                !empty($settings['headings_contents']) ? printf('<p class="section__title-desc wow fadeInUp %s" data-wow-delay="200ms" data-wow-duration="1500ms">%s</p>', esc_attr($cw_auto_cls), wp_kses($settings['headings_contents'], $allowed_tags)) : false;
                ?>
            </div>

<?php endif;
    }
}
$widgets_manager->register(new WPR_Headings());
