<?php
/**
 * Record of url processing for debugging
 */
$url_processing = array();
/**
 * PIP main script
 *
 * @author Gilbert Pellegrom
 * @package PIP
 */
/**
 * Main PIP function
 *
 * Gets URL from request builds appropriate controller and calls requested function
 */
function pip()
{
	global $config, $url_processing;
    
    // Set our defaults
    $controller = $config['default_controller'];
    $action = 'index';
    $url = '';
		
	// Get request url and script url
	$request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
	$script_url  = (isset($_SERVER['PHP_SELF']))    ? $_SERVER['PHP_SELF'] : '';
	
	$url_processing['request_url'] = $request_url;
	$url_processing['script_url'] = $script_url;
    	
	// Get our url path and trim the / of the left and the right
	if($request_url != $script_url) $url = trim(preg_replace('/'. str_replace('/', '\/', str_replace('index.php', '', $script_url)) .'/', '', $request_url, 1), '/');

	// Split the url into segments
	$segments = explode('/', $url);
	
	$url_processing['url'] = $url;
	$url_processing['segments'] = $segments;
	
	// Do our default checks
	if(isset($segments[0]) && $segments[0] != '') $controller = $segments[0];
	if(isset($segments[1]) && $segments[1] != '') $action = $segments[1];
	
	$url_processing['controller'] = $controller;
	$url_processing['action'] = $action;

	// Get our controller file
    $path = APP_DIR . 'controllers/' . $controller . '.php';
	if(file_exists($path)){
        require_once($path);
	} else {
        $controller = $config['error_controller'];
        require_once(APP_DIR . 'controllers/' . $controller . '.php');
	}
	
	$url_processing['path'] = $path;
    
    // Check the action exists
    if(!method_exists($controller, $action)){
        $controller = $config['error_controller'];
        require_once(APP_DIR . 'controllers/' . $controller . '.php');
        $action = 'index';
    }
	
	// Create object and call method
	$obj = new $controller;
    die($obj->$action());
}

