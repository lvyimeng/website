<?php 

if (!is_admin()) {
	//wp_enqueue_script( 'jquery_ui', get_bloginfo('template_url').'/jigoshop/jquery-ui-1.9.0.custom.js', array('jquery'));
    wp_enqueue_script('jigoscript', get_bloginfo('template_url').'/jigoshop/jigoscript.js', array('jquery'), '1.0');
    //wp_enqueue_script( 'jigoshop_script', get_bloginfo('template_url').'/jigoshop/script.js', array('jquery'));
}

//Register sidebars

if (!function_exists('jigoshop_widgets_init')) {
function jigoshop_widgets_init() {
    // Cart Holder
    register_sidebar(array(
        'name'                  => 'Cart Holder',
        'id'                        => 'cart-holder',
        'description'   => __( 'Contains shopping cart.'),
        'before_widget' => '<div id="%2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><div class="widget-holder">',
    ));
}
//Overriding jigoshop functions

add_action( 'widgets_init', 'jigoshop_widgets_init' );
}
  
add_image_size( 'single', 100, 100, true ); // Slider Small Thumbnail


// Show product images


add_action( 'tm_single_product_images', 'tm_show_product_images'    , 10);

function tm_show_product_images() {

    global $_product, $post;
    $jigoshop_options = Jigoshop_Base::get_options();

?>
    <div class="images">
        <?php
            $args = array(
                'post_type' => 'attachment', 
                'post_mime_type' => 'image', 
                'numberposts' => -1, 
                'post_status' => null, 
                'post_parent' => $post->ID, 
                'orderby' => 'menu_order', 
                'order' => 'asc'
            );
            $attachments = get_posts( $args );
            if ( $attachments ) { 
        ?>
        <div id="holder" class="img-holder">
            <?php
                    $large_img_w = $jigoshop_options->get_option('jigoshop_shop_large_w');
                    $large_img_h = $jigoshop_options->get_option('jigoshop_shop_large_h');
                    $th_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                    $image = aq_resize( $th_url, $large_img_w, $large_img_h, true );
            ?>
            <?php if ( has_post_thumbnail() ) { ?>
            <a id="prettyLink" href="<?php echo $th_url; ?>" rel="prettyPhoto" class="item1" title="<?php echo get_the_title(); ?>">
                <img alt="<?php the_title(); ?>" src="<?php echo $image; ?>">
            </a>
            <?php } else {
                $iter = 0;
                $iter_alt = 0;
                foreach ( $attachments as $attachment ) {
                    $iter_alt ++;
                    $cur_url = wp_get_attachment_url( $attachment->ID, false );
                    $image = aq_resize( $cur_url, $large_img_w, $large_img_h, true );
                    if ( ! $image || $cur_url == get_post_meta($post->ID, 'file_path', true) ) {
                        $check = 1;
                        continue;
                    }
                    if ($iter == 0) {
            ?>
                <a id="prettyLink" href="<?php echo $cur_url; ?>" rel="prettyPhoto" class="item1" title="<?php echo get_the_title(); ?>">
                    <img alt="<?php the_title(); ?>" src="<?php echo $image; ?>">
                </a>
            <?php
                    }
                    $iter ++;
                }
            } 
            if ( (1 == $check) && (1 == $iter_alt)) {
            ?>
            <img src="<?php bloginfo( 'template_url' ); ?>/images/placeholder.png" alt="<?php the_title(); ?>">
            <?php
            }
        ?>
        </div>
        <div class="sub-pager">
            <?php
                
                    if ( has_post_thumbnail() ) {
                        $th_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                        $image_lr = aq_resize( $th_url, $large_img_w, $large_img_h, true );
                        $image = aq_resize( $th_url, 90, 90, true );
                        echo "<a class='cur' href='".$image_lr."' data-href='".$th_url."'>";
                            echo "<img alt='".get_the_title()."' src='".$image."'>";
                        echo "</a>";
                    }
                   
                    foreach ( $attachments as $attachment ) {
                        $cur_url = wp_get_attachment_url( $attachment->ID, false );
                        if ($cur_url != $th_url) {
                            $image = aq_resize( $cur_url, 90, 90, true);
                            if ( ! $image || $cur_url == get_post_meta($post->ID, 'file_path', true) )
                                continue;
                            $image_lr = aq_resize( $cur_url, $large_img_w, $large_img_h, true );
                            
                            echo "<a href='".$image_lr."' data-href='".$cur_url."'>";
                                echo "<img alt='".get_the_title()."' src='".$image."'>";
                            echo "</a>";
                        }
                    }
            ?>
        </div>
    <?php } else { ?>
        <div id="holder" class="img-holder">
            <img src="<?php bloginfo( 'template_url' ); ?>/images/placeholder.png" alt="<?php the_title(); ?>">
        </div>
    <?php } ?>
    </div>
<?php
}

    // Product Brands

    $brand_labels = array(
        'name' => __( 'Brands' ),
        'singular_name' => __( 'Brand' ),
        'search_items' =>  __( 'Search Brands' ),
        'popular_items' => __( 'Popular Brands' ),
        'all_items' => __( 'All Brands' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit Brand' ), 
        'update_item' => __( 'Update Brand' ),
        'add_new_item' => __( 'Add New Brand' ),
        'new_item_name' => __( 'New Brand Name' ),
        'add_or_remove_items' => __( 'Add or remove brands' ),
        'choose_from_most_used' => __( 'Choose from the most used brands' ),
        'menu_name' => __( 'Brands' ),
      ); 

    register_taxonomy('brands','product',array(
    'hierarchical' => true,
    'labels' => $brand_labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'brand' ),
    ));
    /**
     * Category thumbnails
     */

    if (!function_exists('jigoshop_brands_image')) {
        function jigoshop_brands_image($id) {

            if( empty($id) )
                return false;

            $thumbnail_id   = get_metadata('jigoshop_term', $id, 'brand_thumbnail_id', true);
            $category_image = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id )
                                            : get_bloginfo( 'template_url' ).'/images/placeholder.png';

            return array('image' => $category_image, 'thumb_id' => $thumbnail_id);

        }
    }

    add_action('brands_add_form_fields' , 'brands_add_thumbnail_field');
    add_action('brands_edit_form_fields', 'brands_edit_thumbnail_field', 10,2);

    function brands_add_thumbnail_field() {
        $image = get_bloginfo( 'template_url' ).'/images/placeholder.png';
        ?>
        <div class="form-field">
            <label><?php _e('Thumbnail', 'theme2196'); ?></label>
            <div id="brands_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo $image; ?>" width="60px" height="60px" /></div>
            <div style="line-height:60px;">
                <input type="hidden" id="brands_thumbnail_id" name="brands_thumbnail_id" />
                <button type="submit" class="upload_image_button button"><?php _e('Upload/Add image', 'theme2196'); ?></button>
                <button type="submit" class="remove_image_button button"><?php _e('Remove image', 'theme2196'); ?></button>
            </div>
            <script type="text/javascript">
                jQuery(function(){
                    jQuery('#brands_thumbnail_id').val('');
                })
                window.send_to_termmeta = function(html) {

                    jQuery('body').append('<div id="temp_image">' + html + '</div>');

                    var img = jQuery('#temp_image').find('img');

                    imgurl      = img.attr('src');
                    imgclass    = img.attr('class');
                    imgid       = parseInt(imgclass.replace(/\D/g, ''), 10);

                    jQuery('#brands_thumbnail_id').val(imgid);
                    jQuery('#brands_thumbnail img').attr('src', imgurl);
                    jQuery('#temp_image').remove();

                    tb_remove();
                }

                jQuery('.upload_image_button').live('click', function(e){
                    e.preventDefault();
                    var post_id = 0;

                    window.send_to_editor = window.send_to_termmeta;

                    tb_show('', 'media-upload.php?post_id=' + post_id + '&amp;type=image&amp;TB_iframe=true');
                    return false;
                });

                jQuery('.remove_image_button').live('click', function(){
                    jQuery('#brands_thumbnail img').attr('src', '<?php echo $image; ?>');
                    jQuery('#brands_thumbnail_id').val('');
                    return false;
                });

            </script>
            <div class="clear"></div>
        </div>
        <?php
    }

    function brands_edit_thumbnail_field( $term, $taxonomy ) {
        $image = jigoshop_brands_image($term->term_id);
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label><?php _e('Thumbnail', 'theme2196'); ?></label></th>
            <td>
                <div id="brands_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo $image['image']; ?>" width="60px" height="60px" /></div>
                <div style="line-height:60px;">
                    <input type="hidden" id="brands_thumbnail_id" name="brands_thumbnail_id" value="<?php echo $image['thumb_id']; ?>" />
                    <button type="submit" class="upload_image_button button"><?php _e('Upload/Add image', 'theme2196'); ?></button>
                    <button type="submit" class="remove_image_button button"><?php _e('Remove image', 'theme2196'); ?></button>
                </div>
                <script type="text/javascript">
                    jQuery(function(){
                        jQuery('#brands_thumbnail_id').val('');
                    })
                    window.send_to_termmeta = function(html) {

                        jQuery('body').append('<div id="temp_image">' + html + '</div>');

                        var img = jQuery('#temp_image').find('img');

                        imgurl      = img.attr('src');
                        imgclass    = img.attr('class');
                        imgid       = parseInt(imgclass.replace(/\D/g, ''), 10);

                        jQuery('#brands_thumbnail_id').val(imgid);
                        jQuery('#brands_thumbnail img').attr('src', imgurl);
                        jQuery('#temp_image').remove();

                        tb_remove();
                    }

                    jQuery('.upload_image_button').live('click', function(e){
                        e.preventDefault();
                        var post_id = 0;

                        window.send_to_editor = window.send_to_termmeta;

                        tb_show('', 'media-upload.php?post_id=' + post_id + '&amp;type=image&amp;TB_iframe=true');
                        return false;
                    });

                    jQuery('.remove_image_button').live('click', function(){
                        jQuery('#brands_thumbnail img').attr('src', '<?php echo jigoshop::assets_url().'/assets/images/placeholder.png'; ?>');
                        jQuery('#brands_thumbnail_id').val('');
                        return false;
                    });

                </script>
                <div class="clear"></div>
            </td>
        </tr>
        <?php
    }

    add_action('created_term', 'barnds_thumbnail_field_save', 10,3);
    add_action('edit_term'   , 'barnds_thumbnail_field_save', 10,3);

    function barnds_thumbnail_field_save( $term_id, $tt_id, $taxonomy ) {

        if (!isset($_POST['brands_thumbnail_id']))
            return false;

        update_metadata( 'jigoshop_term', $term_id, 'brands_thumbnail_id', $_POST['brands_thumbnail_id'] );

    }

    /**
    * Thumbnail column for categories
    */
    add_filter("manage_edit-brands_columns", 'jigoshop_brands_columns');
    add_filter("manage_brands_custom_column", 'jigoshop_brands_column', 10, 3);

    function jigoshop_brands_columns( $columns ) {

        $new_columns = array(
            'cb'    => $columns['cb'],
            'thumb' => null
        );

        unset($columns['cb']);
        $columns = array_merge( $new_columns, $columns );

        return $columns;

    }

    function jigoshop_brands_column( $columns, $column, $id ) {

        if ($column != 'thumb')
            return false;

        $brands = get_terms( 'brands', 'orderby=count&hide_empty=0' );
        foreach ($brands as $brand) {
            if($brand->term_id==$id) {
                global $wpdb;
                $brand_thumb = $wpdb->get_row("SELECT * FROM $wpdb->jigoshop_termmeta WHERE jigoshop_term_id = $id AND meta_key = 'brands_thumbnail_id'", ARRAY_A);
                $brand_thumb_url = wp_get_attachment_image_src($brand_thumb['meta_value'],'full');
                $brand_image = aq_resize( $brand_thumb_url[0], 32, 32, true );
                if ($brand_image=='') {$brand_image = get_bloginfo( 'template_url' ).'/images/placeholder.png';}
            }
        }
        $columns .= '<a class="row-title" href="'.get_edit_term_link( $id, 'brands', 'product' ).'">';
        $columns .= '<img src="'.$brand_image.'" alt="Thumbnail" class="wp-post-image" height="32" width="32" />';
        $columns .= '</a>';

        return $columns;

    }


