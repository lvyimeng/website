<?php get_header(); ?>
<div id="content">
	<div id="error404" class="clearfix">
  	<div class="error404-num grid_7">404</div>
    <div class="grid_5">
    	<hgroup>
        <?php echo '<h1>' . __('Sorry!', 'theme2196') . '</h1>'; ?>
        <?php echo '<h2>' . __('Page Not Found', 'theme2196') . '</h2>'; ?>
      </hgroup>
      <?php echo '<h6>' . __('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'theme2196') . '</h6>'; ?>
      <?php echo '<p>' . __('Please try using our search box below to look for information on the internet.', 'theme2196') . '</p>'; ?>
      <?php get_search_form(); /* outputs the default Wordpress search form */ ?>
    </div>
	</div><!--#error404 .post-->
</div><!--#content-->
<?php get_footer(); ?>