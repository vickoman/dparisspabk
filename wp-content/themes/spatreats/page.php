<?php get_header();?>
<?php $tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
	  $tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
	  
	  $page_layout  = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : "content-full-width";
  	  $show_sidebar = false;
	  $sidebar_class= "";
	  
	  switch($page_layout):
		case 'with-left-sidebar':
			$page_layout 	=	"content-with-sidebar with-left-sidebar";
			$show_sidebar 	= 	true;
			$sidebar_class 	=	"with-left-sidebar";
		break;
		
		case 'with-right-sidebar':
			$show_sidebar 	=  true;
			$page_layout 	= "content-with-sidebar with-right-sidebar";
			$sidebar_class  = "with-right-sidebar";
		break;
	  endswitch;
	  
	  #Page Top Code Section
	  $mytheme_options = get_option(IAMD_THEME_SETTINGS);
	  $mytheme_integration = !empty($mytheme_options['integration']) ? $mytheme_options['integration'] : array();
	  if(isset($mytheme_integration['enable-single-page-top-code']))	echo stripslashes($mytheme_integration['single-page-top-code']); ?>

    	<!-- **Content Full Width** -->
    	<div class="content <?php echo $page_layout;?>">
        	<?php if( have_posts() ): ?>
        	<?php while ( have_posts() ) : the_post(); ?>
            <?php	get_template_part('framework/loops/content','page'); ?>
            <?php endwhile; ?>
            <?php else:?>
            	<div class="hr_invisible"> </div>
            	<h1><?php _e( 'Nothing Found', 'spatreats' ); ?></h1>
				<h3><?php _e( 'Apologies, but no posts found in blog.', 'spatreats' ); ?></h3>
				<?php get_search_form(); ?>
            <?php endif;?>
        </div> <!-- **Content  - End** -->
          
<?php if($show_sidebar): ?>
		<!-- **Sidebar** -->
    	<div class="sidebar <?php echo $sidebar_class;?>"><?php 	
			get_sidebar();?></div><!-- **Sidebar - End** -->
<?php endif; ?>

<?php #Page Top Code Section
	  if(isset($mytheme_integration['enable-single-page-bottom-code']))	echo stripslashes($mytheme_integration['single-page-bottom-code']);
	  get_footer();?>