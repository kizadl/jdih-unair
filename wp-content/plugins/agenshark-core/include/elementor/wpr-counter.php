<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly


/**
 * Marketi Core
 *
 * Elementor widget for Headings
 *
 * @since 1.0.0
 */
class WPR_Counter extends \Elementor\Widget_Base
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
        return 'wpr_counter';
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
        return __('Counter', 'tpcore');
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
         * Start layout control
         */
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__('Layout', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        /**
         *
         * Select style
         * =========================
         */
        $this->add_control(
            'st_counter_layout',
            [
                'label' => esc_html__('Layout', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                    'style-1' => esc_html__('Style 1', 'tpcore'),
                    'style-2' => esc_html__('Style 2', 'tpcore'),
                ],
            ]
        );

        $this->end_controls_section();
        //End control layout


        /**
         * 
         * Start Content control
         */
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        // Number controll
        $repeater->add_control(
            'counter_number',
            [
                'label' => esc_html__('Number', 'tpcore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 10,
            ]
        );
        // Number Prefix
        $repeater->add_control(
            'counter_prefix',
            [
                'label' => esc_html__('Prefix', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('1', 'tpcore'),
            ]
        );
        // Number Suffix
        $repeater->add_control(
            'counter_suffix',
            [
                'label' => esc_html__('Suffix', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Plus', 'tpcore'),
            ]
        );
        // Title
        $repeater->add_control(
            'counter_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type your title here', 'tpcore'),
            ]
        );
        // Animation Delay
        $repeater->add_control(
            'ani_delay',
            [
                'label' => esc_html__('Animation Delay', 'tpcore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0.1,
                'description' => 'Animation Delay will render as a SECONDS'
            ]
        );


        $this->add_control(
            'counter_list',
            [
                'label' => esc_html__('Repeater List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'counter_title' => esc_html__('Active user', 'tpcore'),
                        'counter_number' => esc_html__(10, 'tpcore'),
                        'counter_suffix' => esc_html__('k', 'tpcore'),
                    ],
                    [
                        'counter_title' => esc_html__('Total Download', 'tpcore'),
                        'counter_number' => esc_html__(20, 'tpcore'),
                        'counter_suffix' => esc_html__('k+', 'tpcore'),
                    ],
                ],
                'title_field' => '{{{ counter_title }}}',
            ]
        );

        $this->end_controls_section();

        /**
         * ***********
         *  Styles Controls
         */
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Counter style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // slide dimention
        $this->add_responsive_control(
            'margin',
            [
                'label' => esc_html__('Margin', 'tpcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .fanfact__item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'before_counter_color',
            [
                'label' => esc_html__('Prefix', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .st-counter-before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'counter_typo',
                'selector' => '{{WRAPPER}} .st-counter-before',
            ],
        );


        $this->add_control(
            'counter_color',
            [
                'label' => esc_html__('Counter Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .st-counter-number' => 'color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'after_counter_typo',
                'selector' => '{{WRAPPER}} .st-counter-number',
            ],
        );


        $this->add_control(
            'after_counter_color',
            [
                'label' => esc_html__('Suffix Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .st-counter-after' => 'color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'aftercounter_typo',
                'selector' => '{{WRAPPER}} .st-counter-after',
            ],
        );


        $this->add_control(
            'label_counter_color',
            [
                'label' => esc_html__('Counter label', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .st-counter-label' => 'color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'labelcounter_typo',
                'selector' => '{{WRAPPER}} .st-counter-label',
            ],
        );

        $this->end_controls_section();
        //End control Content
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
        $id = $this->get_id();
?>

        <?php if ($settings['st_counter_layout'] == 'style-10') : ?>
            <div class="about__counter">
                <?php foreach ($settings['counter_list'] as $key => $list) : ?>
                    <div class="coun-item wow fadeInDown" data-wow-delay="<?php echo esc_attr($list['ani_delay'] . 's') ?>" data-wow-duration="1000ms">
                        <?php
                        $counter_prefix = $list['counter_prefix'] ? '<span class="st-counter-before">' . $list['counter_prefix'] . '</span>' : '';
                        $counter_number = $list['counter_number'] ? '<span class="st-counter st-counter-number count">' . $list['counter_number'] . '</span>' : '';
                        $counter_suffix = $list['counter_suffix'] ? '<span class="st-counter-after">' . $list['counter_suffix'] . '</span>' : '';

                        printf('<h3 class="countdown-info st-counter-number">%1$s%2$s%3$s</h3>', tp_kses($counter_prefix), tp_kses($counter_number), tp_kses($counter_suffix));
                        printf(tp_kses('<p class="st-counter-label">%1$s</p>'), $list['counter_title']);
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif ($settings['st_counter_layout'] == 'style-1') : ?>
            <div class="fanfact__item-right">
                <?php foreach ($settings['counter_list'] as $key => $list) : ?>
                    <div class="fanfact__item">
                        <?php
                        $counter_prefix = $list['counter_prefix'] ? '<span class="st-counter-before">' . $list['counter_prefix'] . '</span>' : '';
                        $counter_number = $list['counter_number'] ? '<span class="st-counter st-counter-number count">' . $list['counter_number'] . '</span>' : '';
                        $counter_suffix = $list['counter_suffix'] ? '<span class="st-counter-after">' . $list['counter_suffix'] . '</span>' : '';

                        printf('<h2 class="mb-10">%1$s%2$s%3$s</h2>', tp_kses($counter_prefix), tp_kses($counter_number), tp_kses($counter_suffix));
                        printf(tp_kses('<p class="st-counter-label"><strong>%1$s</strong></p>'), $list['counter_title']);
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new WPR_Counter());
