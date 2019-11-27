/**
 * LifetypeEditor.js
 *
 * Non-wysiwyg javascript-based editor for textarea controls in browsers. It works in
 * exactly the same as HTMLArea control but instead of graphically showing the contents
 * of the post, works based on raw html code. It does not offer as many features as
 * htmlarea but it does offer some other things as customizable toolbars, support
 * for text selections and ranges, etc. It should work in every major browser with
 * some support for DOM and DHTML.
 *
 * This code is licensed under the terms of the GPL license.
 *
 * -- Installation and usage --
 *
 * Place this file somewhere in your web server tree and from your html files, call it like
 * <html>
 *  <head>
 *   <link rel="stylesheet" href="plogeditor.css" type="text/css">
 *   <script type="text/javascript" src="lifetypeeditor.js"></script>
 *  </head>
 *  <body>
 *   <h1>Lifetype Javascript Sample</h1>
 *   <form name="textEditor" id="textEditor">
 *    text1:<br/>
 *    <script type="text/javascript">ed1 = new LifetypeUIEditor('text1', 'ed1');</script>
 *    <textarea id="text1" name="text1" rows="8" cols="60"></textarea>
 *    <br/>text2:<br/>
 *    <script type="text/javascript">ed2 = new LifetypeUIEditor('text2', 'ed2');</script>
 *    <textarea id="text2" name="text1" rows="8" cols="60"></textarea>
 *   </form>
 *  </body>
 * </html>
 *
 * Create a new pLogEditor object in the place where you would like to show the 
 * toolbar of the editor. The first paramter for the constructor is the value of the 'id'
 * attribute of the textarea that will be the content area for the toolbar. The second parameter
 * is the name of the object itself, so if you are creating an editor called 'myEditor', the second
 * parameter will be 'myEditor.
 */
 
/**
 * main class
 *
 */
