<?php

/**
 * Themesama Framework Upload Field
 *
 * @access    public
 * @since     1.0
 */
class TS_FRAMEWORK_UPLOAD_FIELD extends TS_FRAMEWORK_FIELDS
{
  
  //Upload Field
  function output( $args = array() ){
    
    extract( $args );

      $val = $this->getFieldContent($title,$desc,$type,$depends);

      $field_class = esc_attr($class);
      $field_class.= isset($getid) && $getid == 'on' ? ' hidden' : '';

      $attrs = ' class="ts-upload '.esc_attr( $field_class ).'"';
      $attrs.= isset($depend_id) ? ' data-depend-id="'.esc_attr( $depend_id ).'"' : '';

      $attrs_button = isset($mediabox_title) ? ' data-uploadertitle="'.esc_attr( $mediabox_title ).'"' : ' data-uploadertitle="'.esc_attr__('Choose a file',TS_TRANSLATE).'"';
      $attrs_button.= isset($button_title) ? ' data-uploaderbutton="'.esc_attr( $button_title ).'"' : ' data-uploaderbutton="'.esc_attr__('Insert',TS_TRANSLATE).'"';
      $attrs_button.= isset($filetype) ? ' data-filetype="'.esc_attr( $filetype ).'"' : ' data-filetype="image"';
      $attrs_button.= isset($getid) ? ' data-getid="'.esc_attr( $getid ).'"' : ' data-getid=""';

      $image_src = ( isset($getid) && $getid == 'on' && !empty( $field_value ) ) ? wp_get_attachment_image_src( $field_value ) : '';

      $val .= '<span class="live_preview">
      '.( !empty( $image_src[0] ) ? '<img src="'.esc_url( $image_src[0] ).'" alt="">' : '' ).'
      </span><span>
        <input type="text" '.$attrs.' name="'.esc_attr( $field_name ).'" value="'.esc_attr( $field_value ).'">
        <a href="#" '.$attrs_button.' class="ts_upload_button button-primary">'.__('Upload',TS_TRANSLATE).'</a>
        <a href="#" class="ts_remove_button button-primary'.( ( empty($field_value) || empty($getid) ) ? ' ts_hidden' : '' ).'">'.__('Remove',TS_TRANSLATE).'</a>
      </span>';
       
      return $val.'</div>';

  }
  
}

?>