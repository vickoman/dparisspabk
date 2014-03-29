<?php get_header();
	#Page Top Code Section
	$mytheme_options = get_option(IAMD_THEME_SETTINGS);
	
	$mytheme_integration = !empty($mytheme_options['integration']) ? $mytheme_options['integration'] : array();
	if(isset($mytheme_integration['enable-single-post-top-code']))	echo stripslashes($mytheme_integration['single-post-top-code']);

	$tpl_default_settings = get_post_meta($post->ID,'_dt_post_settings',TRUE);
	$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
	  
	$post_layout = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : "content-full-width";
  	$show_sidebar = false;
	$sidebar_class= "";

	  switch($post_layout):
		case 'with-left-sidebar':
			$post_layout 	= "content-with-sidebar with-left-sidebar";
			$show_sidebar 	= true;
			$sidebar_class 	= "with-left-sidebar";
		break;
		
		case 'with-right-sidebar':
			$show_sidebar 	=  true;
			$post_layout 	= "content-with-sidebar with-right-sidebar";
			$sidebar_class  = "with-right-sidebar";
		break;
	  endswitch; ?>
      
	 <!-- **Content Full Width** -->
    <div class="content <?php echo $post_layout;?>">
<?php if( have_posts() ):
		while ( have_posts() ) :
			the_post();
				get_template_part( 'framework/loops/content', 'single' );
		endwhile;
      endif;?>
    </div> <!-- **Content  - End** -->
<?php if($show_sidebar): ?>
		<!-- **Sidebar** -->
    	<div class="sidebar <?php echo $sidebar_class;?>"><?php  get_sidebar();?></div><!-- **Sidebar - End** -->
<?php endif; 
	#Page Top Code Section
	if(isset($mytheme_integration['enable-single-post-bottom-code']))	echo stripslashes($mytheme_integration['single-post-bottom-code']);
get_footer();?>