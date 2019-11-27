/**
 * functions for auto save
 */

// Before you change the following values, please make sure the total cookie size of the domain does not exceed 
// your LimitRequestFieldsize value in Apache. Or you will get a ugly error message like this in your browser: 
//
// [Bad Request: Size of a request header field exceeds server limit]
//
// The default LimitRequestFieldsize value of apache is 8192 bytes.
 
// In generally, the cookie size is 4096 bytes, So this number should be smaller then 4096
var maxBackupCookieLength = 3240;

// How many cookies we can use per postText and PostExtentedText
// see comment in clearAutoSaveCookie in adminaddnewpostaction.class.php if you change
// this to be something other than 1
var maxBackupCookiesPerBlog = 1;

// It doesn't make sense just backup few characters, use this to control the minimal backup length
var minBackupLength = 9;

// The time interval between two post backup, the default is 5 seconds
var backupInterval = 5;

// Timer we used for post backup
var backupTimer;

// Cookies we used in auto save
var postNotSavedCookieName = LTCookieBaseName + "postNotSaved";
var postTopicCookieName = LTCookieBaseName + "postTopic";
var postTextCookieName = LTCookieBaseName + "postText";

function deleteBackupPostFromCookie()
{
	deleteCookie( postNotSavedCookieName );
	for( cookieNum = 0; cookieNum < maxBackupCookiesPerBlog; cookieNum++ )
	{
		deleteCookie( postTopicCookieName + cookieNum );
		deleteCookie( postTextCookieName + cookieNum );
	}
}

function saveBackupPostToCookie( cookieName, content )
{
	// Clear old post, I know it stupid. But it seems the best way to keep the data clean.
	// If we use mutiple cookies to compose a single post.
	for( cookieNum = 0; cookieNum < maxBackupCookiesPerBlog; cookieNum++ )
	{
		deleteCookie( cookieName + cookieNum );
	}

	var dataIndex = 0;
	var cookieNum = 0;
	var data = escape( content );
	while ( ( dataIndex < data.length ) && ( cookieNum < maxBackupCookiesPerBlog ) ) {
		var cookieData = data.substring(dataIndex, dataIndex + maxBackupCookieLength);
		setCookie( cookieName + cookieNum, cookieData, 1);
		dataIndex += maxBackupCookieLength;
		cookieNum++;
	}
}

function loadBackupPostFromCookie( cookieName )
{
	var content = "";
	for( cookieNum = 0; cookieNum < maxBackupCookiesPerBlog; cookieNum++ )
	{
		data = getCookie( cookieName + cookieNum );
		if ( data )
			content += data;
		else
			break;
	}	

	return unescape( content );
}

function backupPost()
{
	postTopic = $('postTopic').value;
	
	if(htmlAreaEnabled){
        if(tinyMCE == undefined){
                // there is an error, forget the auto-saving
            clearInterval( backupTimer );
            return;
        }
		postText = tinyMCE.getInstanceById('postText').getBody().innerHTML;
	}
	else
	{
		postText = $('postText').value;
	}

	if( postTopic.length > 1 )
	{
		setCookie( postNotSavedCookieName, 1, 1);
		saveBackupPostToCookie( postTopicCookieName, postTopic );
	}
		
	if( postText.length > minBackupLength )
	{
		setCookie( postNotSavedCookieName, 1, 1);
		saveBackupPostToCookie( postTextCookieName, postText );
	}
}

function initialAutoSave()
{
	postNotSaved = getCookie( postNotSavedCookieName );
	if ( postNotSaved == 1 )
	{
		$('autoSaveMessage').innerHTML = msgAutoSaveMessage;
		Element.show($('autoSaveMessage'));
	}
	else
	{
		deleteBackupPostFromCookie();
	}
}

function startAutoSave() {
	backupTimer = setInterval('backupPost();', backupInterval * 1000 );
}

function restartAutoSave() {
	deleteBackupPostFromCookie();
	clearInterval( backupTimer );
	setTimeout( 'startAutoSave();', backupInterval * 1000 );
}

function restoreAutoSave()
{
	$('postTopic').value = loadBackupPostFromCookie( postTopicCookieName );
	
	if( htmlAreaEnabled )
	{
		tinyMCE.getInstanceById('postText').getBody().innerHTML  = loadBackupPostFromCookie( postTextCookieName );
	}
	else
	{
		$('postText').value = loadBackupPostFromCookie( postTextCookieName );
	}
	
	$('autoSaveMessage').innerHTML = '';
	Element.hide($('autoSaveMessage'));
}

function eraseAutoSave()
{
	deleteBackupPostFromCookie();
	
	$('autoSaveMessage').innerHTML = '';
	Element.hide($('autoSaveMessage'));
}
