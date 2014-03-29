<?php 
add_action("admin_init", "gallery_metabox");
function gallery_metabox(){
	add_meta_box("gallery-post-meta-container", __('Gallery Images Settings','spatreats'), "gallery_settings", "gallery", "normal", "high");
	add_action('save_post','gallery_item_meta_save');
}

function gallery_settings($callback_args){ 
	global $post;
	$args = array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'post_mime_type' => 'image', 'posts_per_page' => 10 );
	$media_query = new WP_Query($args);
	
	$data = get_post_meta( $post->ID, '_gallery_post_meta', true );
	$data = is_array($data) ? $data  : array(); ?>

        <div class="custom-box">
            <div class="column one-sixth">             
                <label><?php _e('Show Related Projects','spatreats');?></label>
            </div>
            <div class="column five-sixth last">  
                <?php $switchclass = array_key_exists("show-releated-items",$data) ? 'checkbox-switch-on' :'checkbox-switch-off';
                      $checked = array_key_exists("show-releated-items",$data) ? ' checked="checked"' : '';?>
                <div data-for="mytheme-related-item" class="checkbox-switch <?php echo $switchclass;?>"></div>
                <input id="mytheme-related-item" class="hidden" type="checkbox" name="mytheme-related-item" value="true"  <?php echo $checked;?>/>
                <p class="note"> <?php _e('Would you like to show the related projects at the bottom','spatreats');?> </p>
            </div>
        </div>
        
        <div class="custom-box">
            <p id="j-no-images-container"><?php _e('Please, add some image','spatreats'); ?></p>
            <ul id="j-used-sliders-containers">
            <?php if(array_key_exists("images",$data)):
					//PERFORMING ARRAY...
					$images = ( isset($data["images"]) && is_array( unserialize( $data['images'] ) ) ) ? array_filter(  unserialize( $data['images'] ) ) : array();
					//FORLOOP...
				 	foreach($images as $item): 
						 if( is_numeric($item) ):
						 	 $image = wp_get_attachment_image($item);?>
                             	<li data-attachment-id="<?php echo(esc_attr($item));?>">
                            		<?php echo($image); ?>
	                               	<span class="my_delete">x</span>
    	                           	<input type="hidden" value="<?php echo(esc_attr($item));?>" name="sliders[]" />
	    	                    </li>                              
				   <?php else:
				   				$img = "<img width='150' height='150' src='".IAMD_FW_URL."theme_options/images/video-slider.jpg' title='{$item}' />";
								echo "<li>";
								echo  $img;
								echo "<span class='my_delete'>x</span>";
								echo "<input type='hidden' value='{$item}' name='sliders[]' />";
								echo "</li>";
						 endif;
                	endforeach;
                endif;?>
            </ul><!-- Used Sliders End -->

            <!-- Available Images -->
            <div class="clear"> </div>
            <h3 class="slider-info"><?php _e("Available Images",'spatreats');?></h3>
            <ul id="j-available-sliders">
            <?php foreach ($media_query->posts as $attachment):
                    @$added_class = (  in_array( $attachment->ID, $data['images'] ,false ) ) ? ' class="my_added"' : ''; ?>
                        <li <?php echo($added_class);?> data-attachment-id="<?php echo(esc_attr($attachment->ID));?>">
                            <?php echo(wp_get_attachment_image( $attachment->ID));?>
                            <span class="my_delete">x</span>
                        </li>                    
            <?php endforeach;?>	
            </ul><!-- Available Images  End-->

            <!-- Pagination -->
            <?php if ( $media_query->max_num_pages > 1 ): ?>
                    <div id="j-slider-pagination" class="admin-pagination j-for-portfolio">
                      <?php  for ( $i=1; $i <= $media_query->max_num_pages; $i++ ): ?>
                        <a href="#" <?php echo( 1 == $i ? ' class="active_page"' : '' ) ?>><?php echo($i);?></a>
                      <?php endfor;?>
                    </div>
            <?php endif; ?>	


        <h2><?php _e("Choose effects:",'spatreats');?></h2>
        <?php $effects = array("fade","scrollLeft","scrollRight","scrollUp","scrollDown","slideX","slideY","turnUp","turnDown","turnLeft","turnRight","zoom",
			"fadeZoom","growX","growY");
			 sort($effects);
			 $p = (isset($data['effects']) && is_array( unserialize($data['effects'])) )? unserialize($data['effects'])  : array();
			 foreach( $effects as $effect): ?>
	         <label style="padding:5px; width:100px; float:left; display: block;">
             	<input type="checkbox" name="effects[]" value="<?php echo($effect);?>"<?php checked(in_array(esc_attr($effect),$p));?>/>  <?php echo(esc_html($effect));?>
             </label>
             <?php endforeach; ?> 
            
        </div>
        
<?php wp_reset_postdata(); ?>       
<?php }?>
<?php function gallery_item_meta_save( $post_id){

		global $pagenow;
		if ( 'post.php' != $pagenow ) return $post_id;
	
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
			return $post_id;
	
		$data = array();
		$data['images']  = isset($_POST['sliders'])? serialize($_POST['sliders']):NULL;
		$data['effects'] = isset($_POST['effects'])? serialize($_POST['effects']):NULL;
		$data['show-releated-items'] = $_POST['mytheme-related-item'];
		update_post_meta($post_id, '_gallery_post_meta',array_filter($data));
	  }?>