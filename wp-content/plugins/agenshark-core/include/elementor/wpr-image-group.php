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
 * Elementor widget for Headings
 *
 * @since 1.0.0
 */
class WPR_ImageGroup extends \Elementor\Widget_Base
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
        return 'wpr-image-group';
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
        return __('Image Group', 'tpcore');
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
            'content_section',
            [
                'label' => esc_html__('Layout', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        /**
         * Select style
         * =========================
         */
        $this->add_control(
            'st_image',
            [
                'label' => esc_html__('Style', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                    'style-1' => esc_html__('Style 1', 'tpcore'),
                    'style-2' => esc_html__('Style 2', 'tpcore'),
                    'style-3' => esc_html__('Style 3', 'tpcore'),
                    'style-4' => esc_html__('Style 4', 'tpcore'),
                    'style-5' => esc_html__('Style 5', 'tpcore'),
                    'style-6' => esc_html__('Style 6', 'tpcore'),
                ],
            ]
        );

        $this->end_controls_section();
        //End control for content tab


        /**
         * 
         * Start control for Style tab
         */
        //Shape style tab start
        $this->start_controls_section(
            'media_contents',
            [
                'label' => esc_html__('Images', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image_one',
            [
                'label' => esc_html__('Choose Image one', 'tpcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],

            ]
        );
        $this->add_control(
            'image_two',
            [
                'label' => esc_html__('Choose Image two', 'tpcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition'   => ['st_image'   => ['style-1', 'style-2', 'style-3', 'style-5', 'style-6']],
            ]
        );
        $this->add_control(
            'image_three',
            [
                'label' => esc_html__('Choose Image three', 'tpcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition'   => ['st_image'   => ['style-1', 'style-2', 'style-5', 'style-6']],
            ]
        );
        $this->add_control(
            'image_four',
            [
                'label' => esc_html__('Choose Image Four', 'tpcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition'   => ['st_image'   => ['style-5']],
            ]
        );
        $this->add_control(
            'image_five',
            [
                'label' => esc_html__('Choose Image Five', 'tpcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition'   => ['st_image'   => ['style-5']],
            ]
        );

        $this->end_controls_section();
        //End control for content tab

        //Style tab start
        $this->start_controls_section(
            'group_style',
            [
                'label' => esc_html__('Style', 'tpcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Box BG
        $this->add_control(
            'group_background',
            [
                'label' => esc_html__('Background Color', 'tpcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .choose__image, .grow__image' => 'background-color: {{VALUE}}',
                ],
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
        $settings = $this->get_settings_for_display(); ?>

        <?php if ($settings['st_image'] == 'style-1') : ?>
            <div class="choose__image">
                <div class="row g-2 g-sm-4">
                    <?php if (!empty($settings['image_one'])) : ?>
                        <div class="col-6">
                            <div class="image">
                                <?php echo wp_get_attachment_image($settings['image_one']['id'], 'full', '', ['class' => '']) ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($settings['image_two'])) : ?>
                        <div class="col-6">
                            <div class="image">
                                <?php echo wp_get_attachment_image($settings['image_two']['id'], 'full', '', ['class' => '']) ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($settings['image_three'])) : ?>
                        <div class="col-12">
                            <div class="image">
                                <?php echo wp_get_attachment_image($settings['image_three']['id'], 'full', '', ['class' => '']) ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php elseif ($settings['st_image'] == 'style-2') : ?>
            <div class="grow__image">
                <div class="row g-2 g-sm-4">
                    <?php if (!empty($settings['image_one'])) : ?>
                        <div class="col-7">
                            <div class="image">
                                <?php echo wp_get_attachment_image($settings['image_one']['id'], 'full', '', ['class' => '']) ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($settings['image_two'])) : ?>
                        <div class="col-5">
                            <div class="image">
                                <?php echo wp_get_attachment_image($settings['image_two']['id'], 'full', '', ['class' => '']) ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($settings['image_three'])) : ?>
                        <div class="col-12">
                            <div class="image">
                                <?php echo wp_get_attachment_image($settings['image_three']['id'], 'full', '', ['class' => '']) ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php elseif ($settings['st_image'] == 'style-3') : ?>
            <div class="about__image">
                <?php if (!empty($settings['image_one'])) : ?>
                    <?php echo wp_get_attachment_image($settings['image_one']['id'], 'full', '', ['class' => 'w-100']) ?>
                <?php endif; ?>
                <?php if (!empty($settings['image_two'])) : ?>
                    <?php echo wp_get_attachment_image($settings['image_two']['id'], 'full', '', ['class' => 'about-kit']) ?>
                <?php endif; ?>
            </div>
        <?php elseif ($settings['st_image'] == 'style-4') : ?>
            <div class="team__shape1 animation__floatBob">
                <?php if (!empty($settings['image_one'])) : ?>
                    <?php echo wp_get_attachment_image($settings['image_one']['id'], 'full', '', ['class' => '']) ?>
                <?php endif; ?>
            </div>

        <?php elseif ($settings['st_image'] == 'style-5') : ?>
            <div class="banner-three__image paralax__animation">

                <?php echo wp_get_attachment_image($settings['image_one']['id'], 'full', '', [
                    'class' => 'w-100 wow bounceInRight',
                    'data-wow-delay' => '400ms',
                    'data-wow-duration' => '1000ms',
                ]); ?>

                <?php echo wp_get_attachment_image($settings['image_two']['id'], 'full', '', ['class' => 'here-bg',]); ?>

                <?php echo wp_get_attachment_image($settings['image_three']['id'], 'full', '', [
                    'class' => 'kit1',
                    'data-depth' => '0.03',
                ]); ?>

                <?php echo wp_get_attachment_image($settings['image_four']['id'], 'full', '', [
                    'class' => 'kit2',
                    'data-depth' => '0.1',
                ]); ?>

                <?php echo wp_get_attachment_image($settings['image_five']['id'], 'full', '', [
                    'class' => 'kit3',
                    'data-depth' => '0.05',
                ]); ?>

            </div>
        <?php elseif ($settings['st_image'] == 'style-6') : ?>
            <div class="start-now-four__image">
                <?php if (!empty($settings['image_one'])) : ?>
                    <?php echo wp_get_attachment_image($settings['image_one']['id'], 'full', '', [
                        'class' => 'w-100',
                    ]); ?>
                <?php endif; ?>
                <?php if (!empty($settings['image_two'])) : ?>
                    <?php echo wp_get_attachment_image($settings['image_two']['id'], 'full', '', [
                        'class' => 'shape1 animation__arryLeftRight d-none d-lg-block',
                    ]); ?>
                <?php endif; ?>
                <?php if (!empty($settings['image_three'])) : ?>
                    <?php echo wp_get_attachment_image($settings['image_three']['id'], 'full', '', [
                        'class' => 'shape2',
                    ]); ?>
                <?php endif; ?>
            </div>
<?php endif;
    }
}

$widgets_manager->register(new WPR_ImageGroup());
