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
