<?php
	global $nm_theme_options, $nm_globals;
	
	// Ubermenu
	if ( function_exists( 'ubermenu' ) ) {
		$ubermenu = true;
		$ubermenu_wrap_open = '<div class="nm-ubermenu-wrap clear">';
		$ubermenu_wrap_close = '</div>';
	} else {
		$ubermenu = false;
		$ubermenu_wrap_open = $ubermenu_wrap_close = '';
	}
?>
<div class="nm-row">
    <?php echo $ubermenu_wrap_open; ?>
    
    <?php
        // Include header logo
        get_template_part( 'template-parts/header/header', 'logo' );
    ?>

    <div class="nm-main-menu-wrap col-xs-6">
        <?php if ( $ubermenu ) : ?>
        <nav class="nm-main-menu">
            <ul id="nm-main-menu-ul" class="nm-menu">
                <li class="nm-menu-offscreen menu-item">
                    <?php 
                        if ( nm_woocommerce_activated() ) {
                            echo nm_get_cart_contents_count();
                        }
                    ?>
                    <a href="#" id="nm-mobile-menu-button" class="clicked">
                        <div class="nm-menu-icon">
                            <span class="line-1"></span><span class="line-2"></span><span class="line-3"></span>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>


        <?php ubermenu( 'main', array( 'theme_location' => 'main-menu' ) ); ?>
        <?php else : ?>
        <nav class="nm-main-menu">
            <ul id="nm-main-menu-ul" class="nm-menu">
                <li class="nm-menu-offscreen menu-item">
                    <?php 
                        if ( nm_woocommerce_activated() ) {
                            echo nm_get_cart_contents_count();
                        }
                    ?>
                    <a href="#" id="nm-mobile-menu-button" class="clicked">
                        <div class="nm-menu-icon">
                            <span class="line-1"></span><span class="line-2"></span><span class="line-3"></span>
                        </div>
                    </a>
                </li>
                <?php
                    wp_nav_menu( array(
                        'theme_location'	=> 'main-menu',
                        'container'       	=> false,
                        'fallback_cb'     	=> false,
                        'items_wrap'      	=> '%3$s'
                    ) );
                ?>
            </ul>
        </nav>
        <?php endif; ?>

				<?php echo nm_get_social_profiles( 'nm-top-bar-social' ); // Args: $wrapper_class ?>
    </div>

    <div class="nm-right-menu-wrap col-xs-6">
        <nav class="nm-right-menu">
            <ul id="nm-right-menu-ul" class="nm-menu">
                <?php
                    wp_nav_menu( array(
                        'theme_location'	=> 'right-menu',
                        'container'       	=> false,
                        'fallback_cb'     	=> false,
                        'items_wrap'      	=> '%3$s'
                    ) );

                    if ( nm_woocommerce_activated() && $nm_theme_options['menu_login'] ) :
                ?>
                <li class="nm-menu-account menu-item">
                    <?php echo nm_get_myaccount_link( true ); ?>
                </li>
                <?php
                    endif;

                    if ( $nm_globals['cart_link'] ) :

                        $cart_menu_class = ( $nm_theme_options['menu_cart_icon'] ) ? 'has-icon' : 'no-icon';
                        $cart_url = ( $nm_globals['cart_panel'] ) ? '#' : wc_get_cart_url();
                ?>
                <li class="nm-menu-cart menu-item <?php echo esc_attr( $cart_menu_class ); ?>">
                    <a href="<?php echo esc_url( $cart_url ); ?>" id="nm-menu-cart-btn">
                        <?php echo nm_get_cart_title(); ?>
                        <?php echo nm_get_cart_contents_count(); ?>
                    </a>
                </li>
                <?php 
                    endif; 

                    if ( $nm_globals['shop_search_header'] ) :
                ?>
                <li class="nm-menu-search menu-item"><a href="#" id="nm-menu-search-btn"><i class="nm-font nm-font-search-alt flip"></i></a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <?php echo $ubermenu_wrap_close; ?>
</div>