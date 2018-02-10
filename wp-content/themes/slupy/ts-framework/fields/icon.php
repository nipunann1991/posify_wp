<?php

/**
 * Themesama Framework Icon Field
 *
 * @access    public
 * @since     1.0
 */
class TS_FRAMEWORK_ICON_FIELD extends TS_FRAMEWORK_FIELDS
{
  
  //Icon Picker Field
  function output( $args = array() ){
    
    extract( $args );
    
    $val = $this->getFieldContent($title,$desc,$type,$depends);   

      $field_class = $class;
      $field_class.= ' hidden';

      $attrs = ' class="'.esc_attr( $field_class ).'"';

      $val .= '<label>
        <input type="text" '.$attrs.' name="'.esc_attr( $field_name ).'" value="'.esc_attr( $field_value ).'">
      </label>';

      $val .= '<div>
        <a href="#" class="icon_toggle button-large button-primary">
        '.__('Choose Icon',TS_TRANSLATE).'
        <span class="current_icon">'.($field_value ? '<i class="fa fa-'.esc_attr( $field_value ).'"></i>' : '').'</span></a>
        <div class="icon_content hidden">
          <input type="text" name="filter_icons" value="'.esc_attr__('Filter Icons',TS_TRANSLATE).'">
          <div class="all_icons"></div>
        </div>
      </div>';
      
      return $val.'</div>';

  }
  
}

?>