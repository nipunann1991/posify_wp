<?php
$root =dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header("Content-type: text/css; charset=utf-8");
global $archi_option; 
?>

/* 01 MAIN STYLES
****************************************************************************************************/

/* default color: #FAB702 */
#subheader{
  background-image:url(<?php echo esc_url($archi_option['bg_allpage']['url']); ?>);
}
header.header-bg{
  background-color:<?php echo esc_attr( $archi_option['header-background-color'] ); ?>;
}
header.header-bg.smaller{
  background-color:<?php echo esc_attr( $archi_option['header-small-background-color'] ); ?>;
}
#mainmenu li li a{}
#mainmenu a,#mainmenu li li a{
  color: <?php echo esc_attr( $archi_option['header-text-color'] ); ?>;
}
#mainmenu li a:after {color: <?php echo esc_attr( $archi_option['main-color'] ); ?>;}
#mainmenu li.current-menu-item a, nav ul#mainmenu > li.current-menu-ancestor > a {color: <?php echo esc_attr( $archi_option['main-color'] ); ?>;}

.bg-color, .de_light .bg-fixed.bg-color,
section.call-to-action,
#mainmenu li li a:hover,
.price-row,
.blog-list .date,
.blog-read .date,
.slider-info .text1,
#filters a.selected,
.btn-primary,
.bg-id-color,
.pagination .current,
.pagination .current,
.pagination .current:hover,
.pagination .current:hover,
.pagination .current:focus,
.pagination .current span:focus,
.dropcap,
.fullwidthbanner-container a.btn,
.feature-box-big-icon i,
#testimonial-full,
.icon-deco i,
.blog-list .date-box .day,
.bloglist .date-box .day,
.feature-box-small-icon .border,
.small-border,
#jpreBar,
.date-post,
.team-list .small-border,
.de-team-list .small-border,
.btn-line:hover,a.btn-line:hover,
.btn-line.hover,a.btn-line.hover,
.owl-arrow span,
.de-progress .progress-bar,
#btn-close-x:hover,
.box-fx .info,
.vc_tta-container .vc_tta-tabs-container li span,
.de_testi blockquote:before,
.menu-sidebar-menu-container ul li.current_page_item a,
.widget_nav_menu ul li:hover,
.btn-more,
.widget .small-border,
.product img:hover,
#btn-search,
.form-submit #submit,
#wp-calendar tbody td#today,
.de_tab.tab_steps .de_nav li span,
#services-list li a:hover,
.de_light #services-list li.active,
#services-list li.active, .button.btn.btn-line:hover,.woocommerce #respond input#submit, .woocommerce a.button, 
.woocommerce button.button, .woocommerce input.button, .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, 
.woocommerce button.button.alt, .woocommerce input.button.alt
{
 background-color:<?php echo esc_attr( $archi_option['main-color'] ); ?>;
}
.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce #respond input#submit.alt:hover, 
.woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover {
  background-color: #DAD8DA;
  color: #5D6F93;
}
.post-image .owl-theme .owl-controls .owl-page.active span,
ul li.menu-item-has-children ul li.active a{
   background-color:<?php echo esc_attr( $archi_option['main-color'] ); ?>!important;
}

.feature-box i,
#mainmenu li:hover > ul,
.slider_text h1,
.id-color,
.pricing-box li h1,
.title span,
i.large:hover,
.feature-box-small-icon-2 i,
address div i,
.pricing-dark .pricing-box li.price-row,
.price,#mainmenu .current_page_parent.menu-item-has-children > a,
#mainmenu a:hover,
#mainmenu a.active,
.pricing-dark .pricing-box li.price-row,
.dark .feature-box-small-icon i,
a.btn-slider:after,
.feature-box-small-icon i,
a.btn-line:after,
.team-list .social a,
.de_contact_info i,
.de_count,
.dark .btn-line:hover:after, .dark a.btn-line:hover:after, .dark a.btn-line.hover:after,
a.btn-text:after,
.separator span  i,
address div strong,
address span strong,
.vc_tta-container .vc_tta-tabs-container li span:hover,
.de_testi_by,
.pf_text,
.widget_tags li a,
.dark .btn-line:after, .dark  a.btn-line:after,
.crumb a,
.post-info a,
.comments_number,
.date .c_reply a,
.search-form:before,
.widget_tag_cloud li a,
h3 b,nav ul#mainmenu > li.current-menu-ancestor > a, .woocommerce .star-rating span,
.woocommerce .star-rating:before, .woocommerce div.product p.price, .woocommerce div.product span.price,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .de_light.woocommerce p.stars a
{
  color:<?php echo esc_attr( $archi_option['main-color'] ); ?>;
}

.feature-box i,
#filters a:hover,
#filters a.selected,
.pagination .current,
.pagination .current,
.pagination .current:hover,
.pagination .current:hover,
.pagination .current:focus,
.pagination .current:focus
.feature-box-big-icon i:after,
.social-icons i,
.btn-line:hover,a.btn-line:hover,
.btn-line.hover,a.btn-line:hover,
.product img:hover,
.wpcf7 input[type=text]:focus,.wpcf7 input[type=email]:focus,.wpcf7 input[type=tel]:focus,.wpcf7 textarea:focus, #search:focus,
.de_light .wpcf7  input[type=text]:focus,.de_light .wpcf7  input[type=tel]:focus,.de_light .wpcf7 textarea:focus,
.de_light .wpcf7 #search:focus, .comment-form input[type='text']:focus,.comment-form input[type='email']:focus,.comment-form textarea:focus
{
  border-color:<?php echo esc_attr( $archi_option['main-color'] ); ?>;
  outline: 0px;
}


.comment-form textarea:focus{
  border:1px solid <?php echo esc_attr( $archi_option['main-color'] ); ?>!important;
}

.box-fx .inner,
.dark .box-fx .inner,
.post-image,
.arrow-up
{
  border-bottom-color:<?php echo esc_attr( $archi_option['main-color'] ); ?>;
}

.arrow-down{
  border-top-color:<?php echo esc_attr( $archi_option['main-color'] ); ?>;
}

.callbacks_nav {
  background-color:<?php echo esc_attr( $archi_option['main-color'] ); ?>;
}

.de_tab .de_nav li span {
border-top: 3px solid <?php echo esc_attr( $archi_option['main-color'] ); ?>;
}

.feature-box-big-icon i:after {
border-color: <?php echo esc_attr( $archi_option['main-color'] ); ?> transparent; /*same colour as the lower of the bubble's gradient*/
}

.de_review li.active img{
  border:solid 4px <?php echo esc_attr( $archi_option['main-color'] ); ?>;
}
.post-text blockquote {
    border-left: 5px solid <?php echo esc_attr( $archi_option['main-color'] ); ?>;
}

/**** Custom CSS Footer ****/
footer {
    background: <?php echo esc_attr( $archi_option['footer_bgcolor'] ); ?>;
    color: <?php echo esc_attr( $archi_option['footer_textcolor'] ); ?>;
}
.subfooter {
    background: <?php echo esc_attr( $archi_option['footer_bottom_bgcolor'] ); ?>;
}