<?php
class AgensharkblocksPost
{
    function __construct()
    {
        add_action('init', array($this, 'register_custom_post_type'));
        add_filter('template_include', array($this, 'agenshark_block_include'));

        // Add new column to agenshark-block post type
        add_filter('manage_agenshark-blocks_posts_columns', [$this, 'agenshark_blocks_columns']);
        // Populate the new column with shortcode data
        add_action('manage_agenshark-blocks_posts_custom_column', [$this, 'agenshark_blocks_shortcode'], 10, 2);

        // init shortocde
        add_shortcode('agenshark-block', [$this, 'agenshark_shortcode_blocks']);
    }

    public function agenshark_block_include($template)
    {
        if (is_singular('agenshark-blocks')) {
            return $this->get_template('single-agenshark-block.php');
        }
        return $template;
    }


    public function get_template($template)
    {
        if ($theme_file = locate_template(array($template))) {
            $file = $theme_file;
        } else {
            $file = TPCORE_ADDONS_DIR . '/include/template/' . $template;
        }
        return apply_filters(__FUNCTION__, $file, $template);
    }


    public function register_custom_post_type()
    {
        $labels = array(
            'name'                  => esc_html_x('Agenshark Block', 'Post Type General Name', 'agensharkcore'),
            'singular_name'         => esc_html_x('Agenshark Block', 'Post Type Singular Name', 'agensharkcore'),
            'menu_name'             => esc_html__('Agenshark Blocks', 'agensharkcore'),
            'name_admin_bar'        => esc_html__('Agenshark Block', 'agensharkcore'),
            'archives'              => esc_html__('Item Archives', 'agensharkcore'),
            'parent_item_colon'     => esc_html__('Parent Item:', 'agensharkcore'),
            'all_items'             => esc_html__('All Items', 'agensharkcore'),
            'add_new_item'          => esc_html__('Add New Blocks', 'agensharkcore'),
            'add_new'               => esc_html__('Add New', 'agensharkcore'),
            'new_item'              => esc_html__('New Item', 'agensharkcore'),
            'edit_item'             => esc_html__('Edit Item', 'agensharkcore'),
            'update_item'           => esc_html__('Update Item', 'agensharkcore'),
            'view_item'             => esc_html__('View Item', 'agensharkcore'),
            'search_items'          => esc_html__('Search Item', 'agensharkcore'),
            'not_found'             => esc_html__('Not found', 'agensharkcore'),
            'not_found_in_trash'    => esc_html__('Not found in Trash', 'agensharkcore'),
            'featured_image'        => esc_html__('Featured Image', 'agensharkcore'),
            'set_featured_image'    => esc_html__('Set featured image', 'agensharkcore'),
            'remove_featured_image' => esc_html__('Remove featured image', 'agensharkcore'),
            'use_featured_image'    => esc_html__('Use as featured image', 'agensharkcore'),
            'inserbt_into_item'     => esc_html__('Insert into item', 'agensharkcore'),
            'uploaded_to_this_item' => esc_html__('Uploaded to this item', 'agensharkcore'),
            'items_list'            => esc_html__('Items list', 'agensharkcore'),
            'items_list_navigation' => esc_html__('Items list navigation', 'agensharkcore'),
            'filter_items_list'     => esc_html__('Filter items list', 'agensharkcore'),
        );

        $args   = array(
            'label'                 => esc_html__('Agenshark Block', 'agensharkcore'),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'excerpt', 'thumbnail'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'               => 'dashicons-smiley',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );

        register_post_type('agenshark-blocks', $args);
    }

    public function agenshark_blocks_columns($columns)
    {
        // Move the Date column to a variable and remove it from the array
        $date = $columns['date'];
        unset($columns['date']);

        // Add the Shortcode column before the Date column
        $columns['shortcode'] = __('Shortcode');
        $columns['date'] = $date; // Add the Date column back to the array
        return $columns;
    }

    public function agenshark_blocks_shortcode($column, $post_id)
    {
        if ($column === 'shortcode') {
            echo "<input  type='text' value='[agenshark-block id=\"{$post_id}\"]' disabled style='color:#000'>";
        }
    }

    public function agenshark_shortcode_blocks($atts)
    {

        $data = shortcode_atts(array(
            'id' => '',
        ), $atts);

        $post_id = $data['id'];

        echo Elementor\Plugin::instance()->frontend->get_builder_content($post_id);
    }
}

new AgensharkblocksPost();
