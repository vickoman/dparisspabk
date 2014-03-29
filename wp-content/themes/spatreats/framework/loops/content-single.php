<?php $tpl_default_settings = get_post_meta($post->ID,'_dt_post_settings',TRUE);
	  $tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();?>
        	<!-- **Blog Header** -->
        	<div class="blog-header">
            	<ul class="cat-menu">
                    <li><a href="#" rel="toggle[categories]" title=""><?php _e('Categories','spatreats');?><span class="arrow-down"> </span> </a></li>
                    <li><a href="#" rel="toggle[archives]" title=""><?php _e('Archive','spatreats');?><span class="arrow-down"> </span></a> </li>
                </ul>
                <div id="categories" class="categories-list">      
                	<ul><?php wp_list_categories('show_count=1&echo=1&title_li=&depth=1&hide_empty=0&orderby=ID');?></ul>                                      	
                </div><!-- #categories -->
                
                <div id="archives" class="categories-list">
            		<ul><?php wp_get_archives('type=monthly'); ?></ul>
        		</div>
                         
            </div><!-- **Blog Header - End** -->
        
        
            <div id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
            
            	<div class="post-title">
                	<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s'), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
                    <span class="arrow"> </span>
            	</div><!-- .post-title -->
                
                <div class="post-details">
                
                	<div class="date">
                    	<span class="day"><?php echo  get_the_date('d');?></span>
                        <span class="date-group">
                        	<span class="month"><?php  echo get_the_date('M');?></span>
                            <span class="year"><?php echo  get_the_date('Y');?></span>
                        </span>
                        <span class="arrow"> </span> 
                     </div><!-- .date -->

					<?php if ( comments_open() && ! post_password_required() ):?>
                    <div class="post-comments">
                        <?php comments_popup_link('<span class="count"> 0 </span>  <span class="comment">Comment</span>', 
                                '<span class="count">1</span>  <span class="comment">Comment</span>', '<span class="count">%</span> <span class="comment">Comment</span>');?>
                        <span class="arrow"> </span>
                    </div> <!-- .post-comments -->
                    <?php endif;?>
                    
                    <div class="blog-post-social"><?php mytheme_social_bookmarks();?></div>
                    
                </div><!-- .post-details -->
                
                <div class="post-content"><?php
				if( !isset($tpl_default_settings['disable-featured-image']) ):
				
					$attachment  = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID));
					if( $attachment ):?>
                    	<div class="post-thumb"><?php
							$attachment =  wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'my-blog');
							if($attachment[3]): #Original Size my-blog 
							
                      	      if($attachment[1] == 850 && $attachment[2] == 340):?>
                        	        <img alt="<?php the_title(); ?>" src="<?php echo $attachment[0]; ?>" width="<?php echo $attachment[1]; ?>" height="<?php echo $attachment[2]; ?>" />
                   	  <?php   else: ?>
                             	<img alt="<?php the_title();?>" class="alignleft" src="<?php echo $attachment[0];?>" width="<?php echo $attachment[1];?>"
                                	 height="<?php echo $attachment[2];?>" />
                      <?php   endif;
                 			else: #Image original size  ?>
                         		<img alt="<?php the_title(); ?>" class="alignleft" src="<?php echo $attachment[0]; ?>" width="<?php echo $attachment[1]; ?>" 
                                	height="<?php echo $attachment[2]; ?>" />
                	 <?php endif;?>
                     	</div>
<?php 				endif;
				endif;
			
            		the_content();
					
					wp_link_pages( array( 'before' => '<div class="page-link">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>',
									'next_or_number' => 'number','pagelink' => '%','echo' => 1 ) );
			
          	  		if(get_the_tags($post->ID)) :?>
	                	<div class="post-tags"><span></span><?php the_tags('',', ');?></div> <!-- .post-tags -->
<?php 				endif; ?>
                </div><!-- .pos-content -->
                
            </div><!-- #post-<?php the_ID(); ?> -->
            <?php edit_post_link( __( 'Edit','spatreats'), '<span class="edit-link">', '</span>' ); ?>
            
<?php $mytheme_options = get_option(IAMD_THEME_SETTINGS);
	  $mytheme_general = $mytheme_options['general'];
	  $globally_disable_post_comment =  array_key_exists('global-post-comment',$mytheme_general) ? true : false; 
	  if( (!$globally_disable_post_comment) && (! isset($tpl_default_settings['disable-comment'])) ):?>
            <!-- **Comment Entries** -->   	
            <div id="comments" class="comment-entry">
                <?php  comments_template('', true); ?>
            </div><!-- **Comment Entries - End** -->
<?php endif;

if( !isset($tpl_default_settings['disable-releated-post']) ): ?>
	<!-- Related Post Section -->
	<div class="hr_invisible"></div>
    <?php echo do_shortcode('[related-post/]'); ?>
    <!-- Releated post section end -->                    
<?php endif;?>