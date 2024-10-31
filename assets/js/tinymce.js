function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function insertPDWPcode() {

	var tagtext;
        var product_code_ddb  = document.getElementById('product_code');
        var product_code      = product_code_ddb.value;
	var product_name_ddb  = document.getElementById('product_name');
	var product_name      = product_name_ddb.value;
        var product_price_ddb = document.getElementById('product_price');
        var product_price     = product_price_ddb.value;

	if( ( product_name == "" ) && ( product_price == "" ) )
            return;

        tagtext = "[pdwpe product_code='" + product_code + "' product_name='" + product_name + "' product_price='" + product_price + "'";

        window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext + ']');
	tinyMCEPopup.editor.execCommand('mceRepaint');
	tinyMCEPopup.close();
	return;
}

