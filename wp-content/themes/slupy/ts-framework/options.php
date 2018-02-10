<?php
/*---------------------------------------------
  Framework & Metabox Options
---------------------------------------------*/
if( !function_exists('get_ts_framework_options') ){
function get_ts_framework_options(){

$ts_framework_custom_options = apply_filters( 'ts_framework_custom_options', array() );

return array(

  //General Tab
  array(
    'title'                 => '<i class="fa fa-desktop menu_icon"></i>'.__('General',TS_TRANSLATE),
    'tabs'                  => array(
      array(
        'title'             => __('Logo',TS_TRANSLATE),
        'id'                => 'logo',
        'options'           => array(
          array(
            'title'         => __('Logo Type',TS_TRANSLATE),
            'id'            => 'logo_type',
            'depend_id'     => 'logo_type',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => '',
            'class'         => '',
            'title_switch'  => __('IMAGE',TS_TRANSLATE).':'.__('TEXT',TS_TRANSLATE),
            'desc'          => __('Choose a logo type',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Logo Icon',TS_TRANSLATE),
            'id'            => 'slupy_logoicon',
            'depends'       => '!logo_type',
            'type'          => 'icon',
            'value'         => 'star-o',
            'class'         => '',
            'desc'          => __('Choose a icon for your logo (Optional)',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Logo',TS_TRANSLATE),
            'id'            => 'slupy_textlogo',
            'depends'       => '!logo_type',
            'type'          => 'text',
            'value'         => get_bloginfo('name'),
            'class'         => '',
            'desc'          => __('Write your name or company name (Optional)',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Sticky Logo',TS_TRANSLATE),
            'id'            => 'slupy_stickytextlogo',
            'depends'       => '!logo_type',
            'type'          => 'text',
            'value'         => get_bloginfo('name'),
            'class'         => '',
            'desc'          => __('Write your name or company name for sticky menu (Optional)',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Logo',TS_TRANSLATE),
            'id'            => 'slupy_logo',
            'depends'       => 'logo_type',
            'type'          => 'upload',
            'value'         => '',
            'class'         => '',
            'getid'         => 'on',
            'desc'          => __('Choose your logo',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Logo (Retina Version @2x)',TS_TRANSLATE),
            'id'            => 'slupy_retinalogo',
            'depends'       => 'logo_type',
            'type'          => 'upload',
            'value'         => '',
            'class'         => '',
            'getid'         => 'on',
            'desc'          => __('Choose your 2x logo for retina-ready displays',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Logo Light (For Transparent Header)',TS_TRANSLATE),
            'id'            => 'slupy_lightlogo',
            'depends'       => 'logo_type',
            'type'          => 'upload',
            'value'         => '',
            'class'         => '',
            'getid'         => 'on',
            'desc'          => __('Choose your transparent header logo',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Logo Max Width',TS_TRANSLATE),
            'id'            => 'slupy_logomaxwidth',
            'type'          => 'text',
            'depends'       => 'logo_type',
            'value'         => '',
            'class'         => ''
          ),
          array(
            'title'         => __('Sticky Logo',TS_TRANSLATE),
            'id'            => 'slupy_stickylogo',
            'depends'       => 'logo_type',
            'type'          => 'upload',
            'value'         => '',
            'class'         => '',
            'getid'         => 'on',
            'desc'          => __('Choose your logo for sticky menu (Optional)',TS_TRANSLATE)
          )
        )
      ),
      //favicon
      array(
        'title'             => __('Favicon',TS_TRANSLATE),
        'id'                => 'favicon',
        'options'           => array(
          array(
            'title'         => __('Favicon',TS_TRANSLATE),
            'id'            => 'slupy_favicon',
            'type'          => 'upload',
            'value'         => '',
            'class'         => '',
            'getid'         => 'on',
            'desc'          => __('Choose your favicon (Optional)',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Apple Touch Icon - 60x60',TS_TRANSLATE),
            'id'            => 'slupy_favicon60',
            'type'          => 'upload',
            'value'         => '',
            'class'         => '',
            'getid'         => 'on',
            'desc'          => __('iPhone & iPod',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Apple Touch Icon - 76x76',TS_TRANSLATE),
            'id'            => 'slupy_favicon76',
            'type'          => 'upload',
            'value'         => '',
            'class'         => '',
            'getid'         => 'on',
            'desc'          => __('iPad',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Apple Touch Icon - 120x120',TS_TRANSLATE),
            'id'            => 'slupy_favicon120',
            'type'          => 'upload',
            'value'         => '',
            'class'         => '',
            'getid'         => 'on',
            'desc'          => __('iPhone & iPod retina',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Apple Touch Icon - 152x152',TS_TRANSLATE),
            'id'            => 'slupy_favicon152',
            'type'          => 'upload',
            'value'         => '',
            'class'         => '',
            'getid'         => 'on',
            'desc'          => __('iPad retina',TS_TRANSLATE)
          )
        )
      ),
      array(
        'title'             => __('Layout',TS_TRANSLATE),
        'id'                => 'layout',
        'options'           => array(
          array(
            'title'         => __('Responsive',TS_TRANSLATE),
            'id'            => 'slupy_responsive',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => 'on',
            'class'         => '',
            'desc'          => __('Enable/Disable responsive design',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Boxed Layout',TS_TRANSLATE),
            'id'            => 'slupy_boxed',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => '',
            'class'         => '',
            'desc'          => __('Enable/Disable boxed layout (It is recommended for companies)',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Sticky Menu', TS_TRANSLATE),
            'id'            => 'slupy_stickymenu',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => '',
            'class'         => '',
            'desc'          => __('Enable/Disable sticky menu', TS_TRANSLATE)
          ),
          array(
            'title'         => __('Back to Top Button', TS_TRANSLATE),
            'id'            => 'slupy_backtopbutton',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => 'on',
            'class'         => '',
            'desc'          => __('Enable/Disable back to top button', TS_TRANSLATE)
          ),
          array(
            'title'         => __('Media Player Skin', TS_TRANSLATE),
            'id'            => 'slupy_playerskin',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => 'on',
            'class'         => '',
            'desc'          => __('Enable/Disable Slupy style player skin', TS_TRANSLATE)
          ),
          /*array(
            'title'         => __('RTL',TS_TRANSLATE),
            'id'            => 'slupy_rtl',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => '',
            'class'         => '',
            'desc'          => __('Enable/Disable right to left text direction',TS_TRANSLATE)
          )*/
        )
      ),
      array(
        'title'             => __('Javascripts',TS_TRANSLATE),
        'id'                => 'javascripts',
        'options'           => array(
          array(
            'title'         => __('Custom JS & Tracking Code',TS_TRANSLATE),
            'id'            => 'slupy_customjs',
            'type'          => 'textarea',
            'rows'          => '20',
            'value'         => '',
            'class'         => '',
            'desc'          => __('Paste your Google Analytics code without script tag',TS_TRANSLATE)
          )
        )
      )
    )
  ),
  //General Tab End

  //Header Tab
  array(
    'title'                 => '<i class="fa fa-bars menu_icon"></i>'.__('Header & Footer',TS_TRANSLATE),
    'tabs'                  => array(
      array(
        'title'             => __('Header Models',TS_TRANSLATE),
        'id'                => 'header_types',
        'options'           => array(
          array(
            'title'         => __('Header Model',TS_TRANSLATE),
            'id'            => 'slupy_header',
            'type'          => 'radio',
            'mode'          => 'image',
            'value'         => 'standard',
            'class'         => '',
            'options'       => array(
              array(
                'title'     => __('Standard',TS_TRANSLATE),
                'value'     => 'standard',
                'image'     => TS_FRAMEWORKURI.'/images/layout/header1.jpg'
              ),
              array(
                'title'     => __('Big Logo',TS_TRANSLATE),
                'value'     => 'big',
                'image'     => TS_FRAMEWORKURI.'/images/layout/header2.jpg'
              ),
              array(
                'title'     => __('Center Logo',TS_TRANSLATE),
                'value'     => 'center',
                'image'     => TS_FRAMEWORKURI.'/images/layout/header3.jpg'
              ),
              array(
                'title'     => __('Under Logo',TS_TRANSLATE),
                'value'     => 'underlogo',
                'image'     => TS_FRAMEWORKURI.'/images/layout/header4.jpg'
              )
            ),
            'desc'          => __('Choose your header type',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Top-Bar Text (Optional)',TS_TRANSLATE),
            'id'            => 'slupy_topbartext',
            'type'          => 'textarea',
            'multi_lang'    => 'on',
            'value'         => '',
            'class'         => '',
            'desc'          => __('You can add a text on top-bar.',TS_TRANSLATE)
          )
        )
      ),
      array(
        'title'             => __('Page Header',TS_TRANSLATE),
        'id'                => 'pageheader',
        'options'           => array(
          array(
            'title'         => __('Show Parent Page for Blog posts on Breadcrumb Nav',TS_TRANSLATE),
            'id'            => 'ph_blogpage',
            'type'          => 'select',
            'mode'          => 'pages',
            'value'         => '',
            'class'         => '',
            'desc'          => __('Adds another page in between Home and the blogpost.',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Show Parent Page for Portfolio posts on Breadcrumb Nav',TS_TRANSLATE),
            'id'            => 'ph_portfoliopage',
            'type'          => 'select',
            'mode'          => 'pages',
            'value'         => '',
            'class'         => '',
            'desc'          => __('Adds another page in between Home and the portfolio post.',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Background Image',TS_TRANSLATE),
            'id'            => 'ph_bg',
            'type'          => 'background',
            'value'         => '',
            'class'         => '',
            'desc'          => ''
          ),
          array(
            'title'         => __('Space',TS_TRANSLATE),
            'id'            => 'ph_padding',
            'type'          => 'select',
            'value'         => 'space-20',
            'class'         => '',
            'options'       => array(
              array(
                'title'     => __( 'X-Small', TS_TRANSLATE ),
                'value'     => 'space-20'
              ),
              array(
                'title'     => __( 'Small', TS_TRANSLATE ),
                'value'     => 'space-30'
              ),
              array(
                'title'     => __( 'Medium', TS_TRANSLATE ),
                'value'     => 'space-40'
              ),
              array(
                'title'     => __( 'Large', TS_TRANSLATE ),
                'value'     => 'space-60'
              ),
              array(
                'title'     => __( 'X-Large', TS_TRANSLATE ),
                'value'     => 'space-90'
              ),
              array(
                'title'     => __( 'XX-Large', TS_TRANSLATE ),
                'value'     => 'space-120'
              )
            )
          ),
          array(
            'title'         => __('Text Color',TS_TRANSLATE),
            'id'            => 'ph_text_color',
            'type'          => 'colorpicker',
            'value'         => '',
            'class'         => '',
            'color'         => '',
            'desc'          => __('Choose a text color (Optional)',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Link Color',TS_TRANSLATE),
            'id'            => 'ph_link_color',
            'type'          => 'colorpicker',
            'value'         => '',
            'class'         => '',
            'color'         => '',
            'desc'          => __('Choose a link color (Optional)',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Link Color (Hover)',TS_TRANSLATE),
            'id'            => 'ph_link_color_hover',
            'type'          => 'colorpicker',
            'value'         => '',
            'class'         => '',
            'color'         => '',
            'desc'          => __('Choose a link color (Optional)',TS_TRANSLATE)
          ),
        )
      ),
      array(
        'title'             => __('Menu Additional',TS_TRANSLATE),
        'id'                => 'menu_additional',
        'options'           => array(
          array(
            'title'         => __('Menu Additional Type',TS_TRANSLATE),
            'id'            => 'slupy_menuadditional',
            'type'          => 'select',
            'value'         => 'right',
            'class'         => '',
            'depend_id'     => 'menu_additional',
            'options'       => array(
              array(
                'title'     => __('None',TS_TRANSLATE),
                'value'     => 'none'
              ),
              array(
                'title'     => __('Show on Top-Bar (Right)',TS_TRANSLATE),
                'value'     => 'right'
              ),
              array(
                'title'     => __('Show on Top-Bar (Left)',TS_TRANSLATE),
                'value'     => 'left'
              ),
              array(
                'title'     => __('Show with Menu',TS_TRANSLATE),
                'value'     => 'menu'
              )
            ),
            'desc'          => __('Choose your menu additional position or disable',TS_TRANSLATE)
          ),
          array(
            'title'         => '',
            'id'            => 'slupy_menuadditionalicons',
            'type'          => 'checkbox',
            'value'         => '',
            'class'         => '',
            'depends'       => 'menu_additional:!none',
            'mode'          => 'switch',
            'options'       => array(
              array(
                'title'     => __('Social Networks',TS_TRANSLATE),
                'id'        => 'social',
                'depend_id' => 'social',
                'value'     => 'on'
              ),
              array(
                'title'     => __('WPML Lang Selector',TS_TRANSLATE),
                'id'        => 'wpml',
                'value'     => 'on'
              ),
              array(
                'title'     => __('Woocommerce Cart',TS_TRANSLATE),
                'id'        => 'woocommerce',
                'value'     => 'on'
              ),
              array(
                'title'     => __('Search',TS_TRANSLATE),
                'id'        => 'search',
                'value'     => 'on'
              )
            ),
            'desc'          => __('Enable/Disable standard menu additional icons',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Your Social Networks',TS_TRANSLATE),
            'id'            => 'slupy_sociallinks',
            'type'          => 'group',
            'value'         => '',
            'class'         => '',
            'depends'       => 'menu_additional:!none + social',
            'options'       => array(
              array(
                'title'     => __('Title',TS_TRANSLATE),
                'id'        => 'title',
                'type'      => 'text',
                'value'     => '',
                'class'     => ''
              ),
              array(
                'title'     => __('Icon',TS_TRANSLATE),
                'id'        => 'icon',
                'type'      => 'icon',
                'value'     => '',
                'class'     => ''
              ),
              array(
                'title'     => __('URL',TS_TRANSLATE),
                'id'        => 'url',
                'type'      => 'text',
                'value'     => '',
                'class'     => ''
              ),
              array(
                'title'     => __('Target',TS_TRANSLATE),
                'id'        => 'target',
                'type'      => 'select',
                'mode'      => 'target',
                'value'     => '',
                'class'     => ''
              )
            ),
            'desc'          => __('Add your social networks url',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Custom Menu Items',TS_TRANSLATE),
            'id'            => 'slupy_custommenuitems',
            'type'          => 'group',
            'value'         => '',
            'class'         => '',
            'depends'       => 'menu_additional:!none',
            'options'       => array(
              array(
                'title'     => __('Title',TS_TRANSLATE),
                'id'        => 'title',
                'type'      => 'text',
                'value'     => '',
                'class'     => ''
              ),
              array(
                'title'     => __('Icon',TS_TRANSLATE),
                'id'        => 'icon',
                'type'      => 'icon',
                'value'     => '',
                'class'     => ''
              ),
              array(
                'title'     => __('URL',TS_TRANSLATE),
                'id'        => 'url',
                'type'      => 'text',
                'value'     => '',
                'class'     => ''
              ),
              array(
                'title'     => __('Target',TS_TRANSLATE),
                'id'        => 'target',
                'type'      => 'select',
                'mode'      => 'target',
                'value'     => '',
                'class'     => ''
              ),
              array(
                'title'     => __('Content',TS_TRANSLATE),
                'id'        => 'content',
                'type'      => 'textarea',
                'multi_lang'=> 'on',
                'rows'      => '10',
                'value'     => '',
                'class'     => ''
              ),
            ),
            'desc'          => __('Add your custom menu items',TS_TRANSLATE)
          )
        )
      ),
      array(
        'title'             => __('Footer Models',TS_TRANSLATE),
        'id'                => 'footer_types',
        'options'           => array(
          array(
            'title'         => __('Footer Model',TS_TRANSLATE),
            'id'            => 'footer',
            'type'          => 'checkbox',
            'choose'        => 'single',
            'value'         => '',
            'class'         => '',
            'mode'          => 'image',
            'options'       => array(
              array(
                'title'     => __('1 Column',TS_TRANSLATE),
                'id'        => 'col-sm-12',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/1.jpg'
              ),
              array(
                'title'     => __('2 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-6 col-lg-6,col-sm-6 col-lg-6',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/2.jpg'
              ),
              array(
                'title'     => __('3 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-4 col-lg-4,col-sm-4 col-lg-4,col-sm-4 col-lg-4',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/3.jpg'
              ),
              array(
                'title'     => __('4 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-6 col-md-3 col-lg-3,col-sm-6 col-md-3 col-lg-3,col-sm-6 col-md-3 col-lg-3,col-sm-6 col-md-3 col-lg-3',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/4.jpg'
              ),
              array(
                'title'     => __('6 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-4 col-md-2 col-lg-2,col-sm-4 col-md-2 col-lg-2,col-sm-4 col-md-2 col-lg-2,col-sm-4 col-md-2 col-lg-2,col-sm-4 col-md-2 col-lg-2,col-sm-4 col-md-2 col-lg-2',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/6.jpg'
              ),
              array(
                'title'     => __('3 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-3 col-md-2 col-lg-2,col-sm-6 col-md-8 col-lg-8,col-sm-3 col-md-2 col-lg-2',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/7.jpg'
              ),
              array(
                'title'     => __('3 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-3 col-md-2 col-lg-2,col-sm-3 col-md-2 col-lg-2,col-sm-6 col-md-8 col-lg-8',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/8.jpg'
              ),
              array(
                'title'     => __('3 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-6 col-lg-6,col-sm-3 col-lg-3,col-sm-3 col-lg-3',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/9.jpg'
              ),
              array(
                'title'     => __('3 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-3 col-lg-3,col-sm-6 col-lg-6,col-sm-3 col-lg-3',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/10.jpg'
              ),
              array(
                'title'     => __('3 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-3 col-lg-3,col-sm-3 col-lg-3,col-sm-6 col-lg-6',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/11.jpg'
              ),
              array(
                'title'     => __('3 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-5 col-lg-5,col-sm-5 col-lg-5,col-sm-2 col-lg-2',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/12.jpg'
              ),
              array(
                'title'     => __('3 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-2 col-lg-2,col-sm-5 col-lg-5,col-sm-5 col-lg-5',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/13.jpg'
              ),
              array(
                'title'     => __('4 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-6 col-lg-6,col-sm-2 col-lg-2,col-sm-2 col-lg-2,col-sm-2 col-lg-2',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/14.jpg'
              ),
              array(
                'title'     => __('4 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-2 col-lg-2,col-sm-2 col-lg-2,col-sm-2 col-lg-2,col-sm-6 col-lg-6',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/15.jpg'
              ),
              array(
                'title'     => __('5 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-4 col-lg-4,col-sm-2 col-lg-2,col-sm-2 col-lg-2,col-sm-2 col-lg-2,col-sm-2 col-lg-2',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/16.jpg'
              ),
              array(
                'title'     => __('5 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-2 col-lg-2,col-sm-2 col-lg-2,col-sm-4 col-lg-4,col-sm-2 col-lg-2,col-sm-2 col-lg-2',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/17.jpg'
              ),
              array(
                'title'     => __('5 Columns',TS_TRANSLATE),
                'id'        => 'col-sm-2 col-lg-2,col-sm-2 col-lg-2,col-sm-2 col-lg-2,col-sm-2 col-lg-2,col-sm-4 col-lg-4',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/18.jpg'
              )
            ),
            'desc'          => __('Choose your footer column(s). Uncheck to override',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Copyright Content',TS_TRANSLATE),
            'id'            => 'slupy_copyright',
            'type'          => 'textarea',
            'rows'          => 10,
            'multi_lang'    => 'on',
            'value'         => __('Slupy Theme. <a href="http://wordpress.org/" target="_blank">Powered by WordPress.</a>',TS_TRANSLATE),
            'class'         => '',
            'desc'          => __('Shortcode supported.',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Footer Dark Style',TS_TRANSLATE),
            'id'            => 'footer_dark',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => '',
            'class'         => '',
            'desc'          => __('Choose footer style',TS_TRANSLATE)
          )
        )
      )
    )
  ),
  //Header Tab End

  //Styling Tab
  array(
    'title'                 => '<i class="fa fa-tint menu_icon"></i>'.__('Theme Styling',TS_TRANSLATE),
    'tabs'                  => array(
      array(
        'title'             => __('Color Sheme',TS_TRANSLATE),
        'id'                => 'color_sheme',
        'options'           => array(
          array(
            'title'         => __('Choose Ready Skins',TS_TRANSLATE),
            'id'            => 'slupy_skins',
            'type'          => 'select',
            'value'         => '#31353e',
            'class'         => '',
            'depend_id'     => 'theme_colors',
            'options'       => array(
              array(
                'title'     => __('Default',TS_TRANSLATE),
                'value'     => '#31353e'
              ),
              array(
                'title'     => __('Orange',TS_TRANSLATE),
                'value'     => '#fc5513'
              ),
              array(
                'title'     => __('Blue',TS_TRANSLATE),
                'value'     => '#1ca2f1'
              ),
              array(
                'title'     => __('Yellow',TS_TRANSLATE),
                'value'     => '#ffbe05'
              ),
              array(
                'title'     => __('Green',TS_TRANSLATE),
                'value'     => '#82bf06'
              ),
              array(
                'title'     => __('Custom',TS_TRANSLATE),
                'value'     => 'custom'
              )
            )
          ),
          array(
            'title'         => __('Accent Color',TS_TRANSLATE),
            'id'            => 'slupy_accentcolor',
            'type'          => 'colorpicker',
            'value'         => '',
            'class'         => '',
            'color'         => 'ffffff',
            'depends'       => 'theme_colors:custom'
          )
        )
      ),
      array(
        'title'             => __('Typography',TS_TRANSLATE),
        'id'                => 'typography',
        'options'           => array(
          array(
            'title'         => __('Headings',TS_TRANSLATE),
            'id'            => 'headings_font',
            'type'          => 'font',
            'value'         => '',
            'class'         => '',
            'font_size'     => false,
            'desc'          => ''
          ),
          array(
            'title'         => '',
            'id'            => 'heading_size',
            'type'          => 'heading',
            'value'         => '',
            'class'         => '',
            'desc'          => ''
          ),
          array(
            'title'         => __('Main Menu',TS_TRANSLATE),
            'id'            => 'mainmenu_font',
            'type'          => 'font',
            'max_limit'     => '18',
            'min_limit'     => '12',
            'value'         => '',
            'class'         => '',
            'desc'          => __('Change main menu typography',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Main Menu Color (Hover & Active)',TS_TRANSLATE),
            'id'            => 'mainmenu_color',
            'type'          => 'colorpicker',
            'value'         => '',
            'class'         => '',
            'color'         => '',
            'desc'          => __('Change main menu hover & active color',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Sub Menu',TS_TRANSLATE),
            'id'            => 'submenu_font',
            'type'          => 'font',
            'max_limit'     => '18',
            'min_limit'     => '12',
            'value'         => '',
            'class'         => '',
            'desc'          => __('Change sub menu typography',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Sub Menu Color (Hover & Active)',TS_TRANSLATE),
            'id'            => 'submenu_color',
            'type'          => 'colorpicker',
            'value'         => '',
            'class'         => '',
            'color'         => '',
            'desc'          => __('Change main menu hover & active color',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Body',TS_TRANSLATE),
            'id'            => 'body_font',
            'type'          => 'font',
            'max_limit'     => '16',
            'min_limit'     => '12',
            'value'         => '',
            'class'         => '',
            'desc'          => __('Change body typography',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Link',TS_TRANSLATE),
            'id'            => 'link_color',
            'type'          => 'colorpicker',
            'value'         => '',
            'class'         => '',
            'color'         => '',
            'desc'          => __('Change all links color',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Link (Hover)',TS_TRANSLATE),
            'id'            => 'link_color_hover',
            'type'          => 'colorpicker',
            'value'         => '',
            'class'         => '',
            'color'         => '',
            'desc'          => __('Change all links hover color',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Google Fonts Subsets',TS_TRANSLATE),
            'id'            => 'google_subsets',
            'type'          => 'text',
            'value'         => 'latin,latin-ext,cyrillic',
            'class'         => '',
            'color'         => '',
            'desc'          => __('Write google font subsets latin,cyrillic etc.',TS_TRANSLATE)
          )
        )
      ),
      array(
        'title'             => __('Custom CSS',TS_TRANSLATE),
        'id'                => 'custom_css',
        'options'           => array(
          array(
            'title'         => __('Custom CSS',TS_TRANSLATE),
            'id'            => 'slupy_customcss',
            'type'          => 'textarea',
            'rows'          => '30',
            'value'         => '',
            'class'         => '',
            'desc'          => __('Add your custom css lines here',TS_TRANSLATE)
          ),
        )
      )
    )
  ),
  //Styling Tab End
  
  //Blog Tab
  array(
    'title'                 => '<i class="fa fa-file-o menu_icon"></i>'.__('Blog',TS_TRANSLATE),
    'tabs'                  => array(
      array(
        'title'             => __('Blog Listing',TS_TRANSLATE),
        'id'                => 'blog_listing',
        'options'           => array(
          array(
            'title'         => __('Masonry Style',TS_TRANSLATE),
            'id'            => 'blog_masonry',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => '',
            'class'         => '',
            'desc'          => __('Enable/Disable Masonry Style',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Masonry Max Columns',TS_TRANSLATE),
            'id'            => 'blog_masonry_max_columns',
            'type'          => 'select',
            'value'         => '2',
            'class'         => '',
            'options'       => array(
              array(
                'title'     => '2',
                'value'     => '2'
              ),
              array(
                'title'     => '3',
                'value'     => '3'
              ),
              array(
                'title'     => '4',
                'value'     => '4'
              )
            ),
            'desc'          => __('Choose Masonry Max Columns on Desktop Display',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Masonry Effect',TS_TRANSLATE),
            'id'            => 'blog_effect',
            'type'          => 'select',
            'value'         => 'fadeInUp',
            'class'         => '',
            'options'       => array(
              array(
                'title'     => __('fade',TS_TRANSLATE),
                'value'     => 'fadeIn'
              ),
              array(
                'title'     => __('fadeInDown',TS_TRANSLATE),
                'value'     => 'fadeInDown'
              ),
              array(
                'title'     => __('fadeInUp',TS_TRANSLATE),
                'value'     => 'fadeInUp'
              ),
              array(
                'title'     => __('bounceIn',TS_TRANSLATE),
                'value'     => 'bounceIn'
              ),
              array(
                'title'     => __('flipInX',TS_TRANSLATE),
                'value'     => 'flipInX'
              ),
              array(
                'title'     => __('flipInY',TS_TRANSLATE),
                'value'     => 'flipInY'
              )
            )
          ),
          array(
            'title'         => __('Sidebar',TS_TRANSLATE),
            'id'            => 'blog_sidebar',
            'type'          => 'checkbox',
            'choose'        => 'single',
            'value'         => '',
            'class'         => '',
            'mode'          => 'image',
            'options'       => array(
              array(
                'title'     => __('Left Sidebar',TS_TRANSLATE),
                'id'        => 'left',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/sidebar_left.jpg'
              ),
              array(
                'title'     => __('Right Sidebar',TS_TRANSLATE),
                'id'        => 'right',
                'value'     => 'right',
                'image'     => TS_FRAMEWORKURI.'/images/layout/sidebar_right.jpg'
              )
            ),
            'desc'          => __('Choose your sidebar position. Uncheck to override',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Icons for Post Formats',TS_TRANSLATE),
            'id'            => 'blog_icons',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => 'on',
            'class'         => '',
            'desc'          => __('Enable/Disable Post Types Icons',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Meta Position',TS_TRANSLATE),
            'id'            => 'blog_meta_position',
            'type'          => 'select',
            'value'         => 'read-more',
            'class'         => '',
            'options'       => array(
              array(
                'title'     => __('Content After',TS_TRANSLATE),
                'value'     => 'content-after'
              ),
              array(
                'title'     => __('Media After',TS_TRANSLATE),
                'value'     => 'media-after'
              ),
              array(
                'title'     => __('Heading After',TS_TRANSLATE),
                'value'     => 'heading-after'
              ),
              array(
                'title'     => __('Together with Read More Button',TS_TRANSLATE),
                'value'     => 'read-more'
              )
            )
          ),
          array(
            'title'         => 'Meta Items',
            'id'            => 'blog_meta_items',
            'type'          => 'checkbox',
            'value'         => '',
            'class'         => '',
            'mode'          => 'switch',
            'options'       => array(
              array(
                'title'     => __('Author',TS_TRANSLATE),
                'id'        => 'author',
                'value'     => 'on'
              ),
              array(
                'title'     => __('Date',TS_TRANSLATE),
                'id'        => 'date',
                'value'     => 'on'
              ),
              array(
                'title'     => __('Comments Count',TS_TRANSLATE),
                'id'        => 'comments',
                'value'     => 'on'
              ),
              array(
                'title'     => __('Tags',TS_TRANSLATE),
                'id'        => 'tags',
                'value'     => 'on'
              ),
              array(
                'title'     => __('Categories',TS_TRANSLATE),
                'id'        => 'categories',
                'value'     => 'on'
              )
            ),
            'desc'          => __('Enable/Disable Meta Items',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Read More Style',TS_TRANSLATE),
            'id'            => 'blog_read_more',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => 'on',
            'class'         => '',
            'title_switch'  => __('BUTTON',TS_TRANSLATE).':'.__('TEXT',TS_TRANSLATE),
            'desc'          => __('Choose read more style',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Pagination Style',TS_TRANSLATE),
            'id'            => 'blog_pagination',
            'type'          => 'select',
            'value'         => 'oldernewer',
            'class'         => '',
            'options'       => array(
              array(
                'title'     => __('Older & Newer Button',TS_TRANSLATE),
                'value'     => 'oldernewer'
              ),
              array(
                'title'     => __('Load More',TS_TRANSLATE),
                'value'     => 'loadmore'
              ),
              array(
                'title'     => __('Page Numbers',TS_TRANSLATE),
                'value'     => 'pagenumbers'
              )
            )
          ),
          array(
            'title'         => __('Blog Auto Excerpt', TS_TRANSLATE),
            'id'            => 'blog_auto_excerpt',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => '',
            'class'         => ''
          ),
          array(
            'title'         => __('Excerpt Length',TS_TRANSLATE),
            'id'            => 'blog_excerpt_length',
            'type'          => 'text',
            'value'         => '55',
            'class'         => '',
            'desc'          => __('By default, excerpt length is set to 55 words.',TS_TRANSLATE)
          )
        )
      ),
      array(
        'title'             => __('Single Post',TS_TRANSLATE),
        'id'                => 'single_post',
        'options'           => array(
          array(
            'title'         => __('Sidebar',TS_TRANSLATE),
            'id'            => 'single_sidebar',
            'type'          => 'checkbox',
            'choose'        => 'single',
            'value'         => '',
            'class'         => '',
            'mode'          => 'image',
            'options'       => array(
              array(
                'title'     => __('Left Sidebar',TS_TRANSLATE),
                'id'        => 'left',
                'value'     => '',
                'image'     => TS_FRAMEWORKURI.'/images/layout/sidebar_left.jpg'
              ),
              array(
                'title'     => __('Right Sidebar',TS_TRANSLATE),
                'id'        => 'right',
                'value'     => 'right',
                'image'     => TS_FRAMEWORKURI.'/images/layout/sidebar_right.jpg'
              )
            ),
            'desc'          => __('Choose your sidebar position. Uncheck to override',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Icons for Post Formats',TS_TRANSLATE),
            'id'            => 'single_icons',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => 'on',
            'class'         => '',
            'desc'          => __('Enable/Disable Post Types Icons',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Meta Items',TS_TRANSLATE),
            'id'            => 'single_meta_items',
            'type'          => 'checkbox',
            'value'         => '',
            'class'         => '',
            'mode'          => 'switch',
            'options'       => array(
              array(
                'title'     => __('Author',TS_TRANSLATE),
                'id'        => 'author',
                'value'     => 'on'
              ),
              array(
                'title'     => __('Date',TS_TRANSLATE),
                'id'        => 'date',
                'value'     => 'on'
              ),
              array(
                'title'     => __('Comments Count',TS_TRANSLATE),
                'id'        => 'comments',
                'value'     => 'on'
              ),
              array(
                'title'     => __('Tags',TS_TRANSLATE),
                'id'        => 'tags',
                'value'     => 'on'
              ),
              array(
                'title'     => __('Categories',TS_TRANSLATE),
                'id'        => 'categories',
                'value'     => 'on'
              )
            ),
            'desc'          => __('Enable/Disable Meta Items',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Related Posts',TS_TRANSLATE),
            'id'            => 'single_related_posts',
            'type'          => 'select',
            'value'         => 'none',
            'class'         => '',
            'options'       => array(
              array(
                'title'     => __('None',TS_TRANSLATE),
                'value'     => 'none'
              ),
              array(
                'title'     => __('By Tags',TS_TRANSLATE),
                'value'     => 'tags'
              ),
              array(
                'title'     => __('By Categories',TS_TRANSLATE),
                'value'     => 'categories'
              )
            )
          ),
          array(
            'title'         => __('Next & Prev Article Link',TS_TRANSLATE),
            'id'            => 'single_prevnext',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => '',
            'class'         => '',
            'desc'          => __('Enable/Disable Next & Prev Article Links',TS_TRANSLATE)
          ),
          array(
            'title'         => __('About the Author',TS_TRANSLATE),
            'id'            => 'single_about',
            'depend_id'     => 'single_about',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => 'on',
            'class'         => '',
            'desc'          => __('Enable/Disable your short bio',TS_TRANSLATE)
          ),
          array(
            'title'         => __('Users Social Networks',TS_TRANSLATE),
            'id'            => 'single_sociallinks',
            'type'          => 'group',
            'value'         => '',
            'class'         => '',
            'depends'       => 'single_about',
            'options'       => array(
              array(
                'title'     => __('Title',TS_TRANSLATE),
                'id'        => 'title',
                'type'      => 'text',
                'value'     => '',
                'class'     => ''
              ),
              array(
                'title'     => __('Icon',TS_TRANSLATE),
                'id'        => 'icon',
                'type'      => 'icon',
                'value'     => '',
                'class'     => ''
              )
            ),
            'desc'          => __('Add users social networks. Look at main menu "Users->Your Profile->Contact Info"',TS_TRANSLATE)
          )
        )
      ),
      array(
        'title'             => __('Sidebars',TS_TRANSLATE),
        'id'                => 'sidebars',
        'options'           => array(
          array(
            'title'         => __('Sidebars',TS_TRANSLATE),
            'id'            => 'slupy_sidebars',
            'type'          => 'group',
            'value'         => '',
            'class'         => '',
            'options'       => array(
              array(
                'title'     => __('Sidebar Title',TS_TRANSLATE),
                'id'        => 'title',
                'type'      => 'text',
                'value'     => '',
                'class'     => ''
              )
            ),
            'desc'          => __('Add your special sidebars',TS_TRANSLATE)
          )
        )
      )
    )
  ),
  //Blog Tab End

  //Other Settings
  array(
    'title'                 => '<i class="fa fa-wrench menu_icon"></i>'.__('Other Settings',TS_TRANSLATE),
    'tabs'                  => $ts_framework_custom_options
  ),
  //Other Settings End
);

}
}

if( !function_exists('get_ts_metabox_options') ){
function get_ts_metabox_options(){

$page_header_tab = array(
  'title'                   => __('Page Header',TS_TRANSLATE),
  'id'                      => 'pageheader_tab',
  'options'                 => array(
    array(
      'title'               => __('Transparent Header',TS_TRANSLATE),
      'id'                  => 'ph_transparent_header',
      'type'                => 'checkbox',
      'mode'                => 'switch',
      'value'               => '',
      'class'               => ''
    ),
    array(
      'title'               => __('Disable Page Header',TS_TRANSLATE),
      'id'                  => 'ph_disable',
      'depend_id'           => 'ph_disable',
      'type'                => 'checkbox',
      'mode'                => 'switch',
      'value'               => 'on',
      'class'               => ''
    ),
    array(
      'title'               => __('Disable Breadcrumb',TS_TRANSLATE),
      'id'                  => 'ph_nav',
      'type'                => 'checkbox',
      'mode'                => 'switch',
      'value'               => 'on',
      'class'               => ''
    ),
    array(
      'title'               => __('Custom Title',TS_TRANSLATE),
      'id'                  => 'ph_title',
      'type'                => 'text',
      'value'               => '',
      'class'               => ''
    ),
    array(
      'title'               => __('Custom Short Description',TS_TRANSLATE),
      'id'                  => 'ph_desc',
      'type'                => 'text',
      'value'               => '',
      'class'               => ''
    ),
    array(
      'title'               => __('Custom Content',TS_TRANSLATE),
      'id'                  => 'ph_content',
      'type'                => 'textarea',
      'rows'                => '10',
      'value'               => '',
      'class'               => ''
    )
  )
);

$page_header_style_tab = array(
  'title'                   => __('Page Header Style',TS_TRANSLATE),
  'id'                      => 'pageheaderstyle_tab',
  'options'                 => array(
    array(
      'title'               => __('Disable Container',TS_TRANSLATE),
      'id'                  => 'ph_disable_container',
      'type'                => 'checkbox',
      'mode'                => 'switch',
      'value'               => '',
      'class'               => ''
    ),
    array(
      'title'               => __('Align Center',TS_TRANSLATE),
      'id'                  => 'ph_align',
      'type'                => 'checkbox',
      'mode'                => 'switch',
      'value'               => '',
      'class'               => ''
    ),
    array(
      'title'               => __('Space',TS_TRANSLATE),
      'id'                  => 'ph_padding',
      'type'                => 'select',
      'value'               => '',
      'class'               => '',
      'options'             => array(
        array(
          'title'           => __( 'Default', TS_TRANSLATE ),
          'value'           => ''
        ),
        array(
          'title'           => __( 'Small', TS_TRANSLATE ),
          'value'           => 'space-30'
        ),
        array(
          'title'           => __( 'Medium', TS_TRANSLATE ),
          'value'           => 'space-40'
        ),
        array(
          'title'           => __( 'Large', TS_TRANSLATE ),
          'value'           => 'space-60'
        ),
        array(
          'title'           => __( 'X-Large', TS_TRANSLATE ),
          'value'           => 'space-90'
        ),
        array(
          'title'           => __( 'XX-Large', TS_TRANSLATE ),
          'value'           => 'space-120'
        ),
        array(
          'title'           => __( 'None', TS_TRANSLATE ),
          'value'           => 'space-none'
        )
      )
    ),
    array(
      'title'               => __('Text Color',TS_TRANSLATE),
      'id'                  => 'ph_text_color',
      'type'                => 'colorpicker',
      'value'               => '',
      'class'               => '',
      'color'               => ''
    ),
    array(
      'title'               => __('Link Color',TS_TRANSLATE),
      'id'                  => 'ph_link_color',
      'type'                => 'colorpicker',
      'value'               => '',
      'class'               => '',
      'color'               => ''
    ),
    array(
      'title'               => __('Link Color (Hover)',TS_TRANSLATE),
      'id'                  => 'ph_link_color_hover',
      'type'                => 'colorpicker',
      'value'               => '',
      'class'               => '',
      'color'               => ''
    )
  )
);

$page_header_bg_tab = array(
  'title'                   => __('Page Header BG',TS_TRANSLATE),
  'id'                      => 'pageheaderbg_tab',
  'options'                 => array(
    array(
      'title'               => __('Background Type',TS_TRANSLATE),
      'id'                  => 'ph_bgtype',
      'depend_id'           => 'ph_bgtype',
      'type'                => 'checkbox',
      'mode'                => 'switch',
      'title_switch'        => __('VIDEO',TS_TRANSLATE).':'.__('IMAGE',TS_TRANSLATE),
      'value'               => '',
      'class'               => ''
    ),
    array(
      'title'               => __('Background Image',TS_TRANSLATE),
      'id'                  => 'ph_bg',
      'type'                => 'background',
      'value'               => '',
      'class'               => '',
      'depends'             => '!ph_bgtype'
    ),
    array(
      'title'               => __('Parallax',TS_TRANSLATE),
      'id'                  => 'ph_parallax',
      'depend_id'           => 'ph_parallax',
      'type'                => 'checkbox',
      'mode'                => 'switch',
      'value'               => '',
      'class'               => '',
      'depends'             => '!ph_bgtype'
    ),
    array(
      'title'               => __('Parallax Speed',TS_TRANSLATE),
      'id'                  => 'ph_parallax_speed',
      'depends'             => 'ph_parallax + !ph_bgtype',
      'type'                => 'text',
      'value'               => '7',
      'class'               => '',
      'desc'                => ''
    ),
    array(
      'title'               => __('Parallax Offset',TS_TRANSLATE),
      'id'                  => 'ph_parallax_offset',
      'depends'             => 'ph_parallax + !ph_bgtype',
      'type'                => 'text',
      'value'               => '',
      'class'               => ''
    ),
    array(
      'title'               => __('Video BG (.mp4)',TS_TRANSLATE),
      'id'                  => 'ph_video_mp4',
      'depends'             => 'ph_bgtype',
      'type'                => 'upload',
      'filetype'            => 'video',
      'value'               => '',
      'class'               => '',
      'desc'                => ''
    ),
    array(
      'title'               => __('Video BG (.webm)',TS_TRANSLATE),
      'id'                  => 'ph_video_webm',
      'depends'             => 'ph_bgtype',
      'type'                => 'upload',
      'filetype'            => 'video',
      'value'               => '',
      'class'               => '',
      'desc'                => ''
    ),
    array(
      'title'               => __('Video BG (.ogv)',TS_TRANSLATE),
      'id'                  => 'ph_video_ogv',
      'depends'             => 'ph_bgtype',
      'type'                => 'upload',
      'filetype'            => 'video',
      'value'               => '',
      'class'               => '',
      'desc'                => ''
    ),
    array(
      'title'               => __('Video Poster',TS_TRANSLATE),
      'id'                  => 'ph_video_poster',
      'depends'             => 'ph_bgtype',
      'type'                => 'upload',
      'value'               => '',
      'class'               => '',
      'desc'                => __('(Optional) Need for some devices',TS_TRANSLATE)
    ),
    array(
      'title'               => __('Video Sound',TS_TRANSLATE),
      'id'                  => 'ph_video_sound',
      'depends'             => 'ph_bgtype',
      'type'                => 'checkbox',
      'mode'                => 'switch',
      'value'               => '',
      'class'               => ''
    ),
    array(
      'title'               => __('Video Loop',TS_TRANSLATE),
      'id'                  => 'ph_video_loop',
      'depends'             => 'ph_bgtype',
      'type'                => 'checkbox',
      'mode'                => 'switch',
      'value'               => 'on',
      'class'               => ''
    ),
    array(
      'title'               => __('Cover Color',TS_TRANSLATE),
      'id'                  => 'ph_cover_color',
      'type'                => 'colorpicker',
      'value'               => '',
      'class'               => '',
      'color'               => ''
    ),
    array(
      'title'               => __('Cover Alpha',TS_TRANSLATE),
      'id'                  => 'ph_cover_alpha',
      'type'                => 'text',
      'value'               => '0.7',
      'class'               => ''
    )
  )
);

return array(

  //Page Meta Box
  array(
    'id'                    => 'ts_slupy_meta',
    'title'                 => __('Page Details',TS_TRANSLATE),
    'post_type'             => 'page',
    'context'               => 'normal', // normal, advanced, side
    'priority'              => 'core', //high, core, default, low
    'tabs'                  => array(
      array(
        'title'             => __('General',TS_TRANSLATE),
        'id'                => 'general_tab',
        'options'           => array(
          array(
            'title'         => __('Custom Sidebar',TS_TRANSLATE),
            'id'            => 'sidebar',
            'type'          => 'select',
            'mode'          => 'sidebar',
            'value'         => '',
            'class'         => ''
          )
        )
      ),
      $page_header_tab,
      $page_header_bg_tab,
      $page_header_style_tab
    )
  ),
  //Page Meta Box End
  
  //Post Meta Boxes
  array(
    'id'                    => 'ts_slupy_meta',
    'title'                 => __('Post Details',TS_TRANSLATE),
    'post_type'             => 'post',
    'context'               => 'normal', // normal, advanced, side
    'priority'              => 'core', //high, core, default, low
    'tabs'                  => array(
      array(
        'title'             => __('Post Config',TS_TRANSLATE),
        'id'                => 'postconfig_tab',
        'options'           => array(
          array(
            'title'         => __('Custom Icon',TS_TRANSLATE),
            'id'            => 'icon',
            'type'          => 'icon',
            'value'         => '',
            'class'         => ''
          ),
          array(
            'title'         => __('Sidebar Position',TS_TRANSLATE),
            'id'            => 'sidebar_position',
            'type'          => 'select',
            'value'         => '',
            'class'         => '',
            'options'       => array(
              array(
                'title'     => __('Default',TS_TRANSLATE),
                'value'     => ''
              ),
              array(
                'title'     => __('None',TS_TRANSLATE),
                'value'     => 'none'
              ),
              array(
                'title'     => __('Left',TS_TRANSLATE),
                'value'     => 'left'
              ),
              array(
                'title'     => __('Right',TS_TRANSLATE),
                'value'     => 'right'
              )
            )
          )
        )
      ),
      $page_header_tab,
      $page_header_bg_tab,
      $page_header_style_tab
    )
  ),
  //Post Meta Boxes End

  //Custom Post Type Meta Box
  array(
    'id'                    => 'ts_slupy_meta',
    'title'                 => __('Portfolio Details',TS_TRANSLATE),
    'post_type'             => 'portfolio',
    'context'               => 'normal', // normal, advanced, side
    'priority'              => 'high', //high, core, default, low
    'tabs'                  => array(
      array(
        'title'             => __('Layout Config',TS_TRANSLATE),
        'id'                => 'layoutconfig_tab',
        'options'           => array(
          array(
            'title'         => __('Template',TS_TRANSLATE),
            'id'            => 'portfolio_template',
            'depend_id'     => 'portfolio_template',
            'type'          => 'select',
            'value'         => '',
            'class'         => '',
            'options'       => array(
              array(
                'title'     => __('Default Template',TS_TRANSLATE),
                'value'     => ''
              ),
              array(
                'title'     => __('Full Width - Parallax Mode',TS_TRANSLATE),
                'value'     => 'fullwidth'
              ),
              array(
                'title'     => __('Left Sidebar',TS_TRANSLATE),
                'value'     => 'left'
              ),
              array(
                'title'     => __('Right Sidebar',TS_TRANSLATE),
                'value'     => 'right'
              )
            )
          ),
          array(
            'title'         => __('Custom Sidebar',TS_TRANSLATE),
            'id'            => 'sidebar',
            'depends'       => 'portfolio_template:left|right',
            'type'          => 'select',
            'mode'          => 'sidebar',
            'value'         => '',
            'class'         => ''
          )
        )
      ),
      $page_header_tab,
      $page_header_bg_tab,
      $page_header_style_tab
    )
  ),
  array(
    'id'                    => 'ts_slupy_meta',
    'title'                 => __('Product Details',TS_TRANSLATE),
    'post_type'             => 'product',
    'context'               => 'normal', // normal, advanced, side
    'priority'              => 'high', //high, core, default, low
    'tabs'                  => array(
      array(
        'title'             => __('Layout Config',TS_TRANSLATE),
        'id'                => 'layoutconfig_tab',
        'options'           => array(
          array(
            'title'         => __('Template',TS_TRANSLATE),
            'id'            => 'product_template',
            'depend_id'     => 'product_template',
            'type'          => 'select',
            'value'         => '',
            'class'         => '',
            'options'       => array(
              array(
                'title'     => __('Default Template',TS_TRANSLATE),
                'value'     => ''
              ),
              array(
                'title'     => __('Left Sidebar',TS_TRANSLATE),
                'value'     => 'left'
              ),
              array(
                'title'     => __('Right Sidebar',TS_TRANSLATE),
                'value'     => 'right'
              ),
              array(
                'title'     => __('Without Sidebar',TS_TRANSLATE),
                'value'     => 'none'
              )
            )
          ),
          array(
            'title'         => __('Custom Sidebar',TS_TRANSLATE),
            'id'            => 'sidebar',
            'depends'       => 'product_template:left|right',
            'type'          => 'select',
            'mode'          => 'sidebar',
            'value'         => '',
            'class'         => ''
          )
        )
      ),
      $page_header_tab,
      $page_header_bg_tab,
      $page_header_style_tab
    )
  ),
  //Custom Post Type Meta Box End

  //Download Meta Box
  array(
    'id'                    => 'ts_slupy_meta',
    'title'                 => __('Download Details',TS_TRANSLATE),
    'post_type'             => 'download',
    'context'               => 'normal', // normal, advanced, side
    'priority'              => 'core', //high, core, default, low
    'tabs'                  => array(
      array(
        'title'             => __('General',TS_TRANSLATE),
        'id'                => 'general_tab',
        'options'           => array(
          array(
            'title'         => __('Single Free Style',TS_TRANSLATE),
            'id'            => 'free_style',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => '',
            'class'         => ''
          )
        )
      ),
      $page_header_tab,
      $page_header_bg_tab,
      $page_header_style_tab
    )
  ),
  //Download Meta Box End

);

}
}

/*---------------------------------------------
  Filter Custom Options
---------------------------------------------*/

/*---------------------------------------------
  Custom Options for Visual Composer
---------------------------------------------*/
if( !function_exists('ts_framework_custom_options_for_vc') ){

function ts_framework_custom_options_for_vc($options){

  array_push($options,array(
    'title'                 => __('Visual Composer',TS_TRANSLATE),
    'id'                    => 'visual_composer',
    'options'               => array(
      array(
        'title'             => __('Disable VC Shortcodes?',TS_TRANSLATE),
        'id'                => 'vc_disable_shortcodes',
        'type'              => 'checkbox',
        'mode'              => 'switch',
        'value'             => 'on',
        'class'             => '',
        'desc'              => __('Enable/Disable Visual Composer Shortcodes ',TS_TRANSLATE)
      ),
      array(
        'title'             => __('Enable Frontend Editor?',TS_TRANSLATE),
        'id'                => 'vc_enable_frontend',
        'type'              => 'checkbox',
        'mode'              => 'switch',
        'value'             => '',
        'class'             => '',
        'desc'              => __('Enable/Disable Visual Composer Frontend Editor ',TS_TRANSLATE)
      )
    )
  ));

  return $options;

}

}

/*---------------------------------------------
  Custom Options for Themesama Portfolio
---------------------------------------------*/
if( !function_exists('ts_framework_custom_options_for_sp') ){

function ts_framework_custom_options_for_sp($options){

  array_push($options,array(
    'title'                 => __('Portfolio',TS_TRANSLATE),
    'id'                    => 'portfolio',
    'options'               => array(
      array(
        'title'             => __('Thumbnail Model',TS_TRANSLATE),
        'id'                => 'portfolio_model',
        'depend_id'         => 'portfolio_model',
        'type'              => 'select',
        'value'             => '1',
        'class'             => '',
        'options'           => array(
          array(
            'title'         => __('Model 1',TS_TRANSLATE),
            'value'         => '1'
          ),
          array(
            'title'         => __('Model 2',TS_TRANSLATE),
            'value'         => '2'
          ),
          array(
            'title'         => __('Model 3',TS_TRANSLATE),
            'value'         => '3'
          )
        ),
        'desc'              => ''
      ),
      array(
        'title'             => __('List Type',TS_TRANSLATE),
        'id'                => 'portfolio_masonry',
        'depend_id'         => 'portfolio_masonry',
        'depends'           => 'portfolio_model:1|2',
        'type'              => 'checkbox',
        'mode'              => 'switch',
        'value'             => 'on',
        'title_switch'      => __('MASONRY', TS_TRANSLATE).':'.__('GRID', TS_TRANSLATE),
        'class'             => '',
        'desc'              => __('Choose your portfolio list type',TS_TRANSLATE)
      ),
      array(
        'title'             => __('Fit Grid Height?',TS_TRANSLATE),
        'id'                => 'portfolio_fit_grid',
        'depends'           => '!portfolio_masonry + portfolio_model:1|2',
        'type'              => 'checkbox',
        'mode'              => 'switch',
        'value'             => 'on',
        'class'             => '',
        'desc'              => __('Create square portfolio items',TS_TRANSLATE)
      ),
      array(
          'title'           => __('Loop Items Padding?',TS_TRANSLATE),
          'id'              => 'portfolio_padding',
          'depends'         => 'portfolio_model:1|2',
          'type'            => 'checkbox',
          'mode'            => 'switch',
          'value'           => '',
          'class'           => '',
          'desc'            => __('Enable/Disable Portfolio Loop Padding',TS_TRANSLATE)
      ),
      array(
        'title'             => __('Portfolio Max Columns',TS_TRANSLATE),
        'id'                => 'portfolio_max_columns',
        'type'              => 'select',
        'value'             => '4',
        'class'             => '',
        'options'           => array(
          array(
            'title'         => '2',
            'value'         => '2'
          ),
          array(
            'title'         => '3',
            'value'         => '3'
          ),
          array(
            'title'         => '4',
            'value'         => '4'
          ),
          array(
            'title'         => '5',
            'value'         => '5'
          )
        ),
        'desc'              => __('Choose Portfolio Max Columns on Desktop Display',TS_TRANSLATE)
      ),
      array(
          'title'           => __('Filterable',TS_TRANSLATE),
          'id'              => 'portfolio_filter',
          'type'            => 'checkbox',
          'mode'            => 'switch',
          'value'           => 'on',
          'class'           => '',
          'desc'            => __('Enable/Disable Portfolio Filter Menu',TS_TRANSLATE)
      ),
      array(
        'title'             => __('Pagination Style',TS_TRANSLATE),
        'id'                => 'portfolio_pagination',
        'type'              => 'select',
        'value'             => 'loadmore',
        'class'             => '',
        'options'           => array(
          array(
            'title'         => __('Load More',TS_TRANSLATE),
            'value'         => 'loadmore'
          ),
          array(
            'title'         => __('Page Numbers',TS_TRANSLATE),
            'value'         => 'pagenumbers'
          )
        )
      ),
      array(
        'title'             => __('Image Size',TS_TRANSLATE),
        'id'                => 'portfolio_image_size',
        'type'              => 'text',
        'value'             => 'medium',
        'class'             => '',
        'desc'              => __('Write a image size (full, large, medium or custom image sizes)',TS_TRANSLATE)
      ),
      array(
          'title'           => __('Latest Works on Single?',TS_TRANSLATE),
          'id'              => 'portfolio_latest_works',
          'type'            => 'checkbox',
          'mode'            => 'switch',
          'value'           => 'on',
          'class'           => '',
          'desc'            => __('Show latest works on single portfolio page',TS_TRANSLATE)
      ),
      array(
        'title'             => __('Latest Works Image Size',TS_TRANSLATE),
        'id'                => 'portfolio_cimage_size',
        'type'              => 'text',
        'value'             => 'medium',
        'class'             => '',
        'desc'              => __('Write a image size (full, large, medium or custom image sizes)',TS_TRANSLATE)
      ),
      array(
        'title'             => __('Latest Works Limit',TS_TRANSLATE),
        'id'                => 'portfolio_latest_works_limit',
        'type'              => 'select',
        'value'             => '8',
        'class'             => '',
        'options'           => array(
          array(
            'title'         => '5',
            'value'         => '5'
          ),
          array(
            'title'         => '6',
            'value'         => '6'
          ),
          array(
            'title'         => '7',
            'value'         => '7'
          ),
          array(
            'title'         => '8',
            'value'         => '8'
          ),
          array(
            'title'         => '9',
            'value'         => '9'
          ),
          array(
            'title'         => '10',
            'value'         => '10'
          ),
          array(
            'title'         => __('Show All',TS_TRANSLATE),
            'value'         => '-1'
          )
        )
      )
    )
  ));
  
  return $options;

}

}

/*---------------------------------------------
  Custom Options for Import Export
---------------------------------------------*/
if( !function_exists('ts_framework_custom_options_for_ie') ){

function ts_framework_custom_options_for_ie($options){

  array_push($options,array(
    'title'                 => __('Import / Export Settings',TS_TRANSLATE),
    'id'                    => 'import_export',
    'options'               => array(
      array(
        'title'             => '',
        'id'                => 'import_export',
        'type'              => 'import_export',
        'value'             => '',
        'class'             => ''
      )
    )
  ));
  
  return $options;

}

}

/*---------------------------------------------
  Custom Options for Woocommerce
---------------------------------------------*/
if( !function_exists('ts_framework_custom_options_for_wc') ){

function ts_framework_custom_options_for_wc($options){

  array_push($options,array(
    'title'                 => __('Woocommerce',TS_TRANSLATE),
    'id'                    => 'woocommerce',
    'options'               => array(
      array(
        'title'             => __('Sidebar',TS_TRANSLATE),
        'id'                => 'shop_sidebar',
        'type'              => 'checkbox',
        'choose'            => 'single',
        'value'             => '',
        'class'             => '',
        'mode'              => 'image',
        'options'           => array(
          array(
            'title'         => __('Left Sidebar',TS_TRANSLATE),
            'id'            => 'left',
            'value'         => '',
            'image'         => TS_FRAMEWORKURI.'/images/layout/sidebar_left.jpg'
          ),
          array(
            'title'         => __('Right Sidebar',TS_TRANSLATE),
            'id'            => 'right',
            'value'         => 'right',
            'image'         => TS_FRAMEWORKURI.'/images/layout/sidebar_right.jpg'
          )
        ),
        'desc'              => __('Choose your sidebar position. Uncheck to override',TS_TRANSLATE)
      ),
      array(
        'title'             => __('Sidebar Single Product',TS_TRANSLATE),
        'id'                => 'shop_sidebar_single',
        'type'              => 'checkbox',
        'choose'            => 'single',
        'value'             => '',
        'class'             => '',
        'mode'              => 'image',
        'options'           => array(
          array(
            'title'         => __('Left Sidebar',TS_TRANSLATE),
            'id'            => 'left',
            'value'         => '',
            'image'         => TS_FRAMEWORKURI.'/images/layout/sidebar_left.jpg'
          ),
          array(
            'title'         => __('Right Sidebar',TS_TRANSLATE),
            'id'            => 'right',
            'value'         => 'right',
            'image'         => TS_FRAMEWORKURI.'/images/layout/sidebar_right.jpg'
          )
        ),
        'desc'              => __('Choose your sidebar position. Uncheck to override',TS_TRANSLATE)
      ),
      array(
        'title'             => __('Product Max Columns',TS_TRANSLATE),
        'id'                => 'product_max_columns',
        'type'              => 'select',
        'value'             => '4',
        'class'             => '',
        'options'           => array(
          array(
            'title'         => '2',
            'value'         => '2'
          ),
          array(
            'title'         => '3',
            'value'         => '3'
          ),
          array(
            'title'         => '4',
            'value'         => '4'
          )
        ),
        'desc'              => __('Choose Max Columns on Desktop Display',TS_TRANSLATE)
      ),
    )
  ));
  
  return $options;

}

}

/*---------------------------------------------
  Custom Image Sizes
---------------------------------------------*/
if( !function_exists('ts_framework_custom_options_for_cis') ){

function ts_framework_custom_options_for_cis($options){

  array_push($options,array(
    'title'                 => __('Image Sizes',TS_TRANSLATE),
    'id'                    => 'imagesizes',
    'options'               => array(
      array(
        'title'             => __('Image Sizes',TS_TRANSLATE),
        'id'                => 'slupy_imagesizes',
        'type'              => 'group',
        'value'             => '',
        'class'             => '',
        'options'           => array(
          array(
            'title'         => __('Name',TS_TRANSLATE),
            'id'            => 'title',
            'type'          => 'text',
            'value'         => '',
            'class'         => ''
          ),
          array(
            'title'         => __('Width',TS_TRANSLATE),
            'id'            => 'width',
            'type'          => 'text',
            'value'         => '500',
            'class'         => ''
          ),
          array(
            'title'         => __('Height',TS_TRANSLATE),
            'id'            => 'height',
            'type'          => 'text',
            'value'         => '300',
            'class'         => ''
          ),
          array(
            'title'         => __('Hard Crop?',TS_TRANSLATE),
            'id'            => 'crop',
            'type'          => 'checkbox',
            'mode'          => 'switch',
            'value'         => 'on',
            'class'         => '',
            'desc'          => ''
          )
        ),
        'desc'              => __('Add your special image sizes',TS_TRANSLATE)
      )
    )
  ));
  
  return $options;

}

}

/*---------------------------------------------
  Custom Options for Contact Form
---------------------------------------------*/
if( !function_exists('ts_framework_custom_options_for_cf') ){

function ts_framework_custom_options_for_cf($options){

  array_push($options,array(
    'title'                 => __('Contact',TS_TRANSLATE),
    'id'                    => 'contact',
    'options'               => array(
      array(
        'title'               => __('E-Mail',TS_TRANSLATE),
        'id'                  => 'contact_form_mail',
        'type'                => 'text',
        'value'               => '',
        'class'               => ''
      ),
    )
  ));
  
  return $options;

}

}

/*---------------------------------------------
  Custom Options for Easy Digital Downloads
---------------------------------------------*/
if( !function_exists('ts_framework_custom_options_for_edd') ){

function ts_framework_custom_options_for_edd($options){

  array_push($options,array(
    'title'                 => __('Easy Digital Downloads',TS_TRANSLATE),
    'id'                    => 'edd',
    'options'               => array(
      array(
        'title'             => __('Single Image Size',TS_TRANSLATE),
        'id'                => 'edd_single_img_size',
        'type'              => 'text',
        'value'             => '',
        'class'             => '',
        'desc'              => __('Write a image size (full, large, medium or custom image sizes)',TS_TRANSLATE)
      ),
      array(
        'title'             => __('List Image Size',TS_TRANSLATE),
        'id'                => 'edd_img_size',
        'type'              => 'text',
        'value'             => '',
        'class'             => '',
        'desc'              => __('Write a image size (full, large, medium or custom image sizes)',TS_TRANSLATE)
      ),
      array(
          'title'           => __('Latest Downloads on Single?',TS_TRANSLATE),
          'id'              => 'edd_latest_downloads',
          'type'            => 'checkbox',
          'mode'            => 'switch',
          'value'           => 'on',
          'class'           => '',
          'desc'            => __('Show latest downloads on single download page',TS_TRANSLATE)
      )
    )
  ));
  
  return $options;

}

}

//check visual composer
/*if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {
  add_filter( 'ts_framework_custom_options', 'ts_framework_custom_options_for_vc' );
}*/

//check slupy portfolio
add_filter( 'ts_framework_custom_options', 'ts_framework_custom_options_for_sp' );

//check woocommerce
if ( class_exists( 'WooCommerce' ) ) {
  add_filter( 'ts_framework_custom_options', 'ts_framework_custom_options_for_wc' );
}

if( class_exists( 'Easy_Digital_Downloads' ) ){
  add_filter( 'ts_framework_custom_options', 'ts_framework_custom_options_for_edd' );
}

//contact form setting
add_filter( 'ts_framework_custom_options', 'ts_framework_custom_options_for_cf' );

//import export settings
add_filter( 'ts_framework_custom_options', 'ts_framework_custom_options_for_cis' );

//import export settings
add_filter( 'ts_framework_custom_options', 'ts_framework_custom_options_for_ie' );

?>