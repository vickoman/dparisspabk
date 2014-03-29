		<div class="hr_invisible"></div>
        
		<?php if(mytheme_option('general', 'show-newsletter') and mytheme_option('general', 'newsletter-listid') != ""): ?>        
            <!-- **Newsletter** -->
            <div id="newsletter">
                <h2><?php _e('Subscribe to Newsletter','spatreats');?></h2>
                <form method="post" name="frmsubnewsletter">
                    <p><input name="btm_mc_name" type="text" placeholder="<?php _e('Enter Name','spatreats');?>" /></p>
                    <p><input name="btm_mc_emailid" type="email" placeholder="<?php _e('Enter Email Address','spatreats');?>" required="" />
                       <input type="hidden" name="btm_mc_listid" value="<?php echo mytheme_option("general", "newsletter-listid"); ?>" /></p>                       
                    <p><input name="submit" type="submit" value="<?php _e('Subscribe','spatreats');?>" /></p>
                </form><?php
                
                #AFTER SUBMITTING FORM...
                if( isset($_REQUEST['btm_mc_emailid']) ):
                
                    require_once(IAMD_FW."theme_widgets/mailchimp/MCAPI.class.php");
                    $mcapi = new MCAPI( mytheme_option('general','mailchimp-key') );
                    
                    $merge_vars = Array( 'FNAME' =>$_REQUEST['btm_mc_name'], 'EMAIL' => $_REQUEST['btm_mc_emailid'] );
                    $list_id = $_REQUEST['btm_mc_listid'];
        
                    if($mcapi->listSubscribe($list_id, $_REQUEST['btm_mc_emailid'], $merge_vars ) ):
                        // It worked!   
                        $msg = '<span style="color:green;">'.__('Success!&nbsp; Check your inbox or spam folder for a message containing a confirmation link.', 'spatreats').'</span>';
                    else:
                        // An error ocurred, return error message   
                        $msg = '<span style="color:red;"><b>'.__('Error:', 'spatreats').'</b>&nbsp; ' . $mcapi->errorMessage.'</span>';
                    endif;
                    
                    #PRINTING RESULT...
                    if ( isset($msg) ) echo '<span class="zn_mailchimp_result">'.$msg.'</span>';				
                endif; ?>
            </div><!-- **Newsletter - End** -->
		<?php endif; ?>            

    </div><!-- **Main Container - End** -->
	<?php 
		$mytheme_options = get_option(IAMD_THEME_SETTINGS);
		$mytheme_general = $mytheme_options['general'];
		if(mytheme_option('general', 'show-footer')): ?>	
        <!-- ** Footer** -->
        <div id="footer">
            <div class="main-container"><?php
                show_footer_widgetarea($mytheme_general['footer-columns']); ?>
            </div>
        </div><!-- **Footer - End** -->
    <?php endif; ?>    

    <?php
		if(mytheme_option('general', 'show-copyrighttext')): ?>	
        <!-- **Footer Bottom** -->
        <div class="footer-bottom"> 
            <div class="main-container"><?php
                if(isset($mytheme_general['show-copyrighttext'])) :
                    echo stripslashes($mytheme_general['copyright-text']);
                endif;?></div>
        </div><!-- **Footer Bottom - End** -->
	<?php endif; ?>    
    
	<?php if (is_singular() AND comments_open()) wp_enqueue_script( 'comment-reply');
		if(mytheme_option('integration', 'enable-body-code') != '') 
			echo stripslashes(mytheme_option('integration', 'body-code'));
		wp_footer(); ?>
</div><!-- **Main - End**-->
</body>
</html>