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
class TP_Booking extends Widget_Base
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
        return 'booking';
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
        return __('Booking', 'tpcore');
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
        return ['booking', 'disount', 'free quote'];
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
            'tp_booking_design_layout_section',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_booking_design_layout',
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
            'tp_booking_content_section',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_booking_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Title Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_booking_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_booking_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Add Your Description Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_booking_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_booking_features_1',
            [
                'label' => esc_html__('Features - 1', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Features Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your features', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_booking_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_booking_features_2',
            [
                'label' => esc_html__('Features - 2', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Features Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your features', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_booking_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_booking_features_3',
            [
                'label' => esc_html__('Features - 2', 'tpcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Add Your Features Here', 'tpcore'),
                'placeholder' => esc_html__('Enter your features', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_booking_design_layout' => ['layout-1']
                ]
            ]
        );


        // btn 
        $this->add_control(
            'tp_booking_link_switcher',
            [
                'label' => esc_html__('Button Switch', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'tp_booking_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_booking_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_booking_link_switcher' => 'yes',
                    'tp_booking_design_layout' => ['layout-1']
                ],
            ]
        );

        $this->add_control(
            'tp_booking_link_type',
            [
                'label' => esc_html__('Button URL Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom URL',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_booking_link_switcher' => 'yes',
                    'tp_booking_design_layout' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_booking_link',
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
                    'tp_booking_link_type' => '1',
                    'tp_booking_link_switcher' => 'yes',
                    'tp_booking_design_layout' => ['layout-1']
                ]
            ]
        );


        $this->add_control(
            'tp_booking_page_link',
            [
                'label' => esc_html__('Internal Page Link', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_booking_link_type' => '2',
                    'tp_booking_link_switcher' => 'yes',
                    'tp_booking_design_layout' => ['layout-1']
                ]
            ]
        ); // btn end


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

        <?php if ($settings['tp_booking_design_layout']  == 'layout-1') :
            // btn
            if ('2' == $settings['tp_booking_link_type']) {
                $link = get_permalink($settings['tp_booking_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['tp_booking_link']['url']) ? $settings['tp_booking_link']['url'] : '';
                $target = !empty($settings['tp_booking_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_booking_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>

            <section class="agenshark-wrap book-area">
                <div class="container">
                    <div class="book__wrp">
                        <div class="book__shape1">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/book-star.png" alt="shape">
                        </div>
                        <div class="book__shape2">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/book-star.png" alt="shape">
                        </div>
                        <div class="book__left-arry">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/book-btn-left.png" alt="shape">
                        </div>
                        <div class="book__right-arry">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/book-btn-right.png" alt="shape">
                        </div>
                        <div class="book__item">
                            <?php if (!empty($settings['tp_booking_title'])) : ?>
                                <h2> <?php echo $settings['tp_booking_title'] ?></h2>
                            <?php endif; ?>
                            <?php if (!empty($settings['tp_booking_description'])) : ?>
                                <p class="mt-20 mb-25"> <?php echo tp_kses($settings['tp_booking_description']) ?> </p>
                            <?php endif; ?>
                            <ul class="d-flex align-items-center gap-2 gap-md-4 flex-wrap justify-content-center">
                                <li><svg class="me-1" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.1221 6.88023L16.6812 6.43922C16.4002 6.15822 16.2421 5.77622 16.2421 5.37822V4.75722C16.2421 3.10122 14.9002 1.75923 13.2442 1.75923H12.6232C12.2252 1.75923 11.8442 1.60124 11.5622 1.32024L11.1212 0.879227C9.95017 -0.291773 8.05218 -0.291773 6.88118 0.879227L6.44014 1.32024C6.15914 1.60124 5.77723 1.75923 5.37923 1.75923H4.75826C3.10225 1.75923 1.76021 3.10122 1.76021 4.75722V5.37822C1.76021 5.77622 1.60224 6.15722 1.32124 6.43922L0.880203 6.88023C-0.290797 8.05123 -0.290797 9.94922 0.880203 11.1202L1.32124 11.5612C1.60224 11.8422 1.76021 12.2242 1.76021 12.6222V13.2432C1.76021 14.8992 3.10225 16.2412 4.75826 16.2412H5.37923C5.77723 16.2412 6.15814 16.3992 6.44014 16.6802L6.88118 17.1212C8.05218 18.2922 9.95017 18.2922 11.1212 17.1212L11.5622 16.6802C11.8432 16.3992 12.2252 16.2412 12.6232 16.2412H13.2442C14.9002 16.2412 16.2421 14.8992 16.2421 13.2432V12.6222C16.2421 12.2242 16.4002 11.8432 16.6812 11.5612L17.1221 11.1202C18.2931 9.94922 18.2931 8.05123 17.1221 6.88023ZM12.5302 7.53023L8.53023 11.5302C8.38423 11.6762 8.1922 11.7502 8.0002 11.7502C7.8082 11.7502 7.61617 11.6772 7.47017 11.5302L5.47017 9.53023C5.17717 9.23723 5.17717 8.76222 5.47017 8.46922C5.76317 8.17622 6.2382 8.17622 6.5312 8.46922L8.00117 9.93922L11.4711 6.46922C11.7641 6.17622 12.2392 6.17622 12.5322 6.46922C12.8232 6.76222 12.8232 7.23823 12.5302 7.53023Z" fill="white" fill-opacity="0.7" />
                                    </svg>
                                    <?php if (!empty($settings['tp_booking_features_1'])) : ?>
                                        <?php echo $settings['tp_booking_features_1'] ?>
                                    <?php endif; ?>
                                </li>
                                <li>
                                    <svg class="me-1" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.1221 6.88023L16.6812 6.43922C16.4002 6.15822 16.2421 5.77622 16.2421 5.37822V4.75722C16.2421 3.10122 14.9002 1.75923 13.2442 1.75923H12.6232C12.2252 1.75923 11.8442 1.60124 11.5622 1.32024L11.1212 0.879227C9.95017 -0.291773 8.05218 -0.291773 6.88118 0.879227L6.44014 1.32024C6.15914 1.60124 5.77723 1.75923 5.37923 1.75923H4.75826C3.10225 1.75923 1.76021 3.10122 1.76021 4.75722V5.37822C1.76021 5.77622 1.60224 6.15722 1.32124 6.43922L0.880203 6.88023C-0.290797 8.05123 -0.290797 9.94922 0.880203 11.1202L1.32124 11.5612C1.60224 11.8422 1.76021 12.2242 1.76021 12.6222V13.2432C1.76021 14.8992 3.10225 16.2412 4.75826 16.2412H5.37923C5.77723 16.2412 6.15814 16.3992 6.44014 16.6802L6.88118 17.1212C8.05218 18.2922 9.95017 18.2922 11.1212 17.1212L11.5622 16.6802C11.8432 16.3992 12.2252 16.2412 12.6232 16.2412H13.2442C14.9002 16.2412 16.2421 14.8992 16.2421 13.2432V12.6222C16.2421 12.2242 16.4002 11.8432 16.6812 11.5612L17.1221 11.1202C18.2931 9.94922 18.2931 8.05123 17.1221 6.88023ZM6.26021 12.4502C6.26021 12.6162 6.12616 12.7502 5.96016 12.7502H5.46016C5.07016 12.7502 4.7502 12.4302 4.7502 12.0402V8.74022C4.7502 8.34922 5.07016 8.03023 5.46016 8.03023H5.96016C6.12616 8.03023 6.26021 8.16422 6.26021 8.33022V12.4502ZM13.1302 8.95024L12.1901 11.7802C11.9901 12.3602 11.7902 12.7502 10.8402 12.7502H7.56026C7.39426 12.7502 7.26021 12.6162 7.26021 12.4502V7.62822C7.26021 7.59622 7.26522 7.56423 7.27522 7.53423L8.20015 4.74022C8.31015 4.43022 8.59021 4.25023 8.89021 4.25023C9.03021 4.25023 9.18026 4.29023 9.31026 4.38023C9.71026 4.64023 9.94014 5.08022 9.94014 5.55022V7.08022H11.7902C13.2102 7.08022 13.4402 8.03024 13.1302 8.95024Z" fill="white" fill-opacity="0.7" />
                                    </svg>
                                    <?php if (!empty($settings['tp_booking_features_2'])) : ?>
                                        <?php echo $settings['tp_booking_features_2'] ?>
                                    <?php endif; ?>
                                </li>
                                <li>
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.1221 6.88023L16.6812 6.43922C16.4002 6.15822 16.2421 5.77622 16.2421 5.37822V4.75722C16.2421 3.10122 14.9002 1.75923 13.2442 1.75923H12.6232C12.2252 1.75923 11.8442 1.60124 11.5622 1.32024L11.1212 0.879227C9.95017 -0.291773 8.05218 -0.291773 6.88118 0.879227L6.44014 1.32024C6.15914 1.60124 5.77723 1.75923 5.37923 1.75923H4.75826C3.10225 1.75923 1.76021 3.10122 1.76021 4.75722V5.37822C1.76021 5.77622 1.60224 6.15722 1.32124 6.43922L0.880203 6.88023C-0.290797 8.05123 -0.290797 9.94922 0.880203 11.1202L1.32124 11.5612C1.60224 11.8422 1.76021 12.2242 1.76021 12.6222V13.2432C1.76021 14.8992 3.10225 16.2412 4.75826 16.2412H5.37923C5.77723 16.2412 6.15814 16.3992 6.44014 16.6802L6.88118 17.1212C8.05218 18.2922 9.95017 18.2922 11.1212 17.1212L11.5622 16.6802C11.8432 16.3992 12.2252 16.2412 12.6232 16.2412H13.2442C14.9002 16.2412 16.2421 14.8992 16.2421 13.2432V12.6222C16.2421 12.2242 16.4002 11.8432 16.6812 11.5612L17.1221 11.1202C18.2931 9.94922 18.2931 8.05123 17.1221 6.88023ZM11.0352 12.5352C10.6752 12.8962 10.2212 13.1252 9.73018 13.2092V13.5002C9.73018 13.9142 9.39418 14.2502 8.98018 14.2502C8.56618 14.2502 8.23018 13.9142 8.23018 13.5002V13.2082C7.19818 13.0132 6.38624 12.1652 6.26424 11.0852C6.21724 10.6732 6.51325 10.3022 6.92525 10.2552C7.33225 10.2092 7.70823 10.5042 7.75423 10.9162C7.80823 11.3922 8.20816 11.7502 8.68416 11.7502H9.31514C9.56314 11.7502 9.7962 11.6522 9.9742 11.4752C10.1522 11.2972 10.2492 11.0622 10.2492 10.8152C10.2492 10.3862 9.95714 10.0132 9.53914 9.90724L8.09419 9.54823C7.56419 9.41423 7.09216 9.10621 6.76216 8.67921C6.43316 8.26421 6.24922 7.73123 6.24922 7.18523C6.24922 5.99823 7.1032 5.01022 8.2292 4.79622V4.50023C8.2292 4.08623 8.5652 3.75023 8.9792 3.75023C9.3932 3.75023 9.7292 4.08623 9.7292 4.50023V4.78923C10.7792 4.97023 11.6102 5.82221 11.7342 6.91621C11.7812 7.32821 11.4852 7.69923 11.0732 7.74623C10.6712 7.79423 10.2902 7.49722 10.2442 7.08522C10.1902 6.60922 9.79016 6.25124 9.31416 6.25124H8.68318C8.16718 6.25124 7.74825 6.67023 7.74825 7.18623C7.74825 7.39523 7.81624 7.59823 7.94124 7.75523C8.07224 7.92423 8.25321 8.04222 8.45821 8.09422L9.90315 8.45323C10.9912 8.72823 11.7482 9.70024 11.7482 10.8162C11.7502 11.4632 11.4962 12.0742 11.0352 12.5352Z" fill="white" fill-opacity="0.7" />
                                    </svg>
                                    <?php if (!empty($settings['tp_booking_features_2'])) : ?>
                                        <?php echo $settings['tp_booking_features_2'] ?>
                                    <?php endif; ?>
                                </li>
                            </ul>
                            <?php if (!empty($settings['tp_booking_link_switcher'])) : ?>
                                <a href="<?php echo esc_url($link); ?>" class="btn-two border-none mt-45" rel="<?php echo esc_attr($rel); ?>" target="<?php echo esc_attr($target); ?>"> <?php echo tp_kses($settings['tp_booking_btn_text']); ?>
                                    <span>
                                        <i class="fa-regular fa-arrow-up-right arry1"></i>
                                        <i class="fa-regular fa-arrow-up-right arry2"></i>
                                    </span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Booking());
