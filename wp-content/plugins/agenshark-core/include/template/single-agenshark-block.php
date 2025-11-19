<?php

/** 
 * The main template file
 *
 * @package  WordPress
 * @subpackage  agensharkcore
 */
get_header('block');

if (have_posts()) : while (have_posts()) : the_post();
        the_content();
    endwhile;
    wp_reset_query();
endif;

get_footer('block');
