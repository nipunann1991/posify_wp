<?php

/**
 * Themesama Framework Background Field
 *
 * @access    public
 * @since     1.0
 */
class TS_FRAMEWORK_BACKGROUND_FIELD extends TS_FRAMEWORK_FIELDS
{
  
  //Upload Field
  function output( $args = array() ){
    
    extract( $args );

      $val = $this->getFieldContent($title, $desc, $type, $depends);

      $field_class = $class;

      $attrs = ' class="ts-upload '.esc_attr( $field_class ).'"';
      $attrs.= isset($depend_id) ? ' data-depend-id="'.esc_attr( $depend_id ).'"' : '';

      $attrs_button = isset($mediabox_title) ? ' data-uploadertitle="'.esc_attr( $mediabox_title ).'"' : ' data-uploadertitle="'.esc_attr__('Choose a file',TS_TRANSLATE).'"';
      $attrs_button.= isset($button_title) ? ' data-uploaderbutton="'.esc_attr( $button_title ).'"' : ' data-uploaderbutton="'.esc_attr__('Insert',TS_TRANSLATE).'"';
      $attrs_button.= isset($filetype) ? ' data-filetype="'.esc_attr( $filetype ).'"' : ' data-filetype="image"';

      $val .= '
      <label>
        <input type="text" '.$attrs.' name="'.esc_attr( $field_name ).'[image]" value="'.(isset($field_value['image']) ? esc_attr( $field_value['image'] ) : '').'">
        <a href="#" '.$attrs_button.' class="ts_upload_button button-primary">'.__('Upload',TS_TRANSLATE).'</a>
      </label>';

      $bg_fields = array();
      $bg_fields['repeat'] = array( 'background-repeat','no-repeat','repeat','repeat-x','repeat-y','inherit' );
      $bg_fields['attachment'] = array( 'background-attachment','fixed','scroll','inherit' );
      $bg_fields['position'] = array( 'background-position','left top','left center','left bottom', 'center top', 'center center', 'center bottom', 'right top', 'right center', 'right bottom');
      
    $bg_fields_output = '';
      foreach ($bg_fields as $key => $a_select) {
        $bg_fields_output .= '<select name="'.esc_attr( $field_name ).'['.esc_attr( $key ).']" class="">';
        $f_r = isset($field_value[$key]) ? $field_value[$key] : '';
        foreach ($a_select as $key2 => $a_option) {
          $bg_fields_output .= '<option value="'.($key2 != 0 ? esc_attr( $a_option ) : '').'" '.selected($a_option, $f_r, false).'>'.esc_html( $a_option ).'</option>';
        }
        $bg_fields_output .= '</select>';
      }

      $val .= '<div class="clearfix"></div>'.$bg_fields_output;

      if( !isset($disable_color) ){
        $val .= '<input type="text" class="ts_color_picker" name="'.esc_attr( $field_name ).'[color]" value="'.(isset($field_value['color']) ? esc_attr( $field_value['color'] ) : '').'">';
      }
       
      return $val.'</div>';

  }
  
}

?>