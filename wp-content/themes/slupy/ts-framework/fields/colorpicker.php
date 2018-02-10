<?php

/**
 * Themesama Framework Color Picker Field
 *
 * @access    public
 * @since     1.0
 */
class TS_FRAMEWORK_COLORPICKER_FIELD extends TS_FRAMEWORK_FIELDS
{
  
  //Color Picker Field
  function output( $args = array() ){
    
    extract( $args );

      $val = $this->getFieldContent($title,$desc,$type,$depends);

      $field_class = $class;
      $field_class.= ' ts_color_picker';

      $attrs = ' class="'.esc_attr( $field_class ).'"';
      $attrs.= isset($color) ? ' data-default-color="'.esc_attr( $color ).'"' : '';
      $attrs.= isset($depend_id) ? ' data-depend-id="'.esc_attr( $depend_id ).'"' : '';

      $val .= '<input type="text" '.$attrs.' name="'.esc_attr( $field_name ).'" value="'.esc_attr( $field_value ).'">';
      
      return $val.'</div>';

  }
  
}

?>