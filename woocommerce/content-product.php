<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 NM: Modified */

defined( 'ABSPATH' ) || exit;

global $product, $nm_theme_options, $nm_globals;

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

if(get_field('custom_pricing_display', $product->get_id())) {
	$product_class = 'has-custom-pricing';
}

nm_add_page_include( 'products' );

// Actions
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

// Rating
if ( $nm_theme_options['product_rating'] ) {
    add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 15 );
}

// Product link
$product_link_atts = ' href="' . esc_url( get_permalink() ) . '"';

// Quick-view link
if ( $nm_theme_options['product_quickview'] ) {
    $quickview_enabled = true;
    
    // Default link
    $show_default_link = apply_filters( 'nm_product_default_link', false );
    if ( ! $show_default_link ) {
        // Action: woocommerce_after_shop_loop_item
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    }
    
    $quickview_link_atts = $product_link_atts . ' data-product_id="' . esc_attr( $product->get_id() ) . '" class="nm-quickview-btn product_type_' . esc_attr( $product->get_type() ) . '"';
    
    // Override static product link?
    if ( $nm_theme_options['product_quickview_links'] == 'all' ) {
        $product_link_atts = $quickview_link_atts;
    }
} else {
    $quickview_enabled = false;
}
?>
<li <?php wc_product_class(); ?>>
	<?php
        /**
         * Hook: woocommerce_before_shop_loop_item.
         *
         * NM: Removed - @hooked woocommerce_template_loop_product_link_open - 10
         */
		do_action( 'woocommerce_before_shop_loop_item' );
	?>
    
    <div class="nm-shop-loop-thumbnail nm-loader">
        <a<?php echo $product_link_atts; ?> class="woocommerce-LoopProduct-link">
            <?php
                /**
                 * Hook: woocommerce_before_shop_loop_item_title.
                 *
                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
        </a>
    </div>
	
    <div class="nm-shop-loop-details">
    	<?php if ( $nm_globals['wishlist_enabled'] ) : ?>
        <div class="nm-shop-loop-wishlist-button"><?php nm_wishlist_button(); ?></div>
        <?php endif; ?>
        
        <h3><a<?php echo $product_link_atts; ?>><?php the_title(); ?></a></h3>
        <?php
            /**
             * Hook: woocommerce_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             * NM: Added - @hooked woocommerce_template_loop_rating - 15
             */
            do_action( 'woocommerce_shop_loop_item_title' );
        ?>
        
        <div class="nm-shop-loop-after-title <?php echo esc_attr( $nm_theme_options['product_action_link'] ); ?>">
			<div class="nm-shop-loop-price <?php echo $product_class; ?>">
                <?php
                    /**
                     * Hook: woocommerce_after_shop_loop_item_title.
                     *
                     * NM: Removed - @hooked woocommerce_template_loop_rating - 5
                     * @hooked woocommerce_template_loop_price - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item_title' );
                    
					if(get_field('custom_pricing_display', $product->get_id())) {
						echo '                
                            <span class="price custom-price-display">
                                <span class="woocommerce-Price-amount amount">											
                                '.get_field('custom_pricing_display', $product->get_id()).'
                                </span>
                            </span>
                        ';
					}
				?>
            </div>
            
            <div class="nm-shop-loop-actions">
				<?php
                    if ( $quickview_enabled ) {
                        echo apply_filters( 'nm_product_quickview_link', '<a' . $quickview_link_atts . '>' . esc_html__( 'Show more', 'nm-framework' ) . '</a>' );
                    }
                    
                    /**
                     * Hook: woocommerce_after_shop_loop_item.
                     *
                     * NM: Removed - @hooked woocommerce_template_loop_product_link_close - 5
                     * @hooked woocommerce_template_loop_add_to_cart - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item' );
                    
                ?>
            </div>
        </div>
    </div>
</li>