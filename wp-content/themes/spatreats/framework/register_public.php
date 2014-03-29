<?php
add_action('load_head_styles_scripts','plugin_head_styles_scripts');
	function plugin_head_styles_scripts(){

		#Theme urls for Style Picker
			echo "\n <script type='text/javascript'>\n\t";
			echo "var mytheme_urls = {\n";
			echo "\t\t theme_base_url:'".IAMD_BASE_URL."'";
			echo "\n \t\t,framework_base_url:'".IAMD_FW_URL."'";
			echo "\n \t\t,ajaxurl:'".admin_url( 'admin-ajax.php' )."'";
			echo "\n \t\t,url:'".get_site_url()."'";
			echo "\n\t};\n";
			echo " </script>\n";
		#Theme urls for Style Picker End
		
		wp_enqueue_script('jquery');

		if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1) ):
		      wp_enqueue_script( 'comment-reply' );
		endif;

		wp_enqueue_script('tooltip-script',IAMD_FW_URL.'js/public/jquery.tipTip.minified.js',array(),null,true);
		
		wp_enqueue_script('inview-script',IAMD_FW_URL.'js/public/jquery.inview.js',array(),null,true);
		wp_enqueue_script('donut-script',IAMD_FW_URL.'js/public/jquery.donutchart.js',array(),null,true);
		wp_enqueue_script('viewport-script',IAMD_FW_URL.'js/public/jquery.viewport.js',array(),null,true);
		
		wp_enqueue_script('arctext-script',IAMD_FW_URL.'js/public/jquery.arctext.js',array(),null,true);
		wp_enqueue_script('toogle-script',IAMD_FW_URL.'js/public/animatedcollapse.js',array(),null,true);
		wp_enqueue_script('organictabs-script',IAMD_FW_URL.'js/public/organictabs.jquery.js',array(),null,true);
		wp_enqueue_script('jcarousel-script',IAMD_FW_URL.'js/public/jquery.jcarousel.min.js',array(),null,true);

		wp_enqueue_script('spa-smartresize',IAMD_FW_URL.'js/public/jquery.smartresize.js'); # To resize window v1.1
		wp_enqueue_script('spa-custom',IAMD_FW_URL.'js/public/spa.custom.js',array(),null,true);

		if(is_page_template('tpl-gallery.php')):
			global $post;
			$tpl_gallery_meta = get_post_meta($post->ID,'_tpl_gallery_meta',TRUE);
				wp_enqueue_script('isotope-script',IAMD_FW_URL.'js/public/isotope.js',array(),null,true);
				wp_enqueue_script('cycle-plugin',IAMD_FW_URL.'js/public/jquery.cycle.all.js',array(),null,true);
				wp_enqueue_script('custom',IAMD_FW_URL.'js/public/custom.js',array(),null,true);
		endif;
		
		if(is_page_template('tpl-catalog.php')):
			wp_enqueue_script('spa-smothscroll',IAMD_FW_URL.'js/public/smoothscroll.js',array(),null,true);
			wp_enqueue_script('spa-stickyfloat',IAMD_FW_URL.'js/public/stickyfloat.js',array(),null,true);
		endif;
		
		if( is_singular('gallery')):
			wp_enqueue_script('cycle-plugin',IAMD_FW_URL.'js/public/jquery.cycle.all.js',array(),null,true);
		endif;
		
	}

add_action('wp_head','mytheme_appearance_load_fonts',7);
function mytheme_appearance_load_fonts(){
	$custom_fonts = array();
	$output = "";

	$subset = mytheme_option('general','google-font-subset');
	if( $subset ){
		$subset = strtolower(str_replace(' ', '', $subset));
	}
	
	$appearance = mytheme_option("appearance");
	$appearance = array_filter($appearance);
	
	if( !isset($appearance['disable-menu-font-settings']) ):
		$font = isset($appearance['menu-font'] ) ? str_replace(" ", "+",$appearance['menu-font']) : "";
		array_push($custom_fonts,$font);
	endif;

	if( !isset($appearance['disable-title-font-settings']) ):
		$font = isset($appearance['title-font'] ) ? str_replace(" ", "+",$appearance['title-font']) : "";
		array_push($custom_fonts,$font);
	endif;

	if( !isset($appearance['disable-script-font-settings']) ):
		$font = isset($appearance['script-font'] ) ? str_replace(" ", "+",$appearance['script-font']) : "";
		array_push($custom_fonts,$font);
	endif;

	if( !isset($appearance['disable-boddy-font-settings']) ):
		$font = isset($appearance['body-font'] ) ? str_replace(" ", "+",$appearance['body-font']) : "";
		array_push($custom_fonts,$font);
	endif;

	if( !isset($appearance['disable-footer-font-settings']) ):
		$font = isset($appearance['footer-title-font'] ) ? str_replace(" ", "+",$appearance['footer-title-font']) : "";
		array_push($custom_fonts,$font);
	endif;
	
	$custom_fonts = array_filter($custom_fonts);
	array_unique($custom_fonts);
	
	if( !empty($custom_fonts) ):
		$font = implode(":300,400,400italic,700|",$custom_fonts);
		$font .= ":300,400,400italic,700";
	 	$protocol = is_ssl() ? 'https' : 'http';
	    $query_args = array('family' => $font,'subset' =>$subset );
	 	wp_enqueue_style('mytheme-google-fonts', add_query_arg($query_args, "$protocol://fonts.googleapis.com/css" ),array(),null);
	endif;

}

