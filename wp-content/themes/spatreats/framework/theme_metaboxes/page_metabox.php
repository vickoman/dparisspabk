<?php add_action("admin_init", "page_metabox");?>
<?php function page_metabox(){
			add_meta_box("page-template-slider-meta-container", __('Slider Options','spatreats'), "page_sllider_settings", "page", "normal", "high");	
			add_meta_box("page-template-meta-container", __('Default page Options','spatreats'), "page_settings", "page", "normal", "high");
			add_action('save_post','page_meta_save');
	} 
	
	
	#Slider Meta Box
	function page_sllider_settings($args){	
		global $post; 
		$tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
		$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();?>

		<!-- Show Slider -->        
        <div class="custom-box">
        	<div class="column one-sixth">
                <label><?php _e('Show Slider','spatreats');?> </label>
            </div>
            <div class="column four-sixth last">
				<?php $switchclass = array_key_exists("show_slider",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                      $checked = array_key_exists("show_slider",$tpl_default_settings) ? ' checked="checked"' : '';?>
                <div data-for="mytheme-show-slider" class="checkbox-switch <?php echo $switchclass;?>"></div>
                <input id="mytheme-show-slider" class="hidden" type="checkbox" name="mytheme-show-slider" value="true"  <?php echo $checked;?>/>
                <p class="note"> <?php _e('YES! to show slider on this page.','spatreats');?> </p>
            </div>
        </div><!-- Show Slider End-->

        <!-- Slider Types -->
        <div class="custom-box">
        	<div class="column one-sixth">
                <label><?php _e('Choose Slider','spatreats');?></label>
            </div>
            <div class="column four-sixth last">
	            <?php $slider_types = array( '' => __("Select",'spatreats'),
											 'layerslider' => __("Layer Slider",'spatreats'),
											 'revolutionslider' => __("Revolution Responsive",'spatreats'));
											 
	 				  $v =  array_key_exists("slider_type",$tpl_default_settings) ?  $tpl_default_settings['slider_type'] : '';
					  
					  echo "<select class='slider-type' name='mytheme-slider-type'>";
					  foreach($slider_types as $key => $value):
					  	$rs = selected($key,$v,false);
						echo "<option value='{$key}' {$rs}>{$value}</option>";
					  endforeach;
	 				 echo "</select>";?>
            <p class="note"> <?php _e("Choose which slider you wish to use ( eg: Layer or Revolution )",'spatreats');?> </p>
            </div>
        </div><!-- Slider Types End-->
        
        <!-- slier-container starts-->
    	<div id="slider-conainer">
        <?php $layerslider = $revolutionslider = 'style="display:none"';
			  if(isset($tpl_default_settings['slider_type'])&& $tpl_default_settings['slider_type'] == "layerslider"):
			  	$layerslider = 'style="display:block"';
			  elseif(isset($tpl_default_settings['slider_type'])&& $tpl_default_settings['slider_type'] == "revolutionslider"):
			  	$revolutionslider = 'style="display:block"';
			  endif;?>
              
          
              <!-- Layered Slider -->
              <div id="layerslider" class="custom-box" <?php echo $layerslider;?>>
              	<h3><?php _e('Layer Slider','spatreats');?></h3>
                <?php if(mytheme_is_plugin_active('LayerSlider/layerslider.php')):?>
                <?php // Get WPDB Object
					  global $wpdb;
					  // Table name
					  $table_name = $wpdb->prefix . "layerslider";
					  // Get sliders
					  $sliders = $wpdb->get_results( "SELECT * FROM $table_name WHERE flag_hidden = '0' AND flag_deleted = '0'  ORDER BY date_c ASC LIMIT 100" );
					  
					  if($sliders != null && !empty($sliders)):
		 	                echo '<div class="one-half-content">';
							echo '	<div class="bpanel-option-set">';
							echo ' <div class="column one-sixth">';
                            echo '	<label>'.__('Select LayerSlider','spatreats').'</label>';
							echo ' 	</div>';
							echo ' <div class="column two-sixth">';
                            echo '	<select name="layerslider_id">';
                            echo '		<option value="0">'.__("Select Slider",'spatreats').'</option>';
									  	foreach($sliders as $item) :
											$name = empty($item->name) ? 'Unnamed' : $item->name;
											$id = $item->id;
											$rs = isset($tpl_default_settings['layerslider_id']) ? $tpl_default_settings['layerslider_id']:'';
											$rs = selected($id,$rs,false);
											echo "	<option value='{$id}' {$rs}>{$name}</option>";
										endforeach;
                            echo '	</select>';
                            echo '<p class="note">';
							_e("Choose Which LayerSlider you would like to use..",'spatreats');
							echo "</p>";
							echo ' 	</div>';
							echo '	</div>';
                            echo '</div>';
					  else:
					     echo '<p id="j-no-images-container">'.__('Please add atleat one layer slider','spatreats').'</p>';
					  endif;?>
                      
					<?php $layersliders = get_option('layerslider-slides');
                        if($layersliders):
                            $layersliders = is_array($layersliders) ? $layersliders : unserialize($layersliders);	
                            foreach($layersliders as $key => $val):
                                $layersliders_array[$key+1] = 'LayerSlider #'.($key+1);
                            endforeach;
                            echo '<div class="one-half-content">';
							echo '	<div class="bpanel-option-set">';
							echo ' <div class="column one-sixth">';
                            echo '	<label>'.__('Select LayerSlider','spatreats').'</label>';
                            echo '</div>';
							echo ' <div class="column two-sixth">';
                            echo '	<select name="layerslider_id">';
                            echo '		<option value="0">'.__("Select Slider",'spatreats').'</option>';
                            foreach($layersliders_array as $key => $value):
                                $rs = isset($tpl_default_settings['layerslider_id']) ? $tpl_default_settings['layerslider_id']:'';
                                $rs = selected($key,$rs,false);
                                echo "	<option value='{$key}' {$rs}>{$value}</option>";
                            endforeach;
                            echo '	</select>';
                            echo '<p class="note">';
							_e("Choose which LayerSlider would you like to use!",'spatreats');
							echo "</p>";
                            echo '</div>';
							echo '	</div>';
                            echo '</div>';
                        endif;
					  else:?>
                      <p id="j-no-images-container"><?php _e('Please activate Layered Slider','spatreats'); ?></p>
               <?php endif;?>         
                
              </div><!-- Layered Slider End-->

              <!-- Revolution Slider -->
              <div id="revolutionslider" class="custom-box" <?php echo $revolutionslider;?>>
	            <h3><?php _e('Revolution Slider','spatreats');?></h3>
                <?php $return = check_slider_revolution_responsive_wordpress_plugin();
					  if($return):
                        echo '<div class="one-half-content">';
						echo '	<div class="bpanel-option-set">';
						echo ' <div class="column one-sixth">';
						echo '	<label>'.__('Select Slider','spatreats').'</label>';
						echo '</div>';
						echo ' <div class="column three-sixth">';
						echo '	<select name="revolutionslider_id">';
						echo '		<option value="0">'.__("Select Slider",'spatreats').'</option>';
						foreach($return as $key => $value):
							$rs = isset($tpl_default_settings['revolutionslider_id']) ? $tpl_default_settings['revolutionslider_id']:'';
							$rs = selected($key,$rs,false);
							echo "	<option value='{$key}' {$rs}>{$value}</option>";
						endforeach;
						echo '</select>';
						echo '<p class="note">';
						_e("Choose which Revolution slider would you like to use!",'spatreats');
						echo "</p>";
						echo '</div>';
						echo '	</div>';
						echo '</div>';
                	  else: ?>
	                	<p id="j-no-images-container"><?php _e('Please activate Revolution Slider , and add at least one slider.','spatreats'); ?></p>
                <?php endif;?>
              </div><!-- Revolution Slider End-->
        </div><!-- slier-container ends-->

        
	
<?php  wp_reset_postdata();
	}

	#Page Meta Box	
	function page_settings($args){
		 
		global $post; 
		$tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
		$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();?>
        
        <div class="j-pagetemplate-container">
        
            
            	<div id="tpl-common-settings">
                    <!-- 1. Layout -->
                    <div class="custom-box ">
                        <div class="column one-sixth">
                            <label><?php _e('Layout','spatreats');?> </label>
                        </div>
                        <div class="column five-sixth last">                        
                            <ul class="bpanel-layout-set">
                                <?php $homepage_layout = array('content-full-width'=>'without-sidebar','with-left-sidebar'=>'left-sidebar','with-right-sidebar'=>'right-sidebar');
                                    $v =  array_key_exists("layout",$tpl_default_settings) ?  $tpl_default_settings['layout'] : 'content-full-width';
                                    foreach($homepage_layout as $key => $value):
                                        $class = ($key == $v) ? " class='selected' " : "";
                                        echo "<li><a href='#' rel='{$key}' {$class}><img src='".IAMD_FW_URL."theme_options/images/columns/{$value}.png' /></a></li>";
                                    endforeach;?>
                            </ul>
                            <?php $v = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : 'content-full-width';?>
                            <input id="mytheme-page-layout" name="layout" type="hidden"  value="<?php echo $v;?>"/>
                            <p class="note"> <?php _e("You can choose between a left, right or no sidebar layout.",'spatreats');?> </p>
                        </div>
                    </div> <!-- Layout End-->
    
                    <!-- 2. Every Where Sidebar Start -->
                    <div class="custom-box">
                    	<div class="column one-sixth">
                            <label><?php _e('Disable Every Where Sidebar','spatreats');?></label>
                        </div>
                        <div class="column five-sixth last">
							<?php $switchclass = array_key_exists("disable-everywhere-sidebar",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                  $checked = array_key_exists("disable-everywhere-sidebar",$tpl_default_settings) ? ' checked="checked"' : '';?>
                            <div data-for="mytheme-disable-everywhere-sidebar" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            <input id="mytheme-disable-everywhere-sidebar" class="hidden" type="checkbox" name="disable-everywhere-sidebar" value="true"  <?php echo $checked;?>/>
                            <p class="note"> <?php _e('Yes! to hide "Every Where Sidear" on this page.','spatreats');?> </p>
                        </div>
                    </div><!-- Every Where Sidebar Section End-->
                    
                </div><!-- .tpl-common-settings end -->    
                
               
				<div id="tpl-default-settings">
                
                    <!-- 4. Allow Commenet -->
                    <div class="custom-box">
                    	<div class="column one-sixth">
                            <label><?php _e('Allow Comments','spatreats');?></label>
                        </div>
                        <div class="column five-sixth last">
							<?php $switchclass = array_key_exists("comment",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                                  $checked = array_key_exists("comment",$tpl_default_settings) ? ' checked="checked"' : '';?>
                            <div data-for="mytheme-page-comment" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            <input id="mytheme-page-comment" class="hidden" type="checkbox" name="mytheme-page-comment" value="true"  <?php echo $checked;?>/>
                            <p class="note"> <?php _e('YES! to allow comments on this page.','spatreats');?> </p>
                        </div>
                    </div><!-- Allow Commenet End-->
               </div><!-- tpl-default-settings end-->     
             
             
             <!-- Blog Template Settings -->
             <div id="tpl-blog">

                <!-- Post Count-->
                <div class="custom-box">
                    <div class="column one-sixth"> 
                        <label><?php _e('Post per page','spatreats');?></label>
                    </div>
                    <div class="column five-sixth last"> 
                        <select name="mytheme-blog-post-per-page">
                            <option value="-1"><?php _e("All",'spatreats');?></option>
                            <?php $selected = 	array_key_exists("blog-post-per-page",$tpl_default_settings) ?  $tpl_default_settings['blog-post-per-page'] : ''; ?>
                            <?php for($i=1;$i<=30;$i++):
                                echo "<option value='{$i}'".selected($selected,$i,false).">{$i}</option>";
                                endfor;?>
                        </select>
                        <p class="note"> <?php _e("Your blog pages show at most selected number of posts per page.",'spatreats');?> </p>
                    </div>
                </div><!-- Post Count End-->
                
                <!-- Categories -->
                <div class="custom-box">
                	<h3><?php _e('Exclude Categories','spatreats');?></h3>
                    <?php if(array_key_exists("blog-post-exclude-categories",$tpl_default_settings)):
							 $exclude_cats = array_unique($tpl_default_settings["blog-post-exclude-categories"]);
							 foreach($exclude_cats as $cats):
								echo "<!-- Category Drop Down Container -->
									  <div class='multidropdown'>";
								echo  mytheme_categorylist("blog,exclude_cats",$cats,"multidropdown");
								echo "</div><!-- Category Drop Down Container end-->";		
							 endforeach;
						  else:
							echo "<!-- Category Drop Down Container -->";
							echo "<div class='multidropdown'>";
							echo  mytheme_categorylist("blog,exclude_cats","","multidropdown");
							echo "</div><!-- Category Drop Down Container end-->";
						   endif;?>
                    <p class="note"> <?php _e("You can choose certain categories to exclude from your blog page.",'spatreats');?> </p>
                </div><!-- Categories End-->
             </div><!-- Blog Template Settings End-->

             <!-- Gallery Template Settings -->
             <div id="tpl-gallery">
             
             	<!-- Post Playout -->
                <div class="custom-box">
                    <div class="column one-sixth">                
                        <label><?php _e('Posts Layout','spatreats');?> </label>
                    </div>
                    <div class="column five-sixth last">                        
                        <ul class="bpanel-layout-set">
                        <?php $posts_layout = array(	'one-column'=>	__("Single post per row.",'spatreats'),
                                                        'one-half-column'=>	__("Two posts per row.",'spatreats'),
                                                        'one-third-column'=>	__("Three posts per row.",'spatreats'),
                                                        'one-fourth-column' => __("Four posts per row",'spatreats'));
                                $v = array_key_exists("gallery-post-layout",$tpl_default_settings) ?  $tpl_default_settings['gallery-post-layout'] : 'one-column';
                                foreach($posts_layout as $key => $value):
                                    $class = ($key == $v) ? " class='selected' " : "";
                                    echo "<li><a href='#' rel='{$key}' {$class} title='{$value}'><img src='".IAMD_FW_URL."theme_options/images/columns/{$key}.png' /></a></li>";
                                endforeach;?>
                        </ul>
                        <input id="mytheme-gallery-post-layout" name="mytheme-gallery-post-layout" type="hidden" value="<?php echo $v;?>"/>
                        <p class="note"> <?php _e("Choose layout style for your Gallery",'spatreats');?> </p>
                    </div>
                </div><!-- Post Playout End-->

                <!-- Ajax-->
                <div class="custom-box">
                    <div class="column one-sixth">
                        <label><?php _e('Gallery Details?','spatreats');?></label>
                    </div>
                    <div class="column five-sixth last">
                        <?php $switchclass = array_key_exists("is_ajax_load",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                              $checked = array_key_exists("is_ajax_load",$tpl_default_settings) ? ' checked="checked"' : '';?>
                        <div data-for="mytheme-gallery-ajax" class="checkbox-switch <?php echo $switchclass;?>"></div>
                        <input id="mytheme-gallery-ajax" class="hidden" type="checkbox" name="mytheme-gallery-ajax" value="true"  <?php echo $checked;?>/>
                        <p class="note"> <?php _e('Should the gallery details be opened on the same page when someone clicks a gallery item - known as AJAX Gallery?','spatreats');?> </p>
                    </div>
                </div><!-- Ajax End-->

                <!-- Sorting-->
                <div class="custom-box">
                    <div class="column one-sixth">
                        <label><?php _e('Gallery Sortable?','spatreats');?></label>
                    </div>
                    <div class="column five-sixth last">
                        <?php $switchclass = array_key_exists("is_sortable",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                              $checked = array_key_exists("is_sortable",$tpl_default_settings) ? ' checked="checked"' : '';?>
                        <div data-for="mytheme-gallery-sort" class="checkbox-switch <?php echo $switchclass;?>"></div>
                        <input id="mytheme-gallery-sort" class="hidden" type="checkbox" name="mytheme-gallery-sort" value="true"  <?php echo $checked;?>/>
                        <p class="note"> <?php _e('Should the sorting options based on categories be displayed?','spatreats');?> </p>
                    </div>
                </div><!-- Sorting End-->

                <!-- Title-->
                <div class="custom-box">
                    <div class="column one-sixth">
                        <label><?php _e('Show Titles','spatreats');?></label>
                    </div>
                    <div class="column five-sixth last">
                        <?php $switchclass = array_key_exists("show_title",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                              $checked = array_key_exists("show_title",$tpl_default_settings) ? ' checked="checked"' : '';?>
                        <div data-for="mytheme-gallery-show-title" class="checkbox-switch <?php echo $switchclass;?>"></div>
                        <input id="mytheme-gallery-show-title" class="hidden" type="checkbox" name="mytheme-gallery-show-title" value="true"  <?php echo $checked;?>/>
                        <p class="note"> <?php _e('Should the sorting options based on categories be displayed?','spatreats');?> </p>
                    </div>
                </div><!-- Title End-->

                <!-- Post Count-->
                <div class="custom-box">
                    <div class="column one-sixth"> 
                        <label><?php _e('Post per page','spatreats');?></label>
                    </div>
                    <div class="column five-sixth last"> 
                        <select name="mytheme-gallery-post-per-page">
                            <option value="-1"><?php _e("All",'spatreats');?></option>
                            <?php $selected = 	array_key_exists("gallery-post-per-page",$tpl_default_settings) ?  $tpl_default_settings['gallery-post-per-page'] : ''; ?>
                            <?php for($i=1;$i<=30;$i++):
                                echo "<option value='{$i}'".selected($selected,$i,false).">{$i}</option>";
                                endfor;?>
                        </select>
                        <p class="note"> <?php _e("How many items should be displayed per page?",'spatreats');?> </p>
                    </div>
                </div><!-- Post Count End-->

                <!-- Categories -->
                <div class="custom-box">
                	<h3><?php _e('Categories','spatreats');?></h3>
                    <?php if(array_key_exists("gallery-categories",$tpl_default_settings)):
							 $exclude_cats = array_unique($tpl_default_settings["gallery-categories"]);
							 foreach($exclude_cats as $cats):
								echo "<!-- Category Drop Down Container -->
									  <div class='multidropdown'>";
								echo  mytheme_gallery_categorylist("gallery,cats",$cats,"multidropdown");
								echo "</div><!-- Category Drop Down Container end-->";		
							 endforeach;
						  else:
							echo "<!-- Category Drop Down Container -->";
							echo "<div class='multidropdown'>";
							echo  mytheme_gallery_categorylist("gallery,cats","","multidropdown");
							echo "</div><!-- Category Drop Down Container end-->";
						   endif;?>
                    <p class="note"> <?php _e("You can choose from which categories you wnat to show gallery items",'spatreats');?> </p>
                </div><!-- Categories End-->
                
                
                
             
             </div><!-- Gallery Template Settings End-->

             <!-- Catalog Template Settings -->
             <div id="tpl-catalog">
                <!-- Categories -->
                <div class="custom-box">
                	<h3><?php _e('Categories','spatreats');?></h3>
                    <?php if(array_key_exists("catalog-categories",$tpl_default_settings)):
							 $cats = array_unique($tpl_default_settings["catalog-categories"]);
							 foreach($cats as $cat):
								echo "<!-- Category Drop Down Container -->
									  <div class='multidropdown'>";
								echo  mytheme_product_taxonomy_list("catalog,cats",$cat,"multidropdown","item_category");
								echo "</div><!-- Category Drop Down Container end-->";		
							 endforeach;
						  else:
							echo "<!-- Category Drop Down Container -->";
							echo "<div class='multidropdown'>";
								echo  mytheme_product_taxonomy_list("catalog,cats","","multidropdown","item_category");
							echo "</div><!-- Category Drop Down Container end-->";
						   endif;?>
                    <p class="note"> <?php _e("You can choose from which categories you wnat to show catalog items",'spatreats');?> </p>
                </div><!-- Categories End-->
             </div><!-- Catalog Template Settings End-->
             
        </div>    
<?php  wp_reset_postdata();
   } 
   
	function page_meta_save($post_id){
		global $pagenow;
		if ( 'post.php' != $pagenow ) return $post_id;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 	return $post_id;

			$settings = array();
			$settings['layout'] = $_POST['layout'];
			$settings['disable-everywhere-sidebar'] = $_POST['disable-everywhere-sidebar'];
			
			if(isset($_POST["page_template"]) && ( 'default' == $_POST["page_template"]) ) :
			
				$settings['show_slider'] =  $_POST['mytheme-show-slider'];
				$settings['slider_type'] = $_POST['mytheme-slider-type'];
				$settings['comment'] = $_POST['mytheme-page-comment'];
				$settings['layerslider_id'] = $_POST['layerslider_id'];
				$settings['revolutionslider_id'] = $_POST['revolutionslider_id'];
				
			elseif( "tpl-blog.php" == $_POST['page_template'] ):
				$settings['blog-post-per-page'] = $_POST['mytheme-blog-post-per-page'];
				$settings['blog-post-exclude-categories'] = $_POST['mytheme']['blog']['exclude_cats'];
			
			elseif( "tpl-gallery.php" == $_POST['page_template'] ):
				$settings['gallery-post-layout'] =  $_POST['mytheme-gallery-post-layout'];
				$settings['is_ajax_load'] = $_POST['mytheme-gallery-ajax'];
				$settings['is_sortable'] = $_POST['mytheme-gallery-sort'];
				$settings['show_title'] = $_POST['mytheme-gallery-show-title'];
				$settings['gallery-post-per-page'] = $_POST['mytheme-gallery-post-per-page'];
				$settings['gallery-categories'] = $_POST['mytheme']['gallery']['cats'];
			
			elseif( "tpl-catalog.php" === $_POST['page_template']):
				$settings['catalog-categories'] = $_POST['mytheme']['catalog']['cats'];
			endif;
			
		update_post_meta($post_id, "_tpl_default_settings", array_filter($settings));
		
	}?>