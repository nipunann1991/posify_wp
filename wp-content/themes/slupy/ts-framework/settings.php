<?php
/*---------------------------------------------
    Define Framework's Some Helper Variables
---------------------------------------------*/
defined( 'TS_THEMEDIR' )     || define( 'TS_THEMEDIR', get_template_directory() );
defined( 'TS_THEMEURI' )     || define( 'TS_THEMEURI', get_template_directory_uri() );
defined( 'TS_MENUNAME' )     || define( 'TS_MENUNAME', 'Slupy Theme' );
defined( 'TS_SUBMENUNAME' )  || define( 'TS_SUBMENUNAME', 'Theme Options' );
defined( 'TS_OPTIONTITLE' )  || define( 'TS_OPTIONTITLE', 'Slupy Theme Options' );
defined( 'TS_FRAMEWORK' )    || define( 'TS_FRAMEWORK', TS_THEMEDIR.'/ts-framework' );
defined( 'TS_FRAMEWORKURI' ) || define( 'TS_FRAMEWORKURI', TS_THEMEURI.'/ts-framework' );
defined( 'TS_OPTIONSNAME' )  || define( 'TS_OPTIONSNAME', 'slupy_options' );
defined( 'TS_OPTIONGROUP' )  || define( 'TS_OPTIONGROUP', 'slupy_options_group' );
defined( 'TS_PAGENAME' )     || define( 'TS_PAGENAME', 'ts-framework' );
defined( 'TS_TRANSLATE' )    || define( 'TS_TRANSLATE', 'themesama' );

/*---------------------------------------------
    Load Templates for Framework
---------------------------------------------*/
load_template( TS_FRAMEWORK.'/options.php' );
load_template( TS_FRAMEWORK.'/ts_functions.php' );
load_template( TS_FRAMEWORK.'/fields.php' );
load_template( TS_FRAMEWORK.'/metabox.php' );

/**
 * Themesama Framework
 *
 * @access    public
 * @since     1.0
 */
