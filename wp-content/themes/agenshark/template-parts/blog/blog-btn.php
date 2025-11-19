<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agenshark
 */

$agenshark_blog_btn = get_theme_mod('agenshark_blog_btn', 'Read More');
$agenshark_blog_btn_switch = get_theme_mod('agenshark_blog_btn_switch', true);

?>

<?php if (!empty($agenshark_blog_btn_switch)) : ?>
    <div class="tp-postbox-read-more">
        <a href="<?php the_permalink(); ?>" class="tp-postbox-btn"><?php print esc_html($agenshark_blog_btn); ?></a>
    </div>
<?php endif; ?>