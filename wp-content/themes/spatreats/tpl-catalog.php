<?php /*Template Name: Catalog Template*/?>
<?php get_header();?>
<?php $tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
	  $tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
	  
	  $page_layout  = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : "content-full-width";
  	  $show_sidebar = false;
	  $sidebar_class= "";
	  
	  $img_size  ="my-square";
	  
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
	  
	  $categories = isset($tpl_default_settings['catalog-categories']) ? array_filter($tpl_default_settings['catalog-categories']) : "";
	  if( empty($categories) ):
	  	$categories = get_categories('taxonomy=item_category&hide_empty=1');
	  else:
	  	$args = array('taxonomy'=>'item_category','hide_empty'=>1,'include'=>$categories);
		$categories = get_categories($args);
	  endif;
	  
	  $terms = array();
	  foreach($categories as $category):
		  $link =  "name = '".$category->slug."'";
		  $terms[$category->term_id] =  array ("name"=>$category->name , "slug"=>$category->slug,"link" => $link);
	  endforeach;	  
	  
	  #Page Top Code Section
	  $mytheme_options = get_option(IAMD_THEME_SETTINGS);
	  $mytheme_integration = !empty($mytheme_options['integration']) ? $mytheme_options['integration'] : array();
	  if(isset($mytheme_integration['enable-single-page-top-code']))	echo stripslashes($mytheme_integration['single-page-top-code']); ?>

    	<!-- **Content Full Width** -->
    	<div class="content menu-items-list <?php echo $page_layout;?>">
        
        	<?php if( have_posts() ):
        			while ( have_posts() ) : the_post();
            			get_template_part('framework/loops/content','page');
            		endwhile;
            	  endif;?>
                  
                  <div class="menu-sidebar">
	                   <ul class="j-load-all">
                       	<?php foreach( $categories as $category ):?>
                        	<li><a href="<?php echo "#".$category->slug;?>" class="smoothScroll"><?php echo $category->cat_name;?></a></li>
                        <?php endforeach;?>
                       </ul>
                  </div>


           	<!-- **Column Three Fourth** -->
        	<div class="column three-fourth">
            <?php foreach($terms as $key => $value ): ?>
			      <h1><a <?php echo $value['link'];?>><?php echo $value['name'];?></a></h1>
                  <?php $args = array(	'paged' 			=> get_query_var( 'paged' )
										,'posts_per_page' 	=> -1
										,'tax_query'		=> array( array( 'taxonomy'=>'item_category', 'field'=>'id', 'operator'=>'IN', 'terms'=>array($key)  ) ) );
				  	query_posts($args);
					if( have_posts() ):
						while( have_posts() ):
							the_post();
							$the_id = get_the_ID();
							$item = get_post_meta($the_id,'_item_post_meta',TRUE);
							$price = isset( $item['price']) ? $item['price'] : NULL;
							$subtitle = isset( $item['sub-title']) ? $item['sub-title'] : NULL;
							$class = isset( $item['rounded']) ? "rounded-img" : NULL;
							?>
                            <div class="menu-list">
	                            <?php $attachment  = wp_get_attachment_image_src(get_post_thumbnail_id($the_id),$img_size); 
                                if( $attachment ): ?>
	                            	 <div class="menu-image">
    	                                <span class="border <?php echo $class;?>">
                                         	<img alt="<?php the_title();?>"  src="<?php echo $attachment[0]; ?>" />
                                         </span>
	                                 </div>	
                                     
                                    <div class="menu-details">  
                          <?php	else: ?>
                                    <div class="menu-details with-no-image">  
                          <?php endif;?>       
                                         <h2 class="menu-title"> <span><?php the_title();?></span> </h2>
                                         <?php if( !empty($price) ): ?>
                                         <span class="menu-item-price"><?php echo $price;?></span>
                                         <?php endif;?>
                                         <?php if( !empty($subtitle) ): ?>
                                         <span class="sub-title"><?php echo $subtitle;?></span>
                                         <?php endif;?>
                                         <?php the_content();?>
                                 </div>
                            </div>
            <?php 		endwhile;
					endif;                
			 endforeach;?>
            </div> <!-- **Column Three Fourth - End** --> 
            
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