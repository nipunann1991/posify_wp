<?php

/**
 * Themesama Framework Typography Field
 *
 * @access    public
 * @since     1.0
 */
class TS_FRAMEWORK_FONT_FIELD extends TS_FRAMEWORK_FIELDS
{
  
  //Font Picker Field
  function output( $args = array() ){
    
    extract( $args );

      $val = $this->getFieldContent($title,$desc,$type,$depends);

      $standard_fonts = apply_filters('ts_standard_fonts', array('Arial','Georgia','Helvetica','Palatino','Tahoma','Times New Roman','Trebuchet','Verdana'));
      $standard_fonts_op = '';
      foreach ($standard_fonts as $key => $value) {
        $standard_fonts_op .= '<option value="'.esc_attr( $value ).'" data-subsets="" data-variants="400,300,600">'.esc_html( $value ).'</option>';
      }


      $field_class = $class;

      //control fields
      $field_allsubsets = isset($field_value['all-subsets']) ? $field_value['all-subsets'] : '';
      $field_allvariants = isset($field_value['all-variants']) ? $field_value['all-variants'] : '';
      $font_family = isset($field_value['font-family']) ? $field_value['font-family'] : '';
      $field_value['font-size'] = isset($field_value['font-size']) ? $field_value['font-size'] : '';
      $field_value['color'] = isset($field_value['color']) ? $field_value['color'] : '';
      $field_subsets = isset($field_value['subsets']) && is_array($field_value['subsets']) ? $field_value['subsets'] : array();
      $field_variants = isset($field_value['variants']) ? $field_value['variants'] : '';

      $attrs = ' class="'.esc_attr( $field_class ).'"';

      //Font Family Field
      $val .= '<select name="'.esc_attr( $this->getFieldName($id,'[font-family]') ).'" class="select_google_font chosen-select">
        '.$standard_fonts_op.'
        '.( $font_family ? '<option data-subsets="'.esc_attr( $field_allsubsets ).'" data-variants="'.esc_attr( $field_allvariants ).'" value="'.esc_attr( $font_family ).'" selected="selected">'.esc_html( $font_family ).'</option>' : '' ).'
      </select>';

      $max_limit = !empty($max_limit) ? $max_limit : 60;
      $min_limit = !empty($min_limit) ? $min_limit : 11;

      if( !isset($font_size) ){
        //Font Size Field
        $a_subfield = array( 
          'mode' => 'font-size', 'type' => 'select','id' => 'font-size','title' => '','value' => '',
          'field_name'  => $this->getFieldName($id,'[font-size]'),
          'field_value' => $field_value['font-size'],
          'max_limit'   => $max_limit,
          'min_limit'   => $min_limit
        );
        $val .= $this->getField($a_subfield ,false);
      }

      //variants
      $val .= '<select data-placeholder="'.esc_attr__('font-weight',TS_TRANSLATE).'" class="chosen-select font_variants" name="'.esc_attr( $this->getFieldName($id,'[variants]') ).'" '.( empty( $field_allvariants ) ? ' class="hidden"' : '').'>';
        if( isset($field_value['all-variants']) ){
          foreach (explode(',',$field_allvariants) as $key => $value) {
            $ex = '';
            if($value == $field_variants){
              $ex = ' selected="selected"';
            }
            $val .= '<option value="'.esc_attr( $value ).'"'.$ex.'>'.esc_html( $value ).'</option>';
          }
        }
      $val .= '</select>';

      //Color Picker Field
      $a_subfield = array( 
        'mode' => 'color','type' => 'colorpicker','id' => 'color','title' => '','value' => '',
        'field_name'  => $this->getFieldName($id,'[color]'),
        'field_value' => $field_value['color']
      );

      $val .= $this->getField($a_subfield, false);

      $val .= '<input class="all_subsets" value="'.esc_attr( $field_allsubsets ).'" type="hidden" name="'.esc_attr( $this->getFieldName($id,'[all-subsets]') ).'">';
      $val .= '<input class="all_variants" value="'.esc_attr( $field_allvariants ).'" type="hidden" name="'.esc_attr( $this->getFieldName($id,'[all-variants]') ).'">';
      $val .= '<div class="clearfix"></div>';
      return $val.'</div>';

  }
  
}

?>