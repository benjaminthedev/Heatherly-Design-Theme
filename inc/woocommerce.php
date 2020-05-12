<?php
/**
 * Custom Fabric Options
 */

add_action( 'woocommerce_before_single_variation', 'woo_fabric_options', 35 );

function woo_fabric_options( ) {
    // build out the filters
    global $post;

    $fabric_terms        = wp_get_post_terms( $post->ID, 'pa_fabric' );

    $leg_type_terms      = wp_get_post_terms( $post->ID, 'pa_leg-type' );
    $leg_stain_terms     = wp_get_post_terms( $post->ID, 'pa_leg-stain' );
    $timber_stain_terms  = wp_get_post_terms( $post->ID, 'pa_stain' );
    $handle_finish_terms = wp_get_post_terms( $post->ID, 'pa_handle-finish' );
    $cross_stitch_terms  = wp_get_post_terms( $post->ID, 'pa_cross-stitch' );
    $stud_colour_terms   = wp_get_post_terms( $post->ID, 'pa_stud-colour' );

    if($leg_type_terms) { ?>

        <div id="accordion" class="variations-form-accordion">
            <a class="accordion-toggle">
                <p>Leg Types<span class="accordion-toggle__icon"></span></p>
            </a>
            <div class="accordion-content">

                <div class="attributes-swatches-container has-large-swatches">
                    <?php
                
                        $limit = 0;			
                        
                        foreach($leg_type_terms as $term) {                                                    

                            $swatch = get_field('attribute_image', $term->taxonomy . '_' . $term->term_id);
                            $thumb  = $swatch['sizes']['thumbnail'] ? $swatch['sizes']['thumbnail'] : wc_placeholder_img_src();
                            $full   = $swatch['sizes']['large'] ? $swatch['sizes']['large'] : wc_placeholder_img_src();
                        
                            echo '<a class="single-swatch" data-src="'.$thumb.'" data-src_full="'.$full.'" data-name="'.$term->name.'">
                                <img data-attribute="leg-type" data-attribute_slug="'.$term->slug.'" data-attribute_name="'.$term->name.'" 
                                class="single-swatch-img" width="150px" height="150px" src="'.$thumb.'" />
                                <div class="is-active-indicator"></div>
                                </a>';
                            // if(++$limit == 20) break;													
                        } 
                        ?>
                        
                </div>
            </div>
        </div>
        <!-- <a class="button load-more-fabrics">View More Fabrics</a> -->

    <?php }

    if($leg_stain_terms) { ?>

        <div id="accordion" class="variations-form-accordion">
            <a class="accordion-toggle">
                <p>Leg Stains<span class="accordion-toggle__icon"></span></p>
            </a>
            <div class="accordion-content">

                <div class="attributes-swatches-container has-large-swatches">
                    <?php
                        
                        $limit = 0;			
                        
                        foreach($leg_stain_terms as $term) {
                            
                            $swatch = get_field('attribute_image', $term->taxonomy . '_' . $term->term_id);
                            $thumb = $swatch['sizes']['thumbnail'] ? $swatch['sizes']['thumbnail'] : wc_placeholder_img_src();
                            $full = $swatch['sizes']['large'] ? $swatch['sizes']['large'] : wc_placeholder_img_src();

                            echo '<a class="single-swatch" data-src="'.$thumb.'" data-src_full="'.$full.'" data-name="'.$term->name.'">
                                <img data-attribute="leg-stain" data-attribute_slug="'.$term->slug.'" data-attribute_name="'.$term->name.'" 
                                class="single-swatch-img" width="150px" height="150px" src="'.$thumb.'" />
                                <div class="is-active-indicator"></div>
                                </a>';
                            // if(++$limit == 20) break;													
                        } 
                        ?>
                        
                </div>
            </div>
        </div>
        <!-- <a class="button load-more-fabrics">View More Fabrics</a> -->

    <?php }

    if($timber_stain_terms) { ?>

        <div id="accordion" class="variations-form-accordion">
            <a class="accordion-toggle">
                <p>Timber Stains<span class="accordion-toggle__icon"></span></p>
            </a>
            <div class="accordion-content">

                <div class="attributes-swatches-container has-large-swatches">
                    <?php
                        
                        $limit = 0;			
                        
                        foreach($timber_stain_terms as $term) {
                            
                            $swatch = get_field('attribute_image', $term->taxonomy . '_' . $term->term_id);
                            $thumb = $swatch['sizes']['thumbnail'] ? $swatch['sizes']['thumbnail'] : wc_placeholder_img_src();
                            $full = $swatch['sizes']['large'] ? $swatch['sizes']['large'] : wc_placeholder_img_src();

                            echo '<a class="single-swatch" data-src="'.$thumb.'" data-src_full="'.$full.'" data-name="'.$term->name.'">
                                <img data-attribute="stain" data-attribute_slug="'.$term->slug.'" data-attribute_name="'.$term->name.'" 
                                class="single-swatch-img" width="150px" height="150px" src="'.$thumb.'" />
                                <div class="is-active-indicator"></div>
                                </a>';												
                        } 
                        ?>
                        
                </div>
            </div>
        </div>
        <!-- <a class="button load-more-fabrics">View More Fabrics</a> -->

    <?php }

    if($handle_finish_terms) { ?>

        <div id="accordion" class="variations-form-accordion">
            <a class="accordion-toggle">
                <p>Handle Finish<span class="accordion-toggle__icon"></span></p>
            </a>
            <div class="accordion-content">

                <div class="attributes-swatches-container has-large-swatches">
                    <?php
                        
                        $limit = 0;			
                        
                        foreach($handle_finish_terms as $term) {
                            
                            $swatch = get_field('attribute_image', $term->taxonomy . '_' . $term->term_id);
                            $thumb = $swatch['sizes']['thumbnail'] ? $swatch['sizes']['thumbnail'] : wc_placeholder_img_src();
                            $full = $swatch['sizes']['large'] ? $swatch['sizes']['large'] : wc_placeholder_img_src();

                            echo '<a class="single-swatch" data-src="'.$thumb.'" data-src_full="'.$full.'" data-name="'.$term->name.'">
                                <img data-attribute="handle-finish" data-attribute_slug="'.$term->slug.'" data-attribute_name="'.$term->name.'" 
                                class="single-swatch-img" width="150px" height="150px" src="'.$thumb.'" />
                                <div class="is-active-indicator"></div>
                                </a>';												
                        } 
                        ?>
                        
                </div>
            </div>
        </div>
        <!-- <a class="button load-more-fabrics">View More Fabrics</a> -->

    <?php }

    if($cross_stitch_terms) { ?>

        <div id="accordion" class="variations-form-accordion">
            <a class="accordion-toggle">
                <p>Cross Stitch<span class="accordion-toggle__icon"></span></p>
            </a>
            <div class="accordion-content">

                <div class="attributes-swatches-container has-large-swatches">
                    <?php
                        
                        $limit = 0;			
                        
                        foreach($cross_stitch_terms as $term) {
                            
                            $swatch = get_field('attribute_image', $term->taxonomy . '_' . $term->term_id);
                            $thumb = $swatch['sizes']['thumbnail'] ? $swatch['sizes']['thumbnail'] : wc_placeholder_img_src();
                            $full = $swatch['sizes']['large'] ? $swatch['sizes']['large'] : wc_placeholder_img_src();

                            echo '<a class="single-swatch" data-src="'.$thumb.'" data-src_full="'.$full.'" data-name="'.$term->name.'">
                                <img data-attribute="cross-stitch" data-attribute_slug="'.$term->slug.'" data-attribute_name="'.$term->name.'" 
                                class="single-swatch-img" width="150px" height="150px" src="'.$thumb.'" />
                                <div class="is-active-indicator"></div>
                                </a>';												
                        } 
                        ?>
                        
                </div>
            </div>
        </div>
        <!-- <a class="button load-more-fabrics">View More Fabrics</a> -->

    <?php }

    if($stud_colour_terms) { ?>

        <div id="accordion" class="variations-form-accordion">
            <a class="accordion-toggle">
                <p>Stud Colour<span class="accordion-toggle__icon"></span></p>
            </a>
            <div class="accordion-content">

                <div class="attributes-swatches-container has-large-swatches">
                    <?php
                        
                        $limit = 0;			
                        
                        foreach($stud_colour_terms as $term) {
                            
                            $swatch = get_field('attribute_image', $term->taxonomy . '_' . $term->term_id);
                            $thumb = $swatch['sizes']['thumbnail'] ? $swatch['sizes']['thumbnail'] : wc_placeholder_img_src();
                            $full = $swatch['sizes']['large'] ? $swatch['sizes']['large'] : wc_placeholder_img_src();

                            echo '<a class="single-swatch" data-src="'.$thumb.'" data-src_full="'.$full.'" data-name="'.$term->name.'">
                                <img data-attribute="cross-stitch" data-attribute_slug="'.$term->slug.'" data-attribute_name="'.$term->name.'" 
                                class="single-swatch-img" width="150px" height="150px" src="'.$thumb.'" />
                                <div class="is-active-indicator"></div>
                                </a>';												
                        } 
                        ?>
                        
                </div>
            </div>
        </div>
        <!-- <a class="button load-more-fabrics">View More Fabrics</a> -->

    <?php }

    if($fabric_terms) {
        $fabric_types = [];
        $fabric_colors = [];
    
        foreach($fabric_terms as $term) {
    
            $fabric_type = get_field('linked_fabric_type', $term->taxonomy . '_' . $term->term_id);
            
            if($fabric_type) {
                $fabric_types[$fabric_type->slug] = array(
                    'slug' => $fabric_type->slug,
                    'name' => $fabric_type->name
                );
            }
    
            $fabric_color = get_field('fabric_color', $term->taxonomy . '_' . $term->term_id);
    
            if($fabric_color) {
                $fabric_colors[$fabric_color->slug] = array(
                    'slug' => $fabric_color->slug,
                    'name' => $fabric_color->name
                );
            }
        } ?>

            <div id="accordion" class="variations-form-accordion">
                <a class="accordion-toggle">
                    <p>Fabrics<span class="accordion-toggle__icon"></span></p>
                </a>
                <div class="accordion-content">


                
                    
                    
                    
                    <div class="fabric-custom-search-single">
                        <label for="fabric Search">Fabric Search</label>
                        <input type="search" class="Search For Fabric" id="fabrics-search-single" aria-label="Search for fabrics" placeholder="Search for fabrics" data-search></input>
                    </div>
                
                



                    <div class="fabric-swatches-filters" data-balloon-visible data-balloon="Refine selection:" data-balloon-pos="left">      
                        <div class="sod_custom">
                            <div class="label"><label for="<?php echo esc_attr( sanitize_title( 'pa_fabric-type' ) ); ?>"><?php echo wc_attribute_label( 'pa_fabric-type' ); // WPCS: XSS ok. ?></label></div>
                            <div class="value">														
                                <span class="sod_select focus" tabindex="0" data-cycle="false" data-links="false" data-links-external="false" data-placeholder-option="false" data-filter="">
                                    <span class="sod_label sod_label_custom">Choose an option</span>
                                    <span class="sod_list_wrapper sod_list_wrapper_custom">
                                        <span class="sod_list">
                                        <span class="sod_option active sod_option_reset" title="Choose an option" data-value="">Choose an option</span>
                                            <?php foreach($fabric_types as $fabric_type):                                            
                                                echo '<span class="sod_option sod_option_custom" title="'.$fabric_type['name'].'" 
                                                data-type="type" data-value="'.$fabric_type['slug'].'">'.$fabric_type['name'].'</span>';
                                            endforeach; ?>										
                                        </span>
                                    </span>	
                                                
                            </div>
                        </div>
                        <div class="sod_custom">
                            <div class="label sod_label_custom"><label for="Fabric Color">Fabric Color</label></div>
                            <div class="value">
                                <span class="sod_select focus" tabindex="0" data-cycle="false" data-links="false" data-links-external="false" data-placeholder-option="false" data-filter="">
                                    <span class="sod_label sod_label_custom">Choose an option</span>
                                    <span class="sod_list_wrapper sod_list_wrapper_custom">
                                        <span class="sod_list">
                                        <span class="sod_option active sod_option_reset" title="Choose an option" data-value="">Choose an option</span>
                                        <?php foreach($fabric_colors as $fabric_color):
                                            
                                            echo '<span class="sod_option sod_option_custom" title="'.$fabric_color['name'].'" 
                                            data-type="color"
                                            data-value="'.$fabric_color['slug'].'">'.$fabric_color['name'].'</span>';
                                        endforeach; ?>										
                                    </span>
                                </span>	
                            </div>
                        </div>
                    </div>

                    <div class="attributes-swatches-container">
                        <?php
                            
                            $limit = 0;			
                            $fabric_types = [];
                            foreach($fabric_terms as $term) {
                                
                                $swatch 		= get_field('fabric_swatch', $term->taxonomy . '_' . $term->term_id);
                                $fabric_type 	= get_field('linked_fabric_type', $term->taxonomy . '_' . $term->term_id);
                                $fabric_class 	= get_field('linked_fabric_class', $term->taxonomy . '_' . $term->term_id);

                                $fabric_color = get_field('fabric_color', $term->taxonomy . '_' . $term->term_id);
                                $thumb = $swatch['sizes']['thumbnail'] ? $swatch['sizes']['thumbnail'] : wc_placeholder_img_src();
                                $full = $swatch['sizes']['large'] ? $swatch['sizes']['large'] : wc_placeholder_img_src();
                            
                                echo '<a class="single-swatch single-swatch__fabric" data-src="'.$thumb.'" data-src_full="'.$full.'" data-name="'.$term->name.'">
                                    <p class="newTitle">'.$term->name.'</p>
                                    <img data-attribute_slug="'.$term->slug.'" data-fabric_name="'.$term->name.'" 
                                    data-class_name="'.$fabric_class->name.'" data-class_slug="'.$fabric_class->slug.'"
                                    data-type_name="'.$fabric_type->name.'" data-type_slug="'.$fabric_type->slug.'" 
                                    data-color_name="'.$fabric_color->name.'" data-color_slug="'.$fabric_color->slug.'" class="single-swatch-img" width="48px" height="48px" src="'.$thumb.'" />
                                    <div class="is-active-indicator"></div>
                                    </a>';
                                // if(++$limit == 20) break;													
                            } 
                            ?>
                            
                    </div>
                    <style>
                        p.newTitle {
                            font-size: 0px;
                        }
                         .fabric-custom-search-single {
                        padding: 0 0 10px 15px;
                        clear:both;
                        display: block;
                    }
                    input#fabrics-search-single {
                        width: 50%;
                    }
                    </style>
                </div>
            </div>
        <!-- <a class="button load-more-fabrics">View More Fabrics</a> -->

    <?php }

}

