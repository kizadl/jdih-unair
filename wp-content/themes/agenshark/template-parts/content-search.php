<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agenshark
 */

if (is_single()) : ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('tp-postbox-item format-search mb-60'); ?>>
        <?php if (has_post_thumbnail()) : ?>
            <div class="tp-postbox-item-thumb p-relative">
                <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
            </div>
        <?php endif; ?>
        <div class="tp-postbox-details-content">
            <div class="tp-postbox-meta">
                <?php get_template_part('template-parts/blog/blog-meta'); ?>
            </div>
            <h3 class="tp-postbox-details-title">
                <?php the_title(); ?>
            </h3>
            <div class="tp-postbox-details-text pb-30">
                <?php the_content(); ?>
                <?php
                wp_link_pages([
                    'before'      => '<div class="page-links">' . esc_html__('Pages:', 'agenshark'),
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ]);
                ?>
            </div>
            <div class="tp-postbox-tags">
                <?php print agenshark_get_tag(); ?>
            </div>
        </div>
    </article>
<?php else : ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('tp-postbox-item format-search mb-60'); ?>>
        <?php if (has_post_thumbnail()) : ?>
            <div class="tp-postbox-thumb w-img">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
                </a>
            </div>
        <?php endif; ?>
        <div class="tp-postbox-content">
            <div class="tp-postbox-meta">
                <!-- blog meta -->
                <?php get_template_part('template-parts/blog/blog-meta'); ?>
            </div>
            <h3 class="tp-postbox-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class="tp-postbox-text">
                <?php the_excerpt(); ?>
            </div>
            <!-- blog btn -->
            <?php get_template_part('template-parts/blog/blog-btn'); ?>
        </div>
    </article>
<?php endif; ?>