LifetypeUIEditor = function(txtId, objName) 
{

  // class attributes	
  this.txtId = txtId;
  this.objName = objName;
  
  // array with all the open tags that haven't been closed
  this.tagStack = new Array();
  
  this.debug = false;

  this.setToolbar = function()
  {
	  // --
	  // our very own toolbar
	  // --
	  this.toolBar = new Array();
	  options = new Array();
	  options['8'] = '8 pt';
	  options['10'] = '10 pt';
	  options['12'] = '12 pt';
	  options['14'] = '14 pt';
	  options['18'] = '18 pt';
	  options['24'] = '24 pt';  
	  options['36'] = '36 pt';
	  this.toolBar['list_font_size'] = new LifetypeUIEditor.List.FontSize( 'list_font_size', options );
	  this.toolBar['1_but_b']  = new LifetypeUIEditor.Button( '1_but_b', 'bold', '<strong>', '</strong>', 'ed_format_bold.gif', 1 );
	  this.toolBar['2_but_i']  = new LifetypeUIEditor.Button( '2_but_i', 'italics', '<em>', '</em>', 'ed_format_italic.gif', 1 );
	  this.toolBar['3_but_u']  = new LifetypeUIEditor.Button( '3_but_u', 'underline', '<span style="text-decoration:underline">', '</span>', 'ed_format_underline.gif', 1 );
	  this.toolBar['4_but_strikethrough'] = new LifetypeUIEditor.Button( '4_but_strikethrough', 'strikethrough', '<span style="text-decoration: line-through;">', '</span>', 'ed_format_strike.gif', 1 );
	  this.toolBar['but_sep1'] =  new LifetypeUIEditor.Button.Separator();
	  this.toolBar['but_align_left'] = new LifetypeUIEditor.Button( 'but_align_left', 'align left', '<div style="text-align: left;">', '</div>', 'ed_align_left.gif' );
	  this.toolBar['but_align_center'] = new LifetypeUIEditor.Button( 'but_align_center', 'align center', '<div style="text-align: center;">', '</div>', 'ed_align_center.gif' );
	  this.toolBar['but_align_right'] = new LifetypeUIEditor.Button( 'but_align_right', 'align right', '<div style="text-align: right;">', '</div>', 'ed_align_right.gif' );
	  this.toolBar['but_align_justify'] = new LifetypeUIEditor.Button( 'but_align_justify', 'align justify', '<div style="text-align: justify;">', '</div>', 'ed_align_justify.gif' );
	  this.toolBar['but_sep2'] =  new LifetypeUIEditor.Button.Separator();
	  this.toolBar['but_ordered_list'] = new LifetypeUIEditor.Button( 'but_ordered_list', 'ordered list', '<ol><li></li></ol>', '', 'ed_list_num.gif', -1 );
	  this.toolBar['but_unordered_list'] = new LifetypeUIEditor.Button( 'but_unordered_list', 'unordered list', '<ul><li></li></ul>', '', 'ed_list_bullet.gif', -1 );  
	  this.toolBar['5_but_a']  = new LifetypeUIEditor.Button.Link( '5_but_a', 'anchor', 'ed_link.gif' );
	  this.toolBar['6_but_img']= new LifetypeUIEditor.Button.Image( '6_but_img', 'image', 'ed_image.gif' );
	  this.toolBar['7_but_res']= new LifetypeUIEditor.Button.Resource ('7_but_res', 'resource', 'ed_resource.gif' );
	  this.toolBar['8_but_more']= new LifetypeUIEditor.Button.More ('8_but_more', 'more', 'ed_more.gif' );  
  }
  
  /**
   * returns whether our browser supports the features that we are going
   * to use or not
   *
   * @return true if supported, false if not
   */
  this.isSupportedBrowser = function()
  {
	 return( document.getElementById || document.all );
  }

  /**
   * draws the buttons. Takes no parameters
   *
   * @return nothing
   */
  this.init = function() 
  {
	  // generate the toolbar
	  this.setToolbar();
	
	  // load the editor stylesheet dynamically
	  link = document.createElement( "link" );
	  link.rel  = "stylesheet";
	  link.type = "text/css";
	  link.href = Lifetype.getBaseURL() + "/js/editor/lifetypeeditor.css";
	  head = document.getElementsByTagName('head').item( 0 );
	  head.appendChild( link );
	  
	  // first of all, check for unsupported browsers. If the browser
	  // is not supported, we will silently not do anything... since we won't
	  // even print the toolbar! (and nothing will happen without a toolbar)
	  if( !this.isSupportedBrowser())
	  	return;
		
	  markup = '';
	  
	  document.write('<div class="textEditorToolbar" id="textEditorToolbar">');
	  for( var buttonId in this.toolBar ) {
          if ( Lifetype.prototypeCompatibabilityCheck( buttonId ) )
	          continue;
	      button = this.toolBar[buttonId];
	      markup += button.show(this.txtId, this.objName);
	  }
	  document.write(markup);
	  document.write('</div>');
	  
	  if( this.debug ) {
		document.write('<textarea>'+markup+'</textarea>');
	  }
  }
  
  // after initializing the buttons, we can generate the toolbar
  // we can't call this method after defining it!! :)
  this.init();    
  
  /**
   * calls the edButton.execute() callback
   *
   * @param txtId
   * @param buttonId
   * @return nothing
   */
  this.execute = function( txtId, buttonId, param )
  {
	  // get the button from the array
	  var edButton = this.toolBar[buttonId];
	  
	  // execute the button
	  if( !this.selectionExists()) {
	  	result = edButton.execute( txtId, param );
		if( result != 'undefined' )
			this.insertText( result );
  	  }
  	  else {
	  	 surroundInfo = edButton.surround( txtId, param ); 
	     this.surroundText( surroundInfo['start'], surroundInfo['end'] );	  
      }
  }
  
  /**
   * returns the textarea object associated to this editor
   *
   * @return a textarea object
   */
  this.getTextArea = function()
  {
	  textArea = document.getElementById( this.txtId );
	  return textArea;
  }
  
  /** 
   * calls the onMouseOver handler for this button
   *
   * @param txtId
   * @param buttonId
   */
  this.mouseOver = function( txtId, buttonId )
  {
	  var edButton = this.toolBar[buttonId];
	  edButton.mouseOver();
  }
  
  /**
   * calls the onMouseOut handler for this button
   *
   * @param txtId
   * @param buttonId
   */
  this.mouseOut = function( txtId, buttonId )
  {
	  var edButton = this.toolBar[buttonId];
	  edButton.mouseOut();	  
  }
  
	/**
 	 * inserts text where the cursor is
 	 * 
 	 * @param myField
 	 * @param myValue
 	 * @return nothing
 	 */
	this.insertText = function(myValue) 
	{
		myField = this.getTextArea();
		
		//IE support
		if (document.selection) {
			myField.focus();
			sel = document.selection.createRange();
			sel.text = myValue;
			myField.focus();
		}
		//MOZILLA/NETSCAPE support
		else if (myField.selectionStart || myField.selectionStart == '0') {
			var startPos = myField.selectionStart;
			var endPos = myField.selectionEnd;
			myField.value = myField.value.substring(0, startPos)
		    	          + myValue 
                	      + myField.value.substring(endPos, myField.value.length);
			myField.focus();
			myField.selectionStart = startPos + myValue.length;
			myField.selectionEnd = startPos + myValue.length;
		} else {
			myField.value += myValue;
			myField.focus();
		}
	}  
	
	/**
	 * surrounds the current selection with the given opening and closing texts
	 *
	 * @param myValueOpen
	 * @param myValueClose
	 */
	this.surroundText = function( myValueOpen, myValueClose )
  	{
		myField = this.getTextArea();
		if (document.selection) {
			myField.focus();
			sel = document.selection.createRange();
			sel.text = myValueOpen + sel.text + myValueClose;
			myField.focus();
		}
		else if (myField.selectionStart || myField.selectionStart == '0') {
			var startPos = myField.selectionStart;
			var endPos = myField.selectionEnd;
			var cursorPos = endPos;		
			myField.value = myField.value.substring(0, startPos)
		              + myValueOpen
		              + myField.value.substring(startPos, endPos)
		              + myValueClose
                      + myField.value.substring(endPos, myField.value.length);
			cursorPos += myValueOpen.length + myValueClose.length;		
			myField.selectionStart = cursorPos;
			myField.selectionEnd = cursorPos;
			myField.focus();		
		} 
		else {
			myField.value += myValueOpen;
			myField.focus();
		}	  
  	}
  
  /**
   * returns whether there is a user selection in the given editor
   *
   * @return True if there is a selection or false otherwise
   */
  this.selectionExists = function()
  {
	var selection = false;
	var myField = this.getTextArea();
	  
	if (document.selection) {
		// for IE
		myField.focus();
		sel = document.selection.createRange();
		selection = (sel.text != '' );
		myField.focus();
	}
	else if (myField.selectionStart || myField.selectionStart == '0') {
		// for Mozilla
		selection = (myField.selectionEnd > myField.selectionStart)
	}
	else {
		// for everybody else...
		selection = false;
	}

	return selection;
  }
}

