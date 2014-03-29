<!-- #general -->
<div id="theme-footer" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#my-footer"><?php _e("Footer",'spatreats');?></a></li>
        </ul>
        

        <!-- #my-footer-->
        <div id="my-footer" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php _e('Footer','spatreats');?></h3>
                </div>
                
                <div class="box-content">
                
                    <div class="bpanel-option-set">

                         <h6><?php _e('Show Footer','spatreats');?></h6>
                    	 <?php $switchclass = ( "on" ==  mytheme_option('general','show-footer') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                         <div data-for="mytheme-show-footer" class="checkbox-switch <?php echo $switchclass;?>"></div>
						 <input class="hidden" id="mytheme-show-footer" name="mytheme[general][show-footer]" type="checkbox" 
						 <?php checked(mytheme_option('general','show-footer'),'on');?>/>
                         <div class="hr"></div>
                    
                        <h6><?php _e('Footer Column Layout','spatreats');?></h6>
                        <p class="note"><?php _e("Select a perfect column layout style for your theme's footer.",'spatreats');?></p>
                        
                        <ul class="bpanel-layout-set">
                        <?php $footer_layouts = array(1=>'one-column',2=>'one-half-column',3=>'one-third-column',4=>'one-fourth-column');?>
                        <?php foreach($footer_layouts as $k => $v): $class = ( $k ==  mytheme_option('general','footer-columns')) ? " class='selected' " : "";?>
                       		<li><a href="#" rel="<?php echo $k;?>" <?php echo $class;?>><img src="<?php echo IAMD_FW_URL."theme_options/images/columns/{$v}.png";?>" /></a></li>	
                        <?php endforeach;?>
                        </ul><input id="mytheme[general][footer-columns]" name="mytheme[general][footer-columns]" type="hidden"
                        			value="<?php echo  mytheme_option('general','footer-columns');?>"/>
                                    
                    </div><!-- .bpanel-option-set -->
                    <div class="hr"></div>

                    
                    
                    <div class="bpanel-option-set">
                         <h6><?php _e('Show Copyright Text','spatreats');?></h6>
                    	 <?php $switchclass = ( "on" ==  mytheme_option('general','show-copyrighttext') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                         <div data-for="mytheme-show-copyrighttext" class="checkbox-switch <?php echo $switchclass;?>"></div>
						 <input class="hidden" id="mytheme-show-copyrighttext" name="mytheme[general][show-copyrighttext]" type="checkbox" 
						 <?php checked(mytheme_option('general','show-copyrighttext'),'on');?>/>
                         <div class="hr_invisible"></div>
                    
                        <h6><?php _e('Copyright Text','spatreats');?></h6>
                        <textarea id="mytheme-copyright-text" name="mytheme[general][copyright-text]"
                        	rows="" cols=""><?php echo htmlspecialchars (stripslashes(mytheme_option('general','copyright-text')));?></textarea>
                        <p class="note"> <?php _e('You can paste your copyright text in this box. This will be automatically added to the footer.','spatreats');?> </p>
                    </div><!-- .bpanel-option-set -->
                    
                </div> <!-- .box-content -->
            
            </div><!-- .bpanel-box end -->
        </div><!--#my-footer end-->
        
    </div><!-- .bpanel-main-content end-->
</div><!-- #general end-->