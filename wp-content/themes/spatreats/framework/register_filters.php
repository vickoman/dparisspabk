<?php #ADMIN
add_action('after_setup_theme', 'spatreat_setup_theme');
if ( ! function_exists('spatreat_setup_theme')){
	function spatreat_setup_theme(){
		load_theme_textdomain('spatreats',get_template_directory().'/lang');
	}
}

//removes quick edit from custom post type list
function remove_quick_edit( $actions ) {
	global $post;
    if( $post->post_type == 'gallery' ) {
		unset($actions['inline hide-if-no-js']);
	}
    return $actions;
}

if (is_admin()) {
	add_filter('post_row_actions','remove_quick_edit',10,2);
}
#END OF ADMIN
add_filter('widget_text', 'do_shortcode');

#Navigation Menu
function my_default_navigation(){
	echo '<ul id="main-menu" class="menu">';
		$args = array('depth'=>0,'title_li'=>'','echo'=>0,'post_type'=>'page','post_status'=>'publish'	);
		$pages = wp_list_pages($args);
		if($pages)
			echo $pages;
	echo '</ul>';
}

#My Nav Menu Walker to show MENU'S DESCRIPTION IN MEADER MENU
class my_menu_walker extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth, $args) {

		global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

          $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		  
          $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
          $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
          $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
          $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
          $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0) 
                  $description = $append = $prepend = "";

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $description.$args->link_after;
            $item_output .= $args->link_before.apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= '</a>';
            $item_output .= $args->after;
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

#FILTER TO MODIFY THE DEFAULT CATEGORY WIDGET
add_filter('wp_list_categories', 'my_wp_list_categories');
function my_wp_list_categories($output) {
       if(strpos($output, "</span>") <= 0) {
               $output = str_replace('</a> (','<span> ',$output);
               $output = str_replace(')','</span></a> ',$output);
       }
       return $output;
}

add_filter('get_archives_link', 'my_wp_list_archive');
function my_wp_list_archive($output) {
       $output = str_replace('</a> (','<span> ',$output);
       $output = str_replace(')','</span></a> ',$output);
       return $output;
}

#remove_filter('the_content', 'wpautop'); #wpautop - Changes double line-breaks in the text into HTML paragraphs
function wpe_excerptlength_teaser1($length) {  return 5; }
function wpe_excerptlength_teaser($length) {  return 12; }
function wpe_excerptlength_slider($length) {   return 5; }
function wpe_excerptlength_related($length) {  return 30; }
function wpe_excerptlength_blog($length) {  return 110; }
function wpe_excerptmore($more) {  return '...'; }
function wpe_no_excerptmore($more) {  return '.'; }

function wpe_excerpt($length_callback='', $more_callback='') {
	global $post;
    if(function_exists($length_callback)){
		add_filter('excerpt_length', $length_callback);
    }

    if(function_exists($more_callback)){
    	 add_filter('excerpt_more', $more_callback);
    }

     $output = get_the_excerpt();
     $output = apply_filters('wptexturize', $output);
     $output = apply_filters('convert_chars', $output);
     $output = '<p>'.do_shortcode($output).'</p>';
     return $output;
}



function my_render_ie_pie() {
echo ' <!--[if IE]>
	<style type="text/css" media="screen">
		.rounded-img, .rounded-img img, .ajax_previous, .ajax_next, #tiptip_content {
			behavior: url('.trailingslashit(IAMD_BASE_URL).'PIE.htc);
		}
	</style>
	<![endif]-->';
}

add_action('wp_head', 'my_render_ie_pie', 8);?>