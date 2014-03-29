<?php

												####################################################################################
												#############################--------------------------#############################
												############################# FRONT END UTIL FUNCTIONS #############################
												#############################--------------------------#############################
												####################################################################################

### --- ****  is_mytheme_moible_view() *** --- ###
/** dt_is_moible_view()
  * Objective:
  *		If you eanble responsive mode in theme , this will add view port at the head
**/
function is_mytheme_moible_view(){
	$mytheme_options = get_option(IAMD_THEME_SETTINGS);
	$mytheme_mobile = $mytheme_options['mobile'];
	if(isset($mytheme_mobile['is-theme-responsive']))
		echo "<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1' />\r";
}
### --- ****  is_mytheme_moible_view() *** --- ###

/** mytheme_public_title()
  * Objective:
  *		Outputs the value for <title></title> in front end.
  * 
**/
function mytheme_public_title(){
	$status = mytheme_is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') || mytheme_is_plugin_active('wordpress-seo/wp-seo.php');
	if (!$status) :
		global $post;
		$doctitle = '';
		$separator = mytheme_option('seo','title-delimiter');
		$split = true;
		
		if(!empty($post)):
			$author_meta 	= get_the_author_meta($post->post_author);
			$nickname		= get_the_author_meta('nickname',$post->post_author);	
			$first_name		= get_the_author_meta('first_name',$post->post_author);
			$last_name		= get_the_author_meta('last_name',$post->post_author);
			$display_name 	= get_the_author_meta('display_name',$post->post_author);
		endif;
		
		$args = array("blog_title"		=>	preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', get_option('blogname')),
		 "blog_description"				=>	get_bloginfo('description'),
		 "post_title"					=> 	!empty($post) ? $post->post_title:NULL,
		 "post_author_nicename"			=>	!empty($nickname) ? ucwords($nickname):NULL,
		 "post_author_firstname"		=>	!empty($first_name) ? ucwords($first_name):NULL,
		 "post_author_lastname"			=>	!empty($last_name) ? ucwords($last_name):NULL,
		 "post_author_dsiplay"			=>	!empty($display_name) ? ucwords($display_name):NULL);
		$args = array_filter($args);
		#home			
		if(is_home() || is_front_page() ):
			$doctitle =  "";
			if( (get_option('page_on_front')!= 0) && (get_option('page_on_front') == $post->ID)) $doctitle = trim(get_post_meta($post->ID,'_seo_title',true));
			$doctitle =		!empty($doctitle) ? trim($doctitle) : $args["blog_title"].' '.$separator.' '.$args["blog_description"];
			$split = false;
			
		#page	
		elseif(is_page()):
			$doctitle = get_post_meta($post->ID,'_seo_title',true);
			if(empty($doctitle)):
				$options =  is_array(mytheme_option('seo','page-title-format')) ? mytheme_option('seo','page-title-format') : array();
				foreach($options as $option):
					if(array_key_exists($option,$args))
						$doctitle .= $args[$option].' '.$separator.' ';
				endforeach;
			endif;
		#post	
		elseif(is_single()):
			$doctitle = get_post_meta($post->ID,'_seo_title',true);
			if(empty($doctitle)):
			 #To add categories in $args
				 $categories = get_the_category();
				 $c = '';
				 foreach($categories as $category):
					$c .= $category->name.' '.$separator.' ';
				 endforeach;
				 $c = substr(trim($c),"0",strlen(trim($c))-1);
				 $args["category_title"] = $c;
			 #End of adding categories in $args	
			 
			 #To add tags in $args
				 $posttags = get_the_tags();
				 $ptags='';
				 if($posttags):
					foreach($posttags as $posttag):
						$ptags .= $posttag->name.$separator;
					endforeach;
					$ptags = substr(trim($ptags),"0",strlen(trim($ptags))-1);
					$args["tag_title"] = $ptags;
				 endif;
			 #End of adding tags in $args	 
				 $options = is_array(mytheme_option('seo','post-title-format')) ? mytheme_option('seo','post-title-format') : array();
				 foreach($options as $option):
					if(array_key_exists($option,$args)):
						$doctitle .= $args[$option].' '.$separator.' ';
					endif;	
				 endforeach;
			endif;
		#is_category()
		elseif(is_category()):
			$categories = get_the_category();
			#To add category description into $args
				$args["category_title"]		  = $categories[0]->name;	
				$args["category_desc"] = $categories[0]->description;
			#End of adding category description into $args
			
			$options = is_array(mytheme_option('seo','category-page-title-format')) ? mytheme_option('seo','category-page-title-format') : array();
			foreach($options as $option):
				if(array_key_exists($option,$args))
					$doctitle .= $args[$option].' '.$separator.' ';
			endforeach;
		#is_tag()
		elseif(is_tag()):
			$args["tag"] = wp_title("",false);
			$options = is_array(mytheme_option('seo','tag-page-title-format')) ? mytheme_option('seo','tag-page-title-format') : array();
			foreach($options as $option):
				if(array_key_exists($option,$args))
					$doctitle .= $args[$option].' '.$separator.' ';
			endforeach;
	
		#is_archive()
		elseif(is_archive()):
			$args["date"] = wp_title("",false);
			$options = is_array(mytheme_option('seo','archive-page-title-format')) ? mytheme_option('seo','archive-page-title-format') : array();
			foreach($options as $option):
				if(array_key_exists($option,$args))
					$doctitle .= $args[$option].' '.$separator.' ';
			endforeach;
		
		#is_date()
		elseif(is_date()):
		
		#is_search()
		elseif(is_search()):
			$args["search"] = __("Search results for",'dt_delicate').' "'.$_REQUEST['s'].'"'; #Adding search text into the default args
			$options = is_array(mytheme_option('seo','search-page-title-format')) ? mytheme_option('seo','search-page-title-format') : array();
			foreach($options as $option):
				if(array_key_exists($option,$args))
					$doctitle .= $args[$option].' '.$separator.' ';
			endforeach;
		#is_404()
		elseif(is_404()):
			$options = is_array(mytheme_option('seo','404-page-title-format')) ? mytheme_option('seo','404-page-title-format') : array();
			foreach($options as $option):
				if(array_key_exists($option,$args))
					$doctitle .= $args[$option].' '.$separator.' ';
			endforeach;
				$doctitle =  $doctitle.__('Page not found','dt_delicate');
			$split = false;		
		endif;
		
		if($split):
			if(strrpos($doctitle,$separator)):
				$doctitle = str_split($doctitle,strrpos($doctitle,$separator));
				$doctitle = $doctitle[0];
			endif;
		endif;	
		
	echo $doctitle;
   else:
   	wp_title("|", true);
   endif;	
}
### --- ****  mytheme_public_title() *** --- ###

