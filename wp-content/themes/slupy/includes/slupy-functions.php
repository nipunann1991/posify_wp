<?php
/**
 * Slupy Theme Fuctions
 *
 * @since     1.0.0
 */

/*---------------------------------------------
  Theme Support
---------------------------------------------*/
if( !function_exists('slupy_theme_support') ) {

function slupy_theme_support() {

  load_theme_textdomain( SLUPY_TRANSLATE, SLUPY_PATH.'/languages' );

  add_editor_style( 'ts-framework/css/editor-style.css' );

  register_nav_menus( array(
    'main'    => __('Main Menu', SLUPY_TRANSLATE ),
    'mobile'  => __('Mobile Menu', SLUPY_TRANSLATE ),
    'topbar'  => __('Top-Bar Menu', SLUPY_TRANSLATE ),
    'landing' => __('Single Page Menu', SLUPY_TRANSLATE )
  ) );

  //Image Sizes
  $all_sizes = ts_get_option('slupy_imagesizes');
  if( is_array($all_sizes) ){
    foreach ( $all_sizes as $key_size => $a_size ) {
      add_image_size( sanitize_title( $a_size['title'] ), intval( $a_size['width'] ), intval( $a_size['height'] ), $a_size['crop'] === 'on' ? true : false );
    }
  }

  add_image_size( 'slupy-post-thumbnail', 900, 390, true );

  //background
  $slupy_default_bg = array(
    'default-color'          => 'f8f8f8',
    'default-image'          => '',
    'wp-head-callback'       => '_custom_background_cb',
    'admin-head-callback'    => '',
    'admin-preview-callback' => ''
  );

  $slupy_header_defaults = array(
    'default-image'          => '',
    'random-default'         => false,
    'width'                  => 0,
    'height'                 => 0,
    'flex-height'            => false,
    'flex-width'             => false,
    'default-text-color'     => '',
    'header-text'            => false,
    'uploads'                => false,
    'wp-head-callback'       => '',
    'admin-head-callback'    => 'save_slupy_header_type',
    'admin-preview-callback' => '',
  );

  add_theme_support( 'menus' );
  add_theme_support( 'title-tag' );
  add_theme_support( 'woocommerce' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'custom-header', $slupy_header_defaults );
  add_theme_support( 'custom-background', $slupy_default_bg );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
  add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat') );

}

}

/*---------------------------------------------
  WP Title Filter
---------------------------------------------*/
if ( !function_exists( 'slupy_wp_title' ) ) {

function slupy_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() ) {
    return $title;
  }

  // Add the site name.
  $title .= get_bloginfo( 'name', 'display' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title = "$title $sep $site_description";
  }

  // Add a page number if necessary.
  if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
    $title = "$title $sep " . sprintf( __( 'Page %s', SLUPY_TRANSLATE ), max( $paged, $page ) );
  }

  return $title;
}

}

/*---------------------------------------------
  Get Slupy Header
---------------------------------------------*/
if ( !function_exists( 'get_slupy_header' ) ) {

function get_slupy_header( $menu = 'main' ) {
  $get_slupy_header = new Slupy_Theme;
  return $get_slupy_header->get_slupy_header( $menu );
}

}

/*---------------------------------------------
  Get Slupy Menu Additional
---------------------------------------------*/
if ( !function_exists( 'get_slupy_menu_additional' ) ) {

function get_slupy_menu_additional( $pos = 'pull-right' ) {
  $get_slupy_menu_additional = new Slupy_Theme;
  return $get_slupy_menu_additional->menu_additional( $pos );
}

}

/*---------------------------------------------
  Get Slupy Mobile Nav
---------------------------------------------*/
if ( !function_exists( 'get_slupy_mobile_nav' ) ) {

function get_slupy_mobile_nav( $loc = 'mobile' , $btn = false ) {
  $get_slupy_mobile_nav = new Slupy_Theme;
  return $get_slupy_mobile_nav->get_mobile_nav( $loc, $btn );
}

}

/*---------------------------------------------
  Post Header - Replace first shortcode
---------------------------------------------*/
if ( !function_exists( 'organize_slupy_post_formats' ) ) {

function organize_slupy_post_formats( $content ) {

  $post_format = get_post_format();

  if ( $post_format == 'gallery' ) {
    $content = str_replace( get_first_slupy_shortcode( 'gallery', $content ), '', $content );
  }else if ( $post_format == 'audio' ) {
    $content = str_replace( get_first_slupy_shortcode( 'audio|playlist', $content ), '', $content );
  }else if ( $post_format == 'video' ) {
    $content = str_replace( get_first_slupy_shortcode( 'video|video-playlist', $content ), '', $content );
  }

  if( $content == "\n" ){
    return '';
  }

  return $content;

}

}

/*---------------------------------------------
  Highlight Search Results
---------------------------------------------*/
if ( !function_exists( 'highlight_slupy_search_results' ) ) {

function highlight_slupy_search_results( $content ) {

  if ( is_search() ) {
    $sr = get_query_var( 's' );
    $keys = explode( ' ', $sr );
    $content = preg_replace( '/('.implode( '|', $keys ) .')/iu', '<span class="highlight-text">\0</span>', $content );
  }

  return $content;
}

}

