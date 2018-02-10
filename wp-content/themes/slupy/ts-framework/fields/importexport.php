<?php

/**
* 
*/
class TS_FRAMEWORK_IMPORT_EXPORT_FIELD extends TS_FRAMEWORK_FIELDS
{
  function output( $args = array() ){

    $val = '';

    //Font Size Field
    $a_subfield = array( 
      'type' => 'textarea','id' => '','title' => __('Export Settings',TS_TRANSLATE),'value' => '', 'rows' => '10',
      'field_name'  => 'ts_framework_export',
      'field_value' => serialize(get_option(TS_OPTIONSNAME)),
      'desc'      => __('Copy & Import your another slupy wordpress theme',TS_TRANSLATE)
    );

    $val .= $this->getField($a_subfield, false);

    //Font Size Field
    $a_subfield = array( 
      'type' => 'textarea','id' => '','title' => __('Import Settings',TS_TRANSLATE),'value' => '', 'rows' => '10',
      'field_name'  => 'ts_framework_import_val',
      'field_value' => '',
      'desc'      => __('Paste your another slupy wordpress theme export text',TS_TRANSLATE)
    );
    
    $val .= $this->getField($a_subfield, false);

    $val .= '<span class="ts_import_reset_buttons" data-alert="'.esc_attr__('Are you sure?',TS_TRANSLATE).'">'.
    get_submit_button(__('Reset Settings',TS_TRANSLATE),'primary large ts_option_button','ts_framework_reset','').
    get_submit_button(__('Import New Settings',TS_TRANSLATE),'primary large','ts_framework_import',false).'</span>';

    return $val;

  }
}

?>