/**
 * Fabrics Quickview
 *
 */
function woo_fabric_preview() { ?>
    <div class="attribute-preview swatch-preview is-right">
        <a class="preview-close">
            <i class="nm-font-close2"></i>
        </a>
        <div class="swatch-meta">
            <div class="swatch-details">
                <span class="swatch-details-label">Your Choice: </span>
                <span class="swatch-preview__attribute fabric-name"></span>
                <span class="swatch-preview__attribute leg-type"></span>
                <span class="swatch-preview__attribute leg-stain"></span>
                <span class="swatch-preview__attribute cross-stitch"></span>
                <span class="product-price">
                    $<span class="product-price-value"></span>
                </span>
            </div>	
            <img />
        </div>
        <div class="swatch-preview-footer">
            <a class="swatch-preview-button swatch-preview-add_to_cart">Shop Now</a>
            <a class="swatch-preview-button swatch-preview-enquire">Enquire</a>
        </div>
    </div>

    <div class="attribute-preview non-swatch-preview is-left">
        <a class="preview-close">
            <i class="nm-font-close2"></i>
        </a>
        <img />
    </div>
<?php }

add_action( 'woocommerce_after_single_product', 'woo_fabric_preview' );

/**
 * Move product tabs beside the product image - WooCommerce
 */
 
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 35 );

