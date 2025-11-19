<?php

/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agenshark
 */

// info
$agenshark_topbar_switch = get_theme_mod('agenshark_topbar_switch', false);
$agenshark_mail_id = get_theme_mod('agenshark_mail_id', __('info@example.com', 'agenshark'));
$agenshark_address = get_theme_mod('agenshark_address', __('6391 Elgin St. Celina, 10299', 'agenshark'));
$agenshark_address_url = get_theme_mod('agenshark_address_url', __('https://www.google.com/maps/search/6391+Elgin+St,+Wilmington,+DE,+USA/@39.7298967,-75.5645038,13z/data=!3m1!4b1', 'agenshark'));

// contact
$agenshark_phone_num = get_theme_mod('agenshark_phone_num', __('(629) 555-0129', 'agenshark'));
$agenshark_hotline_text = get_theme_mod('agenshark_hotline_text', __('Need help?', 'agenshark'));
$agenshark_hotline_number = get_theme_mod('agenshark_hotline_number', __('(808) 555-0111', 'agenshark'));

// header right
$agenshark_header_right = get_theme_mod('agenshark_header_right', false);
$agenshark_menu_col = $agenshark_header_right ? 'col-xxl-6 col-xl-6 d-none d-xl-block' : 'col-xxl-9 col-xl-9 col-lg-6 d-none d-lg-none d-xl-block';
$agenshark_col_align = $agenshark_header_right ? '' : 'justify-content-end';

?>

<!-- header area start -->
<header class="tp-header-area tp-agenshark-header-5 tp-header-transparent tp-header-height p-relative">
    <?php if (!empty($agenshark_topbar_switch)) : ?>
        <div class="tp-header-top d-none d-xl-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xxl-6 col-xl-8">
                        <div class="tp-header-top-info">
                            <ul>
                                <?php if (!empty($agenshark_phone_num)) : ?>
                                    <li>
                                        <a href="tel:<?php esc_attr($agenshark_phone_num) ?>"><span><i class="fa-solid fa-phone"></i></span>
                                            <?php echo esc_html($agenshark_phone_num); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($agenshark_mail_id)) : ?>
                                    <li>
                                        <a href="mailto:<?php echo esc_attr($agenshark_mail_id); ?>">
                                            <span><i class="fa-solid fa-envelope"></i></span>
                                            <?php echo esc_html($agenshark_mail_id); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($agenshark_address)) : ?>
                                    <li>
                                        <a href="<?php echo esc_url($agenshark_address_url); ?>">
                                            <?php echo esc_html($agenshark_address); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-4">
                        <div class="tp-header-top-right d-flex justify-content-end align-items-center">
                            <div class="header-social d-xxl-block d-none">
                                <?php agenshark_header_social_profiles(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div id="header-sticky" class="tp-header-bottom header__sticky p-relative">
        <div class="container">
            <div class="tp-header-5-nav-area p-relative">
                <div class="row align-items-center">
                    <div class="col-xxl-3 col-xl-3 col-lg-6">
                        <div class="tp-header-main-left p-relative">
                            <div class="tp-header-logo">
                                <?php agenshark_header_logo(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="<?php echo esc_attr($agenshark_menu_col); ?>">
                        <div class="tp-main-menu-area d-flex align-items-center justify-content-center">
                            <div class="tp-main-menu">
                                <nav class="tp-main-menu-content">
                                    <?php agenshark_header_menu(); ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($agenshark_header_right)) : ?>
                        <div class="col-xxl-3 col-xl-3 col-lg-6">
                            <div class="tp-header-main-right d-flex align-items-center justify-content-xl-end">
                                <div class="tp-header-contact d-none d-xl-block">
                                    <div class="tp-header-contact-inner d-flex align-items-center">
                                        <div class="tp-header-contact-icon">
                                            <span><i class="fa-solid fa-phone"></i></span>
                                        </div>
                                        <div class="tp-header-contact-content">
                                            <p><?php echo esc_html($agenshark_hotline_text); ?></p>
                                            <span><a href="tel:<?php echo esc_url($agenshark_hotline_number); ?>"><?php echo esc_html($agenshark_hotline_number); ?></a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-lg-1 col-md-6 col-6 d-flex justify-content-end align-items-center">
                        <div class="tp-header-hamburger-btn d-xl-none offcanvas-open-btn">
                            <button class="hamburger-btn">
                                <span>
                                    <svg width="29" height="24" viewBox="0 0 29 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 1.13163C0 0.506972 0.499692 0 1.11538 0H20.4487C21.0644 0 21.5641 0.506972 21.5641 1.13163C21.5641 1.7563 21.0644 2.26327 20.4487 2.26327H1.11538C0.499692 2.26327 0 1.7563 0 1.13163ZM27.8846 10.5619H1.11538C0.499692 10.5619 0 11.0689 0 11.6935C0 12.3182 0.499692 12.8252 1.11538 12.8252H27.8846C28.5003 12.8252 29 12.3182 29 11.6935C29 11.0689 28.5003 10.5619 27.8846 10.5619ZM14.5 21.1238H1.11538C0.499692 21.1238 0 21.6308 0 22.2555C0 22.8801 0.499692 23.3871 1.11538 23.3871H14.5C15.1157 23.3871 15.6154 22.8801 15.6154 22.2555C15.6154 21.6308 15.1157 21.1238 14.5 21.1238Z" fill="currentColor" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</header>
<!-- header area end -->

<?php get_template_part('template-parts/header/header-side-info'); ?>