/********
 * Lifetype.Forms namespace 
 *
 * Includes all functions related to forms, form validation, lists, etc.
 ***************/

Lifetype.Forms = function() {}

Lifetype.Forms.List = function() {}

/**
 * @static
 * Removes the selected items from the list
 * @param elem The id of an HTML object
 */
Lifetype.Forms.List.removeSelected = function( elem )
{
	list = document.getElementById( elem );
	
	for( i = 0; i < list.options.length; i++ ) {
		if( list.options[i].selected ) {
			// the element is selected, remove it
			list.remove( i );
		}
	}
}

/**
 * @static
 * Removes al elements from a list
 * @param elem The id of an HTML object
 */
Lifetype.Forms.List.removeAll = function( elem )
{
	list = document.getElementById( elem );

	for( i = 0; i < list.options.length; i++ ) {
		list.remove( i );
	}
}

/**
 * @static
 * Selects all elements from a list
 * @param elem The id of an HTML object
 */
Lifetype.Forms.List.selectAll = function( elem )
{
	list = document.getElementById( elem );

	for( i = 0; i < list.options.length; i++ ) {
		list.options[i].selected = true;
	}
}


//
// :TODO:
// Move the functions above to the Lifetype.Forms.List namespace
//

//
// counter to keep track of how many elements we have!
//
var numFields = 2;
var debug = false;

function hideElement(elem)
{
 elem.type = 'hidden';
}

function showElement(elem)
{
 elem.type = 'file';
}
function toggleElement(elem)
{
 if( elem.type == 'hidden')
   showElement(elem);
 else
   hideElement(elem); 
}

function addElementToForm (containerName, fieldType, fieldName, fieldValue)
{
var separator = document.getElementById('marker');
var container = document.getElementById(containerName);
if (navigator.userAgent.indexOf("MSIE") != -1){//isie
var fileTag ="<input type='"+fieldType+"' value='' name='"+fieldName+"_"+numFields+"'>";
var fileObj = document.createElement(fileTag); 
var newLine = document.createElement('BR');
container.insertBefore(fileObj,separator);
container.insertBefore(newLine,separator);
numFields++;
}//endie
  else
	{//notie
	  if (document.getElementById) {
    var input = document.createElement('INPUT');
    var newLine = document.createElement('BR');
    var newFieldName = fieldName + '_' + numFields;
    if( debug) window.alert('adding field ' + newFieldName);
      if (document.all) { 
        input.type = fieldType;
        input.name = newFieldName;
        input.value = fieldValue;
      }
      else if (document.getElementById) { 
        input.setAttribute('type', fieldType);
        input.setAttribute('name', newFieldName);
        input.setAttribute('value', fieldValue);
      }
      
    container.insertBefore(input,separator);
    container.insertBefore(newLine,separator);
    numFields++;
  }
	}//endnotie
}

function getField (form, fieldName) {
  if (!document.all)
    return form[fieldName];
  else  // IE has a bug not adding dynamically created field 
        // as named properties so we loop through the elements array 
    for (var e = 0; e < form.elements.length; e++)
      if (form.elements[e].name == fieldName)
        return form.elements[e];
  return null;
}

function removeField (form, fieldName) {
  var field = getField (form, fieldName);
  if (field && !field.length)
    field.parentNode.removeChild(field);
}

function toggleField (form, fieldName, value) {
  var field = getField (form, fieldName);
  if (field)
    removeField (form, fieldName);
  else
    addField (form, 'hidden', fieldName, value);
}

/**
 * sets a field in the given document (like 'document' or 'parent.opener.document')
 * This function is useful to set a field regardless of in which form it is located
 */
function setDocumentField(dest, fieldName, value )
{
	element = dest.getElementById( fieldName );
	element.value = value;
}

function appendDocumentList(dest, fieldName, value, item )
{
	dstList = dest.getElementById( fieldName );
	
	// check if the element is already there
	found = false;
	j = 0;
	while( j < dstList.options.length && !found ) {
		if( dstList.options[j].text == item && dstList.options[j].value == value ) {
			// element found!
			found = true;
		}
		j++;
	}
	
	// add the element only if not found
	if( !found ) {
		newOpt = new Option( item, value );
		dstList.options[dstList.options.length] = newOpt;
	}
	
	return true;
}