/**
 * represents a button from our toolbar
 *
 * @param id
 * @param display
 * @param tagStart
 * @param tagEnd
 * @param icon
 * @param open
 */
LifetypeUIEditor.Button = function(id, display, tagStart, tagEnd, icon, open) 
{
	this.id = id;				// used to name the toolbar button
	this.display = display;		// label on button
	this.tagStart = tagStart; 	// open tag
	this.tagEnd = tagEnd;		// close tag
	this.open = open;			// set to -1 if tag does not need to be closed
	this.isOpen = false;
	this.icon = icon;
	this.htmlId = '';
	this.currentStatus = 'normalButton';
	
	/**
	 * renders the button
	 *
	 * @param txtId
	 * @return nothing
	 */
	this.show = function(txtId, objName)
	{
		// a very simple document.write...
		this.htmlId = txtId + '_' + this.id;
		var buttonText = '<img src="' + Lifetype.getBaseURL() + "/js/editor/images"+'/'+this.icon+'" id="' + txtId + '_' + this.id + '" class="normalButton" onmouseout="'+objName+'.mouseOut(\'' + txtId + '\', \'' + this.id + '\');" onmouseover="'+objName+'.mouseOver(\'' + txtId + '\', \'' + this.id + '\');" onclick="'+objName+'.execute(\'' + txtId + '\', \'' + this.id + '\', null );" alt = "' + this.display + '" />';
		
		return(buttonText);
	}
		
	/**
	 * returns the html element to which this button is associated
	 *
	 * @return an html element
	 */
	this.getHtmlButton = function()
	{
		return document.getElementById( this.htmlId );	
	}
	
	/**
	 * whether this button needs to be closed or not
	 *
	 * @return True whether it needs to be closed or false otherwise
	 */
	this.needsClose = function()
	{
		return( this.open != -1 );
	}
	
	/**
	 * handler for the onMouseOver event, changes the colour of the borders
	 */
	this.mouseOver = function()
	{
		htmlButton = this.getHtmlButton();
		htmlButton.className = 'buttonHover';
	}
	
	/** 
	 * handler for the onMouseOut event, returns the button to its original state
	 */
	this.mouseOut = function()
	{
		htmlButton = htmlButton = this.getHtmlButton();		
		htmlButton.className = this.currentStatus;
	}
	
	/**
	 * checks/unchecks the button
	 */
	this.toggle = function()
	{
		htmlButton = this.getHtmlButton();

	 	// change its class and save it for later use...
	 	if( this.currentStatus == 'pressedButton' )
	 		this.currentStatus = 'normalButton';
	 	else
	 		this.currentStatus = 'pressedButton';
	 		
	 	htmlButton.className = this.currentStatus;
	}
	
	/**
	 * performs the button's action
	 *
	 * @param txtId
	 * @return nothing
	 */
	this.execute = function( txtId, param )
	{
		var text = '';
		
		// check if the tag needs a closing tag
		if( this.open == -1 ) {
			// it doesnt...
			text = this.tagStart;
		}
		else {
			// it does...
			if( this.isOpen )
				text = this.tagEnd;
			else
				text = this.tagStart;
			
			// change the status of the button
			this.isOpen = !this.isOpen;			
		}
		
		// change the look of the button
		if( this.open != -1 ) {
		    this.toggle();
		}

		// return the text to be added
		return text;
	}

	/**
	 * special callback function that is executed when the main editor would like to 
	 * surround the current selection in the browser
	 *
	 * @param txtId the textarea id
	 */	
	this.surround = function( txtId, param )
	{
		surroundInfo = Array()
		surroundInfo['start'] = this.tagStart;
		surroundInfo['end'] = this.tagEnd;
		
		return surroundInfo;
	}
	
	this.toString = function()
	{
		objSignature = this.id + ' Button';
		return( objSignature );
	}
}

