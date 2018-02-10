<?php
/**
 * Custom Settings Fields.
 *
 * http://codex.wordpress.org/Function_Reference/do_settings_fields
 *
 * @access    public
 * @since     1.0
 */

function ts_framework_do_settings_fields($page, $section) {

  global $wp_settings_fields;

  if ( ! isset( $wp_settings_fields[$page][$section] ) )
    return;

  foreach ( (array) $wp_settings_fields[$page][$section] as $field ) {
    call_user_func($field['callback'], $field['args']);
  }

}

/**
 * Custom Settings Sections.
 *
 * http://codex.wordpress.org/Function_Reference/do_settings_sections
 *
 * @access    public
 * @since     1.0
 */

function ts_framework_do_settings_sections( $page ) {

  global $wp_settings_sections, $wp_settings_fields;

  if ( ! isset( $wp_settings_sections[$page] ) )
    return;

  foreach ( (array) $wp_settings_sections[$page] as $section ) {

    if ( $section['callback'] )
        call_user_func( $section['callback'], $section );

    if ( ! isset( $wp_settings_fields ) || !isset( $wp_settings_fields[$page] ) || !isset( $wp_settings_fields[$page][$section['id']] ) )
        continue;

    echo '<div class="tab_content tab_'.esc_attr( $section['id'] ).'">';
      ts_framework_do_settings_fields( $page, $section['id'] );
    echo '</div>';

  }

}

/**
 * Get Option.
 *
 * Helper function to return the option value.
 *
 * @param     string    The option ID.
 * @return    mixed
 *
 * @access    public
 * @since     1.0
 */

if ( ! function_exists( 'ts_get_option' ) ) {

  function ts_get_option( $option_id ) {
    
    global $TS_OPTIONS;
    
    if( !isset($TS_OPTIONS) ){
      $TS_OPTIONS = get_option( TS_OPTIONSNAME );
      
      if( !is_array($TS_OPTIONS)  ){
        $TS_OPTIONS = ts_check_default();
      }
    }

    do_action('slupy_framework_options');

    if ( !empty( $TS_OPTIONS[$option_id] ) ) {
      return $TS_OPTIONS[$option_id];
    }else{
      return '';
    }
    
  }
  
}

/**
 * Framework Default Values
 *
 * @access    public
 * @since     1.0
 */

if( !function_exists('ts_check_default') ){

  function ts_check_default(){
    $all_options = get_ts_framework_options();
    $new_options = array();
    $default_options = array(
      'slupy_sociallinks' => array(
        '1' => array(
          'title'       => 'Facebook',
          'icon'        => 'facebook',
          'url'         => '#',
          'target'      => ''
        ),
        '2' => array(
          'title'       => 'Twitter',
          'icon'        => 'twitter',
          'url'         => '#',
          'target'      => ''
        )
      ),
      'headings_font'   => array(
        'font-family'   => 'Open Sans',
        'color'         => '#88949b',
        'variants'      => 'regular',
        'all-variants'  => '300,300italic,regular,italic,600,600italic,700,700italic,800,800italic',
        'all-subsets'   => 'vietnamese,latin,cyrillic-ext,greek,latin-ext,cyrillic,greek-ext'
      ),
      'mainmenu_font'   => array(
        'font-family'   => 'Open Sans',
        'font-size'     => '14px',
        'color'         => '#88949b',
        'variants'      => 'regular',
        'all-variants'  => '300,300italic,regular,italic,600,600italic,700,700italic,800,800italic',
        'all-subsets'   => 'vietnamese,latin,cyrillic-ext,greek,latin-ext,cyrillic,greek-ext'
      ),
      'submenu_font'    => array(
        'font-family'   => 'Open Sans',
        'font-size'     => '12px',
        'color'         => '#88949b',
        'variants'      => 'regular',
        'all-variants'  => '300,300italic,regular,italic,600,600italic,700,700italic,800,800italic',
        'all-subsets'   => 'vietnamese,latin,cyrillic-ext,greek,latin-ext,cyrillic,greek-ext'
      ),
      'body_font'       => array(
        'font-family'   => 'Arial',
        'font-size'     => '14px',
        'color'         => '#88949b',
        'variants'      => 'normal',
        'all-variants'  => '400,300,600',
      ),
      'heading_size'    => array(
        'h1' => '36px',
        'h2' => '30px',
        'h3' => '24px',
        'h4' => '18px',
        'h5' => '14px',
        'h6' => '12px'
      )
    );

    foreach ($all_options as $key => $sections) {
      foreach ($sections['tabs'] as $key2 => $tabs) {
        foreach ($tabs['options'] as $key3 => $options) {

          $t = $options['type'];
          $c = isset($options['choose']) ? $options['choose'] : '';
          $v = $options['value'];
          $id = $options['id'];

          if( ($t != 'checkbox' && $t != 'group' && $t != 'font') || $t == 'checkbox' && !empty( $v ) ){
            $new_options[$id] = $v;
          }else if( $t == 'checkbox' && isset($options['options']) && is_array($options['options']) ){

            foreach ( $options['options'] as $key4 => $sub_options ) {

              if( $c == 'single' && $sub_options['value'] == $sub_options['id']  ){
                $new_options[$id] = $sub_options['value'];
              }else if( !empty( $sub_options['value'] ) ){
                $new_options[$id][$sub_options['id']] = $sub_options['value'];
              }

            }
          }
        }
      }
    }

    update_option( TS_OPTIONSNAME, array_merge($new_options,$default_options) );

    return get_option( TS_OPTIONSNAME );
  }

}
?>