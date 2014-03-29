<!-- #integration -->
<div id="integration" class="bpanel-content">
	<!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel">   
            <li><a href="#integration-general"><?php _e("General",'spatreats');?></a></li>
            <li><a href="#integration-post"><?php _e("Post",'spatreats');?></a></li>
            <li><a href="#integration-page"><?php _e("Page",'spatreats');?></a></li>

        </ul>
	    
        <!-- #integration-general-->    
        <div id="integration-general">
        	<?php $integration_general = array( 
					array(
						"title"=>		__('Add Code Inside the &lt;head&gt','spatreats'),
						"tooltip"=>		__('Any code you place here will appear in the head section of every page of your site. This is useful when you need to add javascript or css to all pages.','spatreats'),
						"textarea"=>	"header-code",
						"checkbox"=>	"enable-header-code",
						"label"=>		__('Enable Header Code','spatreats')
					),
					array(
						"title"=>		__('Add Code above &lt;/body&gt;','spatreats'),
						"tooltip"=>		__('You can paste your Google Analytics or other website tracking codes in this box. This will be automatically added above the &lt;/body&gt; tag.','spatreats'), 
						"textarea"=>	"body-code",
						"checkbox"=>	"enable-body-code",
						"label"=>		__('Enable Body Code','spatreats')
					),
					array(
						"title"=> 	__('Custom CSS','spatreats'),
						"tooltip"=>		__('Paste your custom CSS code here.','spatreats'), 
						"textarea"=>	"custom-css",
						"checkbox"=>	"enable-custom-css",
						"label"=>		__('Enable Custom CSS','spatreats')
						
					)
			);
			
			foreach($integration_general as $i_general): ?>
                <!-- .bpanel-box-->
                <div class="bpanel-box">
                	<div class="box-title"><h3><?php echo $i_general['title'];?></h3></div>
                    <!-- .box-content -->
                	<div class="box-content">
                    	 <h6><?php echo $i_general['label'];?></h6>
                         <div class="column one-fifth">
							 <?php $switchclass = (mytheme_option('integration',$i_general['checkbox'])<>'') ? 'checkbox-switch-on' :'checkbox-switch-off';?>
                             <div data-for="<?php echo $i_general['checkbox'];?>" class="checkbox-switch <?php echo $switchclass;?>"></div>                         
                             <input id="<?php echo $i_general['checkbox'];?>" class="hidden" type="checkbox" name="mytheme[integration][<?php echo $i_general['checkbox'];?>]" 
                             value="<?php echo $i_general['checkbox'];?>" <?php checked($i_general['checkbox'],mytheme_option('integration',$i_general['checkbox'])); ?> />                         </div>

                        <div class="column four-fifth last">
                            <p class="note no-margin"><?php echo $i_general['tooltip'];?></p>
                        </div>  
                             
                         <div class="clear"></div>
	                     <div class="hr_invisible"></div>
                         <div class="hr_invisible"></div>
                         <textarea id="mytheme[integration][<?php echo $i_general['textarea']?>]" 
                         	name="mytheme[integration][<?php echo $i_general['textarea']?>]"><?php echo stripslashes(mytheme_option('integration',$i_general['textarea']));?></textarea>
                    </div><!-- .box-content end-->

                </div><!-- .bpanel-box end-->
	  <?php endforeach;?>
        </div><!-- #integration-general end-->

        <!-- #integration-post-->
        <div id="integration-post">
        <?php $integration_post = array(
					array(
						"title"=>		__('Add code to the top of your posts','spatreats'),
						"tooltip"=>		__('Place any codes to show on top of all single post. This is useful if you are looking to integrate things such as social bookmarking links, AD etc.,.','spatreats'),
						"textarea"=>	"single-post-top-code", 
						"checkbox"=>	"enable-single-post-top-code",
						"label"=>		__('Enable single post top code','spatreats')
					),
					array(
						"title"=>		__('Add code to the bottom of your posts, before the comments','spatreats'),
						"tooltip"=>		__('Place any codes to show on bottom of all single post. This is useful if you are looking to integrate things such as social bookmarking links, AD etc.,.','spatreats'),
						"textarea"=>	"single-post-bottom-code",
						"checkbox"=>	"enable-single-post-bottom-code",
						"label"=>		__('Enable single post bottom code','spatreats')
					));
				foreach($integration_post as $i_post): ?>
                	<!-- .bpanel-box-->
                    <div class="bpanel-box">
                    	<div class="box-title"><h3><?php echo $i_post['title'];?></h3></div>
                        
                        <!-- .box-content -->
                        <div class="box-content">
                        	<h6><?php echo $i_post['label'];?></h6>
                            <div class="column one-fifth">
	                   	    	<?php $switchclass = (mytheme_option('integration',$i_post['checkbox'])<>'') ? 'checkbox-switch-on' :'checkbox-switch-off';?>
								<div data-for="<?php echo $i_post['checkbox'];?>" class="checkbox-switch <?php echo $switchclass;?>"></div>
        	                    <input id="<?php echo $i_post['checkbox'];?>" class="hidden" type="checkbox" name="mytheme[integration][<?php echo $i_post['checkbox'];?>]"
            	                value="<?php echo $i_post['checkbox'];?>" <?php checked($i_post['checkbox'],mytheme_option('integration',$i_post['checkbox'])); ?>/>
                             </div>

                            <div class="column four-fifth last">
                                <p class="note no-margin"><?php echo $i_post['tooltip'];?></p>
                            </div>  
                            
                            <div class="clear"></div>
                            <div class="hr_invisible"></div>
                            <div class="hr_invisible"></div>
                    	<textarea id="mytheme[integration][<?php echo $i_post['textarea']?>]"  name="mytheme[integration][<?php echo $i_post['textarea']?>]"><?php echo stripslashes(mytheme_option('integration',$i_post['textarea']));?></textarea>
                    	</div><!-- .box-content end-->
                </div><!-- .bpanel-box end-->
        <?php	endforeach;?>
        

            <!-- Social Bookmark module -->
            <!-- .bpanel-box-->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php _e("Social Bookmark",'spatreats'); ?></h3>
                </div>
                <div class="box-content">
	                <p class="note no-margin"><?php _e("Manage social media bookmark options and its layout to show in the blog post",'spatreats')?></p>
                	<?php global $mytheme_social_bookmarks;
					  $count = 1;
						foreach($mytheme_social_bookmarks as $social_bookmark):?>
                        <div class="one-half-content <?php echo ($count%2 == 0)?"last":''; ?>">
                            <div class="bpanel-option-set">
                             <label><?php echo $social_bookmark["label"];?></label>
                                <?php $switchclass = (mytheme_option('integration',"sb-post-".$social_bookmark['id'])<>'') ? 'checkbox-switch-on' :'checkbox-switch-off';?>
                                <div data-for="<?php echo "sb-post-".$social_bookmark['id'];?>" class="checkbox-switch <?php echo $switchclass;?>"></div>
                                <input id="<?php echo "sb-post-".$social_bookmark['id'];?>" type="checkbox" 
                                	name="mytheme[integration][<?php echo "sb-post-".$social_bookmark['id'];?>]" value="<?php echo $social_bookmark['id'];?>" 
									<?php checked($social_bookmark['id'],mytheme_option('integration',"sb-post-".$social_bookmark['id']));?>
                                class="hidden"/>
                            </div>
                        </div>
                <?php  $count++;
						 endforeach;?>  
                </div>
            </div><!-- Social Bookmark module end-->
            
        
        </div><!-- #integration-post end-->
        


        <div id="integration-page">
        	<?php $integration_page = array( 
					array(
						"title"=>		__('Add code to the top of your pages','spatreats'),
						"tooltip"=>		__('Place any codes to show on top of all single page. This is useful if you are looking to integrate things such as social bookmarking links, AD etc.,.','spatreats'),
						"textarea"=>	"single-page-top-code",
						"checkbox"=>	"enable-single-page-top-code",
						"label"=>		__('Enable single page top code','spatreats')
					),
					array(
						"title"=>		__('Add code to the bottom of your pages, before the comments','spatreats'),
						"tooltip"=>		__('Place any codes to show on bottom of all single page. This is useful if you are looking to integrate things such as social bookmarking links, AD etc.,.','spatreats'),
						"textarea"=>	"single-page-bottom-code",
						"checkbox"=>	"enable-single-page-bottom-code",
						"label"=>		__('Enable single page bottom code','spatreats')
					)
				);
			foreach($integration_page as $i_page): ?>
                <!-- .bpanel-box-->
                <div class="bpanel-box">
                	<div class="box-title"><h3><?php echo $i_page['title'];?></h3></div>
                    
                    <!-- .box-content -->
                	<div class="box-content">
                    	<h6><?php echo $i_page['label'];?></h6>
                        <div class="column one-fifth">
                   	    <?php $switchclass = (mytheme_option('integration',$i_page['checkbox'])<>'') ? 'checkbox-switch-on' :'checkbox-switch-off';?>
						<div data-for="<?php echo $i_page['checkbox'];?>" class="checkbox-switch <?php echo $switchclass;?>"></div>
                        <input id="<?php echo $i_page['checkbox'];?>" class="hidden" type="checkbox" name="mytheme[integration][<?php echo $i_page['checkbox'];?>]" 
                        value="<?php echo $i_page['checkbox'];?>" <?php checked($i_page['checkbox'],mytheme_option('integration',$i_page['checkbox'])); ?>/>
                        </div>
                        
                        <div class="column four-fifth last"><p class="note no-margin"><?php echo $i_page['tooltip'];?></p></div>  
                        
	                    <div class="clear"></div>
                        <div class="hr_invisible"></div>
                        <div class="hr_invisible"></div>
                    	<textarea id="mytheme[integration][<?php echo $i_page['textarea']?>]" 
                        name="mytheme[integration][<?php echo $i_page['textarea']?>]"><?php echo stripslashes(mytheme_option('integration',$i_page['textarea']));?></textarea>
                    </div><!-- .box-content end-->
                </div><!-- .bpanel-box end-->
	  <?php endforeach;?>
      
        </div><!-- #integration-page end-->
        
   </div><!-- .bpanel-main-content end-->
</div><!-- #integration end-->