<?php
/**
 * Archive template
 *
 * DISCLAIMER
 *
 * Do not edit or add directly to this file if you wish to upgrade Jigoshop to newer
 * versions in the future. If you wish to customise Jigoshop core for your needs,
 * please use our GitHub repository to publish essential changes for consideration.
 *
 * @package             Jigoshop
 * @category            Catalog
 * @author              Jigowatt
 * @copyright           Copyright © 2011-2012 Jigowatt Ltd.
 * @license             http://jigoshop.com/license/commercial-edition
 */
?>

<?php get_header('shop'); ?>
<div class="grid_8 <?php echo of_get_option('blog_sidebar_pos') ?>" id="content"><div class="shop">
	<div class="bc-wrap">
		<?php do_action('jigoshop_before_main_content', 'jigoshop_breadcrumb', 20, 0); ?>
	</div>
	<?php if (is_search()) : ?>
		<h1 class="page_title"><?php _e('Search Results:', 'theme2196'); ?> &ldquo;<?php the_search_query(); ?>&rdquo; <?php if (get_query_var('paged')) echo ' &mdash; Page '.get_query_var('paged'); ?></h1>
	<?php else : ?>
		<h1 class="page_title"><?php _e('All Products', 'theme2196'); ?></h1>
	<?php endif; ?>

	<?php
		$shop_page_id = jigoshop_get_page_id('shop');
		$shop_page = get_post($shop_page_id);
		echo apply_filters('the_content', $shop_page->post_content);
	?>

	<?php jigoshop_get_template_part( 'loop', 'shop' ); ?>

	<?php do_action('jigoshop_pagination'); ?>
</div></div>
<?php get_sidebar(); ?>
<?php get_footer('shop'); ?>