function checkUserNameAjax()
{
	var userName = $F('userName');
	//userName = userName.toLowerCase();
	if (userName != '')
	{
		var url = plogSummaryBaseUrl;
		var params = 'op=checkUserNameAjax' + '&userName=' + encodeURIComponent(userName);
		var myAjax = new Ajax.Request(
						url,
						{method: 'get', parameters: params, onComplete: showCheckUserNameResult }
						);
	}
	else
	{
		alert( emptyUserNameMessage );
	}
}

function showCheckUserNameResult(originalRequest) {
	//put returned XML in the textarea
	var xmldoc = originalRequest.responseXML;
	var success = xmldoc.getElementsByTagName('success')[0].firstChild.nodeValue;
	var message = xmldoc.getElementsByTagName('message')[0].firstChild.nodeValue;
	var successIcon = '<span style="background:green;color:white;font-weight:bold">&nbsp;!&nbsp;</span>&nbsp;&nbsp;';
	var errorIcon = '<span style="background:red;color:white;font-weight:bold">&nbsp;!&nbsp;</span>&nbsp;&nbsp;';
	Element.show($('checkResult'));
	if( success == 1 )
	{
		$( 'checkResult' ).className  = 'fieldValidationSuccess';
		$( 'checkResult' ).innerHTML = successIcon + message;
	}
	else
	{
		$( 'checkResult' ).className  = 'fieldValidationError';
		$( 'checkResult' ).innerHTML = errorIcon + message;
	}
}