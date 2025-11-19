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
class WPR_Button extends Widget_Base
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
        return 'wpr-buttons';
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
        return esc_html__('Buttons', 'tpcore');
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
        // heading
        $this->start_controls_section(
            'heading',
            [
                'label' => esc_html__('Content', 'tpcore'),
            ]
        );
        $this->add_control(
            'layout_control',
            [
                'label'   => esc_html__('Layout Style', 'tpcore'),
                'label_block' => true,
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => array(
                    '1' => esc_html__('Style 1 ', 'tpcore'),
                    '2' => esc_html__('Style 2 ', 'tpcore'),
                    '3' => esc_html__('Style 3 ', 'tpcore'),
                    '4' => esc_html__('Style 4 ', 'tpcore'),
                    '5' => esc_html__('Style 5 ', 'tpcore'),
                ),
            ]
        );
        //Sub Headings
        $this->add_control(
            'btn_text',
            [
                'label'       => __('Text', 'tpcore'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Learn More', 'tpcore'),
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Button Name', 'tpcore'),
            ]
        );
        //Heading
        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Link', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label' => __('Show Icon', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'tpcore'),
                'label_off' => __('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => ['layout_control' => ['1', '2', '4']],
            ]
        );

        $this->add_control(
            'btn_icon',
            [
                'label' => esc_html__('Icon', 'tpcore'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'description' => __('Please select icon from Font Awesome icon pack.', 'tpcore'),
                'condition' => ['layout_control' => ['3']],
            ]
        );

        // icon spacing
        $this->add_control(
            'btn_icon_spacing',
            [
                'label' => esc_html__('Icon gap', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .btn-has-icon' => 'gap: {{SIZE}}px;',
                ],
                'condition' => ['layout_control' => ['10']],
            ]
        );

        $this->add_control(
            'rotate_image',
            [
                'label' => esc_html__('Rotate Image', 'tpcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => ['layout_control' => ['5']],

            ]
        );
        $this->add_control(
            'icon_image',
            [
                'label' => esc_html__('Icon Image', 'tpcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => ['layout_control' => ['5']],
            ]
        );

        $this->end_controls_section();

        //heading Style		
        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__('Button Style', 'tpcore'),
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
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpr__button-wrap' => 'text-align: {{VALUE}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_padding',
            [
                'label'      => esc_html__('Padding', 'pyloncore'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpr__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'selector' => '{{WRAPPER}} .wpr__button',
            ]
        );

        $this->add_responsive_control(
            'border-radius',
            [
                'label' => esc_html__('Border radius', 'tpcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .wpr__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );


        // button Color styles
        $this->start_controls_tabs(
            'style_tabs'
        );
        $this->start_controls_tab(
            'btn_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'tpcore'),
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label' => esc_html__('Background', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__button' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_color',
            [
                'label' => esc_html__('Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__button' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__('Hover', 'tpcore'),
            ]
        );
        $this->add_control(
            'btn_bg_color_hover',
            [
                'label' => esc_html__('Background', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__button:hover' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_color_hover',
            [
                'label' => esc_html__('Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'label' => __('Typography', 'tpcore'),
                'selector' => '{{WRAPPER}} .wpr__button',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'btn_text_stroke',
                'selector' => '{{WRAPPER}} .wpr__button',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'btn_shadow',
                'selector' => '{{WRAPPER}} .wpr__button',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'btn_icon_style',
            [
                'label' => esc_html__('Icon Style', 'tpcore'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'btn_icon_bg',
            [
                'label' => esc_html__('BG Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-three i' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_icon_color',
            [
                'label' => esc_html__('Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__button svg' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .btn-two span .arry1' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .btn-one.active span .arry1, .active.btn-four span .arry1, .active.btn-two span .arry1' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .btn-three i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .btn-four span .arry1 ' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_icon_color_hover',
            [
                'label' => esc_html__('Hover', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__button:hover svg' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .btn-two span .arry2' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .btn-four span .arry2' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .btn-one.active span .arry2, .active.btn-four span .arry2, .active.btn-two span .arry2' => 'color: {{VALUE}}'
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_icon_size',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Icon Size', 'tpcore'),
                'default' => [
                    'size' => 60,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .wpr__button svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpr__button i' => 'width: {{SIZE}}{{UNIT}};',
                ],
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

        if ($layout == '3') {
            $this->add_render_attribute(
                'btn_attr',
                [
                    'class' => ['wpr__button btn-three'],
                    'href'    => $settings['btn_link']['url'],
                    'target' => $settings['btn_link']['is_external'] ? '_blank' : '',
                ]
            );
        } elseif ($layout == '2') {
            $this->add_render_attribute(
                'btn_attr',
                [
                    'class' => ['wpr__button btn-two'],
                    'href'    => $settings['btn_link']['url'],
                    'target' => $settings['btn_link']['is_external'] ? '_blank' : '',
                ]
            );
        } elseif ($layout == '4') {
            $this->add_render_attribute(
                'btn_attr',
                [
                    'class' => ['wpr__button btn-four'],
                    'href'    => $settings['btn_link']['url'],
                    'target' => $settings['btn_link']['is_external'] ? '_blank' : '',
                ]
            );
        } elseif ($layout == '5') {
            $this->add_render_attribute(
                'btn_attr',
                [
                    'class' => ['wpr__button text-btn'],
                    'href'    => $settings['btn_link']['url'],
                    'target' => $settings['btn_link']['is_external'] ? '_blank' : '',
                ]
            );
        } else {
            $is_icon = (!empty($settings['btn_icon']['value'])) ? 'btn-has-icon' : '';
            $this->add_render_attribute(
                'btn_attr',
                [
                    'class' => ['wpr__button btn-one active', $is_icon],
                    'href'    => $settings['btn_link']['url'],
                    'target' => $settings['btn_link']['is_external'] ? '_blank' : '',
                ]
            );
        }


?>

        <?php if ($layout === '2'): ?>

            <?php if ($settings['btn_text']): ?>
                <div class="wpr__button-wrap">
                    <a <?php echo $this->get_render_attribute_string('btn_attr'); ?>><?php echo wp_kses($settings['btn_text'], $allowed_tags); ?>
                        <?php if ('yes' === $settings['show_icon']): ?>
                            <span>
                                <i class="fa-regular fa-arrow-up-right arry1"></i>
                                <i class="fa-regular fa-arrow-up-right arry2"></i>
                            </span>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endif; ?>

        <?php elseif ($layout === '3'): ?>

            <?php if ($settings['btn_text']): ?>
                <div class="wpr__button-wrap">
                    <a <?php echo $this->get_render_attribute_string('btn_attr'); ?>><?php echo wp_kses($settings['btn_text'], $allowed_tags);
                                                                                        \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']) ?></a>
                </div>
            <?php endif; ?>

        <?php elseif ($layout === '4'): ?>

            <?php if ($settings['btn_text']): ?>
                <div class="wpr__button-wrap">
                    <a <?php echo $this->get_render_attribute_string('btn_attr'); ?>><?php echo wp_kses($settings['btn_text'], $allowed_tags); ?>
                        <?php if ('yes' === $settings['show_icon']): ?>
                            <span>
                                <i class="fa-regular fa-arrow-right arry1"></i>
                                <i class="fa-regular fa-arrow-right arry2"></i>
                            </span>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endif; ?>

        <?php elseif ($layout === '5'): ?>

            <?php if ($settings['btn_text']): ?>
                <div class="wpr__button-wrap banner-four__image">
                    <a <?php echo $this->get_render_attribute_string('btn_attr'); ?>>
                        <?php if (!empty($settings['rotate_image'])) : ?>
                            <?php echo wp_get_attachment_image($settings['rotate_image']['id'], 'full', '', [
                                'class' => 'btn-circle animation__rotate',
                            ]); ?>
                        <?php endif; ?>
                        <?php if (!empty($settings['icon_image'])) : ?>
                            <?php echo wp_get_attachment_image($settings['icon_image']['id'], 'full', '', [
                                'class' => 'btn-arry',
                            ]); ?>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <!-- Default Button -->
            <?php if ($settings['btn_text']): ?>
                <div class="wpr__button-wrap">
                    <a <?php echo $this->get_render_attribute_string('btn_attr'); ?>><?php echo wp_kses($settings['btn_text'], $allowed_tags); ?>
                        <?php if ('yes' === $settings['show_icon']): ?>
                            <span>
                                <i class="fa-regular fa-arrow-up-right arry1"></i>
                                <i class="fa-regular fa-arrow-up-right arry2"></i>
                            </span>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endif; ?>

<?php endif;
    }
}

$widgets_manager->register(new WPR_Button());