/**
 * visual separators for the toolbar are also implemented as buttons, but they do
 * do nothing and only show a vertical bar anyway with some margin on both sides...
 */ 
LifetypeUIEditor.Button.Separator = function()
{
	this.prototype = new LifetypeUIEditor.Button('separator', '', '', '', '', -1 );
	this.prototype.constructor = LifetypeUIEditor.Button;
	this.superclass = LifetypeUIEditor.Button;
	
	this.superclass('separator', '', '', '', '', -1 );
	
	/**
	 * draws a vertical line
	 */
	this.show = function( txtId, objName )
	{
		separatorCode = '<span class="separator"></span>';
		
		return( separatorCode );
	}
}

/**
 * special button that only adds a link
 *
 * @param id
 * @param display
 * @param icon
 */
LifetypeUIEditor.Button.Link = function(id, display, icon) 
{
	//
	// strange javascript thingies used for object inheritance...
	//
	this.prototype = new LifetypeUIEditor.Button(id, display, '', '', icon, -1 );
	this.prototype.constructor = LifetypeUIEditor.Button;
	this.superclass = LifetypeUIEditor.Button;
	
	this.superclass(id, display, '', '', icon, -1 );

	/**
	 * function redefined from above so that users can type links
	 *
	 * @param txtId
	 */
	this.execute = function( txtId, param )
	{		
		this.toggle();
		
		linkText = prompt('Enter the link text: ');
		if( linkText == null ) {
			this.toggle();
			return '';
		}
		
		linkDest = prompt('Enter the destination for the link:');
		if( linkDest == null ) {
			this.toggle();
			return '';
		}

		this.toggle();		

		// if everything went fine, add the link and return
		var linkTag = '<a href="' + linkDest + '">' + linkText + '</a>'; 
		return linkTag;
	}
	
	/**
	 * special behaviour for this function... It will only ask for the link destination
	 * and surround the current selection with the user's input
	 *
	 * @param txtId
	 */
	this.surround = function( txtId, param )
	{
		surroundInfo = Array();
		surroundInfo['start'] = '';
		surroundInfo['end'] = '';		
		
		this.toggle();
		linkDest = prompt('Enter the destination for the link:');
		if( linkDest == null ) {
			this.toggle();
			return surroundInfo;
		}
		
		surroundInfo['start'] = '<a href="' + linkDest + '">';
		surroundInfo['end'] = '</a>';
		
		this.toggle();
		
		return surroundInfo;
	}
}

