tinyMCEPopup.requireLangPack();
tinyMCEPopup.resizeToInnerSize();

var EmbedDialog = {
	init : function() {
		var f = document.forms[0];

		// Get the selected contents as text and place it in the input
		f.embedcode.value = tinyMCEPopup.editor.selection.getContent({format : 'html'});
	},

	insert : function() {
		// Insert the contents from the input into the document
		tinyMCEPopup.editor.execCommand('mceInsertContent', false, document.forms[0].embedcode.value);
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(EmbedDialog.init, EmbedDialog);
