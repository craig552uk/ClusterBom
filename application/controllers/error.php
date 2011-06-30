<?php
/**
 * Error Controller Class 
 *
 * This is the error controller class, it is used to display errors
 *
 * @author Gilbert Pellegrom
 * @package PIP
 */
class Error extends Controller {
	
    /**
     * Default controller function
     * Returns 404 error
     */
	function index()
	{
		$this->error404();
	}
	
    /**
     * Displays 404 'File Not Found' error
     */
	function error404()
	{
		// Load and render error view
		$template = $this->load->view('app/error');
		$template->set('session', $this->session->getData());
		$template->set('title','404 Error');
		$template->set('message','Looks like this page doesn\'t exist');
        $template->render();
	}
	
	/**
     * Displays 404 'File Not Found' error
     */
	function error403()
	{
		// Load and render error view
		$template = $this->load->view('app/error');
		$template->set('session', $this->session->getData());
		$template->set('title','403 Error');
		$template->set('message','Sorry, you can\'t access that page');
        $template->render();
	}
    
}

