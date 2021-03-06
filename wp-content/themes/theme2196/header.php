<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes();?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes();?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]-->
<head>
	<title><?php if ( is_category() ) {
		echo __('Category Archive for &quot;', 'theme2196'); single_cat_title(); echo __('&quot; | ', 'theme2196'); bloginfo( 'name' );
	} elseif ( is_tag() ) {
		echo __('Tag Archive for &quot;', 'theme2196'); single_tag_title(); echo __('&quot; | ', 'theme2196'); bloginfo( 'name' );
	} elseif ( is_archive() ) {
		wp_title(''); echo __(' Archive | ', 'theme2196'); bloginfo( 'name' );
	} elseif ( is_search() ) {
		echo __('Search for &quot;', 'theme2196').wp_specialchars($s).__('&quot; | ', 'theme2196'); bloginfo( 'name' );
	} elseif ( is_home() || is_front_page()) {
		bloginfo( 'name' ); if (get_bloginfo( 'description' ) != '') {echo ' | ';} bloginfo( 'description' );
	}  elseif ( is_404() ) {
		echo __('Error 404 Not Found | ', 'theme2196'); bloginfo( 'name' );
	} elseif ( is_single() ) {
		wp_title('');
	} else {
		echo wp_title( ' | ', false, right ); bloginfo( 'name' );
	} ?></title>
	<meta name="description" content="<?php wp_title(); echo ' | '; bloginfo( 'description' ); ?>" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
  <?php if(of_get_option('favicon') != ''){ ?>
	<link rel="icon" href="<?php echo of_get_option('favicon', "" ); ?>" type="image/x-icon" />
	<?php } else { ?>
	<link rel="icon" href="<?php bloginfo( 'template_url' ); ?>/favicon.ico" type="image/x-icon" />
	<?php } ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />
	<?php /* The HTML5 Shim is required for older browsers, mainly older versions IE */ ?>
  <!--[if lt IE 8]>
    <div style=' clear: both; text-align:center; position: relative;'>
    	<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="" /></a>
    </div>
  <![endif]-->
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/normalize.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/prettyPhoto.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/flexslider.css" />
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/skeleton.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/touchTouch.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/320.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/480.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/768.css" />
	<?php
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
	
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
	?>
  <!--[if gte IE 9]>
  <style type="text/css">
    .home-page-content .post_list li .extra-wrap, 
    .onsale, 
    .main-content-box .left-border, 
    .main-content-box .right-border,
    #jigoshop_cart .widget-holder,
    .product #tabs .panel,
    .product.type-product .images + .summary .attributes .product-avlb,
    .single-product .summary fieldset.variations,
    #breadcrumb,
    .pagenavi span, .pagenavi a {
       filter: none;
    }
  </style>
<![endif]-->
  
  <script type="text/javascript">
  	// initialise plugins
		jQuery(function(){
			// main navigation init
			jQuery('ul.sf-menu').superfish({
				delay:       <?php echo of_get_option('sf_delay'); ?>, 		// one second delay on mouseout 
				animation:   {opacity:'<?php echo of_get_option('sf_f_animation'); ?>'<?php if (of_get_option('sf_sl_animation')=='show') { ?>,height:'<?php echo of_get_option('sf_sl_animation'); ?>'<?php } ?>}, // fade-in and slide-down animation
				speed:       '<?php echo of_get_option('sf_speed'); ?>',  // faster animation speed 
				autoArrows:  <?php echo of_get_option('sf_arrows'); ?>,   // generation of arrow mark-up (for submenu) 
				dropShadows: false
			});
			
			// prettyphoto init
			   if(jQuery(window).width() > 480){
				  jQuery("a[rel^='prettyPhoto']").prettyPhoto({
				   animation_speed:'normal',
				   slideshow:5000,
				   autoplay_slideshow: false,
				   overlay_gallery: true
				  });}
				  else{
				   jQuery("a[rel^='prettyPhoto']").click(function(){
					return false;
				   })
				  }
			
			// Initialize the gallery
			jQuery("#gallery .touch-item").touchTouch();
			
			
		});
		jQuery(function(){
		  var ismobile = navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(android)|(webOS)/i)
		  if(ismobile){
		   jQuery('.sf-menu').sftouchscreen({});
		 }
		});
		// Init for audiojs
		audiojs.events.ready(function() {
			var as = audiojs.createAll();
		});
		
		// Init for si.files
		SI.Files.stylizeAll();
  </script>
	
	
	<!--[if (gt IE 9)|!(IE)]><!-->
	<script type="text/javascript">
		jQuery(function(){
			jQuery('.sf-menu').mobileMenu();
		})
	</script>
	<!--<![endif]-->
  
  
	
  <!-- Custom CSS -->
	<?php if(of_get_option('custom_css') != ''){?>
  <style type="text/css">
  	<?php echo of_get_option('custom_css' ) ?>
  </style>
  <?php }?>
  
  
  
  
  <style type="text/css">
		<?php $background = of_get_option('body_background');
			if ($background != '') {
				if ($background['image'] != '') {
					echo 'body { background-image:url('.$background['image']. '); background-repeat:'.$background['repeat'].'; background-position:'.$background['position'].';  background-attachment:'.$background['attachment'].'; }';
				}
				if($background['color'] != '') {
					echo 'body { background-color:'.$background['color']. '}';
				}
			};
		?>
		
		<?php $header_styling = of_get_option('header_color'); 
			if($header_styling != '') {
				echo '#header {background:'.$header_styling.'}';
			}
		?>
		
		<?php $links_styling = of_get_option('links_color'); 
			if($links_styling) {
				echo 'a{color:'.$links_styling.'}';
				echo '.button {background:'.$links_styling.'}';
			}
		?>

  </style>