add_action('wp_head','mytheme_appearance_css',9);
function mytheme_appearance_css(){
	
	$appearance = mytheme_option("appearance");
	$appearance = array_filter($appearance);
	$output = "";

	if( !isset($appearance['disable-menu-font-settings']) ):
		if( isset($appearance['menu-font']) )
			$output .= "ul.menu li a { font-family:'{$appearance['menu-font']}', Arial, sans-serif;}\r";
			
		 if( isset($appearance['menu-font-size']) )
			$output .= "ul.menu li a { font-size: {$appearance['menu-font-size']}px;}\r";

	endif;

	if( !isset($appearance['disable-title-font-settings']) ):
		if( isset($appearance['title-font']) ):
			$output .= "h1, h2, h3, h4, th, .button, input[type=submit], .widget.widget_calendar caption, .widget.widget_calendar th, .breadcrumb, .sidebar h2, ul.cat-menu li a, .categories-list ul li a, .post-title h2, .post-details, .pagination, .page-link a, .page-link span, #sorting-container a, .gallery-title h5 a, .tabs ul li a, .accordion li a, a.tooltip, .sticky .post-title .featured, .menu-item-price, .menu-sidebar ul li a, ul.page-numbers li, ul.tabs li a, .woocommerce-message, .product-name, .widget_shopping_cart_content .total { font-family:'{$appearance['title-font']}', Arial, sans-serif;}\r";
		endif;
	endif;

	if( !isset($appearance['disable-script-font-settings']) ):
		if( isset($appearance['script-font'] ) ):
			$output .= ".big-ico-button, span.arctext, .notice, .back-btn, table.price-table td.even, #newsletter h2, .theme-default .nivo-caption h2, ul.products li .price, .product .summary .price, .widget.woocommerce ul.product_list_widget li .amount { font-family:'{$appearance['script-font']}', Arial, sans-serif; }\r";
		endif;
	endif;
	
	if( !isset($appearance['disable-boddy-font-settings']) ):
		if( isset($appearance['body-font'])) 
			$output .= "body { font-family:'{$appearance['body-font']}', Arial, sans-serif;}\r";		
			
		 if( isset($appearance['body-font-size']))
			$output .= "body { font-size: {$appearance['body-font-size']}px;}\r";
	endif;

	if( !isset($appearance['disable-footer-font-settings']) ):
		if( isset($appearance['footer-title-font']) )
			$output .= "#footer h2 { font-family:'{$appearance['footer-title-font']}', Arial, sans-serif;}\r";
		if( isset($appearance['footer-title-font-size']) )
			$output .= "#footer h2 { font-size: {$appearance['footer-title-font-size']}px;}\r";
	endif;
	
	
	if(!empty($output)):
		$output = "\r" . '<style type="text/css">'."\r\t". $output ."\r".'</style>'."\r";
		echo $output;
	endif;
}

#BREADCRUMB
class my_breadcrumb {
	var $options;
	
