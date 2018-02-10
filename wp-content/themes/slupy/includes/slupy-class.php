<?php

if ( !class_exists( 'Slupy_Theme' ) ) {
  class Slupy_Theme {

    /*---------------------------------------------
      Menu Additional
    ---------------------------------------------*/
    function menu_additional( $pos = 'pull-right' ) {

      $val = '<div class="menu-additional '.esc_attr( $pos ).'">';
      $val.= '<ul class="'.esc_attr( $pos ).'">';

      $all_menu_icons = ts_get_option( 'slupy_menuadditionalicons' );

      //Multi Lang Available
      if ( isset( $all_menu_icons['wpml'] ) && function_exists( 'icl_get_languages' ) ) {

        $all_lang_details = icl_get_languages( 'skip_missing=1&link_empty_to=str' );
        $lang_list = '';

        foreach ( $all_lang_details as $key => $a_lang ) {

          if ( $a_lang['active'] === '1' ) { $actived_lang = $key; }

          $lang_list.= '<li>
                  <a href="'.esc_url( $a_lang['url'] ).'">
                    <img src="'.esc_url( $a_lang['country_flag_url'] ).'" alt="" />'.$a_lang['native_name'].'
                  </a>
                </li>';
        }

        if ( isset( $actived_lang ) ) {
          $val.= '<li class="language-change-content menu-additional-btn">
              <a href="javascript:void(0);" class="wpml-lang">
                '.$actived_lang.'
              </a>
              <div class="menu-content">
                <div class="lang-content">
                  <ul>
                  '.$lang_list.'
                  </ul>
                </div>
              </div>
            </li><!-- .language-change-content -->';
        }

      }

      //Social Links Available
      if ( isset( $all_menu_icons['social'] ) ) {

        $all_social_links = ts_get_option( 'slupy_sociallinks' );

        if ( is_array( $all_social_links ) ) {

          $val.= '<li class="social-links-content menu-additional-btn">
                    <a href="javascript:void(0);" class="fa fa-globe"></a>
                    <div class="menu-content">
                      <div class="social-content">
                        <ul>';

          foreach ( $all_social_links as $key => $a_social_link ) {

            $i_icon = !empty( $a_social_link['icon'] ) ? $a_social_link['icon'] : 'heart';
            $a_attrs = !empty( $a_social_link['url'] ) ? ' href="'.esc_url( $a_social_link['url'] ).'"' : ' href="#"' ;
            $a_attrs.= !empty( $a_social_link['target'] ) ? ' target="'.esc_attr( $a_social_link['target'] ).'"' : '';

            $val.= '<li><a'.$a_attrs.' class="fa fa-'.esc_attr( $i_icon ).'"></a></li>';

          }

          $val.= '</ul></div></div></li><!-- .social-links-content -->';
        }

      }

      //Shopping Cart Available
      if ( isset( $all_menu_icons['woocommerce'] ) && is_woocommerce_activated() ) {

        $val.= '<li class="cart-content menu-additional-btn">
              <a href="javascript:void(0);" class="fa fa-shopping-cart"></a>
              <div class="menu-content">
                <div class="widget_shopping_cart_content"></div>
              </div>
            </li><!-- .cart-content -->';

      }

      //Search Available
      if ( isset( $all_menu_icons['search'] ) ) {

        $val.= '<li class="search-content menu-additional-btn">
              <a href="javascript:void(0);" class="fa fa-search"></a>
              <div class="menu-content">
                <div class="search-content">
                  <form method="get" action="'.esc_url( home_url() ).'" role="search">
                    <input type="search" id="live-search" name="s" placeholder="'.esc_attr__( 'Type & Press Enter', SLUPY_TRANSLATE ).'">
                    '.( defined( 'ICL_LANGUAGE_CODE' ) ? '<input type="hidden" name="lang" value="'.esc_attr( ICL_LANGUAGE_CODE ).'"/>' : '' ).'
                    <button type="submit" role="button">'.__( 'Search', SLUPY_TRANSLATE ).'</button>
                  </form><!-- .search -->
                  <div class="search-results"></div>
                </div>
              </div>
            </li><!-- .search-content -->';

      }

      //Custom Menu Items
      $all_custommenu_items = ts_get_option( 'slupy_custommenuitems' );

      if ( is_array( $all_custommenu_items ) ) {

        foreach ( $all_custommenu_items as $key => $value ) {

          if ( !empty( $value['icon'] ) ) {

            $i_icon = $value['icon'];
            $a_attrs = !empty( $value['url'] ) ? ' href="'.esc_url( $value['url'] ).'"' : ' href="#"' ;
            $a_attrs.= !empty( $value['target'] ) ? ' target="'.esc_attr( $value['target'] ).'"' : '';

            $val.= '<li class="custom-content menu-additional-btn">
                <a'.$a_attrs.' class="fa fa-'.esc_attr( $i_icon ).'"></a>';

            $content_menu_item = '';

            if ( is_array( $value['content'] ) && defined( 'ICL_LANGUAGE_CODE' ) && !empty( $value['content'][ICL_LANGUAGE_CODE] ) ) {
              $content_menu_item = $value['content'][ICL_LANGUAGE_CODE];
            }else if ( !empty( $value['content'] ) ) {
              $content_menu_item = $value['content'];
            }

            if ( $content_menu_item ) {
              $val.= '<div class="menu-content">
                        <div class="menu-custom-content ts-white-bg">'.do_shortcode( $content_menu_item ).'</div>
                      </div>';
            }

            $val.=  '</li>';

          }
        }
      }

      $val.= '</ul></div><!-- .menu-additional -->';

      return $val;
    }

    /*---------------------------------------------
      Site Logo
    ---------------------------------------------*/
    function get_logo( $sticky_menu ) {
      $val = '<div id="logo">';

      if ( ts_get_option( 'logo_type' ) ) {
        //image logo
        $slupy_logo = ts_get_option( 'slupy_logo' ) ? wp_get_attachment_image_src( ts_get_option( 'slupy_logo' ), 'full' ) : '';
        $slupy_stickylogo = ts_get_option( 'slupy_stickylogo' ) && $sticky_menu ? wp_get_attachment_image_src( ts_get_option( 'slupy_stickylogo' ), 'full' ) : '';
        $slupy_light_logo = ts_get_option( 'slupy_lightlogo' ) ? wp_get_attachment_image_src( ts_get_option( 'slupy_lightlogo' ), 'full' ) : '';

        $val.= '<a href="'.esc_url( get_home_url() ).'">';
        $val.= ( is_array( $slupy_logo ) ) ? '<span class="site-logo"><img src="'.esc_url( $slupy_logo[0] ).'" width="'.esc_attr( $slupy_logo[1] ).'" height="'.esc_attr( $slupy_logo[2] ).'" alt="" /></span>' : '';
        $val.= ( is_array( $slupy_light_logo ) ) ? '<span class="site-light-logo"><img src="'.esc_url( $slupy_light_logo[0] ).'" width="'.esc_attr( $slupy_light_logo[1] ).'" height="'.esc_attr( $slupy_light_logo[2] ).'" alt="" /></span>' : '';
        $val.= ( is_array( $slupy_stickylogo ) && $sticky_menu ) ? '<span class="sticky-logo"><img src="'.esc_url( $slupy_stickylogo[0] ).'" width="'.esc_attr( $slupy_stickylogo[1] ).'" height="'.esc_attr( $slupy_stickylogo[2] ).'" alt="" /></span>' : '';
        $val.= '</a>';

      }else {
        //text logo
        $val.= '<h1><a href="'.esc_url( get_home_url() ).'">';
        $val.= ts_get_option( 'slupy_logoicon' ) ? '<span class="logo-icon fa fa-'.esc_attr( ts_get_option( 'slupy_logoicon' ) ).'"></span>' : '';
        $val.= ts_get_option( 'slupy_textlogo' ) ? '<span class="site-logo">'.esc_html( ts_get_option( 'slupy_textlogo' ) ).'</span>' : '';
        $val.= ( ts_get_option( 'slupy_stickytextlogo' ) && $sticky_menu ) ? '<span class="sticky-logo">'.esc_html( ts_get_option( 'slupy_stickytextlogo' ) ).'</span>' : '';
        $val.= '</a></h1>';

      }

      $val.= '</div>';
      return $val;
    }

    /*---------------------------------------------
      Nav
    ---------------------------------------------*/
    function get_nav( $loc = 'main', $btn = true ) {

      if( $loc != 'main' && !has_nav_menu( $loc ) ){
        $loc = 'main';
      }else if( $loc == 'main' && !has_nav_menu( $loc ) ){
        return '<nav class="main-menu-notice"><a href="'.esc_url( admin_url().'nav-menus.php?action=locations' ).'">'.esc_html__( 'Please choose a main menu', SLUPY_TRANSLATE ).'</a></nav>';
      }
      
      $args = array(
        'container'       => false, 
        'theme_location'  => $loc, 
        'echo'            => false, 
        'walker'          => new Slupy_Walker()
      );

      $val = wp_nav_menu( $args );
      $val.= $loc != 'mobile' && $btn ? '<a href="#" id="mobile-menu-button" class="fa fa-bars"></a>' : '';

      return '<nav>'.$val.'</nav>';
    }

    /*---------------------------------------------
      Header
    ---------------------------------------------*/
    function get_slupy_header( $menu = 'main' ) {
      $val = '';

      $sticky_menu = ts_get_option( 'slupy_stickymenu' ) ? true : false;
      $h_type = ts_get_option( 'slupy_header' );
      $slupy_logo = $this->get_logo( $sticky_menu );
      $slupy_nav  = $this->get_nav( $menu );
      $slupy_menuadditional = ts_get_option( 'slupy_menuadditional' ) === 'menu' ? $this->menu_additional() : '';

      $val = $slupy_logo;
      $val.= $h_type !== 'underlogo' ? '<div class="nav-content">' : '';
      $val.= $slupy_menuadditional;
      $val.= $slupy_nav;
      $val.= $h_type !== 'underlogo' ? '</div>' : '';

      return $val;
    }

    /*---------------------------------------------
      Mobile Nav
    ---------------------------------------------*/
    function get_mobile_nav($loc = 'mobile' , $btn = false ) {

      $val = '';
      if ( ts_get_option( 'slupy_responsive' ) ) {

        $val = '<div class="mobile-menu-content">
        <div class="back-site-content"><a href="#">'.__( 'BACK', SLUPY_TRANSLATE ).'</a></div>
        '.$this->get_nav( $loc, $btn ).'
        </div><!-- .mobile-menu-content -->';

      }
      return $val;

    }

  }

}


