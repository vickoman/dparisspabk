<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="ie ie6 lte9 lte8 lte7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>     <html class="ie ie7 lte9 lte8 lte7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="ie ie8 lte9 lte8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>     <html class="ie ie9 lte9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]>  <html> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php is_mytheme_moible_view();?>
<title><?php mytheme_public_title();?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php	#To load basic css
		load_mytheme_basic_css();
			
		#To Load responsive.css 
		set_mytheme_layout();
		
		do_action('load_head_styles_scripts');
		
		if(mytheme_option('integration', 'enable-header-code'))
			echo stripslashes(mytheme_option('integration', 'header-code'));
			
		#WordPress Default head hook
		wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- **Header** -->
<div id="header">
	<div class="container">

    	<!-- **Top-Menu** -->
    	<div id="top-menu">
        	<?php $primaryMenu = NULL; 
				if (function_exists('wp_nav_menu')) :
					$primaryMenu = wp_nav_menu(array('theme_location'=>'main','menu_id'=>'','menu_class'=>'menu'
						,'fallback_cb'=>'my_default_navigation','echo'=>false,'walker' => new my_menu_walker())); 
				endif;
				if(!empty($primaryMenu)):
					echo $primaryMenu;
				endif;?>
        </div><!-- **Top-Menu - End** -->

        <!-- **Logo** -->
        <div id="logo">
        	<a href="<?php echo home_url();?>" title="<?php echo get_bloginfo('description');?>">
            <?php $logo = mytheme_option('general', 'logo-url');
				  $logo = !empty($logo) ? $logo : IAMD_BASE_URL.'/images/logo.png';?>
            	<img src="<?php echo $logo;?>" alt="<?php echo get_bloginfo('description');?>" title="<?php echo get_bloginfo('description');?>" /></a>
        </div><!-- **Logo - End** -->

        <!-- **Searchform** -->
        <?php get_search_form();?>
        <!-- **Searchform - End** -->
        
    </div><!-- ** container -->
</div><!-- **Header - End** -->

<?php  $show_breadcrumb = true;
	   $tpl_default_settings = array();
	   
		if( is_page() ):
			global $post;
			$tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
		elseif( is_post_type_archive('product') ):
			$tpl_default_settings = get_post_meta(get_option('woocommerce_shop_page_id'),'_tpl_default_settings',TRUE);
		endif;	
		
		if( isset( $tpl_default_settings['show_slider']) && isset( $tpl_default_settings['slider_type']) ):
			$show_breadcrumb = false; ?>
        	<!-- ** Home Slider** -->
            <div id="home-slider">
            	<div class="slider-container"><?php
					if($tpl_default_settings['slider_type'] === "layerslider"):
						$id = $tpl_default_settings['layerslider_id'];
						echo do_shortcode("[layerslider id='{$id}']");
					elseif( $tpl_default_settings['slider_type'] === "revolutionslider" ):
						$id = $tpl_default_settings['revolutionslider_id'];
						echo do_shortcode("[rev_slider $id]");
					endif;?></div><!-- .slider-container -->
            </div><!-- **Home Slider - End** -->
<?php 	endif;?>

<!-- ** Main** -->
<div id="main">
<?php	if(!is_front_page()):
			$disable_breadcrumb = mytheme_option('general','disable-breadcrumb');
				if( empty($disable_breadcrumb) && $show_breadcrumb ):
					new my_breadcrumb;
				endif;	
		endif;?>
	<!-- **Main Container** -->
	<div class="main-container">