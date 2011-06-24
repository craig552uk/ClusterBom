<?php
/**
 * Controller base class
 *
 * This is the base class for a controller object
 *
 * @author Gilbert Pellegrom
 * @package PIP
 */
class Controller {
	
    /**
     * Load object
     * @access public
     */
	public $load;  // Load object
	
	/**
	 * Session object
	 * @access public
	 */
	public $session;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->load = new Load();   
        $this->session = new UserSession();       
    }

    /*
     * Redirect the browser to a new location
     * @param string $loc Location path
     */
	public function redirect($loc)
	{
		global $config;
		
		header('Location: '. $config['base_url'] . $loc);
	}
    
}

