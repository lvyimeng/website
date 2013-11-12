<?php
// =============================== My Request Quote Widget ======================================
class MY_FeaturedProducts extends WP_Widget {
    /** constructor */
    function MY_FeaturedProducts() {
        parent::WP_Widget(false, $name = 'My - Featured Products');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
		global $columns, $per_page;	
		if (!isset($columns) || !$columns) $columns = apply_filters('loop_shop_columns', 3);
		if (!isset($per_page) || !$per_page) $per_page = apply_filters('loop_shop_per_page', get_option('posts_per_page'));			
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$prod_count = apply_filters('prod_count', $instance['prod_count']);
		$show_desc = apply_filters('show_desc', $instance['show_desc']);
		$show_rating = apply_filters('show_rating', $instance['show_rating']);
		$query_args = array(
				'posts_per_page'=> $prod_count,
				'post_type'     => 'product',
				'post_status'   => 'publish',
				'meta_key'      => 'featured',
				'meta_value'    => '1',
				'meta_query'    => array(
					array(
						'key'    => 'visibility',
						'value'  => array('catalog', 'visible'),
						'compare'=> 'IN',
					),
				)
			);
        $prod = new WP_Query( $query_args );
			if ( $prod->have_posts() ) {
        ?>
              <?php echo $before_widget; ?>
			  			<div class="featured-products">	
							<div class="widgetHolder">
								<?php if($title!=""){ echo $before_title; echo $title; echo $after_title; $loop = 0; } ?>
                                <ul class="products">
                                <?php while( $prod->have_posts() ) : $prod->the_post(); $_product = new jigoshop_product( get_the_ID() ); $loop++;?>
                                    <li class="product <?php if ($loop%$columns==0) echo 'last'; if (($loop-1)%$columns==0) echo 'first'; ?>">
                                        <div class="product-inner">
                                        <?php do_action('jigoshop_before_shop_loop_item'); ?>
                                        <div class="product-image-wrap"><a href="<?php the_permalink(); ?>" class="product-image"><?php do_action('jigoshop_before_shop_loop_item_title', $post, $_product); ?></a></div>
                                        
                                        <div class="caption">
                                            <h3 class="title"><a href="<?php the_permalink(); ?>" class="product-info"><?php the_title(); ?></a></h3>
                                            <?php if ( $instance['show_desc'] ) : ?><div class="short-desc"><?php the_excerpt(); ?></div><?php endif; ?>
                                            
                                            <?php if ( $instance['show_rating'] ) : ?>
                                            <div class="prod_rate">
                                            <?php 
                                                if ($_product->get_rating_html( 'sidebar' )!='') {
                                                    echo $_product->get_rating_html( 'sidebar' ); 
                                                } else {
                                                    _e('Not rated', 'theme2196');
                                                }
                                            ?>
                                            </div>
                                            <div class="clear"></div>
                                            <?php endif; ?>
                                            <div class="product-meta">
                                                <?php do_action('jigoshop_after_shop_loop_item_title', $prod, $_product); ?>
                                                <a href="<?php echo get_permalink($_product->id) ?>"; class="button"><?php _e('Details', 'theme2196'); ?></a>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                        </div>
                                    </li>
                                <?php endwhile; ?>
                                </ul>
							</div>
						</div>
              <?php echo $after_widget; ?>
        <?php }
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
				$prod_count = esc_attr($instance['prod_count']);
				$show_desc = esc_attr($instance['show_desc']);
				$show_rating = esc_attr($instance['show_rating']);
        ?>
       <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'theme2196'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			 
			 <p><label for="<?php echo $this->get_field_id('prod_count'); ?>"><?php _e('Count of Products:', 'theme2196'); ?> <input id="<?php echo $this->get_field_id('prod_count'); ?>" size="3" name="<?php echo $this->get_field_name('prod_count'); ?>" type="text" value="<?php echo $prod_count; ?>" /></label></p>
		 <p>
      <label for="<?php echo $this->get_field_id("show_desc"); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_desc"); ?>" name="<?php echo $this->get_field_name("show_desc"); ?>"<?php checked( (bool) $instance["show_desc"], true ); ?> />
          <?php _e( 'Show product description' ); ?>
      </label>
  </p>
  <p>
      <label for="<?php echo $this->get_field_id("show_rating"); ?>">
          <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_rating"); ?>" name="<?php echo $this->get_field_name("show_rating"); ?>"<?php checked( (bool) $instance["show_rating"], true ); ?> />
          <?php _e( 'Show product rating' ); ?>
      </label>
  </p>
        <?php 
    }

} // class Request Quote Widget

?>