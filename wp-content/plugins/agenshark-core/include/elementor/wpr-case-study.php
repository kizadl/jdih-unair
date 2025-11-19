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
class WPR_Case_Study extends Widget_Base
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
        return 'wpr-case-study';
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
        return esc_html__('Case Studies Slider', 'tpcore');
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
                ),
            ]
        );
        $this->end_controls_section();

        /**
         * **
         * Contents for style 1
         */
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        // Image control
        $repeater->add_control(
            'slide_image',
            [
                'label' => __('Image', 'tpcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Title control
        $repeater->add_control(
            'slide_title',
            [
                'label' => __('Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Dashboard Analytics', 'tpcore'),
            ]
        );

        $repeater->add_control(
            'slide_services',
            [
                'label' => __('Add Tags', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __("UI/UX Design\nDevelopment\nCreative Service", 'tpcore'),
                'description' => __('Enter each tag on a new line.', 'tpcore'),
            ]
        );

        $repeater->add_control(
            'slide_button_text',
            [
                'label' => __('Button Text', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('View Case', 'tpcore'),
            ]
        );

        $repeater->add_control(
            'slide_button_url',
            [
                'label' => __('Button URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'tpcore'),
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __('Slider List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_title' => __('Dashboard Analytics', 'tpcore'),
                        'slide_services' => __("UI/UX Design\nDevelopment\nCreative Service", 'tpcore'),
                        'slide_button_text' => __('View Case', 'tpcore'),
                    ],
                    [
                        'slide_title' => __('Sequence - Financial Dashboard', 'tpcore'),
                        'slide_services' => __("UI/UX Design\nDashboard\nDevelopment", 'tpcore'),
                        'slide_button_text' => __('View Case', 'tpcore'),
                    ]
                ],
                'title_field' => '{{{ slide_title }}}',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Explore More', 'tpcore'),
                'separator' => __('before', 'tpcore'),
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label' => __('Button URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'tpcore'),
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
                'label' => esc_html__('Content Style', 'tpcore'),
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
                    '{{WRAPPER}} .wpr__slide_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__slide_title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .wpr__slide_title',

            ]
        );

        $this->add_control(
            'tags_color',
            [
                'label' => esc_html__('Tags Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__slide_tag' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tags_typography',
                'selector' => '{{WRAPPER}} .wpr__slide_tag',
            ]
        );

        $this->add_control(
            'fullstop_color',
            [
                'label' => esc_html__('Seperator Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .story__info ul li.li-dot' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        //Button One  Style		
        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__('Button Style', 'tpcore'),
                'tab' => Controls_Manager::TAB_STYLE,
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

        // button Color styles
        $this->start_controls_tabs(
            'style_tabs'
        );
        $this->start_controls_tab(
            'btn_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'tpcorecore'),
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
                'label' => esc_html__('Hover', 'tpcorecore'),
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

        // Inner Button Style
        //heading Style		
        $this->start_controls_section(
            'heading_style_two',
            [
                'label' => esc_html__('Inner Button Style', 'tpcore'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'btn_padding_two',
            [
                'label'      => esc_html__('Padding', 'pyloncore'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpr__button_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_border_two',
                'selector' => '{{WRAPPER}} .wpr__button_two',
            ]
        );

        // button Color styles
        $this->start_controls_tabs(
            'style_tabs_two'
        );
        $this->start_controls_tab(
            'btn_style_normal_tab_two',
            [
                'label' => esc_html__('Normal', 'tpcorecore'),
            ]
        );

        $this->add_control(
            'btn_bg_color_two',
            [
                'label' => esc_html__('Background', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__button_two' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_color_two',
            [
                'label' => esc_html__('Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__button_two' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab_two',
            [
                'label' => esc_html__('Hover', 'tpcorecore'),
            ]
        );
        $this->add_control(
            'btn_bg_color_hover_two',
            [
                'label' => esc_html__('Background', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__button_two:hover' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_color_hover_two',
            [
                'label' => esc_html__('Color', 'tpcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr__button_two:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography_two',
                'label' => __('Typography', 'tpcore'),
                'selector' => '{{WRAPPER}} .wpr__button_two',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'btn_text_stroke_two',
                'selector' => '{{WRAPPER}} .wpr__button_two',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'btn_shadow_two',
                'selector' => '{{WRAPPER}} .wpr__button_two',
            ]
        );


        $this->end_controls_section();
    }


    protected function render()
    {
        $settings    = $this->get_settings_for_display();
        $allowed_tags = wp_kses_allowed_html('post');


        if ($settings['layout_control'] == '2'): ?>

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
        /// Layout style 1 or default
        else:
        ?>
            <section class="story-area">
                <div class="container">
                    <div class="swiper story__slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['list'] as $item): ?>
                                <div class="swiper-slide">
                                    <div class="story__item">
                                        <?php if ($item['slide_image']) : ?>
                                            <div class="image">
                                                <?php echo wp_get_attachment_image($item['slide_image']['id'], 'full', '', ['class' => '']); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div
                                            class="d-flex align-items-center flex-wrap gap-3 justify-content-between mt-20">
                                            <?php if ($item['slide_title']) : ?>
                                                <div>
                                                    <h3 class="wpr__slide_title"><a href="<?php echo esc_url($item['slide_button_url']['url']); ?>"><?php echo esc_html($item['slide_title']); ?></a></h3>
                                                    <?php
                                                    if ($item['slide_services']) {
                                                        $services = explode("\n", $item['slide_services']);
                                                        echo '<div class="story__info"> <ul>';
                                                        $total_services = count($services);
                                                        foreach ($services as $index => $service) {
                                                            echo '<li class="wpr__slide_tag">' . esc_html($service) . '</li>';
                                                            if ($index < $total_services - 1) {
                                                                echo '<li class="li-dot"></li>';
                                                            }
                                                        }
                                                        echo '</ul> </div>';
                                                    }
                                                    ?>
                                                </div>
                                            <?php endif; ?>

                                            <div>
                                                <a href="<?php echo esc_url($item['slide_button_url']['url']); ?>" class="wpr__button_two btn-one"><?php echo esc_html($item['slide_button_text']); ?>
                                                    <span>
                                                        <i class="fa-regular fa-arrow-up-right arry1"></i>
                                                        <i class="fa-regular fa-arrow-up-right arry2"></i>
                                                    </span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php if ($settings['button_text']) : ?>
                        <div class="story__btn mt-80">
                            <a href="<?php echo esc_url($settings['button_url']['url']); ?>" class="wpr__button btn-one active"><?php echo esc_html($settings['button_text']); ?>
                                <span>
                                    <i class="fa-regular fa-arrow-up-right arry1"></i>
                                    <i class="fa-regular fa-arrow-up-right arry2"></i>
                                </span>
                            </a>

                            <div class="story__scrollbar">
                                <div class="position-relative">
                                    <div class="swiper-scrollbar"></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
<?php
        endif; // layout end
    }
}

$widgets_manager->register(new WPR_Case_Study());