</head>

<body <?php body_class(); ?>>
<div id="main"><!-- this encompasses the entire Web site -->
	<header id="header">
    	<div class="top-row">
			<div class="container_12 clearfix">
				<div class="grid_12">
                    <div class="top-row-inner clearfix">
                       <div class="logo">
						  <?php if(of_get_option('logo_type') == 'text_logo'){?>
                            <?php if( is_front_page() || is_home() || is_404() ) { ?>
                              <h1><a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a></h1>
                            <?php } else { ?>
                              <h2><a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a></h2>
                            <?php } ?>
                          <?php } else { ?>
                            <?php if(of_get_option('logo_url') != ''){ ?>
                                <a href="<?php bloginfo('url'); ?>/" id="logo"><img src="<?php echo of_get_option('logo_url', "" ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
                            <?php } else { ?>
                                <a href="<?php bloginfo('url'); ?>/" id="logo"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
                            <?php } ?>
                          <?php }?>
                          <p class="tagline"><?php bloginfo('description'); ?></p>
                        </div>
                        <?php if ( of_get_option('g_search_box_id') == 'yes') { ?>  
                        <div id="top-search">
                            <form method="get" action="<?php echo get_option('home'); ?>/">
                                 <input type="text" name="s"  class="input-search"/><input type="submit" value="<?php _e('Search', 'theme2196'); ?>" id="submit">
                            </form>
                        </div>  
                        <?php } ?>
                    </div>
                </div>  
            </div>
        </div>
        <div class="middle-row">
            	<div class="container_12 clearfix">
					<div class="grid_12">
                    	<div class="shopping-block">
                            <nav class="shop-nav">
                              <?php
                                 wp_nav_menu( array(
                                'container'       => 'ul', 
                                'menu_class'      => 'shop-menu', 
                                'menu_id'         => 'shopnav',
                                'depth'           => 0,
                                'theme_location' => 'shop_menu'
                                )); 
                              ?>
                            </nav>
                            <div id="cart-holder">
                                <?php if ( ! dynamic_sidebar( 'Cart Holder' ) ) : ?><!-- Wigitized Cart Holder --><?php endif ?>
                            </div>
                            <div class="clear"></div>
                        </div>
         			</div>
                </div>
        </div>
	</header>
       <div class="main-content-box">
         <div class="content-box-inner">
       	 <div class="container_12 clearfix">
         	<div class="grid_12">
             <nav class="primary">
              <?php wp_nav_menu( array(
                'container'       => 'ul', 
                'menu_class'      => 'sf-menu', 
                'menu_id'         => 'topnav',
                'depth'           => 0,
                'theme_location' => 'header_menu' 
                )); 
              ?>
            </nav><!--.primary-->
        	</div>
        </div>
  <?php if( is_front_page() ) { ?>
  <section id="slider-wrapper">
   <div class="container_12 clearfix">
        <div class="grid_12">
      	<?php include_once(TEMPLATEPATH . '/slider.php'); ?>
        </div>
  	</div>
  </section><!--#slider-->
  <?php } ?>
	<div class="container_12 primary_content_wrap clearfix">