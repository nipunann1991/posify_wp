<?php

/**
 * Themesama Framework Group Field
 *
 * @access    public
 * @since     1.0
 */
class TS_FRAMEWORK_DESCRIPTION_FIELD extends TS_FRAMEWORK_FIELDS
{
  
  //Description Field
  function output( $args = array() ){
      
      extract( $args );

      $val = $this->getFieldContent($title,$desc,$type,$depends);
      
      $val.= $desc_content;

    return $val.'</div>';
    
  }
  
}

?>