/**
 * Add To Cart Area
 */

// Conditionally show add to cart button
add_filter('body_class', function($classes) {

    $id = get_queried_object_id();

    if(is_singular('product')) {

        // echo $id;

        if(get_field('show_add_to_cart', $id) == false) {
            $classes[] = 'hide_add_to_cart_button';     
        }

        $terms = get_the_terms( $id, 'product_cat' );
        foreach($terms as $term) {
            $classes[] = 'category_'.$term->slug;
        }

    }
    return $classes;
});


// Change 'add to cart' text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'savoy_child_add_to_cart_text' );
function savoy_child_add_to_cart_text() {
    if ( !has_term( 'samples', 'product_cat' ) ) {        
        return __( esc_attr_e( get_theme_mod( 'add_to_cart_text', 'Add to Cart' ), 'savoy-child'), 'savoy-child' );
    } else {
        return __( 'Add To Cart', 'savoy-child' );
    }
}

// Add enquiry button
add_action( 'woocommerce_single_product_summary', 'before_add_to_cart_enquiry', 25 );

function before_add_to_cart_enquiry() {
    echo '<button id="nm-enquiry-popup-trigger" type="submit" class="button alt mt1 mb1 single_enquire_button">
    <i class="nm-menu-cart-icon nm-font nm-font-envelope"></i>
    Enquire About Product & Pricing
    </button>';
}

