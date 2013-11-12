    <?php $post_meta = of_get_option('post_meta'); ?>
		<?php if ($post_meta=='true' || $post_meta=='') { ?>
			<div class="post-meta">
				<div class="fleft"><?php _e('Posted by', 'theme2196'); ?> <?php the_author_posts_link() ?></div>
				<div class="fright"><?php comments_popup_link('0 Comment(s)', '1 Comment(s)', '% Comment(s)', 'comments-link', 'Comments are closed'); ?></div>
			</div><!--.post-meta-->
		<?php } ?>		
