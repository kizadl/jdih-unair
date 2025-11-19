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


if (!defined('ABSPATH')) exit;

/**
 * Marketi Core
 *
 * Elementor widget for Headings
 *
 * @since 1.0.0
 */
class WPR_Branding extends \Elementor\Widget_Base
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
        return 'wpr_branding';
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
        return esc_html__('Brand Carousel', 'tpcore');
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
                'label' => esc_html__('Contents', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout_control',
            [
                'label'   => esc_html__('Layout Style', 'tpcore'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => array(
                    '1' => esc_html__('Style One ', 'tpcore'),
                    '2' => esc_html__('Style Two ', 'tpcore'),
                ),
            ]
        );

        $this->add_control(
            'item_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
                'default' => esc_html__('Used by World Leading Companies', 'tpcore'),
                'placeholder' => esc_html__('Widget Title', 'tpcore'),
            ]
        );

        $this->add_control(
            'gallery',
            [
                'label' => esc_html__('Add Images', 'tpcore'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'show_label' => false,
                'default' => [],
            ]
        );

        $this->end_controls_section();

        //heading Style		
        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // widget title for Layout three 3
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'widget_title',
                'selector' => '{{WRAPPER}} .st__brand-title',
                'condition' => ['layout_control' => '1'],
            ]
        );

        // Title color for Layout 3
        $this->add_control(
            'widget_title_color',
            [
                'label' => esc_html__('Title Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .st__brand-title' => 'color: {{VALUE}}',
                ],
                'condition' => ['layout_control' => '1'],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Spacing', 'tpcore'),
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .st__brand-title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
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
        $layout = $settings['layout_control'];
?>

        <?php if ($layout === '1') : ?>
            <?php if ($settings['gallery']) : ?>
                <div class="brand-area">
                    <?php if (!empty($settings['item_title'])) : ?>
                        <P class="st__brand-title"><i class="fa-regular me-1 fa-arrow-right"></i><?php echo tp_kses($settings['item_title']); ?>
                        </P>
                    <?php endif; ?>
                    <div class="marquee-area">
                        <div class="container">
                            <div class="swiper brand__slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($settings['gallery'] as $image) : ?>
                                        <div class="swiper-slide">
                                            <?php echo wp_get_attachment_image($image['id'], 'full'); ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        <?php elseif ($layout === '2') : ?>
            <!-- Brand area start here -->
            <?php if ($settings['gallery']) : ?>
                <div class="brand-area">
                    <div class="container">
                        <div class="swiper brand__slider st__brand-slide-pt bor-top">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['gallery'] as $image) : ?>
                                    <div class="swiper-slide">
                                        <?php echo wp_get_attachment_image($image['id'], 'full'); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Brand area end here -->


<?php endif;
    }
}
$widgets_manager->register(new WPR_Branding());