/*---------------------------------------------
  Slupy Ajax / Live Search - Contact Form
---------------------------------------------*/
if ( !class_exists( 'Slupy_Ajax' ) ) {
  class Slupy_Ajax {

    public function __construct() {
      //live search
      add_action( 'wp_ajax_slupy_live_search', array( $this, 'slupy_live_search_callback' ) );
      add_action( 'wp_ajax_nopriv_slupy_live_search', array( $this, 'slupy_live_search_callback' ) );

      add_action( 'wp_ajax_slupy_contact_form', array( $this, 'slupy_contact_form_callback' ) );
      add_action( 'wp_ajax_nopriv_slupy_contact_form', array( $this, 'slupy_contact_form_callback' ) );
    }

    public function slupy_live_search_callback() {

      check_ajax_referer( 'slupy_nonce', 'nonce' );

      if ( true ) {
        global $wpdb; // this is how you get access to the database
        global $wp_query;

        wp_reset_query();

        $val = '<ul>';

        $s = isset( $_GET['s'] ) ? $_GET['s'] : '';
        $search_query = new WP_Query();
        $args = array(
          's' => esc_sql( $s ),
          'post_type' => array(
            'post',
            'page'
          ),
          'post_status' => array(
            'publish',
            'private'
          ),
          'posts_per_page' => 5,
          'orderby' => 'comment_count',
          'suppress_filters'=>true
        );
        $search_posts = $search_query->query( $args );

        // build loop
        foreach ( $search_posts as $search_post ) {
          $page_url = get_page_link( $search_post->ID );
          $val.= '<li><a href="'.esc_url( $page_url ).'">'.$search_post->post_title.'</a></li>';
        }

        wp_reset_query();
        $args['showposts'] = -1;
        $search_query->query( $args );
        $total_posts = $search_query->post_count;

        if ( intval( $total_posts ) > 5 ) {
          $search_url = home_url().'/?s='.str_replace( ' ', '+', $s );

          $val.= '<li class="total-results">
            <a href="'.esc_url( $search_url ).'">
            '.sprintf( __( 'Total: %s results', SLUPY_TRANSLATE ), intval( $total_posts ) ).'
            <span>'.__( 'View all', SLUPY_TRANSLATE ).'</span>
            </a>
          </li>';
        }

        $val.= '</ul>';

        wp_send_json_success( $val );

        die();
      }
    }

    public function slupy_contact_form_callback() {

      check_ajax_referer( 'slupy_nonce', 'nonce' );

      if ( true ) {

        $form_ok = 0;
        $ajax_message = '';
        $set_mail = __( 'Please set a e-mail on framework.', SLUPY_TRANSLATE );
        $fill_message = __( 'Please fill all required fields.', SLUPY_TRANSLATE );
        $correct_mail = __( 'Please enter a valid e-mail address.', SLUPY_TRANSLATE );
        $message_sent = __( 'Your message has been sent successfully.', SLUPY_TRANSLATE );
        $message_error = __( 'Currently there is a problem. Please use <a href="mailto:your@gmail.com">our email</a> address.', SLUPY_TRANSLATE );
        $email = isset( $_POST['email'] ) ? $_POST['email'] : '';
        $name = isset( $_POST['name'] ) ? $_POST['name'] : '';
        $subject = isset( $_POST['subject'] ) ? $_POST['subject'] : '';
        $message = isset( $_POST['message'] ) ? $_POST['message'] : '';

        if ( strlen( $name ) < 2 || strlen( $subject ) < 3 || strlen( $message ) < 2 ) {
          $ajax_message = $fill_message;
        }else if ( !is_email( $email ) ) {
          $ajax_message = $correct_mail;
        }else if( is_email( ts_get_option( 'contact_form_mail' ) ) ) {
          $headers = 'From: '.esc_html( $name ).' <'.$email.'>' . "\r\n";
          $mail_check = wp_mail( ts_get_option( 'contact_form_mail' ), esc_html( $subject ), esc_html( $message ), $headers );

          if ( $mail_check ) {
            $ajax_message = $message_sent;
            $form_ok = 1;
          }else {
            $ajax_message = $message_error;
          }

        }else {
          $ajax_message = $set_mail;
        }

        wp_send_json( array( 'ID' => $form_ok , 'message' => $ajax_message ) );
      }
    }
  }

}
new Slupy_Ajax;

