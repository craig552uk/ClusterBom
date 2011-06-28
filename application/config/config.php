<?php 
/**
 * PIP Configuration file
 *
 * @author Gilbert Pellegrom
 * @package PIP
 */

/**
 * Base URL including trailing slash (e.g. http://localhost/)
 */
$config['base_url'] = 'http://local.craig-russell.co.uk/ClusterBom/';

/**
 * System controllers
 *
 * default_controller   Loaded if no controller specified in URL
 * error_controller     Loaded when an error occurs
 */
$config['default_controller'] = 'main';
$config['error_controller'] = 'error';
 
/**
 * Database configuration
 *
 * db_host              Database host or IP (e.g. localhost)
 * db_name              Database name
 * db_username          Database username
 * db_password          Database password
 */
$config['db_host']     = 'localhost'; 
$config['db_name']     = 'clusterbom';
$config['db_username'] = 'root'; 
$config['db_password'] = 'passw0rd';

/**
 * Date & Time formats for display
 * See http://php.net/manual/en/function.date.php
 */
define('DATE_FORMAT', 'D jS M Y');
define('TIME_FORMAT', 'H:i:s');
define('DATETIME_FORMAT', TIME_FORMAT.' \o\n '.DATE_FORMAT);

/**
 * Strings for use throughout the appliction
 */
$config['str']['error']['ACCOUNT_DISABLED'] = 'Your account has been disabled, please contact technical support';
$config['str']['error']['GOOGLE_ACCOUNT_INVALID'] = 'Google oAuth has returned an invalid response.';

/**
 * oAuth 2.0 configuration
 */
$config['oauth']['auth_uri']       = 'https://accounts.google.com/o/oauth2/auth';
$config['oauth']['token_uri']      = 'https://accounts.google.com/o/oauth2/token';
$config['oauth']['client_id']      = '785503801988.apps.googleusercontent.com';
$config['oauth']['client_secret']  = 'gj0bPRhhNYQ7fMVg7JsqpR_W';
$config['oauth']['redirect_uri']   = $config['base_url'].'auth/oauth2/';
$config['oauth']['scope']          = 'https://spreadsheets.google.com/feeds/';
$config['oauth']['response_type']  = 'code';

