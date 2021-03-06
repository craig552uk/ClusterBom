<?php
/**
 * View base class
 *
 * This is the base class for a view object
 *
 * @author Gilbert Pellegrom
 * @package PIP
 */
class View {

    /**
     * Array of variables accessible in the view scope
     * @private
     */
	private $pageVars = array();

    /**
     * Path to template file
     * @private
     */
	private $template;

    /*
     * Constuctor
     *
     * @param string $template Name of template
     */
	public function __construct($template)
	{
		$this->template = APP_DIR .'views/'. $template .'.php';
	}

    /*
     * Sets a variable name and value in the view scope
     * @param string $var Variable name
     * @param string $val Variable value
     */
	public function set($var, $val)
	{
		$this->pageVars[$var] = $val;
	}

    /*
     * Render the view
     * Extract set variables in to view scope
     *
     * @param boolean $ht       If true wraps view in source from 
     *                          sys/head.php and sys/tail.php 
     */
	public function render($ht=true)
	{
		extract($this->pageVars);

		ob_start();
		if($ht) include(APP_DIR . 'views/sys/head.php');
		include($this->template);
		if($ht) include(APP_DIR . 'views/sys/tail.php');
		echo ob_get_clean();
	}
    
}

