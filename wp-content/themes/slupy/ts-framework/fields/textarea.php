<?php

/**
 * Themesama Framework Textarea Field
 *
 * @access    public
 * @since     1.0
 */
class TS_FRAMEWORK_TEXTAREA_FIELD extends TS_FRAMEWORK_FIELDS
{

  //Textarea Field
  function output( $args = array() ){
    
    extract( $args );

      $val = $this->getFieldContent($title,$desc,$type,$depends);
      $field_class = $class;

      $attrs = isset($rows) ? ' rows="'.esc_attr( $rows ).'"' : ' rows="5"';
      $attrs.= ' class="'.esc_attr( $field_class ).'"';
      $attrs.= isset($depend_id) ? ' data-depend-id="'.esc_attr( $depend_id ).'"' : '';

      if( isset($multi_lang) && function_exists('icl_get_languages') && defined('ICL_LANGUAGE_CODE') ){
        $all_textarea = '';
        $val .= '<ul class="lang_tab">';
        $all_lang_details = icl_get_languages('link_empty_to=str');
      foreach ($all_lang_details as $key => $a_lang) {
        if( is_array($field_value) ){
          $field_value_ex = $field_value[$a_lang['language_code']];
        }else{
          $field_value_ex = $field_value;
        }
        $val .= '<li><a data-lang="'.esc_attr( $a_lang['language_code'] ).'" href="#" class="'.($a_lang['active'] == '1' ? 'ts_active' : '').'">'.esc_html( $a_lang['native_name'] ).'</a></li>';
          $all_textarea .= '<label class="'.($a_lang['active'] == '1' ? '' : 'hidden').' lang_'.esc_attr( $a_lang['language_code'] ).'">
            <textarea '.$attrs.' name="'.esc_attr( $field_name ).'['.esc_attr( $a_lang['language_code'] ).']">'.esc_textarea( $field_value_ex ).'</textarea>
          </label>';
        }
        $val .= '</ul>';
      $val.= $all_textarea;

      }else{
        if( is_array($field_value) ){ $field_value = ''; }

        if( defined('TS_PLUGIN') ){

          $textarea_id = 'shortcode_support'.rand();
          $val .= '<a class="themesama_shortcode-button button" href="#" data-inputid="'.esc_attr( $textarea_id ).'">
              <span class="themesama_plus_icon"></span>'.__('Add Shortcode',TS_TRANSLATE).'
            </a>';

        }


        $val .= '<label>
          <textarea '.$attrs.' name="'.esc_attr( $field_name ).'" '.(isset($textarea_id) ? 'id="'.esc_attr( $textarea_id ).'"' : '').'>'.esc_textarea( $field_value ).'</textarea>
        </label>';
    }
      
      return $val.'</div>';

  }

}

?>