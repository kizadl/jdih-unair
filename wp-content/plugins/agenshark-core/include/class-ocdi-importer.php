<?php

if (!defined('ABSPATH')) {
    exit;
}

class TP_OCDI_Demo_Importer
{

    public function __construct()
    {
        add_filter('pt-ocdi/import_files', [$this, 'import_files_config']);
        add_filter('ocdi/after_import', [$this, 'ocdi_after_import_setup']);
        add_filter('pt-ocdi/disable_pt_branding', '__return_true');
        add_action('init', [$this, 'tp_ocdi_rewrite_flush']);
    }

    public function import_files_config()
    {

        $home_prevs = array(
            'tp_demo_home_1' => array(
                'title' => __('Startup Agency', 'tpcore'),
                'page' => __('Home', 'tpcore'),
                'screenshot' => plugins_url('assets/img/demo/home1.jpg', dirname(__FILE__)),
                'preview_link' => 'https://agenshark.wprealizer.com/',
            ),
            'tp_demo_home_2' => array(
                'title' => __('Digital Marketing', 'tpcore'),
                'page' => __('Home - 02', 'tpcore'),
                'screenshot' => plugins_url('assets/img/demo/home2.jpg', dirname(__FILE__)),
                'preview_link' => 'https://agenshark.wprealizer.com/home-02/',
            ),
            'tp_demo_home_3' => array(
                'title' => __('SEO Marketing', 'tpcore'),
                'page' => __('Home - 03', 'tpcore'),
                'screenshot' => plugins_url('assets/img/demo/home3.jpg', dirname(__FILE__)),
                'preview_link' => 'https://agenshark.wprealizer.com/home-03/',
            ),
            'tp_demo_home_4' => array(
                'title' => __('Creative Agency', 'tpcore'),
                'page' => __('Home - 04', 'tpcore'),
                'screenshot' => plugins_url('assets/img/demo/home4.jpg', dirname(__FILE__)),
                'preview_link' => 'https://agenshark.wprealizer.com/home-04/',
            ),
        );


        $config = [];

        $import_path = trailingslashit(get_template_directory()) . 'sample-data/';

        foreach ($home_prevs as $key => $prev) {

            $contents_demo = 'https://themeforest.wprealizer.com/agenshark-wp/demo/contents-demo.xml?ver=' . time();
            $widget_settings = 'https://themeforest.wprealizer.com/agenshark-wp/demo/widget-settings.wie?ver=' . time();
            $customizer_data = 'https://themeforest.wprealizer.com/agenshark-wp/demo/customizer-data.dat?ver=' . time();

            $config[] = [
                'import_file_id' => $key,
                'import_page_name' => $prev['page'],
                'import_file_name' => $prev['title'],
                'import_file_url' => esc_url($contents_demo),
                'import_widget_file_url' => esc_url($widget_settings),
                'import_customizer_file_url' => esc_url($customizer_data),
                'import_preview_image_url' => $prev['screenshot'],
                'preview_url' => $prev['preview_link'],
                'import_notice' => esc_html__('After you import this demo, you will have to setup the slider separately.', 'tpcore'),
            ];
        }

        return $config;
    }

    public function import_widgets()
    {
        $import_path = trailingslashit(get_template_directory()) . 'sample-data/';

        $widget_settings = $import_path . 'widget-settings.json';

        $config[] = [
            'local_import_widget_file' => $widget_settings,
        ];
        return $config;
    }

    public function ocdi_after_import_setup($selected_file)
    {

        $this->assign_menu_to_location();
        $this->assign_frontpage_id($selected_file);
        $this->update_permalinks();
        update_option('basa_ocdi_importer_flash', true);
    }

    private function assign_menu_to_location()
    {

        $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');

        set_theme_mod('nav_menu_locations', [
            'main-menu' => $main_menu->term_id,
        ]);
    }

    private function assign_frontpage_id($selected_import)
    {

        $front_page = ag_get_page_by_title($selected_import['import_page_name']);
        $blog_page = ag_get_page_by_title('Blog');

        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page->ID);
        update_option('page_for_posts', $blog_page->ID);
    }

    private function update_permalinks()
    {
        update_option('permalink_structure', '/%postname%/');
    }

    public function tp_ocdi_rewrite_flush()
    {

        if (get_option('basa_ocdi_importer_flash') == true) {
            flush_rewrite_rules();
            delete_option('basa_ocdi_importer_flash');
        }
    }
}

new TP_OCDI_Demo_Importer;
