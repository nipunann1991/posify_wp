<?php

/**
 * Themesama Framework Checkbox Field
 *
 * @access    public
 * @since     1.0
 */
class TS_FRAMEWORK_CHECKBOX_FIELD extends TS_FRAMEWORK_FIELDS
{
  
  //Checkbox Field
  function output( $args = array() ){
    
    extract( $args );

    $val = $this->getFieldContent($title,$desc,$type,$depends);

    $title_switch = isset($title_switch) ? $title_switch : '';
    $mode = isset($mode) ? $mode : '';

    $val_extra = '';
    $field_class = esc_attr($class);

    if( isset($choose) && $choose == 'single' ){
      $field_class .= ' ts_single_checkbox';
    }

    if( isset($mode) ){
      switch ($mode) {
        case 'switch':
          $field_class .= ' ts_switch_checkbox';
        break;
        case 'image':
          $field_class .= ' ts_image_checkbox';
        break;
      }
      $val_extra = $this->getFieldMode($mode,$title_switch);
    }

    if( isset($options) && is_array($options) ){
      $val.='<div class="ts_checkbox_group">';
      foreach ($options as $key => $a_checkbox) {
        $item_checked = '';
        $attrs = isset($a_checkbox['depend_id']) ? ' data-depend-id="'.esc_attr( $a_checkbox['depend_id'] ).'"' : '';
        if(isset($choose) && $choose == 'single' && $field_value == $a_checkbox['id']){
          $item_checked = ' checked="checked"';
        }else if( !empty($field_value[$a_checkbox['id']]) && empty($choose) ){
          $item_checked = ' checked="checked"';
        }

        if( isset($mode) && $mode == 'image' ){
          $val_extra_clone = $val_extra;
          $val_extra = str_replace('{image}', $a_checkbox['image'], $val_extra);
        }

        $ex_val = '';
        $item_name = '';
        if( !isset($choose) ){
          $item_name = $field_name.'['.$a_checkbox['id'].']';
        }else if( isset($choose) && $choose == 'single' ){
          $ex_val = ' value="'.esc_attr( $a_checkbox['id'] ).'"';
          $item_name = $field_name;
        }

        $val .= '<label class="type_'.esc_attr( $mode ).'">'.($mode == 'switch' ? $this->getFieldTitle($a_checkbox['title']).'<div class="clearfix"></div>' : '').
          '<input '.$attrs.' '.$ex_val.' class="'.esc_attr( $field_class ).'" type="checkbox" name="'.esc_attr( $item_name ).'"'.$item_checked.'>
          '.$val_extra.'
        </label>';
        $val_extra = isset($val_extra_clone) ? $val_extra_clone : $val_extra;
      }
      $val.='</div><div class="clearfix"></div>';
    }else{

      $attrs = ' class="'.esc_attr( $field_class ).'"';
        $attrs.= isset($depend_id) ? ' data-depend-id="'.esc_attr( $depend_id ).'"' : '';

      $val .= '<label>
        <input '.$attrs.' type="checkbox" name="'.esc_attr( $field_name ).'"'.($field_value ? ' checked="checked"' : '').'>
        '.$val_extra.'
      </label>';

    }

    return $val.'</div>';
      
  }
  
}

?>