/*---------------------------------------------
  Paging Navigation Types
---------------------------------------------*/
if ( !function_exists( 'slupy_paging_nav' ) ) {

function slupy_paging_nav( $max_page = 1, $p_type ='', $content_css_selector = '.slupy-articles' ) {

  if ( $max_page == 1 ) {
    $max_page = $GLOBALS['wp_query']->max_num_pages;
  }

  // Don't print empty markup if there's only one page.
  if ( $max_page < 2 ) {
    return;
  }

  $links = '';

  if ( get_query_var( 'page' ) ) {
    $paged = intval( get_query_var( 'page' ) );
  }else if ( get_query_var( 'paged' ) ) {
    $paged = intval( get_query_var( 'paged' ) );
  }else {
    $paged = 1;
  }

  $p_type = $p_type ? $p_type : ts_get_option( 'blog_pagination' );

  switch ( $p_type ) {

    case 'oldernewer':
      $older_posts = __( 'Older Posts', SLUPY_TRANSLATE );
      $newer_posts = __( 'Newer Posts', SLUPY_TRANSLATE );

      $next_posts_link = get_next_posts_link( $older_posts, $max_page );
      $prev_posts_link = get_previous_posts_link( $newer_posts );

      $next_link = '<div class="older-posts">'.( $next_posts_link ? $next_posts_link : '<span>'.$older_posts.'</span>' ).'</div>';
      $prev_link = '<div class="newer-posts">'.( $prev_posts_link ? $prev_posts_link : '<span>'.$newer_posts.'</span>' ).'</div>';
      
      $links = '<div class="posts-links">'.$next_link.'<div class="current-page">'.$paged.'</div>'.$prev_link.'</div>';
    break;

    case 'loadmore':
      //
      if ( $content_css_selector == '.slupy-articles' ) {
        wp_enqueue_script( 'mediaelement' );
        wp_enqueue_script( 'OwlCarousel' );
        wp_enqueue_script( 'fitvids' );

        wp_enqueue_style( 'mediaelement' );
        wp_enqueue_style( 'OwlCarousel' );
      }

      // Add some parameters for the JS.
      wp_localize_script(
        'jquery-slupy',
        'lm_config',
        array(
          'next'        => $paged + 1,
          'max'         => $max_page,
          'link'        => get_pagenum_link( 9999999999 ),
          'text'        => __( 'Load More', SLUPY_TRANSLATE ),
          'loading'     => __( 'Loading', SLUPY_TRANSLATE ),
          'nomore'      => __( 'No More', SLUPY_TRANSLATE ),
          'content'     => $content_css_selector,
          'btn'         => '.blog-load-more',
          'removelast'  => 'yes'
        )
      );

      $links = '<a href="#" class="slupy-loadmore-link blog-load-more"></a>';
    break;

    case 'pagenumbers':
      $pagenum_link = html_entity_decode( get_pagenum_link() );
      $query_args   = array();
      $url_parts    = explode( '?', $pagenum_link );

      if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
      }

      $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
      $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

      $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
      $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

      $links = '<div class="pagination loop-pagination">';
      // Set up paginated links.
      $links .= paginate_links( array(
          'base'     => $pagenum_link,
          'format'   => $format,
          'total'    => $max_page,
          'current'  => $paged,
          'mid_size' => 1,
          'add_args' => array_map( 'urlencode', $query_args ),
          'prev_text' => _x( '<span class="fa fa-angle-left"></span>', 'pagination left arrow', SLUPY_TRANSLATE ),
          'next_text' => _x( '<span class="fa fa-angle-right"></span>', 'pagination right arrow', SLUPY_TRANSLATE ),
        ) );

      $links .= '</div><!-- .pagination -->';
    break;

    case 'wp_link_pages':
      wp_link_pages(array(
        'before'      => '<div class="page-links-wrap"><span class="page-links-title">' . __( 'Pages:', SLUPY_TRANSLATE ) . '</span><span class="page-links">',
        'after'       => '</span></div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
      ));
    break;
  }

  if ( $links ) {
    echo '<nav class="navigation '.esc_attr($p_type).'" role="navigation">'.$links.'</nav><!-- .navigation -->';
  }
}

}

/*---------------------------------------------
  Get Post's First Shortcode
---------------------------------------------*/
if ( !function_exists( 'get_first_slupy_shortcode' ) ) {

function get_first_slupy_shortcode( $shortcode_tag, $content = '' ) {
  preg_match( '/'. get_slupy_shortcode_regex( $shortcode_tag ) .'/s', $content, $a_shortcode );
  return is_array( $a_shortcode ) ? reset( $a_shortcode ):'';
}

}

/*---------------------------------------------
  get_shortcode_regex for Slupy
---------------------------------------------*/
if ( !function_exists( 'get_slupy_shortcode_regex' ) ) {

function get_slupy_shortcode_regex( $tag ) {
  return
  '\\['                                 // Opening bracket
  . '(\\[?)'                            // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
  . "(slupy_post_header|$tag)"          // 2: Shortcode name
  . '(?![\\w-])'                        // Not followed by word character or hyphen
  . '('                                 // 3: Unroll the loop: Inside the opening shortcode tag
  .     '[^\\]\\/]*'                    // Not a closing bracket or forward slash
  .     '(?:'
  .         '\\/(?!\\])'                // A forward slash not followed by a closing bracket
  .         '[^\\]\\/]*'                // Not a closing bracket or forward slash
  .     ')*?'
  . ')'
  . '(?:'
  .     '(\\/)'                         // 4: Self closing tag ...
  .     '\\]'                           // ... and closing bracket
  . '|'
  .     '\\]'                           // Closing bracket
  .     '(?:'
  .         '('                         // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
  .             '[^\\[]*+'              // Not an opening bracket
  .             '(?:'
  .                 '\\[(?!\\/\\2\\])'  // An opening bracket not followed by the closing shortcode tag
  .                 '[^\\[]*+'          // Not an opening bracket
  .             ')*+'
  .         ')'
  .         '\\[\\/\\2\\]'              // Closing shortcode tag
  .     ')?'
  . ')'
  . '(\\]?)';                           // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
}

}

