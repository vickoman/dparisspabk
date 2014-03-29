<?php require_once(TEMPLATEPATH.'/framework/theme_widgets/twitter.php');
	  require_once(TEMPLATEPATH.'/framework/theme_widgets/mailchimp.php');
	  require_once(TEMPLATEPATH.'/framework/theme_widgets/flickr.php');
	  require_once(TEMPLATEPATH.'/framework/theme_widgets/widget_custom_post.php');
	  require_once(TEMPLATEPATH.'/framework/theme_widgets/widget_sociable.php');
	  
add_action( 'widgets_init', 'my_widgets' );
function my_widgets(){
	#Twitter
	register_widget('MY_Twitter');

	#Mailchimp
	register_widget('MY_Mailchimp');

	#Flickr
	register_widget('MY_Flickr');

	#Custom Post Widget
	register_widget('MY_Custom_Post');
	
	#Social Links Widget
	register_widget('MY_Social_Links');
	
}?>