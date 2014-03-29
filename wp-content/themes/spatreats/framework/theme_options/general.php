<!-- #general -->
<div id="general" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#my-general"><?php _e("General",'spatreats');?></a></li>
            <li><a href="#my-sociable"><?php _e("Sociable",'spatreats');?></a></li>
        </ul>
        
        <!-- #my-general-->
        <div id="my-general" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">

                    <!-- Logo -->
                    <div class="box-title"><h3><?php _e('Logo','spatreats');?></h3></div>
                    <div class="box-content">
                    	<div class="image-preview-container">
                        	<input id="mytheme-logo" name="mytheme[general][logo-url]" type="text" class="uploadfield" readonly="readonly"
                                    value="<?php echo  mytheme_option('general','logo-url');?>" />
                            <input type="button" value="<?php _e('Upload','spatreats');?>" class="upload_image_button show_preview" />
                            <input type="button" value="<?php _e('Remove','spatreats');?>" class="upload_image_reset" />
                            <?php mytheme_adminpanel_image_preview(mytheme_option('general','logo-url'),false,'logo.png');?>
                        </div>
                        <p class="note"> <?php _e('Upload a logo for your theme, or specify the image address of your online logo.','spatreats');?> </p>
                    </div><!-- Logo End-->
            
                    <!-- Favicon -->
                    <div class="box-title">
                        <h3><?php _e('Favicon','spatreats');?></h3>
                    </div>
                    <div class="box-content">
                    	<h6> <?php _e('Enable Favicon','spatreats');?> </h6> 
                        
                        <div class="column one-fifth">                        
							<?php $checked = ( "true" ==  mytheme_option('general','enable-favicon') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  mytheme_option('general','enable-favicon') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="enable-favicon" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            <input class="hidden" id="enable-favicon" name="mytheme[general][enable-favicon]" type="checkbox" 
                            value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">                    
                            <input id="mytheme-favicon" name="mytheme[general][favicon-url]" type="text" class="uploadfield medium" 
                                value="<?php echo  mytheme_option('general','favicon-url');?>" />
                            <input type="button" value="<?php _e('Upload','spatreats');?>" class="upload_image_button" />
                            <input type="button" value="<?php _e('Remove','spatreats');?>" class="upload_image_reset" />
                        </div>
                        <p class="note"> <?php _e('Upload a favicon for your theme, or specify the oneline URL for favicon','spatreats');?>  </p>
                    </div> <!-- Favicon End -->


                    <!-- 404 Logo -->
                    <div class="box-title"><h3><?php _e('404 Image','spatreats');?></h3></div>
                    <div class="box-content">
                    	<div class="image-preview-container">
                        	<input id="mytheme-logo" name="mytheme[general][404-image]" type="text" class="uploadfield" readonly="readonly"
                                    value="<?php echo  mytheme_option('general','404-image');?>" />
                            <input type="button" value="<?php _e('Upload','spatreats');?>" class="upload_image_button show_preview" />
                            <input type="button" value="<?php _e('Remove','spatreats');?>" class="upload_image_reset" />
                            <?php mytheme_adminpanel_image_preview(mytheme_option('general','404-image'),true);?>
                        </div>
                        <p class="note"> <?php _e('Upload a image for the 404 page in your theme, or specify the image address of your online.','spatreats');?> </p>
                    </div><!-- 404 Logo End-->

                    <!-- Others -->
                    <div class="box-title"><h3><?php _e('Others', 'spatreats');?></h3></div>
                    <div class="box-content">
                    
                   	  <h6><?php _e('Globally Disable Comments on Pages','spatreats');?></h6>
                      <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  mytheme_option('general','disable-page-comment') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  mytheme_option('general','disable-page-comment') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="mytheme-global-page-comment" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            <input class="hidden" id="mytheme-global-page-comment" name="mytheme[general][disable-page-comment]" type="checkbox" 
                            value="true" <?php echo $checked;?> />
                       </div>
                       
                       <div class="column four-fifth last">
                       	<p class="note no-margin"><?php _e('YES! to disable comments on all the pages. This will globally override your "Allow comments" option under your page "Discussion" settings. ','spatreats');?> </p>
                       </div>
                       
                       <div class="hr"></div>
                       
                       <h6><?php _e('Globally Disable Comments on Posts','spatreats');?></h6>
                       <div class="column one-fifth">
                       <?php $checked = ( "true" ==  mytheme_option('general','global-post-comment') ) ? ' checked="checked"' : ''; 
                       		 $switchclass = ( "true" ==  mytheme_option('general','global-post-comment') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="mytheme-global-post-comment" class="checkbox-switch <?php echo $switchclass;?>"></div>
                            <input class="hidden" id="mytheme-global-post-comment" name="mytheme[general][global-post-comment]" type="checkbox" 
                            value="true" <?php echo $checked;?> />
                        </div>
                        
                        <div class="column four-fifth last">
                        	<p class="note no-margin"><?php _e('YES! to disable comments on all the posts. This will globally override your "Allow comments" option under your post "Discussion" settings. ','spatreats');?> </p>
                        </div>
                        <div class="hr"></div>

                        <h6><?php _e('Globally Disable Breadcrumbs','spatreats');?></h6>
                        <div class="column one-fifth">
                            <?php $switchclass = ( "on" ==  mytheme_option('general','disable-breadcrumb') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="mytheme-global-breadcrumb-disable" class="checkbox-switch <?php echo $switchclass;?>"></div>
							<input class="hidden" id="mytheme-global-breadcrumb-disable" name="mytheme[general][disable-breadcrumb]" type="checkbox" 
							<?php checked(mytheme_option('general','disable-breadcrumb'),'on');?>/>                            
                        </div>
                        <div class="column four-fifth last">
                        	<p class="note"><?php _e('show / Hide Breacrumbs globally on sitewide','spatreats');?> </p>
                        </div>

                        <div class="hr-invisible-small"> </div>
                        
                        <label><?php _e('Breadcrumb Delimiter','spatreats');?></label>
                        <input id="mytheme-breadcrumb-delimiter" name="mytheme[general][breadcrumb-delimiter]" type="text" class="small" 
                        	   value="<?php echo stripslashes(mytheme_option('general','breadcrumb-delimiter'));?>" />
                        <p class="note"><?php _e('This is the symbol that will appear in between your breadcrumbs','spatreats');?></p>
                        
                        <div class="hr"></div>
                        
                        <h6><?php _e('Google Font Subset','spatreats');?></h6>
                        <div class="column one-half">
                         <input id="mytheme-google-font-subset" name="mytheme[general][google-font-subset]" type="text" value="<?php echo mytheme_option('general','google-font-subset');?>"/>
                        </div>

                        <div class="column one-half last">
                            <p class="note no-margin"><?php _e('Specify which subsets should be downloaded. Multiple subsets should be separated with coma','spatreats'); ?></p>
                        </div>
                        
                        <div class="clear"> </div>
                        <div class="hr-invisible-small"> </div>
                        
                       	<p class="note"><?php _e('Some of the fonts in the Google Font Directory supports multiple scripts (like Latin and Cyrillic for example). In order to specify which subsets should be downloaded the subset parameter should be appended to the URL. For a complete list of available fonts and font subsets please see','spatreats'); 
							echo " <a href='http://www.google.com/webfonts'>Google Web Fonts</a>";?> </p>

                        <div class="hr"></div>
                        <div class="clear"> </div>
                        
                        <h6><?php _e('Mailchimp API KEY','spatreats');?></h6>
                        <div class="column one-half">
                            <input id="mytheme-mailchimp-key" name="mytheme[general][mailchimp-key]" type="text" value="<?php echo mytheme_option('general','mailchimp-key'); ?>" />
                        </div>
                        
                        <div class="column one-half last">
                            <p class="note no-margin"><?php _e('Paste your mailchimp api key that will be used by the mailchimp widget.','spatreats'); ?></p>
                        </div>
                        
                        <div class="hr"></div>
                        <div class="clear"> </div>
                        
                        <h6><?php _e('Site Bottom Newsletter','spatreats');?></h6>
                    	<?php $switchclass = ( "on" ==  mytheme_option('general','show-newsletter') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div class="column one-fifth">                         
                        	<div data-for="mytheme-show-newsletter" class="checkbox-switch <?php echo $switchclass;?>"></div>
						 	<input class="hidden" id="mytheme-show-newsletter" name="mytheme[general][show-newsletter]" type="checkbox" 
							 <?php checked(mytheme_option('general','show-newsletter'),'on');?>/>
						</div>
                        <div class="column four-fifth last">
                        	<p class="note"><?php _e('show / Hide bottom newsletter form globally on sitewide','spatreats');?> </p>
                        </div>
                        
                        <div class="hr-invisible-small"> </div>
                        
						<label><?php _e('Select List','spatreats');?></label><?php
							//CALLING LISTS...
							require_once(IAMD_FW."theme_widgets/mailchimp/MCAPI.class.php");
							$mcapi = new MCAPI( mytheme_option('general','mailchimp-key') );
							$lists = $mcapi->lists(); ?>
                        <select id="mytheme-newsletter-listid" name="mytheme[general][newsletter-listid]">
                        <option value=""><?php _e('Select', 'spatreats'); ?></option>
                        <?php foreach ($lists['data'] as $key => $value):
                              $id = $value['id'];
                              $name = $value['name'];
                              $selected = selected(mytheme_option('general','newsletter-listid'),$id,false);
                              echo "<option $selected value='$id'>$name</option>";
                           endforeach;?></select>
						 <p class="note no-margin"> <?php _e('Set mailchimp api key before selecting the list.','spatreats');?> </p>
                    </div><!-- Others End-->
                    
            </div><!-- .bpanel-box end-->
        </div><!--#my-general end-->
        
        <!-- #my-sociable-->
        <div id="my-sociable" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
            
                <div class="box-title">
                	<h3><?php _e('Sociable','spatreats');?></h3>
                </div><!-- .box-title -->

                <div class="box-content">
                    <div class="bpanel-option-set">
                         <h6><?php _e('Show Sociable','spatreats');?></h6>
                         
                         <div class="column one-fifth">
							 <?php $switchclass = ( "on" ==  mytheme_option('general','show-sociables') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                             <div data-for="mytheme-show-sociables" class="checkbox-switch <?php echo $switchclass;?>"></div>
                             <input class="hidden" id="mytheme-show-sociables" name="mytheme[general][show-sociables]" type="checkbox" 
                             <?php checked(mytheme_option('general','show-sociables'),'on');?>/>
                         </div>
                         
                         <input type="button" value="<?php _e('Add New Sociable','spatreats');?>" class="black mytheme_add_item" />
                         
                         <div class="column four-fifth last">
                             <p class="note"> <?php _e('Manage Social Network icons list to display','spatreats');?> </p>
                         </div>
                         
                         <div class="hr_invisible"></div>
                    </div>
                    
                    <div class="bpanel-option-set">
                        <ul class="menu-to-edit">
                        <?php $socials = mytheme_option('social');
						      if(is_array($socials)): 
							  	$keys = array_keys($socials);
								$i=0;
						 	  foreach($socials as $s):?>
                              <li id="<?php echo $keys[$i];?>">
                                <div class="item-bar">
                                    <span class="item-title"><?php $n = $s['icon']; $n = explode('.',$n); $n = ucwords($n[count($n) - 2]); echo $n;?></span>
                                    <span class="item-control"><a class="item-edit"><?php _e('Edit','spatreats');?></a></span>
                                </div>
                                <div class="item-content" style="display: none;">
                                	<span><label><?php _e('Sociable Icon','spatreats');?></label>
										<?php echo mytheme_sociables_selection($keys[$i],$s['icon']);?></span>
                                    <span><label><?php _e('Sociable Link','spatreats');?></label>
                                    	<input type="text" class="social-link" name="mytheme[social][<?php echo $keys[$i];?>][link]" value="<?php echo $s['link']?>"/>
                                    </span>
                                    
                                    <div class="remove-cancel-links">
                                        <span class="remove-item"><?php _e('Remove','spatreats');?></span>
                                        <span class="meta-sep"> | </span>
                                        <span class="cancel-item"><?php _e('Cancel','spatreats');?></span>
                                    </div>
                                </div>
                              </li>
                        <?php $i++;endforeach; endif;?> 
                        </ul>
                        
                        <ul class="sample-to-edit" style="display:none;">
                        	<!-- Social Item -->
                            <li>
                            	<!-- .item-bar -->
                            	<div class="item-bar">
                                	<span class="item-title"><?php _e('Sociable','spatreats');?></span>
                                    <span class="item-control"><a class="item-edit"><?php _e('Edit','spatreats');?></a></span>
                                </div><!-- .item-bar -->
                                <!-- .item-content -->
                                <div class="item-content">                                
                                	<span><label><?php _e('Sociable Icon','spatreats');?></label><?php echo mytheme_sociables_selection();?></span>
                                    <span><label><?php _e('Sociable Link','spatreats');?></label><input type="text" class="social-link" /></span>
                                    <div class="remove-cancel-links">
                                        <span class="remove-item"><?php _e('Remove','spatreats');?></span>
                                        <span class="meta-sep"> | </span>
                                        <span class="cancel-item"><?php _e('Cancel','spatreats');?></span>
                                    </div>
                                </div><!-- .item-content end -->
                            </li><!-- Social Item End-->
                        </ul>
                        
                    </div>
                </div> <!-- .box-content -->    
                
            </div><!-- .bpanel-box end -->
        </div><!--#my-sociable end-->

    </div><!-- .bpanel-main-content end-->
</div><!-- #general end-->