/*---------------------------------------------
  Post's Meta Section & Config
---------------------------------------------*/
if ( !function_exists( 'get_slupy_entry_meta' ) ) {

function get_slupy_entry_meta( $type = 'blog' ) {

  $all_meta = ts_get_option( $type.'_meta_items' );

  echo '<div class="entry-meta">';

  // Set up and print post meta information.
  //Author
  if ( isset( $all_meta['author'] ) && $all_meta['author'] == 'on' ) {
    printf( '<span class="entry-author"><a href="%2$s">%1$s</a></span>',
      esc_html( get_the_author() ),
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
    );
  }

  //Date
  if ( isset( $all_meta['date'] ) && $all_meta['date'] == 'on' ) {
    printf( '<span class="entry-date"><a href="%3$s"><time datetime="%2$s">%1$s</time></a></span>',
      esc_html( get_the_date() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_url( get_permalink() )
    );
  }

  //Comments
  if ( isset( $all_meta['comments'] ) && $all_meta['comments'] == 'on' && !post_password_required() && ( comments_open() || get_comments_number() ) ) {
    echo '<span class="comments-link">';
    comments_popup_link( __( 'Leave a comment', SLUPY_TRANSLATE ), __( '1 Comment', SLUPY_TRANSLATE ), __( '% Comments', SLUPY_TRANSLATE ) );
    echo '</span>';
  }

  //Categories
  if ( isset( $all_meta['categories'] ) && $all_meta['categories'] == 'on' && !is_attachment() ) {
    echo '<span class="entry-categories">';
    $categories = get_the_category();
    $separator = ', ';
    $output = '';
    if ( $categories ) {
      foreach ( $categories as $category ) {
        $output .= '<a href="'.esc_url( get_category_link( $category->term_id ) ).'" title="' . sprintf( esc_attr__( "View all posts in %s", SLUPY_TRANSLATE ), $category->name ) . '">'.esc_html( $category->cat_name ).'</a>'.$separator;
      }
      echo trim( $output, $separator );
    }
    echo '</span>';
  }

  //Tags
  if ( isset( $all_meta['tags'] ) && $type != 'blog' && $all_meta['tags'] == 'on' ) {
    the_tags( '<span class="entry-tags">', ', ', '</span>' );
  }

  echo '</div>';

}

}

/*---------------------------------------------
  Get first url on post content for Link Format
---------------------------------------------*/
if ( !function_exists( 'get_slupy_link_url' ) ) {

function get_slupy_link_url() {
  $content = get_the_content();
  $has_url = get_url_in_content( $content );

  return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

}

/*---------------------------------------------
  Get first gallery shortcode in content
---------------------------------------------*/
if ( !function_exists( 'get_gallery_in_slupy_content' ) ) {

function get_gallery_in_slupy_content() {

  $val = '';

  $gallery = get_first_slupy_shortcode( 'gallery', get_the_content() );

  if ( $gallery ) {
    $val = do_shortcode( $gallery );
  }

  return $val;

}

}

/*---------------------------------------------
  Get first audio shortcode in content
---------------------------------------------*/
if ( !function_exists( 'get_audio_in_slupy_content' ) ) {

function get_audio_in_slupy_content() {

  $val = '';

  wp_enqueue_script( 'fitvids' );

  $audio = get_first_slupy_shortcode( 'audio|playlist', get_the_content() );

  if ( $audio ) {
    $wp_embed = new WP_Embed;
    $audio = $wp_embed->autoembed( $audio );
    $val = do_shortcode( $audio );
  }

  return $val;
}

}

/*---------------------------------------------
  Get first video shortcode in content
---------------------------------------------*/
if ( !function_exists( 'get_video_in_slupy_content' ) ) {

function get_video_in_slupy_content() {

  $val = '';

  wp_enqueue_script( 'fitvids' );

  $video = get_first_slupy_shortcode( 'video|video-playlist', get_the_content() );

  if ( $video ) {
    $wp_embed = new WP_Embed;
    $video = $wp_embed->autoembed( $video );
    $val = do_shortcode( $video );
  }

  return $val;
}

}

/*---------------------------------------------
  Related Posts
---------------------------------------------*/
if ( !function_exists( 'get_slupy_related_posts' ) ) {

function get_slupy_related_posts( $post_id, $limit = 5 ) {

  $type = ts_get_option('single_related_posts');

  if ( $type == 'tags' ) {
    $tags = wp_get_post_tags( $post_id );

    if ( $tags ) {
      foreach ( $tags as $key => $a_tag ) {
        $all_tags[$key] = $a_tag->term_id;
      }

      $args = array(
        'tag__in'         => $all_tags,
        'post__not_in'    => array( $post_id ),
        'posts_per_page'  => intval( $limit )
      );
    }

  }else if (  $type == 'categories' ) {
    $all_categories = wp_get_post_categories( $post_id );

    $args = array(
      'category__in'    => $all_categories,
      'post__not_in'    => array( $post_id ),
      'posts_per_page'  => intval( $limit )
    );
  }

  if ( isset( $args ) ) {

    $the_query = new WP_Query( $args );

    // The Loop
    if ( $the_query->have_posts() ) {
      echo '<div class="related-posts">
        <h2 class="related-post-title">'.esc_html__( 'Related Posts', SLUPY_TRANSLATE ).'</h2>
          <ul class="related-post-list">';

      while ( $the_query->have_posts() ) {
        $the_query->the_post();
        echo '<li>
                <a href="'.esc_url( get_permalink() ).'">' . esc_html( get_the_title() ) . '</a>
                <time datetime="'.esc_attr( get_the_date( 'c' ) ).'">('.esc_html( get_the_date() ).')</time>
              </li>';
      }

      echo '</ul></div>';
    }
    /* Restore original Post Data */
    wp_reset_postdata();

  }
}

}

/*---------------------------------------------
  Gallery for Slideshow
---------------------------------------------*/
if ( !function_exists( 'get_slupy_gallery_slider' ) ) {

function get_slupy_gallery_slider( $tag, $attr ) {
  $output = '';
  if ( isset( $attr['slider_gallery'] ) && $attr['slider_gallery'] == 'true' ) {

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
      $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
      if ( !$attr['orderby'] )
        unset( $attr['orderby'] );
    }

    $post = get_post();
    $html5 = current_theme_supports( 'html5', 'gallery' );

    extract( shortcode_atts( array(
          'order'         => 'ASC',
          'orderby'       => 'menu_order ID',
          'id'            => $post ? $post->ID : 0,
          'include'       => '',
          'size'          => 'slupy-post-thumbnail',
          'exclude'       => '',
          'autoplay'      => 'on',
          'stop_hover'    => 'on',
          'navigation'    => 'on',
          'pagination'    => 'on',
          'fade_effect'   => 'on',
          'touch_drag'    => 'on',
          'duration_time' => '7',
          'auto_height'   => 'off',
          'link'          => ''
        ), $attr, 'gallery' ) );

    $id = intval( $id );

    if ( 'RAND' == $order )
      $orderby = 'none';

    if ( !empty( $include ) ) {

      $_attachments = get_posts( array( 
        'include'         => $include, 
        'post_status'     => 'inherit', 
        'post_type'       => 'attachment', 
        'post_mime_type'  => 'image', 
        'order'           => $order, 
        'orderby'         => $orderby )
      );

      $attachments = array();

      foreach ( $_attachments as $key => $val ) {
        $attachments[$val->ID] = $_attachments[$key];
      }

    } elseif ( !empty( $exclude ) ) {
      $attachments = get_children( array( 
        'post_parent'     => $id, 
        'exclude'         => $exclude, 
        'post_status'     => 'inherit', 
        'post_type'       => 'attachment', 
        'post_mime_type'  => 'image', 
        'order'           => $order, 
        'orderby'         => $orderby ) 
      );
    } else {
      $attachments = get_children( array( 
        'post_parent'     => $id, 
        'post_status'     => 'inherit', 
        'post_type'       => 'attachment', 
        'post_mime_type'  => 'image', 
        'order'           => $order, 
        'orderby'         => $orderby ) 
      );
    }

    if ( empty( $attachments ) )
      return '';

    if ( is_feed() ) {
      $output = "\n";

      foreach ( $attachments as $att_id => $attachment )
        $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";

      return $output;
    }

    wp_enqueue_style( 'OwlCarousel' );
    wp_enqueue_script( 'OwlCarousel' );

    $class = 'slupy-slider';
    $class.= $link === 'lightbox' ? ' gallery-lightbox' : '';

    $attrs = ' class="'.esc_attr( $class ).'"';
    $attrs.= ' data-autoplay="'.esc_attr( $autoplay ).'"';
    $attrs.= ' data-stophover="'.esc_attr( $stop_hover ).'"';
    $attrs.= ' data-navigation="'.esc_attr( $navigation ).'"';
    $attrs.= ' data-fade="'.esc_attr( $fade_effect ).'"';
    $attrs.= ' data-touch="'.esc_attr( $touch_drag ).'"';
    $attrs.= ' data-time="'.esc_attr( $duration_time ).'"';
    $attrs.= ' data-pagination="'.esc_attr( $pagination ).'"';
    $attrs.= ' data-autoheight="'.esc_attr( $auto_height ).'"';

    $output = '<div'.$attrs.'>';

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
      if ( ! empty( $link ) && ('file' === $link || $link === 'lightbox') )
        $image_output = wp_get_attachment_link( $id, $size, false, false );
      elseif ( ! empty( $link ) && 'none' === $link )
        $image_output = wp_get_attachment_image( $id, $size, false );
      else
        $image_output = wp_get_attachment_link( $id, $size, true, false );

      $image_meta  = wp_get_attachment_metadata( $id );

      $output .= "<div class='slider-item'>";
      $output .= $image_output;
      $output .= "</div>";
    }

    $output .= "</div>";
  }
  return $output;
}

}

