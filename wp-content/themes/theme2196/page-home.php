<?php
/**
 * Template Name: Home Page
 */

get_header(); ?>
<div class="clearfix">
  <div class="home-page-content clearfix">
  	<div class="grid_12">
	  <?php if ( ! dynamic_sidebar( 'Main Content Area' ) ) : ?>
        <!--Widgetized 'Main Content Area' for the home page-->
      <?php endif ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>