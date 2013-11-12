<article id="post-<?php the_ID(); ?>" <?php post_class('post-holder'); ?>>
				
				
				<?php if(!is_singular()) : ?>
				<header class="entry-header">
				<time datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('j M'); ?></time>
                <div class="post-head-right">
                	<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'theme1771');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<?php get_template_part('includes/post-formats/post-meta'); ?>
                </div>
                
				<?php else :?>
                <header class="entry-header single">
				<time datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('j M'); ?></time>
                <div class="post-head-right">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <?php get_template_part('includes/post-formats/post-meta'); ?>
                </div>
				<?php endif; ?>
				
				</header>
				
				
				<?php get_template_part('includes/post-formats/post-thumb'); ?>
				
				
				<?php if(!is_singular()) : ?>
				
				<div class="post-content not-single">
					<?php $post_excerpt = of_get_option('post_excerpt'); ?>
					<?php if ($post_excerpt=='true' || $post_excerpt=='') { ?>
						
						<div class="excerpt">
						
						
						<?php 
						
						$content = get_the_content();
						$excerpt = get_the_excerpt();

						if (has_excerpt()) {

								the_excerpt();

						} else {
						
								if(!is_search()) {

								echo my_string_limit_words($content,45);
								
								} else {
								
								echo my_string_limit_words($excerpt,45);
								
								}

						}
						
						
						?>
						
						</div>
						
						
					<?php } ?>
					<a href="<?php the_permalink() ?>" class="button"><?php _e('More', 'theme2196'); ?></a>
				</div>
				
				<?php else :?>
				
				<div class="content">
				
					<?php the_content(''); ?>
					
				<!--// .content -->
				</div>
				<div class="clear"></div>
				<footer class="post-footer">
					<?php the_tags('Tags: ', ' ', ''); ?>
				</footer>
			 	<?php endif; ?>
                <div class="clear"></div>
			</article>