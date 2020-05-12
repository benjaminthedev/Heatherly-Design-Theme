<?php 
	global $nm_theme_options, $nm_globals;
?>
                </div> <!-- .nm-page-wrap-inner -->
            </div> <!-- .nm-page-wrap -->
            
            <div id="nm-page-overlay" class="nm-page-overlay"></div>
            <div id="nm-widget-panel-overlay" class="nm-page-overlay"></div>
            
            <footer id="nm-footer" class="nm-footer">
                <?php
                    // Footer widgets
                    if ( is_active_sidebar( 'footer' ) ) {
                        get_template_part( 'template-parts/footer/footer', 'widgets' );
                    }
                ?>
                
                <?php 
                    // Footer bar
                    get_template_part( 'template-parts/footer/footer', 'bar' );
                ?>
            </footer>
            
            <?php 
                // Mobile menu
                get_template_part( 'template-parts/navigation/navigation', 'mobile' );
            ?>
            
            <?php
                // Cart panel
                if ( $nm_globals['cart_panel'] ) {
                    get_template_part( 'template-parts/woocommerce/cart-panel' );
                }
            ?>
            
            <?php
                // Login panel
                if ( $nm_globals['login_popup'] && ! is_user_logged_in() && ! is_account_page() ) {
                    get_template_part( 'template-parts/woocommerce/login' );
                }
			?>

            <!-- enquiry popup -->
            <div id="nm-enquiry-popup-wrap" class="nm-login-popup-wrap mfp-hide">
                <h3>Enquire About Product & Pricing</h3>
                <p>Please complete the form below and we will be in touch with a quote</p>
                <?php echo do_shortcode('[gravityform id="10" name="Contact Us" title="false" description="false"]'); ?>
            </div>
            <!-- /enquirty popup -->
            
            <div id="nm-quickview" class="clearfix"></div>
            
            <?php if ( strlen( $nm_theme_options['custom_js'] ) > 0 ) : ?>
                <?php echo $nm_theme_options['custom_js']; ?>
            <?php endif; ?>
<?php if(get_the_ID()=='27812'){?>     
<script type="text/javascript">
      var onloadCallback = function() { 
        grecaptcha.render('recaptcha_element', {
          'sitekey' : '6LduR7UUAAAAADmRikl-TReAU2ycm6Xdensv7wZD'
        });
      };
 jQuery('#birs_book_appointment').click(function(e) {
    e.preventDefault();
  if(grecaptcha.getResponse() == "") {
     jQuery(".text_error_c").html('');
   jQuery("#recaptcha_element").append('<div class="text_error_c" style="color:red;">Invalid ReCaptcha</div>');
  } else {
   jQuery(".text_error_c").html('');
  }
})
</script>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"></script>
 <?php }?>  
            <?php wp_footer(); // WordPress footer hook ?>

        </div> <!-- .nm-page-overflow -->
	</body>
</html>