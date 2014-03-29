(function() {
	tinymce.create("tinymce.plugins.DTCoreShortcodePlugin", {

		init : function(d, e) {

			d.addCommand("scnOpenDialog", function(a, c) {
				scnSelectedShortcodeType = c.identifier;

				jQuery.get(e + "/dialog.php", function(b) {
					jQuery("#scn-dialog").remove();
					jQuery("body").append(b);
					jQuery("#scn-dialog").hide();
					var f = jQuery(window).width();
					b = jQuery(window).height();
					f = 720 < f ? 720 : f;
					f -= 80;
					b -= 84;
					tb_show("Insert Shortcode", "#TB_inline?width=" + f
							+ "&height=" + b + "&inlineId=scn-dialog");
					jQuery("#scn-options h3:first").text(
							"Customize the " + c.title + " Shortcode");
				});

			});

		},

		getInfo : function() {
			return {
				longname : 'DesignThemes Core Shortcodes',
				author : 'DesignThemes',
				authorurl : 'http://themeforest.net/user/designthemes',
				infourl : '',
				version : "1.0"
			};

		},

		createControl : function(btn, e) {


			if ("designthemes_sc_button" === btn) {

				var a = this;
				var btn = e.createSplitButton("designthemes_sc_buttons",{
						title : "Insert Shortcode",
						image : DTCorePlugin.tinymce_folder	+ "/images/dt-icon.png",
						icons : false});
						
				btn.onRenderMenu.add(function(c, b) {
					
					//Accordion
					var accordion_cmd = "[accordion]"
					+'<br>[accordion_item title="Accordions Heading 1"]<br>'
					+'Lorem Ipsum passages, and more recently with desktop publishing software like. It has survived not only five centuries, but also the leap into electronic typesetting,'
					+'remaining essentially unchanged.'
					+'<br>[/accordion_item]'
					+'<br>[accordion_item title="Accordions Heading 2"]<br>'
					+'Lorem Ipsum passages, and more recently with desktop publishing software like. It has survived not only five centuries, but also the leap into electronic typesetting,'
					+'remaining essentially unchanged.'
					+'<br>[/accordion_item]'
					+'<br>[accordion_item title="Accordions Heading 3"]<br>'
					+'Lorem Ipsum passages, and more recently with desktop publishing software like. It has survived not only five centuries, but also the leap into electronic typesetting,'
					+'remaining essentially unchanged.'
					+'<br>[/accordion_item]'
					+"<br>[/accordion]";
					b.add({ title:"Accordion", onclick:function(){ tinyMCE.activeEditor.execCommand("mceInsertContent", false,accordion_cmd);}});//Accordion
					
					//ArcText
					var arctext_cmd = '[arctext rotate="true" radius="100" dir="1"]Sample[/arctext]';
					b.add({ title:"ArcText", onclick:function(){ tinyMCE.activeEditor.execCommand("mceInsertContent", false,arctext_cmd);}});
					//ArcText End
					
					//Button
					a.addWithDialog(b, "Button", "button");

					/* Callout Button */
					a.addWithDialog(b, "Callout Button", "callout");
							
					a.addWithDialog(b, "Column Layout", "column");
					
					/* Donutchart */
					c = b.addMenu({ title: "Donut Chart" });
					a.addImmediate(c, "Small",'<br>[dt_sc_donutchart_small title="Lorem" bgcolor="#808080" fgcolor="#4bbcd7" percent="70" /]<br>');
					a.addImmediate(c, "Medium",'<br>[dt_sc_donutchart_medium title="Lorem" bgcolor="#808080" fgcolor="#7aa127" percent="65" /]<br>');
					a.addImmediate(c, "Large",'<br>[dt_sc_donutchart_large title="Lorem" bgcolor="#808080" fgcolor="#a23b6f" percent="50" /]<br>');
					
					/* Dropcap Shortcodes */
					a.addWithDialog(b, "Dropcap", "dropcap");

					//Dividers
					c = b.addMenu({title: "Dividers"});
					a.addImmediate(c, "Horizontal Rule", "<br>[hr/] <br>");
					a.addImmediate(c, "Whitespace","<br>[hr_invisible/] <br>");
					a.addImmediate(c, "Clear", "[clear/]");
					//Dividers End

					/* Icon Box */
					a.addWithDialog(b, "Icon Boxes", "iconbox");

					//Shape Button
					a.addWithDialog(b, "Shaped Button", "shaped-button");
					
					//Icon Button
					a.addWithDialog(b, "Icon Button", "big-icon-button");
					
					//Blockquote
					a.addWithDialog(b, "Blockquote", "blockquote" );

					/* List Shortcodes */
					c = b.addMenu({title : "Lists"});
					a.addWithDialog(c, "Ordered List", "orderedlist");
					a.addWithDialog(c, "Unordered List","unorderedlist");
					
					c = b.addMenu({title : "Flower List"});
					var list = "<ul><li>Lorem ipsum dolor sit amet</li><li>Cras iaculis ante sed quam iaculis</li><li>Donec ullamcorper convallis</li><li>Aliquam placerat porta justo</li></ul>";
					a.addImmediate(c, "Brown","[brown-flower]<br>"+list+"<br>[/brown-flower]");
					a.addImmediate(c, "Dark brown","[darkbrown-flower]<br>"+list+"<br>[/darkbrown-flower]");
					a.addImmediate(c, "Green","[green-flower]<br>"+list+"<br>[/green-flower]");
					a.addImmediate(c, "Orange","[orange-flower]<br>"+list+"<br>[/orange-flower]");
					a.addImmediate(c, "Pink","[pink-flower]<br>"+list+"<br>[/pink-flower]");

					/*Pricing Table*/
					a.addWithDialog(b, "Pricing Table", "pricingtable");
					
					/* Progressbar*/
					c = b.addMenu({ title:"Progress Bar"});
					a.addImmediate(c, "Standard","<br>[dt_sc_progressbar value='85' type='standard' color='#9c59b6' textcolor=''] consectetur[/dt_sc_progressbar]<br>");
					a.addImmediate(c, "Stripe","<br>[dt_sc_progressbar value='75' type='progress-striped' color='' textcolor=''] consectetur[/dt_sc_progressbar]<br>");
					a.addImmediate(c, "Active","<br>[dt_sc_progressbar value='45' type='progress-striped-active'] consectetur[/dt_sc_progressbar]<br>");
					
					//Tab
					var tab_cmd = "[tab]"
						+"<br>[tab_nav_container]"
						+'<br>[tab_nav href="tab1" title="Tab one"/]'
						+'<br>[tab_nav href="tab2" title="Tab two"/]'
						+'<br>[/tab_nav_container]'
						+'<br>[tab_container]'
						+'<br>[tab_item id="tab1"]'
						+ '<p>Tab 1: Lorem Ipsum passages, and more recently with desktop publishing software like. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>'
						+'<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop.</p>'
						+'<br>[/tab_item]'
						+'<br>[tab_item id="tab2"]'
						+ '<p>Tab 2: Lorem Ipsum passages, and more recently with desktop publishing software like. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>'
						+'<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop.</p>'
						+'<br>[/tab_item]'
						+'<br>[/tab_container]'
						+'<br>[/tab]';
						
					b.add({ title:"Tab", onclick:function(){ tinyMCE.activeEditor.execCommand("mceInsertContent", false,tab_cmd);}});
					
					//Popular Procedure
					var pp_type1 = "[box-content]"
						+'<br><img class="alignleft" src="http://placehold.it/220x240/ffffff" width="220" height="240" />'
						+'<h2>Lorem Ipsum passages</h2>'
						+'<p>Nulla ullamcorper faucibus tellus sed malesuada. In convallis hendrerit velit id vulputate. In hac habitasse platea dictumst. Donec eget consequat urna. Pellentesque ac nibh risus. Duis scelerisque, metus ac adipiscing.</p>'
						+'<br>[tooltip href="#" title="Read More"/]'
						+ "<br>[/box-content]";

					var pp_type2 = "[box-content]"
						+'<br><img class="alignright" src="http://placehold.it/220x240/ffffff" width="220" height="240" />'
						+'<h2>Lorem Ipsum passages</h2>'
						+'<p>Nulla ullamcorper faucibus tellus sed malesuada. In convallis hendrerit velit id vulputate. In hac habitasse platea dictumst. Donec eget consequat urna. Pellentesque ac nibh risus. Duis scelerisque, metus ac adipiscing.</p>'
						+'<br>[tooltip href="#" class="left" title="Read More"/]'
						+ "<br>[/box-content]";
						
					
					var content = '<img alt="" src="http://placehold.it/300x276/ffffff" />'
						+'<br>[box-content-with-design]'
						+'<br><h3Lorem Ipsum passages</h3>'
						+'<br>[green-flower]'
						+'<br><ul>'
						+'<li>Fusce nec purus dui, id placerat sem.</li>'
						+'<li>Aenean at nunc sem, sit amet tristique nisi.</li>'
						+'<li>Duis at neque in libero aliquam molestie.</li>'
						+'<li>Nullam ornare ante et nulla accumsan molestie.</li>'
						+'<li>Vivamus volutpat ultricies felis, at sodales.</li>'
						+'<li>Nam faucibus nisi et nisl suscipit suscipit.</li>'
						+'<li>Sed non metus quam, id tincidunt ligula.</li>'
						+'</ul>'
						+'<br>[/green-flower]'
						+'<h3>Price Range</h3>'
						+'<br>[price-table]'
						+'<table><tbody><tr><td class="odd">1 hr</td><td class="even">$50</td></tr><tr><td class="odd">2 hrs</td><td class="even">$75</td></tr><tr><td class="odd">3 hrs (Max)</td><td class="even">'
						+'$125</td></tr></tbody></table>'
						+'<br>[/price-table]'
						+'<br>[/box-content-with-design]';
						
						var content2 = '<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It uses a dictionary of It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>'
						
						+'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>'
						
						+'<p>Lorem Ipsum passages, and more recently with desktop publishing software like. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>'
						
						+'<br>[blockquote]'
						+'<br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'
						+'<br>[/blockquote]'
						+'<br>[hr_invisible/]'
						+'<br>[big-ico-button link="http://google.com" class="book" text=" Book an Appointment "/]'
						+'<br>[big-ico-button link="http://themeforest.net" class="leaf" color="green"  text="Gift to a Friend "/]';

					
					var pp_type3 = "<h1>Lorem Ipsum passages</h1>"
						+'<br>[one-third id=""]'
						+ content
						+'<br>[/one-third]'
						+'<br>[two-third last]'
						+ content2
						+'[/two-third]'
						+'<br>[hr/]'
						+'<br>[clear/]'
						
					var pp_type4 = "<h1>Lorem Ipsum passages</h1>"
						+'<br>[two-third id=""]'
						+ content2
						+'<br>[/two-third]'
						+'[one-third last]'
						+ content
						+'<br>[/one-third]'
						+'<br>[hr/]'
						+'<br>[clear/]'

									
					c = b.addMenu({title: "Popular Procedure"});
					a.addImmediate(c, "Type 1", pp_type1);
					a.addImmediate(c, "Type 2", pp_type2);

					a.addImmediate(c, "Type 3", pp_type3);
					a.addImmediate(c, "Type 4", pp_type4);
					
					//Title Tag
					c = b.addMenu({title: "Title"});
					a.addImmediate(c, "H1",'<br>[h1]Lorem ipsum dolor sit amet[/h1]<br>');
					a.addImmediate(c, "H2",'<br>[h2]Lorem ipsum dolor sit amet[/h2]<br>');
					a.addImmediate(c, "H3",'<br>[h3]Lorem ipsum dolor sit amet[/h3]<br>');
					a.addImmediate(c, "H4",'<br>[h4]Lorem ipsum dolor sit amet[/h4]<br>');
					a.addImmediate(c, "H5",'<br>[h5]Lorem ipsum dolor sit amet[/h5]<br>');
					a.addImmediate(c, "H6",'<br>[h6]Lorem ipsum dolor sit amet[/h6]<br>');
					//Title Tag End
					
					/* Tooltip Shortcodes */
					a.addWithDialog(b, "Tooltip", "tooltip");
					
					//Others
					c = b.addMenu({title: "Others"});
					a.addImmediate(c,"Notice",'<br>[notice left="Mon - Fri :" right="8am - 6pm"/]<br>[notice left="Sat & Sunday :" right="8am - 10pm"/]');
					a.addImmediate(c,"Rounded Image",'<br>[image src="http://placehold.it/300x300/ffffff" class="rounded-img border"/]');
					a.addImmediate(c,"Member",'<br>[member name="Angela Mcarthy" role="Sr Therapist" ]<br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry sandard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<br>[/member]');
					a.addImmediate(c,"Contact Details",'<br>[contact-details]<br>[address line1="No: 58 A, East Madison St" line2="Baltimore, MD" line3="USA"/]<br>[mail id1="yourname@somemail.com"/]<br>[phone no1="+91 999 414 9897"/]<br>[/contact-details]');
					
					//Others End
					
				});// btn.onRenderMenu.add()
				return btn;
			}
		},
		

		addImmediate : function(d, e, a) {
			d.add({
				title : e,
				onclick : function() {
					tinyMCE.activeEditor.execCommand("mceInsertContent", false,
							a);
				}
			});
		},

		addWithDialog : function(d, e, a) {
			d.add({
				title : e,
				onclick : function() {
					tinyMCE.activeEditor.execCommand("scnOpenDialog", false, {
						title : e,
						identifier : a
					});
				}
			});

		}

	});

	// add DTCoreShortcodePlugin plugin
	tinymce.PluginManager.add("DTCoreShortcodePlugin",
			tinymce.plugins.DTCoreShortcodePlugin);
})();