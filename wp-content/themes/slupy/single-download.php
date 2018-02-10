<?php
/**
 * The Template for displaying all single download items
 *
 * @since Slupy 1.0
 */

get_header();
get_template_part( 'includes/slupy', 'pageheader' );
$ts_single_meta = get_post_meta( get_the_ID(), '_ts_slupy_meta', true );
$ts_content_free_style = apply_filters( 'slupy_edd_single_free_style', !empty( $ts_single_meta['free_style'] ) ? true : false );
?>

<div id="site-content" class="edd-download-single-wrap">

  <div class="edd-download-single-white">
    <div class="container">
      <div class="row">
        
        <?php
          // Start the Loop.
          while ( have_posts() ) { the_post();
            //check free style
            if( !$ts_content_free_style ) {
        ?>

        <div class="col-sm-5 col-lg-5 edd-downloads-media">

          <?php do_action('slupy_edd_download_header'); ?>

          <div class="ts-gap-30 hidden-lg hidden-md"></div>

        </div><!-- .edd-downloads-media -->

        <div class="col-sm-7 col-lg-7 edd-downloads-content">

          <h2 class="edd-download-single-title"><?php the_title(); ?></h2>

          <?php if ( ! edd_has_variable_prices( get_the_ID() ) ){ ?>

          <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
            <div itemprop="price" class="edd-single-price">
              <?php edd_price( get_the_ID() ); ?>
            </div>
          </div>

          <?php } ?>

          <?php
            echo do_shortcode(remove_shortcode_in_edd_content(get_the_content()));
          ?>

          <div class="edd_download_buy_button edd-signle-download-buy">
            <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID(), 'price' => '0' ) ); ?>
          </div>

          <?php
            echo get_the_term_list( get_the_ID(), 'download_category', __('Categories:','edd').' ', ', ' );
          ?>

        </div><!-- .downloads-content -->

        <?php } else{ ?>

        <div class="col-sm-12 col-lg-12 edd-downloads-content">
          <?php
            echo do_shortcode(remove_shortcode_in_edd_content(get_the_content()));
          ?>
        </div>

        <?php } } ?>

        <div class="col-sm-12">
          <div class="portfolio-prev-next nav-prev-next">
            <div class="row">
              <div class="col-sm-6 col-lg-6 space-bottom-10">
                <?php previous_post_link('%link','<span class="title-link nav-prev-post">%title</span>'); ?>
              </div>
              <div class="col-sm-6 col-lg-6 text-right mobile-text-left">
                <?php next_post_link('%link','<span class="title-link nav-next-post">%title</span>'); ?>
              </div>
            </div>
          </div>
        </div><!-- .downloads-prev-next -->

      </div>
    </div>
  </div><!-- .downloads-container -->

  <?php if( ts_get_option('edd_latest_downloads') || comments_open() || get_comments_number() ) { ?>
  <div class="container edd-download-single-details">
    <div class="row">
      <div class="col-sm-12">

        <?php

          //check latest downloads
          if( ts_get_option('edd_latest_downloads') && function_exists('edd_downloads_query') ) {
            echo '<h3 class="portfolio-latest-heading">'.__('Latest Added Downloads',SLUPY_TRANSLATE).'</h3>';
            
            $slupy_edd_archive_config = array(
              'excerpt'  => 'no',
              'price'    => 'yes',
              'number'   => '4',
              'columns'  => '4'
            );
            echo edd_downloads_query($slupy_edd_archive_config);
          }

          // If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) {
            comments_template();
          }

        ?>

      </div>
    </div>
  </div><!-- latest downloads and comments -->
  <?php } ?>

</div><!-- #site-content -->

<?php
get_footer();