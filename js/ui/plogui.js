/**
 * when adding a new form, checks that there is at least one category selected
 */
function submitNewPost(form)
{
	if( form.postCategories.selectedIndex == -1 ) {
		// we have no category selected!
		window.alert(msgErrorNoCategorySelected);
		return false;
    }  
    
	return true;
}

/**
 * The following functions are called when clicking the "save draft and continue" button
 */
function saveDraftArticleAjax()
{
	// if there is no category selected, then we won't save a draft!
	form = document.getElementById( "newPost" );
	
	if( form.postTopic.value == '' ) {
		window.alert( msgErrorPostTopic );
		return false;
	}
	
    // Can't use form.postText.value, becasue the form.postText.value still "null"
    if( htmlAreaEnabled ) {
		postText = tinyMCE.getInstanceById('postText').getBody().innerHTML;
	} else {
		postText = form.postText.value;
    }
    
    if (postText == '') {
		window.alert( msgErrorPostText );
		return false;
	}
	
	if( !submitNewPost( form ))
		return false;	

    var formData = getPostEditFormElements( "newPost" );
	var url = plogAdminBaseUrl;
	var params = 'op=saveDraftArticleAjax&'+formData;
	var myAjax = new Ajax.Request(
					url,
					{method: 'post', 
                     parameters: params, 
                     onComplete: saveDraftArticleResponse}
					);    
}

function saveDraftArticleResponse(originalRequest)
{
    var success = false;
	//put returned XML in the textarea
	var xmldoc = originalRequest.responseXML;
    if(xmldoc){
        var id_elem = xmldoc.getElementsByTagName('id');
        if(id_elem && id_elem[0]){
            $('postId').value = id_elem[0].firstChild.nodeValue;

            var message = xmldoc.getElementsByTagName('message')[0].firstChild.nodeValue;
            if(message != ''){
                window.alert(message);
                success = true;
            }
        }
    }
    if(!success){
        window.alert('Error: couldn\'t save draft');
    }
}


/**
 * The following functions are called when clicking the "add category" button
 */
function addArticleCategoryAjax()
{
	var categoryName = $F('newArticleCategory');
	if (categoryName != ''){
		var url = plogAdminBaseUrl;

	var params = '';
	form = document.getElementById("newPost");
	for(i = 0; i < form.elements.length; i++ ) {
		itemName = form.elements[i].name;
		if(itemName == "CsrfToken" ) {
            params += itemName + '=' + escape(form.elements[i].value) + "&";
            break;
		}
    }	

    params += 'op=addArticleCategoryAjax' + '&categoryName=' + encodeURIComponent(categoryName);
    var myAjax = new Ajax.Request(
        url,
        {method: 'post', 
         parameters: params, 
         onComplete: addArticleCategoryResponse, 
         onLoading: showArticleCategorySavingStatus }
                                  );
	}
}

function addArticleCategoryResponse(originalRequest)
{
	//put returned XML in the textarea
	var xmldoc = originalRequest.responseXML;
	if(xmldoc){
        var success = xmldoc.getElementsByTagName('success')[0].firstChild.nodeValue;
        var message = xmldoc.getElementsByTagName('message')[0].firstChild.nodeValue;
        if(success == '0'){
            window.alert(message);
        }
        else{
            var catId = xmldoc.getElementsByTagName('id')[0].firstChild.nodeValue;
            var catName = xmldoc.getElementsByTagName('name')[0].firstChild.nodeValue;
            for(i=$( 'postCategories' ).length; i>0; i--){
                tmpText = $( 'postCategories' ).options[i-1].text;
                tmpValue = $( 'postCategories' ).options[i-1].value;
                tmpSelected = $( 'postCategories' ).options[i-1].selected;
                $( 'postCategories' ).options[i] = new Option( tmpText, tmpValue );
                $( 'postCategories' ).options[i].selected = tmpSelected;
            }
            $( 'postCategories' ).options[0] = new Option( catName, catId );
            $( 'postCategories' ).options[0].selected = true;
        }
    }
    else{
        window.alert("Error adding category");
    }
    $( 'newArticleCategory' ).value = '';
    $( 'addArticleCategory' ).disabled = 0;
}

function showArticleCategorySavingStatus(originalRequest) {
	$( 'newArticleCategory' ).value = msgSaving;
	$( 'addArticleCategory' ).disabled = 1;
}

/**
 * this function is the one called when clicking the "add category" button
 */
function submitPostsList(op)
{
	if ( op == 'changePostsStatus' )
	{
		if ( document.getElementById("postsList").postStatus.value == -1 )
	    	window.alert(errorPostStatusMsg);
		else
		{
			document.getElementById("postsList").op.value = op;
			document.getElementById("postsList").submit();
		}
	}
	else
	{
		document.getElementById("postsList").op.value = op;
		document.getElementById("postsList").submit();
	}
}

function submitCommentsList(op)
{
	if ( op == 'changeCommentsStatus' )
	{
		if ( document.getElementById("postCommentsList").commentStatus.value == -1 )
	    	window.alert(errorCommentStatusMsg);
		else
		{
			document.getElementById("postCommentsList").op.value = op;
			document.getElementById("postCommentsList").submit();
		}
	}
	else
	{
		document.getElementById("postCommentsList").op.value = op;
		document.getElementById("postCommentsList").submit();
	}
}

function submitTrackbacksList(op)
{
	if ( op == 'changeTrackbacksStatus' )
	{
		if ( document.getElementById("postTrackbacksList").trackbackStatus.value == -1 )
	    	window.alert(errorTrackbackStatusMsg);
		else
		{
			document.getElementById("postTrackbacksList").op.value = op;
			document.getElementById("postTrackbacksList").submit();
		}
	}
	else
	{
		document.getElementById("postTrackbacksList").op.value = op;
		document.getElementById("postTrackbacksList").submit();
	}
}

function submitGalleryItemsList(op)
{
	document.getElementById("Resources").op.value = op;
	document.getElementById("Resources").submit();
}

function submitLinksList(op)
{
	document.getElementById("links").op.value = op;
	document.getElementById("links").submit();
}

function submitBlogsList(op)
{
	if ( document.getElementById("blogStatus").value == -1 )
		window.alert(errorStatusMsg);
	else {
		document.getElementById("editBlogs").op.value = op;
		document.getElementById("editBlogs").submit();
	}
}

function submitUsersList(op)
{
	if ( document.getElementById("userStatus").value == -1 )
		window.alert(errorStatusMsg);
	else {
		document.getElementById("siteUsers").op.value = op;
		document.getElementById("siteUsers").submit();
	}
}

function switchMassiveOption()
{
	if ( $('massiveChangeOption').style.display == 'none' )
	{
		Element.show($('massiveChangeOption'));
		$('optionIconLink').innerHTML = hideMassiveChangeOption;
		$('optionIconLink').title = hideMassiveChangeOption;
	}
	else
	{
		Element.hide($('massiveChangeOption'));
		$('optionIconLink').innerHTML = showMassiveChangeOption;
		$('optionIconLink').title = showMassiveChangeOption;
	}
}

function showProgressBar( elementToHide )
{
   button = document.getElementById( elementToHide );
   button.style.display = "none";     
   bar = document.getElementById("status_bar");
   bar.style.display = "block";
}
