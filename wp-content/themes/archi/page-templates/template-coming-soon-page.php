<?php

/*
 * Template Name: Coming Soon Page
 * Description: A Page Template.
 */

//get_header(); ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<?php global $archi_option; ?>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body id="homepage">
  <div id="wrapper">
    <!-- content begin -->
    <div id="content" class="no-bottom no-top">
            <section id="hide-content" class="padding-top-90">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <h2><?php echo esc_html($archi_option['hc_title']); ?></h2>

                            <?php echo htmlspecialchars_decode($archi_option['hc_stitle']); ?>
                    
                            <?php echo do_shortcode($archi_option['hc_contact']); ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- parallax section -->
            <section id="section-coming-soon" class="coming-soon padding-top-90">
                <div class="coming-soon-content text-center">
                    <img src="<?php echo esc_url($archi_option['cms_logo']['url']); ?>" alt="">
                    
                    <div class="spacer-single"></div>
                    <div class="teaser-text">
                        <h2><?php echo esc_html($archi_option['cs_title']); ?></h2>
                        <br>
                        <?php echo htmlspecialchars_decode($archi_option['cs_stitle']); ?>
                    </div>
                    <div class="spacer-double"></div>
                    <div class="col-md-8 col-md-offset-2">
                        <ul class="countdown">
                          <li> 
                            <span class="days">00</span>
                            <p class="days_ref">days</p>
                          </li>
                          <li class="seperator">.</li>
                          <li>
                            <span class="hours">00</span>
                            <p class="hours_ref">hours</p>
                          </li>
                          <li class="seperator">:</li>
                          <li> 
                            <span class="minutes">00</span>
                            <p class="minutes_ref">minutes</p>
                          </li>
                          <li class="seperator">:</li>
                          <li>
                            <span class="seconds">00</span>
                            <p class="seconds_ref">seconds</p>
                          </li>
                        </ul>
                    </div>
                    
                    <div class="col-md-8 col-md-offset-2">
                      <div class="social-icons">
                          <?php if($archi_option['facebook']!=''){ ?>                                    
                                  <a target="_blank" href="<?php echo esc_url($archi_option['facebook']); ?>"><i class="fa fa-facebook"></i></a>                            
                          <?php } ?>
                          <?php if($archi_option['google']!=''){ ?>                            
                                  <a target="_blank" href="<?php echo esc_url($archi_option['google']); ?>"><i class="fa fa-google-plus"></i></a>                            
                          <?php } ?>
                          <?php if($archi_option['twitter']!=''){ ?>                            
                                  <a target="_blank" href="<?php echo esc_url($archi_option['twitter']); ?>"><i class="fa fa-twitter"></i></a>                            
                          <?php } ?>
                          <?php if($archi_option['youtube']!=''){ ?>                            
                                  <a target="_blank" href="<?php echo esc_url($archi_option['youtube']); ?>"><i class="fa fa-youtube"></i></a>                            
                          <?php } ?>
                          <?php if($archi_option['linkedin']!=''){ ?>
                                  <a target="_blank" href="<?php echo esc_url($archi_option['linkedin']); ?>"><i class="fa fa-linkedin"></i></a>
                          <?php } ?>
                          <?php if($archi_option['dribbble']!=''){ ?>
                                  <a target="_blank" href="<?php echo esc_url($archi_option['dribbble']); ?>"><i class="fa fa-dribbble"></i></a>
                          <?php } ?>
                          <?php if($archi_option['pinterest']!=''){ ?>
                                  <a target="_blank" href="<?php echo esc_url($archi_option['pinterest']); ?>"><i class="fa fa-pinterest"></i></a>
                          <?php } ?>
                          <?php if($archi_option['instagram']!=''){ ?>
                                  <a target="_blank" href="<?php echo esc_url($archi_option['instagram']); ?>"><i class="fa fa-instagram"></i></a>
                          <?php } ?>  
                          <?php if($archi_option['github']!=''){ ?>
                                  <a target="_blank" href="<?php echo esc_url($archi_option['github']); ?>"><i class="fa fa-github"></i></a>
                          <?php } ?>
                          <?php if($archi_option['vimeo']!=''){ ?>
                              <a target="_blank" href="<?php echo esc_url($archi_option['vimeo']); ?>"><i class="fa fa-vimeo-square"></i></a>
                          <?php } ?>
                          <?php if($archi_option['tumblr']!=''){ ?>
                              <a target="_blank" href="<?php echo esc_url($archi_option['tumblr']); ?>"><i class="fa fa-tumblr-square"></i></a>
                          <?php } ?>
                          <?php if($archi_option['soundcloud']!=''){ ?>
                              <a target="_blank" href="<?php echo esc_url($archi_option['soundcloud']); ?>"><i class="fa fa-soundcloud"></i></a>
                          <?php } ?>
                          <?php if($archi_option['behance']!=''){ ?>
                              <a target="_blank" href="<?php echo esc_url($archi_option['behance']); ?>"><i class="fa  fa-behance"></i></a>
                          <?php } ?>
                          <?php if($archi_option['lastfm']!=''){ ?>
                              <a target="_blank" href="<?php echo esc_url($archi_option['lastfm']); ?>"><i class="fa fa-lastfm"></i></a>
                          <?php } ?> 
                          <?php if($archi_option['skype']!=''){ ?>
                              <a target="_blank" href="<?php echo esc_url($archi_option['skype']); ?>"><i class="fa fa-skype"></i></a>
                          <?php } ?> 
                      </div>
                    </div>
                </div>

            </section>
            <!-- parallax section close -->
            <section id="bg-coming-soon-page" style="background-image: url(<?php echo esc_url($archi_option['cs_bg']['url']); ?>)"></section>
            <div class="arrow-down"></div>
            <div class="arrow-up"></div>
    </div>
  </div>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.downCount.js"></script>
<script type="text/javascript">
  (function($) { "use strict";      
      //Timer
      $('.countdown').downCount({
          date: '<?php echo htmlspecialchars_decode($archi_option['cmsoon_date']); ?> 12:00:00',
          offset: +10
      }, function () {
          alert('WOOT WOOT, done!');
      });
      //Portfolio Top Sections Fullscreen         
      $(function(){"use strict";
        $('.commingsoon-top').css({'height':($(window).height())+'px'});
        $(window).resize(function(){
        $('.commingsoon-top').css({'height':($(window).height())+'px'});
        });
      });
      
  })(jQuery);
</script>

  <style type="text/css">    
    html {
        margin-top: 0px !important;
    }
    * html body {
        margin-top: 0px !important;
    }
    @media screen and (max-width: 782px) {
      html {
          margin-top: 0px !important;
      }
      * html body {
          margin-top: 0px !important;
      }
    }
  </style>
<?php wp_footer(); ?>
</body>
</html>