if ( !class_exists( 'THEMESAMA_FRAMEWORK' ) ) {
  class THEMESAMA_FRAMEWORK extends TS_FRAMEWORK_FIELDS
  {

    public $themesama_framework_fields = array();
    public $themesama_framework_menu = '';

    public function __construct() {
      $this->themesama_framework_fields = get_ts_framework_options();
      // register actions and filters
      add_filter( 'ts_framework_font_awesome_icons', array( $this,'ts_framework_font_awesome_icons' ) );

      $this->getAction( 'admin_init', 'ts_admin_init' );
      $this->getAction( 'admin_menu', 'ts_add_menu' );
      $this->getAction( 'print_media_templates', 'ts_gallery_shortcode_extra_config' );
    }

    public function getAction( $action, $function_name ) {
      add_action( $action, array( $this, $function_name ) );
    }

    public function ts_admin_init() {
      // enqueque scripts
      $this->getAction( 'admin_enqueue_scripts', 'loadAdminScripts' );

      // register theme sama framework settings
      register_setting( TS_OPTIONGROUP, TS_OPTIONSNAME, array( $this, 'ts_conrol_events' ) );

      foreach ( $this->themesama_framework_fields as $key => $tabs ) {

        $this->themesama_framework_menu .= '<li class="ts_main_tab"><a href="#">'.$tabs['title'].'</a><ul>';
        //sections
        foreach ( $tabs['tabs'] as $key2 => $sections ) {
          if( !empty($sections['id']) ){
          $id = $sections['id'];
          // add settings sections
          add_settings_section( $id, '', array( &$this, 'ts_settings_section' ), TS_PAGENAME );
          $this->themesama_framework_menu .= '<li class="ts_sub_tab" data-tab="'.esc_attr( $id ).'"><a href="#">'.$sections['title'].'</a></li>';

          //fields
          foreach ( $sections['options'] as $key3 => $fields ) {
            $type = $fields['type'];
            $field_id = $fields['id'];
            // add your setting's fields
            add_settings_field( $id.$field_id, '', array( &$this, 'getField' ), TS_PAGENAME, $id, $fields );
          }
          //fields end
          }

        }
        //sections end
        $this->themesama_framework_menu .= '</ul></li>';

      }

    }

    /*---------------------------------------------
        Gallery Shortcode Extra Config
    ---------------------------------------------*/
    public function ts_gallery_shortcode_extra_config() {
?>
      <script type="text/html" id="tmpl-slupy-custom-gallery-setting">
        <label class="setting">
          <span><?php _e( 'Slider', TS_TRANSLATE ); ?></span>
          <input data-setting="slider_gallery" type="checkbox">
        </label>
      </script>

      <script>

        jQuery(document).ready(function(){

          // add your shortcode attribute and its default value to the
          // gallery settings list; $.extend should work as well...
          _.extend(wp.media.gallery.defaults, {
            slider_gallery: 'false'
          });

          // merge default gallery settings template with yours
          wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
            template: function(view){
              return wp.media.template('gallery-settings')(view)
                   + wp.media.template('slupy-custom-gallery-setting')(view);
            }
          });

        });

      </script>
<?php
    }

    /*---------------------------------------------
        Control Framework's Save Operation
    ---------------------------------------------*/
    public function ts_conrol_events( $settings ) {
      $framework_notice = __( 'Settings saved.<br><img src="http://www.ten28.com/yt.jpg">', TS_TRANSLATE );
      $framework_notice_type = 'updated';
      $is_ok = true;

      if ( isset( $_POST['ts_framework_reset'] ) ) {

        $framework_notice = __( 'Settings reset.', TS_TRANSLATE );
        $is_ok = false;
        delete_option( TS_OPTIONSNAME );

      }else if ( isset( $_POST['ts_framework_import'] ) ) {
        if ( isset( $_POST['ts_framework_import_val'] ) && is_serialized( stripslashes( $_POST['ts_framework_import_val'] ) ) ) {
          $framework_notice = __( 'Imported settings saved.', TS_TRANSLATE );
          $settings = unserialize( stripslashes( $_POST['ts_framework_import_val'] ) );
        }else if ( isset( $_POST['ts_framework_import_val'] ) ) {
          $framework_notice = __( 'Please check imported value.', TS_TRANSLATE );
          $is_ok = false;
          $framework_notice_type = 'error';
        }
      }

      add_settings_error( 'ts_framework_notices', esc_attr( 'ts_notice' ), $framework_notice, $framework_notice_type );

      if ( $is_ok === true ) {
        return $settings;
      }else {
        return;
      }

    }

    public function ts_settings_section() {
      // Think of this as help text for the section.
    }

    /*---------------------------------------------
        Add Framework Menu Item
    ---------------------------------------------*/
    public function ts_add_menu() {
      add_theme_page(TS_OPTIONTITLE, TS_SUBMENUNAME, 'manage_options', TS_PAGENAME, array( $this, 'getFramework' ));
      //add_menu_page( TS_OPTIONTITLE, TS_MENUNAME, 'manage_options', TS_PAGENAME , array( $this, 'getFramework' ) );
    }

    /*---------------------------------------------
        Framework Content
    ---------------------------------------------*/
    public function getFramework() {
      echo '<div class="wrap">'.$this->getNotices();
      include_once TS_FRAMEWORK.'/index.php';
      echo '</div>';
    }

    /*---------------------------------------------
        Notices Output
    ---------------------------------------------*/
    public function getNotices() {
      $val = '';
      $all_notices = get_settings_errors( 'ts_framework_notices' );
      if ( is_array( $all_notices ) && count( $all_notices ) > 0 ) {
        $message = $all_notices[0]['message'];
        $type = $all_notices[0]['type'];
        $val = '<div id="ts_framework_notices" class="'.esc_attr( $type ).' settings-error">
                    <p><strong>'.$message.'</strong></p>
                </div>';
      }
      return $val;
    }

    /*---------------------------------------------
        Framework's Styles & Scripts
    ---------------------------------------------*/
    public function loadAdminScripts() {

      //register styles
      wp_enqueue_style( 'font-awasome', SLUPY_CSS . '/font-awesome.min.css', array(), '4.2.0' );
      wp_enqueue_style( 'ts-framework', TS_FRAMEWORKURI.'/css/framework-style.css', array(), '1.0.0' );
      wp_enqueue_style( 'chosen', TS_FRAMEWORKURI.'/js/chosen/chosen.css', array(), '1.0.0' );
      wp_enqueue_style( 'wp-color-picker' );

      $color = get_user_meta( get_current_user_id(), 'admin_color', true );
      global $_wp_admin_css_colors;
      $custom_css = '
        .isotope-filter li.active a,
        .isotope-filter a:hover,
        .composer-switch .vc-spacer,
        .composer-switch .logo-icon,
        .composer-switch a,
        .composer-switch a:visited,
        .choose_this_icon.activated_icon,
        .tab_contents ul.lang_tab li a.ts_active,
        .tab_contents ul.lang_tab li a:hover,
        .ts_switch_button .ts_switch_on span,
        .radio_switch_on input[type="radio"]:checked + span,
        .ts_frameworkarea .ts_content .ts_menu > ul > li.activated_tab > a,
        .ts_frameworkarea .ts_content .ts_menu > ul > li:hover > a{
            background-color: '.$_wp_admin_css_colors[$color]->colors[2].' !important;
        }

        .modal-header .close:hover{
          color: '.$_wp_admin_css_colors[$color]->colors[2].' !important;
        }

        .composer-switch a:hover,
        .ts_switch_button .ts_switch_off span,
        .radio_switch_off input[type="radio"]:checked + span,
        .ts_frameworkarea .ts_content .ts_menu > ul > li > ul > li > a{
            background-color: '.$_wp_admin_css_colors[$color]->colors[1].' !important;
        }

        .ts_frameworkarea .ts_content .ts_menu > ul > li > ul > li.activated_subtab a{
            background-color: '.$_wp_admin_css_colors[$color]->colors[0].' !important;
        }

        .ts_content_a_field.ts_content_text input[type="text"]:focus,
        .ts_content_a_field.ts_content_upload input[type="text"]:focus,
        .ts_content_a_field.ts_content_textarea textarea:focus,
        .ts_image_checkbox:checked + .ts_image_button img{
            border-color: '.$_wp_admin_css_colors[$color]->colors[2].' !important;
        }';
      wp_add_inline_style( 'ts-framework', $custom_css );

      //scripts
      wp_enqueue_media();
      wp_enqueue_script( 'jquery-ui-core' );
      wp_enqueue_script( 'jquery-ui-sortable' );
      wp_enqueue_script( 'wp-color-picker' );
      wp_enqueue_script( 'jquery-cookie' , TS_FRAMEWORKURI.'/js/jquery.cookie.js', array( 'jquery' ), '1.4.0', true );
      wp_enqueue_script( 'jquery-form-dependencies', TS_FRAMEWORKURI . '/js/jquery.form-dependencies.js', array( 'jquery' ), '2.0', true );
      wp_enqueue_script( 'chosen', TS_FRAMEWORKURI.'/js/chosen/chosen.jquery.min.js', array( 'jquery' ), '1.0.0', true );
      wp_enqueue_script( 'ts-framework' , TS_FRAMEWORKURI.'/js/scripts.js', array( 'jquery' ), '1.0.0', true );
      
      //Font Awesome Icons
      wp_localize_script( 'ts-framework', 'font_awesome', array( 'icons' => apply_filters( 'ts_framework_font_awesome_icons', array() ) ) );
      wp_localize_script( 'ts-framework', 'ts_framework', array( 'url' => urlencode( TS_FRAMEWORKURI ) ) );
    }

    /*---------------------------------------------
        Font Awesome Icons
    ---------------------------------------------*/
    function ts_framework_font_awesome_icons( $icons = array() ) {
      return array("glass", "music", "search", "envelope-o", "heart", "star", "star-o", "user", "film", "th-large", "th", "th-list", "check", "remove", "close", "times", "search-plus", "search-minus", "power-off", "signal", "gear", "cog", "trash-o", "home", "file-o", "clock-o", "road", "download", "arrow-circle-o-down", "arrow-circle-o-up", "inbox", "play-circle-o", "rotate-right", "repeat", "refresh", "list-alt", "lock", "flag", "headphones", "volume-off", "volume-down", "volume-up", "qrcode", "barcode", "tag", "tags", "book", "bookmark", "print", "camera", "font", "bold", "italic", "text-height", "text-width", "align-left", "align-center", "align-right", "align-justify", "list", "dedent", "outdent", "indent", "video-camera", "photo", "image", "picture-o", "pencil", "map-marker", "adjust", "tint", "edit", "pencil-square-o", "share-square-o", "check-square-o", "arrows", "step-backward", "fast-backward", "backward", "play", "pause", "stop", "forward", "fast-forward", "step-forward", "eject", "chevron-left", "chevron-right", "plus-circle", "minus-circle", "times-circle", "check-circle", "question-circle", "info-circle", "crosshairs", "times-circle-o", "check-circle-o", "ban", "arrow-left", "arrow-right", "arrow-up", "arrow-down", "mail-forward", "share", "expand", "compress", "plus", "minus", "asterisk", "exclamation-circle", "gift", "leaf", "fire", "eye", "eye-slash", "warning", "exclamation-triangle", "plane", "calendar", "random", "comment", "magnet", "chevron-up", "chevron-down", "retweet", "shopping-cart", "folder", "folder-open", "arrows-v", "arrows-h", "bar-chart-o", "bar-chart", "twitter-square", "facebook-square", "camera-retro", "key", "gears", "cogs", "comments", "thumbs-o-up", "thumbs-o-down", "star-half", "heart-o", "sign-out", "linkedin-square", "thumb-tack", "external-link", "sign-in", "trophy", "github-square", "upload", "lemon-o", "phone", "square-o", "bookmark-o", "phone-square", "twitter", "facebook", "github", "unlock", "credit-card", "rss", "hdd-o", "bullhorn", "bell", "certificate", "hand-o-right", "hand-o-left", "hand-o-up", "hand-o-down", "arrow-circle-left", "arrow-circle-right", "arrow-circle-up", "arrow-circle-down", "globe", "wrench", "tasks", "filter", "briefcase", "arrows-alt", "group", "users", "chain", "link", "cloud", "flask", "cut", "scissors", "copy", "files-o", "paperclip", "save", "floppy-o", "square", "navicon", "reorder", "bars", "list-ul", "list-ol", "strikethrough", "underline", "table", "magic", "truck", "pinterest", "pinterest-square", "google-plus-square", "google-plus", "money", "caret-down", "caret-up", "caret-left", "caret-right", "columns", "unsorted", "sort", "sort-down", "sort-desc", "sort-up", "sort-asc", "envelope", "linkedin", "rotate-left", "undo", "legal", "gavel", "dashboard", "tachometer", "comment-o", "comments-o", "flash", "bolt", "sitemap", "umbrella", "paste", "clipboard", "lightbulb-o", "exchange", "cloud-download", "cloud-upload", "user-md", "stethoscope", "suitcase", "bell-o", "coffee", "cutlery", "file-text-o", "building-o", "hospital-o", "ambulance", "medkit", "fighter-jet", "beer", "h-square", "plus-square", "angle-double-left", "angle-double-right", "angle-double-up", "angle-double-down", "angle-left", "angle-right", "angle-up", "angle-down", "desktop", "laptop", "tablet", "mobile-phone", "mobile", "circle-o", "quote-left", "quote-right", "spinner", "circle", "mail-reply", "reply", "github-alt", "folder-o", "folder-open-o", "smile-o", "frown-o", "meh-o", "gamepad", "keyboard-o", "flag-o", "flag-checkered", "terminal", "code", "mail-reply-all", "reply-all", "star-half-empty", "star-half-full", "star-half-o", "location-arrow", "crop", "code-fork", "unlink", "chain-broken", "question", "info", "exclamation", "superscript", "subscript", "eraser", "puzzle-piece", "microphone", "microphone-slash", "shield", "calendar-o", "fire-extinguisher", "rocket", "maxcdn", "chevron-circle-left", "chevron-circle-right", "chevron-circle-up", "chevron-circle-down", "html5", "css3", "anchor", "unlock-alt", "bullseye", "ellipsis-h", "ellipsis-v", "rss-square", "play-circle", "ticket", "minus-square", "minus-square-o", "level-up", "level-down", "check-square", "pencil-square", "external-link-square", "share-square", "compass", "toggle-down", "caret-square-o-down", "toggle-up", "caret-square-o-up", "toggle-right", "caret-square-o-right", "euro", "eur", "gbp", "dollar", "usd", "rupee", "inr", "cny", "rmb", "yen", "jpy", "ruble", "rouble", "rub", "won", "krw", "bitcoin", "btc", "file", "file-text", "sort-alpha-asc", "sort-alpha-desc", "sort-amount-asc", "sort-amount-desc", "sort-numeric-asc", "sort-numeric-desc", "thumbs-up", "thumbs-down", "youtube-square", "youtube", "xing", "xing-square", "youtube-play", "dropbox", "stack-overflow", "instagram", "flickr", "adn", "bitbucket", "bitbucket-square", "tumblr", "tumblr-square", "long-arrow-down", "long-arrow-up", "long-arrow-left", "long-arrow-right", "apple", "windows", "android", "linux", "dribbble", "skype", "foursquare", "trello", "female", "male", "gittip", "sun-o", "moon-o", "archive", "bug", "vk", "weibo", "renren", "pagelines", "stack-exchange", "arrow-circle-o-right", "arrow-circle-o-left", "toggle-left", "caret-square-o-left", "dot-circle-o", "wheelchair", "vimeo-square", "turkish-lira", "try", "plus-square-o", "space-shuttle", "slack", "envelope-square", "wordpress", "openid", "institution", "bank", "university", "mortar-board", "graduation-cap", "yahoo", "google", "reddit", "reddit-square", "stumbleupon-circle", "stumbleupon", "delicious", "digg", "pied-piper", "pied-piper-alt", "drupal", "joomla", "language", "fax", "building", "child", "paw", "spoon", "cube", "cubes", "behance", "behance-square", "steam", "steam-square", "recycle", "automobile", "car", "cab", "taxi", "tree", "spotify", "deviantart", "soundcloud", "database", "file-pdf-o", "file-word-o", "file-excel-o", "file-powerpoint-o", "file-photo-o", "file-picture-o", "file-image-o", "file-zip-o", "file-archive-o", "file-sound-o", "file-audio-o", "file-movie-o", "file-video-o", "file-code-o", "vine", "codepen", "jsfiddle", "life-bouy", "life-buoy", "life-saver", "support", "life-ring", "circle-o-notch", "ra", "rebel", "ge", "empire", "git-square", "git", "hacker-news", "tencent-weibo", "qq", "wechat", "weixin", "send", "paper-plane", "send-o", "paper-plane-o", "history", "circle-thin", "header", "paragraph", "sliders", "share-alt", "share-alt-square", "bomb", "soccer-ball-o", "futbol-o", "tty", "binoculars", "plug", "slideshare", "twitch", "yelp", "newspaper-o", "wifi", "calculator", "paypal", "google-wallet", "cc-visa", "cc-mastercard", "cc-discover", "cc-amex", "cc-paypal", "cc-stripe", "bell-slash", "bell-slash-o", "trash", "copyright", "at", "eyedropper", "paint-brush", "birthday-cake", "area-chart", "pie-chart", "line-chart", "lastfm", "lastfm-square", "toggle-off", "toggle-on", "bicycle", "bus", "ioxhost", "angellist", "cc", "shekel", "sheqel", "ils", "meanpath");
    }
    
    /*---------------------------------------------
        Admin Login Logo
    ---------------------------------------------*/
    function ts_admin_login_logo() {
      $admin_logo = ts_get_option( 'slupy_adminlogo' );
      if ( $admin_logo ) {
        $admin_logo = wp_get_attachment_image_src( $admin_logo, 'full' );
        echo '<style type="text/css">
                body.login div#login h1 a {
                    background-image: url("'.esc_url( $admin_logo[0] ).'");
                    padding-bottom: 70px;
                    width: auto;
                    background-size: 100%;
                }
                </style>';
      }
    }

  }
}
new THEMESAMA_FRAMEWORK;

?>