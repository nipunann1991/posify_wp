<?php

/**
 * Themesama Framework Group Field
 *
 * @access    public
 * @since     1.0
 */
class TS_FRAMEWORK_GROUP_FIELD extends TS_FRAMEWORK_FIELDS
{
  
  //Group Field
  function output( $args = array() ){
      
      extract( $args );
      $big_key = 0;
      $val = $this->getFieldContent($title,$desc,$type,$depends);
      $remove_button = '<a class="delete_group_item" href="#">'.__('Remove',TS_TRANSLATE).'</a>';

    $val .= '<div class="ts_field_group">';
    if( is_array($field_value) ){
      foreach ($field_value as $key => $a_field) {
        if( intval($key) > $big_key ){ $big_key = intval($key); }
        $title_control = !empty( $a_field['title'] ) ? $a_field['title'] : __('Item',TS_TRANSLATE);
        $title_control = is_array($title_control) && defined('ICL_LANGUAGE_CODE') ? $title_control[ICL_LANGUAGE_CODE] : $title_control;
        $val .= '<div class="a_group"><span><span class="a_item_title" data-placeholder="'.esc_attr( $title_control ).'">'.$title_control.'</span><i class="fa"></i></span><div class="a_group_content">';
        foreach ($options as $key2 => $a_subfield) {
          $a_subfield['field_name'] = $this->getFieldName($id,'['.$key.']['.$a_subfield['id'].']');
          if( isset($field_value[$key][$a_subfield['id']]) ){
            $a_subfield['field_value'] = $field_value[$key][$a_subfield['id']];
          }else{
            $a_subfield['field_value'] = '';
          }
          
          $val .= $this->getField($a_subfield, false);
        }
        $val .= $remove_button;
        $val .= '</div></div>';
      }
    }
    $val .= '</div>';

    $val .= '<a href="#" class="add_group_item button-primary">Add New Item</a>';

    $val .= '<div class="duplicate_group" data-id="'.esc_attr( $big_key ).'">';
    $title_control = __('New Item',TS_TRANSLATE);
    $val .= '<div class="a_group"><span><span class="a_item_title" data-placeholder="'.esc_attr( $title_control ).'">'.$title_control.'</span><i class="fa"></i></span><div class="a_group_content">';
    $val_ex = '';
    foreach ($options as $key => $a_field) {
      $a_field['field_name'] = $this->getFieldName($id,'[{id}]['.$a_field['id'].']');
      $a_field['field_value'] = $a_field['value'];
      
      $val_ex .= $this->getField($a_field, false);
    }
    $val .= str_replace(TS_OPTIONSNAME, 'fake_'.TS_OPTIONSNAME, $val_ex);
    $val .= $remove_button;
    $val .= '</div></div></div><div class="clearfix"></div>';

    return $val.'</div>';
    
  }
  
}

?>