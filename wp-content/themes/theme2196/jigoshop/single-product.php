<?php get_header('shop');
$jigoshop_options = Jigoshop_Base::get_options();
get_header(); ?>
	<div id="content" class="grid_8 <?php echo of_get_option('blog_sidebar_pos') ?>">

	<div class="bc-wrap">
		<?php do_action('jigoshop_before_main_content', 'jigoshop_breadcrumb', 20, 0); ?>
	</div>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); global $_product; $_product = &new jigoshop_product( $post->ID ); ?>

		<?php do_action('jigoshop_before_single_product', $post, $_product); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php do_action('tm_single_product_images', $post, $_product); ?>

			<div class="summary">
				
				<div class="category"><?php echo $_product->get_categories( ', ', ' <div class="posted_in">' . __( 'Category:&nbsp;', 'theme2196' ) . '', '.</div>'); ?></div>
				 
					<h2 class="product_title added"><?php echo $_product->get_title(); ?></h2>
					<div class="attributes">
						<?php $availability = $_product->get_availability();
						if ( $availability <> '' ) {
							?>
							<div class="product-avlb <?php echo $availability['class'] ?>"><?php echo $availability['availability']; ?></div>
							<?php
						}?>
					<div class="product-price"><span class="label">Price: </span><?php echo apply_filters( 'jigoshop_single_product_price', $_product->get_price_html() ); ?></div>
                    <div class="single_prod_rate">
                        <div class="rating">
                            <?php 
                                if ($_product->get_rating_html( 'sidebar' )!='') {
                                    echo $_product->get_rating_html( 'sidebar' ); 
                                } else {
                                    _e('Not rated', 'theme2196');
                                }
                            ?>
                        </div>
                        <div class="reviews-number">
                            <?php comments_number( 'No reviews', '1 Review', '% Reviews' ); ?>
                        </div>
                    </div>
					</div>
				<?php do_action( 'jigoshop_template_single_summary', $post, $_product ); ?>
                <div class="share-buttons">
                	<div class="addthis_toolbox addthis_default_style tm_style"></div>
                </div>
			</div>
				
			<div class="clear"></div>
			<?php do_action('jigoshop_after_single_product_summary', $post, $_product); ?>

		</div>

		<?php do_action('jigoshop_after_single_product', $post, $_product); ?>

	<?php endwhile; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>