/**
 * special button that only adds a link
 *
 * @param id
 * @param display
 * @param icon
 */
LifetypeUIEditor.Button.BR = function(id, display, icon) 
{
	//
	// strange javascript thingies used for object inheritance...
	//
	this.prototype = new LifetypeUIEditor.Button(id, display, '', '', icon, -1 );
	this.prototype.constructor = LifetypeUIEditor.Button;
	this.superclass = LifetypeUIEditor.Button;
	
	this.superclass(id, display, '<br />', '', icon, -1 );

	/**
	 * special behaviour for this function... It will only ask for the link destination
	 * and surround the current selection with the user's input
	 *
	 * @param txtId
	 */
	this.surround = function( txtId, param )
	{
		surroundInfo = Array();
		surroundInfo['start'] = '<p>';
		surroundInfo['end'] = '</p>';
		this.toggle();
		
		return surroundInfo;
	}
}

/**
 * special button that adds/removes the "[@more@]" separator
 *
 * @param id
 * @param display
 * @param icon
 */
LifetypeUIEditor.Button.More = function(id, display, icon) 
{
	//
	// strange javascript thingies used for object inheritance...
	//
	this.prototype = new LifetypeUIEditor.Button(id, display, '', '', icon, -1 );
	this.prototype.constructor = LifetypeUIEditor.Button;
	this.superclass = LifetypeUIEditor.Button;
	
	this.superclass(id, display, '', '', icon, -1 );
	
	/**
	 * @private
	 */
	this._getMoreTag = function()
	{
		return( "[@more@]" );
	}
	
	this.execute = function( txtId, param ) 
	{
		var txtArea = document.getElementById( txtId );
		var content = txtArea.value;
	    var bFound = 0;
		var startPos = 0;
		var returnValue = '';
	    
		// Parse all img tags and remove any 'more' tags
		while((startPos = content.indexOf(this._getMoreTag(), startPos)) != -1) {
	       var contentAfter = content.substring(startPos + this._getMoreTag().length);
	       content = content.substring(0, startPos) + contentAfter;
	       startPos++;
	       bFound = 1;
		}
		
	    if(bFound ) {
			// the tag is already there and should be removed, we can use a regular expression
			// to easily remove it
			returnValue = '';
			txtArea.value = content;
	     }
	     else {
			// the tag is not there and can be safely added
			returnValue = '\n' + this._getMoreTag() + '\n'; 
	    }
	
		return( returnValue );
	}
}

/**
 * special button that only adds an image
 *
 * @param id
 * @param display
 * @param icon
 */
LifetypeUIEditor.Button.Image = function(id, display, icon) 
{
	//
	// strange javascript thingies used for object inheritance...
	//
	this.prototype = new LifetypeUIEditor.Button(id, display, '', '', icon, -1 );
	this.prototype.constructor = LifetypeUIEditor.Button;
	this.superclass = LifetypeUIEditor.Button;
	
	this.superclass(id, display, '', '', icon, -1 );

	/**
	 * reimplemented from edButton so that we can ask for an image url and a description
	 *
	 * @param txtId
	 */
	this.execute = function( txtId, param )
	{
		textArea = document.getElementById(txtId);
		
		this.toggle();
		
		imgSrc = prompt('Enter the image source: ');
		if( imgSrc == null ) {
			this.toggle();
			return '';
		}
		
		imgAlt = prompt('Enter an image description:');
		if( imgAlt == null ) {
			this.toggle();
			return '';
		}
		
		this.toggle();

		// if everything went fine, add the link and return
		var imgTag = '<img src="' + imgSrc + '" alt="' + imgAlt + '" />';
		return imgTag;
	}
}

