<?php /*Template Name: Gallery Template*/?>
<?php get_header();?>
<?php $tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
	  $tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
	  
	  $page_layout  = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : "content-full-width";
	  $show_sidebar = false;
	  $sidebar_class= "";
	  
	  $post_layout  = array_key_exists("gallery-post-layout",$tpl_default_settings) ? $tpl_default_settings['gallery-post-layout'] : "one-third-column";
	  $ajax_class 	= array_key_exists("is_ajax_load",$tpl_default_settings) ? 'ajax-gallery-container' : "";
	  $sortable 	= array_key_exists("is_sortable",$tpl_default_settings) ? 'sortable' : "";
	  $items_per_page =  $tpl_default_settings['gallery-post-per-page'];
	  
	  $categories 		= isset($tpl_default_settings['gallery-categories']) ? array_filter($tpl_default_settings['gallery-categories']) : "";
	  if( empty($categories) ):
	  	$categories = get_categories('taxonomy=gallery_entries&hide_empty=1');
	  else:
	  	$args = array('taxonomy'=>'gallery_entries','hide_empty'=>1,'include'=>$categories);
		$categories = get_categories($args);
	  endif;
	  
	  
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
	  
	  
	  $grid = $image_size = $c_count = "";
	  
	  switch($post_layout):
	  	case 'one-column':
			$c_count = 1;
			if( $show_sidebar ):
				$image_size = "my-gallery";
				$grid = "full-width full-width-with-sidebar";
			else:
				$image_size = "my-gallery";
				$grid = "full-width";
			endif;
		break;
		
		case 'one-half-column':
			$c_count = 2;
			if( $show_sidebar ):
				$image_size = "gallery-one-half-with-sidebar";
				$grid = "one-half with-sidebar";
			else:
				$image_size = "gallery-one-half";
				$grid = "one-half";
			endif;
		break;
		
		case 'one-third-column':
			$c_count = 3;
			if( $show_sidebar ):
				$image_size = "gallery-one-third-with-sidebar";
				$grid = "one-third with-sidebar";
			else:
				$image_size = "gallery-one-thrid";
				$grid = "one-third";
			endif;
		break;
		
		case 'one-fourth-column':
			$c_count = 4;
			if( $show_sidebar ):
				$image_size = "gallery-one-fourth-with-sidebar";
				$grid = "one-fourth with-sidebar";
			else:
				$image_size = "gallery-one-fourth";
				$grid = "one-fourth";
			endif;
		break;
	  endswitch;
	  
	  #Page Top Code Section
	  $mytheme_options = get_option(IAMD_THEME_SETTINGS);
	  $mytheme_integration = !empty($mytheme_options['integration']) ? $mytheme_options['integration'] : array();
	  if(isset($mytheme_integration['enable-single-page-top-code']))	echo stripslashes($mytheme_integration['single-page-top-code']); ?>

    	<!-- **Content Full Width** -->
    	<div class="content <?php echo $page_layout;?>">
        
        	<?php if( have_posts() ): 
        			while ( have_posts() ) : the_post();
						get_template_part('framework/loops/content','page');
					endwhile; 
				  endif;?>

            <!-- Sorting Container -->
            <?php if( sizeof($categories) > 1 ) :
					if( (!empty($sortable)) && ( !empty($categories) ) ):?>      
		                 <div id="sorting-container">
        		         	<div id="js_sort_items">
                		        <a href='#' data-filter='all_sort' class='all_sort_button active_sort'><?php echo __('All','spatreats');?></a>
                        		<?php foreach( $categories as $category ): ?>
                            			<a href='#' data-filter="<?php echo $category->category_nicename;?>_sort" 
                                			class="<?php echo $category->category_nicename;?>_sort_button"><?php echo $category->cat_name;?></a>
                        		<?php endforeach;?>
                    		</div>
                 		</div>
           <?php 	endif;
		   		 endif;?><!-- Sorting Container END -->

           		 <!-- **Gallery Wrapper -->
                 <div class="gallery-wrapper <?php echo($ajax_class.' '.$sortable);?>">
                 		<!-- **Gallery Details** -->
		            	<div class="gallery-details">
                        	 <div class="gallery-details-inner">
                             </div>
                        </div><!-- **Gallery Details**  END -->
                        
                        <!-- **Gallery Container** -->
		                <div class="gallery-sort-container gallery-container">
                        	<?php $args = array();
							      $gallery_categories = isset($tpl_default_settings['gallery-categories']) ? array_filter($tpl_default_settings['gallery-categories']):array();
								  if(is_array($gallery_categories) && !empty($gallery_categories)):
								  	$terms = $tpl_default_settings['gallery-categories'];
									$args = array(	'orderby' 			=> 'ID'
													,'order' 			=> 'ASC'
													,'paged' 			=> get_query_var( 'paged' )
													,'posts_per_page' 	=> $items_per_page
													,'tax_query'		=> array( array( 'taxonomy'=>'gallery_entries', 'field'=>'id', 'operator'=>'IN', 'terms'=>$terms  ) ) );
								  else:
								  	$args = array(	'paged' => get_query_var( 'paged' ) ,'posts_per_page' => $items_per_page ,'post_type' => 'gallery');
								  endif;
								  
								  query_posts($args); 	
								  if( have_posts() ):
								  	$count = 1; $last_class=''; #To add last-column class
									while( have_posts() ):
										the_post();
										$the_id = get_the_ID();
										#Find sort class by using the gallery_entries
										$sort = "";
										$item_categories = get_the_terms( $the_id, 'gallery_entries' );
										if(is_object($item_categories) || is_array($item_categories)):
											foreach ($item_categories as $category):
												$sort .= $category->slug.'_sort ';
											endforeach;
										endif;
										
										if($count == $c_count ) $last_class = 'last';?>
                                        	<div data-ajax-id="<?php echo $the_id;?>"
                                            	class="isotope-item post-entry post-entry-<?php echo($the_id.'  all_sort '.$sort.' '.$grid.' column  no-margin');?>">
                                                <div class="inner-entry">
                                                <?php $slider = new MySlideShow($the_id,'single');
													  $slider->setImageSize($image_size);
													  $slider->setPermalinkForAjaxCall(get_permalink());
 	 												  echo $slider->slideShow();?>
                                                 <?php if(isset($tpl_default_settings['show_title'])): ?>     
                                                 <div class="gallery-title">
                                                       <h5><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h5>
                                                 </div>
                                                 <?php endif;?>
                                                </div>
                                            </div>    
									<?php
										#To add last-column class 
										 if($count == $c_count ): 
											$last_class = ''; 
											$count = 0;
									  	endif; 	
										$count ++;
									endwhile;
									else:?>
                                        <div class="hr_invisible"> </div>
                                        <h1><?php _e( 'Nothing Found', 'spatreats' ); ?></h1>
                                        <h3><?php _e( 'Apologies, but no items found in our gallery.', 'spatreats' ); ?></h3>
                                        <?php get_search_form(); ?>
                              <?php endif;?>
                        </div><!-- **Gallery Container - End** -->
                 </div><!-- **Gallery Wrapper END -->

                <!-- **Pagination** -->
                <div class="pagination">
                    <div class="prev-post"> <?php previous_posts_link('<span> Prev Posts </span>');?> </div>           
                    <div class="next-post"> <?php next_posts_link('<span> Next Posts </span>');?> </div>
                    <?php my_pagination();?>
                </div><!-- **Pagination - End** -->
                  
                  
        </div> <!-- **Content  - End** -->
          
<?php if($show_sidebar): ?>
		<!-- **Sidebar** -->
    	<div class="sidebar <?php echo $sidebar_class;?>"><?php 	
			get_sidebar();?></div><!-- **Sidebar - End** -->
<?php endif; ?>

<?php #Page Top Code Section
	  if(isset($mytheme_integration['enable-single-page-bottom-code']))	echo stripslashes($mytheme_integration['single-page-bottom-code']);
	  get_footer();?>