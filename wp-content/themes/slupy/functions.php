<?php
/*---------------------------------------------
    Define Slupy Theme Helper Variables
---------------------------------------------*/
if ( !isset( $content_width ) ) {
  $content_width = 1200;
}

defined( 'IS_SLUPY' )         || define( 'IS_SLUPY', true );
defined( 'SLUPY_TRANSLATE' )  || define( 'SLUPY_TRANSLATE', 'slupy' );
defined( 'SLUPY_VERSION' )    || define( 'SLUPY_VERSION' , '1.0.5' );
defined( 'SLUPY_URI' )        || define( 'SLUPY_URI' , get_template_directory_uri() );
defined( 'SLUPY_PATH' )       || define( 'SLUPY_PATH', get_template_directory() );
defined( 'SLUPY_INC' )        || define( 'SLUPY_INC',  SLUPY_PATH.'/includes' );
defined( 'SLUPY_IMG' )        || define( 'SLUPY_IMG' , SLUPY_URI.'/images' );
defined( 'SLUPY_JS' )         || define( 'SLUPY_JS'  , SLUPY_URI.'/js' );
defined( 'SLUPY_CSS' )        || define( 'SLUPY_CSS' , SLUPY_URI.'/css' );

//Load Themesama Framework
load_template( SLUPY_PATH.'/ts-framework/settings.php' );

//Slupy Functions
load_template( SLUPY_INC.'/slupy-main.php' );
load_template( SLUPY_INC.'/slupy-functions.php' );

//Slupy Header & Footer
load_template( SLUPY_INC.'/slupy-style.php' );

//Slupy Class - Menu & Menu Additional, Ajax etc.
load_template( SLUPY_INC.'/slupy-class.php' );

//Visual Composer
if ( is_visual_composer_activated() ) {
  load_template( SLUPY_INC.'/visual-composer-conf.php' );
}

//Woocommerce
if ( is_woocommerce_activated() ) {
  load_template( SLUPY_INC.'/woocommerce-conf.php' );
}

//Easy Digital Downloads
if ( is_edd_activated() ) {
  load_template( SLUPY_INC.'/edd-conf.php' );
}

//TGM Plugin Activation
load_template( SLUPY_INC.'/plugin-activation.php' );

//Template Hooks
load_template( SLUPY_INC.'/slupy-hooks.php' );