	function my_breadcrumb(){
		
		$delimiter =  stripslashes(mytheme_option('general', 'breadcrumb-delimiter'));
		$this->options = array( 'before' => "<span>",'after' => '</span>', 'delimiter' => $delimiter);
		$markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
		
		global $post;
		
		echo '<div class="breadcrumb">				
				<div class="container">
					<a href="'.home_url().'">'.__('Home','spatreats').'</a>';
					if( !is_front_page() && !is_home()) {
						echo $markup;
					}
					
					$output = $this->simple_breadcrumb_case($post);

				if ( is_page() || is_single()) {
					echo "<h1 class='current-crumb'>";
					the_title();
					echo "</h1>";
				} else if($output != NULL) {
					echo "<h1 class='current-crumb'>".$output."</h1>";
				} else {
					$title =  (get_option( 'page_for_posts' ) > 0) ? get_the_title( get_option( 'page_for_posts' ))  :NULL;
					echo $markup;
					echo "<h1 class='current-crumb'>".$title."</h1>";
				}
		echo "	</div>
		</div> <!-- ** container - End -->";
	}
	
	function simple_breadcrumb_case($der_post){
		$markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
		if (is_page()){
			 if($der_post->post_parent) {
				 $my_query = get_post($der_post->post_parent);			 
				 $this->simple_breadcrumb_case($my_query);
				 $link = '<a href="'.get_permalink($my_query->ID).'">';
				 $link .= ''. get_the_title($my_query->ID) . '</a>'. $markup;
				 echo $link;
			 }
		return;	 	
		} 

		if(is_single()){
			$category = get_the_category();
			if (is_attachment()){
				$my_query = get_post($der_post->post_parent);			 
				$category = get_the_category($my_query->ID);
				$ID = $category[0]->cat_ID;
				echo get_category_parents($ID, TRUE, $markup, FALSE );
				previous_post_link("%link $markup");
			}else{
				$postType = get_post_type();

				if($postType == 'post')	{
					$ID = $category[0]->cat_ID;
					echo get_category_parents($ID, TRUE,$markup, FALSE );
					
				} else if($postType == 'portfolio') {
					global $post;
					$terms = get_the_term_list( $post->ID, 'portfolio_entries', '', '$$$', '' );
					$terms =  array_filter(explode('$$$',$terms));
					if( !empty($terms)):
						echo $terms[0].$markup;
				    endif;
				} else if($postType == 'product') {
					global $post;
					$terms = get_the_term_list( $post->ID, 'product_cat', '', '$$$', '' );
					$terms =  array_filter(explode('$$$',$terms));
					if( !empty($terms)):
						echo $terms[0].$markup;
				    endif;
				}
			}
		return;
		}

		if(is_tax()){
			  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			  return $term->name;
		}

		if(is_category()){
			$category = get_the_category(); 
			$i = $category[0]->cat_ID;
			$parent = $category[0]-> category_parent;
			if($parent > 0 && $category[0]->cat_name == single_cat_title("", false)){
				echo get_category_parents($parent, TRUE, $markup, FALSE);
			}
		return __("Archive for Category: ",'spatreats').single_cat_title('',FALSE);
		}

		if(is_author()){
			$curauth = get_userdatabylogin(get_query_var('author_name'));
			return __("Archive for Author: ",'spatreats').$curauth->nickname;
		}

		if(is_tag()){ return __("Archive for Tag: ",'spatreats').single_tag_title('',FALSE); }

		if(is_404()){ return __("LOST",'spatreats'); }

		if(is_search()){ return __("Search",'spatreats'); }	

		if(is_year()){ return get_the_time('Y'); }

		if(is_month()){
			$k_year = get_the_time('Y');
			echo "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
			return get_the_time('F'); 
		}

		if(is_day() || is_time()){ 
			$k_year = get_the_time('Y');
			$k_month = get_the_time('m');
			$k_month_display = get_the_time('F');
			echo "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
			echo "<a href='".get_month_link($k_year, $k_month)."'>".$k_month_display."</a>".$markup;
		return get_the_time('jS (l)'); 
		}
		
		if(is_post_type_archive('product')){
			return 'Products';
		}


	}

}
#END OF BREADCRUMB
####################################

