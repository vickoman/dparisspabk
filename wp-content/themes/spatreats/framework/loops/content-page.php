<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php 	if(has_post_thumbnail()):
			$attr = array('class' => 'alignleft', 'title' => get_the_title());	
			the_post_thumbnail('my-gallery',$attr);
		endif;
		
		the_content();
		
    	wp_link_pages( array( 'before' => '<div class="page-link">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>','next_or_number' => 'number',
			'pagelink' => '%','echo' => 1 ) );
			
		echo '<div class="social-share">';
			mytheme_social_bookmarks('sb-page');
		echo '</div>';
		
		edit_post_link( __( 'Edit','spatreats' ), '<span class="edit-link">', '</span>' ); ?>
</div><!-- #post-<?php the_ID(); ?> -->
<?php $tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
	  $tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
	  
	  $mytheme_options = get_option(IAMD_THEME_SETTINGS);
	  $mytheme_general = $mytheme_options['general'];
	  
  	  $globally_disable_page_comment =  array_key_exists('disable-page-comment',$mytheme_general) ? true : false;
	  if( (!$globally_disable_page_comment) && (isset($tpl_default_settings['comment'])) ): ?>
          <!-- **Comment Entries** -->   	
        <div id="comments" class="comment-entry"><?php
          	comments_template('', true); ?></div><!-- **Comment Entries - End** -->
<?php endif;?>