/*---------------------------------------------
  Slupy Main Menu
---------------------------------------------*/
class Slupy_Main_Menu {


  function __construct() {
    // add custom menu fields to menu
    add_filter( 'wp_setup_nav_menu_item', array( $this, 'slupy_wp_setup_nav_menu_item' ) );
    // save menu custom fields
    add_action( 'wp_update_nav_menu_item', array( $this, 'slupy_wp_update_nav_menu_item' ), 10, 3 );
    // edit menu walker
    add_filter( 'wp_edit_nav_menu_walker', array( $this, 'slupy_wp_edit_nav_menu_walker' ), 10, 2 );
  }

  function slupy_wp_setup_nav_menu_item( $menu_item ) {

    $menu_id = intval( $menu_item->ID );

    $menu_item->icon = get_post_meta( $menu_id, '_menu_item_icon', true );
    $menu_item->disablelink = get_post_meta( $menu_id, '_menu_item_disablelink', true );
    $menu_item->hidetitle = get_post_meta( $menu_id, '_menu_item_hidetitle', true );
    $menu_item->megamenu = get_post_meta( $menu_id, '_menu_item_megamenu', true );
    $menu_item->fullwidth = get_post_meta( $menu_id, '_menu_item_fullwidth', true );
    $menu_item->contentex = get_post_meta( $menu_id, '_menu_item_contentex', true );
    $menu_item->menusize = get_post_meta( $menu_id, '_menu_item_menusize', true );

    return $menu_item;

  }

