scnShortcodeMeta = {
	attributes : [
	
			{
				label : "Label",
				id : "text",
				help : "The button text.",
			},

			{
				label : "Link",
				id : "link",
				help : "Optional link (e.g. http://google.com).",
			},
			{
				label : "Size",
				id : "size",
				help : "Values: &lt;empty&gt; for normal size, small, large",
				controlType : "select-control",
				selectValues : [ 'small', 'medium', 'big'],
				defaultValue : 'medium',
				defaultText : 'medium (Default)'
			},
			{
				label : 'Variation',
				id : 'color',
				help : 'Choose one of our predefined color skins to use with your list.',
				controlType : "select-control",
				selectValues : ['','black','blue','brown','cyan','green','orange','pink','red','yellow'],
				defaultValue : '',
				defaultText : 'Select'
			},
			{
				label : "Title",
				id : "title",
				help : "The button title.",
			},
			{
				label : "Target",
				id : 'target',
				help : 'Setting the target to _blank will open your page in a new tab when the reader clicks on the button.',
				controlType : "select-control",
				selectValues : [ '_blank', '_new', '_parent', '_self', '_top' ],
				defaultValue : '_blank',
				defaultText : '_blank (Default)'
			} ],
	defaultContent : "",
	shortcode : "shape-button"

};