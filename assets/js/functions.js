/**
 * Registers our global scope
 *
 * @since Collaborate 1.0
 */
if ( ! this.COLLABORATE ) { 
	var COLLABORATE = {};
}

/**
 * Not all browsers have console, this prevents absent minded theme 
 * developers from breaking console if they leave a call in by mistake.
 *
 * @since Collaborate 1.0
 */
if ( ! this.console ) {
	var console = {};
	console.log = console.error = function(){
		"use strict";
		return;
	};
}

/**
 * Base JavaScript functions.
 *
 * Several global objects are passed to the function in order to save on
 * scope lookups and aid compression.
 *
 * @param object window the global window object
 * @param object document the global document object
 * @param object COLLABORATE the theme's global scope
 * @param object $ jQuery, if it exists
 * @since Collaborate 1.0
 */
COLLABORATE.base = function ( window, document, COLLABORATE, $ ) {
	"use strict";

	var html = document.documentElement,
		body = document.body;

};

/**
 * Initialise base functions, pass jQuery if it exists.
 *
 * @since Collaborate 1.0
 */
if ( this.jQuery ) {
	COLLABORATE.base ( this, document, COLLABORATE, jQuery );
}
else {
	COLLABORATE.base ( this, document, COLLABORATE );
}