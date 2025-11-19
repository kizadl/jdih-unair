<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agenshark
 */

$gallery_images = function_exists('get_field') ? get_field('gallery_images') : '';
if (is_single()) : ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('tp-postbox-item format-gallery mb-60'); ?>>
        <?php if (!empty($gallery_images)) : ?>
            <div class="tp-postbox-item-thumb p-relative w-img">
                <div class="tp-gallery-post swiper-container p-relative">
                    <div class="swiper-wrapper">
                        <?php foreach ($gallery_images as $key => $image) : ?>
                            <div class="tp-gallery-post-item swiper-slide">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="tp-blog-nav">
                        <button class="tp-blog-button-next"><i class="fal fa-arrow-right"></i></button>
                        <button class="tp-blog-button-prev"><i class="fal fa-arrow-left"></i></button>
                    </div>
                </div>
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
    <article id="post-<?php the_ID(); ?>" <?php post_class('tp-postbox-item format-gallery mb-60'); ?>>
        <?php if (!empty($gallery_images)) : ?>
            <div class="tp-postbox-thumb w-img">
                <div class="tp-gallery-post swiper-container p-relative">
                    <div class="swiper-wrapper">
                        <?php foreach ($gallery_images as $key => $image) : ?>
                            <div class="tp-gallery-post-item swiper-slide">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="tp-blog-nav">
                        <button class="tp-blog-button-next"><i class="fal fa-arrow-right"></i></button>
                        <button class="tp-blog-button-prev"><i class="fal fa-arrow-left"></i></button>
                    </div>
                </div>
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
<?php
endif; ?>