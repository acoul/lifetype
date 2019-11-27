/**
 * opens a window with some help information
 *
 * @param helpurl The destination url
 * @return nothing
 */ 
function help_window(helpurl)
{
	HelpWin = window.open( helpurl,'HelpWindow','scrollbars=yes,resizable=yes,toolbar=no,height=400,width=400');
}

/**
 * opens a window pointing to the list of resources so that we can easily add one to our current
 * article
 *
 * @param type
 * @return nothing
 */
function resource_list_window() {
	width  = 500;
	height = 450;
	
	x = parseInt(screen.width / 2.0) - (width / 2.0);
	y = parseInt(screen.height / 2.0) - (height / 2.0);

	HelpWin = window.open( '?op=resourceList','ResourceListWindow','top='+y+',left='+x+',scrollbars=yes,resizable=yes,toolbar=no,height='+height+',width='+width);

}

function userPictureSelectWindow()
{
	width  = 500;
	height = 450;
	
	x = parseInt(screen.width / 2.0) - (width / 2.0);
	y = parseInt(screen.height / 2.0) - (height / 2.0);
	
	UserPicture = window.open( '?op=userPictureSelect', 'UserPictureSelect','top='+y+',left='+x+',scrollbars=yes,resizable=yes,toolbar=no,height='+height+',width='+width);
}

/**
 * resets the user picture/avatar in the profile page
 */
function resetUserPicture()
{
    window.document.userSettings.userPictureId.value = 0;
    // and reload the image path
    window.document.userSettings.userPicture.src = 'imgs/no-user-picture.jpg';
}

/**
 * resets blogid in the general setting page
 */
function resetBlogId()
{
    window.document.updateGlobalSettings.blogId.value = '';
}

/**
 * empties a drop-down list
 *
 * @param box The form object representing the drop-down list
 * @return nothing
 */
function emptyList( box )
{
	while ( box.options.length ) box.options[0] = null;
}

/**
 * fill a list with data
 *
 * @param box
 * @param numElems
 * @return nothing
 */
function fillList( box, numElems )
{
	for ( i = 1; i <= numElems; i++ ) {
		option = new Option( i, i );
		box.options[box.length] = option;
	}
	
	box.selectedIndex=0;
}

/**
 * @private 
 * @param box
 * @return nothing
 */
function changeList( box )
{
	daysMonth = days[box.options[box.selectedIndex].value-1];
	emptyList( box.form.postDay );
	fillList( box.form.postDay, daysMonth );
}

/**
 * Adds some text where the cursor is.
 *
 * Works in IE and Mozilla 1.3b+
 * In other browsers, it simply adds the text at the end of the current text
 */
function addText( input, insText ) 
{
	input.focus();
	if( input.createTextRange ) {
		parent.opener.document.selection.createRange().text += insText;
	} 
	else if( input.setSelectionRange ) {
		var len = input.selectionEnd;
		input.value = input.value.substr( 0, len ) + insText + input.value.substr( len );
		input.setSelectionRange(len+insText.length,len+insText.length);
	} 
	else { 
		input.value += insText; 
	}
}

/**
 * Used in the' user profile' screen where users can pick an image from their collection
 * and set it as their 'avatar'
 *
 * @param resId
 * @param url
 * @return nothing
 */
function returnResourceInformation(resId, url)
{
	// set the picture id
    parent.opener.document.userSettings.userPictureId.value = resId;
    // and reload the image path
    parent.opener.document.userSettings.userPicture.src = url;
}

/**
 * opens a window to see an screenshot from a template
 *
 * @param destination url
 */
function openScreenshotWindow( destUrl )
{
	ScreenshotWindow = window.open( destUrl, 'Screenshot','scrollbars=yes,resizable=yes,toolbar=no,height=600,width=800');
}

/**
 * opens the window where users can choose their own template. The destination url is hardcoded
 */
function openTemplateChooserWindow()
{
	width  = 500;
	height = 450;
	
	x = parseInt(screen.width / 2.0) - (width / 2.0);
	y = parseInt(screen.height / 2.0) - (height / 2.0);
	
	TemplateSelectorWindow = window.open( '?op=blogTemplateChooser', 'TemplateChooser','top='+y+',left='+x+',scrollbars=yes,resizable=yes,toolbar=no,height='+height+',width='+width);
}

/**
 * tells the parent window which template we chose
 */
function blogTemplateSelector( templateId )
{
	templateSelectList = parent.opener.document.blogSettings.blogTemplate;
	
	// loop throough the array with the different template sets and if we find the
	// one that the use just selected, then automatically select it and quit the loop
	for( i = 0; i < templateSelectList.options.length; i++ ) {
		if( templateSelectList.options[i].value == templateId ) {
			templateSelectList.selectedIndex = i;
			break;
		}
	}
	
	window.close();
}

/**
 * in the "newBlogUser" screen, shows and hides the 'notification area', a textbox
 * where users can type some text that will be included in an email sent to the user that is
 * going to be invited to the blog
 */
function toggleNotificationArea()
{
    var elem = document.getElementById('emailTextNotification');
    if( elem.style.display == 'none' )
      elem.style.display = '';
    else
      elem.style.display = 'none';
      
    return true;  
}

/**
 * the functions below are used in the "global settings" page, so that 
 * whole blocks of the html page can appear and disappear when needed
 */