// Add captions to products

function gcw_insert_captions( $html, $attachment_id ) {
	$captions = '';
	$title = get_post_field( 'post_title', $attachment_id );
	if( !empty( $title ) ) {
		$captions .= '<h5>' . esc_html( $title ) . '</h5>';
	}
	$description = get_post_field( 'post_excerpt', $attachment_id );
	if( !empty( $description ) ) {
		$captions .= '<p>' . $description . '</p>';
	}
	if( !empty( $captions ) ) {
		$captions = '<div class="woocommerce-product-gallery__image-caption">' . $captions . '</div>';
		
		$html = preg_replace('~<\/div>$~', $captions . '</div>', $html );
	}
	return $html;
}
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'gcw_insert_captions', 10, 2 );

// Product swatches page

function woo_sample_options( ) {
    // build out the filters

    $fabric_terms = get_terms( 'pa_fabric' );

    if($fabric_terms) {
        $fabric_types = [];
        $fabric_colors = [];
        $fabric_names = [];

        foreach($fabric_terms as $term) {

            $fabric_names[$term->name] = array( 'name' => $term->name );

            $fabric_type = get_field('linked_fabric_type', $term->taxonomy . '_' . $term->term_id);
            
            if($fabric_type) {
                $fabric_types[$fabric_type->slug] = array(
                    'slug' => $fabric_type->slug,
                    'name' => $fabric_type->name
                );
            }
    
            $fabric_color = get_field('fabric_color', $term->taxonomy . '_' . $term->term_id);
    
            if($fabric_color) {
                $fabric_colors[$fabric_color->slug] = array(
                    'slug' => $fabric_color->slug,
                    'name' => $fabric_color->name
                );
            }
        }
//var_dump($fabric_names);
        usort($fabric_names, build_sort_asc('name'));
//var_dump($fabric_names);
        ?>
        <div class="woocommerce-product-gallery">
            <div class="samples-variations-form">
                
                <h5>Select up to 5 Swatches</h5>
                <div class="content">
                   
                <!-- CUSTOM WORK START -->

                    <div class="fabric-custom-search">
                        <label for="fabric Search">Fabric Search</label>
                        <input type="search" class="Search For Fabric" id="fabrics-search" aria-label="Search for fabrics" placeholder="Search for fabrics" data-search></input>
                    </div> 

                  

                    <style>
                    p.newTitle {
                        /* display: none; */
                        font-size: 0px;
                    }
                    .fabric-custom-search {
                        padding: 0 0 10px 15px;
                        clear:both;
                        display: block;
                    }
                    input#fabrics-search {
                        width: 50%;
                    }
                    .hiddenMe {
                        display: none;
                    }
                    </style>




                <!-- CUSTOM WORK END -->    
                         <div class="fabric-swatches-filter-list">
                        <div class="sod_custom">
                            <div class="label sod_label_custom"><label for="Fabric Name">Fabric Name</label></div>
                            <div class="value">
                                <span class="sod_select focus" tabindex="0" data-cycle="false" data-links="false" data-links-external="false" data-placeholder-option="false" data-filter="">
                                    <span class="sod_label sod_label_custom">Choose fabric name</span>
                                    <span class="sod_list_wrapper sod_list_wrapper_custom">
                                        <span class="sod_list">
                                        <span class="sod_option active sod_option_reset" title="Choose fabric name" data-value="">Choose fabric name</span>
                                            <?php foreach($fabric_names as $fabric):

                                                echo '<span class="sod_option sod_option_custom" title="'.$fabric['name'].'"
                                                data-type="name" data-value="'.$fabric['name'].'">'.$fabric['name'].'</span>';
                                            endforeach; ?>
                                        </span>
                                    </span>

                            </div>
                        </div>
                    </div>

                    <div class="fabric-swatches-filters">
                        <div class="sod_custom">
                            <div class="label"><label for="<?php echo esc_attr( sanitize_title( 'pa_fabric-type' ) ); ?>"><?php echo wc_attribute_label( 'pa_fabric-type' ); // WPCS: XSS ok. ?></label></div>
                            <div class="value">														
                                <span class="sod_select focus" tabindex="0" data-cycle="false" data-links="false" data-links-external="false" data-placeholder-option="false" data-filter="">
                                    <span class="sod_label sod_label_custom">Choose an option</span>
                                    <span class="sod_list_wrapper sod_list_wrapper_custom">
                                        <span class="sod_list">
                                        <span class="sod_option active sod_option_reset" title="Choose an option" data-value="">Choose an option</span>
                                            <?php foreach($fabric_types as $fabric_type):
                                                
                                                echo '<span class="sod_option sod_option_custom" title="'.$fabric_type['name'].'" 
                                                data-type="type" data-value="'.$fabric_type['slug'].'">'.$fabric_type['name'].'</span>';
                                            endforeach; ?>										
                                        </span>
                                    </span>	
                                                
                            </div>
                        </div>
                        <div class="sod_custom">
                            <div class="label sod_label_custom"><label for="Fabric Color">Fabric Color</label></div>
                            <div class="value">
                                <span class="sod_select focus" tabindex="0" data-cycle="false" data-links="false" data-links-external="false" data-placeholder-option="false" data-filter="">
                                    <span class="sod_label sod_label_custom">Choose an option</span>
                                    <span class="sod_list_wrapper sod_list_wrapper_custom">
                                        <span class="sod_list">
                                        <span class="sod_option active sod_option_reset" title="Choose an option" data-value="">Choose an option</span>
                                        <?php foreach($fabric_colors as $fabric_color):
                                            echo '<span class="sod_option sod_option_custom" title="'.$fabric_color['name'].'" 
                                            data-type="color"                                                                                    
                                            data-value="'.$fabric_color['slug'].'">'.$fabric_color['name'].'</span>';
                                        endforeach; ?>										
                                    </span>
                                </span>	
                            </div>
                        </div>
                    </div>

                    <div class="attributes-swatches-container">
                        <?php	
                            $limit = 0;			
                            $fabric_types = [];
                            foreach($fabric_terms as $term) {
                                
                                $swatch = get_field('fabric_swatch', $term->taxonomy . '_' . $term->term_id);
                                $fabric_type 	= get_field('linked_fabric_type', $term->taxonomy . '_' . $term->term_id);
                                $fabric_class 	= get_field('linked_fabric_class', $term->taxonomy . '_' . $term->term_id);

                                $fabric_color   = get_field('fabric_color', $term->taxonomy . '_' . $term->term_id);
                                
                                $thumb  = $swatch['sizes']['thumbnail'] ? $swatch['sizes']['thumbnail'] : wc_placeholder_img_src();
                                $full   = $swatch['sizes']['large'] ? $swatch['sizes']['large'] : wc_placeholder_img_src();

                                echo '<a class="single-sample-swatch single-swatch__sample" data-src="'.$thumb.'" data-src_full="'.$full.'" data-name="'.$term->name.'">
                                    <p class="newTitle">'.$term->name.'</p>
                                    <img data-attribute_slug="'.$term->slug.'" data-fabric_name="'.$term->name.'" data-name_slug="'.$term->name.'"
                                    data-type_name="'.$fabric_type->name.'" data-type_slug="'.$fabric_type->slug.'"
                                    data-color_name="'.$fabric_color->name.'" data-color_slug="'.$fabric_color->slug.'"
                                    class="single-swatch-img" width="48px" height="48px" src="'.$thumb.'" />
                                    <div class="is-active-indicator"></div>
                                    </a>';
                                // if(++$limit == 20) break;													
                            } 
                            ?>
                            
                    </div>
                </div>
            </div>
        </div>

        <div class="attribute-preview non-swatch-preview is-left">
            <a class="preview-close">
                <i class="nm-font-close2"></i>
            </a>
            <img />
        </div>

    <?php }

}