/*---------------------------------------------
  Post Format Icons
---------------------------------------------*/
if ( !function_exists( 'get_slupy_post_format_icon' ) ) {

function get_slupy_post_format_icon( $post_format = 'standard', $custom_icon = '' ) {
  $post_format_icons = apply_filters( 'slupy_post_format_icons', array(
    '0'       => 'icon-pencil',
    'aside'   => 'icon-file2',
    'gallery' => 'icon-images',
    'link'    => 'icon-link',
    'image'   => 'icon-camera',
    'quote'   => 'icon-left-quote',
    'status'  => 'icon-chat2',
    'video'   => 'icon-play2',
    'audio'   => 'icon-music2',
    'chat'    => 'icon-chat'
  ) );

  if ( !$custom_icon ) {
    $icon = get_post_meta( get_the_ID(), '_ts_slupy_meta', true );
  }
  
  if ( !empty( $icon ) && !empty( $icon['icon'] ) ) {
    $custom_icon = 'fa fa-'.$icon['icon'];
  }else if ( !empty( $custom_icon ) ) {
    $custom_icon = 'fa fa-'.$custom_icon;
  }

  $custom_icon = $custom_icon ? $custom_icon : $post_format_icons[$post_format];

  return ts_get_option( (is_single() ? 'single_icons' : 'blog_icons') ) ? '<span class="entry-icon">
      <a class="entry-format" href="'.esc_url( get_post_format_link( $post_format ) ).'">
        <span class="'.esc_attr( $custom_icon ).' entry-format-icon"></span><span class="fa fa-caret-right"></span>
      </a>
    </span>' : '';
}

}

