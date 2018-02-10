<?php
/**
 * Themesama Metabox
 *
 * @access    public
 * @since     1.0
 */
if( !class_exists('THEMESAMA_FRAMEWORK_METABOX') )
{
  class THEMESAMA_FRAMEWORK_METABOX extends TS_FRAMEWORK_FIELDS
  {

    public $themesama_metabox_fields = array();

    public function __construct()
    {
      $this->themesama_metabox_fields = get_ts_metabox_options();
      $this->getAction( 'admin_init', 'ts_admin_init' );
      $this->getAction( 'save_post', 'ts_save_meta_boxes' );
    }

    public function getAction($action,$function_name){
      add_action( $action, array($this, $function_name ));
    }

    public function ts_admin_init(){
      $this->getAction( 'add_meta_boxes', 'ts_add_meta_boxes_post' );
    }

    public function ts_add_meta_boxes_post($page){
      
      foreach ($this->themesama_metabox_fields as $key => $a_metabox) {
        
        extract( $a_metabox );
        add_meta_box($id, $title, array( $this, 'ts_meta_box_content' ), $post_type, $context, $priority,$tabs);
      
      }

    }

    /*---------------------------------------------
      Metabox Save Operation
    ---------------------------------------------*/
    public function ts_save_meta_boxes( $post_id ){

      $nonce = isset($_POST['themesama_custom_meta_boxes_nonce']) ? $_POST['themesama_custom_meta_boxes_nonce'] : '';

      if ( ( isset($_POST['post_type']) && 'page' != $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) ) || ( isset($_POST['post_type']) &&'page' == $_POST['post_type'] && !current_user_can( 'edit_page', $post_id ) ) || ! wp_verify_nonce( $nonce, 'themesama_custom_meta_boxes' ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ){
        return $post_id;
      }

      /* OK, its safe for us to save the data now. */
      $new_val = array();
      foreach ($this->themesama_metabox_fields as $key => $a_metabox) {
                
        if( isset($_POST['_'.$a_metabox['id']]) ){

          $new_val = $_POST['_'.$a_metabox['id']];

          foreach ($a_metabox['tabs'] as $key2 => $tabs) {
            foreach ($tabs['options'] as $key3 => $options) {
              
              if( $options['type'] == 'checkbox' && !isset($new_val[$options['id']]) ){
                $new_val[$options['id']] = '';
              }
            }
          }
        }
        if ( is_array($new_val) ) {
          update_post_meta( $post_id, '_'.$a_metabox['id'], $new_val );
        }

      }

    }
    /*---------------------------------------------
      Metabox Output
    ---------------------------------------------*/
    public function ts_meta_box_content($post,$options){

      $all_options = get_post_meta( $post->ID, '_'.$options['id'] , true );
      wp_nonce_field( 'themesama_custom_meta_boxes', 'themesama_custom_meta_boxes_nonce');
      $all_tabs = '';

      echo '<input name="themesama_custom_meta_box_id" type="hidden" value="'.esc_attr( $options['id'] ).'">
      <div class="ts_content">
        <div class="tab_contents">
          <div class="tab_content">
          <ul class="ts_metabox_tabs">';

      foreach ($options['args'] as $key => $tabs) {

        echo '<li'.($key == 0 ? ' class="ts_activetab"' : '').'><a href="#tab_'.esc_attr( $tabs['id'] ).'">'.$tabs['title'].'</a></li>';
        $all_tabs .= '<div class="ts_metabox_tab" id="tab_'.esc_attr( $tabs['id'] ).'">';

        foreach ($tabs['options'] as $key2 => $a_option) {

          $class_name = 'TS_FRAMEWORK_'.strtoupper($a_option['type']).'_FIELD';

          if( !isset( $a_option['field_name'] ) ){
            $a_option['field_name'] = '_'.$options['id'].'['.$a_option['id'].']';
          }

          if( !isset( $a_option['field_value'] ) ){
            $a_option['field_value'] =  isset($all_options[$a_option['id']]) ? $all_options[$a_option['id']]:'';
          }

          if( !isset( $a_option['desc'] ) ){
            $a_option['desc'] = '';
          }

          if( !isset( $a_option['depends'] ) ){
            $a_option['depends'] = '';
          }

          $get_field = new $class_name;
          $all_tabs .= $get_field->output($a_option);
        }
        
        $all_tabs .= '</div>';

      }
      echo '</ul><div class="ts_metabox_alltabs">'.$all_tabs.'</div></div></div></div>';
    }
  
  }
}
new THEMESAMA_FRAMEWORK_METABOX;

?>