#### BLOG COMMENT STYLE
####################################
function my_customComments($comment,$args,$depth){
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
		   case 'pingback' :
  
		   case 'trackback' :
			   echo '<li class="post pingback">';
			   echo "<p>";
				   _e( 'Pingback:','spatreats');
				   comment_author_link();
				   edit_comment_link( __('Edit','spatreats'), ' ' ,'');
			   echo "</p>";
		   break;
		   default :                                        

		   case '' :
				echo "<li ";
					comment_class();
				echo ' id="li-comment-';
					comment_ID();
				echo '">';
					echo '<div id="comment-';
							comment_ID();
					echo '">';
					echo '<div class="comment-author">';
						echo '<div class="gravatar"> <span>';
							echo get_avatar( $comment, 50 );
						echo '</span></div>';	
				
						echo '<cite>'.ucfirst(get_comment_author_link()).'</cite>';
						echo '<div class="comment-meta">';
						 printf(__( '%1$s at %2$s','spatreats'), get_comment_date('D M d, Y'), get_comment_time());
						echo '</div>';
					echo '</div><!--.comment-author -->';
					echo '<div class="reply">';
                    echo comment_reply_link( array_merge( $args, array('reply_text' => 'Reply', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); 
					echo '</div><!-- .reply -->';
					echo '<div class="comment-body">';
							comment_text();
							if ( $comment->comment_approved == '0' ) :
								_e( 'Your comment is awaiting moderation.','spatreats'); 
							endif;
							edit_comment_link( __('Edit','spatreats') );
					echo '</div><!-- .comment-body -->';
					echo '</div><!-- .comment-ID -->';
			break;
		endswitch;
}

############################################
# PAGINATION
############################################
function my_pagination($pages = ''){
	global $paged;
	if(empty($paged))$paged = 1;
	$prev = $paged - 1;							
	$next = $paged + 1;	
	$range = 10; // only edit this if you want to show more page-links
	$showitems = ($range * 2)+1;
	if($pages == '') {	
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages)	{
			$pages = 1;
		}
	}
	if(1 != $pages){
	echo "<ul>";
	echo ($paged > 2 && $paged > $range+1 && $showitems < $pages)? "<li> <a href='".get_pagenum_link(1)."'>&laquo;</a></li>":"";
	echo ($paged > 1 && $showitems < $pages)? "<li> <a href='".get_pagenum_link($prev)."'>&lsaquo;</a></li>":"";

	for ($i=1; $i <= $pages; $i++){
		if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
			echo ($paged == $i)? "<li class='active-page'>".$i."</li>":
			"<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>"; 
		}
	}
	
	echo ($paged < $pages && $showitems < $pages) ? "<li> <a href='".get_pagenum_link($next)."'>&rsaquo;</a> </li>" :"";
	echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<li> <a href='".get_pagenum_link($pages)."'>&raquo;</a></li>":"";
	echo "</ul>";
	}
}

class MySlideShow {
	var $post_id;
	var $imageSize;
	var $link;
	var $sliders;
	var $slideshow_poster;
	var $slider_count = 0;
	var $slider_effects;

	function MySlideShow($postId= false,$poster = 'single'){
		$this->post_id = $postId;
		$this->slideshow_poster = $poster;
		$data = get_post_meta( $this->post_id, '_gallery_post_meta', true );
		$this->sliders = isset( $data['images']) ? unserialize($data['images']):'';
		$this->slider_effects = isset( $data['effects']) ?  unserialize($data['effects']):array("fade");
		$this->modify_slide_poster();
		$this->link = "";
	}

	function setImageSize($imageSize){
		$this->imageSize = $imageSize;
	}
	
	function setPermalinkForAjaxCall($link){
		$this->link = $link;
	}

	function getSliderCount(){
		return $this->slider_count;
	}

	function modify_slide_poster(){
		if($this->slideshow_poster == 'single'):
			if((is_array($this->sliders)) && (!empty($this->sliders))):
				$this->sliders = array_slice($this->sliders, 0, 1);
			endif;
		endif;
	}