/*---------------------------------------------
  About Author
---------------------------------------------*/
if ( !function_exists( 'get_slupy_about_author' ) ) {

function get_slupy_about_author( $author_id ) {

  $author_desc = get_the_author_meta( 'description', $author_id );
  $author_desc = $author_desc ? $author_desc : __( 'You need update your bio: ', SLUPY_TRANSLATE ).'<a href="'.esc_url( get_edit_profile_url( $author_id ) ).'">'.__( 'Edit your profile', SLUPY_TRANSLATE ).'</a>';

  echo '<div class="author-bio">
  <h2 class="author-name">'.__( 'Who is ', SLUPY_TRANSLATE ).esc_html( get_the_author_meta( 'display_name', $author_id ) ).'</h2>
  <p><a href="'.esc_url( get_author_posts_url( $author_id ) ).'" class="author-avatar">'.get_avatar( $author_id, 120 ).'</a>'.$author_desc.'</p>';

  get_slupy_author_social_links( $author_id );

  echo '</div>';
}

}

if( !function_exists('get_slupy_author_social_links') ) {

function get_slupy_author_social_links( $author_id ) {

  //get social links
  $all_social_links = ts_get_option( 'single_sociallinks' );
  if ( is_array( $all_social_links ) ) {
    echo '<span class="ts-social">';
    foreach ( $all_social_links as $key => $a_social ) {
      if ( !empty( $a_social['icon'] ) && !empty( $a_social['title'] ) ) {
        $social_url = get_the_author_meta( 'slupy_'.str_replace('-', '_', $a_social['icon']), $author_id );
        if ( $social_url ) {
          $social_target = is_email( $social_url ) ? '_self': '_blank';
          $social_url = is_email( $social_url ) ? 'mailto:'.antispambot( $social_url, 1 ) : $social_url;
          echo '<a href="'.esc_url( $social_url ).'" target="'.esc_attr( $social_target ).'" data-title="'.esc_attr( $a_social['title'] ).'" class="fa fa-'.esc_attr( $a_social['icon'] ).'"></a>';
        }
      }
    }
    echo '<span class="ts-social-tooltip"></span></span>';
  }
  
}

}

/*---------------------------------------------
  Slupy Comments List
---------------------------------------------*/
if ( !function_exists( 'get_slupy_list_comments' ) ) {

function get_slupy_list_comments( $comment, $args, $depth ) {
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
<<?php echo ( 'div' === $args['style'] ) ? 'div' : 'li'; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
  <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
    <header class="comment-meta">
      <?php printf( '%s', sprintf( '<b class="fn">%s</b>', get_comment_author_link() ) ); ?>
      <span class="comment-metadata">
        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
          <time datetime="<?php comment_time( 'c' ); ?>">
            <?php printf( _x( '%1$s at %2$s', '1: date, 2: time', SLUPY_TRANSLATE ), get_comment_date(), get_comment_time() ); ?>
          </time>
        </a>
      </span><!-- .comment-metadata -->
      <span class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply &rarr;', SLUPY_TRANSLATE ), 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </span><!-- .reply -->

    </header><!-- .comment-meta -->

    <div class="comment-content">
      <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
      <?php comment_text(); ?>
      <?php if ( '0' == $comment->comment_approved ) : ?>
        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', SLUPY_TRANSLATE ); ?></p>
      <?php endif; ?>
      <?php edit_comment_link( __( 'Edit', SLUPY_TRANSLATE ), '<span class="edit-link">', '</span>' ); ?>
    </div><!-- .comment-content -->

  </article><!-- .comment-body -->
<?php
}

}