// Custom fields
/* 
* Display input on single product page
* @return html
*/
function savoy_swatches_samples(){
    $value = isset( $_POST['_swatches_samples'] ) ? sanitize_text_field( $_POST['_swatches_samples'] ) : '';
    printf( '<div class="swatch-samples-results"><label>%s</label><textarea type="textarea" class="swatch-sample-results__input" rows="3" id="swatch-samples" name="_swatches_samples" value="%s"></textarea></div>', __( 'Your swatches:', 'savoy-child' ), esc_attr( $value ) );
 }
 
 
 function savoy_add_to_cart_validation($passed, $product_id, $qty){
  
     if( isset( $_POST['_swatches_samples'] ) && sanitize_text_field( $_POST['_swatches_samples'] ) == '' ){
         $product = wc_get_product( $product_id );
         wc_add_notice( sprintf( __( '%s cannot be added to the cart until you select some swatches.', 'savoy-child' ), $product->get_title() ), 'error' );
         return false;
     }
  
     return $passed;
  
 }

add_action( 'wp', 'savoy_child_product_swatches_html' );
function savoy_child_product_swatches_html() {
    if ( is_product() && has_term( 'samples', 'product_cat' ) ) {
        remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
        remove_action( 'woocommerce_single_product_summary', 'before_add_to_cart_enquiry', 25 );

        add_action( 'woocommerce_before_single_product_summary', 'woo_sample_options', 20 );
        add_action( 'woocommerce_before_add_to_cart_button', 'savoy_swatches_samples', 9 );
        add_filter( 'woocommerce_add_to_cart_validation', 'savoy_add_to_cart_validation', 10, 3 );
    }
}