// there is no current section selected
var currentSection='';
sections = ["general","summary","templates","urls","email","uploads","helpers","interfaces","security","bayesian","resources","search"];

function _toggle( sectionId )
{
 // get the dom object with such section
 element = document.getElementById( sectionId );
 
 currentStatus = element.style.display;

 // and toggle its visibility
 if( element.style.display == 'none' )
   element.style.display = 'block';
 else
   element.style.display = 'none';
  
 return true;
}

function toggleSection(sectionId)
{
 // if no section selected, do nothing
 if( sectionId == 'none' )
   return false;

 toggleAll( false );
 
 // and toggle the new one
 _toggle(sectionId);

 // now we have a new current section
 currentSection = sectionId;
   
 return true;  
}

function toggleAll( enabled )
{
  if( enabled ) statusString = 'block';
  else statusString = 'none';
  
  for( i = 0; i < sections.length; i++ ) {
    element = document.getElementById( sections[i] );
    element.style.display = statusString;
  }
}

/**
 * generic function for moving elements from one list to another!
 */
function moveElement(srcList, dstList)
{
	
	// now find out which user we've selected from the first list
	indexId = srcList.selectedIndex;
	
	// if no element was selected, quit
	if( indexId == -1 )
		return false;
	
	optText = srcList.options[indexId].text;
	optId  = srcList.options[indexId].value;
	
	if( optId == -1 ) {
		// do nothing, this is our special marker!
		return false;
	}
	
	// add the option to the opposite box
	newOpt = new Option( optText, optId );
	dstList.options[dstList.options.length] = newOpt;
	
	// and remove it from the current box
	srcList.options[indexId] = null;
	
	return true;
}

/**
 * automatically selects all the elements of a list
 */
function listSelectAll(listId)
{
	list = document.getElementById( listId );
	for( i = 0; i < list.options.length; i++ ) {
		list.options[i].selected = true;
	}

	return true;
}

function editBlogRemoveSelected()
{
	userList = document.getElementById( 'userList' );
    length = userList.options.length;
	for( i = 0; i < length; i++ ) {
		if( userList.options[i] ) {
			if( userList.options[i].selected ){
				userList.options[i] = null;
            	i--; 
            	//length--;
			}
        }
	}
	return( true );
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0 
    eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'"); 
    if (restore) selObj.selectedIndex=0; 
}

function getPostEditFormElements( formId )
{
	var formData = '';
	
	form = document.getElementById( formId );
	
	for(i = 0; i < form.elements.length; i++ ) {
		itemName = form.elements[i].name;
		itemValue = form.elements[i].value;
		
		if( itemName != "op" ) {
			// we don't want to send more than one "op" parameter... do we?
			if( itemName == "postCategories[]" ) {
				// we need to have a special case for this one because it's a list that
				// allows multiple selection... only using the "value" attribute will
				// return one of the items and we would like to have them all
				for (var j = 0; j < form.elements[i].options.length; j++) {
					if (form.elements[i].options[j].selected) 
						formData = formData + itemName + "=" + form.elements[i].options[j].value + "&";
				}
			}
			else if( itemName == "postText" && htmlAreaEnabled ) {
			    if ( blogLocale == "UTF-8" ) {
				    formData = formData + itemName + "=" + 
                        encodeURIComponent(
                            tinyMCE.getInstanceById('postText').getBody().innerHTML) + "&";
				} else {
				    formData = formData + itemName + "=" + 
                        escape(tinyMCE.getInstanceById('postText').getBody().innerHTML) + "&";
				}
			}
			else if( itemName == "postExtendedText" && htmlAreaEnabled ) {
				if ( blogLocale == "UTF-8" ) {
				    formData = formData + itemName + "=" + 
                        encodeURIComponent(
                            tinyMCE.getInstanceById('postExtendedText').getBody().innerHTML)
                        + "&";
			    } else {
				    formData = formData + itemName + "=" + 
                        escape(
                            tinyMCE.getInstanceById('postExtendedText').getBody().innerHTML)
                        + "&";
                }
			}
			else {
				// for all other elements, normal handling
				if ( blogLocale == "UTF-8" ) {
				    formData = formData + itemName + "=" + encodeURIComponent(itemValue) + "&";
				} else {
				    formData = formData + itemName + "=" + escape(itemValue) + "&";
			    }
			}
		}
    }	
    
    return formData;
}

/**
 * Returns the HTML code required to embed the Flash MP3 and video player, given
 * a URL to a playable media file.
 *
 * @param url
 * @return
 */
function getFlashPlayerHTML( url, height, width ) 
{
    var playerUrl = plogBaseUrl + "/flash/mp3player/mp3player.swf";
	
	var htmlCode = "<object data=\"" + playerUrl + "\" type=\"application/x-shockwave-flash\" width=\"" + width +"\" height=\"" + height + "\" class=\"ltPlayer\">"+
		"<param name=\"quality\" value=\"best\" />"+
		"<param name=\"bgcolor\" value=\"#FFFFFF\" />" +
        "<param name=\"movie\" value=\"" + playerUrl + "\" />" +
		"<param name=\"FlashVars\" value=\"&file="+ url + "&height=" + height + "&width=" + width + "\" />" +
    	"</object>";	

	return htmlCode;
}