/*---------------------------------------------
  Plugin Output Change for blog posts
  http://wordpress.org/plugins/breadcrumb-trail/
---------------------------------------------*/
if( !function_exists('change_breadcrumb_trail_items') ) {

function change_breadcrumb_trail_items( $items, $args ) {
  //control post type
  $p_type = get_post_type( get_the_ID() );
  //get post page id
  $b_page = ts_get_option( 'ph_blogpage' );
  //get portfolio page id
  $w_page = ts_get_option( 'ph_portfoliopage' );

  if ( !empty( $b_page ) && !empty( $p_type ) && ( $p_type == 'post' || $p_type == 'attachment' ) ) {
    //include your blog page link
    $p_title = get_the_title( intval( $b_page ) );
    if ( !empty( $p_title ) ) {
      array_splice( $items, 1, 0, '<a href="'.esc_url( get_permalink( $b_page ) ).'">'.esc_html( $p_title ).'</a>' );
    }
  }else if ( !empty( $w_page ) && !empty( $p_type ) && $p_type == 'portfolio' ) {
    unset($items[count($items)-2]);
    //include your portfolio page link
    $p_title = get_the_title( intval( $w_page ) );
    if ( !empty( $p_title ) ) {
      array_splice( $items, 1, 0, '<a href="'.esc_url( get_permalink( $w_page ) ).'">'.esc_html( $p_title ).'</a>' );
    }
  }

  return $items;
}

}

/*---------------------------------------------
  Add custom users contact fields
---------------------------------------------*/
if( !function_exists('add_slupy_user_contacts') ) {

function add_slupy_user_contacts( $user_contact ) {
  $all_social_links = ts_get_option( 'single_sociallinks' );
  if ( is_array( $all_social_links ) ) {
    foreach ( $all_social_links as $key => $a_social ) {
      if ( !empty( $a_social['icon'] ) && !empty( $a_social['title'] ) ) {
        $user_contact['slupy_'.str_replace('-', '_', $a_social['icon'])] = $a_social['title'];
      }
    }
  }
  // Returns the contacts
  return $user_contact;
}

}

/*---------------------------------------------
  colourBrightness
---------------------------------------------*/
if( !function_exists('colourBrightness') ) {

function colourBrightness($hex, $percent) {
  // Work out if hash given
  $hash = '';
  if (stristr($hex,'#')) {
    $hex = str_replace('#','',$hex);
    $hash = '#';
  }
  /// HEX TO RGB
  $rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
  //// CALCULATE 
  for ($i=0; $i<3; $i++) {
    // See if brighter or darker
    if ($percent > 0) {
      // Lighter
      $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
    } else {
      // Darker
      $positivePercent = $percent - ($percent*2);
      $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
    }
    // In case rounding up causes us to go to 256
    if ($rgb[$i] > 255) {
      $rgb[$i] = 255;
    }
  }
  //// RBG to Hex
  $hex = '';
  for($i=0; $i < 3; $i++) {
    // Convert the decimal digit to hex
    $hexDigit = dechex($rgb[$i]);
    // Add a leading zero if necessary
    if(strlen($hexDigit) == 1) {
    $hexDigit = "0" . $hexDigit;
    }
    // Append to the hex string
    $hex .= $hexDigit;
  }
  return $hash.$hex;
}

}

/*---------------------------------------------
  Container Class
---------------------------------------------*/
if( !function_exists('slupy_container_class') ) {

function slupy_container_class( $sidebar = '', $extra = '', $echo = true ) {

  if( $sidebar == 'left' ){
    $container_class = 'col-xs-12 col-sm-8 col-md-9 col-lg-9 right-content';
  }else if( $sidebar == 'right' ){
    $container_class = 'col-xs-12 col-sm-8 col-md-9 col-lg-9 left-content';
  }else{
    $container_class = 'col-sm-12 col-lg-12';
  }

  $container_class.= $extra ? ' '.$extra : '';

  if( $echo ) {
    echo esc_attr( $container_class );
  }else{
    return esc_attr( $container_class );
  }

}

}

/*---------------------------------------------
  Page Cover
---------------------------------------------*/
if( !function_exists('get_slupy_page_cover') ) {

function get_slupy_page_cover( $class_name = false ) {
  //check cover page header
  $is_cover = false;
  $val = '';

  if( ts_get_option('ph_bg') && ts_get_option('ph_cover_color') && ts_get_option('ph_cover_alpha') ) {
    $is_cover = true;
  }

  if( $is_cover ) {
    $val = $class_name ? '<div class="section-cover"></div>' : ' is-media-container';
  }

  return $val;

}

}

/*---------------------------------------------
  Check WooCommerce
---------------------------------------------*/
if ( !function_exists( 'is_woocommerce_activated' ) ) {

function is_woocommerce_activated() {
  if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
}

}

/*---------------------------------------------
  Check Easy Digital Downloads
---------------------------------------------*/
if ( !function_exists( 'is_edd_activated' ) ) {

function is_edd_activated() {
  if ( class_exists( 'Easy_Digital_Downloads' ) ) { return true; } else { return false; }
}

}

/*---------------------------------------------
  Check Visual Composer
---------------------------------------------*/
if ( !function_exists( 'is_visual_composer_activated' ) ) {

function is_visual_composer_activated() {
  
  if ( class_exists('Vc_Manager') ) {
    return true;
  } else {
    return false; 
  }
}

}