	function generateImage($size,$attachment_id = false){
		$local =  array(
					'my-gallery'=>'my-gallery'
					,'gallery-one-half'=>'one-half'
					,'gallery-one-half-with-sidebar'=>'one-half-with-sidebar'
					,'gallery-one-thrid'=>'one-third'
					,'gallery-one-third-with-sidebar'=>'one-third-with-sidebar'
					,'gallery-one-fourth'=>'one-fourth'
					,'gallery-one-fourth-with-sidebar'=>'one-fourth-with-sidebar'
					,'my-releated-post'=>'my-releated-post'
					,'my-post-thumb'=>'my-post-thumb');

		$img_size = array(
					'my-gallery'=>" width='940' height='864' "
					,'gallery-one-half'=>" width='468' height='379' "
					,'gallery-one-half-with-sidebar'=>" width='348' height='282' "
					,'gallery-one-thrid'=>" width='312' height='253' "
					,'gallery-one-third-with-sidebar'=>" width='232' height='188' "
					,'gallery-one-fourth'=>" width='233' height='179' "
					,'gallery-one-fourth-with-sidebar'=>" width='173' height='133' "
					,'my-releated-post'=>" width='280' height='120' "
					,'my-post-thumb'=>" width='54' height='54' ");
					
		if($attachment_id) {
			$image_src = wp_get_attachment_image_src($attachment_id, $local[$size]);
			$attachment = get_post($attachment_id);
			
			if(is_object($attachment)) :
				$image_description = $attachment->post_excerpt == "" ? $attachment->post_content : $attachment->post_excerpt;
				$image_description = trim(strip_tags($image_description));
				$image_title = trim(strip_tags($attachment->post_title));
				return "<img src='{$image_src[0]}' title='{$image_title}' alt='{$image_description}' width='{$image_src[1]}' height='{$image_src[2]}' />";
				#return "<img src='{$image_src[0]}' title='{$image_title}' alt='{$image_description}' />";
			else:
				return "<img src='".IAMD_BASE_URL."images/poster-".$local[$size].".jpg' {$img_size[$size]}  title='' alt='dummy-poster'/>";
			endif;
		}else{
			return "<img src='".IAMD_BASE_URL."images/poster-".$local[$size].".jpg' {$img_size[$size]}  title='' alt='dummy-poster'/>";
		}
	}

	function singleImage(){
		$output = NULL;	
		if( is_array($this->sliders) && !empty($this->sliders)  ):
			foreach($this->sliders as $slider):
				$this->slider_count +=1;
					if(!empty($this->link)):
						$output .= "<a href='{$this->link}'>".$this->generateImage($this->imageSize,$slider)."</a>";
					else:
						$output .= $this->generateImage($this->imageSize,$slider);
					endif;
			endforeach;
		else:
			if(!empty($this->link)):
				$output .= "<a href='{$this->link}'>".$this->generateImage($this->imageSize)."</a>";
			else:
				$output .= $this->generateImage($this->imageSize);
			endif;			
		endif;
	return $output;	
	}

	function slideShow(){
		$output = "";
		$output .= "<div class='slideshow_container'>";
			$effect = implode(", ", $this->slider_effects);
			$output .= "<ul class='slideshow' data-transition='{$effect}'>";
				if( is_array($this->sliders) && !empty($this->sliders)  ):
					foreach($this->sliders as $slider):
						$this->slider_count +=1;
						$output .= "<li>";
						if(!empty($this->link)): 
							$output .= "<a href='{$this->link}'>".$this->generateImage($this->imageSize,$slider)."
											<span class='image-overlay'> <span class='image-overlay-inside'> </span> </span>
										</a>";
						else:
							$output .= $this->generateImage($this->imageSize,$slider);
						endif;			
						$output .="</li>";
					endforeach;
				else:
					$output .= "<li>";
					if(!empty($this->link)):
						$output .= "<a href='{$this->link}'>".$this->generateImage($this->imageSize)."<span class='image-overlay'>
									<span class='image-overlay-inside'> </span> </span></a>";
					else:
						$output .= $this->generateImage($this->imageSize);
					endif;			
					$output .="</li>";
				endif;
			$output .= "</ul>";			
		$output .= "</div>";
		return $output;	
	}
}

/** mytheme_seo_meta()
  * Objective:
  *		To generate meta tags based on the backend options.
**/

