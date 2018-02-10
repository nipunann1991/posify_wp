<?php

/**
 * Themesama Framework Select Field
 *
 * @access    public
 * @since     1.0
 */
class TS_FRAMEWORK_HEADING_FIELD extends TS_FRAMEWORK_FIELDS
{
  
  //Select Field
  function output( $args = array() ){
    
    extract( $args );

      $val = $this->getFieldContent($title,$desc,$type,$depends);

      $val_extra = '';
      $field_class = $class;

      $attrs = ' class="'.esc_attr( $field_class ).'"';

      for ($i=1; $i < 7; $i++) {

      $val_extra = $this->getFieldMode('font-size',$field_value['h'.$i]);

      $val .= '<label class="type-heading-size"><h4 class="ts_field_title">H'.esc_html( $i ).'</h4>
        <select '.$attrs.' name="'.esc_attr( $field_name ).'[h'.$i.']">';
        $val .= $val_extra;
        if( isset($options) && is_array($options) ){
          foreach ($options as $key => $a_option) {
            $val .= '<option '.($a_option['value'] == $field_value['h'.$i] ? 'selected="selected"' : '').' value="'.esc_attr( $a_option['value'] ).'">'.esc_html( $a_option['title'] ).'</option>';
          }
        }
      $val.='</select>
      </label>';

      }
      
      return $val.'<div class="clearfix"></div></div>';

  }
  
}

?>