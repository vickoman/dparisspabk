<!-- #widgetarea -->
<div id="widgetarea" class="bpanel-content">
    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel widget-area-nav">
            <li><a href="#for-pages"><?php _e("Pages",'spatreats');?></a></li>
            <li><a href="#for-posts"><?php _e("Posts",'spatreats');?></a></li>
            <?php if( class_exists('woocommerce') ): ?>
            <li><a href="#for-products"><?php _e("Products",'spatreats');?></a></li>            
            <li><a href="#for-products-category"><?php _e("Products Category",'spatreats');?></a></li>
            <li><a href="#for-products-tag"><?php _e("Products Tag",'spatreats');?></a></li>
            <?php endif;?>
        </ul>
        
        <!-- #for-pages -->
        <div id="for-pages" class="tab-content">
        	<!-- .bpanel-box-->
        	<div class="bpanel-box">
            	<div class="box-title">
	                <h3><?php _e('Add new widget areas for pages','spatreats');?></h3>
                </div>
                <!-- .box-content -->
                <div class="box-content">
                	<p class="note"><?php _e("Select a PAGE that should receive a new widget area:",'spatreats');?></p>

                	<?php if(is_array(mytheme_option("widgetarea","pages"))):
							$pages = array_unique(mytheme_option("widgetarea","pages"));
							foreach($pages as $page):
							  echo "<!-- Category Drop Down Container -->";
							  echo "<div class='multidropdown'>";
							  echo  mytheme_pagelist("widgetarea,pages",$page,"multidropdown");						  
							  echo "</div><!-- Category Drop Down Container end-->";
							endforeach;
						  else:	
							  echo "<!-- Pages Drop Down Container -->";
							  echo "<div class='multidropdown'>";
							  echo  mytheme_pagelist("widgetarea,pages","","multidropdown");						  
							  echo "</div><!-- Category Drop Down Container end-->";
						  endif;?>
                </div><!-- .box-content End-->
            </div><!-- .bpanel-box -->
        </div><!-- #for-pages end-->

        <!-- #for-posts -->
        <div id="for-posts" class="tab-content">
        	<!-- .bpanel-box-->
        	<div class="bpanel-box">
            	<div class="box-title">
	                <h3><?php _e('Add new widget areas for posts','spatreats');?></h3>
                </div>
                <!-- .box-content -->
                <div class="box-content">
                	<p class="note"><?php _e("Select a POST that should receive a new widget area:",'spatreats');?></p>
                	<?php if(is_array(mytheme_option("widgetarea","posts"))):
							$posts = array_unique(mytheme_option("widgetarea","posts"));
							foreach($posts as $post):
							  echo "<!-- Category Drop Down Container -->";
							  echo "<div class='multidropdown'>";
							  echo  mytheme_postlist("widgetarea,posts",$post,"multidropdown");						  
							  echo "</div><!-- Category Drop Down Container end-->";
							endforeach;
						  else:
							 echo "<!-- Post Drop Down Container -->";
							 echo "<div class='multidropdown'>";
							 echo  mytheme_postlist("widgetarea,posts","","multidropdown");						  
							 echo "</div><!-- Category Drop Down Container end-->";						  
						  endif;?>
                </div><!-- .box-content End-->
            </div><!-- .bpanel-box -->
        </div><!-- #for-posts end-->
        
<?php if( class_exists('woocommerce') ): ?>
        <!-- #for-products -->
        <div id="for-products" class="tab-content">
        	<!-- .bpanel-box-->
        	<div class="bpanel-box">
            	<div class="box-title">
	                <h3><?php _e('Add new widget area for product','spatreats');?></h3>
                </div>
                <!-- .box-content -->
                <div class="box-content">
                	<p class="note"><?php _e("Select a PRODUCT that should receive a new widget area:",'spatreats');?></p>
                    <?php if(is_array(mytheme_option("widgetarea","products"))):
							$products = array_unique(mytheme_option("widgetarea","products"));
							foreach($products as $product):
							  echo "<!-- Product Drop Down Container -->";
							  echo "<div class='multidropdown'>";
							  echo  mytheme_productlist("widgetarea,products",$product,"multidropdown");						  
							  echo "</div><!-- Product Drop Down Container end-->";
							endforeach;
					  else: 	
						  echo "<!-- Product Drop Down Container -->";
						  echo "<div class='multidropdown'>";
						  echo  mytheme_productlist("widgetarea,products","","multidropdown");						  
						  echo "</div><!-- Product Drop Down Container end-->";
					  endif?>
                </div><!-- .box-content End-->
            </div><!-- .bpanel-box -->
        </div><!-- #for-products end-->

        <!-- #for-products-category -->
        <div id="for-products-category" class="tab-content">
        	<!-- .bpanel-box-->
        	<div class="bpanel-box">
            	<div class="box-title">
	                <h3><?php _e('Add new widget area for product','spatreats');?></h3>
                </div>
                <!-- .box-content -->
                <div class="box-content">
                	<p class="note"><?php _e("Select a product's category that should receive a new widget area:",'spatreats');?></p>
                    <?php if(is_array(mytheme_option("widgetarea","product-category"))):
							$products = array_unique(mytheme_option("widgetarea","product-category"));
							foreach($products as $product):
							  echo "<!-- Product Drop Down Container -->";
							  echo "<div class='multidropdown'>";
							  echo  mytheme_product_taxonomy_list("widgetarea,product-category",$product,"multidropdown","product_cat");						  
							  echo "</div><!-- Product Drop Down Container end-->";
							endforeach;
					  else: 	
						  echo "<!-- Product Drop Down Container -->";
						  echo "<div class='multidropdown'>";
						  echo  mytheme_product_taxonomy_list("widgetarea,product-category","","multidropdown","product_cat");						  
						  echo "</div><!-- Product Drop Down Container end-->";
					  endif?>
                </div><!-- .box-content End-->
            </div><!-- .bpanel-box -->
        </div><!-- #for-products-category end-->

        <!-- #for-products-tag -->
        <div id="for-products-tag" class="tab-content">
        	<!-- .bpanel-box-->
        	<div class="bpanel-box">
            	<div class="box-title">
	                <h3><?php _e('Add new widget area for product','spatreats');?></h3>
                </div>
                <!-- .box-content -->
                <div class="box-content">
                	<p class="note"><?php _e("Select a PRODUCT that should receive a new widget area:",'spatreats');?></p>
                    <?php if(is_array(mytheme_option("widgetarea","product-tag"))):
							$products = array_unique(mytheme_option("widgetarea","product-tag"));
							foreach($products as $product):
							  echo "<!-- Product Drop Down Container -->";
							  echo "<div class='multidropdown'>";
							  echo  mytheme_product_taxonomy_list("widgetarea,product-tag",$product,"multidropdown","product_tag");						  
							  echo "</div><!-- Product Drop Down Container end-->";
							endforeach;
					  else: 	
						  echo "<!-- Product Drop Down Container -->";
						  echo "<div class='multidropdown'>";
						  echo  mytheme_product_taxonomy_list("widgetarea,product-tag","","multidropdown","product_tag");						  
						  echo "</div><!-- Product Drop Down Container end-->";
					  endif?>
                </div><!-- .box-content End-->
            </div><!-- .bpanel-box -->
        </div><!-- #for-products-tag end-->
<?php endif;?>
    </div><!-- .bpanel-main-content end-->
</div><!-- #widgetarea end -->