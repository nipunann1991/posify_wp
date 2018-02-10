<?php
/**
 * The template for displaying the footer
 */
 global $archi_option; 
?>

	 <!-- footer begin -->
        <footer>
            <div class="container">
                <div class="row">
                    <?php get_sidebar('footer');?>
                </div>    
            </div>

            <div class="subfooter">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo esc_html($archi_option['footer_text']); ?> 
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="social-icons">
                                <?php if($archi_option['facebook']!=''){ ?>                                    
                                        <a target="_blank" href="<?php echo esc_url($archi_option['facebook']); ?>"><i class="fa fa-facebook"></i></a>
                                    
                                <?php } ?>
                                
                                <?php if($archi_option['twitter']!=''){ ?>
                                    
                                        <a target="_blank" href="<?php echo esc_url($archi_option['twitter']); ?>"><i class="fa fa-twitter"></i></a>
                                    
                                <?php } ?> 
                                <?php if($archi_option['google']!=''){ ?>
                                    
                                        <a target="_blank" href="<?php echo esc_url($archi_option['google']); ?>"><i class="fa fa-google-plus"></i></a>
                                    
                                <?php } ?>
                                <?php if($archi_option['youtube']!=''){ ?>
                                    
                                        <a target="_blank" href="<?php echo esc_url($archi_option['youtube']); ?>"><i class="fa fa-youtube"></i></a>
                                    
                                <?php } ?>
                                <?php if($archi_option['linkedin']!=''){ ?>
                                        <a target="_blank" href="<?php echo esc_url($archi_option['linkedin']); ?>"><i class="fa fa-linkedin"></i></a>
                                <?php } ?>
                                <?php if($archi_option['skype']!=''){ ?>
                                    <a target="_blank" href="<?php echo esc_url($archi_option['skype']); ?>"><i class="fa fa-skype"></i></a>
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
                                 
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </footer>
        <!-- footer close -->
	
</div><!-- #wrapper -->

<?php wp_footer(); ?>
 

</body>
</html>