/*---------------------------------------------
  Sidebars
---------------------------------------------*/
if( !function_exists('register_slupy_sidebars') ) {

function register_slupy_sidebars($i, $heading, $id, $desc, $h = '4', $s = 'sidebar-widget'){
  $args = array(
    'name'          => $heading.(($i!=1) ? ' %d':''),
    'id'            => $id,
    'description'   => $desc,
    'class'         => '',
    'before_widget' => '<aside id="%1$s" class="slupy-widget '.$s.' widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h'.$h.' class="widget-title">',
    'after_title'   => '</h'.$h.'>'
  );

  register_sidebars( $i, $args );
}

}

if( !function_exists('slupy_widgets_init') ) {

function slupy_widgets_init() {

  //blog
  register_slupy_sidebars( 1, __('Blog Sidebar', SLUPY_TRANSLATE), 'blog-sidebar', __('Sidebar for Blog & Single Post Page', SLUPY_TRANSLATE), '4' );
  
  //woocommerce
  if ( is_visual_composer_activated() ) {
    register_slupy_sidebars( 1, __('Woocommerce Sidebar', SLUPY_TRANSLATE), 'woocommerce-sidebar', __('Sidebar for Woocommerce', SLUPY_TRANSLATE), '4' );
  }
  
  //footer
  if( ts_get_option('footer') ){
    $slupy_footer = explode(',',ts_get_option('footer'));
    register_slupy_sidebars( count($slupy_footer), __('Footer Column' , SLUPY_TRANSLATE), 'footer', '', '4');
  }
  
  //custom sidebars
  $custom_sidebars = ts_get_option('slupy_sidebars');
  if( is_array($custom_sidebars) ){
    foreach ($custom_sidebars as $key => $a_sidebar) {
      if( !empty( $a_sidebar['title'] ) && !preg_match('/^\d/', $a_sidebar['title'] )){
        register_slupy_sidebars( 1, $a_sidebar['title'], sanitize_title( $a_sidebar['title'] ), '', '4' );
      }
    }
  }

}

}

/*---------------------------------------------
  Widgets Output
---------------------------------------------*/
if( !function_exists('slupy_add_span_cat_count') ) {

function slupy_add_span_cat_count($links) {
  $links = str_replace('</a>&nbsp;', '</a>', $links);
  $links = preg_replace('/\((\d+)\)/', '<span class="widget-count">$1</span>', $links);
  return $links;
}

}

/*---------------------------------------------
  SVG File Type Support
---------------------------------------------*/
if( !function_exists('slupy_svg_support') ) {

function slupy_svg_support( $m ) {
  $m['svg'] = 'image/svg+xml';
  $m['svgz'] = 'image/svg+xml';
  return $m;
}

}

/*---------------------------------------------
  Custom Header Options
---------------------------------------------*/
if ( !function_exists('save_slupy_header_type') ) {

function save_slupy_header_type(){
  if ( ! current_user_can('edit_theme_options') )
    return;

  echo '<style type="text/css">.wrap >h3, .wrap > .form-table{display:none;}</style>';

  if ( empty( $_POST ) )
    return;

  if ( isset( $_POST['slupy_header'] ) ) {
    check_admin_referer( 'custom-header-options', '_wpnonce-custom-header-options' );
    global $TS_OPTIONS;
    $slupy_options = $TS_OPTIONS;
    $slupy_options['slupy_header'] = $_POST['slupy_header'];
    update_option('slupy_options', $slupy_options);
    $TS_OPTIONS = $slupy_options;
    return;
  }
}

}

if (!function_exists('add_slupy_header_type')) {

function add_slupy_header_type(){
  $header_models = array(
    'title'     => __( 'Header Model', SLUPY_TRANSLATE ),
    'id'        => 'slupy_header',
    'type'      => 'radio',
    'depends'   => '',
    'mode'      => 'image',
    'value'     => '',
    'field_value' => ts_get_option('slupy_header'),
    'field_name'  => 'slupy_header',
    'class'     => '',
    'options'   => array(
      array(
        'title'     => '',
        'value'     => 'standard',
        'image'     => TS_FRAMEWORKURI.'/images/layout/header1.jpg'
      ),
      array(
        'title'     => '',
        'value'     => 'big',
        'image'     => TS_FRAMEWORKURI.'/images/layout/header2.jpg'
      ),
      array(
        'title'     => '',
        'value'     => 'center',
        'image'     => TS_FRAMEWORKURI.'/images/layout/header3.jpg'
      ),
      array(
        'title'     => '',
        'value'     => 'underlogo',
        'image'     => TS_FRAMEWORKURI.'/images/layout/header4.jpg'
      )
    ),
    'desc'      => ''
  );
  $get_header_types = new TS_FRAMEWORK_RADIO_FIELD;
  $new_field = $get_header_types->output($header_models);
  echo '<tr>
    <td>
      '.$new_field.'
    </td>
  </tr>';
}

}