function savoy_add_cart_item_data( $cart_item, $product_id ){
 
    if( isset( $_POST['_swatches_samples'] ) ) {
        $cart_item['swatches_samples'] = sanitize_text_field( $_POST['_swatches_samples'] );
    }
 
    return $cart_item;
 
}

add_filter( 'woocommerce_add_cart_item_data', 'savoy_add_cart_item_data', 10, 2 );

function savoy_child_get_cart_item_from_session( $cart_item, $values ) {
 
    if ( isset( $values['swatches_samples'] ) ){
        $cart_item['swatches_samples'] = $values['swatches_samples'];
    }
 
    return $cart_item;
 
}
add_filter( 'woocommerce_get_cart_item_from_session', 'savoy_child_get_cart_item_from_session', 20, 2 );

/*
 * Add meta to order item
 * @param int $item_id
 * @param array $values
 * @return void
 */
function savoy_child_add_order_item_meta( $item_id, $values ) {
 
    if ( ! empty( $values['swatches_samples'] ) ) {
        woocommerce_add_order_item_meta( $item_id, 'swatches_samples', $values['swatches_samples'] );           
    }
}
add_action( 'woocommerce_add_order_item_meta', 'savoy_child_add_order_item_meta', 10, 2 );

/*
 * Get item data to display in cart
 * @param array $other_data
 * @param array $cart_item
 * @return array
 */
