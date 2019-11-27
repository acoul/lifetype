/** 
 * This will be the base class for all Lifetype Javascript code. Right 
 * now only the TableEffects class extends this, but in the future all code
 * will be moved to this framework.
 */

/**
 * Base Lifetype class 
 */
Lifetype = function() 
{
	// nothing yet
}

/**
 * Compatibility check
 */
Lifetype.prototypeCompatibabilityCheck = function( str )
{
    if ( str == '_each' ||
	  	 str == '_reverse' ||
         str == 'all' ||
         str == 'any' ||
         str == 'clear' ||
         str == 'collect' ||
         str == 'compact' ||
         str == 'detect' ||
         str == 'each' ||
         str == 'entries' ||
         str == 'extend' ||
         str == 'find' ||
         str == 'findAll' ||
         str == 'first' ||
         str == 'flatten' ||
         str == 'grep' ||
         str == 'include' ||
         str == 'indices' ||
         str == 'indexOf' ||
         str == 'inject' ||
         str == 'inspect' ||
         str == 'invoke' ||
         str == 'last' ||
         str == 'map' ||
         str == 'max' ||
         str == 'member' ||
         str == 'min' ||
         str == 'partition' ||
         str == 'pluck' ||
         str == 'reject' ||
         str == 'remove' ||
         str == 'removeItem' ||
         str == 'select' ||
         str == 'shift' ||
         str == 'sortBy' ||
         str == 'toArray' ||
         str == 'without' ||
         str == 'zip')
        return true;
    else
    	return false;
}

/**
 * Return the base URL of the script
 *
 * @return Base URL
 */
Lifetype.getBaseURL = function()
{
	// Get document base path
	documentBasePath = document.location.href;
	if (documentBasePath.indexOf('?') != -1)
		documentBasePath = documentBasePath.substring(0, documentBasePath.indexOf('?'));
		
	documentBasePath = documentBasePath.substring(0, documentBasePath.lastIndexOf('/'));

	return( documentBasePath );
}


/**
 * Base UI class
 */
Lifetype.UI = function() 
{
	// nothing yet
}