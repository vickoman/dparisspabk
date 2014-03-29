<!-- #appearance -->
<div id="appearance" class="bpanel-content">
    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel">
			<?php $sub_menus = array(
						array("title"=>__("Menu",'spatreats'), "link"=>"#appearance-menu"),
						array("title"=>__("Title",'spatreats'), "link"=>"#appearance-title"),
						array("title"=>__("Script",'spatreats'), "link"=>"#appearance-script"),
						array("title"=>__("Body",'spatreats'), "link"=>"#appearance-body"),
						array("title"=>__("Footer",'spatreats'), "link"=>"#appearance-footer"));
						
				  foreach($sub_menus as $menu): ?>
                  	<li><a href="<?php echo $menu['link']?>"><?php echo $menu['title'];?></a></li>
			<?php endforeach?>
        </ul>
        
        <!-- Menu Section -->
        <div id="appearance-menu" class="tab-content">
        	<div class="bpanel-box">
            
                <!-- Header Font -->
                <div class="box-title"><h3><?php _e('Menu Font','spatreats');?></h3></div>
                <div class="box-content">
            
                    <div class="bpanel-option-set">
                    	<h6><?php _e('Disable Menu Settings','spatreats');?></h6>
                        <?php mytheme_switch("",'appearance','disable-menu-font-settings');?>
                        <p class="note"> <?php _e('Enable or Disable Menu section apperance settings.','spatreats');?>  </p>                        
                    </div>
                    
                    <div class="clear"> </div>
                    <div class="hr"> </div>
                
                    <div class="column one-column bpanel-option-set">
                        <?php mytheme_admin_fonts(__('Menu Font','spatreats'),'mytheme[appearance][menu-font]',mytheme_option('appearance','menu-font'));?>
                        <p class="note"> <?php _e('Choose the menu font','spatreats');?> </p>                        
                        <div class="clear"></div>
                        <?php mytheme_admin_jqueryuislider(__('Menu Font Size','spatreats'),"mytheme[appearance][menu-font-size]",
						mytheme_option('appearance',"menu-font-size"));?>
                    </div>
                    
                </div><!-- Header Font End-->
            </div>
        </div><!-- Menu Section (#appearance-menu) End-->

        <!-- Title Section -->
        <div id="appearance-title" class="tab-content">
        	<div class="bpanel-box">
            
                <!-- Title Font -->
                <div class="box-title"><h3><?php _e('Title Font','spatreats');?></h3></div>
                <div class="box-content">
            
                    <div class="bpanel-option-set">
                    	<h6><?php _e('Disable Title Font Settings','spatreats');?></h6>
                        <?php mytheme_switch("",'appearance','disable-title-font-settings');?>
                        <p class="note"> <?php _e('Enable or Disable Title font settings.','spatreats');?>  </p>                        
                    </div>
                    
                    <div class="clear"> </div>
                    <div class="hr"> </div>
                
                    <div class="column one-column bpanel-option-set">
                        <?php mytheme_admin_fonts(__('Title Font','spatreats'),'mytheme[appearance][title-font]',mytheme_option('appearance','title-font'));?>
                        <p class="note"> <?php _e('Choose the title font','spatreats');?> </p>                        
                        <div class="clear"></div>
                    </div>
                    
                </div><!-- Title Font End-->
            </div>
        </div><!-- Title Section (#appearance-title) End-->

        <!-- Script Section -->
        <div id="appearance-script" class="tab-content">
        	<div class="bpanel-box">
            
                <!-- Script Font -->
                <div class="box-title"><h3><?php _e('Script Font','spatreats');?></h3></div>
                <div class="box-content">
            
                    <div class="bpanel-option-set">
                    	<h6><?php _e('Disable Script Font Settings','spatreats');?></h6>
                        <?php mytheme_switch("",'appearance','disable-script-font-settings');?>
                        <p class="note"> <?php _e('Enable or Disable Script font settings.','spatreats');?>  </p>                        
                    </div>
                    
                    <div class="clear"> </div>
                    <div class="hr"> </div>
                
                    <div class="column one-column bpanel-option-set">
                        <?php mytheme_admin_fonts(__('Script Font','spatreats'),'mytheme[appearance][script-font]',mytheme_option('appearance','script-font'));?>
                        <p class="note"> <?php _e('Choose the script font','spatreats');?> </p>                        
                        <div class="clear"></div>
                    </div>
                    
                </div><!-- Script Font End-->
            </div>
        </div><!-- Script Section (#appearance-script) End-->
        
        <!-- Body Section -->
        <div id="appearance-body" class="tab-content">
        	<div class="bpanel-box">
            	
                <!-- Body Font Settings -->
                <div class="box-title"><h3><?php _e('Body Font','spatreats');?></h3></div>
                <div class="box-content">
                
                    <div class="bpanel-option-set">
                    	<h6><?php _e('Disable Body Settings','spatreats');?></h6>
                        <?php mytheme_switch("",'appearance','disable-boddy-font-settings');?>
                        <p class="note"> <?php _e('Enable or Disable Body apperance settings.','spatreats');?>  </p>
                    </div>    
                    
                    <div class="hr"> </div>
                
                	<div class="column one-column bpanel-option-set">
                        <?php mytheme_admin_fonts(__('Body Font','spatreats'),'mytheme[appearance][body-font]', mytheme_option('appearance','body-font'));?>
                        <p class="note"> <?php _e('Choose the body font','spatreats');?> </p>
                        <div class="clear"></div>                                                      
                        <?php mytheme_admin_jqueryuislider(__('Body Font Size','spatreats'),"mytheme[appearance][body-font-size]",mytheme_option('appearance',"body-font-size"));?> 
                    </div>

                </div>
                <!-- Body Font Settings End-->
                 
            </div>
        </div><!-- Body Section(#appearance-body) end -->
        
        <!-- Footer Section -->
        <div id="appearance-footer" class="tab-content">
        
        	<div class="bpanel-box">
            	<!-- Footer Font -->
                <div class="box-title"><h3><?php _e('Footer Font','spatreats');?></h3></div>
                <div class="box-content">
                
                    <div class="bpanel-option-set">
                    	<h6><?php _e('Disable Footer Settings','spatreats');?></h6>
                        <?php mytheme_switch(__("Disable Footer Settings",'spatreats'),'appearance','disable-footer-font-settings');?>
                        <p class="note"><?php _e('Enable or Disable Footer apperance settings.','spatreats');?>  </p>
                    </div>
                    
                    <div class="hr"> </div>
                    
                    <div class="column one-column bpanel-option-set">
                    	<?php mytheme_admin_fonts(__('Footer Title Font','spatreats'),'mytheme[appearance][footer-title-font]', mytheme_option('appearance','footer-title-font'));?>
                        <p class="note"> <?php _e('Choose the footer font','spatreats');?> </p>
                        <div class="clear"></div>
                        <?php mytheme_admin_jqueryuislider(__('Footer Font Size','spatreats'),"mytheme[appearance][footer-title-font-size]",mytheme_option('appearance',"footer-title-font-size"));?>                    </div>
                        
                </div><!-- "box-content End-->
                
            </div><!-- .bpanel-box End -->
        </div><!-- Footer Section (#appearance-footer) End-->
        
    </div><!-- .bpanel-main-content end -->
</div><!-- #appearance  end-->