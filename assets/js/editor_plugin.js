// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('payment_digital');
	 
	tinymce.create('tinymce.plugins.payment_digital', {
		
		init : function(ed, url) {
		// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');

			ed.addCommand('payment_digital', function() {
				ed.windowManager.open({
					file : url + '../../../includes/window.php',
					width : 400,
					height : 120,
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('payment_digital', {
				title : 'Pagamento Digital WP e-Commerce',
				cmd   : 'payment_digital',
				image : url + '../../../images/bt_comprar.png'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('payment_digital', n.nodeName == 'IMG');
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
					longname  : 'Pagamento Digital WP e-Commerce',
					author 	  : 'Apiki WordPress',
					authorurl : 'http://www.apiki.com',
					infourl   : 'http://www.apiki.com',
					version   : "0.1"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('payment_digital', tinymce.plugins.payment_digital);
})();