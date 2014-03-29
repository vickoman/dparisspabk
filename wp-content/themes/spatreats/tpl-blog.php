<?php /*Template Name: Blog Template*/?>
<?php get_header();?>
<?php $tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
	  $tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
	  
	  $page_layout  = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : "content-full-width";
  	  $show_sidebar = false;
	  $sidebar_class= "";
	  
  	$categories 	= isset($tpl_default_settings['blog-post-exclude-categories']) ? array_filter($tpl_default_settings['blog-post-exclude-categories']) : NULL;
	$post_per_page 	= $tpl_default_settings['blog-post-per-page'];

	  
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
	  endswitch;?>

    	<!-- **Content Full Width** -->
    	<div class="content <?php echo $page_layout;?>">

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

<?php	if( have_posts() ):
			while( have_posts() ):
				the_post(); ?>
                <!-- #post-<?php the_ID(); ?> -->
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php the_content(); 
					  wp_link_pages( array(	'before' =>	'<div class="page-link">', 'after' => '</div>','link_before' =>	'<span>','link_after' => '</span>',
					  						'next_or_number' =>	'number','pagelink' =>	'%', 'echo' =>1 ) );
					  edit_post_link( __( ' Edit ','spatreats' ) );?>
				</div><!-- #post-<?php the_ID(); ?> -->
<?php 		endwhile;
		endif;?>
        
        <div class="clear"></div>
<!--- Start loop to show blog posts -->
<?php 			  if(empty($categories)):
					$args = array('paged'=>get_query_var('paged'),'posts_per_page'=>$post_per_page,'post_type'=> 'post');
				  else:
					$exclude_cats = array_unique($categories);
					$args = array('paged'=>get_query_var('paged'),'posts_per_page'=>$post_per_page,'category__not_in'=>$exclude_cats,'post_type'=>'post');
				   endif;
				   
   				   query_posts($args);
				   if( have_posts() ):
				   	while( have_posts() ):
						the_post();?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
                        	<div class="post-title">
								<?php if(is_sticky()): ?>	
                                        <div class="featured"><span><?php _e('Featured','spatreats');?></span></div>
                                <?php endif;?>
                                <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s'), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
                                <a href="<?php the_permalink(); ?>" class="tooltip-top readmore" title="<?php _e('Read More','spatreats');?>"> </a>
                                <span class="arrow"> </span>
                            </div><!-- .post-title -->
                            
                            <div class="post-details">
                            	<div class="date">
                                	<span class="day"><?php echo get_the_date('d');?></span>
                                    <span class="date-group">
                                    	<span class="month"><?php echo get_the_date('M');?></span>
                                        <span class="year"><?php echo get_the_date('Y');?></span>
                                    </span>
                                    <span class="arrow"> </span> 
                            	</div><!-- .date -->
                            
                            	<?php if ( comments_open() && ! post_password_required() ) : ?>
                            	<div class="post-comments">
                		        	<?php comments_popup_link('<span class="count"> 0 </span>  <span class="comment">Comment</span>', '<span class="count">1</span>  <span class="comment">Comment</span>', '<span class="count">%</span> <span class="comment">Comment</span>');?>
				        	    	<span class="arrow"> </span>
					        	</div> <!-- .post-comments -->
        					<?php endif;?>
                             </div><!-- .post-details -->
                          
                          	<div class="post-content">
                          	<?php $attachment  = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID));
								  if( $attachment ):?>
                                  	<div class="post-thumb">
                                    	<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s'), the_title_attribute( 'echo=0' ) ); ?>">
                                        <?php  $attachment =  wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'my-blog');
											   if($attachment[3]): #Original Size my-blog 
											   	if($attachment[1] == 850 && $attachment[2] == 340):?>
                                                	<img alt="<?php the_title(); ?>" src="<?php echo $attachment[0]; ?>" width="<?php echo $attachment[1]; ?>" 
                                                    	 height="<?php echo $attachment[2]; ?>" />
                                       	<?php   else: ?>
                                        			<img alt="<?php the_title();?>" class="alignleft" src="<?php echo $attachment[0]; ?>" width="<?php echo $attachment[1]; ?>" 
                                                    	height="<?php echo $attachment[2]; ?>" />
                    					<?php 	endif; ?>
										<?php  else: #Image original size  ?>
												<img alt="<?php the_title(); ?>" class="alignleft" src="<?php echo $attachment[0]; ?>" width="<?php echo $attachment[1]; ?>" 
                                                	height="<?php echo $attachment[2]; ?>" />
                                         <?php endif;?></a>
                                     </div>
                           <?php endif; ?>
                           
                           <?php echo wpe_excerpt('wpe_excerptlength_blog', 'wpe_no_excerptmore');?>
                           <?php edit_post_link( __( 'Edit','spatreats'), '<span class="edit-link">', '</span>' ); ?>
						  </div><!-- .pos-content -->

                        
                        </div><!-- #post-<?php the_ID()?> Ends -->
<?php				endwhile;
				   endif;?>

                    <!-- **Pagination** -->
                    <div class="pagination">
                        <div class="prev-post"> <?php previous_posts_link('<span> Prev Posts </span>');?> </div>           
                        <div class="next-post"> <?php next_posts_link('<span> Next Posts </span>');?> </div>
                        <?php my_pagination();?>
                    </div><!-- **Pagination - End** -->
                   
<!--- End of loop to show blog posts -->        
        </div> <!-- **Content  - End** -->
          
<?php if($show_sidebar): ?>
		<!-- **Sidebar** -->
    	<div class="sidebar <?php echo $sidebar_class;?>"><?php 	
			get_sidebar();?></div><!-- **Sidebar - End** -->
<?php endif; 
	  get_footer();?>