  function slupy_wp_update_nav_menu_item( $menu_id, $menu_item_db_id, $args ) {

    // Check if element is properly sent
    if ( isset( $_REQUEST['menu-item-icon'] ) && is_array( $_REQUEST['menu-item-icon'] ) ) {
      $icon_val = $_REQUEST['menu-item-icon'][$menu_item_db_id];
      update_post_meta( $menu_item_db_id, '_menu_item_icon', esc_attr( $icon_val ) );
    }

    if ( isset( $_REQUEST['menu-item-contentex'] ) && is_array( $_REQUEST['menu-item-contentex'] ) ) {
      $val = $_REQUEST['menu-item-contentex'][$menu_item_db_id];
      update_post_meta( $menu_item_db_id, '_menu_item_contentex', $val );
    }

    if ( isset( $_REQUEST['menu-item-menusize'] ) && is_array( $_REQUEST['menu-item-menusize'] ) ) {
      $val = $_REQUEST['menu-item-menusize'][$menu_item_db_id];
      update_post_meta( $menu_item_db_id, '_menu_item_menusize', esc_attr( $val ) );
    }

    $val = isset( $_REQUEST['menu-item-disablelink'][$menu_item_db_id] ) && $_REQUEST['menu-item-disablelink'][$menu_item_db_id] === 'on' ? 'on' : '';
    update_post_meta( $menu_item_db_id, '_menu_item_disablelink', $val );
    $val = isset( $_REQUEST['menu-item-hidetitle'][$menu_item_db_id] ) && $_REQUEST['menu-item-hidetitle'][$menu_item_db_id] === 'on' ? 'on' : '';
    update_post_meta( $menu_item_db_id, '_menu_item_hidetitle', $val );
    $val = isset( $_REQUEST['menu-item-megamenu'][$menu_item_db_id] ) && $_REQUEST['menu-item-megamenu'][$menu_item_db_id] === 'on' ? 'on' : '';
    update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $val );
    $val = isset( $_REQUEST['menu-item-fullwidth'][$menu_item_db_id] ) && $_REQUEST['menu-item-fullwidth'][$menu_item_db_id] === 'on' ? 'on' : '';
    update_post_meta( $menu_item_db_id, '_menu_item_fullwidth', $val );

  }

  function slupy_wp_edit_nav_menu_walker( $walker, $menu_id ) {

    return 'Walker_Nav_Menu_Edit_Custom';

  }

}
new Slupy_Main_Menu;


