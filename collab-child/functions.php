<?php
/**
 * Because we're considerate theme developers we've made all of the functions in our parent theme pluggable so people can copy and paste the function they want to modify from functions.php into this functions.php
 */

/**
 * Here's how you remove sizzle in a child theme
 *
 * @return bool
 */
function collaborate_enqueue_scripts() {
	return false;
}