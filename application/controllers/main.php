<?php
/**
 * Example Controller Class 
 *
 * This is an example controller showing how to extend the base controller class
 *
 * @author Gilbert Pellegrom
 * @package PIP
 */
class Main extends Controller {
	
    /**
     * Default controller function
     */
	function index()
    {
        // Load and render main view
		$template = $this->load->view('index');
		$template->set('title','Welcome to ClusterBom');
        $template->render();
	}
    
}

