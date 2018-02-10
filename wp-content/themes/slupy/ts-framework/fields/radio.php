<?php

/**
 * Themesama Framework Radio Field
 *
 * @access    public
 * @since     1.0
 */
class TS_FRAMEWORK_RADIO_FIELD extends TS_FRAMEWORK_FIELDS
{
  
  //Radio Field
  function output( $args = array() ){
    
    extract( $args );

    $val = $this->getFieldContent($title,$desc,$type,$depends);

    $val_extra = '';
    $field_class = esc_attr($class);

    if( isset($mode) ){
      switch ($mode) {
        case 'switch':
          $field_class .= ' ts_image_checkbox';
          if( isset($title_switch) ){
            $field_titles = explode(':', $title_switch);
          }
          
          $val.='<div class="ts_radio_group ts_radio_switch">';
            $val .= '<label class="radio_switch_on">
              <input class="'.esc_attr( $field_class ).'" type="radio" value="on" name="'.esc_attr( $field_name ).'" '.checked('on', $field_value, false).'>
              <span>'.(isset($field_titles[0]) ? esc_html( $field_titles[0] ) : __('ON',TS_TRANSLATE) ).'</span>
            </label>
            <label class="radio_switch_default">
              <input class="'.esc_attr( $field_class ).'" type="radio" value="" name="'.esc_attr( $field_name ).'" '.checked('', $field_value, false).'>
              <span>'.(isset($field_titles[1]) ? esc_html( $field_titles[1] ) : __('DEFAULT',TS_TRANSLATE) ).'</span>
            </label>
            <label class="radio_switch_off">
              <input class="'.esc_attr( $field_class ).'" type="radio" value="off" name="'.esc_attr( $field_name ).'" '.checked('off',$field_value,false).'>
              <span>'.(isset($field_titles[2]) ? esc_html( $field_titles[2] ) : __('OFF',TS_TRANSLATE) ).'</span>
            </label>';
          $val.='</div><div class="clearfix"></div>';

        break;
        case 'image':
          $field_class .= ' ts_image_checkbox';
        break;
      }
      $val_extra = $this->getFieldMode($mode);
    }

    if( isset($options) && is_array($options) ){
      $val.='<div class="ts_radio_group">';
      foreach ($options as $key => $a_radio) {
        if( isset($mode) && $mode == 'image' ){
          $val_extra_clone = $val_extra;
          $val_extra = str_replace('{image}', $a_radio['image'], $val_extra);
        }
        $val .= '<label>
          <span class="'.esc_attr( $field_class ).'">'.esc_html( $a_radio['title'] ).'</span>
          <input class="'.esc_attr( $field_class ).'" type="radio" value="'.esc_attr( $a_radio['value'] ).'" name="'.esc_attr( $field_name ).'" '.checked($a_radio['value'], $field_value, false).'>
          '.$val_extra.'
        </label>';
        $val_extra = isset($val_extra_clone) ? $val_extra_clone : $val_extra;
      }
      $val.='</div>';
    }

    return $val.'</div>';
      
  }
  
}

?>