/** mytheme_canonical()
  * Objective:
  *		Generate the Canonical url
  * This function called at register_public.php via mytheme_seo_meta();
**/
function mytheme_canonical(){
		$canonical = false;
	if ( is_singular() || is_single() ):
		$canonical = get_permalink( get_queried_object() );
		
		# Fix paginated pages
		if ( get_query_var('paged') > 1 ) :
			global $wp_rewrite;
			if ( !$wp_rewrite->using_permalinks() ) :
				$canonical = add_query_arg( 'paged', get_query_var('paged'), $canonical );
			else:
				$canonical = user_trailingslashit( trailingslashit( $canonical ) . 'page/' . get_query_var( 'paged' ) );
			endif;
		endif;
	else:
		if ( is_front_page() ): 
			$canonical = home_url( '/' );
  	    elseif ( is_home() && "page" == get_option('show_on_front') ):		
		 	$canonical = get_permalink( get_option( 'page_for_posts' ) );
		elseif( is_tax() || is_tag() || is_category() ):
			$term = get_queried_object();
			$canonical = get_term_link( $term, $term->taxonomy );
		elseif(function_exists('get_post_type_archive_link') && is_post_type_archive()):	
			$canonical = get_post_type_archive_link(get_post_type());
		elseif(is_author()):
			$canonical = get_author_posts_url(get_query_var('author'), get_query_var('author_name'));
		elseif(is_archive()):
			if (is_date()):
				if(is_day()):
					$canonical = get_day_link( get_query_var('year'), get_query_var('monthnum'), get_query_var('day') );
				elseif(is_month()):
					$canonical = get_month_link( get_query_var('year'), get_query_var('monthnum') );
				elseif(is_year()):	
					$canonical = get_year_link( get_query_var('year') );
				endif;	
			endif;
		endif;
		
		if ( $canonical && get_query_var('paged') > 1 ):
			global $wp_rewrite;
			if ( !$wp_rewrite->using_permalinks() )
				$canonical = add_query_arg( 'paged', get_query_var('paged'), $canonical );			
			else	
				$canonical = user_trailingslashit( trailingslashit( $canonical ) . trailingslashit( $wp_rewrite->pagination_base ) . get_query_var('paged') );
		endif;
	endif;
return $canonical;	
}
### --- ****  mytheme_canonical() *** --- ###

