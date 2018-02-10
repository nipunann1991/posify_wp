<?php
  if ( ! defined( 'TS_FRAMEWORK' ) ) exit( 'No direct access allowed' );
?>

<form action="options.php" method="post" id="ts_framework_form">

  <?php settings_fields(TS_OPTIONGROUP); ?>

  <div class="ts_frameworkarea">
    
    <div class="ts_header">
      <a href="#"><img src="<?php echo esc_url( TS_FRAMEWORKURI.'/images/logo.svg' ); ?>" alt="slupy logo"></a>
      <span><?php submit_button('','primary large ts_option_button','submit',''); ?></span>
    </div>

    <div class="ts_content">
      <div class="ts_menu">
        <ul>
          <?php echo apply_filters( 'themesama_framework_menu', $this->themesama_framework_menu ); ?>
        </ul>
      </div>

      <div class="tab_contents">
        <?php  ts_framework_do_settings_sections(TS_PAGENAME); ?>
      </div>

    </div>
  </div>

</form>