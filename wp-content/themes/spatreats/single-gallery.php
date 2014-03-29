<?php global $my_theme_settings; ?>
<?php get_header(); ?>

<!-- Post header code -->
<?php #Page Top Code Section
	  $mytheme_options = get_option(IAMD_THEME_SETTINGS);	
	  $mytheme_integration = !empty($mytheme_options['integration']) ? $mytheme_options['integration'] : array();
	  if(isset($mytheme_integration['enable-single-post-top-code']))	echo stripslashes($mytheme_integration['single-post-top-code']); ?>
<!-- Post header code end-->

    	<!-- **Content Full Width** -->
    	<div class="content content-full-width">
        	<?php get_template_part( 'framework/loops/content', 'single-gallery' ); ?>
            
            <?php
			//CHECKING RELATED ITEMS...
			$meta_set = get_post_meta($post->ID, '_gallery_post_meta', true);
			if(isset($meta_set['show-releated-items']) != ""): ?>
               <!-- Related Post Section -->
               <div class="hr_invisible"></div>
               <?php get_template_part( 'framework/loops/content', 'releated-gallery' ); ?>      
               <!-- Releated post section end --><?php
			endif; ?>   
                  
            <!-- Post bottom code -->
            <?php #Page Top Code Section
				  if(isset($mytheme_integration['enable-single-post-bottom-code']))	echo stripslashes($mytheme_integration['single-post-bottom-code']); ?>
            <!-- Post bottom code end-->
        </div><!-- **Content Full Width - End** -->
        
<?php get_footer();?>