#To load basic css : default,shortcode & skin css
function load_mytheme_basic_css() {
	
	 $mytheme_options = get_option(IAMD_THEME_SETTINGS);
	 $mytheme_general = $mytheme_options['general'];
		
	 if(isset($mytheme_general['enable-favicon'])):
		$url = !empty($mytheme_general['favicon-url']) ? $mytheme_general['favicon-url'] : IAMD_BASE_URL."images/favicon.ico";
		echo "<link href='$url' rel='shortcut icon' type='image/x-icon' />";
	 endif;
	 
	 wp_enqueue_style('default', get_stylesheet_uri());
	 wp_enqueue_style('shortcode',IAMD_BASE_URL."shortcodes.css");
	 wp_enqueue_style ( 'custom-font-awesome', IAMD_BASE_URL . 'css/font-awesome.min.css', array (), '' );
	 wp_enqueue_style('skin', IAMD_BASE_URL."skins/".$mytheme_options['appearance']['skin']."/style.css");
	 
	 #Enqueue only in IE 7
	 wp_register_style('ie7-css',IAMD_BASE_URL.'css/ie7.css');
     $GLOBALS['wp_styles']->add_data('ie7-css', 'conditional', 'lt IE 7');
	 wp_enqueue_style('ie7-css');

	 #Enqueue only in IE 7
	 wp_register_style('ie8-css',IAMD_BASE_URL.'css/ie8.css');
     $GLOBALS['wp_styles']->add_data('ie8-css', 'conditional', 'lt IE 8');
	 wp_enqueue_style('ie8-css');
}