/*---------------------------------------------
  Slupy Main Menu - Admin Fields
---------------------------------------------*/
/**
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu {
  /**
   * Starts the list before the elements are added.
   *
   * @see Walker_Nav_Menu::start_lvl()
   *
   * @since 3.0.0
   *
   * @param string  $output Passed by reference.
   * @param int     $depth  Depth of menu item. Used for padding.
   * @param array   $args   Not used.
   */
  function start_lvl( &$output, $depth = 0, $args = array() ) {}

  /**
   * Ends the list of after the elements are added.
   *
   * @see Walker_Nav_Menu::end_lvl()
   *
   * @since 3.0.0
   *
   * @param string  $output Passed by reference.
   * @param int     $depth  Depth of menu item. Used for padding.
   * @param array   $args   Not used.
   */
  function end_lvl( &$output, $depth = 0, $args = array() ) {}

  /**
   * Start the element output.
   *
   * @see Walker_Nav_Menu::start_el()
   * @since 3.0.0
   *
   * @param string  $output Passed by reference. Used to append additional content.
   * @param object  $item   Menu item data object.
   * @param int     $depth  Depth of menu item. Used for padding.
   * @param array   $args   Not used.
   * @param int     $id     Not used.
   */
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $_wp_nav_menu_max_depth;
    $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

    ob_start();
    $item_id = esc_attr( $item->ID );
    $removed_args = array(
      'action',
      'customlink-tab',
      'edit-menu-item',
      'menu-item',
      'page-tab',
      '_wpnonce',
    );

    $original_title = '';
    if ( 'taxonomy' == $item->type ) {
      $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
      if ( is_wp_error( $original_title ) )
        $original_title = false;
    } elseif ( 'post_type' == $item->type ) {
      $original_object = get_post( $item->object_id );
      $original_title = get_the_title( $original_object->ID );
    }

    $classes = array(
      'menu-item menu-item-depth-' . $depth,
      'menu-item-' . esc_attr( $item->object ),
      'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive' ),
    );

    $title = $item->title;

    if ( ! empty( $item->_invalid ) ) {
      $classes[] = 'menu-item-invalid';
      /* translators: %s: title of menu item which is invalid */
      $title = sprintf( __( '%s (Invalid)', SLUPY_TRANSLATE ), $item->title );
    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
      $classes[] = 'pending';
      /* translators: %s: title of menu item in draft status */
      $title = sprintf( __( '%s (Pending)', SLUPY_TRANSLATE ), $item->title );
    }

    $title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

