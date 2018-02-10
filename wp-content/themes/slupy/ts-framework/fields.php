<?php

/**
 * Themesama Framework Fields
 *
 * @access    public
 * @since     1.0
 */
class TS_FRAMEWORK_FIELDS
{

  /*---------------------------------------------
      Get Fields
  ---------------------------------------------*/
  public function getField( $args = array(), $echo = true ){

    $class_name = 'TS_FRAMEWORK_'.strtoupper($args['type']).'_FIELD';
    if( !isset( $args['field_name'] ) ){
        $args['field_name'] = $this->getFieldName($args['id']);
    }
    if( !isset( $args['field_value'] ) ){
        $args['field_value'] = ts_get_option($args['id']);
    }
    if( !isset( $args['desc'] ) ){
        $args['desc'] = '';
    }
    if( !isset( $args['depends'] ) ){
        $args['depends'] = '';
    }
    if( !isset( $args['class'] ) ){
        $args['class'] = '';
    }
    if( class_exists( $class_name ) ) {
      $field_class = new $class_name;
      
      if( $echo ) {
        echo $field_class->output($args);
      } else {
        return $field_class->output($args);
      }
    }

  }

  function getFieldName($id, $ex=''){
    return TS_OPTIONSNAME.'['.$id.']'.$ex;
  }

  function getFieldTitle($title){
    return '<h4 class="ts_field_title">'.$title.'</h4>';
  }

  function getFieldDesc($desc){
    return '<div class="ts_field_desc"><span>'.$desc.'<i class="fa fa-caret-right"></i></span><i class="fa fa-question-circle help_icon"></i></div>';
  }

  function getFieldContent($title = '', $desc = '', $type, $depends = ''){
    $attrs = '';
    if( $depends ){
      $attrs = ' data-depends-on="'.esc_attr( $depends ).'"';
    }
    $val = '<div '.$attrs.' class="ts_content_a_field ts_content_'.esc_attr( $type ).'">';

    if($title){
      $val.= $this->getFieldTitle($title);
    }
    if( $desc ){
      $val.= $this->getFieldDesc($desc);
    }
    
    return $val;
  }

  function getFieldMode($mode,$ex = '', $max_limit = 60, $min_limit = 11){

    $val_extra = '';
    switch ($mode) {
      case 'switch':
        if( $ex ){
          $titles = explode(':',$ex);
          $title_on = $titles[0];
          $title_off = $titles[1];
        }else{
          $title_on = __('ON',TS_TRANSLATE);
          $title_off = __('OFF',TS_TRANSLATE);
        }
        $val_extra = '<span class="ts_switch_button">
        <span class="ts_switch_on"><span>'.$title_on.'</span></span>
        <span class="ts_switch_off"><span>'.$title_off.'</span></span>
      </span>';
      break;
      case 'image':
        $val_extra = '<span class="ts_image_button"><img src="{image}" alt=""></span>';
      break;
      case 'target':
        $target_v = array('_blank','_self','_parent','_top');
        $val_extra = '<option value=""></option>';
        foreach ($target_v as $key => $value) {
          $val_extra .= '<option value="'.esc_attr( $value ).'" '.selected($ex, $value, false).'>'.esc_html( $value ).'</option>';
        }
      break;
      case 'font-size':
        $val_extra = '<option value="">'.__('font-size',TS_TRANSLATE).'</option>';
        for ($i=$min_limit; $i <= $max_limit ; $i++) {
          $val_extra .= '<option value="'.esc_attr( $i ).'px" '.selected($ex, $i.'px', false).'>'.esc_html( $i ).'px</option>';
        }
      break;
      case 'sidebar':
        // get the registered sidebars
        global $wp_registered_sidebars;
        $sidebars = array();
        foreach( $wp_registered_sidebars as $id=>$sidebar ) {
          $sidebars[ $id ] = $sidebar[ 'name' ];
        }
        // has sidebars
        if( count($sidebars) ) {
          $val_extra .= '<option value="">' . __('Choose a Sidebar',TS_TRANSLATE) . '</option>';
          foreach ( $sidebars as $id => $sidebar ) {
            $val_extra .= '<option value="' . esc_attr( $id ) . '"' . selected( $ex, $id, false ) . '>' . esc_attr( $sidebar ) . '</option>';
          }
        }else {
          $val_extra .= '<option value="">' . __( 'No Sidebars', TS_TRANSLATE ) . '</option>';
        }
      break;
      case 'pages':
        //get all pages
        $args_query = array(
          'post_type'       => array('page'),
          'posts_per_page'  => -1,
          'orderby'         => 'title',
          'order'           => 'ASC',
          'post_status'     => 'any'
        );
        $all_pages = get_posts($args_query);
        
        if ( is_array( $all_pages ) && ! empty( $all_pages ) ){
          $val_extra .= '<option value="">' . __( 'Choose a Page', TS_TRANSLATE ) . '</option>';
          foreach( $all_pages as $a_post ) {
            $val_extra .= '<option value="' . esc_attr( $a_post->ID ) . '"' . selected( $ex, $a_post->ID, false ) . '>' . esc_attr( $a_post->post_title ) . '</option>';
          }
        }else{
          $val_extra .= '<option value="">' . __( 'No Pages Found', TS_TRANSLATE ) . '</option>';
        }
      break;
    }
    return $val_extra;
  }

}

//Load Framework Fields
$all_framework_fields = array('heading','description','group','radio','checkbox','select','upload','icon','font','colorpicker','textarea','text','importexport','background');
foreach ($all_framework_fields as $key => $field_name) {
  load_template(TS_FRAMEWORK.'/fields/'.$field_name.'.php');
}

?>