if (!function_exists('jigoshop_output_content_wrapper')) {
    function jigoshop_output_content_wrapper() {
        if(  get_option('template') === 'twentyeleven' ) echo '<section id="primary"><div id="content" role="main">';
        else echo '';  /* twenty-ten */
    }
}
include_once (TEMPLATEPATH . '/jigoshop/widgets/my-recent_products.php');
include_once (TEMPLATEPATH . '/jigoshop/widgets/my-featured_products.php');
//include_once (TEMPLATEPATH . '/jigoshop/widgets/my-cart.php');
add_action("widgets_init", "load_jigo_widgets");
if (!function_exists('load_jigo_widgets')) {
function load_jigo_widgets() {

    register_widget("MY_RecentProducts");
    register_widget("MY_FeaturedProducts");
    //register_widget("My_Widget_Cart");
}
}
if (!function_exists('jigoshop_pagination')) {
    function jigoshop_pagination() {

        global $wp_query;

        if (  $wp_query->max_num_pages > 1 ) :
            get_template_part('includes/post-formats/post-nav');
        endif;

    }
}

if (!function_exists('jigoshop_product_attributes_tab')) {
    function jigoshop_product_attributes_tab( $current_tab ) {

        global $_product;
        if( ( $_product->has_attributes() || $_product->has_dimensions() || $_product->has_weight() ) ):
        ?>
        <li <?php if ($current_tab=='#tab-attributes') echo 'class="active"'; ?>><a href="#tab-attributes"><?php _e('Info', 'theme2196'); ?></a></li><?php endif;

    }
}
if (!function_exists('jigoshop_output_related_products')) {
 function jigoshop_output_related_products() {
        $jigoshop_options = Jigoshop_Base::get_options();
  if ($jigoshop_options->get_option ('jigoshop_enable_related_products') != 'no')
   // 2 Related Products in 2 columns
   jigoshop_related_products( 3, 3 );
 }
}
//### Sale products shortcode #########################################################

