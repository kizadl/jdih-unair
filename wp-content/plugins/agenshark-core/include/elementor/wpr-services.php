<?php

namespace TPCore\Widgets;

use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Saasto Core
 *
 * Elementor widget for Headings
 *
 * @since 1.0.0
 */
class WPR_Service extends \Elementor\Widget_Base
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
        return 'wpr-services';
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
        return __('Services Card', 'tpcore');
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

        // Content Repeater start
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout_control',
            [
                'label'   => esc_html__(
                    'Layout Style',
                    'tpcore'
                ),
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

        $this->add_control(
            'featured_card',
            [
                'label' => esc_html__('Featured Item', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => ['layout_control' => ['1']],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'tpcore'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-star',
                    'library' => 'fa-solid',
                ]
            ]
        );
        $this->add_control(
            'services_image',
            [
                'label' => esc_html__('Choose Image', 'tpcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => ['layout_control' => ['5']],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default title', 'tpcore'),
                'placeholder' => esc_html__('Type your title here', 'tpcore'),
                'label_block'   => true
            ]
        );
        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Default description', 'tpcore'),
                'placeholder' => esc_html__('Type your description here', 'tpcore'),
            ]
        );
        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Learn More', 'tpcore'),
                'placeholder' => esc_html__('Type your title here', 'tpcore'),
                'condition' => ['layout_control' => ['1', '3']]
            ]
        );
        $this->add_control(
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
                'label_block' => true,
                'condition' => ['layout_control' => ['1', '3']]
            ]
        );

        // Animation Delay
        $this->add_control(
            'repeat_ani_delay',
            [
                'label' => esc_html__('Animation Delay', 'marketicore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0.1,
                'description' => 'Animation Delay will render as a SECONDS',
                'condition' => ['layout_control' => ['2', '3']]
            ]
        );

        $this->end_controls_section();

        // Style controll
        $this->start_controls_section(
            'box_style',
            [
                'label' => esc_html__('Box Style', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'box_bg',
            [
                'label' => esc_html__('Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__services_card' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .service-three__item ' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'box_hover_bg',
            [
                'label' => esc_html__('Box Hover Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__services_card.active' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['layout_control' => ['1']]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .wpr__services_card',
            ]
        );

        $this->add_control(
            'headline_align',
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
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .wpr__services_card' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__('Padding', 'tpcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .wpr__services_card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .wpr__services_card',
            ]
        );
        $this->add_control(
            'border-radius',
            [
                'label' => esc_html__('Border radius', 'tpcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .wpr__services_card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();


        // Style controll
        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__('Icon Style', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'team_icon_color',
            [
                'label' => esc_html__('Icon', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__service_icon' => 'color: {{VALUE}}; fill:  {{VALUE}};'
                ],
            ]
        );
        $this->add_control(
            'icon_bg',
            [
                'label' => esc_html__('Icon Background', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__service_icon' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'font-size',
            [
                'label' => esc_html__('Width', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'default' => [
                    'unit' => 'px',
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr__service_icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bg-radius',
            [
                'label' => esc_html__('Radius', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .wpr__service_icon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bg-widht-height',
            [
                'label' => esc_html__('Stack width', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .wpr__service_icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Spacing', 'tpcore'),
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
                'selectors' => [
                    '{{WRAPPER}} .wpr__icon_gap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['layout_control' => ['4', '5']]
            ]
        );

        $this->end_controls_section();


        // Style controll
        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__('Content', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Heading Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__service_title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .wpr__service_title',
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Spacing', 'tpcore'),
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
                'selectors' => [
                    '{{WRAPPER}} .wpr__heading_gap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__services_card .wpr__service_card_info p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .wpr__services_card .wpr__service_card_info p',
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Spacing', 'tpcore'),
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
                'selectors' => [
                    '{{WRAPPER}} .wpr__desc_gap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['layout_control' => ['1', '3']],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Button Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__service_btn a' => 'color: {{VALUE}}',
                ],
                'condition' => ['layout_control' => ['1', '3']],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .wpr__service_btn a',
                'condition' => ['layout_control' => ['1', '3']],
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
        $allowed_tags = wp_kses_allowed_html('post');
        $id = $this->get_id();
        $active_class = $settings['featured_card'] === 'yes' ? 'active' : '';

        if (!empty($settings['btn_link']['url'])) {
            $this->add_link_attributes('btn_link', $settings['btn_link']);
        }
?>
        <?php
        if ($settings['layout_control'] == '1') { ?>
            <div class="wpr__services_card service__item <?php echo esc_attr($active_class); ?>">
                <div class="wpr__heading_gap d-flex align-items-center gap-2">
                    <div class="wpr__service_icon icon">
                        <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                    </div>

                    <?php
                    if (!empty($settings['title'])) {
                        echo ' <h4 class="wpr__service_title wow splt-txt" data-splitting>' . tp_kses($settings['title']) . '</h4>';
                    }
                    ?>
                </div>
                <div class="wpr__service_card_info">
                    <?php
                    if (!empty($settings['description'])) {
                        echo '<p class="wpr__service_desc wpr__desc_gap">' . tp_kses($settings['description']) . '</p>';
                    }

                    if (!empty($settings['btn_text']) && !empty($settings['btn_link']['url'])) {
                        echo '<div class="wpr__service_btn">';
                        echo '<a ' . $this->get_render_attribute_string('btn_link') . '>' . esc_html($settings['btn_text']) . '<i class="fa-light ms-1 fa-arrow-right"></i> </a>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

        <?php } elseif ($settings['layout_control'] == '2') { ?>

            <div class="wow bounceInUp" data-wow-delay="<?php echo esc_attr($settings['repeat_ani_delay'] . 's') ?>" data-wow-duration="1500ms">
                <div class="wpr__services_card feature__item">
                    <div class="wpr__service_icon feature__icon bg1 mb-30">
                        <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                    <div class="wpr__service_card_info">
                        <?php
                        if (!empty($settings['title'])) {
                            echo '<h3 class="wpr__service_title wpr__heading_gap mb-10">' . tp_kses($settings['title']) . '</h3>';
                        }
                        if (!empty($settings['description'])) {
                            echo '<p class="wpr__service_desc">' . tp_kses($settings['description']) . '</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>

        <?php } elseif ($settings['layout_control'] == '3') { ?>
            <div class="wow bounceInUp" data-wow-delay="<?php echo esc_attr($settings['repeat_ani_delay'] . 's') ?>" data-wow-duration="1500ms">
                <div class="wpr__services_card service-two__item">
                    <div class="wpr__service_icon icon">
                        <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                    <div class="service-two__content wpr__service_card_info">
                        <?php
                        if (!empty($settings['title'])) {
                            echo ' <h3 class="wpr__service_title wpr__heading_gap mb-10" data-splitting>' . tp_kses($settings['title']) . '</h3>';
                        }

                        if (!empty($settings['description'])) {
                            echo '<p class="wpr__service_desc wpr__desc_gap b-20">' . tp_kses($settings['description']) . '</p>';
                        }

                        if (!empty($settings['btn_text']) && !empty($settings['btn_link']['url'])) {
                            echo '<div class="wpr__service_btn">';
                            echo '<a class="explore-btn" ' . $this->get_render_attribute_string('btn_link') . '>' . esc_html($settings['btn_text']) . '<i class="fa-light ms-1 fa-arrow-right"></i> </a>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php } elseif ($settings['layout_control'] == '4') { ?>
            <div class="wpr__services_card service-three__item">
                <?php if (!empty($settings['icon'])) : ?>
                    <div class="wpr__service_icon wpr__icon_gap service-three__icon mb-20">
                        <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                <?php endif; ?>
                <div class="wpr__service_card_info">
                    <?php
                    if (!empty($settings['title'])) {
                        echo ' <h3 class="wpr__service_title wpr__heading_gap mb-10" data-splitting>' . tp_kses($settings['title']) . '</h3>';
                    }

                    if (!empty($settings['description'])) {
                        echo '<p class="wpr__service_desc wpr__desc_gap">' . tp_kses($settings['description']) . '</p>';
                    }
                    ?>
                </div>
            </div>
        <?php } elseif ($settings['layout_control'] == '5') { ?>
            <div class="wpr__services_card service-three__item gap-3 d-flex align-items-end">
                <div class="service-three__item p-0">
                    <?php if (!empty($settings['icon'])) : ?>
                        <div class="wpr__service_icon wpr__icon_gap service-three__icon mb-20">
                            <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="wpr__service_card_info">
                        <?php
                        if (!empty($settings['title'])) {
                            echo ' <h3 class="wpr__service_title wpr__heading_gap mb-10" data-splitting>' . tp_kses($settings['title']) . '</h3>';
                        }

                        if (!empty($settings['description'])) {
                            echo '<p class="wpr__service_desc wpr__desc_gap">' . tp_kses($settings['description']) . '</p>';
                        }
                        ?>
                    </div>
                </div>
                <?php if (!empty($settings['services_image'])) : ?>
                    <div class="service-three__image">
                        <?php echo wp_get_attachment_image($settings['services_image']['id'], 'full', '', ['class' => '']) ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php } ?>
<?php
    }
}

$widgets_manager->register(new WPR_Service());
