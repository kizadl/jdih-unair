<?php

/**
 * Template part for displaying header side information
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agenshark
 */

$agenshark_side_hide = get_theme_mod('agenshark_side_hide', false);
$agenshark_side_logo = get_theme_mod('agenshark_side_logo', get_template_directory_uri() . '/assets/img/logo/logo-black.png');
$agenshark_extra_map_url = get_theme_mod('agenshark_extra_map_url', __('https://www.google.com/maps/search/86+Road+Broklyn+Street,+600+New+York,+USA/@40.6897806,-74.0278086,12z/data=!3m1!4b1', 'agenshark'));
$agenshark_contact_title = get_theme_mod('agenshark_contact_title', __('Contact', 'agenshark'));
$agenshark_extra_address = get_theme_mod('agenshark_extra_address', __('86 Road Broklyn Street, 600', 'agenshark'));
$agenshark_extra_phone = get_theme_mod('agenshark_extra_phone', __('+92 666 888 0000', 'agenshark'));
$agenshark_extra_email = get_theme_mod('agenshark_extra_email', __('Needhelp@company.com', 'agenshark'));
?>

<!-- offcanvas area start -->
<div class="offcanvas__area">
   <div class="offcanvas__wrapper">
      <div class="offcanvas__close">
         <button class="offcanvas__close-btn offcanvas-close-btn">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
               <path d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
         </button>
      </div>
      <div class="offcanvas__content">
         <div class="offcanvas__top mb-50 d-flex justify-content-between align-items-center">
            <?php if (!empty($agenshark_side_logo)) : ?>
               <div class="offcanvas__logo logo">
                  <a href="<?php print esc_url(home_url('/')); ?>">
                     <img src="<?php print esc_url($agenshark_side_logo); ?>" alt="<?php echo esc_attr__('logo', 'agenshark'); ?>">
                  </a>
               </div>
            <?php endif; ?>
         </div>
         <div class="tp-main-menu-mobile fix d-xl-none mb-40"></div>
         <?php if (!empty($agenshark_side_hide)) : ?>
            <div class="offcanvas__contact">
               <?php if (!empty($agenshark_contact_title)) : ?>
                  <h4 class="offcanvas__title"><?php echo esc_html($agenshark_contact_title) ?></h4>
               <?php endif; ?>
               <?php if (!empty($agenshark_extra_address)) : ?>
                  <div class="offcanvas__contact-content d-flex">
                     <div class="offcanvas__contact-content-icon">
                        <i class="fa-sharp fa-solid fa-location-dot"></i>
                     </div>
                     <div class="offcanvas__contact-content-content">
                        <a href="<?php echo esc_url($agenshark_extra_map_url); ?>">
                           <?php echo agenshark_kses($agenshark_extra_address); ?> </a>
                     </div>
                  </div>
               <?php endif; ?>
               <?php if (!empty($agenshark_extra_email)) : ?>
                  <div class="offcanvas__contact-content d-flex">
                     <div class="offcanvas__contact-content-icon">
                        <i class="fa-solid fa-envelope"></i>
                     </div>
                     <div class="offcanvas__contact-content-content">
                        <a href="mailto:<?php echo esc_url(agenshark_kses($agenshark_extra_email)); ?>"> <?php echo agenshark_kses($agenshark_extra_email); ?></a>
                     </div>
                  </div>
               <?php endif; ?>
               <?php if (!empty($agenshark_extra_phone)) : ?>
                  <div class="offcanvas__contact-content d-flex">
                     <div class="offcanvas__contact-content-icon">
                        <i class="fa-solid fa-phone"></i>
                     </div>
                     <div class="offcanvas__contact-content-content">
                        <a href="tel:<?php echo esc_url(agenshark_kses($agenshark_extra_phone)); ?>"><?php echo agenshark_kses($agenshark_extra_phone); ?></a>
                     </div>
                  </div>
               <?php endif; ?>
            </div>
            <div class="offcanvas__social">
               <?php agenshark_header_social_profiles(); ?>
            </div>
         <?php endif; ?>
      </div>
   </div>
</div>
<div class="body-overlay"></div>
<!-- offcanvas area end -->