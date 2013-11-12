  </div><!--.container-->
	<footer id="footer">
		<div class="container_12 clearfix">
    	<div id="widgets-footer" class="clearfix">
        	<div class="grid_4">
				<?php if ( ! dynamic_sidebar( 'Footer 1' ) ) : ?>
                  <!--Widgetized Footer-->
                <?php endif ?>
            </div>
            <div class="footer_widgets_2">
				<?php if ( ! dynamic_sidebar( 'Footer 2' ) ) : ?>
                  <!--Widgetized Footer-->
                <?php endif ?>
            </div>
            <div class="grid_2">
				<?php if ( ! dynamic_sidebar( 'Footer 3' ) ) : ?>
                  <!--Widgetized Footer-->
                <?php endif ?>
            </div>
      	</div>
      		<div class="grid_12">
				<div id="copyright" class="clearfix">
					<?php if ( of_get_option('footer_menu') == 'true') { ?>  
						<nav class="footer">
							<?php wp_nav_menu( array(
								'container'       => 'ul', 
								'menu_class'      => 'footer-nav', 
								'depth'           => 0,
								'theme_location' => 'footer_menu' 
								)); 
							?>
						</nav>
					<?php } ?>
					<div id="footer-text">
						<?php $myfooter_text = of_get_option('footer_text'); ?>
						
						<?php if($myfooter_text){?>
							<?php echo of_get_option('footer_text'); ?>
						<?php } else { ?>
							<a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>" class="site-name"><?php bloginfo('name'); ?></a> <?php _e('is proudly powered by', 'theme2196'); ?> <a href="http://wordpress.org">WordPress</a> <a href="<?php if ( of_get_option('feed_url') != '' ) { echo of_get_option('feed_url'); } else bloginfo('rss2_url'); ?>" rel="nofollow" title="<?php _e('Entries (RSS)', 'theme2196'); ?>"><?php _e('Entries (RSS)', 'theme2196'); ?></a> and <a href="<?php bloginfo('comments_rss2_url'); ?>" rel="nofollow"><?php _e('Comments (RSS)', 'theme2196'); ?></a>&nbsp;&nbsp;&nbsp;
							<a href="<?php bloginfo('url'); ?>/privacy-policy/" title="Privacy Policy"><?php _e('Privacy Policy', 'theme2196'); ?></a>
						<?php } ?>
						<?php if( is_front_page() ) { ?>
						<!-- {%FOOTER_LINK} -->
						<?php } ?>
					</div>
					
				</div>
			</div>
		</div><!--.container-->
        <div id="back-top-wrapper">
            <p id="back-top"><a href="#top"></a></p>
        </div>
	</footer>
    </div>
    </div>
</div><!--#main-->
<?php wp_footer(); ?> <!-- this is used by many Wordpress features and for plugins to work properly -->
<?php if(of_get_option('ga_code')) { ?>
	<script type="text/javascript">
		<?php echo stripslashes(of_get_option('ga_code')); ?>
	</script>
  <!-- Show Google Analytics -->	
<?php } ?>
</body>
</html>