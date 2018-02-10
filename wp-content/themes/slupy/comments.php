<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
  return;
}
?>

<div id="comments" class="comments-area">

  <?php if ( have_comments() ) : ?>
  
  <header class="comment-header">

  <h2 class="comments-title">
    <?php
      printf( _n( 'One comment', '%1$s comments', get_comments_number(), SLUPY_TRANSLATE ),
        number_format_i18n( get_comments_number() ), get_the_title() );
    ?>
  </h2>

  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
  <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
    <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', SLUPY_TRANSLATE ) ); ?></div>
    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', SLUPY_TRANSLATE ) ); ?></div>
    <div class="nav-comment"><a href="#respond"><?php _e('Leave a Comment &darr;',SLUPY_TRANSLATE); ?></a></div>
  </nav><!-- #comment-nav-above -->
  <?php endif; // Check for comment navigation. ?>
  <div class="clearfix"></div>

  </header>


  <ol class="comment-list">
    <?php
      wp_list_comments( array(
        'style'      => 'ol',
        'short_ping' => true,
        'avatar_size'=> 120,
        'callback'   => 'get_slupy_list_comments'
      ) );
    ?>
  </ol><!-- .comment-list -->

  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
  <footer class="comment-footer">
  <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
    <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', SLUPY_TRANSLATE ) ); ?></div>
    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', SLUPY_TRANSLATE ) ); ?></div>
  </nav><!-- #comment-nav-below -->
  <div class="clearfix"></div>
  </footer>
  <?php endif; // Check for comment navigation. ?>

  <?php if ( ! comments_open() ) : ?>
  <p class="no-comments"><?php _e( 'Comments are closed.', SLUPY_TRANSLATE ); ?></p>
  <?php endif; ?>

  <?php endif; // have_comments() ?>

  <?php
    $args = array(
      'cancel_reply_link' => __('&larr; Cancel Reply',SLUPY_TRANSLATE),
      'comment_notes_before'  => '',
      'comment_notes_after' => '<p class="comment-notes">' . __( 'Your email address will not be published.',SLUPY_TRANSLATE ) . ' Required fields are marked *' . '</p>'
    );
    comment_form($args);
  ?>

</div><!-- #comments -->