?>
    <li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
      <dl class="menu-item-bar">
        <dt class="menu-item-handle">
          <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo ( 0 == $depth ) ? 'style="display: none;"' : ''; ?>><?php _e( 'sub item', SLUPY_TRANSLATE ); ?></span></span>
          <span class="item-controls">
            <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
            <span class="item-order hide-if-js">
              <a href="<?php
    echo wp_nonce_url(
      add_query_arg(
        array(
          'action' => 'move-up-menu-item',
          'menu-item' => $item_id,
        ),
        remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
      ),
      'move-menu_item'
    );
    ?>" class="item-move-up"><abbr title="<?php esc_attr_e( 'Move up' ); ?>">&#8593;</abbr></a>
              |
              <a href="<?php
    echo wp_nonce_url(
      add_query_arg(
        array(
          'action' => 'move-down-menu-item',
          'menu-item' => $item_id,
        ),
        remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
      ),
      'move-menu_item'
    );
    ?>" class="item-move-down"><abbr title="<?php esc_attr_e( 'Move down' ); ?>">&#8595;</abbr></a>
            </span>
            <a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" title="<?php esc_attr_e( 'Edit Menu Item' ); ?>" href="<?php
    echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? esc_url( admin_url( 'nav-menus.php' ) ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
    ?>"><?php _e( 'Edit Menu Item', SLUPY_TRANSLATE ); ?></a>
          </span>
        </dt>
      </dl>

      <div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
        <?php if ( 'custom' == $item->type ) : ?>
          <p class="field-url description description-wide">
            <label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
              <?php _e( 'URL', SLUPY_TRANSLATE ); ?><br />
              <input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
            </label>
          </p>
        <?php endif; ?>
        <p class="description description-thin">
          <label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
            <?php _e( 'Navigation Label', SLUPY_TRANSLATE ); ?><br />
            <input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
          </label>
        </p>
        <p class="description description-thin">
          <label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
            <?php _e( 'Title Attribute', SLUPY_TRANSLATE ); ?><br />
            <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
          </label>
        </p>
        <p class="field-link-target description">
          <label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
            <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
            <?php _e( 'Open link in a new window/tab', SLUPY_TRANSLATE ); ?>
          </label>
        </p>
        <p class="field-css-classes description description-thin">
          <label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
            <?php _e( 'CSS Classes (optional)', SLUPY_TRANSLATE ); ?><br />
            <input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode( ' ', $item->classes ) ); ?>" />
          </label>
        </p>
        <p class="field-xfn description description-thin">
          <label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
            <?php _e( 'Link Relationship (XFN)', SLUPY_TRANSLATE ); ?><br />
            <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
          </label>
        </p>
        <p class="field-description description description-wide">
          <label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
            <?php _e( 'Description', SLUPY_TRANSLATE ); ?><br />
            <textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_textarea( $item->description ); ?></textarea>
            <span class="description"><?php _e( 'The description will be displayed in the menu if the current theme supports it.', SLUPY_TRANSLATE ); ?></span>
          </label>
        </p>
