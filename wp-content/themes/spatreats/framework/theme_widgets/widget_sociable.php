<?php class MY_Social_Links extends WP_Widget {
		#1.Constructor
		function MY_Social_Links() {
			$widget_options	 = array("classname"=>"social-widget","description"=>"To Show your social links.");
			$this->WP_Widget(false, wp_get_theme()." Social Icons",$widget_options);
		}
		
		#2.Form
		function form($instance) {
			$instance = wp_parse_args( (array) $instance, array('title'=>'') );
			$title	  = strip_tags($instance['title']);?>
                        
		  <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','spatreats');?></label>
			 <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" 
             type="text" value="<?php echo $title;?>"/></p>
             
<?php						
		}

		#3.Update Process
		function update( $new_instance,$old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
		return $instance;	
		}
		
		#4.widget Frontend
		function widget( $args,$instance ) {
			extract($args);
			$title 				= strip_tags($instance['title']);
			
			$url = IAMD_BASE_URL.'images/';
			
			echo "{$before_widget}";
			echo "	{$before_title}";
			echo "		{$title}";
			echo "	{$after_title}";
			$mytheme_options = get_option(IAMD_THEME_SETTINGS);
			
			if( isset($mytheme_options['general']['show-sociables']) && isset($mytheme_options['social']) ):
				echo "<ul>";
				foreach($mytheme_options['social'] as $social):
					$link = $social['link'];
					$icon = $social['icon'];
					echo "<li><a href='{$link}' target='_blank'>";
					echo "<img src='".IAMD_BASE_URL."/images/sociable/hover/{$icon}' alt='{$icon}' />";
					echo "<img src='".IAMD_BASE_URL."/images/sociable/{$icon}' alt='{$icon}' />";
					echo "	</a>";
					echo "</li>"; 
				endforeach;
				echo "</ul>";
			endif;
			echo "{$after_widget}";
		}
		
}?>