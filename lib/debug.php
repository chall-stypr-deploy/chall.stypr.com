<?php

/* lib/debug.php
Made for debugging purposes */

function return_error() {
	// Returns error by template
	http_response_code( 404 );
	$template = new Template();
	$template->include( "error" );
}

function return_error_info( $error ) {
	// Print error info with beauty
	$file = $error['file'];
	$line = $error['line'];
	$msg = $error['message'];
	$style = "background:#333;color:#fff;width:600px;letter-spacing:-1px;" .
		"margin:0 auto;white-space:pre-wrap; font-family:monospace;";
	echo "<pre style='$style'><h2>$file:$line</h2> $msg </pre>";
}

function shutdown_function(){
	// Runs on shutdown of the script, even with errors.
	// This is far different from the PHP.ini auto_append_file
	// You can use this code to other projects too.
	global $query;
	unset( $query );
	$error = error_get_last();
	if ( $error['type'] === E_ERROR ) {
		if ( __DEBUG__ === true ) return_error_info( $error );
		return_error();
	}
	// You can also log or put html footers here!
}
register_shutdown_function( "shutdown_function" );

?>