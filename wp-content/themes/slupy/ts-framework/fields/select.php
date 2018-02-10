<?php

/**
 * Themesama Framework Select Field
 *
 * @access    public
 * @since     1.0
 */
class TS_FRAMEWORK_SELECT_FIELD extends TS_FRAMEWORK_FIELDS
{
  
  //Select Field
  function output( $args = array() ){
    
    extract( $args );

      $val = $this->getFieldContent($title,$desc,$type,$depends);

      $val_extra = '';
      $field_class = $class;

      if( !isset($attrs) ){
        $attrs = '';
      }

      $attrs .= ' class="'.esc_attr( $field_class ).'"';
      $attrs .= isset($depend_id) ? ' data-depend-id="'.esc_attr( $depend_id ).'"' : '';

      $max_limit = !empty($max_limit) ? $max_limit : 60;
      $min_limit = !empty($min_limit) ? $min_limit : 11;

      if( isset( $mode ) ){
        $val_extra = $this->getFieldMode($mode, $field_value, $max_limit, $min_limit );
      }

      $val .= '<label>
        <select '.$attrs.' name="'.esc_attr( $field_name ).'">';
        $val .= $val_extra;
        if( isset($options) && is_array($options) ){
          foreach ($options as $key => $a_option) {
            $val .= '<option '.selected( $a_option['value'], $field_value, false ).' value="'.esc_attr( $a_option['value'] ).'">'.esc_html( $a_option['title'] ).'</option>';
          }
        }
      $val.='</select>
      </label>';
      
      return $val.'</div>';

  }
  
}

?>