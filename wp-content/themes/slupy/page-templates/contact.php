<?php

/*
 * Template Name: Contact
 * Description: A Page Template for Contact Page.
*/

get_header();
get_template_part( 'includes/slupy', 'pageheader' );
?>

<div id="site-content">
  <div class="container">
    <div class="row">

    <?php
      while ( have_posts() ){
        the_post();
    ?>

    <div class="col-sm-5 col-lg-5">
      <?php the_content(); ?>
    </div>
      
    <?php } ?>

    <div class="col-sm-7 col-lg-7">
      <h4><?php _e( 'Leave a Message', SLUPY_TRANSLATE ); ?></h4>
      <div class="slupy-contact-form">
        <form method="post" action="<?php echo esc_url( get_permalink() ); ?>" class="slupy-contact-form">
          <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4">
              <label for="slupy-cn"><?php _e( 'Name *', SLUPY_TRANSLATE ); ?></label>
              <input type="text" name="name" class="slupy-contact-field">
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
              <label for="slupy-email"><?php _e( 'E-Mail *', SLUPY_TRANSLATE ); ?></label>
              <input type="email" name="mail" class="slupy-contact-field">
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
              <label for="slupy-sj"><?php _e( 'Subject *', SLUPY_TRANSLATE ); ?></label>
              <input type="text" name="subject" class="slupy-contact-field">
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <label for="slupy-ms"><?php _e( 'Message *', SLUPY_TRANSLATE ); ?></label>
              <textarea name="message" rows="6" class="slupy-contact-field"></textarea>
              <button class="slupy-button contact-form-submit" type="button"><span><?php _e( 'Send Message', SLUPY_TRANSLATE ); ?></span></button>
              <span class="contact-form-response"></span>
            </div>
          </div>
        </form>
      </div>
    </div><!-- contact-form -->

    </div>
  </div>
</div><!-- #site-content -->

<?php
get_footer();