<?php
    /* New fields insertion starts here */
    $menu_sizes_options = '';
    for ($i=1; $i < 13; $i++) {
      $menu_sizes_options .= '<option value="'.esc_attr( $i ).'" '.selected( $item->menusize, $i, false ).'>'.esc_attr( $i ).' / 12'.'</option>';
    }

    $ts_icon_box = new TS_FRAMEWORK_ICON_FIELD;
    $icon_box_args = array(
      'title'       => '',
      'field_value' => esc_attr( $item->icon ),
      'id'          => $item_id,
      'type'        => 'icon',
      'depends'     => '',
      'desc'        => '',
      'field_name'  => 'menu-item-icon['.$item_id.']',
      'class'       => ''
    );

    echo '<div class="slupy_menuex">
            <p class="field-custom description description-wide">
              <label>
                '.$ts_icon_box->output( $icon_box_args ).'
              </label>
            </p>

            <p class="field-custom description description-wide">
              <label>'.__( 'Disable link', SLUPY_TRANSLATE ).'
                <input type="checkbox" value="on" '.checked( $item->disablelink, 'on', false ).' name="menu-item-disablelink['.$item_id.']" />
              </label>
              <label> '.__( 'Hide title', SLUPY_TRANSLATE ).'
                <input type="checkbox" value="on" '.checked( $item->hidetitle, 'on', false ).' name="menu-item-hidetitle['.$item_id.']" />
              </label>
            </p>

            <p class="field-custom description description-wide slupy-menuconfig slupy-main">
              <label>'.__( 'Mega Menu', SLUPY_TRANSLATE ).'
                <input class="mega-menu-control" type="checkbox" value="on" '.checked( $item->megamenu, 'on', false ).' name="menu-item-megamenu['.$item_id.']" />
              </label>
              <label> '.__( 'and full width content', SLUPY_TRANSLATE ).'
                <input type="checkbox" value="on" '.checked( $item->fullwidth, 'on', false ).' name="menu-item-fullwidth['.$item_id.']" />
              </label>
            </p>

            <p class="field-custom description description-wide slupy-menuconfig slupy-sub">
              <label>
                '.__( 'Menu Size (Optional)', SLUPY_TRANSLATE ).'<br />
                <select name="menu-item-menusize['.$item_id.']" class="size-selectbox">
                  <option></option>
                    '.$menu_sizes_options.'
                </select>
              </label>
            </p>

            <p class="field-custom description description-wide slupy-menuconfig slupy-menucontent">
              <label>
                '.__( 'Menu Content', SLUPY_TRANSLATE ).'<br />
                '. ( defined( 'TS_PLUGIN' ) ? '<a class="themesama_shortcode-button button" href="#" data-inputid="menu-item-contentex'.$item_id.'">
                <span class="themesama_plus_icon"></span>'.__( 'Add Shortcode', SLUPY_TRANSLATE ).'</a>' : '' ).'
                <textarea id="menu-item-contentex'.$item_id.'" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-contentex['.$item_id.']">'.esc_textarea( $item->contentex ).'</textarea>
                <span class="description">'.__( '(Optional) You can use shortcode.', SLUPY_TRANSLATE ).'</span>
              </label>
            </p>

            </div>';
            /* New fields insertion ends here */