function on_sale_products( $atts ) {
	global $columns, $per_page, $paged;

	extract(shortcode_atts(array(
		'per_page'                  => Jigoshop_Base::get_options()->get_option('jigoshop_catalog_per_page'),
		'columns'                   => Jigoshop_Base::get_options()->get_option('jigoshop_catalog_columns'),
		'orderby'                   => Jigoshop_Base::get_options()->get_option('jigoshop_catalog_sort_orderby'),
		'order'                     => Jigoshop_Base::get_options()->get_option('jigoshop_catalog_sort_direction'),
		'pagination'                => false
	), $atts));

  	$today = date('Y-m-d',time());
  	$tomorrow = date('Y-m-d',mktime(0, 0, 0, date("m"), date("d")+1, date("Y")) );

	$args = array(
		'post_type'                 => array( 'product' ),
		'post_status'               => 'publish',
		'ignore_sticky_posts'       => 1,
		'posts_per_page'            => $per_page,
		'orderby'                   => $orderby,
		'order'                     => $order,
		'meta_query'                => array(
				array(
						'key'       => 'visibility',
						'value'     => array( 'catalog', 'visible' ),
						'compare'   => 'IN'
				),
				array(
						'key'       => 'sale_price',
						'value'     => '',
						'compare'   => '!='
				)
		)
	);
	@query_posts($args);
	ob_start();
	jigoshop_get_template_part( 'loop', 'shop' );
	if ( $pagination ) do_action( 'jigoshop_pagination' );
	wp_reset_query();
	return ob_get_clean();
}
add_shortcode('on_sale', 'on_sale_products');
?>