/*---------------------------------------------
  Favicons
---------------------------------------------*/
if( !function_exists('get_slupy_favicons') ) {

function get_slupy_favicons(){

  $sizes = array(
    ''    => 'shortcut icon',
    '60'  => 'apple-touch-icon',
    '76'  => 'apple-touch-icon',
    '120' => 'apple-touch-icon',
    '152' => 'apple-touch-icon',
  );

  foreach ($sizes as $size => $rel) {
    $favicon_file = ts_get_option( 'slupy_favicon'.$size );
    if ( $favicon_file ) {
      $favicon_file = wp_get_attachment_image_src( $favicon_file, 'full' );
      echo !empty( $favicon_file ) ? '<link href="'.esc_url( $favicon_file[0] ).'" rel="'.esc_attr( $rel ).'"'.(!empty( $size ) && $size != '60' ? ' sizes="'.esc_attr( $size.'x'.$size ).'"' : '').' />' : '';
    }
  }
}

}

/*---------------------------------------------
  Check RTL
---------------------------------------------*/
if( !function_exists('is_slupy_rtl') ) {

function is_slupy_rtl() {

  if( ts_get_option( 'slupy_rtl' ) || is_rtl() ) {
    return true;
  }

  return false;
}

}

/*---------------------------------------------
  Blog Excerpt Custom Lenght
---------------------------------------------*/
if( !function_exists('slupy_excerpt_length') ) {

function slupy_excerpt_length( $length ) {
  $custom_length = ts_get_option( 'blog_excerpt_length' );
  if( $custom_length ) {
    $length = intval( $custom_length );
  }

  return $length;
}

}

/*---------------------------------------------
  Blog Single Post Details
---------------------------------------------*/
if( !function_exists('get_slupy_single_details') ) {

function get_slupy_single_details() {

  if( is_single() ) {
    get_slupy_related_posts( get_the_ID() );
  
    if( ts_get_option('single_prevnext') ){
      echo '<div class="nav-prev-next"><span class="prev-btn">';
        previous_post_link('%link','<span class="title-link nav-prev-post">%title</span>');
      echo '</span><span class="next-btn">';
        next_post_link('%link','<span class="title-link nav-next-post">%title</span>');
      echo '</span></div>';
    }
  }

}

}

/*---------------------------------------------
  Blog Post Meta Position
---------------------------------------------*/
if( !function_exists('get_post_meta_position') ) {

function get_post_meta_position() {

  global $slupy_blog_meta_position, $more;

  if( !empty($slupy_blog_meta_position) && !is_single()  ){
    $more = 0;
  }

  $ts_is_single = is_single() ? true : false;
  $ts_meta_position = $ts_is_single ? 'content-after' : ts_get_option('blog_meta_position');

  if( !empty($slupy_blog_meta_position) && !$ts_is_single  ){
    $ts_meta_position = $slupy_blog_meta_position;
  }

  $slupy_blog_meta_position = $ts_meta_position;

}

}

/*---------------------------------------------
  Blog Post Extra Classes
---------------------------------------------*/
if( !function_exists('get_slupy_extra_post_classes') ) {

function get_slupy_extra_post_classes( $classes ) {

  global $slupy_blog_meta_position;

  if( !empty( $slupy_blog_meta_position ) ) {
    $classes[] = 'meta-pos-'.esc_attr( $slupy_blog_meta_position );
  }

  if( !is_single() && ts_get_option('blog_read_more') ){
    $classes[] = 'readmore-type-button';
  }

  if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
    $classes[] = 'has-post-thumbnail';
  }

  if( is_sticky() && !is_single() && !is_paged() ) {
    $classes[] = 'sticky';
  }

  return $classes;

}

}

/*---------------------------------------------
  Blog Post Footer Details
---------------------------------------------*/
if( !function_exists('get_slupy_post_footer_details') ) {

function get_slupy_post_footer_details() {

  global $slupy_blog_meta_position, $post;

  if( $slupy_blog_meta_position == 'content-after' ) {
    get_slupy_entry_meta( is_single() ? 'single' : 'blog' );

  }else if( $slupy_blog_meta_position == 'read-more' ) {
    $ts_read_more_activated = ( !is_single() && ( strpos($post->post_content, '<!--more-->') || !empty( $post->post_excerpt ) || ts_get_option( 'blog_auto_excerpt' ) ) ) ? true : false;
    
    echo '<div class="entry-meta-with-button'.( $ts_read_more_activated ? ' load-more-active' : '').'">';
    get_slupy_entry_meta();

    if( $ts_read_more_activated ) {
   
      echo '<div class="slupy-readmore">
              <a href="'.esc_url( get_permalink() .'#more-'.esc_attr( get_the_ID() ) ).'" rel="bookmark"  class="slupy-more-button">
                <span>'.__( 'Read More', SLUPY_TRANSLATE ).'</span>
              </a>
            </div><!-- .slupy-readmore -->';
    }

    echo '</div><!-- .entry-meta-with-button -->';

  }

  $tags_settings = ts_get_option('blog_meta_items');

  if( !empty( $tags_settings['tags'] ) && !is_single() ){
    the_tags( '<div class="entry-meta meta-tags"><span class="tag-links">', '', '</span></div>' );
  }

}

}

/*---------------------------------------------
  WP Title for 4.0 and older version
---------------------------------------------*/
if( !function_exists('get_slupy_wp_title') ) {

function get_slupy_wp_title() {
  echo '<title>' . wp_title( '|', false, 'right' ) . "</title>\n";
}

}

/*---------------------------------------------
  Meta Description
---------------------------------------------*/
if( !function_exists('get_slupy_wp_description') ) {

function get_slupy_wp_description() {
  echo '<meta name="description" content="'.get_bloginfo('description').'">';
}

}