function savoy_child_get_item_data( $other_data, $cart_item ) {
 
    if ( isset( $cart_item['swatches_samples'] ) ){
 
        $other_data[] = array(
            'name' => __( 'Your swatches', 'savoy-child' ),
            'value' => sanitize_text_field( $cart_item['swatches_samples'] )
        );
 
    }
 
    return $other_data;
 
}
add_filter( 'woocommerce_get_item_data', 'savoy_child_get_item_data', 10, 2 );

/*
 * Show custom field in order overview
 * @param array $cart_item
 * @param array $order_item
 * @return array
 */
function savoy_child_order_item_product( $cart_item, $order_item ){
 
    if( isset( $order_item['swatches_samples'] ) ){
        $cart_item_meta['swatches_samples'] = $order_item['swatches_samples'];
    }
 
    return $cart_item;
 
}
add_filter( 'woocommerce_order_item_product', 'savoy_child_order_item_product', 10, 2 );

/* 
 * Add the field to order emails 
 * @param array $keys 
 * @return array 
 */ 
function savoy_child_email_order_meta_fields( $fields ) { 
    $fields['custom_field'] = __( 'Your swatches', 'savoy-child' ); 
    return $fields; 
} 
add_filter('woocommerce_email_order_meta_fields', 'savoy_child_email_order_meta_fields');

/* Order Again
* @param array $cart_item
* @param array $order_item
* @param obj $order
* @return array
*/
function savoy_child_order_again_cart_item_data( $cart_item, $order_item, $order ){

   if( isset( $order_item['swatches_samples'] ) ){
       $cart_item_meta['swatches_samples'] = $order_item['swatches_samples'];
   }

   return $cart_item;

}
add_filter( 'woocommerce_order_again_cart_item_data', 'savoy_child_order_again_cart_item_data', 10, 3 );


// usort routines
function build_sort_asc($key) {
    return function ($a, $b) use ($key) {
        return strnatcmp(strtolower($a[$key]), strtolower($b[$key]));
    };
}
function build_sort_desc($key) {
    return function ($a, $b) use ($key) {
        return strnatcmp(strtolower($b[$key]), strtolower($a[$key]));
    };
}