?>
        <p class="field-move hide-if-no-js description description-wide">
          <label>
            <span><?php _e( 'Move', SLUPY_TRANSLATE ); ?></span>
            <a href="#" class="menus-move-up"><?php _e( 'Up one', SLUPY_TRANSLATE ); ?></a>
            <a href="#" class="menus-move-down"><?php _e( 'Down one', SLUPY_TRANSLATE ); ?></a>
            <a href="#" class="menus-move-left"></a>
            <a href="#" class="menus-move-right"></a>
            <a href="#" class="menus-move-top"><?php _e( 'To the top', SLUPY_TRANSLATE ); ?></a>
          </label>
        </p>

        <div class="menu-item-actions description-wide submitbox">
          <?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
            <p class="link-to-original">
              <?php printf( __( 'Original: %s', SLUPY_TRANSLATE ), '<a href="' . esc_url( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
            </p>
          <?php endif; ?>
          <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
    echo wp_nonce_url(
      add_query_arg(
        array(
          'action' => 'delete-menu-item',
          'menu-item' => $item_id,
        ),
        admin_url( 'nav-menus.php' )
      ),
      'delete-menu_item_' . $item_id
    ); ?>"><?php _e( 'Remove', SLUPY_TRANSLATE ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
    ?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php _e( 'Cancel', SLUPY_TRANSLATE ); ?></a>
        </div>

        <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
        <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
        <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
        <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
        <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
        <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
      </div><!-- .menu-item-settings-->
      <ul class="menu-item-transport"></ul>
    <?php
    $output .= ob_get_clean();
  }

} // Walker_Nav_Menu_Edit

/*---------------------------------------------
  Slupy Main Menu - Frontend Output
---------------------------------------------*/
class Slupy_Walker extends Walker_Nav_Menu
{

  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $wp_query;

    if ( is_array( $args ) ) {
      $args = json_decode( json_encode( $args ), FALSE );
    }

    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $class_slupy_menu = $value = '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

    //Control Mega Menu
    $ex_class = '';
    if ( $depth == 0 && $item->megamenu == 'on' ) {
      $ex_class = ' mega-menu ts-white-bg'.( $item->fullwidth == 'on' ? ' full-width' : '' );
      $ex_class.= ' no-padding';
    }
    
    if ( $depth == 1 && !empty( $item->menusize ) ) {
      $ex_class = ' col-mm-'.$item->menusize;
    }

    $class_slupy_menu = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
    $class_slupy_menu = ' class="'. esc_attr( $class_slupy_menu ) .$ex_class. '"';

    $output .= $indent . '<li id="menu-item-'. esc_attr( $item->ID ) . '"' . $value . $class_slupy_menu .'>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url ) && $item->disablelink != 'on' ? ' href="'   . esc_url( $item->url ) .'"' : ' href="javascript:void(0);"';

    $prepend = '';
    $append = '';
    $description  = ! empty( $item->description ) ? '<span>'.$item->description.'</span>' : '';

    if ( $depth != 0 ) {
      $description = $append = $prepend = "";
    }

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= !empty( $item->icon ) ? '<i class="fa fa-'.esc_attr( $item->icon ).' menu-icon"></i>' : '';

    if ( $item->hidetitle != 'on' ) {
      $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
      $item_output .= $description.$args->link_after;
    }

    $item_output .= '</a>';
    $item_output .= $args->after;

    //Content Mega Menu
    if ( $depth == 1 && !empty( $item->contentex ) ) {
      $item_output .=  '<div class="menu-content">'.do_shortcode( $item->contentex ).'</div>';
    }
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
  }
}
