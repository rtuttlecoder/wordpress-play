<?php

function http_get_request($url) {
	$url = esc_url_raw($url);
	$args = ('user-agent' => 'Plugin Demo: HTTP API; ' . home_url());
	return wp_safe_remote_get($url, $args);
}

function http_get_response() {
	$url = 'https://api.github.com/';
	$reponse = http_get_request($url);

	// response data
	$code = wp_remote_retrieve_response_code( $response );
	$message = wp_remote_retrieve_response_message( $response );
	$body = wp_remote_retrieve_body( $response );
	$headers = wp_remote_retrieve_headers( $response );
	$header_date = wp_remote_retrieve_header( $response, 'date' );
	$header_type = wp_remote_retrieve_header( $response, 'content-type' );
	$header_cache = wp_remote_retrieve_header( $response, 'cache-control' );

	// output data
	$output = '<h2><code>' . $url . '</code></h2>';
	$ouput .= '<div>Response Code: ' . $code . '</div>';
	$output .= '<div>Response Message: ' . $message . '</div>';
	$output .= '<h3>Body</h3>';
	$output .= '<pre>';
	ob_start();
	var_dump($body);
	$output .= ob_get_clean();
	$output .= '</pre>';
	$output .= '<h3>Headers</h3>';
	$output .= '<div>Response Date: ' . $header_date . '</div>';
	$output .= '<div>Content Type: ' . $header_type . '</div>';
	$output .= '<div>Cache Control: ' . $header_cache . '</div>';
	$output .= '<pre>';
	ob_start();
	var_dump($headers);
	$output .= ob_get_clean();
	$output .= '</pre>';
	return $output;
}