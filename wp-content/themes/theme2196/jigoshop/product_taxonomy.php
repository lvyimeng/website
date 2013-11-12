<?php
//php get_header('shop');
get_header();?>
		<div id="content" class="grid_8 <?php echo of_get_option('blog_sidebar_pos') ?>"><div id= "shop">
        
        <div class="bc-wrap">
            <?php do_action('jigoshop_before_main_content', 'jigoshop_breadcrumb', 20, 0); ?>
        </div>

		<?php global $wp_query; $term = get_term_by( 'slug', get_query_var($wp_query->query_vars['taxonomy']), $wp_query->query_vars['taxonomy']); ?>

		<h1 class="page_title"><?php echo wptexturize($term->name); ?></h1>

		<?php echo wpautop(wptexturize($term->description)); ?>

		<?php get_template_part( 'loop', 'shop' ); ?>

		<?php do_action('jigoshop_pagination'); ?>

		</div></div>

<?php get_sidebar(); ?>  
<?php get_footer();?>