### --- ****  set_mytheme_layout *** --- ###
function set_mytheme_layout(){

	if(mytheme_option("mobile","is-theme-responsive")) {
		$childResponsive =  mytheme_option("appearance","skin");
		wp_enqueue_style('responsive',IAMD_BASE_URL."responsive.css");
		wp_enqueue_style('skin-responsive',IAMD_BASE_URL.'skins/'.mytheme_option("appearance","skin")."/responsive.css");
		
	}

	$mytheme_options = get_option(IAMD_THEME_SETTINGS);
	$mytheme_mobile = $mytheme_options['mobile'];

    if(isset($mytheme_mobile['is-slider-disabled'])):
		$out =	'<style type="text/css">';
		$out .=	'@media only screen and (max-width:320px), (max-width: 479px), (min-width: 480px) and (max-width: 767px), (min-width: 768px) and (max-width: 959px),
		 (max-width:1200px) { #home-slider { display:none !important; } 	}';
		$out .=	'</style>';
		echo $out;
	endif;		
	
}
### --- ****  set_mytheme_layout *** --- ###

### --- ****  mytheme_social_bookmarks() *** --- ###
/** mytheme_social_bookmarks()
  * Objective:
  *		To show social shares
**/
function mytheme_social_bookmarks($arg='sb-post'){
	global $post;

	$title = $post->post_title;
	$url = get_permalink($post->ID);
	$excerpt = $post->post_excerpt;
	$data = "";
	
	$path = IAMD_BASE_URL."/images/socialbookmark/";
	
	
	$fb = mytheme_option('integration',"{$arg}-fb_like");
	$data .= !empty($fb) ? "<li><a href='http://www.facebook.com/sharer.php?u=$url&amp;t=".urlencode($title)."'><img src='{$path}facebook.png' /></a></li>" : "";
	
	$delicious = mytheme_option('integration',"{$arg}-delicious");
	$data .= !empty($delicious)? "<li><a href='http://del.icio.us/post?url=$url&amp;title=".urlencode($title)."'><img src='{$path}delicious.png' /></a></li>":"";

	$digg = mytheme_option('integration',"{$arg}-digg");
	$data .= !empty($digg)? "<li><a href='http://digg.com/submit?phase=2&amp;url=$url&amp;title=".urlencode($title)."'><img src='{$path}digg.png' /></a></li>":"";

	$stumbleupon = mytheme_option('integration',"{$arg}-stumbleupon");
	$data .= !empty($stumbleupon)? "<li><a href='http://www.stumbleupon.com/submit?url=$url&amp;title=".urlencode($title)."'><img src='{$path}stumbleupon.png' /></a></li>":"";

	$twitter = mytheme_option('integration',"{$arg}-twitter");
	$t_url = !empty($twitter) ? $url : '';
	$data .= !empty($twitter)? "<li><a href='http://twitter.com/home/?status=".urlencode($title).":$t_url'><img src='{$path}twitter.png' /></a></li>":"";
	
	$googleplus = mytheme_option('integration',"{$arg}-googleplus");
	$data .= !empty($googleplus) ? "<li><a class=\"google\" href=\"https://plus.google.com/share?url=$url\"  onclick=\"javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\" >
	<img src='{$path}google.png' /></a></li>" :'';
  
  	$linkedin = mytheme_option('integration',"{$arg}-linkedin");
	$data .= !empty($linkedin) ? "<li><a href='http://www.linkedin.com/shareArticle?mini=true&amp;title=".urlencode($title)."&amp;url=$url' title='Share on LinkedIn'>
	<img src='{$path}linkedin.png' /></a></li>":"";

	$pintrest = mytheme_option('integration',"{$arg}-pintrest");
	$media = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
	$data .= !empty($pintrest) ? "<li><a href='http://pinterest.com/pin/create/button/?url=".urlencode($url)."&amp;media=$media'><img src='{$path}pinterest.png' /></a></li>":"";
	
	$data = !empty($data) ? "<ul class='social-icons'>{$data}</ul>" : "";
	echo $data;
}
### --- ****  mytheme_social_bookmarks() *** --- ###

### --- ****  show_footer_widgetarea() *** --- ###
/** show_footer_widgetarea()
  * Objective:
  *		Outputs the Footer section widget area.
**/
function show_footer_widgetarea($count){
	$classes = array("1"=>"one","one-half","one-third","one-fourth","1-2"=>"one-half","1-3"=>"one-third","1-4"=>"one-fourth","3-4"=>"three-fourth","2-3"=>"two-third");
	if($count<=4):
		for($i=1;$i<=$count;$i++):
			$class = $classes[$count];
			$last  = ($i == $count) ? "last":"";
			echo "<div class='column {$class} {$last}'>";
				if (function_exists('dynamic_sidebar') && dynamic_sidebar("footer-sidebar-{$i}") ): endif;
			echo "</div>";	
		endfor;
	elseif($count == 5 || $count == 6 ):
		$a = array("1-4","1-4","1-2");
		$a = ($count == 5) ? $a : array_reverse($a);
		foreach($a as $k => $v):
			$class  = $classes[$v];
			$last   = (end($a) == $v) ? "last" : "";
			echo "<div class='column {$class} {$last}'>";
				if (function_exists('dynamic_sidebar') && dynamic_sidebar("footer-sidebar-{$k}-{$v}") ): endif;
			echo "</div>";	
		endforeach;
				
	elseif($count == 7 || $count == 8):
		$a = array("1-4","3-4");
		$a = ($count == 7) ? $a : array_reverse($a);
		foreach($a as $k => $v):
			$class  = $classes[$v];
			$last   = (end($a) == $v) ? "last" : "";
			echo "<div class='column {$class} {$last}'>";
				if (function_exists('dynamic_sidebar') && dynamic_sidebar("footer-sidebar-{$k}-{$v}") ): endif;
			echo "</div>";	
		endforeach;
	elseif($count == 9 || $count == 10):
		$a = array("1-3","2-3");
		$a = ($count == 9) ? $a : array_reverse($a);
		foreach($a as $k => $v):
			$class  = $classes[$v];
			$last   = (end($a) == $v) ? "last" : "";
			echo "<div class='column {$class} {$last}'>";
				if (function_exists('dynamic_sidebar') && dynamic_sidebar("footer-sidebar-{$k}-{$v}") ): endif;
			echo "</div>";	
		endforeach;
	endif;
}
### --- ****  show_footer_widgetarea() *** --- ###


												####################################################################################
												#############################--------------------------#############################
												########################	END OF FRONT END UTIL FUNCTIONS		####################
												#############################--------------------------#############################
												####################################################################################


/** mytheme_switch()
  * Objective:
  *		Outputs the switch control at the backend.
  * 
**/
function mytheme_switch($label,$parent,$name){
	$checked = ( "true" ==  mytheme_option($parent,$name) ) ? ' checked="checked"' : '';
	$switchclass = ( "true" == mytheme_option($parent,$name)  ) ? 'checkbox-switch-on' :'checkbox-switch-off';
	$out = "<div data-for='mytheme-{$parent}-{$name}' class='checkbox-switch {$switchclass}'></div>";
	$out .= "<input id='mytheme-{$parent}-{$name}' class='hidden' name='mytheme[{$parent}][{$name}]' type='checkbox' value='true' {$checked} />";
 echo $out;	
}
### --- ****  mytheme_switch() *** --- ###


/** mytheme_get_option()
  * Objective:
  *		To get my theme options stored in database by the thme option page at back end.
**/
function mytheme_option($key1,$key2=''){
	$options = get_option(IAMD_THEME_SETTINGS);
	$output = NULL;
	
	
	if(is_array($options)):
		
		if( array_key_exists($key1,$options) ){
			$output = $options[$key1];
			if( is_array($output) && !empty($key2)  ){
				$output = ( array_key_exists($key2,$output) && (!empty($output[$key2])) )?  $output[$key2] : NULL;
			}
		}else{
			$output = $output;
		}

		
	endif;	
	return $output;		
}
### --- ****  mytheme_option() *** --- ###

/** mytheme_default_option()
  * Objective:
  *		To return my theme default options to store in database. 
**/
function mytheme_default_option(){
	
	$general = array(
		"disable-page-comment"=>"true",
		"breadcrumb-delimiter"=>"/",
		"show-footer"=>"on",
		"footer-columns"=>'4',
		"show-copyrighttext"=>"on",
		"copyright-text" => 'Copyright &copy; 2013 Spatreats Theme All Rights Reserved. | <a href="http://themeforest.net/user/designthemes"> Design Themes </a>');

	$appearance = array('menu-font'=>'Oswald','title-font'=>'Oswald','script-font'=>'Niconne','footer-title-font'=>'Norican','skin'=>'spatreats');
	
	$mobile = array('s-theme-responsive'=>'true');

	$woo = array( 'shop-product-per-page' => '10','shop-page-product-layout'=>'one-half-column', 'product-layout'=>'content-full-width',
							 'product-category-layout' => 'content-full-width','product-tag-layout'=>'content-full-width');		
							 
	$seo = array(
			"title-delimiter" => "|",
			"post-title-format" => array("blog_title","post_title"),
			"page-title-format" => array("blog_title","post_title"),
			"archive-page-title-format" =>  array("blog_title","date"),
			"category-page-title-format" => array("blog_title","category_title"),
			"tag-page-title-format"	=> array("blog_title","tag"),
			"search-page-title-format" => array("blog_title","search"),
			"404-page-title-format"	=> array("blog_title"));							 					

	$data = array( "general" => $general, "appearance" => $appearance, "mobile" => $mobile, "woo"=>$woo,"seo"=>$seo );
return $data;	
	
}
### --- ****  mytheme_default_option() *** --- ###
	

/** mytheme_listImage()
  * Args:
  *		1. $dir = location of the folder from which you wnat to get images
  * Objective:
  *		Returns an array that contains  icon names located at $dir.
**/
function mytheme_listImage($dir) {
	$sociables = array();
	$icon_types = array('jpg', 'jpeg', 'gif', 'png');
	
	if( is_dir($dir) ){
		$handle = opendir($dir);
		while (false !== ($dirname = readdir($handle))) {
			
			if( $dirname != "." && $dirname!=".." ){
				$parts = explode('.',$dirname);
				$ext = strtolower($parts[count($parts)-1]);
				
				if( in_array($ext, $icon_types)) {
					$option = $parts[count($parts) - 2];
					$sociables[$dirname] = str_replace( ' ','', $option );
				}
			}
		}
		closedir($handle);
	}
	
	return $sociables;
}
### --- ****  mytheme_listImage() *** --- ###

/** mytheme_sociables_selection()
  * Objective:
  *		Returns selection box.
**/
function mytheme_sociables_selection($name='',$selected="") {
	$dir = get_template_directory()."/images/sociable/";
	$sociables = mytheme_listImage($dir);
	$name  = !empty($name) ? "name='mytheme[social][{$name}][icon]'" : '';
	$out  = "<select class='social-select' {$name}>"; #name attribute will be added to this by jQuery menuAdd()
	foreach($sociables as $key => $value ):
		$s = selected($key,$selected,false);
		$v = ucwords($value);
		$out .= "<option value='{$key}' {$s} >{$v}</option>";
	endforeach;
	$out .= "</select>";
 return $out;	
}
### --- ****  mytheme_sociables_selection() *** --- ###

#admin
/** mytheme_adminpanel_tooltip()
  * Objective:
  *		To place tooltip content in thme option page at back end.
  * args:
  *		1. $tooltip = content which is shown as tooltip
**/
function mytheme_adminpanel_tooltip($tooltip){
	$output  = "<div class='bpanel-option-help'>\n";
	$output .= "<a href='' title=''> <img src='".IAMD_FW_URL."theme_options/images/help.png' alt='' title='' /> </a>\n";
	$output .= "\r<div class='bpanel-option-help-tooltip'>\n";
	$output .= $tooltip;
	$output .= "\r</div>\n";
	$output .= "</div>\n";
	echo $output;
}
### --- ****  mytheme_adminpanel_tooltip() *** --- ###

#admin
/** mytheme_adminpanel_image_preview()
  * Objective:
  *		To place tooltip content in thme option page at back end.
  * args:
  *		1. $src = image source
  *		2. $backend = true - to get images placed in framework  ? false - to get images stored in  theme/images folder 
**/
function mytheme_adminpanel_image_preview($src,$backend=true,$default="no-image.jpg"){
	$default = ($backend) ? IAMD_FW_URL."theme_options/images/".$default : IAMD_BASE_URL."images/".$default;
	$src  = !empty($src) ? $src : $default; 
	$output  = "<div class='bpanel-option-help'>\n";
	$output .= "<a href='' title='' class='a_image_preivew'> <img src='".IAMD_FW_URL."theme_options/images/image-preview.png' alt='' title='' /> </a>\n";
	$output .= "\r<div class='bpanel-option-help-tooltip imagepreview'>\n";
	$output .= "\r<img src='{$src}' data-default='{$default}'/>";
	$output .= "\r</div>\n";
	$output .= "</div>\n";
	echo $output;
}
### --- ****  mytheme_adminpanel_image_preview() *** --- ###

/** mytheme_admin_fonts()
  * Objective:
  *		Outputs the fonts selection box.
**/
function mytheme_admin_fonts($label,$name,$selctedFont){
	global $my_google_fonts;
	$f = IAMD_SAMPLE_FONT;
	$css = (!empty($selctedFont)) ? 'style="font-family:'.$selctedFont.';"': '';
	$output =  "<div class='mytheme-font-preview' {$css}>{$f}</div>";
	$output .= "<label>{$label}</label>";
	$output .= "<div class='clear'></div>";
	$output .= "<select class='mytheme-font-family-selector' name='{$name}'>";
	$output .= 		"<option value=''>".__("Select",'spatreats')."</option>";
			foreach($my_google_fonts as $fonts):
			$rs = selected($fonts,$selctedFont,false);
			$output .= 	"<option value='{$fonts}' {$rs}>{$fonts}</option>";
			endforeach;
	$output .= "</select>"; 
	echo $output;
}
### --- ****  mytheme_admin_fonts() *** --- ###

/** mytheme_admin_jqueryuislider()
  * Objective:
  *		Outputs the jQurey UI Slider.
**/
function mytheme_admin_jqueryuislider($label,$id='',$value='',$px="px"){
	$div_value = (!empty($value) && ($px == "px")) ? $value."px" : $value;
	$output = "<label>{$label}</label>";
	$output .= "<div class='clear'></div>";
	$output .= "<div id='{$id}' class='mytheme-slider' data-for='{$px}'></div>";
	$output .= "<input type='hidden' class='' name='{$id}' value='{$value}'/>";
	$output .= "<div class='mytheme-slider-txt'>{$div_value}</div>";
echo $output;	
}
### --- ****  mytheme_admin_jqueryuislider() *** --- ###
/** mytheme_pagelist()
  * Objective:
  *		To create dropdown box with list of pages.
  * args:
  *		1. $id = page id
  *		2. $selected = ( true / false)		
**/
function mytheme_postlist($id,$selected,$class="mytheme_select") {
	global $post;
	$args = array( 'numberposts' => -1);
	
	$name = explode(",",$id);
	if(count($name) > 1 ){
		$name = "[{$name[0]}][{$name[1]}]";
	}else {
		$name = "[{$name[0]}]";
	}
	$name =  	($class=="multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";	
	$output  = 	"<select name='{$name}' class='{$class}'>";
	$output .= "<option value=''>".__('Select Post','spatreats')."</option>";
	$posts = get_posts($args);
		foreach ($posts as $post):
			$id = esc_attr($post->ID);
			$title = esc_html($post->post_title);
			$output .= "<option value='{$id}' ".selected($selected,$id,false).">{$title}</option>";
		endforeach;
	$output .= "</select>\n";
	echo $output;
}
### --- ****  mytheme_postlist() *** --- ###

/** mytheme_productlist()
  * Objective:
  *		To create dropdown box with list of products.
  * args:
  *		1. $id = page id
  *		2. $selected = ( true / false)		
**/
function mytheme_productlist($id,$selected,$class="mytheme_select") {
	global $post;
	$args = array( 'numberposts' => -1, 'post_type'=>'product');
	
	$name = explode(",",$id);
	if(count($name) > 1 ){
		$name = "[{$name[0]}][{$name[1]}]";
	}else {
		$name = "[{$name[0]}]";
	}
	$name =  	($class=="multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";	
	$output  = 	"<select name='{$name}' class='{$class}'>";
	$output .= "<option value=''>".__('Select Product','spatreats')."</option>";
	$posts = get_posts($args);
		foreach ($posts as $post):
			$id = esc_attr($post->ID);
			$title = esc_html($post->post_title);
			$output .= "<option value='{$id}' ".selected($selected,$id,false).">{$title}</option>";
		endforeach;
	$output .= "</select>\n";
	echo $output;
}
### --- ****  mytheme_productlist() *** --- ###

function mytheme_product_taxonomy_list($id,$selected='',$class="mytheme_select",$taxonomy){

	$name = explode(",",$id);
	if(count($name) > 1 ){
		$name = "[{$name[0]}][{$name[1]}]";
	}else {
		$name = "[{$name[0]}]";
	}
	$name =  	($class=="multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";	
	$output  = 	"<select name='{$name}' class='{$class}'>";
	$output .= 	"<option value=''>".__('Select','spatreats')."</option>";
	$cats   = 	get_categories("taxonomy={$taxonomy}&hide_empty=0");
	
		foreach ($cats as $cat):
			$id = esc_attr($cat->term_id);
			$title = esc_html($cat->name);
			$output .= "<option value='{$id}' ".selected($selected,$id,false).">{$title}</option>";
		endforeach;
	$output .= "</select>\n";
	
	return $output;
}


/** mytheme_pagelist()
  * Objective:
  *		To create dropdown box with list of pages.
  * args:
  *		1. $id = page id
  *		2. $selected = ( true / false)		
**/
function mytheme_pagelist($id,$selected,$class="mytheme_select") {
	
	$name = explode(",",$id);
	if(count($name) > 1 ){
		$name = "[{$name[0]}][{$name[1]}]";
	}else {
		$name = "[{$name[0]}]";
	}
	$name =  	($class=="multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";	
	$output  = 	"<select name='{$name}' class='{$class}'>";
	$output .= "<option value=''>".__('Select Page','spatreats')."</option>";
	$pages   = get_pages('title_li=&orderby=name');
		foreach ($pages as $page):
			$id = esc_attr($page->ID);
			$title = esc_html($page->post_title);
			$output .= "<option value='{$id}' ".selected($selected,$id,false).">{$title}</option>";
		endforeach;
	$output .= "</select>\n";
	echo $output;
}
### --- ****  mytheme_pagelist() *** --- ###

/** mytheme_categorylist()
  * Objective:
  *		To create dropdown box with list of categories.
  * args:
  *		1. $id =  		dropdown id
  *		2. $selected = 	( true / false)
  *		3. $class = 	default class		
**/
function mytheme_categorylist($id,$selected='',$class="mytheme_select") {
	
	$name = explode(",",$id);
	if(count($name) > 1 ){
		$name = "[{$name[0]}][{$name[1]}]";
	}else {
		$name = "[{$name[0]}]";
	}
	$name =  	($class=="multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";	
	$output  = 	"<select name='{$name}' class='{$class}'>";
	$output .= 	"<option value=''>".__('Select Category','spatreats')."</option>";
	$cats   = 	get_categories( 'orderby=name&hide_empty=0' );
		foreach ($cats as $cat):
			$id = esc_attr($cat->term_id);
			$title = esc_html($cat->name);
			$output .= "<option value='{$id}' ".selected($selected,$id,false).">{$title}</option>";
		endforeach;
	$output .= "</select>\n";
	return $output;
}
### --- ****  mytheme_categorylist() *** --- ###

function mytheme_gallery_categorylist($id,$selected='',$class="mytheme_select") {
	
	$name = explode(",",$id);
	if(count($name) > 1 ){
		$name = "[{$name[0]}][{$name[1]}]";
	}else {
		$name = "[{$name[0]}]";
	}
	$name =  	($class=="multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";	
	$output  = 	"<select name='{$name}' class='{$class}'>";
	$output .= 	"<option value=''>".__('Select Category','spatreats')."</option>";
	$cats   = 	 get_categories('taxonomy=gallery_entries&hide_empty=0');;
		foreach ($cats as $cat):
			$id = esc_attr($cat->term_id);
			$title = esc_html($cat->name);
			$output .= "<option value='{$id}' ".selected($selected,$id,false).">{$title}</option>";
		endforeach;
	$output .= "</select>\n";
	return $output;
}


/** getFolders()
  * Objective:
  *		
**/
function getFolders($directory, $starting_with = "", $sorting_order = 0) {
	if(!is_dir($directory)) return false;
	$dirs = array();
	$handle = opendir($directory);
	while (false !== ($dirname = readdir($handle))) {
		if ($dirname != "." && $dirname != ".." && is_dir($directory."/".$dirname)) 
		{
			if ($starting_with == "")
				$dirs[] = $dirname;
			else {
				$filter = strstr($dirname, $starting_with);
				if ($filter !== false) $dirs[] = $dirname;
			}
		}  
	}

	closedir($handle);
	
	if($sorting_order == 1) {
		rsort($dirs); 
	} else {
		sort($dirs); 
	}
	return $dirs;
}
### --- ****  getFolders() *** --- ###

/** mytheme_footer_widgetarea()
  * Objective: 
  *		1. To Generate Footer Widget Areas
  *	Args: $count = No of widget areas
**/
function mytheme_footer_widgetarea($count){
	$name = __("Footer Column",'spatreats');
	if($count<=4):
		for($i=1;$i<=$count;$i++):
			register_sidebar(array('name' 			=>	$name."-{$i}",
				'id'			=>	"footer-sidebar-{$i}",
				'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</div>',
				'before_title' 	=> 	'<h2 class="widgettitle"><span>',
				'after_title' 	=> 	'</span></h2>'));
		endfor;
 	endif;
}
### --- ****  mytheme_footer_widgetarea() *** --- ###

### --- ****  check_slider_revolution_responsive_wordpress_plugin() *** --- ###
/** check_slider_revolution_responsive_wordpress_plugin()
  * Objective:
  *		Check the "Revolution Responsive WordPress Plugin" is activated
**/
function check_slider_revolution_responsive_wordpress_plugin(){
	$sliders = false;
	if(mytheme_is_plugin_active('revslider/revslider.php')):
		global $wpdb;
		#$table_prefix =  WP_ALLOW_MULTISITE ? $wpdb->base_prefix : $wpdb->prefix;
		$table_prefix =  $wpdb->prefix;
		$table_name = $table_prefix."revslider_sliders";
		
		if(	$wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name):
			$resultset = $wpdb->get_results("SELECT title,alias FROM $table_name");
			foreach($resultset as $rs):
				$sliders[$rs->alias] = $rs->title;
			endforeach;
			return $sliders;
		else:
			return $sliders;
		endif;	
	else:
		return $sliders;	
	endif;
}
### --- ****  mytheme_is_plugin_active() *** --- ###
?>