/**
 * special button that only adds an resource
 *
 * @param id
 * @param display
 * @param icon
 */
LifetypeUIEditor.Button.Resource = function(id, display, icon)
{
	//
	// strange javascript thingies used for object inheritance...
	//
	this.prototype = new LifetypeUIEditor.Button(id, display, '', '', icon, -1 );
	this.prototype.constructor = LifetypeUIEditor.Button;
	this.superclass = LifetypeUIEditor.Button;
	
	this.superclass(id, display, '', '', icon, -1 );

	/**
	 * reimplemented from edButton so that we can ask for an image url and a description
	 *
	 * @param txtId
	 */
	this.execute = function( txtId, param )
	{
		resource_list_window();

		return '';
	}
}

/**
 * implements drop-down lists
 */
LifetypeUIEditor.List = function( id, options )
{
	//
	// strange javascript thingies used for object inheritance...
	//
	this.prototype = new LifetypeUIEditor.Button(id, '', '', '', '', -1 );
	this.prototype.constructor = LifetypeUIEditor.Button;
	this.superclass = LifetypeUIEditor.Button;
	
	this.options = options;
	
	this.superclass(id, '', '', '', '', -1 );
	
	/**
	 * renders the button. In our case, creates a drop-down list with the available options
	 *
	 * @param txtId
	 * @returns the markup that is going to be written to the document
	 */
	this.show = function(txtId, objName)
	{
		selectBox = '<select class="editorDropDownList" name=\''+this.id+'\' onChange="'+objName+'.execute(\'' + txtId + '\', \'' + this.id + '\', this);">';
		for( var key in this.options ) {
            if ( Lifetype.prototypeCompatibabilityCheck( key ) )
	            continue;			
			selectBox += '<option value=\''+key+'\'>'+this.options[key]+'</option>';
		}
		selectBox += '</select>';
		
		return( selectBox );
	}
	
	/**
	 * reimplement this method for lists that should behave in a particular way when an option
	 * is selected
	 */
	this.execute = function( txtId, param )
	{
		// param is the drop-down list that generated the event, so we can easily learn
		// more about what was selected by 
		opt = param.selectedIndex;
	
		return( param.options[opt].value );
	}
	
	/**
	 * does nothing
	 */
	this.surround = function( txtId, param )
	{
		surroundInfo = Array();
		return( surroundInfo );
	}

}

/**
 * button that shows a list with different font sizes
 */
LifetypeUIEditor.List.FontSize = function( id, options )
{
	//
	// strange javascript thingies used for object inheritance...
	//
	this.prototype = new LifetypeUIEditor.List(id, options );
	this.prototype.constructor = LifetypeUIEditor.List;
	this.superclass = LifetypeUIEditor.List;
	
	this.superclass(id, options );
	
	/**
	 * returns the right <span style=...></span> markup
	 */
	this.execute = function( txtId, param )
	{
		// param is the drop-down list that generated the event, so we can easily learn
		// more about what was selected in the dropdown list
		opt = param.selectedIndex;
		fontSizePt = param.options[opt].value;
		
		spanCode = '<span style="font-size: '+fontSizePt+'pt;"></span>';
	
		return( spanCode );
	}
	
	/**
	 * surrouns the selected text with the right <span>...</span> tags
	 */
	this.surround = function( txtId, param )
	{
		opt = param.selectedIndex;
		fontSizePt = param.options[opt].value;	
	
		surroundInfo = Array();
		surroundInfo['start'] = '<span style="font-size: '+fontSizePt+'pt;">';
		surroundInfo['end'] = '</span>';
		return( surroundInfo );
	}
}
