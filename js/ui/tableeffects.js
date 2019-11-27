/**
 * TableEffects class
 *
 * @param id The id of the table to which we'd like to apply the effects. If no id is provided (i.e. the constructor
 * is called without parameters), then all tables in the page will be processed
 */
Lifetype.UI.TableEffects = function( id )
{
	this.id = id;
	this.table = document.getElementById( id );	
}

/**
 * Given a table id, use stripes for its rows
 *
 * @param cssClass CSS class to be applied to odd rows. If none is provided, a class called
 * "odd" will be used.
 */
Lifetype.UI.TableEffects.prototype.stripe = function( cssClass )
{
	if( this.table ) 
		var tbodies = this.table.getElementsByTagName("tbody");
	else
		var tbodies = document.getElementsByTagName("tbody");
		
	if( !cssClass ) 
		cssClass = "odd";
		
	for (var i=0; i<tbodies.length; i++) {
		var odd = true;
		var rows = tbodies[i].getElementsByTagName("tr");
		for (var j=0; j<rows.length; j++) {
			if (odd == false) {
				odd = true;
			} 
			else {
				YAHOO.util.Dom.addClass( rows[j], cssClass );
				odd = false;
			}
		}
	}
}

/**
 * Highlights the row where the mouse is
 *
 * @param cssClass The name of the CSS cssClass to be applied to highlighted rows. If none is provided,
 * a class called "highlightClass" will be used
 */
Lifetype.UI.TableEffects.prototype.highlightRows = function( cssClass )
{
	if(!document.getElementsByTagName) 
		return false;
	
	if( !cssClass )
		cssClass = "highlightClass";
	
	if( this.table )
		var tbodies = this.table.getElementsByTagName("tbody");
	else
		var tbodies = document.getElementsByTagName("tbody");
	
	for (var j=0; j<tbodies.length; j++) {
		var rows = tbodies[j].getElementsByTagName("tr");
	  	for (var i=0; i<rows.length; i++) {
			rows[i].onmouseover = function() {				
				YAHOO.util.Dom.addClass( this, cssClass );
			}
			rows[i].onmouseout = function() {
				YAHOO.util.Dom.removeClass( this, cssClass );
			}
		}
	}
}