if( !(mytheme_is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') || mytheme_is_plugin_active('wordpress-seo/wp-seo.php')) ) {
	add_action( 'wp_head', 'mytheme_seo_meta',1 );
}

function mytheme_seo_meta(){
	global $post;
	$output = "";
	$meta_description = '';
	$meta_keywords = '';
	
	if( is_feed() )
		return;
		
	if ( is_404() || is_search() ) return;	
		
	# meta robots Noindex ,NoFollow
	if(is_category() && (mytheme_option('seo','use_noindex_in_cats_page'))):
		$output .= '<meta name="robots" content="noindex,follow" />'."\r";
	elseif(is_archive() && (mytheme_option('seo','use_noindex_in_archives_page'))):	
		$output .= '<meta name="robots" content="noindex,follow" />'."\r";
	elseif(is_tag() && !(mytheme_option('seo','use_noindex_in_tags_archieve_page'))):	
		$output .= '<meta name="robots" content="noindex,follow" />'."\r";
	endif;
	#End

	### Meta Description ###	
	if(is_page()):
		$meta_description = get_post_meta($post->ID,'_seo_description',true);
		if(empty($meta_description) && mytheme_option('seo','auto_generate_desc')):
			$meta_description =  substr( strip_shortcodes( strip_tags( $post->post_content ) ), 0, 155 );
		endif;
	#post	
	elseif(is_singular() || is_single()):
		$meta_description = get_post_meta($post->ID,'_seo_description',true);
		if(empty($meta_description) && mytheme_option('seo','auto_generate_desc')):
			$meta_description = trim(substr(strip_shortcodes( strip_tags( $post->post_content ) ), 0, 155 ));
		endif;
	#is_category()
	elseif(is_category()):
		#$categories = get_the_category();
		#$meta_description = $categories[0]->description;
		$meta_description = strip_tags(category_description());
	#is_tag()
	elseif(is_tag()):
		$meta_description = strip_tags(tag_description());
	#is_author
	elseif(is_author()):
	   $author_id  = get_query_var('author');
	   if(!empty($author_id)):
		   $meta_description = get_the_author_meta('description',$author_id);
	   endif;
	endif;

	if( !empty( $meta_description ) ) {
		$meta_description =  trim(substr($meta_description,0,155));
		$meta_description = htmlspecialchars($meta_description);
		$output .= "<meta name='description' content='{$meta_description}' />\r";
		
	}
	### Meta Description End###
	
	if(is_page()):
		$meta_keywords = get_post_meta($post->ID,'_seo_keywords',true);
	#post	
	elseif(is_singular() || is_single()):
		$meta_keywords = get_post_meta($post->ID,'_seo_keywords',true);
		
		#Use Categories in Keyword
		if(mytheme_option('seo','use_cats_in_meta_keword')):
			 $categories = get_the_category();
			 $c = '';
			 foreach($categories as $category):
		 		$c .= $category->name.',';
			 endforeach;
			 $c = substr(trim($c),"0",strlen(trim($c))-1);
		$meta_keywords = $meta_keywords.','.$c;	 
		endif;
		
		#Use Tags in Keyword
		if(mytheme_option('seo','use_tags_in_meta_keword')):
			 $posttags = get_the_tags();
			 $ptags='';
			 if($posttags):
			 	foreach($posttags as $posttag):
					$ptags .= $posttag->name.',';
				endforeach;
				$ptags = substr(trim($ptags),"0",strlen(trim($ptags))-1);
				$meta_keywords = $meta_keywords.','.$ptags;	 				
			 endif;
		endif;
	
	#Archive
	elseif(is_archive()):
	
		global $posts;
		$keywords = array();
		
		foreach($posts as $post ):
			# If attachment then use parent post id
			$id = ( is_attachment() ? $post->post_parent : ( !empty( $post->ID ) ? $post->ID : '' ) );
			
			$keywords_from_posts = get_post_meta($id,'_seo_keywords',true);
			if(!empty($keywords_from_posts)):
				$traverse = explode( ',', $keywords_from_posts );
				foreach ($traverse as $keyword):
					$keywords[] = $keyword;
				endforeach;
			endif;
			
			#Use Tags in Keyword
			if(mytheme_option('seo','use_tags_in_meta_keword')):
				$tags = get_the_tags($id);
				if($tags && is_array($tags)):
					foreach($tags as $tag):
						$keywords[] = $tag->name;
					endforeach;
				endif;
			endif;
			
			#Use categories in Keywords
			if(mytheme_option('seo','use_cats_in_meta_keword')):
		    	$categories = get_the_category($id); 
		      	foreach ( $categories as $category ):
			    	$keywords[] = $category->cat_name;
			   endforeach;			
			endif;
			
		endforeach;
		
		# Make keywords lowercase
		$keywords = array_unique($keywords);
		$small_keywords = array();
		$final_keywords = array();
		foreach ( $keywords as $word ):
			$final_keywords[]  = strtolower($word);
		endforeach;
		
		if(!empty($final_keywords)):
			$meta_keywords = implode(",",$final_keywords);
		endif;

		
	#search || 404 page	
	elseif( is_404() || is_search() ):
		$meta_keywords = '';
	endif;	
	if( !empty( $meta_keywords ) )
		$output .= "\t<meta name='keywords' content='{$meta_keywords}'/>\r";
	### Meta Keyword End###
	
	
	#Generate canonical_url
	if(mytheme_option('seo','use_canonical_urls')):
		$url = mytheme_canonical();
		if ($url)
			$output .= "<link rel='canonical' href='{$url}'/>\r";
	endif;
echo $output;	 }
### --- ****  mytheme_seo_meta() *** --- ###?>