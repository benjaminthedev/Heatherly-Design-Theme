<?php
	global $nm_globals, $nm_theme_options;
    
    // Layout class
    $header_class = $nm_globals['header_layout'];
    
    // Scroll class
    $header_scroll_class = apply_filters( 'nm_header_on_scroll_class', 'resize-on-scroll' );
    $header_class .= ( strlen( $header_scroll_class ) > 0 ) ? ' ' . $header_scroll_class : '';
    
    // Alternative logo class
    if ( $nm_theme_options['alt_logo'] && isset( $nm_theme_options['alt_logo_visibility'] ) ) {
        $alt_logo_class = '';
        foreach( $nm_theme_options['alt_logo_visibility'] as $key => $val ) {
            if ( $val === '1' ) {
                $alt_logo_class .= ' ' . $key;
            }
        }
        $header_class .= $alt_logo_class;
    }
?>
<div id="nm-header-placeholder" class="nm-header-placeholder"></div>


<header id="nm-header" class="nm-header <?php echo esc_attr( $header_class ); ?> clear">
        <div class="nm-header-inner">
        <?php
            // Include header layout
            if ( $nm_globals['header_layout'] == 'centered' ) {
                get_template_part( 'template-parts/header/header', 'layout-centered' );
            } else {
                get_template_part( 'template-parts/header/header', 'layout' );
            }
        ?>
    </div>
    
    <?php
        // Shop search
        if ( $nm_globals['shop_search_header'] ) {
            get_template_part( 'woocommerce/product', 'searchform_nm' );
        }
    ?>
</header>
